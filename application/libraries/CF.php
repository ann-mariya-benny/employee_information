<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CF {

    function get_data($table, $where_array = array(), $order_by = array(), $limit = '') {
        $ci = & get_instance();
        $ci->load->database();
        if ($order_by) {
            foreach ($order_by as $key => $value) {
                $ci->db->order_by($key, $value);
            }
        }
        if ($limit > 0)
            $ci->db->limit($limit);
        $query = $ci->db->get_where($table, $where_array);
        $row = $query->result();
        return $row;
    }

    function insert_data($table, $insert_array) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->insert($table, $insert_array);
        return $ci->db->insert_id();
    }

    function insert_batch_data($table, $data) {
        $ci = & get_instance();
        $ci->db->insert_batch($table, $data);
        return $ci->db->insert_id();
    }

    function get_row_count($table, $where_array = array()) {
        $ci = & get_instance();
        $ci->load->database();
        $query = $ci->db->get_where($table, $where_array);
        $row = $query->num_rows();
        return $row;
    }

    function update_data($table, $update_array, $where_array) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->update($table, $update_array, $where_array);
        return $ci->db->affected_rows();
    }

    function delete_data($table, $where_array) {
        $ci = & get_instance();
        $ci->db->delete($table, $where_array);
        return $ci->db->affected_rows();
    }

    function gender($type = 'list', $id = 0) {
        $gender_list = array(1 => 'Male', 2 => 'Female');
        if ($type == 'text' && array_key_exists($id, $gender_list))
            return $gender_list[$id];
        else if ($type == 'list')
            return $gender_list;
        else
            return '';
    }

    function dateformats($date) {
        $date = explode('-', $date);
        if (count($date) == 3) {
            $date = $date[2] . '-' . $date[1] . '-' . $date[0];
        } else {
            $date = '';
        }
        return $date;
    }

    function getdateformat($date) {
        if ($date != '0000-00-00' && $date != '') {

            return date('d-m-Y', strtotime($date));
        } else {
            $date = '';
        }
        return $date;
    }

    function randomAlphaNum($numchars = 0) {
        $chars = explode(',', 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,0,1,2,3,4,5,6,7,8,9,#,@');
        $random = '';
        for ($i = 0; $i < $numchars; $i++) {
            $random .= $chars[rand(0, count($chars) - 1)];
        }
        return $random;
    }

    function email($data = array()) {
        if ($data) {
            $extra_files = array();
            $file = $cc = $bcc = '';
            $from_mail = $data['from_mail'];
            $from_name = $data['from_name'];
            $to_mail = $data['to_mail'];
            $subject = $data['subject'];
            $message = $data['message'];
            if (isset($data['file']) && $data['file'])
                $file = $data['file'];
            if (isset($data['cc']) && $data['cc'])
                $cc = $data['cc'];
            if (isset($data['bcc']) && $data['bcc'])
                $bcc = $data['bcc'];
            if (isset($data['extra_files']) && is_array($data['extra_files']) && $data['extra_files']) {
                $extra_files = $data['extra_files'];
            }
            $CI = & get_instance();
            $CI->load->library('email');
            $CI->email->clear(true);

            $config = array();
            $config['mailtype'] = 'html';

//            $email_config = $this->get_data('master_company', array('id' => 1));
//            if ($email_config) {
//                if ($email_config[0]->activate_smtp && $email_config[0]->smtp_host && $email_config[0]->smtp_user_name && $email_config[0]->smtp_password) {
//                    $config['protocol'] = 'smtp';
////                    $config['smtp_crypto'] = 'tls';
////                    $config['crlf'] = "\r\n";
////                    $config['newline'] = "\r\n";
//                    $config['smtp_host'] = $email_config[0]->smtp_host;
//                    $config['smtp_user'] = $email_config[0]->smtp_user_name;
//                    $config['smtp_pass'] = $email_config[0]->smtp_password;
//                    $config['smtp_port'] = $email_config[0]->smtp_port;
//                    $config = array(
//                        'protocol' => 'smtp',
//                        'smtp_host' => $email_config[0]->smtp_host,
//                        'smtp_port' => $email_config[0]->smtp_port,
//                        'smtp_user' => $email_config[0]->smtp_user_name,
//                        'smtp_pass' => $email_config[0]->smtp_password,
//                        'mailtype' => 'html',
//                        'charset' => 'iso-8859-1',
//                    );
//                }
//            }


            $CI->email->initialize($config);
            $CI->email->set_newline("\r\n");

            $CI->email->from($from_mail, $from_name);
            $CI->email->to($to_mail);
            if ($cc)
                $CI->email->cc($cc);
            if ($bcc)
                $CI->email->bcc($bcc);
            $CI->email->subject($subject);
            $CI->email->message($message);
            if ($file)
                $CI->email->attach($file);
            if ($extra_files) {
                foreach ($extra_files as $value) {
                    $CI->email->attach($value);
                }
            }
            $CI->email->send();

//  $CI->email->send(false);
// print_r($CI->email->print_debugger());
//die();
        }
    }

    function number_in_words($number = '') {
        if ($number) {
            $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            return ucfirst($f->format($number));
        }
    }

    function add_notification($array = array()) {
        if ($array) {
            $insert_array = array();
            $insert_array['date'] = date('Y-m-d H:i:s');
            $insert_array['type'] = $array['type'];
            $insert_array['service'] = $array['service'];
            if (isset($array['description']))
                $insert_array['description'] = $array['description'];
            if (isset($array['ref']))
                $insert_array['ref'] = $array['ref'];
            if (isset($array['ref_text']))
                $insert_array['ref_text'] = $array['ref_text'];
            $insert_array['user_to'] = $array['to'];
            $insert_array['user_from'] = $array['from'];
            $insert_array['msg_read'] = 0;
            $insert_array['sent'] = 0;
            $ci = &get_instance();
            return $this->insert_data('master_notification', $insert_array);
        }
    }

    function check_login($deactive = false) {
        $ci = & get_instance();
        $member_id = (int) $ci->session->userdata('xouser');
        if ($member_id <= 0) {
            $ci->session->sess_destroy();
            redirect('login');
        } else {
            $last_active = $ci->session->userdata('last_active');

            if (!$last_active) {
                $ci->session->sess_destroy();
                $ci->session->set_flashdata('message', 'Session Expired');
                redirect('login');
            } else {
                $diff = round(abs(strtotime(date('Y-m-d H:i:s')) - strtotime($last_active)) / 60, 2);

                if ($diff > 45) {
                    $ci->session->sess_destroy();
                    $ci->session->set_flashdata('message', 'Session Expired');
                    redirect('login');
                } else {
                    if (!$deactive) {
                        $ci->session->set_userdata('last_active', date('Y-m-d H:i:s'));
                    }
                    return true;
                }
            }
        }
    }

    function check_auth($module = '') {
        $ci = & get_instance();
        $member_id = (int) $ci->session->userdata('xouser');
        $auth = 0;
        if ($module == 'company') {
            $auth = (int) $ci->session->userdata('company_auth');
        } else if ($module == 'settings') {
            $auth = (int) $ci->session->userdata('setting_auth');
        }
        if (!$auth) {
            redirect('authentication/auth?module=' . $module);
        }
    }

    function datef($date = '', $format = 'Y-m-d H:i:s', $timezone = '') {

        if ($timezone == '')
            $timezone = XO_DEFAULT_TIMEZONE;
        if ($format == '')
            $format = 'Y-m-d H:i:s';
        $datetime = new DateTime($date);
        $la_time = new DateTimeZone($timezone);
        $datetime->setTimezone($la_time);
        return $datetime->format($format);
    }

    function timezones($id = '') {
        $time_zone = array('Asia/Kolkata' => '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi', 'Asia/Dubai' => '(GMT+04:00) Abu Dhabi, Muscat', 'Asia/Dhaka' => '(GMT+06:00) Dhakka, Bangladesh', 'Asia/Kathmandu' => '(GMT+05:45) Kathmandu, Nepal', 'Africa/Lagos' => '(GMT+01:00) Lagos, Nigeria, West Africa');
        if ($id != '')
            return @$time_zone[$id];
        else
            return $time_zone;
    }

    function getCurlData($url) {
        $url = curl_init($url);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($url, CURLOPT_POST, 1);
        curl_setopt($url, CURLOPT_POSTFIELDS, "");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, 2);
        $data = curl_exec($url);
        return $data;
    }

    function paginate($url = '', $style = "") {
        $ci = & get_instance();
        $return = '<select name="records_per_page" class="form-control" style="width: 150px;' . $style . '" onchange="paginate(this.value)">
                                        <option value="">Display Per Page</option>';
        foreach ($this->display_per_page('', TRUE) as $key => $value) {

            if ($ci->input->get('display') == $key)
                $return .= '<option value="' . $key . '" selected="selected">' . $value . '</option>';
            else
                $return .= '<option value="' . $key . '">' . $value . '</option>';
        }

        $return .= '</select>';
        $return .= '<script>function paginate(page){var url="' . site_url($url) . '"+page;window.location=url;}</script>';
        return $return;
    }

    function short_string($string = '', $limit = 15, $upper = true) {
        $string_old = $string;
        if ($string && strlen($string) > $limit && $limit) {
            $string = substr($string, 0, $limit) . '...';
            if ($upper)
                $string = strtoupper($string);
        }else {
            if ($upper)
                $string = strtoupper($string);
        }
        return '<span  title="' . $string_old . '">' . $string . '</span>';
    }

    function get_sum($table, $column, $where_array = array()) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select_sum($column);
        $query = $ci->db->get_where($table, $where_array);
        $row = $query->row();
        return $row;
    }

    function get_between($table, $from, $to, $value) {
        $ci = & get_instance();
        $ci->load->database();
        $query = $ci->db->where((int) $value . " BETWEEN  " . $from . " AND " . $to . "");
        $query = $ci->db->get($table);
        $row = $query->row();
        return $row;
    }

    function get_query_result($sql) {
        $ci = & get_instance();
        $ci->load->database();
        $query = $ci->db->query($sql);
        return $query;
    }

    function get_row($table, $where_array = array()) {
        $ci = & get_instance();
        $ci->load->database();
        $query = $ci->db->get_where($table, $where_array);
        $row = $query->row();
        return $row;
    }

}
