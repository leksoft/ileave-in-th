<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($txtsearch, $role, $dep, $offset, $per_page = 20, $url = '/Main/UserIndex') {

        $sql = "SELECT  * FROM tbuser WHERE role_id = $role AND depart_id = $dep";

        if ($txtsearch != '') {
            $sql .= " Where (name like '%$txtsearch%') or (username like '%$txtsearch%')";
            $sql .= " or (email like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql .= "  Order by name limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }

    function UserById($user_id) {

        $query = $this->db->get_where('tbuser', array('id' => $user_id))->row_array();
        $data['query'] = $query;
        return $data;
    }

    function display_status($status) {
        $ret = '';
        switch ($status) {
            case '1':
                $ret = 'ปกติ';
                break;
            case '2':
                $ret = 'ระงับ';
                break;
        }
        return $ret;
    }

//สิทธิ์การใช้งาน
    function display_role($role) {
        $this->db->where('role_id', $role);
        $data = $this->db->get('tbrole')->row_array();
        return $data['role_name'];
    }

    //แสดงชื่อผู้ลา
    function display_Username($user_id) {
        $this->db->where('id', $user_id);
        $data = $this->db->get('tbuser')->row_array();
        return $data['name'];
    }

    function display_depart($depart_id) {
        $sql = "SELECT tbdepart.id,tbdepart.name AS depart_name,tbuser.depart_id ,tbteam.id , tbteam.name AS team_name  FROM tbdepart,tbuser,tbteam ";
        $sql .= "WHERE tbuser.depart_id = tbdepart.id ";
        $sql .= "AND tbdepart.team_id = tbteam.id ";
        $sql .= "AND tbuser.depart_id = {$depart_id}";

        $data = $this->db->query($sql)->row_array();
        return $data['depart_name'] . " (" . $data['team_name'] . ")";
    }

    public function UserbyDepartAll() {
        $sql = "SELECT tbdepart.id AS depart_id,tbdepart.name AS depart_name,tbteam.id , tbteam.name AS team_name  FROM tbdepart,tbteam ";
        $sql .= "WHERE tbdepart.team_id = tbteam.id ";

        $query = $this->db->query($sql)->result_array();

        $data['query'] = $query;

        return $data;
        //  return $data['depart_name'] . " (" . $data['team_name'] . ")";
    }

}
