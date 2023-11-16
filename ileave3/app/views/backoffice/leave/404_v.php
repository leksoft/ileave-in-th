<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Oops!</h1>

   
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"> 404 Not Found</h3>

                    <div class="box-tools pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-flat btn-facebook dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-leaf"></i> เปลี่ยนเรื่องขอลา</button>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                $leavetype = $this->db->get('tbleave_type')->result_array();
                                foreach ($leavetype as $rs):
                                    ?>
                                    <li><a href="<?php echo base_url(); ?>formleave/index/<?php echo $rs['url']; ?>"><i class="fa fa-check-circle"></i> <?php echo $rs['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="box-body">
                    Sorry, an error has occured, Requested page not found!
                    <hr/>
                    ไม่พบหน้า <?php echo $page_title; ?> อาจเกิดจากไม่มีฟอร์มที่รองรับการใช้งานนี้ กรุณาติดต่อผู้พัฒนาระบบ หากต้องการใช้แบบฟอร์มนี้
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo base_url(); ?>main" class="btn btn-large btn-primary">
                        <i class="icon-chevron-left"></i>
                        &nbsp;
                        Back to Dashboard						
                    </a>

                    <a href="#myModalAboute" data-toggle="modal" class="btn btn-large">
                        <i class="icon-envelope"></i>
                        &nbsp;
                        Contact Support						
                    </a>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
</section>