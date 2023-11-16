<?php if (isset($msg)): ?>
    <script type="text/javascript">
        $(function () {
    <?php echo $msg; ?>
        });
    </script>
<?php endif; ?>

<section class="content-header">
    <h1>
        ประเภทการลา

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Main/LeaveTypeIndex"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ประเภทการลา</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href ="<?php echo base_url('Main/LeaveTypeAdd'); ?>">
                            <button type="button" class="btn btn-flat btn-google">
                                <i class="fa fa-plus-circle"></i> เพิ่มประเภทการลา
                            </button>
                        </a>
                    </div>
                    <div class="box-tools pull-right">


                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="">

                        <tr>
                            <th>No.</th>

                            <th>รายการ</th>
                            <th width="110">Menu Option</th>
                        </tr>


                        <?php
                        $irow = 0;
                        $i = $this->uri->segment(3) + 1;
                        foreach ($query as $r) {
                            $irow++;
                            $id = $r['id'];
                            echo "<tr>";
                            echo "<td class='center'>" . $i++ . "</td>";
                            echo "<td>" . $r['name'] . "</td>";
                            echo "<td class='center'>";
                            echo '<a href="' . base_url('Main/LeaveTypeEdit?id=' . $id) . '" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>&nbsp;';
                            // echo '<a href="#" onclick="return grid_btn_del(\'' . $id . '\')" class="btn btn-mini btn-danger"><i class="icon-remove icon-white"></i>ลบ</a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        if ($irow == 0) {
                            echo "<tr><td colspan='3' class='center'>*** ไม่พบข้อมูล ***</td></tr>";
                        }
                        ?>

                    </table>		
                </div>
                <div class="box-footer">
                   
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->