<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        รายละเอียดการลา <?php echo $rs['title']; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
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
                            <b>Followers</b> <a class="pull-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b> <a class="pull-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b> <a class="pull-right">13,287</a>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
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
                                    <?php echo $rs['dateregist']; ?>
                                </span> <?php echo $leave_m->display_LeaveStatus($rs['leaveStatus']);?>
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

                                    </div>

                                </div>
                            </li>
                            <!-- END timeline item -->

                            <li>
                                <i class="fa fa-sign-out bg-gray"></i>
                            </li>
                        </ul>

                    </div>


                </div>
                <div class="tab-content">

                    <?php echo form_open('Formleave/isNotApprove', array('class' => 'form-horizontal')); ?>

                    <input type="hidden" name ="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">หมายเหตุ</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" id="status_detail" name ="status_detail" placeholder="หมายเหตุถ้าไม่อนุญาติให้ลา"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">บันทึก</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->