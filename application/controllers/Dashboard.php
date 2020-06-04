<?php

/**
 * 
 */
class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->role != 1) {
			redirect('home', 'refresh');
		}
		$this->load->library('upload');
		$this->load->model(array('Product_model', 'Review_model', 'Order_model'));
		$this->load->library('cart');
	}
	function index()
	{
		$data['title'] = "Dashboard";
		$data["_view"] = "dashboard";
		$data['neworder'] = $this->Order_model->newOrder();
		$data['totalOrder'] = $this->Order_model->totalOrder();
		$data['totalUser'] = $this->Order_model->users();
		$data['totalSales'] = $this->Order_model->sales();
		$this->load->view('template', $data);
	}
	function products()
	{
		$data['products'] = $this->Product_model->get_all_products();
		$data['title'] = "Products";
		$data['_view'] = 'product/index';
		$this->load->view('template', $data);
	}
	function addProduct()
	{
		$this->load->library('form_validation');
		$data['title'] = "Add Products";
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|max_length[100]');
		$this->form_validation->set_rules('brand', 'Brand', 'required|max_length[100]');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');

		if ($this->form_validation->run()) {
			$config['upload_path']          = 'upload';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 800;
			$config['max_width']            = 2560;
			$config['max_height']           = 1960;

			$this->load->library('upload');
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('image')) {
				echo $this->upload->display_errors();
			} else {
				$upload_data = $this->upload->data();

				$params = array(
					'product_name' => $this->input->post('product_name'),
					'brand' => $this->input->post('brand'),
					'price' => $this->input->post('price'),
					'image' => base_url() . 'upload/' . $upload_data['file_name'],
				);

				$product_id = $this->Product_model->add_product($params);
				redirect('dashboard/products');
			}
		} else {
			$data['_view'] = 'product/add';
			$this->load->view('template', $data);
		}
	}
	function productremove($product_id)
	{
		$product = $this->Product_model->get_product($product_id);

		// check if the product exists before trying to delete it
		if (isset($product['product_id'])) {
			$this->Product_model->delete_product($product_id);
			redirect('dashboard/products');
		} else
			show_error('The product you are trying to delete does not exist.');
	}

	function reviews()
	{
		$data['review'] = $this->Review_model->get_all_review();

		$data['_view'] = 'reviews';
		$data['title'] = 'Reviews';
		$this->load->view('template', $data);
	}
	function dataset()
	{
		$file = fopen("dataset.csv", "w");
		$header = array("product_id", "brand", "also_bought", "recommendation");
		fputcsv($file, $header);
		fclose($file);
		$product = $this->db->get('products')->result();
		foreach ($product as $p) {
			$data['product'] = $this->Product_model->get_product($p->product_id);
			$alsobought = $this->db->query("select a.product_id, count(*) as cnt 
			from orderdetail a
			join (select distinct order_id from orderdetail where product_id = $p->product_id) b on (a.order_id = b.order_id)
			where a.product_id != $p->product_id
			group by a.product_id 
			order by cnt desc 
			limit 5")->result();
			//	var_dump($alsobought);
			$pro = [];
			foreach ($alsobought as $a) {
				array_push($pro, $a->product_id);
			}
			$data = array(
				$p->product_id,

				$p->brand,
				json_encode(($pro)),
				$pro[array_rand($pro)],
			);

			$file = fopen("dataset.csv", "a");


			fputcsv($file, $data);


			fclose($file);
		}
		echo "<script>alert('Dataset Created')</script>";
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
	function ordermanagement()
	{
		$data['orders'] = $this->Order_model->get_all_orders();

		$data['_view'] = 'orders/index';
		$data['title'] = 'Orders';
		$this->load->view('template', $data);
	}
	function createDataset()
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
		echo "<script>alert('Dataset Created')</script>";
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
	
	function data()
	{

		$order = 200;

		for ($j = 0; $j <= 200; $j++) {
			$rand = rand(1, 5);
			for ($i = 0; $i <= $rand; $i++) {
				$id = rand(3, 14);
				$data['product'] = $this->Product_model->get_product($id);

				$data = array(
					'id'      => $id,
					'qty'     => rand(1, 3),
					'price'   => $data['product']['price'],
					'name'    => $data['product']['product_name'],
				);

				$this->cart->insert($data);
			}

			$order = array(
				'user_id' => rand(2, 105),
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
			$this->cart->destroy();
		}
	}
}
