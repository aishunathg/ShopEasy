<?php
class Review_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get review by review_id
     */
    function get_review($review_id)
    {
        return $this->db->get_where('review',array('review_id'=>$review_id))->row_array();
    }
        
    /*
     * Get all review
     */
    function get_all_review()
    {
        $this->db->join('products','review.product_id=products.product_id');
        $this->db->join('users','users.userId=review.user_id');
        $this->db->order_by('review_id', 'desc');
        $this->db->group_by('review.review_id');
        return $this->db->get('review')->result_array();
    }
        
    /*
     * function to add new review
     */
    function add_review($params)
    {
        $this->db->insert('review',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update review
     */
    function update_review($review_id,$params)
    {
        $this->db->where('review_id',$review_id);
        return $this->db->update('review',$params);
    }
    
    /*
     * function to delete review
     */
    function delete_review($review_id)
    {
        return $this->db->delete('review',array('review_id'=>$review_id));
    }
}