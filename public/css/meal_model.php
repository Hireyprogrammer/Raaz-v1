<?php
class Meal_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Get all meal categories from the database
    public function get_all_meal()
    {
        $sql = "SELECT * FROM tbl_meal_category";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_meal()
    {
        $sql = "SELECT ml.meal_id,mc.category_id, ml.name, ml.price, mc.name category_name, ml.image, ml.meal_status FROM tbl_meals ml 
        JOIN tbl_meal_category mc ON ml.category_id = mc.category_id";    

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}