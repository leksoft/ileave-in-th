<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>iLeave -  Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/Admin.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert.css">
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

        <!-- validation -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/plugins/validation/css/screen.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/jquery.metadata.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/validation/localization/messages_th.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert.min.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                $(".loader").fadeOut("slow");
            });
        </script>

        <?php if (isset($msg)): ?>
            <script type="text/javascript">
                $(function () {
    <?php echo $msg; ?>
                });
            </script>
        <?php endif; ?>
        <script type="text/javascript">
            $(function () {


                $("#myform").validate();

                $('#password').bind('keypress', function (e) {
                    if (e.keyCode == 13) {
                        login();
                    }
                });
            });


        </script>
    </head>
    <div class="loader">
        <p>กำลังประมวลผล...</p>
    </div>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url('home'); ?>"><b>iLeave</b> 3.0</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">ใช้งานระบบสำหรับผู้ลา</p>

                <?php echo form_open('Home/UserAuthen', array('id' => 'myform')); ?>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control required" placeholder="Username" id = "username" name ="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control required" placeholder="Password" id = "password" name ="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าระบบ</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php echo form_close(); ?>

                <div class="social-auth-links text-center">

                </div>
                <!-- /.social-auth-links -->
                <div class="showcase sweet">

                    <a href ="#"> <button>ลืมรหัสผ่าน?</button></a>

                </div>

                <a href="<?php echo base_url('Home/Register'); ?>" class="text-center">ลงทะเบียนใช้งานสำหรับผู้ลา</a><br/>
                <a href ="<?php echo base_url('Home'); ?>">สำหรับผู้ตรวจสอบ/ผู้อนุมัติ/ผู้ดูแลระบบ</a>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->


    </body>
</html>
