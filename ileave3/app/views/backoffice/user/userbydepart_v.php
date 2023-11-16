<?php if (isset($msg)): ?>
    <script type="text/javascript">
        $(function () {
    <?php echo $msg; ?>
        });
    </script>
<?php endif; ?>

<section class="content-header">
    <h1>
        ดูรายชื่อผู้ลาแยกตามแผนกทั้งหมด

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Main/DepartIndex"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ข้อมูลแผนก</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">

                    <div class="box-tools pull-right">


                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="">

                        <tr>
                            <th>No.</th>

                            <th>แผนก</th>
                            <th>จำนวน/คน</th>
                            <th width="110">Menu Option</th>
                        </tr>


                        <?php
                        $irow = 0;
                        $i = $this->uri->segment(2) + 1;
                        foreach ($query as $r) {

                            $irow++;
                            $id = $r['depart_id'];
                            $this->db->where('depart_id', $id);
                            $total = $this->db->get('tbuser')->num_rows();
                            echo "<tr>";
                            echo "<td class='center'>" . $i++ . "</td>";
                            echo "<td>" . $r['depart_name'] . " (" . $r['team_name'] . ")</td>";
                            echo "<td class='center'>";
                            echo "<h3>" . $total . "</h3>";
                            echo "</td>";
                            echo "<td class='center'>";
                            echo '<a href="' . base_url('Main/ListUserBydepart/' . $id) . '" class="btn btn-sm btn-default"><i class="fa fa-open"></i> เปิดดูรายชื่อ</a>&nbsp;';

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