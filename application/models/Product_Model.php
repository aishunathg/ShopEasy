<?php

class Product_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get product by product_id
     */
    function get_product($product_id)
    {
        return $this->db->get_where('products',array('product_id'=>$product_id))->row_array();
    }
        
    /*
     * Get all products
     */
    function get_all_products()
    {
        $this->db->order_by('product_id', 'desc');
        return $this->db->get('products')->result_array();
    }
        
    /*
     * function to add new product
     */
    function add_product($params)
    {
        $this->db->insert('products',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update product
     */
    function update_product($product_id,$params)
    {
        $this->db->where('product_id',$product_id);
        return $this->db->update('products',$params);
    }
    
    /*
     * function to delete product
     */
    function delete_product($product_id)
    {
        return $this->db->delete('products',array('product_id'=>$product_id));
    }

    function get_product_review($product_id)
    {
        return $this->db->get_where('review',array('product_id'=>$product_id))->result_array();
    }
    function is_product_reviewed($product_id)
    {
        $is_product_reviewed =  $this->db->get_where('review',array('product_id'=>$product_id, "user_id"=>$this->session->userId))->num_rows();
        return $is_product_reviewed == 0 ? false : true;
    }



































    

    function frequent()
    {
        return $this->db->query("select a.product_id,p.image,p.brand,p.price,p.product_name, count(*) as cnt 
			from orderdetail a
			join (select distinct order_id from orderdetail where product_id = ".$this->session->recommend .") b on (a.order_id = b.order_id)
            join products p on p.product_id = a.product_id 
            where a.product_id != ".$this->session->recommend."
			group by a.product_id 
			order by cnt desc 
            limit 4")->result_array();
    }

    function recommended($product_id)
    {
        if(count($product_id)){
        $this->db->where_in('product_id',$product_id);
        return $this->db->limit(8)->get('products')->result_array();
    }
    }
}