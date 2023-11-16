<?php if (isset($msg)): ?>
    <script type="text/javascript">
        $(function () {
    <?php echo $msg; ?>
        });
    </script>
<?php endif; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mailbox
        <small>13 new messages</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Main/isUser'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
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
                        <li class="active"><a href="#"><i class="fa fa-history"></i> รอตรวจสอบ
                                <span class="label label-primary pull-right"><?php echo $leave_m->TotalWait('wait'); ?></span></a></li>
                        <li><a href="#"><i class="fa fa-check"></i> การลาอนุมัติแล้ว</a></li>
                        <li><a href="#"><i class="fa fa-remove"></i> การลาไม่อนุมัติ</a></li>
                        <li><a href="#"><i class="fa fa-thumbs-down"></i> การลายกเลิก <span class="label label-danger pull-right"><?php echo $leave_m->TotalWait('cancel'); ?></span></a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">สถิติการลา</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
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
                    <h3 class="box-title">รอตรวจสอบ</h3>


                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">

                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width ="100px">สถานะ</th>
                                    <th width ="180px">วันที่ลา</th>
                                    <th>เรื่อง</th>
                                    <th width ="110px">จำนวนวันลา</th>
                                    <th width ="110px">วันที่ทำรายการ</th>
                                    <th width ="110px">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $irow = 0;
                                $i = $this->uri->segment(2) + 1;
                                foreach ($leavewait as $r) {
                                    $irow++;
                                    $id = $r['id'];
                                    ?>
                                    <tr>
                                        <td class=""><a href="">
                                                <?php echo $leave_m->display_LeaveStatus($r['status']); ?>
                                            </a></td>
                                        <td class="mailbox-name">
                                            <?php echo $mydate->dateThaiLong($r['datefrom']) . ' - ' . $mydate->dateThaiLong($r['dateto']); ?>
                                        </td>
                                        <td class="mailbox-subject"><b><?php echo $r['title']; ?></b><br/> - <?php echo $r['comment']; ?>
                                        </td>
                                        <td class=""><?php echo number_format($r['amountdate']); ?> (<?php echo $r['timerang']; ?>)</td>
                                        <td class="mailbox-date"><?php echo $mydate->dateThaiLong($r['dateregist']); ?></td>
                                        <td class="">

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></button>
                                                <a href = "<?php echo base_url('Formleave/CancelLeave?id=' . $r['id']); ?>" type="button" onClick="javascript:return confirm('คุณต้องการยกเลิกการลาใช่หรือไม่');" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
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
                            <i class="fa fa-trash-o"></i> ยกเลิกการลากดปุ่มนี้
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