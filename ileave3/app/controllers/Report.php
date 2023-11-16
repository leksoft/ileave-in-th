<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    var $skin = 'backoffice/';
    var $skins = 'backoffice/report/report_template_v';

    public function Index() {
        
    }

    public function Year() {
        $data['content'] = $this->skin . 'report/report_year_v';
        $this->load->view($this->skins, $data);
    }

    function ajax_get_chart() {
        $s_login = $this->session->userdata('s_login');
        $user_id = $s_login['login_id'];

        $y = $this->input->post('year');
        $m = $this->input->post('mounth');
        $data['y'] = $y;
        $data['m'] = $m;

        $title_text = "สถิติการลา";
        $data['title_text'] = $title_text;

        $this->db->order_by('name');
        $team = $this->db->get('tbleave_type')->result_array();

        $categories_data = array();
        $series = array();

        $i = 0;
        foreach ($team as $r) {
            $i++;
            array_push($categories_data, $r['name']);


            $count = $this->count_use_by($r['id'], $user_id, $y, $m);


            array_push($series, $count);
        }


        $data['categories_data'] = json_encode($categories_data);

        $series_data[] = array('name' => 'จำนวนการลา', 'data' => $series);
        $data['series_data'] = json_encode($series_data);

        // วนลูปประเภทการลา
        $this->db->order_by('id', 'asc');
        $data['rows'] = $this->db->get('tbleave_type')->result_array();


        $data['content'] = $this->skin . 'report/report_year_v';
        $this->load->view($this->skins, $data);
    }

    //นับจำนวนตามประเภทการลา
    function count_use_by($leave_type, $user_id, $y, $m) {

        $i1 = 0;
        $sql = "SELECT tbleavemanage.leave_type_id ,tbleavemanage.user_id ,tbleavemanage.status FROM tbleavemanage";
        $sql .= " WHERE tbleavemanage.leave_type_id ='$leave_type'";
        $sql .= " AND tbleavemanage.user_id ='$user_id' AND tbleavemanage.status = 'yes' AND tbleavemanage.dateregist like '%$y-$m%'";
        $i1 = $this->db->query($sql)->num_rows();

        $count = $i1;
        return $count;
    }

    function preview() {
        $s_login = $this->session->userdata('s_login');
        $member_id = $s_login['login_id'];

        $start_date = $this->input->post('datefrom');
        $end_date = $this->input->post('dateto');
        $rptstyle = $this->input->post('rptstyle');


        $caption = "รายงานการลา สรุปรายการตามประเภทของการลา";
        $condition = '';

        $leave_type_id = $this->input->post('leave_type_id');
        if ($leave_type_id != '')
            $this->db->where('leave_type_id', $leave_type_id);
        $this->db->where('member_id', $member_id);
        $this->db->order_by('id,dateregist');

        $query = $this->db->get('tbleavemanage')->result_array();

        if ($leave_type_id != '') {
            $leave_type = $this->report_m->get_one($leave_type_id);
            $condition .= "<b>ชื่อประเภทการลา </b>" . $leave_type['name'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        if ($condition == '')
            $condition = "<b>แสดงทุกรายการ</b>";


        $i = 0;
        $i_total = 0;
        $tbl = "<p class='caption'>$caption</p>";
        $tbl .= "<div style='padding-bottom:10px'>$condition</div>";
        $tbl .= <<<EOD
  <table width="100%" border="0" cellspacing="4" cellpadding="4">
  <thead>
  <tr>
    <th width="30px">ลำดับ</th>
    <th width="200px">เรื่อง</th>
    <th width="110px">วันที่ลา</th>
    <th width="50px">จำนวนวันลา</th>
    <th width="50px">วันที่ทำรายการ</th>
                 <th width="40px">สถานะ</th>
  </tr>
  </thead>
  <tbody>
EOD;
        $row_ins = '';
        foreach ($query as $r) {
            $instrument = $this->report_m->get_one($r['leave_type_id']);
            if ($row_ins != $r['leave_type_id']) {
                if ($row_ins != '' && $r['leave_type_id'] != '') {
                    $tbl .= "<tr><td colspan='4' align='right'><b>รวม :</b></td><td align='center'><b>$i</b></td></tr>";
                }
                $tbl .= "<tr><td colspan='5'><b>ชื่อประเภทการลา : </b>" . $instrument['name'] . "</td></tr>";
                $row_ins = $r['leave_type_id'];
                $i = 0;
            }

            $i++;
            $i_total++;
            $instu = $this->report_m->get_one($r['leave_type_id']);

            $tbl .= <<<EOD
            <tr>
                <td align="center">{$i}</td>
                <td width="40"align="center"><u>{$instrument['name']}</u></td>
                   <td width="200">{$this->mydate->dateThaiLong($r['datefrom'])}-{$this->mydate->dateThaiLong($r['dateto'])}</td>

                <td>{$r['amountdate']}</td>
                 <td>{$this->mydate->dateThaiLong($r['dateregist'])}</td>
             <td align="center">
                {$r['status']}

               </td>
            </tr>
EOD;
        }

        if ($i == 0) {
            $tbl .= "<tr><td colspan=\"6\"><p align='center'><b>**** ไม่พบข้อมูล ****</b></p></td></tr>";
        } else {
            $tbl .= "<tr><td colspan='5' align='right'><b>รวม :</b></td><td align='center'><b>$i</b></td></tr>";
            $tbl .= "<tr><td colspan='5' align='right'><b>รวมทั้งหมด :</b></td><td align='center'><b>$i_total</b></td></tr>";
        }
        $tbl .= "<tbody></table><br/> Status : approve =  อนุมัติการลา , disapproval = ไม่อนุมัติ , cancel = ยกเลิก , wait = รออนุมัติ<br/>  ***สิ้นสุดรายงาน***";

        $data['tbl'] = $tbl;
        $data['rpt_name'] = $caption;
        $this->load->view('office/report/A4_template_v', $data);
    }

    public function Test() {
        $this->load->view('backoffice/report/index_v');
    }

}
