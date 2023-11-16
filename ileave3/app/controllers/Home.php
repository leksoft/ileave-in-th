<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {

        $data['msg'] = '';
        $this->load->view('admin_login_v', $data);
    }

    public function UserIndex() {
        $data = array();
        $data['msg'] = '';
        if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("Success", "ลงทะเบียนเรียบร้อยแล้ว คุณสามารถเข้าใช้ระบบได้ทันที", "success")';
        }

        $this->load->view('user_login_v', $data);
    }

    //ตรวจสอบการเข้าสู่ระบบสำหรัรบผู้ดูแล ผู้ตรวจสอบ ผู้อนุมัติ
    function AdminAuthen() {

        $this->load->library('encrypt');

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $this->db->where('username', $username);
        $query = $this->db->get('tbperson');

        $msg = '';
        if ($query->num_rows() == 0) {

            $msg = 'swal("Error", "รหัสผู้ใช้งานไม่ถูกต้อง !", "error")';
            $result = false;
            $data['row']['username'] = $username;
        } else {
            $row = $query->row_array();
            if ($password != $this->encrypt->decode($row['password'])) {
                $msg = 'swal("Error", "รหัสผ่านไม่ถูกต้อง !", "error"';
                $result = false;
            } else {
                if ($row['status'] != '1') {
                    if ($row['status'] == '0') {
                        $msg = 'swal("Error", "รหัสผู้ใช้งานนี้อยู่ระหว่างรอการอนุมัติ ยังไม่สามารถใช้งานได้ในขณะนี้ !", "error")';
                    } else {
                        $msg = 'swal("Error", "รหัสผู้ใช้งานนี้ถูกระงับการใช้งาน ยังไม่สามารถใช้งานได้ในขณะนี้ !", "error")';
                    }
                    $result = false;
                } else {
                    $result = true;
                    $this->db->where('username', $username);
                    $row = $this->db->get('tbperson')->row_array();
                    $role = $this->db->get_where('tbrole', array('role_id' => $row['role_id']))->row_array();
                    $s_login = array(
                        'login_id' => $row['id'],
                        'login_code' => $username,
                        'login_name' => $row['name'],
                        'login_pic' => $row['picture'],
                        'login_type' => $row['role_id'],
                        'login_depart_id' => $row['depart_id'],
                        'login_role' => $role['role_name'],
                        'mem_status' => $row['status'],
                        'login_status' => '1'
                    );
                    $this->session->set_userdata('s_login', $s_login);
                }
            }
        }

        //superuser
        if ($username == USER && $password == PASS) {
            $msg = '';
            $result = true;
            $s_login = array(
                'login_id' => '0',
                'login_code' => $username,
                'login_name' => "Admin System",
                'login_role' => "ผู้ดูแลระบบ",
                'login_depart_id' => '1',
                'login_type' => '1',
                'mem_status' => '1',
                'login_status' => '1'
            );
            $this->session->set_userdata('s_login', $s_login);
        }

        if ($result) {
            redirect('main');
        } else {
            $data['row']['username'] = $username;
            $data['msg'] = $msg;
            $data['page_title'] = 'เข้าสู่ระบบ';

            $this->load->view('admin_login_v', $data);
        }
    }

    //ตรวจสอบการเข้าสู่ระบบสำหรับผู้ลา
    function UserAuthen() {

        $this->load->library('encrypt');

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $this->db->where('username', $username);
        $query = $this->db->get('tbuser');

        $msg = '';
        if ($query->num_rows() == 0) {
            $msg = 'swal("Error", "รหัสผู้ใช้งานไม่ถูกต้อง !", "error")';
            $result = false;
            $data['row']['username'] = $username;
        } else {
            $row = $query->row_array();
            if ($password != $this->encrypt->decode($row['password'])) {
                $msg = 'swal("Error", "รหัสผ่านไม่ถูกต้อง !", "error")';
                $result = false;
            } else {
                if ($row['status'] != '1') {
                    if ($row['status'] == '0') {
                        $msg = 'swal("Error", "รหัสผู้ใช้งานนี้อยู่ระหว่างรอการอนุมัติ ยังไม่สามารถใช้งานได้ในขณะนี้ !", "error")';
                    } else {
                        $msg = 'swal("Error", "รหัสผู้ใช้งานนี้ถูกระงับการใช้งาน ยังไม่สามารถใช้งานได้ในขณะนี้ !", "error")';
                    }
                    $result = false;
                } else {
                    $result = true;
                    $this->db->where('username', $username);
                    $row = $this->db->get('tbuser')->row_array();

                    $role = $this->db->get_where('tbrole', array('role_id' => $row['role_id']))->row_array();
                    $s_login = array(
                        'login_id' => $row['id'],
                        'login_code' => $username,
                        'login_name' => $row['name'],
                        'login_pic' => $row['picture'],
                        'login_type' => $row['role_id'],
                        'login_depart_id' => $row['depart_id'],
                        'login_role' => $role['role_name'],
                        'mem_status' => $row['status'],
                        'login_status' => '1'
                    );
                    $this->session->set_userdata('s_login', $s_login);
                }
            }
        }


        if ($result) {
            redirect('main');
        } else {
            $data['row']['username'] = $username;
            $data['msg'] = $msg;
            $data['page_title'] = 'เข้าสู่ระบบ';

            $this->load->view('user_login_v', $data);
        }
    }

    //ลงทะเบียนใช้งาน
    public function Register() {
        $data = array();

        $this->db->select('tbteam.id AS team_id,tbteam.name AS team_name,tbdepart.id AS depart_id,tbdepart.name AS depart_name');
        $this->db->from('tbteam');
        $this->db->join('tbdepart', 'tbdepart.team_id = tbteam.id');
        $data['depart'] = $this->db->get()->result_array();

        $this->load->view('register_v', $data);
    }

    //บันทึกข้อมุล
    public function RegisterSave() {
        $password = $this->input->post('password');

        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'card_id' => $this->security->xss_clean($this->input->post('card_id')),
            'username' => $this->security->xss_clean($this->input->post('username')),
            'depart_id' => $this->security->xss_clean($this->input->post('depart_id')),
            'role_id' => 4,
            'email' => $this->security->xss_clean($this->input->post('email')),
            'created' => date('Y-m-d H:i:m'),
            'status' => 1,
        );

        if ($password != '') {
            $this->load->library('encrypt');
            $data['password'] = $this->encrypt->encode($password);
        }

        $this->db->insert('tbuser', $data);

        redirect("Home/UserIndex?success=yes");
    }

    public function Logout() {
        $this->session->sess_destroy();
        redirect('Home/UserIndex');
    }

}
