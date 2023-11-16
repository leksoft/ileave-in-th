<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="โปรแกรมลางานออนไลน์">
        <meta name="author" content="อีสานเดฟ">
        <title>โปรแกรมลางานออนไลน์ 3.0</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/Admin.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skin-green.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert.css">
        <!-- validation -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/plugins/validation/css/screen.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/jquery.metadata.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/localization/messages_th.js"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jasny-bootstrap/jasny-bootstrap.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jasny-bootstrap/jasny-bootstrap.js">
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

        <link href="<?php echo base_url(); ?>assets/css/reports.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/highchart/highcharts.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/highchart/exporting.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                $(".loader").fadeOut("slow");
            });
        </script>

    </head>
    <?php
//ตรวจสอบการ login
    $s_login = $this->session->userdata('s_login');
    $login_type = $s_login['login_type'];
    $depart_id = $s_login['login_depart_id'];
    $user_id = $s_login['login_id'];
    $ci = &get_instance();
    $ci->load->model('Leave_m');
    $ci->load->model('User_m');
    $ci->load->model('Person_m');
    $leave_m = $ci->Leave_m;
    $user_m = $ci->User_m;
    $person_m = $ci->Person_m;
    //รายการลารอตรวจสอบ

    $this->db->where('status', 'wait');
    $this->db->where('user_id', $user_id);
    $this->db->order_by('id', 'desc');
    $this->db->limit(12);
    $leavewait = $this->db->get('tbleavemanage')->result_array();
    ?>
    <div class="loader"></div>
    <body class="hold-transition <?= SKIN; ?> sidebar-mini">
        <div class="wrapper">

            <header class="main-header">

                <!-- Logo -->
                <a href="<?php echo base_url('main'); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Lea</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>iLeave</b>3</span>
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <?php if ($leave_m->TotalWait('wait') != '0') : ?>
                                        <span class="label label-warning"><?php echo $leave_m->TotalWait('wait'); ?></span>
                                    <?php endif; ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have <?php echo $leave_m->TotalWait('wait'); ?> notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <?php foreach ($leavewait AS $LeaveWaitRow) : ?>
                                                <li>
                                                    <a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId=' . $LeaveWaitRow['id']); ?>">
                                                        <i class="fa fa-user text-red"></i> <?php echo $LeaveWaitRow['title'] . " วันที่ลา " . $LeaveWaitRow['dateregist']; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $s_login['login_name']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                        <p><?php echo $s_login['login_role']; ?>

                                            <?php if ($login_type == '1' || $login_type == '2' || $login_type == '3') { ?>
                                                <small>แผนก <?php echo $person_m->display_depart($depart_id); ?></small>
                                            <?php } else { ?>

                                                <small>แผนก <?php echo $user_m->display_depart($depart_id); ?></small>

                                            <?php } ?>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <?php if ($login_type == '1' || $login_type == '2' || $login_type == '3') { ?>
                                                <a href="<?php echo base_url('Profile/PersonIndex?id=' . $user_id); ?>" class="btn btn-default btn-flat">Profile</a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url('Profile/UserIndex?id=' . $user_id); ?>" class="btn btn-default btn-flat">Profile</a>
                                            <?php } ?>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url('home/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->

                        </ul>
                    </div>

                </nav>
            </header>
            <?php
            $ileave = $this->session->userdata('ileave');
            $s_activemenu = $ileave['activemenu'];
            ?>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $s_login['login_name']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $s_login['login_role']; ?></a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <?php if ($login_type == '1'): ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-dashboard"></i> <span>กำหนดค่าทั่วไป</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url('Main/TeamIndex'); ?>"><i class="fa fa-circle-o"></i> หน่วยงาน</a></li>
                                    <li><a href="<?php echo base_url('Main/DepartIndex'); ?>"><i class="fa fa-circle-o"></i> แผนก</a></li>
                                    <li class=""><a href="<?php echo base_url('Main/YearIndex'); ?>"><i class="fa fa-circle-o"></i> ปีงบประมาณ</a></li>
                                    <li class=""><a href="<?php echo base_url('Main/LeaveTypeIndex'); ?>"><i class="fa fa-circle-o"></i> ประเภทการลา</a></li>
                                </ul>
                            </li>

                            <li class="<?php echo ($this->uri->segment('2') == 'PersonIndex') ? 'active' : ''; ?> treeview">
                                <a href="#">
                                    <i class="fa fa-child"></i> <span>ข้อมูลพนักงาน</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url('Main/PersonIndex?role=1'); ?>"><i class="fa fa-circle-o"></i> ผู้ดูแลระบบสูงสุด</a></li>
                                    <li><a href="<?php echo base_url('Main/PersonIndex?role=2'); ?>"><i class="fa fa-circle-o"></i> ผู้ตรวจสอบการลา</a></li>
                                    <li><a href="<?php echo base_url('Main/PersonIndex?role=3'); ?>"><i class="fa fa-circle-o"></i> ผู้อนุมัติการลา</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Main/UserByDepart'); ?>">
                                    <i class="fa fa-list-ol"></i> <span>ข้อมูลผู้ลาแยกตามแผนก</span>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($login_type == '2' || $login_type == '3'): ?>
                            <li>
                                <a href="<?php echo base_url('Main/UserIndex?role=4&dep=' . $depart_id); ?>">
                                    <i class="fa fa-users"></i> <span>ข้อมูลผู้ลา</span>

                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Main/UserByDepart'); ?>">
                                    <i class="fa fa-list-ol"></i> <span>ข้อมูลผู้ลาแยกตามแผนก</span>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($login_type == '4'): ?>
                            <li>
                                <a href="<?php echo base_url('Main/isUser'); ?>">
                                    <i class="fa fa-database"></i> <span>ข้อมูลการลาของฉัน</span>

                                </a>
                            </li>

                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-pie-chart"></i>
                                    <span>รายงานการลา</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url('Report/ajax_get_chart'); ?>"><i class="fa fa-circle-o"></i> ประจำปี</a></li>


                                </ul>
                            </li>
                        <?php endif; ?>
                        <li><a href=""><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                        <li class="header">อื่นๆ</li>

                        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>วันหยุด</span></a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>support</span></a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php $this->view($content); ?>
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?> <b>iLeave V.</b> 3
                </div>
                <strong>Copyright &copy; 2016-2017 <a href="">Esandev Studio</a>.</strong> All rights
                reserved.
            </footer>

        </div>
        <!-- ./wrapper -->

        <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>


        <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/demo.js"></script>

    </body>
</html>
