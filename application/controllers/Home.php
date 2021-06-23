<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library("pagination");
        $this->load->helper('date');
        $this->load->library('cf');
        $this->load->model('employee_model');
    }

    function employees() {
        $type = $this->uri->segment(3);
        if ($type == 'add') {
            $this->load->view('add_employee');
        } else if ($type == 'save') {
            $insert_array['employee_code'] = '';
            $insert_array['employee_name'] = $this->input->post('employee_name');
            $insert_array['department'] = $this->input->post('department');
            $insert_array['age'] = $this->input->post('age');
            $insert_array['experience'] = $this->input->post('experience');
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
            if ($dob) {
                $insert_array['dob'] = $dob;
            } else {
                $insert_array['dob'] = '';
            }

            $doj = date('Y-m-d', strtotime($this->input->post('doj')));
            if ($doj) {
                $insert_array['doj'] = $doj;
            } else {
                $insert_array['doj'] = '';
            }

            $employee_details = $this->cf->insert_data('employees', $insert_array);

            $new_id = sprintf('%03d', $employee_details);
            $user_array['employee_code'] = "EMP" . $new_id;
            $this->cf->update_data('employees', $user_array, array('id' => $employee_details));
            redirect('home/employees');
        } else {
            if (isset($_POST['clear'])) {
                $this->session->unset_userdata('$search_employee_filters');
                redirect('home/employees');
            }
            $search_employee = $this->session->userdata('$search_employee_filters');
            if (!$search_employee) {
                $this->session->set_userdata(
                        array('$search_employee_filters' => array('employee_code' => '', 'employee_name' => '', 'department' => '', 'age' => '', 'experience' => '', 'dob' => '', 'doj' => '')));
                $search_employee = $this->session->userdata('$search_employee_filters');
            }
            if (isset($_POST['search'])) {
                $this->session->set_userdata(
                        array('$search_employee_filters' => array(
                                'employee_code' => $this->input->post('employee_code'),
                                'employee_name' => $this->input->post('employee_name'),
                                'department' => $this->input->post('department'),
                                'age' => $this->input->post('age'),
                                'experience' => $this->input->post('experience'),
                            )
                        )
                );
                $search_employee = $this->session->userdata('$search_employee_filters');
            }

//            echo '<pre>';print_r($search_employee);die();


            $dataplay = (int) $this->input->get('display');
            if ($dataplay == -1)
                $dataplay = 100;
            if (!$dataplay)
                $dataplay = 5;
            //Pagination
            $this->load->library('pagination');
            $offset = $this->input->get('per_page');
            $config['page_query_string'] = TRUE;
            $config['base_url'] = site_url('home/employees') . '?display=' . $dataplay;
            // $config['reuse_query_string'] = true;
            $config['per_page'] = $dataplay;
            $config["links"] = $this->pagination->create_links();
            $data['total_rows'] = $config['total_rows'] = $this->employee_model->get_employees('', '', 'total', $search_employee);

            $config['num_links'] = 5;
            //links style
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $this->pagination->initialize($config);
            $data['employees'] = $this->employee_model->get_employees($config['per_page'], $offset, 'pagination', $search_employee);
            $data['filter']=$search_employee;

            $data['links'] = $this->pagination->create_links();
//            $data['filter'] = $search_employee;
            $this->load->view('employees', $data);
        }
    }

}
