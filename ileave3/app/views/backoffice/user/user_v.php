<?php if (isset($msg)): ?>
    <script type="text/javascript">
        $(function () {
    <?php echo $msg; ?>
        });
    </script>
<?php endif; ?>

<section class="content-header">
    <h1>
        
        ข้อมูล <?php echo $display_role ?> แผนก <?php echo $user_m->display_depart($dep);?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Main/UserIndex?role=<?php echo $role;?>&dep=<?php echo $dep;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ข้อมูลพนักงาน</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href ="<?php echo base_url('Main/UserAdd?role='.$role.'&dep='.$dep); ?>">
                            <button type="button" class="btn btn-flat btn-google">
                                <i class="fa fa-plus-circle"></i> เพิ่ม<?php echo $display_role;?>
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
                            <th>ชื่อ-นามสกุล</th>
                            <th>สังกัด/แผนก/ฝ่าย</th>
                            <th>สถานะ</th>
                            <th width="110">Menu Option</th>
                        </tr>


                        <?php
                        $irow = 0;
                        $i = $this->uri->segment(2) + 1;
                        foreach ($query as $r) {
                            $irow++;
                            $id = $r['id'];
                            echo "<tr>";
                            echo "<td class='center'>" . $i++ . "</td>";
                            echo "<td>" . $r['name'] . "</td>";
                            echo "<td>" . $user_m->display_depart($r['depart_id']) . "</td>";
                            echo "<td>" . $user_m->display_status($r['status']) . "</td>";
                            echo "<td class='center'>";
                            echo '<a href="' . base_url('Main/UserEdit?id=' . $id.'&role='.$role.'&dep='.$dep) . '" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>&nbsp;';
                            echo '<a href="' . base_url('Main/UserDel?id=' . $id.'&role='.$role.'&dep='.$dep) . '" onclick="return confirm(\'คุณต้องการลบข้อมูลนี้ใช่หรือไม่\')" class="btn btn-sm btn-google"><i class="fa fa-trash"></i></a>';
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
                    <?php echo $pagination;?>
                </div><!-- box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->