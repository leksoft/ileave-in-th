<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_m extends CI_Model {

    var $tbname = 'tbleavemanage';

    function __construct() {
        parent::__construct();
    }

    //get รายการที่รออนุมัติ และแสดงหน้าละ 20 รายการ
    function get_all($field_name, $text_search, $login_id, $offset, $per_page = 20, $url = '/leavemanage/index') {

        $sql = "SELECT tbleavemanage.id AS Leave_id, tbleavemanage.datefrom,tbleavemanage.dateto, tbleavemanage.amountdate,tbleavemanage.comment,tbleavemanage.status,tbleavemanage.dateregist,";
        $sql .= "tbperson.id, tbperson.code,tbperson.pwork, tbperson.title, tbperson.firstname,";
        $sql .= " tbperson.surname,tbperson.salary,tbcategory.name AS category_name";
        $sql .= " FROM tbleavemanage Inner Join tbperson ON tbleavemanage.person_id = tbperson.id";
        $sql .= " Inner Join tbcategory ON tbleavemanage.category_id = tbcategory.id";
        $sql .= " WHERE tbleavemanage.person_id = '$login_id'  and tbleavemanage.status= 'รออนุมัติ'";
        if ($field_name != '' && $text_search != '') {
            $sql .= " Where $field_name like '%$text_search%'";
        }
        $total = $this->db->query($sql)->num_rows();

        $sql .= "  Order by Leave_id desc limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['page_links'] = $this->pagination->pagin($total, $url, $per_page);

        $data['query'] = $query;
        return $data;
    }

    function display_LeaveStatus($status) {
        $ret = '';
        switch ($status) {

            case 'wait':
                $ret = '<label class="label label-warning">รอตรวจสอบ</label>';
                break;
            case 'disapproval':
                $ret = '<label class="label label-default">ไม่อนุมัติ</label>';
                break;
            case 'approve':
                $ret = '<label class="label label-success">เห็นควรอนุญาติ</label>';
                break;

            case 'cancel':
                $ret = '<label class="label label-danger">ยกเลิก</label>';
                break;
            case 'yes':
                $ret = '<label class="label label-primary">อนุมัติแล้ว</label>';
                break;
            case 'no':
                $ret = '<label class="label label-danger">ไม่อนุญาติ</label>';
                break;
        }
        return $ret;
    }

    //รายการลาแต่ละประเภท
    public function ShowLeave($status, $user_id) {

        $this->db->where('status', $status);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbleavemanage')->result_array();
        $data['query'] = $query;
        return $data;
    }

    //แสดงรายชื่อผู้ลาตามแผนก
    public function ShowLeaveByDepart($depart_id, $status) {

        $sql = "SELECT * FROM tbleavemanage WHERE depart_id = {$depart_id} AND status = '$status'";
        $query = $this->db->query($sql)->result_array();

        $data['query'] = $query;
        return $data;
    }

    public function ShowLeaveByDepartAll($status) {

        $sql = "SELECT * FROM tbleavemanage WHERE status = '$status'";
        $query = $this->db->query($sql)->result_array();

        $data['query'] = $query;
        return $data;
    }

    ////นับรายการลาที่รอตรวจสอบของแต่ละแผนก
    public function TotalByDepart($status) {
        $s_login = $this->session->userdata('s_login');
        $depart_id = $s_login['login_depart_id'];
        //รายการลารอตรวจสอบ
        $this->db->where('status', $status);
        $this->db->where('depart_id', $depart_id);
        return $this->db->get('tbleavemanage')->num_rows();
    }

    ////นับรายการลาที่รอตรวจสอบของแต่ละแผนก แสดงทั้งหมด
    public function TotalByDepartAll($status) {
        //$s_login = $this->session->userdata('s_login');
        // $depart_id = $s_login['login_depart_id'];
        //รายการลารอตรวจสอบ
        $this->db->where('status', $status);
        //  $this->db->where('depart_id', $depart_id);
        return $this->db->get('tbleavemanage')->num_rows();
    }

    //นับรายการลาที่รอตรวจสอบของแต่ละคน
    public function TotalWait($status) {
        $s_login = $this->session->userdata('s_login');
        $user_id = $s_login['login_id'];
        //รายการลารอตรวจสอบ
        $this->db->where('status', $status);
        $this->db->where('user_id', $user_id);
        return $this->db->get('tbleavemanage')->num_rows();
    }

    //นับสถิติการลาประจำเดือน
    public function TotalStatLeave($id) {
        $s_login = $this->session->userdata('s_login');
        $user_id = $s_login['login_id'];
        //รายการลารอตรวจสอบ
        $date = date("Y-m");
        $this->db->where('leave_type_id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'yes');
        $this->db->like('dateregist', $date);
        return $this->db->get('tbleavemanage')->num_rows();
    }
      public function TotalStatLeaveById($id) {
        $s_login = $this->session->userdata('s_login');
        $user_id = $s_login['login_id'];
        //รายการลารอตรวจสอบ
        $date = date("Y-m");
        $this->db->where('leave_type_id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'yes');
        $this->db->like('dateregist', $date);
        return $this->db->get('tbleavemanage')->num_rows();
    }

}
