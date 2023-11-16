<?php if (isset($msg)): ?>
    <script type="text/javascript">
        $(function () {
    <?php echo $msg; ?>
        });
    </script>
<?php endif; ?>
<?php
//ตรวจสอบการ login
$s_login = $this->session->userdata('s_login');
$login_type = $s_login['login_type'];
$depart_id = $s_login['login_depart_id'];
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
         สังกัดแผนก <?php echo $user_m->display_depart($depart_id); ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Main/isUser'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="btn-group">
                <button type="button" class="btn btn-google">ยื่นเรื่องขอลา</button>
                <button type="button" class="btn btn-google dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <?php
                    $leavetype = $this->db->get('tbleave_type')->result_array();
                    foreach ($leavetype as $rs):
                        ?>
                        <li><a href="<?php echo base_url(); ?>formleave/index/<?php echo $rs['url']; ?>"><?php echo $rs['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <hr/>
            </div>


            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">รายการลา</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="<?php echo base_url('Main'); ?>"><i class="fa fa-history"></i> รอตรวจสอบ
                                <span class="label label-warning pull-right"><?php echo $leave_m->TotalWait('wait'); ?></span></a></li>
                                <li><a href="<?php echo base_url('Main/isUser?status=approve'); ?>"><i class="fa fa-check"></i> ตรวจสอบแล้ว <span class="label label-primary pull-right"><?php echo $leave_m->TotalWait('approve'); ?></span></a></li>
                        <li><a href="<?php echo base_url('Main/isUser?status=yes'); ?>"><i class="fa fa-check"></i> อนุมัติแล้ว <span class="label label-success pull-right"><?php echo $leave_m->TotalWait('yes'); ?></span></a></li>
                        <li><a href="<?php echo base_url('Main/isUser?status=disapproval'); ?>"><i class="fa fa-remove"></i> การลาไม่อนุมัติ <span class="label label-default pull-right"><?php echo $leave_m->TotalWait('disapproval'); ?></span></a></li>
                        <li><a href="<?php echo base_url('Main/isUser?status=cancel'); ?>"><i class="fa fa-thumbs-down"></i> การลายกเลิก <span class="label label-danger pull-right"><?php echo $leave_m->TotalWait('cancel'); ?></span></a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">สถิติการลา <?php echo $mydate->MonthAndYear(date('Y-m-d')); ?></h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <?php
                       $this->db->limit(4);
                        $showNameLeave = $this->db->get('tbleave_type')->result_array();
                        foreach ($showNameLeave as $rsShowNameLeave):
                            ?>
                            <li><a href="#"> <?php echo $rsShowNameLeave['name']; ?> <span class="label label-success pull-right"><?php echo $leave_m->TotalStatLeave($rsShowNameLeave['id']); ?></span></a></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $title; ?></h3>


                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">

                    <div class="table-responsive mailbox-messages">

                        <?php
                        if ($login_type == 4) {
                            $this->view('backoffice/leave/isUserWait_v');
                        } else if ($login_type == 1 || $login_type == 2 || $login_type == 3) {
                            $this->view('backoffice/leave/isAdminWait_v');
                        }
                        ?>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">

                        <div class="pull-right">
                           
                        </div>
                        <!-- /.pull-right -->
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->