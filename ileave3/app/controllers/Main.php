<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    var $skin = 'backoffice/';
    var $skins = 'backoffice/template_v';

    public function __construct() {
        parent::__construct();
        $ileave['activemenu'] = '001';
        $this->session->set_userdata('ileave', $ileave);

        $this->load->model('Person_m');
        $this->load->model('User_m');
        $this->load->model('Leave_m');
        $this->load->library('myfile');
        $this->load->library('mydate');
    }

    public function Index() {

        $s_login = $this->session->userdata('s_login');
        $login_type = $s_login['login_type'];

        if ($login_type == 1 || $login_type == 2 || $login_type == 3) {
            redirect('Main/isAdmin');
        } else if ($login_type == 4) {
            redirect('Main/isUser?status=wait');
        }
    }

    public function isUser() {

        $status = $this->input->get('status');

        $data = array();
        if ($this->input->get('msg') == 'yes') {
            $data['msg'] = 'swal("", "ยกเลิกรายการลาเรียบร้อยแล้ว", "success")';
        } else if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("", "บันทึกการลาเสร็จเรียบร้อยแล้ว", "success")';
        }
        $s_login = $this->session->userdata('s_login');
        $user_id = $s_login['login_id'];

        $array = $this->Leave_m->ShowLeave($status, $user_id);
        $data['query'] = $array['query'];
        $data['leave_m'] = $this->Leave_m;
        $data['user_m'] = $this->User_m;

        switch ($status) {

            case 'wait':
                $data['title'] = 'รายการลาที่ รอตรวจสอบ';
                break;
            case 'disapproval':
                $data['title'] = 'รายการลาที่ ไม่อนุมัติ';
                break;
            case 'approve':
                $data['title'] = 'รายการลาที่ อนุมัติ';
                break;

            case 'cancel':
                $data['title'] = 'รายการลาที่ ยกเลิก';
                break;
            case 'yes':
                $data['title'] = 'รายการลาที่ เห็นอนุญาติ';
                break;
            case 'no':
                $data['title'] = 'รายการลาที่ ไม่อนุญาติ';
                break;
            default :
                redirect('Main/isUser?status=wait');
                break;
        }


        $data['mydate'] = $this->mydate;
        $data['content'] = $this->skin . "leave/index_v";
        $this->load->view($this->skins, $data);
    }

    public function isAdmin() {
        $data = array();
        $s_login = $this->session->userdata('s_login');
        $login_type = $s_login['login_type'];

        if ($login_type == 2) {  //ผู้ตรวจสอบ
            redirect('Main/isApproversRoleTwo?status=wait');
        }
        if ($login_type == 3) {  //ผู้อนุมัติ
            redirect('Main/isApproversRoleTree?status=approve');
        }
        if ($login_type == 1) { //ผู้ดูแลระบบ
            redirect('Main/isMyAdmin');
        }
    }

    // ผู้ดูแล ROLE 1 
    // 
    public function isMyAdmin() {

        $data['leave_m'] = $this->Leave_m;
        $data['person_m'] = $this->Person_m;
        $data['user_m'] = $this->User_m;
        $data['content'] = $this->skin . "content_v";
        $this->load->view($this->skins, $data);
    }

    //ผู้ตรวจสอบ ROLE 2 
    public function isApproversRoleTwo() {
        $status = $this->input->get('status');
        $data = array();
        if ($this->input->get('msg') == 'yes') {
            $data['msg'] = 'swal("", "ยกเลิกรายการลาเรียบร้อยแล้ว", "success")';
        } else if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("", "ตรวจสอบรายการลาเรียบร้อยแล้ว", "success")';
        }
        $s_login = $this->session->userdata('s_login');
        //  $user_id = $s_login['login_id'];
        $depart_id = $s_login['login_depart_id'];

        $array = $this->Leave_m->ShowLeaveByDepart($depart_id, $status);
        $data['query'] = $array['query'];
        $data['leave_m'] = $this->Leave_m;
        $data['person_m'] = $this->Person_m;
        $data['user_m'] = $this->User_m;


        switch ($status) {

            case 'wait':
                $data['title'] = 'รายการลาที่ รอตรวจสอบ';
                break;
            case 'disapproval':
                $data['title'] = 'รายการลาที่ ไม่อนุมัติ';
                break;
            case 'approve':
                $data['title'] = 'รายการลาที่ อนุมัติ';
                break;

            case 'cancel':
                $data['title'] = 'รายการลาที่ ยกเลิก';
                break;
            case 'yes':
                $data['title'] = 'รายการลาที่ เห็นอนุญาติ';
                break;
            case 'no':
                $data['title'] = 'รายการลาที่ ไม่อนุญาติ';
                break;
            default :
                redirect('Main/isUser?status=wait');
                break;
        }


        $data['mydate'] = $this->mydate;
        $data['content'] = $this->skin . "leave/isApprovers_role2_v";
        $this->load->view($this->skins, $data);
    }

    //ผู้อนุมัติ ROLE 3
    public function isApproversRoleTree() {
        $status = $this->input->get('status');
        $data = array();
        if ($this->input->get('msg') == 'yes') {
            $data['msg'] = 'swal("", "อนุมัติการลาเรียบร้อยแล้ว", "success")';
        } else if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("", "ทำรายการเรียบร้อยแล้ว", "success")';
        }
        //  $s_login = $this->session->userdata('s_login');
        //  $user_id = $s_login['login_id'];
        //    $depart_id = $s_login['login_depart_id'];

        $array = $this->Leave_m->ShowLeaveByDepartAll($status);
        $data['query'] = $array['query'];
        $data['leave_m'] = $this->Leave_m;
        $data['person_m'] = $this->Person_m;
        $data['user_m'] = $this->User_m;

        switch ($status) {

            case 'wait':
                $data['title'] = 'รายการลาที่ รอตรวจสอบ';
                break;
            case 'disapproval':
                $data['title'] = 'รายการลาที่ ไม่อนุมัติ';
                break;
            case 'approve':
                $data['title'] = 'รายการลาที่ อนุมัติ';
                break;

            case 'cancel':
                $data['title'] = 'รายการลาที่ ยกเลิก';
                break;
            case 'yes':
                $data['title'] = 'รายการลาที่ เห็นอนุญาติ';
                break;
            case 'no':
                $data['title'] = 'รายการลาที่ ไม่อนุญาติ';
                break;
            default :
                redirect('Main/isUser?status=wait');
                break;
        }


        $data['mydate'] = $this->mydate;
        $data['content'] = $this->skin . "leave/isApprovers_role3_v";
        $this->load->view($this->skins, $data);
    }

    //config ประเภทการลา
    public function LeaveTypeIndex($success = '') {
        $data = array();
        if ($success == 'yes') {
            $data['msg'] = 'swal("", "บันทึกรายการเสร็จเรียบร้อย", "success")';
        }

        $this->db->order_by('name', 'desc');
        $data['query'] = $this->db->get('tbleave_type')->result_array();


        $data['content'] = $this->skin . "leavetype/leavetype_v";
        $this->load->view($this->skins, $data);
    }

    public function LeaveTypeAdd() {
        $data = array();
        $data['content'] = $this->skin . 'leavetype/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function LeaveTypeEdit() {
        $data = array();
        $id = $this->input->get('id');

        $this->db->where('id', $id);
        $data['row'] = $this->db->get('tbleave_type')->row_array();

        $data['content'] = $this->skin . 'leavetype/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function LeaveTypeSave() {
        $id = $this->security->xss_clean($this->input->post('id'));
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'url' => $this->security->xss_clean($this->input->post('url')),
            'totall' => $this->security->xss_clean($this->input->post('totall')),
        );
        if ($id == '') {
            $this->db->insert('tbleave_type', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbleave_type', $data);
        }
        redirect("Main/LeaveTypeIndex/yes");
    }

    //end leavetype 
    //config ปีงบประมาณ
    public function YearIndex($success = '') {
        $data = array();
        if ($success == 'yes') {
            $data['msg'] = 'swal("", "บันทึกรายการเสร็จเรียบร้อย", "success")';
        }

        $this->db->order_by('name', 'desc');
        $data['query'] = $this->db->get('tbyear')->result_array();


        $data['content'] = $this->skin . "year/year_v";
        $this->load->view($this->skins, $data);
    }

    public function YearAdd() {
        $data = array();

        $data['content'] = $this->skin . 'year/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function YearEdit() {
        $data = array();
        $id = $this->input->get('id');

        $this->db->where('id', $id);
        $data['row'] = $this->db->get('tbyear')->row_array();


        $data['content'] = $this->skin . 'year/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function YearSave() {
        $id = $this->security->xss_clean($this->input->post('id'));
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
        );
        if ($id == '') {
            $this->db->insert('tbyear', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbyear', $data);
        }
        redirect("Main/YearIndex/yes");
    }

    //end Year 
    //Depart หน่วยงาน สังกัดแผนก
    public function DepartIndex($success = '') {
        $data = array();
        if ($success == 'yes') {
            $data['msg'] = 'swal("", "บันทึกรายการเสร็จเรียบร้อย", "success")';
        } else if ($success == 'del') {
            $data['msg'] = 'swal("", "ลบรายการเรียบร้อยแล้ว", "success")';
        }
        $this->db->order_by('name', 'desc');
        $data['query'] = $this->db->get('tbdepart')->result_array();


        $data['content'] = $this->skin . "depart/depart_v";
        $this->load->view($this->skins, $data);
    }

    public function DepartAdd() {
        $data = array();

        $this->db->order_by('name', 'desc');
        $data['team'] = $this->db->get('tbteam')->result_array();

        $data['content'] = $this->skin . 'depart/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function DepartEdit() {
        $data = array();
        $id = $this->input->get('id');

        $this->db->where('id', $id);
        $data['row'] = $this->db->get('tbdepart')->row_array();

        $this->db->order_by('name');
        $data['team'] = $this->db->get('tbteam')->result_array();

        $data['content'] = $this->skin . 'depart/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function DepartSave() {
        $id = $this->security->xss_clean($this->input->post('id'));
        $data = array(
            'code' => $this->security->xss_clean($this->input->post('code')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'team_id' => $this->security->xss_clean($this->input->post('team_id')),
        );
        if ($id == '') {
            $this->db->insert('tbdepart', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbdepart', $data);
        }
        redirect("Main/DepartIndex/yes");
    }

    //ลบแผนก
    function DepartDel() {
        $this->db->where('id', $this->input->get('id'));
        $this->db->delete('tbdepart');
        redirect('Main/DepartIndex/del');
    }

    //end หน่วยงานสังกัดแผนก
    //team หน่วยงาน
    public function TeamIndex($success = '') {
        $data = array();
        if ($success == 'yes') {
            $data['msg'] = 'swal("", "บันทึกรายการเสร็จเรียบร้อย", "success")';
        } else if ($success == 'del') {
            $data['msg'] = 'swal("", "ลบรายการเรียบร้อยแล้ว", "success")';
        }

        $this->db->order_by('name', 'desc');
        $data['query'] = $this->db->get('tbteam')->result_array();


        $data['leave_m'] = $this->Leave_m;
        $data['user_m'] = $this->User_m;
        $data['content'] = $this->skin . "team/team_v";
        $this->load->view($this->skins, $data);
    }

    public function TeamAdd() {
        $data = array();

        $data['content'] = $this->skin . 'team/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function TeamEdit() {
        $data = array();
        $id = $this->input->get('id');

        $this->db->where('id', $id);
        $data['row'] = $this->db->get('tbteam')->row_array();


        $data['content'] = $this->skin . 'team/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function TeamSave() {
        $id = $this->security->xss_clean($this->input->post('id'));
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
        );
        if ($id == '') {
            $this->db->insert('tbteam', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbteam', $data);
        }
        redirect("Main/TeamIndex/yes");
    }

    //ลบหน่วยงาน
    function TeamDel() {
        $this->db->where('id', $this->input->get('id'));
        $this->db->delete('tbteam');
        redirect('Main/TeamIndex/del');
    }

    //end หน่วยงานสังกัดแผนก
    //#
    //
    //
    //ข้อมูลพนักงาน  status ผู้ดูแลระบบ
    public function PersonIndex($offset = 0) {
        $role = $this->input->get('role');

        $data = array();
        if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("", "บันทึกรายการเสร็จเรียบร้อย", "success")';
        } else if ($this->input->get('success') == 'del') {
            $data['msg'] = 'swal("", "ลบรายการเรียบร้อยแล้ว", "success")';
        }

        $txtsearch = $this->input->post('txtsearch');

        $array = $this->Person_m->get_all($txtsearch, $role, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];

        $data['display_role'] = $this->Person_m->display_role($role);
        $data['person_m'] = $this->Person_m;
        $data['role'] = $role;


        $data['content'] = $this->skin . "person/person_v";
        $this->load->view($this->skins, $data);
    }

    public function PersonAdd() {
        $role = $this->input->get('role');

        $data = array();

        $this->db->select('tbteam.id AS team_id,tbteam.name AS team_name,tbdepart.id AS depart_id,tbdepart.name AS depart_name');
        $this->db->from('tbteam');
        $this->db->join('tbdepart', 'tbdepart.team_id = tbteam.id');
        $depart = $this->db->get();

        $data['depart'] = $depart->result_array();

        $data['display_role'] = $this->Person_m->display_role($role);
        $data['role'] = $role;
        $data['content'] = $this->skin . 'person/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function PersonEdit() {
        $data = array();
        $id = $this->input->get('id');
        $role = $this->input->get('role');
        $data['role'] = $role;

        $data['display_role'] = $this->Person_m->display_role($role);
        $this->db->where('id', $id);
        $data['row'] = $this->db->get('tbperson')->row_array();



        $this->db->select('tbteam.id AS team_id,tbteam.name AS team_name,tbdepart.id AS depart_id,tbdepart.name AS depart_name');
        $this->db->from('tbteam');
        $this->db->join('tbdepart', 'tbdepart.team_id = tbteam.id');
        $depart = $this->db->get();

        $data['depart'] = $depart->result_array();


        $data['content'] = $this->skin . 'person/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function PersonSave() {
        $id = $this->input->post('id');
        $role = $this->input->post('role_id');


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
            'created' => date('Y-m-d H:i:m'),
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
        redirect("Main/PersonIndex?role=$role&success=yes");
    }

    //ลบ person
    function PersonDel() {
        $this->db->where('id', $this->input->get('id'));
        $this->db->delete('tbperson');
        redirect('Main/PersonIndex?role=' . $this->input->get('role') . '&success=del');
    }

    //end person
    //ข้อมูลผู้ลา role = 4
    public function UserIndex($offset = 0) {
        $role = $this->input->get('role');
        $dep = $this->input->get('dep');

        $data = array();
        if ($this->input->get('success') == 'yes') {
            $data['msg'] = 'swal("", "บันทึกรายการเสร็จเรียบร้อย", "success")';
        } else if ($this->input->get('success') == 'del') {
            $data['msg'] = 'swal("", "ลบรายการเรียบร้อยแล้ว", "success")';
        }

        $txtsearch = $this->input->post('txtsearch');

        $array = $this->User_m->get_all($txtsearch, $role, $dep, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];

        $data['display_role'] = $this->User_m->display_role($role);
        $data['user_m'] = $this->User_m;
        $data['role'] = $role;
        $data['dep'] = $dep;

        $data['content'] = $this->skin . "user/user_v";
        $this->load->view($this->skins, $data);
    }

    public function UserAdd() {
        $role = $this->input->get('role');
        $dep = $this->input->get('dep');
        $data = array();

        $this->db->select('tbteam.id AS team_id,tbteam.name AS team_name,tbdepart.id AS depart_id,tbdepart.name AS depart_name');
        $this->db->from('tbteam');
        $this->db->join('tbdepart', 'tbdepart.team_id = tbteam.id');
        $depart = $this->db->get();

        $data['depart'] = $depart->result_array();

        $data['display_role'] = $this->User_m->display_role($role);
        $data['role'] = $role;
        $data['dep'] = $dep;
        $data['content'] = $this->skin . 'user/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function UserEdit() {
        $data = array();
        $id = $this->input->get('id');
        $role = $this->input->get('role');
        $dep = $this->input->get('dep');
        $data['role'] = $role;
        $data['dep'] = $dep;

        $data['display_role'] = $this->User_m->display_role($role);
        $this->db->where('id', $id);
        $data['row'] = $this->db->get('tbuser')->row_array();



        $this->db->select('tbteam.id AS team_id,tbteam.name AS team_name,tbdepart.id AS depart_id,tbdepart.name AS depart_name');
        $this->db->from('tbteam');
        $this->db->join('tbdepart', 'tbdepart.team_id = tbteam.id');
        $depart = $this->db->get();

        $data['depart'] = $depart->result_array();


        $data['content'] = $this->skin . 'user/frm_v';
        $this->load->view($this->skins, $data);
    }

    public function UserSave() {
        $s_login = $this->session->userdata('s_login');
        $person_id = $s_login['login_id'];
        $id = $this->input->post('id');
        $role = $this->input->post('role_id');
        $dep = $this->input->post('dep');

        $password = $this->input->post('password');

        $data = array(
            'person_id' => $person_id,
            'name' => $this->security->xss_clean($this->input->post('name')),
            'card_id' => $this->security->xss_clean($this->input->post('card_id')),
            'position' => $this->security->xss_clean($this->input->post('position')),
            'username' => $this->security->xss_clean($this->input->post('username')),
            'mobile' => $this->security->xss_clean($this->input->post('mobile')),
            'tel' => $this->security->xss_clean($this->input->post('tel')),
            'depart_id' => $this->security->xss_clean($dep),
            'role_id' => $this->security->xss_clean($role),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'birthday' => $this->security->xss_clean($this->input->post('birthday')),
            'created' => date('Y-m-d H:i:m'),
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
        redirect("Main/UserIndex?role=$role&dep=$dep&success=yes");
    }

    //ลบ User
    function UserDel() {
        $this->db->where('id', $this->input->get('id'));
        $this->db->delete('tbuser');
        redirect('Main/UserIndex?role=' . $this->input->get('role') . '&dep=' . $this->input->get('dep') . '&success=del');
    }

    //end User
    //ดูรายชื่อผู้ทำการลาแยกตามแผนกทั้งหมด
    public function UserByDepart() {
        $data = array();
        $array = $this->User_m->UserbyDepartAll();
        $data['query'] = $array['query'];



        $data['content'] = $this->skin . "user/userbydepart_v";
        $this->load->view($this->skins, $data);
    }

    public function ListUserBydepart($depart_id) {
        //$depart_id = $this->input->get('depart_id');
        $data = array();
        $this->db->where('depart_id', $depart_id);
        $this->db->order_by('id', 'desc');
        $data['rs'] = $this->db->get('tbuser')->result_array();

        $this->db->where('depart_id', $depart_id);
        $total = $this->db->get('tbuser')->num_rows();



        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, '/Main/ListUserBydepart', 100);

        $data['depart_id'] = $depart_id;
        $data['user_m'] = $this->User_m;
        $data['content'] = $this->skin . "user/listUserBydepart_v";
        $this->load->view($this->skins, $data);
    }

}
