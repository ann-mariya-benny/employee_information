<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_employees($limit, $offset = 0, $type = '', $search_employee = array()) {
        
//        echo '<pre>';print_r($search_employee);
        
        if ($type == 'pagination') {
            $this->db->select('*');
        }
        if ($search_employee['employee_code']) {
            $search_employee['employee_code'] = $this->db->escape_str($search_employee['employee_code'], true);
            $this->db->where("( employees.employee_code LIKE '%" . $search_employee['employee_code'] . "%')");
        }
        if ($search_employee['employee_name']) {
            $search_employee['employee_name'] = $this->db->escape_str($search_employee['employee_name'], true);
            $this->db->where("( employees.employee_name LIKE '%" . $search_employee['employee_name'] . "%')");
        }
        if ($search_employee['department']) {
            $search_employee['department'] = $this->db->escape_str($search_employee['department'], true);
            $this->db->where("( employees.department LIKE '%" . $search_employee['department'] . "%')");
        }
        if ($search_employee['age']) {
            $search_employee['age'] = $this->db->escape_str($search_employee['age'], true);
            $this->db->where("( employees.age LIKE '%" . $search_employee['age'] . "%')");
        }
        if ($search_employee['experience']) {
            $search_employee['experience'] = $this->db->escape_str($search_employee['experience'], true);
            $this->db->where("( employees.experience LIKE '%" . $search_employee['experience'] . "%')");
        }

        $this->db->from(' employees');
        $this->db->order_by(' employees.id', 'asc');
        if ($type == 'pagination')
            $this->db->limit($limit, $offset);
        $query = $this->db->get();
        if ($type == 'pagination')
            $row = $query->result();
        else
            $row = $query->num_rows();
        
//        echo $this->db->last_query();
        
        return $row;
    }
    
}

