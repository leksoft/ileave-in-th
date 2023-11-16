<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Class สร้าง Paginatioin ที่สืบทอดมาจาก CI_Pagination
*/

class MY_Pagination extends CI_Pagination {

    function MY_Pagination() {
        parent::__construct();
    }

    /*
     * สร้าง Pagin
    */

    function pagin($total_rows, $url, $per_page=10, $num_links=2,$uri_segment=3) {
        $config['uri_segment'] = $uri_segment;
        $config['base_url'] = site_url() . $url;  //อ้างถึง controler ที่แสดงค่าให้หน้า view ที่มีการแสดงแบบ list ข้อมูล
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['first_link'] = 'หน้าแรก';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'หน้าสุดท้าย';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['full_tag_open'] = '<div class="pagination"><ul class="pagination pull-left">';
        $config['full_tag_close'] = '</ul></div>';

        $config['cur_tag_open'] = '<li class="active "><a>';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = $num_links;

        $this->initialize($config);
        return $this->create_links();
    }
    function pagin2($total_rows, $url, $per_page=10, $num_links=2,$uri_segment=3) {
        $config['uri_segment'] = $uri_segment;
        $config['base_url'] = site_url() . $url;  //อ้างถึง controler ที่แสดงค่าให้หน้า view ที่มีการแสดงแบบ list ข้อมูล
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['next_link'] = 'หน้าถัดไป';
        $config['prev_link'] = 'หน้าก่อน';
        $config['first_link'] = '[หน้าแรก]';
        $config['last_link'] = '[หน้าสุดท้าย]';
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['num_links'] = $num_links;

        $this->initialize($config);
        return $this->create_links();
    }

}
