<?php

class Order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get order by order_id
     */
    function get_order($order_id)
    {
        
        return $this->db->get_where('orders',array('order_id'=>$order_id))->row_array();
    }
        
    /*
     * Get all orders
     */
    function get_all_orders()
    {
        if($this->session->role==2){
            $this->db->where('user_id',$this->session->userId);
        }
        $this->db->order_by('order_id', 'desc');
        return $this->db->get('orders')->result_array();
    }
        
    /*
     * function to add new order
     */
    function add_order($params)
    {
        $this->db->insert('orders',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update order
     */
    function update_order($order_id,$params)
    {
        $this->db->where('order_id',$order_id);
        return $this->db->update('orders',$params);
    }
    
    /*
     * function to delete order
     */
    function delete_order($order_id)
    {
        return $this->db->delete('orders',array('order_id'=>$order_id));
    }

    function verified($id)
    {
        return $this->db->get_where('orders',array('user_id'=>$this->session->userId, "product_id"=>$id))->num_rows();
    }

    function newOrder()
    {
       return $this->db->get_where("orders",array("order_date"=>date("Y-m-d")))->num_rows();
    }
    function totalOrder()
    {
       return $this->db->get("orders")->num_rows();
    }
    function users(){
        return $this->db->get_where("users",array("role"=> 2))->num_rows();
    }
    function sales(){
       return $this->db->query("select sum(total) as total from orders")->row();
    }
    function getOrderDetail($id)
    {
        $this->db->select("*");
        $this->db->from('products p');
        $this->db->join('orderdetail od','od.product_id=p.product_id');

        $this->db->where('od.order_id',$id);
        return $this->db->get()->result();
    }

    function history(){
        $this->db->select("p.*, count(p.product_id) as count");
        $this->db->from('products p');
        $this->db->join('orderdetail od','od.product_id=p.product_id');
        $this->db->join('orders o','o.order_id=od.order_id');
        $this->db->where("o.user_id",$this->session->userId);
        $this->db->group_by('p.product_id');
        $this->db->order_by("count",'desc');
        return $this->db->limit(4)->get()->result_array();
    }

    function notification($date){
        $this->db->select("p.*, count(p.product_id) as count");
        $this->db->from('products p');
        $this->db->join('orderdetail od','od.product_id=p.product_id');
        $this->db->join('orders o','o.order_id=od.order_id');
        $this->db->where("o.user_id",$this->session->userId);
        $this->db->where("o.order_date",$date);
        $this->db->group_by('p.product_id');
        $this->db->order_by("count",'desc');
        return $this->db->limit(4)->get()->result_array();
    }

    function isMailSent($date){
        return $this->db->get_where('notification',array('user_id'=>$this->session->userId, 'notification_date'=>$date))->num_rows();
    }
    function updatenotification($date){
        $data = array('user_id'=>$this->session->userId, 'notification_date'=>$date);
        $this->db->insert('notification',$data);
    }
}