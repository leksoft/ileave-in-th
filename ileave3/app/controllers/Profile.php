<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    var $skin = 'backoffice/';
    var $skins = 'backoffice/template_v';

    //โปรไฟล์ผู้ลา
    public function UserIndex() {
        $data = array();
        $user_id = $this->input->get('id');


        if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("", "แก้ไขข้อมูลส่วนตัวเสร็จเรียบร้อย", "success")';
        }

        $rs = $this->User_m->UserById($user_id);
        $data['row'] = $rs['query'];

        $data['display_role'] = $this->User_m->display_role($data['row']['role_id']);
        $data['user_m'] = $this->User_m;



        $this->db->select('tbteam.id AS team_id,tbteam.name AS team_name,tbdepart.id AS depart_id,tbdepart.name AS depart_name');
        $this->db->from('tbteam');
        $this->db->join('tbdepart', 'tbdepart.team_id = tbteam.id');
        $depart = $this->db->get();

        $data['depart'] = $depart->result_array();



        $data['user_id']  = $user_id;
        $data['mydate'] = $this->mydate;
        $data['content'] = $this->skin . 'user/profile_frm_v';
        $this->load->view($this->skins, $data);
    }

    public function UserSave() {
        $id = $this->input->post('id');
        $password = $this->input->post('password');

        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'card_id' => $this->security->xss_clean($this->input->post('card_id')),
            'position' => $this->security->xss_clean($this->input->post('position')),
            'username' => $this->security->xss_clean($this->input->post('username')),
            'mobile' => $this->security->xss_clean($this->input->post('mobile')),
            'tel' => $this->security->xss_clean($this->input->post('tel')),
            'depart_id' => $this->security->xss_clean($this->input->post('depart_id')),
            'role_id' => $this->security->xss_clean($this->input->post('role_id')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'birthday' => $this->security->xss_clean($this->input->post('birthday')),
            'status' => 1,
        );

        if ($password != '') {
            $this->load->library('encrypt');
            $data['password'] = $this->encrypt->encode($password);
        }

        //******** upload file ****************
        if (isset($_FILES['pic_file'])) {
            $file_temp = $_FILES['pic_file']['tmp_name'];

            $name = $_FILES['pic_file']['name'];

            // rename
            $ext_file = explode(".", $_FILES['pic_file']['name']);
            $ext_file = $ext_file[count($ext_file) - 1];

            $timeVar = strtotime(date("H:i:s"));
            $minutes = ((idate('H', $timeVar) * 60) + idate('i', $timeVar) + idate('s', $timeVar));
            $file_name = $minutes . "." . $ext_file;

            $full_path = $this->myfile->GetPhysicalFromURL() . 'assets/upload/user/';

            // upload here
            if ($name != "") {
                if (file_exists($full_path . $file_name)) {
                    //ตรวจสอบว่ามีไฟล์ตามรหัสนี้หรือยัง
                    unlink($full_path . $file_name);
                }
                move_uploaded_file($file_temp, 'assets/upload/user/' . $file_name);
                $data['picture'] = $file_name;
            }
        }

        if ($id == '') {
            $this->db->insert('tbuser', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbuser', $data);
        }
        redirect("Profile/UserIndex?id=$id&success=yes");
    }
    // End โปรไฟล์ผู้ลา
    
    //โปรไฟล์พนักงาน
     public function PersonIndex() {
        $data = array();
        $person_id = $this->input->get('id');


        if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("", "แก้ไขข้อมูลส่วนตัวเสร็จเรียบร้อย", "success")';
        }

        $rs = $this->Person_m->PersonById($person_id);
        $data['row'] = $rs['query'];

        $data['display_role'] = $this->Person_m->display_role($data['row']['role_id']);
        $data['Person'] = $this->Person_m;



        $this->db->select('tbteam.id AS team_id,tbteam.name AS team_name,tbdepart.id AS depart_id,tbdepart.name AS depart_name');
        $this->db->from('tbteam');
        $this->db->join('tbdepart', 'tbdepart.team_id = tbteam.id');
        $depart = $this->db->get();

        $data['depart'] = $depart->result_array();



        $data['person_id']  = $person_id;
        $data['mydate'] = $this->mydate;
        $data['content'] = $this->skin . 'person/profile_frm_v';
        $this->load->view($this->skins, $data);
    }

    public function PersonSave() {
        $id = $this->input->post('id');
        $password = $this->input->post('password');

        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'card_id' => $this->security->xss_clean($this->input->post('card_id')),
            'position' => $this->security->xss_clean($this->input->post('position')),
            'username' => $this->security->xss_clean($this->input->post('username')),
            'mobile' => $this->security->xss_clean($this->input->post('mobile')),
            'tel' => $this->security->xss_clean($this->input->post('tel')),
            'depart_id' => $this->security->xss_clean($this->input->post('depart_id')),
            'role_id' => $this->security->xss_clean($this->input->post('role_id')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'birthday' => $this->security->xss_clean($this->input->post('birthday')),
            'status' => 1,
        );

        if ($password != '') {
            $this->load->library('encrypt');
            $data['password'] = $this->encrypt->encode($password);
        }

        //******** upload file ****************
        if (isset($_FILES['pic_file'])) {
            $file_temp = $_FILES['pic_file']['tmp_name'];

            $name = $_FILES['pic_file']['name'];

            // rename
            $ext_file = explode(".", $_FILES['pic_file']['name']);
            $ext_file = $ext_file[count($ext_file) - 1];

            $timeVar = strtotime(date("H:i:s"));
            $minutes = ((idate('H', $timeVar) * 60) + idate('i', $timeVar) + idate('s', $timeVar));
            $file_name = $minutes . "." . $ext_file;

            $full_path = $this->myfile->GetPhysicalFromURL() . 'assets/upload/person/';

            // upload here
            if ($name != "") {
                if (file_exists($full_path . $file_name)) {
                    //ตรวจสอบว่ามีไฟล์ตามรหัสนี้หรือยัง
                    unlink($full_path . $file_name);
                }
                move_uploaded_file($file_temp, 'assets/upload/person/' . $file_name);
                $data['picture'] = $file_name;
            }
        }

        if ($id == '') {
            $this->db->insert('tbperson', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbperson', $data);
        }
        redirect("Profile/PersonIndex?id=$id&success=yes");
    }
    //End Person

}
