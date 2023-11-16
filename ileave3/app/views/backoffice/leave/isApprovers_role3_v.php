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
        สังกัดแผนก <?php echo $person_m->display_depart($depart_id); ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Main/isUser'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">

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
                        <li class="active"><a href="<?php echo base_url('Main/isApproversRoleTree?status=approve'); ?>"><i class="fa fa-history"></i> การรอรออนุมัติ
                                <span class="label label-warning pull-right"><?php echo $leave_m->TotalByDepartAll('approve'); ?></span></a></li>
                        <li><a href="<?php echo base_url('Main/isApproversRoleTree?status=yes'); ?>"><i class="fa fa-check"></i> การลาที่อนุมัติแล้ว <span class="label label-success pull-right"><?php echo $leave_m->TotalByDepartAll('yes'); ?></span></a></li>

                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->

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
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width ="60px"></th>
                                    <th width ="110px">ชื่อ-นามสกุล</th>
                                    <th width ="180px">เรื่อง</th>
                                    <th width ="180px">วันที่ลา</th>
                                    <th width ="120px">สถานะ</th>
                                    <th width ="110px">วันที่ทำรายการ</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $irow = 0;
                                $i = $this->uri->segment(2) + 1;
                                foreach ($query as $r) {
                                    $irow++;
                                    $id = $r['id'];
                                    ?>


                                    <tr>
                                        <td 
                                            class="">
                                            <div class="btn-group">

                                                <button type="button" class="btn btn-sm btn-dropbox dropdown-toggle" data-toggle="dropdown">
                                                    จัดการ <span class="fa fa-cogs"></span> 
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">

                                                    <?php if ($r['status'] == 'approve') { ?>

                                                        <?php if ($login_type == 3) { ?>
                                                            <li><a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId=' . $r['id']); ?>"><i class="fa fa-address-card"></i> ดูรายละเอียด</a></li>
                                                            <li><a href="<?php echo base_url('Formleave/isApproveYes?LeaveId=' . $r['id']); ?>"><i class="fa fa-check"></i> อนุมัติการลา</a></li>
                                                            <li><a href="<?php echo base_url('Formleave/isFromAppNO?LeaveId=' . $r['id']); ?>"><i class="fa fa-reply"></i> ไม่อนุมัติ</a></li>
                                                        <?php } ?>
                                                    <?php } else if ($r['status'] == 'yes') { ?>
                                                        <li><a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId=' . $r['id']); ?>"><i class="fa fa-address-card"></i> ดูรายละเอียด</a></li>
                                                    <?php } else if ($r['status'] == 'disapproval') { ?>    
                                                        <li><a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId=' . $r['id']); ?>"><i class="fa fa-address-card"></i> ดูรายละเอียด</a></li>
                                                    <?php } else if ($r['status'] == 'cancel') { ?>
                                                        <li><a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId=' . $r['id']); ?>"><i class="fa fa-address-card"></i> ดูรายละเอียด</a></li>
                                                    <?php } else { ?>
                                                        <?php if ($login_type == 4) { ?>
                                                            <li><a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId=' . $r['id']); ?>"><i class="fa fa-eye"></i> ดูรายละเอียด</a></li>
                                                            <li><a href = "<?php echo base_url('Formleave/CancelLeave?id=' . $r['id']); ?>"  onClick="javascript:return confirm('คุณต้องการยกเลิกการลาใช่หรือไม่');" ><i class="fa fa-trash-o"></i> ยกเลิกการลา</a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                        </td>
                                        <td>
                                            <span class="small"> <?php echo $user_m->display_Username($r['user_id']); ?></span>
                                        </td>
                                        <td><b><?php echo $r['title']; ?></b></td>
                                        <td>
                                            <span class="small"> <?php echo $mydate->dateThaiLong($r['datefrom']) . ' - ' . $mydate->dateThaiLong($r['dateto']); ?></span>
                                        </td>
                                        <td><a href=""><?php echo $leave_m->display_LeaveStatus($r['status']); ?></a>
                                            <br/><span class="small">
                                                <?php 
                                            if($r['status'] == 'approve'){
                                            echo "ผู้ตรวจสอบ <br/>".$person_m->display_PersonName($r['person_id']);
                                            }else if($r['status'] == 'yes'){
                                                 echo "ผู้อนุมัติ <br/>".$person_m->display_PersonName($r['boss_id']);
                                            }
                                            ?>
                                            
                                            </span>
                                        </td>



                                        <td><span class="small"><?php echo $mydate->dateThaiLong($r['dateregist']); ?></span></td>
                                    </tr>
                                    <?php
                                }
                                if ($irow == 0) {
                                    echo "<tr><td colspan='6' class='center'>*** ไม่พบข้อมูลการลาของคุณ ***</td></tr>";
                                }
                                ?>


                            </tbody>
                        </table>
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