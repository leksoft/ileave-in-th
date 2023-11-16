<?php
class Login extends Controller {
    function __construct() {
        parent::Controller();
        $this->load->model('script_m');
        $this->load->model('phpfunction_m');
        $this->load->model('teacher_m');
        $this->session->sess_destroy();
    }

    function index() {
        //ชื่อโรงเรียน จะดึงจาก Serial แล้วบันทึกลงตารางให้อัตโนมัติ
        $this->load->library('serial');
        $school = $this->serial->get_serial();
        $this->session->set_userdata('school_name',$school['school_name']);
        $data['school_name'] = $school['school_name'];
        $data['serial'] = $school['serial'];

        if ($this->db->get('tbconfig')->num_rows() > 0) {
            $this->db->update('tbconfig', $data);
        } else {
            $this->db->insert('tbconfig', $data);
        }
        //******************************************************************//

        //$this->load->library('encrypt');
        //$this->load->model('register_m');

        $row = $this->db->get('tbconfig')->row_array();
        $script = '';
        $demo_txt = '';

        if($row['serial']=="B999") {
            $script = "<script type=\"text/javascript\">alert('โปรแกรมชุดนี้ใช้เพื่อการ DEMO เท่านั้น');</script>\n";
            $demo_txt = 'Trail Version';
        }

        $data['demo_txt'] = $demo_txt;
        $data['extraHeadContent'] = $this->script_m->jquery_fancybox();
        $data['extraHeadContent'].= $this->script_m->calendar();
        $this->load->view('index_v',$data);
    }

    function index_bk() {
        //ชื่อโรงเรียน จะดึงจาก Serial แล้วบันทึกลงตารางให้อัตโนมัติ
        $this->load->library('serial');
        $school = $this->serial->get_serial();
        $this->session->set_userdata('school_name',$school['school_name']);
        $data['school_name'] = $school['school_name'];
        if ($this->db->get('tbconfig')->num_rows() > 0) {
            $this->db->update('tbconfig', $data);
        } else {
            $this->db->insert('tbconfig', $data);
        }
        //******************************************************************//

        $this->load->library('encrypt');
        $this->load->model('register_m');

        $result = $this->db->get('tbconfig');
        $script = '';
        $demo_txt = '';
        if($result->num_rows()==0) {
            $this->load->view('register/index_v');
            return;
        }else {
            $data = $result->row_array();
            $this->load->model('register_m');
            $activecode = $this->register_m->decode($data['activecode']);

            //ดึงค่า Mac Address มาเปรียบเทียบกับ ActiveCode ว่าตรงกันหรือป่าว
            if($data['server_type']=='1') {
                $serial = $this->register_m->linux_macaddress();
            }else {
                $serial = $this->register_m->window_macaddress();
            }

            $serial = str_replace("-","",$serial);
            if($serial != $activecode || $data['serial'] == '' || $data['activecode'] == '' || strlen($data['activecode'])!=16) {
                $data['school_name'] = $school['school_name'];
                $this->load->view('register/index_v',$data);
                return;
            }else {
                if(substr($data['serial'], 0 , 4)=="B999") {
                    $script = "<script type=\"text/javascript\">alert('โปรแกรมชุดนี้ใช้เพื่อการ DEMO เท่านั้น');</script>\n";
                    $demo_txt = 'Trail Version';
                }
            }
        }

        $data['demo_txt'] = $demo_txt;
        $data['extraHeadContent'] = $this->script_m->jquery_fancybox();
        $data['extraHeadContent'].= $this->script_m->calendar();
        $this->load->view('index_v',$data);
    }

    //login โดย student
    function student_login() {
        $student_code = $this->input->post('student_code');
        //$birthday = $this->phpfunction_m->dateToMysql($this->input->post('birthday'));
        $ddl_date = sprintf("%02d",$this->input->post('ddl_date'));
        $ddl_month = sprintf("%02d",$this->input->post('ddl_month'));
        $ddl_year = $this->input->post('ddl_year');

        $birthday = $this->phpfunction_m->dateToMysql($ddl_date."/".$ddl_month."/".$ddl_year);

        $result = false; //ถูกต้อง
        $msg = '';
        $this->db->where('code',$student_code);
        if($this->db->get('tbstudent')->num_rows()==0) {
            $msg = 'รหัสประจำตัวไม่ถูกต้อง !!';
        }else {
            $this->db->where('birthday',$birthday);
            if($this->db->get('tbstudent')->num_rows()==0) {
                $msg = 'วัน เดือน ปีเกิด ไม่ถูกต้อง !!';
            }else {
                $result = true;
            }
        }

        if($result) {
            $this->session->set_userdata('sessionID','');
            $this->session->set_userdata('s_student_code',$student_code);

            $this->db->where('code',$student_code);
            $student = $this->db->get('tbstudent')->row_array();
            $fullname = $student['title'].$student['firstname']." ".$student['surname'];
            $this->session->set_userdata('s_student_fullname',$fullname);
            $this->session->set_userdata('s_persontype',$this->input->post('ddl_persontype'));

            $this->session->set_userdata('s_login','1');
            $data['url'] = site_url("sys_student/win_student");

            //session social
            $this->setSessionPost($student_code,'6');

            $this->load->model('log_m');
            $this->log_m->saveLogStudent($student_code,$fullname,"ส่วนงานนักเรียน/ผู้ปกครอง");
        }

        $data['msg'] = $msg;
        $data['result'] = $result;
        echo json_encode($data);
    }

    //login โดย admin
    function admin_login($login_code='',$login_password='',$recall='') {

        if ($login_code=='')
            $login_code = $this->input->post('login_code');
        if ($login_password=='')
            $login_password = $this->input->post('login_password');

        $this->load->model('user_m');
        $data = $this->user_m->checkUserAndPass($login_code,$login_password);

        if($data['result']) {
            $this->session->set_userdata('s_login','1');
            $this->session->set_userdata('s_login_type','99');
            $this->session->set_userdata('s_admin_code',$login_code);
            $this->session->set_userdata('s_admin_pass',$login_password);
            $this->session->set_userdata('s_login_type_name','ผู้ดูแลระบบ');

            $this->db->where('code',$login_code);
            $full_name = $this->db->get('tbuser')->row_array();

            if($login_code=='administrator') {
                $this->session->set_userdata('s_login_fullname','Administrator');
            }else {
                $this->session->set_userdata('s_login_fullname',$full_name['name']);
            }

            $data['url'] = site_url("admin");

            //session social
            $this->setSessionPost($login_code,'99');
        }

        $this->session->set_userdata('user_picture', base_url().'assets/images/user_nopic.gif');
        if ($recall=="")
            echo json_encode($data);
        else
            redirect('admin');
    }

    /**
     * ตรวจสอบ username และรหัสผ่านของครูสำหรับเข้าทุกระบบ ยกเว้นระบบของนักเรียน
     * ว่าถูกต้องหรือไม่ และสามารถเข้าใช้ icon นี้ได้หรือไม่
     */
    function check_login($login_code='',$login_password='',$icon_id='',$recall='') {
        /**1. ตรวจสอบก่อนว่ารหัสผู้ใช้งานถูกต้องหรือไม่
         * 2. ตรวจสอบว่ามีสิทธิ์เข้าใช้งาน icon นี้หรือไม่
         * 3. ตรวจสอบ่วารหัสผ่านถูกต้องหรือไม่
         */
        $this->load->model('config_m');
        $school = $this->config_m->get_one();
        $url_recall='';
        if ($login_code=='')
            $login_code = $this->input->post('login_code');
        if ($login_password=='')
            $login_password = $this->input->post('login_password');
        if ($icon_id=='')
            $icon_id = $this->input->post('icon_id');

        $this->session->set_userdata('s_login_code',$login_code);
        $this->session->set_userdata('s_login_password',$login_password);

        $msg = '';
        $result = false;
        $user_picture = base_url().'assets/images/user_nopic.gif';
        $menuname = ''; //บันทึกว่า login เข้าเมนูระบบชื่ออะไร

        if($icon_id=='99') {
            $this->admin_login($login_code, $login_password,$recall);
            return;
        }else if($icon_id=='6') {
            $this->db->where('password_card',$login_password);
            $row = $this->db->get('tbuser')->row_array();
            if(count($row)>0) {
                $data['url'] = site_url('timebarcode');
                $this->session->set_userdata('s_login_type','6');
                $this->session->set_userdata('s_login','1');
                $result = true;
            }else {
                $msg = 'รหัสผ่านไม่ถูกต้อง !!';
                $result = false;
            }
        }else {
            $this->db->where('user_code',$login_code);
            $query = $this->db->get('tbteacher');

            if($query->num_rows()==0) {
                $msg = 'รหัสผู้ใช้งานไม่ถูกต้อง !';
            }else {
                $row = $query->row_array();
                $this->session->set_userdata('s_login_teacher_code',$row['code']);
                switch ($icon_id) {
                    case '2':   //ครู
                        if($row['isteacher']=='0') {
                            $msg = 'คุณไม่ได้รับสิทธิ์ใช้งานส่วนนี้ !!';
                        }else {
                            $data['url'] = site_url('sys_teacher/win_teacher');
                            $url_recall='sys_teacher/win_teacher';
                            $this->session->set_userdata('s_login_type','2');
                            $this->session->set_userdata('s_login_type_name','ครู');
                            $menuname = 'ส่วนงานครูประจำชั้น';
                            $result = true;

                            //session social
                            $this->setSessionPost($row['code'],'1');
                            $this->session->set_userdata('s_persontype','1'); //ประเมินโดย 1=ครู,2=ผู้ปกครอง,3=นักเรียน
                        }
                        break;
                    case '3':   //บุคลากรภายใน
                        if($row['isemployee']=='0') {
                            $msg = 'คุณไม่ได้รับสิทธิ์ใช้งานส่วนนี้ !!';
                            $result = false;
                        }else {
                            $data['url'] = site_url('sys_employee/win_employee');
                            $url_recall='sys_employee/win_employee';
                            $this->session->set_userdata('s_login_type','3');
                            $this->session->set_userdata('s_login_type_name','บุคลากรภายใน');
                            $menuname = 'ส่วนงานบุคลากรภายใน';
                            $result = true;

                            //session social
                            $this->setSessionPost($row['code'],'5');
                        }
                        break;
                    case '4':   //งานกิจกรรม
                        if($row['isactivity']=='0') {
                            $msg = 'คุณไม่ได้รับสิทธิ์ใช้งานส่วนนี้ !!';
                            $result = false;
                        }else {
                            $data['url'] = site_url('sys_activity/win_activity');
                            $url_recall='sys_activity/win_activity';
                            $this->session->set_userdata('s_login_type','4');
                            $this->session->set_userdata('s_login_type_name','งานกิจกรรม');
                            $menuname = 'ส่วนงานกิจกรรม';
                            $result = true;

                            //session social
                            $this->setSessionPost($row['code'],'4');
                        }
                        break;
                    case '7':   //งานปกครอง
                        if($row['isrule']=='0') {
                            $msg = 'คุณไม่ได้รับสิทธิ์ใช้งานส่วนนี้ !!';
                            $result = false;
                        }else {
                            $data['url'] = site_url('sys_rule/win_rule');
                            $url_recall='sys_rule/win_rule';
                            $this->session->set_userdata('s_login_type','7');
                            $this->session->set_userdata('s_login_type_name','งานปกครอง');
                            $menuname = 'ส่วนงานปกครอง';
                            $result = true;

                            //session social
                            $this->setSessionPost($row['code'],'3');
                        }
                        break;
                    case '5':   //ผู้บริหาร
                        if($row['ismanager']=='0') {
                            $msg = 'คุณไม่ได้รับสิทธิ์ใช้งานส่วนนี้ !!';
                            $result = false;
                        }else {
                            $data['url'] = site_url('sys_manager/win_manager');
                            $url_recall='sys_manager/win_manager';
                            $this->session->set_userdata('s_login_type','5');
                            $this->session->set_userdata('s_login_type_name','ผู้บริหาร');
                            $menuname = 'ส่วนงานผู้บริหาร';
                            $result = true;

                            //session social
                            $this->setSessionPost($row['code'],'2');
                        }
                        break;
                }
            }

            if($result && $icon_id!='6') {
                $this->load->library('encrypt');
                $uspass = $this->encrypt->decode($row['password']);
                if($login_password != $uspass) {
                    $msg = 'รหัสผ่านไม่ถูกต้อง !';
                    $result = false;
                }else {
                    $this->session->set_userdata('s_login','1');
                    $row = $this->teacher_m->get_one_bylogin($login_code);
                    $this->session->set_userdata('s_login_fullname',$row['name']);
                    $user_picture = $this->teacher_m->get_picture($row['code']);

                    $this->load->model('log_m');
                    $this->log_m->saveLogTeacher($row['code'],$row['user_code'],$row['name'],$menuname);
                }
            }
        }

        $data['msg'] = $msg;
        $data['result'] = $result;
        $this->session->set_userdata('user_picture',$user_picture);
        if ($recall=='')
            echo json_encode($data);
        else
            echo  redirect($url_recall);
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    function openStudent($student_code) {
        $this->session->set_userdata('sessionID',$student_code);
        $this->session->set_userdata($student_code.'s_student_code',$student_code);
        $this->session->set_userdata('s_student_code',$student_code);

        $this->db->where('code',$student_code);
        $row = $this->db->get('tbstudent')->row_array();
        if($row['checktime']=='1') {
            $this->session->set_userdata('s_checktime','1');
        }else {
            $this->session->set_userdata('s_checktime','0');
        }
        $this->session->set_userdata('s_group_code',$row['group_code']);

        redirect('sys_student/profile');
    }

    //set ค่า session เพื่อใช้ในการ post
    function setSessionPost($code,$section) {
        /*
         * ครู = 1
         * ผู้บริหาร = 2
         * งานปกครอง = 3
         * งานกิจกรรม = 4
         * เจ้าหน้าที่ = 5
         * นักเรียน/ผู้ปกครอง = 6
        */

        $this->session->set_userdata('s_social_teacher_code',$code);
        $this->session->set_userdata('s_social_section',$section);
        return true;
    }
}
?>
