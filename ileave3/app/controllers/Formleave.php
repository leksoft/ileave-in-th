<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//สำหรับเรียกหน้าฟอร์มการลาประเภทต่างๆ
class Formleave extends MY_Controller {

    var $skin = 'backoffice/';
    var $skins = 'backoffice/template_v';

    public function __construct() {
        parent::__construct();
        $this->load->library('Mydate');
        $this->load->model('Person_m');
        $this->load->model('User_m');
        $this->load->model('Leave_m');
        //$this->load->model('script_m');
        $this->load->model('Report_m');
    }

    public function Index($url = '') {
        //ตรวจสอบการ login
        $s_login = $this->session->userdata("s_login");
        $member_id = $s_login['login_id'];

        $this->db->where('id', $member_id);
        $row_member = $this->db->get('tbuser')->row_array();
        $data['row_member'] = $row_member;

        $data['person_m'] = $this->Person_m;

        // เรียกใช้ url
        $this->db->where('url', $url);
        $row_leave_type = $this->db->get('tbleave_type')->row_array();
        $data['row_leave_type'] = $row_leave_type;

        //เมื่อเพิ่มประเภทการลาแล้วต้องมาเพิ่มเข้าตรงนี้ด้วย ถ้าไม่เพิ่มอาจจะทำให้เกิด Error ได้
        switch ($row_leave_type['url']) {
            //1 แบบฟอร์มการลาป่วย
            case 'sick':
                $data['page_title'] = "แบบฟอร์มการลาป่วย";
                $data['content'] = $this->skin . "leave/leave_frm_v";
                $this->load->view($this->skins, $data);
                break;
            //2 แบบฟอร์มการลากิจส่วนตัว
            case 'carer':
                $data['page_title'] = "แบบฟอร์มการลากิจส่วนตัว";
                $data['content'] = $this->skin . "leave/leave_frm_v";
                $this->load->view($this->skins, $data);
                break;
            //3 แบบฟอร์มการลาคลอดบุตร
            case 'Maternity':
                $data['page_title'] = "แบบฟอร์มการลาคลอดบุตร";
                $data['content'] = $this->skin . "leave/leave_frm_v";
                $this->load->view($this->skins, $data);
                break;
            //4 แบบฟอร์มการลาพักผ่อน
            case 'rest':
                $data['page_title'] = "แบบฟอร์มการลาพักผ่อน";
                $data['content'] = $this->skin . "leave/rest_frm_v";
                $this->load->view($this->skins, $data);

                break;
            //5 แบบฟอร์มการลาเพื่อช่วยเหลือภริยาคลอดบุตร
            case 'help-his-wife':
                $data['page_title'] = "แบบฟอร์มการลาเพื่อช่วยเหลือภริยาคลอดบุตร";
                $data['content'] = $this->skin . "leave/help-his-wife_frm_v";
                $this->load->view($this->skins, $data);

                break;
            //6 ขอการลาอุปสมบทหรือการลาไปประกอบพิธีฮัจย์
            case 'ordain':
                $data['page_title'] = "ขอการลาอุปสมบท";
                $data['content'] = $this->skin . "leave/ordain_frm_v";
                $this->load->view($this->skins, $data);

                break;
            //7 ขอการลาเข้ารับการตรวจเลือกหรือเข้ารับการเตรียมพล
            case 'Select':
                $data['page_title'] = "ขอการลาเข้ารับการตรวจเลือกหรือเข้ารับการเตรียมพล";
                $data['msg_type'] = "warning";
                $data['msg_text'] = "ไม่พบประเภทการลาที่คุณเรียกอาจเกิดจากไม่มีแบบฟอร์มนี้ กรุณาติดต่อเจ้าของโปรแกรมหรือผู้ดูแลระบบ";
                $data['content'] = $this->skin . "leave/404_v";
                $this->load->view($this->skins, $data);
                break;
            //8 ขอการลาไปศึกษา ฝึกอบรม ปฏิบัติการวิจัย หรือดูงาน
            case 'education-training-research-work':
                $data['page_title'] = "ขอการลาไปศึกษา ฝึกอบรม ปฏิบัติการวิจัย หรือดูงาน ";
                $data['msg_type'] = "warning";
                $data['msg_text'] = "ไม่พบประเภทการลาที่คุณเรียกอาจเกิดจากไม่มีแบบฟอร์มนี้ กรุณาติดต่อเจ้าของโปรแกรมหรือผู้ดูแลระบบ";
                $data['content'] = $this->skin . "leave/404_v";
                $this->load->view($this->skins, $data);
                break;
            //9 ขอการลาไปปฏิบัติงานในองค์การระหว่างประเทศ
            case 'work-in-international-organizations':
                $data['page_title'] = "ขอการลาไปปฏิบัติงานในองค์การระหว่างประเทศ ";
                $data['msg_type'] = "warning";
                $data['msg_text'] = "ไม่พบประเภทการลาที่คุณเรียกอาจเกิดจากไม่มีแบบฟอร์มนี้ กรุณาติดต่อเจ้าของโปรแกรมหรือผู้ดูแลระบบ";
                $data['content'] = $this->skin . "leave/404_v";
                $this->load->view($this->skins, $data);
                break;
            //10
            case 'Leave-a-spouse':
                $data['page_title'] = "ขอการลาติดตามคู่สมรส";
                $data['msg_type'] = "warning";
                $data['msg_text'] = "ไม่พบประเภทการลาที่คุณเรียกอาจเกิดจากไม่มีแบบฟอร์มนี้ กรุณาติดต่อเจ้าของโปรแกรมหรือผู้ดูแลระบบ";
                $data['content'] = $this->skin . "leave/404_v";
                $this->load->view($this->skins, $data);
                break;
            //11
            case 'to-the-Vocational-Rehabilitation':
                $data['page_title'] = "ขอการลาไปฟื้นฟูสมรรถภาพด้านอาชีพ";
                $data['msg_type'] = "warning";
                $data['msg_text'] = "ไม่พบประเภทการลาที่คุณเรียกอาจเกิดจากไม่มีแบบฟอร์มนี้ กรุณาติดต่อเจ้าของโปรแกรมหรือผู้ดูแลระบบ";
                $data['content'] = $this->skin . "leave/404_v";
                $this->load->view($this->skins, $data);
                break;
            default:
                $data['page_title'] = "Error !!";
                $data['msg_type'] = "warning";
                $data['msg_text'] = "ไม่พบประเภทการลาที่คุณเรียกอาจเกิดจากไม่มีแบบฟอร์มนี้ กรุณาติดต่อเจ้าของโปรแกรมหรือผู้ดูแลระบบ";
                $data['content'] = $this->skin . "leave/404_v";
                $this->load->view($this->skins, $data);
        }
    }

    //บันทึกการทำรายการลาใหม่
    function save() {

        //ตรวจสอบการ login
        $s_login = $this->session->userdata("s_login");
        $user_id = $s_login['login_id'];
        $depart_id = $s_login['login_depart_id'];

        $data_ = array(
            'writing' => $this->input->post('writing'), //เขียนที่
            'title' => $this->input->post('title'), // เรื่อง
            'president' => $this->input->post('president'), //เรียน 
            'depart_id' => $depart_id,
            'user_id' => $user_id, // รหัสผู้ลา 
            'leave_type_id' => $this->input->post('leave_type_id'), // รหัสประเภทการลา
            'timerang' => $this->input->post('timerang'),
//            'datefrom' => $this->mydate->dateToMysql($this->input->post('datefrom')), // ตั้งแต่วันที่
//            'dateto' => $this->mydate->dateToMysql($this->input->post('dateto')), // ถึงวันที่
            'datefrom' => $this->input->post('datefrom'), // ตั้งแต่วันที่
            'dateto' => $this->input->post('dateto'), // ถึงวันที่
            'amountdate' => $this->mydate->DateDiff($this->input->post('datefrom'), $this->input->post('dateto')), //จำนวนวันลา
            'comment' => $this->input->post('comment'), //  เหตุผลการลา
            'address' => $this->input->post('address'), // ที่อยู่ระหว่างการลา
            'status' => 'wait', // สถานะ เมื่อทำรายการใหม่ให้เพิ่มสถานะ ว่า รออนุมัติ
            'newbihelp' => $this->input->post('newbihelp'), //ชื่อภริยากรณีลาเพื่อไปช่วยเหลือภริยาคลอดบุตร
            'date_newbihelp' => $this->input->post('date_newbihelp'), //วันที่คลอดบุตร
            'dateregist' => date("Y-m-d H:i:s"), // วันที่ทำการลา
            //การอุปสมบท
            'ordain_status' => $this->input->post('ordain_status'), //สถานะการอุปสมบท
            'measure_address' => $this->input->post('measure_address'), //อุปสมปทอยู่ ณ วัด / ตั้งอยู่ ณ
            'temple_address' => $this->input->post('temple_address'), //จะจำพรรษาอยู่ ณ วัด
            'dateofordination' => $this->input->post('dateofordination'), //กำหนดอุปสมบทวันที่
            'ip' => $this->input->ip_address() // ip 
        );

        $mail_user = EMAILSEND;

        $this->db->insert('tbleavemanage', $data_);

        $this->load->library('email');

        $this->email->from('admin@esandev.com', 'iLeave 3 By esandev.co.th');
        $this->email->to($mail_user); //ส่งถึงใคร
        $this->email->cc('leksoft@hotmail.com'); //cc ใคร
        //$this->email->bcc('them@their-example.com'); //bcc ใคร

        $this->email->subject('แจ้งการทำรายการลา'); //หัวข้อของอีเมล
        $this->email->message('ขอลา'); //เนื้อหาของอีเมล

        $this->email->send();

        redirect("Main/isUser?status=wait&success=yes");
    }

    //ลบการลา
    function CancelLeave() {
        $this->db->where('id', $this->input->get('id'));
        $this->db->update('tbleavemanage', array(
            'status' => 'cancel'
        ));

        redirect('Main/isUser?status=wait&msg=yes');
    }

    function get_statusname($status) {
        $st_name = 'รอการอนุมัติ';
        switch ($status) {
            case 'approve':
                $st_name = 'อนุมัติ';
                break;
            case 'disapproval':
                $st_name = 'ไม่อนุมัติ';
                break;
            case 'cancel':
                $st_name = 'ยกเลิกการลา';
                break;
        }

        return $st_name;
    }

    //พิมพ์ใบลา ป่วย / กิจส่วนตัว / คลอดบุตร
    function Printf() {

        $id = $this->input->get('id');

        $tbl = '<div class="caption"><b>แบบใบลาป่วย/ลากิจส่วนตัว/ลาคลอดบุตร</b></div>';
        $leave = $this->db->get_where('tbleavemanage', array('id' => $id))->result_array();
        foreach ($leave as $row):
            if ($row['writing'] != '') {
                $tbl .= '<div class="caption_rpt"><b>เขียนที่ </b>' . $row['writing'] . '</div>';
            } else {
                $tbl .= '<div class="caption_rpt"><b>เขียนที่ </b>........................................................</div>';
            }
            $tbl .= '<div class="caption_center"><b></b><span style ="border-bottom: dashed 1px #333;">' . $this->mydate->dateDay($row['dateregist']) . '</span></div>';


            $tbl .= br(2);
            $tbl .= "<b>เรื่อง </b>";
            $leave_type = $this->db->get_where('tbleave_type', array('id' => $row['leave_type_id']))->result_array();
            foreach ($leave_type as $row_leave_type):
                $tbl .= "<b>ขอ" . $row_leave_type['name'] . "</b>";
            endforeach;
            $tbl .= br(2);

            $tbl .= "<b>เรียน  </b>";
            if ($row['president'] != '') {
                $tbl .= "<b>" . $row['president'] . "</b>";
            } else {
                $tbl .= "<b>...........................................................</b>";
            }
            $tbl .= br(2);

            $tbl .= nbs(12) . "<b>ข้าพเจ้า  </b>";
            $member = $this->db->get_where('tbuser', array('id' => $row['user_id']))->result_array();
            foreach ($member as $rs_member):
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['name'] . "</span>";

                $tbl .= nbs(5) . "<b>ตำแหน่ง  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['position'] . "</span>";

                $tbl .= nbs(5) . "<b>สังกัดหน่วยงาน  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $this->User_m->display_depart($rs_member['depart_id']) . "</span>";


                $tbl .= nbs(2) . "<b>ขอลา</b>";
                $leave_type = $this->db->get_where('tbleave_type', array('id' => $row['leave_type_id']))->result_array();
                foreach ($leave_type as $row_leave_type):
                    $tbl .= nbs(6) . "<span style ='border-bottom: dashed 1px #333;'>" . $row_leave_type['name'] . "</span>";
                endforeach;
                $tbl .= nbs(3) . "<b>เนื่องจาก</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['comment'] . "</span>";
                $tbl .= br(2);

                $tbl .= "<b>ตั้งแต่วันที่</b>";
                $tbl .= nbs(6) . "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLongFull($row['datefrom']) . "</span>";
                $tbl .= nbs(3) . "<b>ถึงวันที่</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLongFull($row['dateto']) . "</span>";
                $tbl .= nbs(3) . "<b>มีกำหนด</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['amountdate'] . "</span> วัน";
                $tbl .= br(2);

                $tbl .= "<b>ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่</b>";
                if ($row['address'] != '') {
                    $tbl .= nbs(6) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['address'] . "</span>";
                } else {
                    $tbl .= nbs(6) . "....................................................................................";
                }
                $tbl .= br(2);

                $tbl .= "<b>หมายเลขโทรศัพท์</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['mobile'] . "</span>";
                $tbl .= br(3);

                $tbl .= nbs(68) . "ขอแสดงความนับถือ";
                $tbl .= br(2) . "" . nbs(50) . "(ลงชื่อ).....................................................................";
                $tbl .= br(1) . "" . nbs(68) . "<span style ='border-bottom: dashed 1px #333;'>( " . $rs_member['name'] . " )</span>";
            endforeach;
            $tbl .= "<table>";
            $tbl .= "<tr>";
            $tbl .= "<td width='90'><u><b>ในระหว่างลานี้ข้าพเจ้ามีภาระหน้าที่รับผิดชอบ ดังนี้</b></u>" . br(2);
            $tbl .= "............................................................................." . br(2);
            $tbl .= "............................................................................." . br(2);
            $tbl .= "............................................................................." . br(2);
            $tbl .= ".............................................................................";

            $tbl .= "</td>";

            $tbl .= "<td width='10'><u><b>สถิติการลาในปีงบประมาณนี้</b></u><br/>";

            $tbl .= "<table border ='1'>";
            $tbl .= "<thead>";
            $tbl .= "<tr>";
            $tbl .= "<th>ประเภทการลา</th>";
            $tbl .= "<th>ลามาแล้ว</th>";
            $tbl .= "<th>ลาครั้งนี้</th>";
            $tbl .= "<th>รวมเป็น</th>";
            $tbl .= "</tr>";
            $tbl .= "</thead>";
            $tbl .= "<tr>";
            $tbl .= "<td>ป่วย</td>";
            $tbl .= "<td></td>";
            $tbl .= "<td></td>";
            $tbl .= "<td></td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td>กิจส่วนตัว</td>";
            $tbl .= "<td></td>";
            $tbl .= "<td></td>";
            $tbl .= "<td></td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td>คลอดบุตร</td>";
            $tbl .= "<td></td>";
            $tbl .= "<td></td>";
            $tbl .= "<td></td>";
            $tbl .= "</tr>";
            $tbl .= "</table>";

            $tbl .= "</td>";

            $tbl .= "</tr>";
            $tbl .= "</table>";



            $tbl .= "<table>";
            $tbl .= "<tr>";
            $tbl .= "<td width='90'><u><b>ความเห็นหัวหน้างาน/ฝ่าย/ศูนย์</b></u>" . br(2);
            $tbl .= "............................................................................." . br(2);
            $tbl .= "............................................................................." . br(2);

            $tbl .= "ลงชื่อ......................................................" . br(2);
            $tbl .= "หัวหน้างาน/ฝ่าย/ศูนย์/ประธานสาขา..............................." . br(2);
            $tbl .= "...................../................../................" . br(2);

            $tbl .= "<u><b>ความเห็น ผอ.สำนัก/ผอ.กอง</b></u>" . br(2);
            $tbl .= "............................................................................." . br(2);
            $tbl .= "............................................................................." . br(2);
            $tbl .= "ลงชื่อ......................................................" . br(2);
            $tbl .= "คณบดี/ผอ.สำนัก/ผอ.กอง..............................." . br(2);
            $tbl .= "...................../................../................";

            $tbl .= "</td>";
            $tbl .= "<td width='10'><b>ลงชื่อ...............................................ผอ.กองบริหารงานบุคคล</b><br/><br/>";
            $tbl .= "...................../................../................" . br(2);

            $tbl .= "<b>ลงชื่อ...............................................ผอ.สำนักงานอธิการบดี</b><br/><br/>";
            $tbl .= "...................../................../................" . br(2);


            $tbl .= "<b><u>คำสั่ง</u></b>" . br(2) . "" . nbs(10);

            if ($row['status'] == 'approve') {
                $tbl .= "( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) อนุญาต" . nbs(5);
                $tbl .= "( ) ไม่อนุญาต";
            } elseif ($row['status'] == 'disapproval') {
                $tbl .= "( ) อนุญาต" . nbs(5);
                $tbl .= "( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) ไม่อนุญาต" . nbs(5);
            }

            $tbl .= br(2);
            $tbl .= "<b>ลงชื่อ...............................................อธิการบดี</b><br/><br/>";
            $tbl .= "...................../................../................";

            $tbl .= "</td>";

            $tbl .= "</tr>";
            $tbl .= "</table>";
        endforeach;
        $this->load->library('Pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($this->Report_m->get_css_pdf(), 1);
        $pdf->WriteHTML($tbl);
        $pdf->Output('From_iLeave.pdf', 'I');

        $data['tbl'] = $tbl;
        //$this->load->view('office/leave/print_v', $data);
    }

    //พิมพ์ใบลา พักผ่อน
    function printf_rest() {

        $id = $this->input->get('id');

        $tbl = '<div class="caption"><b>แบบใบลาพักผ่อน</b></div>';
        $leave = $this->db->get_where('tbleavemanage', array('id' => $id))->result_array();
        foreach ($leave as $row):
            if ($row['writing'] != '') {
                $tbl .= '<div class="caption_rpt"><b>เขียนที่ </b>' . $row['writing'] . '</div>';
            } else {
                $tbl .= '<div class="caption_rpt"><b>เขียนที่ </b>........................................................</div>';
            }
            $tbl .= '<div class="caption_rpt"><b></b><span style ="border-bottom: dashed 1px #333;">' . $this->mydate->dateDay($row['dateregist']) . '</span></div>';


            $tbl .= br(2);
            $tbl .= "<b>เรื่อง </b>";
            $leave_type = $this->db->get_where('tbleave_type', array('id' => $row['leave_type_id']))->result_array();
            foreach ($leave_type as $row_leave_type):
                $tbl .= "<b>ขอ" . $row_leave_type['name'] . "</b>";
            endforeach;
            $tbl .= br(2);

            $tbl .= "<b>เรียน  </b>";
            if ($row['president'] != '') {
                $tbl .= "<b>" . $row['president'] . "</b>";
            } else {
                $tbl .= "<b>...........................................................</b>";
            }
            $tbl .= br(2);

            $tbl .= nbs(12) . "<b>ข้าพเจ้า  </b>";
            $member = $this->db->get_where('tbuser', array('id' => $row['user_id']))->result_array();
            foreach ($member as $rs_member):
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['name'] . "</span>";

                $tbl .= nbs(5) . "<b>ตำแหน่ง  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['position'] . "</span>";

                $tbl .= nbs(5) . "<b>สังกัดหน่วยงาน  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $this->User_m->display_depart($rs_member['depart_id']) . "</span>";



                $tbl .= br(2) . "<b>มีวันพักผ่อนสะสม</b>";
                $leave_type = $this->db->get_where('tbleave_type', array('id' => $row['leave_type_id']))->result_array();
                foreach ($leave_type as $row_leave_type):
                    $tbl .= nbs(6) . "<span style ='border-bottom: dashed 1px #333;'>------------</span>";
                endforeach;
                $tbl .= nbs(3) . "<b>วันทำการ มีสิทธิลาพักผ่อนประจำปีนี้อีก</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>........</span> วันทำการ รวมเป็น..........วันทำการ";
                $tbl .= "";
                $tbl .= br(2);

                $tbl .= "<b>ตั้งแต่วันที่</b>";
                $tbl .= nbs(6) . "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLong($row['datefrom']) . "</span>";
                $tbl .= nbs(3) . "<b>ถึงวันที่</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLong($row['dateto']) . "</span>";
                $tbl .= nbs(3) . "<b>มีกำหนด</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['amountdate'] . "</span> วัน";
                $tbl .= br(2);

                $tbl .= "<b>ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่</b>";
                if ($row['address'] != '') {
                    $tbl .= nbs(6) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['address'] . "</span>";
                } else {
                    $tbl .= nbs(6) . "....................................................................................";
                }
                $tbl .= br(2);

                $tbl .= "<b>หมายเลขโทรศัพท์</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['mobile'] . "</span>";
                $tbl .= br(3);

                $tbl .= nbs(68) . "ขอแสดงความนับถือ";
                $tbl .= br(2) . "" . nbs(50) . "(ลงชื่อ).....................................................................";
                $tbl .= br(1) . "" . nbs(68) . "<span style ='border-bottom: dashed 1px #333;'>( " . $rs_member['name'] . " )</span>";
            endforeach;

            $tbl .= br(2);
            $tbl .= "<table>";
            $tbl .= "<tr>";
            $tbl .= "<td width='50'><u><b>สถิติการลาในปีงบประมาณนี้</b></u><br/>";

            $tbl .= "<table border ='1'>";
            $tbl .= "<thead>";
            $tbl .= "<tr>";
            $tbl .= "<th>ลามาแล้ว(วันทำการ)</th>";
            $tbl .= "<th>ลาครั้งนี้(วันทำการ)</th>";
            $tbl .= "<th>รวมเป็น(วันทำการ)</th>";
            $tbl .= "</tr>";
            $tbl .= "</thead>";
            $tbl .= "<tr>";
            $tbl .= "<td>-</td>";
            $tbl .= "<td>-</td>";
            $tbl .= "<td>-</td>";
            $tbl .= "</tr>";
            $tbl .= "</table>";

            $tbl .= "</td>";
            $tbl .= "<td valign='top' width='90'><u><b>ความเห็นผู้บังคับบัญชา</b></u>" . br(2);
            $tbl .= "............................................................................." . br(2);
            $tbl .= ".............................................................................";
            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "</table>";

            $tbl .= "<table>";
            $tbl .= "<tr>";
            $tbl .= "<td valign='top'>ลงชื่อ.........................................................ผู้ตรวจสอบ" . br(2);
            $tbl .= nbs(4) . "(..............................................................)" . br(2);
            $tbl .= "ตำแหน่ง.................................................................." . br(2);
            $tbl .= "วันที่...................../........................./........................";

            $tbl .= "</td>";
            $tbl .= "<td valign='top' width='90'>ลงชื่อ..............................................................." . br(2);
            $tbl .= nbs(4) . "(..............................................................)" . br(2);
            $tbl .= "ตำแหน่ง.................................................................." . br(2);
            $tbl .= "วันที่...................../........................./........................" . br(4);




            $tbl .= "<b><u>คำสั่ง</u></b>" . br(2) . "" . nbs(10);

            if ($row['status'] == 'approve') {
                $tbl .= "( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) อนุญาต" . nbs(5);
                $tbl .= "( ) ไม่อนุญาต";
            } elseif ($row['status'] == 'disapproval') {
                $tbl .= "( ) อนุญาต" . nbs(5);
                $tbl .= "( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) ไม่อนุญาต" . nbs(5);
            }

            $tbl .= br(2);
            $tbl .= nbs(4) . ".............................................................." . br(2);
            $tbl .= nbs(4) . ".............................................................." . br(2);
            $tbl .= "<b>ลงชื่อ...............................................อธิการบดี</b><br/><br/>";
            $tbl .= "...................../................../................";

            $tbl .= "</td>";

            $tbl .= "</tr>";
            $tbl .= "</table>";
        endforeach;
        $this->load->library('Pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($this->Report_m->get_css_pdf(), 1);
        $pdf->WriteHTML($tbl);
        $pdf->Output('From_iLeave.pdf', 'I');

        $data['tbl'] = $tbl;
        //$this->load->view('office/leave/print_v', $data);
    }

    //พิมพ์ใบลา ช่วยภรรยาและบุตร
    function printf_help_his_wife() {
        $id = $this->input->get('id');


        $tbl = '<div class="caption"><b>แบบใบลาไปช่วยเหลือภริยาที่คลอดบุตร</b></div>';
        $leave = $this->db->get_where('tbleavemanage', array('id' => $id))->result_array();
        foreach ($leave as $row):
            if ($row['writing'] != '') {
                $tbl .= br(1) . '<div class="caption_rpt"><b>เขียนที่ </b>' . $row['writing'] . '</div>';
            } else {
                $tbl .= '<div class="caption_rpt"><b>เขียนที่ </b>........................................................</div>';
            }
            $tbl .= '<div class="caption_rpt"><b></b><span style ="border-bottom: dashed 1px #333;">' . $this->mydate->dateDay($row['dateregist']) . '</span></div>';


            $tbl .= br(2);
            $tbl .= "<b>เรื่อง </b>";
            $leave_type = $this->db->get_where('tbleave_type', array('id' => $row['leave_type_id']))->result_array();
            foreach ($leave_type as $row_leave_type):
                $tbl .= "<b>ขอ" . $row_leave_type['name'] . "</b>";
            endforeach;
            $tbl .= br(2);

            $tbl .= "<b>เรียน  </b>";
            if ($row['president'] != '') {
                $tbl .= "<b>" . $row['president'] . "</b>";
            } else {
                $tbl .= "<b>...........................................................</b>";
            }
            $tbl .= br(2);

            $tbl .= nbs(12) . "<b>ข้าพเจ้า  </b>";
            $member = $this->db->get_where('tbuser', array('id' => $row['user_id']))->result_array();
            foreach ($member as $rs_member):
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['name'] . "</span>";

                $tbl .= nbs(5) . "<b>ตำแหน่ง  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['position'] . "</span>";

                $tbl .= nbs(5) . "<b>สังกัดหน่วยงาน  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $this->User_m->display_depart($rs_member['depart_id']) . "</span>";


                $tbl .= br(2) . "<b>มีความประสงค์ลาไปช่วยเหลือภริยาโดยชอบด้วยกฎหมายชื่อ</b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>  " . $row['newbihelp'] . "</span>";

                $tbl .= br(2) . "<b>ซึ่งคลอดบุตรเมื่อวันที่</b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>  " . $this->mydate->dateThaiLong($row['date_newbihelp']) . "</span> <b> จึงขออนุญาตลาไปช่วยเหลือภริยาที่คลอดบุตรตั้งแต่วันที่</b>  ";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLong($row['datefrom']) . "</span>";
                $tbl .= br(2) . "<b>ถึงวันที่</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLong($row['dateto']) . "</span>";
                $tbl .= nbs(3) . "<b>มีกำหนด</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['amountdate'] . "</span> วันทำการ";
                $tbl .= br(2);

                $tbl .= "<b>ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่</b>";
                if ($row['address'] != '') {
                    $tbl .= nbs(6) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['address'] . "</span>";
                } else {
                    $tbl .= nbs(6) . "....................................................................................";
                }
                $tbl .= br(2);

                $tbl .= "<b>หมายเลขโทรศัพท์</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['mobile'] . "</span>";
                $tbl .= br(3);

                $tbl .= nbs(69) . "ขอแสดงความนับถือ";
                $tbl .= br(2) . "" . nbs(50) . "(ลงชื่อ).....................................................................";
                $tbl .= br(2) . "" . nbs(68) . "<span style ='border-bottom: dashed 1px #333;'>( " . $rs_member['name'] . " )</span>";
            endforeach;

            $tbl .= br(2);
            $tbl .= "<table>";
            $tbl .= "<tr>";
            $tbl .= "<td valign='top'><u><b style ='font-size:16px;'>ความเห็นผู้บังคับบัญชา</b></u>" . br(2);
            $tbl .= "......................................................................................................................................................................................................................................." . br(2);
            $tbl .= ".......................................................................................................................................................................................................................................";
            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td align ='center'><br/><b style ='font-size:16px;'>ลงชื่อ.........................................................</b>" . br(2);
            $tbl .= "(..............................................................)" . br(2);
            $tbl .= "<b style ='font-size:16px;'>ตำแหน่ง..................................................................</b>" . br(2);
            $tbl .= "<b style ='font-size:16px;'>วันที่...................../........................./........................</b>";
            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td>";

            $tbl .= "<b><u style ='font-size:16px;'>คำสั่ง</u></b>" . br(2);

            if ($row['status'] == 'approve') {
                $tbl .= "<b style ='font-size:16px;'>( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) อนุญาต</b>";
                $tbl .= "<b style ='font-size:16px;'>( ) ไม่อนุญาต</b>";
            } elseif ($row['status'] == 'disapproval') {
                $tbl .= "<b style ='font-size:16px;'>( ) อนุญาต</b>";
                $tbl .= "<b style ='font-size:16px;'>( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) ไม่อนุญาต</b>";
            }

            $tbl .= br(2);
            $tbl .= "........................................................................................................................................................................................................................................" . br(2);
            $tbl .= "........................................................................................................................................................................................................................................" . br(2);
            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td align ='center'>";
            $tbl .= "<b style ='font-size:16px;'><br/>ลงชื่อ...............................................อธิการบดี</b><br/><br/>";
            $tbl .= "...................../................../................";

            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "</table>";

        endforeach;
        $this->load->library('Pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($this->Report_m->get_css_pdf(), 1);
        $pdf->WriteHTML($tbl);
        $pdf->Output('From_iLeave.pdf', 'I');

        $data['tbl'] = $tbl;
        //$this->load->view('office/leave/print_v', $data);
    }

    //พิมพ์ใบลา อุปสมปท
    public function printf_ordain() {

        $id = $this->input->get('id');

        $tbl = '<div class="caption"><b>แบบใบลาอุปสมบท</b></div>';
        $leave = $this->db->get_where('tbleavemanage', array('id' => $id))->result_array();
        foreach ($leave as $row):
            if ($row['writing'] != '') {
                $tbl .= br(1) . '<div class="caption_rpt"><b>เขียนที่ </b>' . $row['writing'] . '</div>';
            } else {
                $tbl .= '<div class="caption_rpt"><b>เขียนที่ </b>........................................................</div>';
            }
            $tbl .= '<div class="caption_rpt"><b></b><span style ="border-bottom: dashed 1px #333;">' . $this->mydate->dateDay($row['dateregist']) . '</span></div>';


            $tbl .= br(2);
            $tbl .= "<b>เรื่อง </b>";
            $leave_type = $this->db->get_where('tbleave_type', array('id' => $row['leave_type_id']))->result_array();
            foreach ($leave_type as $row_leave_type):
                $tbl .= "<b>ขอ" . $row_leave_type['name'] . "</b>";
            endforeach;
            $tbl .= br(2);

            $tbl .= "<b>เรียน  </b>";
            if ($row['president'] != '') {
                $tbl .= "<b>" . $row['president'] . "</b>";
            } else {
                $tbl .= "<b>...........................................................</b>";
            }
            $tbl .= br(2);

            $tbl .= nbs(12) . "<b>ข้าพเจ้า  </b>";
            $member = $this->db->get_where('tbuser', array('id' => $row['user_id']))->result_array();
            foreach ($member as $rs_member):
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['name'] . "</span>";

                $tbl .= nbs(5) . "<b>ตำแหน่ง  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $rs_member['position'] . "</span>";

                $tbl .= nbs(5) . "<b>สังกัดหน่วยงาน  </b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $this->User_m->display_depart($rs_member['depart_id']) . "</span>";


                $tbl .= br(2) . "<b>เกิดวันที่</b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>  " . $this->mydate->dateThaiLong($rs_member['birthday']) . "</span> <b> เข้ารับราชการเมื่อวันที่ </b>  ";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLong($rs_member['date_serve']) . "</span>";

                $tbl .= br(2) . "<b>ข้าพเจ้า</b>  ";
                if ($row['ordain_status'] == '0') {
                    $tbl .= "<b style ='font-size:16px;'>   ( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) ยังไม่เคย</b>";
                    $tbl .= "<b style ='font-size:16px;'>   ( ) เคย  อุปสมบท</b>";
                } elseif ($row['ordain_status'] == '1') {
                    $tbl .= "<b style ='font-size:16px;'>   ( ) ยังไม่เคย</b>";
                    $tbl .= "<b style ='font-size:16px;'>   ( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) เคย  อุปสมบท</b>";
                }

                $tbl .= nbs(1) . "<b>บัดนี้ ข้าพเจ้ามีศรัทธาจะอุปสมบทในพระพุทธศาสนา</b>";

                $tbl .= br(2) . "<b>ณ วัด / ตั้งอยู่ ณ</b>";
                if ($row['measure_address'] != '') {
                    $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['measure_address'] . "</span>";
                } else {
                    $tbl .= nbs(6) . "....................................................................................";
                }

                $tbl .= nbs(2) . "โทรศัพท์<span style ='border-bottom: dashed 1px #333;'>  " . $rs_member['mobile'] . "</span>";

                $tbl .= br(2) . "<b>กำหนดอุปสมบทวันที่</b>";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>  " . $this->mydate->dateThaiLong($row['dateofordination']) . "</span> <b> และจำจำพรรษาอยู่ ณ วัด / ตั้งอยู่ ณ</b>  ";
                $tbl .= "<span style ='border-bottom: dashed 1px #333;'>" . $row['temple_address'] . "</span>";


                $tbl .= br(2) . "<b>จึงขออนุญาตลาอุปสมบท ตั้งแต่วันที่</b>  <span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLong($row['datefrom']) . "</span>  ";
                $tbl .= "<b>ถึงวันที่</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $this->mydate->dateThaiLong($row['dateto']) . "</span>";
                $tbl .= nbs(3) . "<b>มีกำหนด</b>";
                $tbl .= nbs(3) . "<span style ='border-bottom: dashed 1px #333;'>" . $row['amountdate'] . "</span> วันทำการ";
                $tbl .= br(3);



                $tbl .= nbs(69) . "ขอแสดงความนับถือ";
                $tbl .= br(2) . "" . nbs(50) . "(ลงชื่อ).....................................................................";
                $tbl .= br(2) . "" . nbs(68) . "<span style ='border-bottom: dashed 1px #333;'>( " . $rs_member['name'] . " )</span>";
            endforeach;

            $tbl .= br(1);
            $tbl .= "<table>";
            $tbl .= "<tr>";
            $tbl .= "<td valign='top'><u><b style ='font-size:16px;'>ความเห็นผู้บังคับบัญชา</b></u>" . br(2);
            $tbl .= "......................................................................................................................................................................................................................................." . br(2);
            $tbl .= ".......................................................................................................................................................................................................................................";
            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td align ='center'><br/><b style ='font-size:16px;'>ลงชื่อ.........................................................</b>" . br(2);
            $tbl .= "(..............................................................)" . br(2);
            $tbl .= "<b style ='font-size:16px;'>ตำแหน่ง..................................................................</b>" . br(2);
            $tbl .= "<b style ='font-size:16px;'>วันที่...................../........................./........................</b>";
            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td>";

            $tbl .= "<b><u style ='font-size:16px;'>คำสั่ง</u></b>" . br(2);

            if ($row['status'] == 'approve') {
                $tbl .= "<b style ='font-size:16px;'>( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) อนุญาต</b>";
                $tbl .= "<b style ='font-size:16px;'>( ) ไม่อนุญาต</b>";
            } elseif ($row['status'] == 'disapproval') {
                $tbl .= "<b style ='font-size:16px;'>( ) อนุญาต</b>";
                $tbl .= "<b style ='font-size:16px;'>( " . '<img src="' . base_url() . 'assets/img/msg_success.png"/>' . " ) ไม่อนุญาต</b>";
            }

            $tbl .= br(2);
            $tbl .= "........................................................................................................................................................................................................................................" . br(2);
            $tbl .= "........................................................................................................................................................................................................................................" . br(2);
            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "<tr>";
            $tbl .= "<td align ='center'>";
            $tbl .= "<b style ='font-size:16px;'><br/>ลงชื่อ...............................................อธิการบดี</b><br/><br/>";
            $tbl .= "...................../................../................";

            $tbl .= "</td>";
            $tbl .= "</tr>";
            $tbl .= "</table>";

        endforeach;
        $this->load->library('Pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($this->Report_m->get_css_pdf(), 1);
        $pdf->WriteHTML($tbl);
        $pdf->Output('From_iLeave.pdf', 'I');

        // $data['tbl'] = $tbl;
        // $this->load->view('office/leave/print_v', $data);
    }

    //แสดงรายละเอียดการลา
    public function LeaveProfile() {

        $id = $this->input->get('LeaveId');

        $sql = "SELECT *,tbuser.name AS user_name,tbleavemanage.status AS leaveStatus,tbleavemanage.id AS leaveID,";
        $sql .= "tbuser.depart_id AS depart_id,tbuser.picture AS picture ";
        $sql .= "FROM tbleavemanage,tbuser WHERE tbleavemanage.user_id = tbuser.id ";
        $sql .= "AND tbleavemanage.id = {$id}";

        $data['rs'] = $this->db->query($sql)->row_array();
        $data['user_m'] = $this->User_m;
        $data['leave_m'] = $this->Leave_m;

        $data['mydate'] = $this->mydate;

        $data['content'] = $this->skin . "leave/isLeaveProfile_v";
        $this->load->view($this->skins, $data);
    }

    //ตรวจสอบการลา เห็นควรอนุญาติ
    public function isApprove() {
        $id = $this->input->get('LeaveId');
//ตรวจสอบการ login
        $s_login = $this->session->userdata("s_login");
        $person_id = $s_login['login_id'];
        $this->db->where('id', $id);
        $this->db->update('tbleavemanage', array(
            'person_id' => $person_id,
            'status' => 'approve',
            'approval_date' => date('Y-m-d H:i:m')
        ));

        redirect('Main/isApproversRoleTwo?status=wait&success=yes');
    }

    public function isFromApp() {
        $id = $this->input->get('LeaveId');

        $sql = "SELECT *,tbuser.name AS user_name,tbleavemanage.status AS leaveStatus,tbuser.depart_id AS depart_id,tbuser.picture AS picture ";
        $sql .= "FROM tbleavemanage,tbuser WHERE tbleavemanage.user_id = tbuser.id ";
        $sql .= "AND tbleavemanage.id = {$id}";

        $data['rs'] = $this->db->query($sql)->row_array();
        $data['user_m'] = $this->User_m;
        $data['leave_m'] = $this->Leave_m;
        $data['mydate'] = $this->mydate;

        $data['id'] = $id;
        $data['content'] = $this->skin . 'leave/isFromApp_v';
        $this->load->view($this->skins, $data);
    }

    //ตรวจสอบการลา ไม่อนุมัติ
    public function isNotApprove() {
        $id = $this->input->post('id');
        //ตรวจสอบการ login
        $s_login = $this->session->userdata("s_login");
        $person_id = $s_login['login_id'];
        $this->db->where('id', $id);
        $this->db->update('tbleavemanage', array(
            'person_id' => $person_id,
            'status' => 'no',
            'status_detail' => $this->input->post('status_detail'),
            'approval_date' => date('Y-m-d H:i:m')
        ));
        redirect('Main/isApproversRoleTwo?status=wait&success=yes');
    }

    //ตรวจสอบการลา อนุมัติการลา
    public function isApproveYes() {
        $id = $this->input->get('LeaveId');
//ตรวจสอบการ login
        $s_login = $this->session->userdata("s_login");
        $person_id = $s_login['login_id'];
        $this->db->where('id', $id);
        $this->db->update('tbleavemanage', array(
            'boss_id' => $person_id,
            'status' => 'yes',
            'OKapproval_date' => date('Y-m-d H:i:m')
        ));

        redirect('Main/isApproversRoleTree?status=yes&msg=yes');
    }

    //ตรวจสอบการลา ไม่อนุมัติ
    public function isNotApproveNo() {
        $id = $this->input->post('id');
        //ตรวจสอบการ login
        $s_login = $this->session->userdata("s_login");
        $person_id = $s_login['login_id'];
        $this->db->where('id', $id);
        $this->db->update('tbleavemanage', array(
            'boss_id' => $person_id,
            'status' => 'no',
            'comment_detail' => $this->input->post('comment_detail'),
            'OKapproval_date' => date('Y-m-d H:i:m')
        ));
        redirect('Main/isApproversRoleTree?status=yes&success=yes');
    }

    public function isFromAppNo() {
        $id = $this->input->get('LeaveId');

        $sql = "SELECT *,tbuser.name AS user_name,tbleavemanage.status AS leaveStatus,tbuser.depart_id AS depart_id,tbuser.picture AS picture ";
        $sql .= "FROM tbleavemanage,tbuser WHERE tbleavemanage.user_id = tbuser.id ";
        $sql .= "AND tbleavemanage.id = {$id}";

        $data['rs'] = $this->db->query($sql)->row_array();
        $data['user_m'] = $this->User_m;
        $data['leave_m'] = $this->Leave_m;
        $data['mydate'] = $this->mydate;

        $data['id'] = $id;
        $data['content'] = $this->skin . 'leave/isFromAppNo_v';
        $this->load->view($this->skins, $data);
    }

}
