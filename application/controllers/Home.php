<?php
class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->isLoggedIn && $this->session->role == 1) {
            redirect('user/login', 'refresh');
        }
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->model(array('Product_model', 'Review_model', 'Order_model'));
    }
    function index()
    {
        $today = date('Y-m-d');
        $days_ago = date('Y-m-d', strtotime('-1 days', strtotime($today) ));
        if($this->session->isLoggedIn) {
        if($this->Order_model->isMailSent($days_ago) == 0){
            $data['reminder'] = $this->Order_model->notification($days_ago);
            if(count( $data['reminder'])){
            $msg = $this->load->view('notification_email', $data,true);
            $this->load->library('email');
            $this->email->from('reviewsuggestions20@gmail.com', 'Product Recommentation');
            $this->email->to($this->session->email);
            $this->email->subject('Notification: Purchase Reminder');
            $this->email->message($msg);
            $this->email->send();
            }
            $this->Order_model->updatenotification($days_ago);
        }
    }

        $data['products'] = $this->Product_model->get_all_products();
        $data["_view"] = "product/products";
        $data['title'] = "New products";
        $this->load->view('user_template', $data);
    }
    private function createDataset()
	{
		$header = array("user_id", "product_id", "order_frequency", "product_name", "brand");
		$this->db->select("o.user_id,od.product_id,count(od.product_id) as order_frequency,p.product_name,p.brand");
		$this->db->from('orderdetail od');
		$this->db->join("orders o", 'o.order_id=od.order_id');
		$this->db->join("products p", "p.product_id=od.product_id");
		$res = $this->db->order_by('user_id','asc')->group_by('o.order_id')->get()->result();
		$data = array();
		foreach ($res as $r) {
			$order = array(
				$r->user_id,
				$r->product_id,
				$r->order_frequency,
				$r->product_name,
				$r->brand
			);
			array_push($data, $order);
		}
		$list = array(
			$header,
			$data
		);
		$file = fopen("dataset.csv", "w");
		fputcsv($file, $header);
		fclose($file);
		$file = fopen("dataset.csv", "a");

		foreach ($data as $line) {
			fputcsv($file, $line);
		}

		fclose($file);
		//echo "<script>alert('Dataset Created')</script>";
		//redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
    function detail($id)
    {
        $data['product'] = $this->Product_model->get_product($id);
        $data['reviews'] = $this->Product_model->get_product_review($id);
        $data['is_reviewed'] = $this->Product_model->is_product_reviewed($id);
        $data["_view"] = "product/details";
        $data['title'] = $data['product']['product_name'];
        $this->load->view('user_template', $data);
    }
    function placeOrder()
    {


        $order = array(
            'user_id' => $this->session->userId,
            'total' => $this->cart->total(),
        );
        $this->db->insert('orders', $order);
        $order_id = $this->db->insert_id();
        foreach ($this->cart->contents() as $items) {

            $detail = array(
                "order_id" => $order_id,
                "product_id" => $items['id'],
                "price" => $items['price'],
                "qty" => $items['qty'],
            );
            $this->db->insert('orderdetail', $detail);
        }
        $msg = $this->load->view('email', array(),true);
        $this->load->library('email');
        $this->email->from('reviewsuggestions20@gmail.com', 'Product Recommentation');
        $this->email->to($this->session->email);
        $this->email->subject('Order Placed');
        $this->email->message($msg);
        $this->email->send();
        $this->cart->destroy();
        $this->createDataset();
        echo "<script>alert('Order Placed')</script>";
        redirect('home/ordermanagement', 'refresh');
    }
    function order($id)
    {
        $data['product'] = $this->Product_model->get_product($id);
        /*$params = array(
            'product_id' => $id,
            'user_id' => $this->session->userId,
        );*/

        $data = array(
            'id'      => $id,
            'qty'     => 1,
            'price'   => $data['product']['price'],
            'name'    => $data['product']['product_name'],
        );

        $this->cart->insert($data);
        //  $order_id = $this->Order_model->add_order($params);
        exec("python prediction.py " . $id, $output);
        $this->session->set_userdata(
            array(
                "recommend" => $output[0]
            )
        );
        echo "<script>alert('Added to cart')</script>";
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
    function ordermanagement()
    {
        $data['orders'] = $this->Order_model->get_all_orders();

        $data['_view'] = 'orders/index';
        $data['title'] = 'Orders';
        $this->load->view('user_template', $data);
    }
    function reviews($id)
    {
        $brands = $this->db->select("distinct(brand) as brand")->from('products')->get()->result_array();

        $product = $this->Product_model->get_product($id);

        //$verified = $this->Order_model->verified($id) > 0 ? 1 : 0;
        $review_text = $this->input->post('review_text');

        $params = array(
            'product_id' => $id,
            'user_id' => $this->session->userId,
            'verified_buyer' => 1,
            'ip_address' => $this->ip(),
            'review_title' => $this->input->post('review_title'),
            'review_text' => $this->input->post('review_text'),
            'rating' => $this->input->post('rating'),


        );

        $review_id = $this->Review_model->add_review($params);
        echo "<script>alert('review submitted')</script>";
        redirect('home/detail/' . $id, 'refresh');
    }

    function ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_address;
    }

    function cart()
    {

        $data["_view"] = "cart";
        $data['title'] = "Cart";
        //echo "python app.py ". $this->session->userId;
        exec("python app.py " . $this->session->userId, $output);
        //var_dump($output);
        $product_id = array();
        for ($i = 19; $i < count($output) - 1; $i++) {
            $id  = explode("    ", $output[$i]);
            array_push($product_id, $id[1]);
        }
        //print_r($product_id);

        $data['products'] = $this->Product_model->recommended($product_id);
        $data['history'] = $this->Order_model->history();
        if ($this->session->recommend) {

            $data['frequent'] = $this->Product_model->frequent();
        } else {

            $data['frequent'] = [];
        }
        $this->load->view('user_template', $data);
    }
}
