<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Person_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($txtsearch, $role, $offset, $per_page = 20, $url = '/Main/PersonIndex') {

        $sql = "SELECT  * FROM tbperson WHERE role_id = $role";

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

    function PersonById($user_id) {

        $query = $this->db->get_where('tbperson', array('id' => $user_id))->row_array();
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

    function display_role($role) {
        $this->db->where('role_id', $role);
        $data = $this->db->get('tbrole')->row_array();
        return $data['role_name'];
    }

    function display_PersonName($person_id) {
        $this->db->where('id', $person_id);
        $data = $this->db->get('tbperson')->row_array();
        return $data['name'];
    }

    function display_depart($depart_id) {
        $sql = "SELECT tbdepart.id,tbdepart.name AS depart_name,tbperson.depart_id ,tbteam.id , tbteam.name AS team_name  FROM tbdepart,tbperson,tbteam ";
        $sql .= "WHERE tbperson.depart_id = tbdepart.id ";
        $sql .= "AND tbdepart.team_id = tbteam.id ";
        $sql .= "AND tbperson.depart_id = {$depart_id}";

        $data = $this->db->query($sql)->row_array();
        return $data['depart_name'] . " (" . $data['team_name'] . ")";
    }

}
