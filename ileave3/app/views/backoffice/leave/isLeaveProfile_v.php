<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        รายละเอียดการลา <?php echo $rs['title']; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php if (isset($rs['picture'])) { ?>
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/img/nophoto.jpg'); ?>" alt="User profile picture">
                    <?php } else { ?>
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/upload/user/' . $rs['picture']); ?>" alt="User profile picture">
                    <?php } ?>
                    <h3 class="profile-username text-center"><?php echo $rs['user_name']; ?></h3>

                    <p class="text-muted text-center"><?php echo $user_m->User_m->display_depart($rs['depart_id']); ?></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <?php
                            $s_login = $this->session->userdata('s_login');
                            $login_type = $s_login['login_type'];
                            if ($login_type == '4') {
                                ?>
                                <b><?php echo $rs['title']; ?>เดือนนี้</b> <a class="pull-right"><?php echo $leave_m->TotalStatLeaveById($rs['leave_type_id']); ?> ครั้ง/เดือน</a>
<?php } ?>
                        </li>

                    </ul>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="active"><a href="#timeline" data-toggle="tab">Timeline</a></li>

                </ul>
                <div class="tab-content">

                    <!-- /.tab-pane -->
                    <div class="active tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-red">
                                    วันที่ทำรายการ <?php echo $rs['dateregist']; ?>
                                </span> <?php echo $leave_m->display_LeaveStatus($rs['leaveStatus']); ?>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> ช่วงเวลา <?php echo $rs['timerang']; ?> น.</span>

                                    <h3 class="timeline-header"><a href="#"><?php echo $rs['title']; ?></a>  เป็นเวลา <?php echo $rs['amountdate']; ?> วัน ตั้งแต่วันที่ <?php echo $mydate->dateThaiLong($rs['datefrom']); ?>  ถึง <?php echo $mydate->dateThaiLong($rs['dateto']); ?></h3>

                                    <div class="timeline-body">
                                        <?php echo $rs['comment']; ?>
                                        <?php
                                        if ($rs['leave_type_id'] == '6') :

                                            if ($rs['ordain_status'] == '0') {
                                                echo "<hr/>ข้าพเจ้าไม่เคยอุปสมบทมาก่อน<hr/>";
                                            } else {
                                                echo "<hr/>ข้าพเจ้าเคยอุปบทมาแล้ว<hr/>";
                                            }

                                            echo "วันที่อุปสมบท " . $rs['dateofordination'];

                                            echo "<hr/>ที่จำพรรษา " . $rs['temple_address'];
                                            echo "<hr/>ที่อยู่วัด " . $rs['measure_address'];








                                        endif;
                                        ?>
                                    </div>

                                </div>
                            </li>
                            <!-- END timeline item -->
                            <li class="time-label">
                                <div class="row no-print">
                                    <div class="col-xs-12">
                                        <?php
                                        switch ($rs['leave_type_id']) {
                                            case '1':
                                                echo '<a href="' . base_url() . 'formleave/printf?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '2':
                                                echo '<a href="' . base_url() . 'formleave/printf?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '3':
                                                echo '<a href="' . base_url() . 'formleave/printf?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '4':
                                                echo '<a href="' . base_url() . 'formleave/printf_rest?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '5':
                                                echo '<a href="' . base_url() . 'formleave/printf_help_his_wife?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '6':
                                                echo '<a href="' . base_url() . 'formleave/printf_ordain?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '7':
                                                echo '<a href="' . base_url() . '#?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '8':
                                                echo '<a href="' . base_url() . '#?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '9':
                                                echo '<a href="' . base_url() . '#?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '10':
                                                echo '<a href="' . base_url() . '#?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            case '11':
                                                echo '<a href="' . base_url() . '#?id=' . $rs['leaveID'] . '" class="btn btn-pinterest" target ="_blank"><i class="fa fa-print"></i>พิมพ์ใบลา</a>&nbsp;';
                                                break;
                                            default :
                                                echo "ไม่พบแบบฟอร์มนี้";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!-- /.tab-pane -->

                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->