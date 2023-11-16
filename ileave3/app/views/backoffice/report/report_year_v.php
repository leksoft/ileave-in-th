<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script type="text/javascript">
    var chart1;
    $(function () {
        chart1 = new Highcharts.Chart({

            chart: {
                renderTo: 'container_chart',
                type: 'bar'
            },

            title: {
                text: "<?php echo $title_text; ?>"
            },
            xAxis: {
                categories: <?php echo $categories_data; ?>
            },
            yAxis: {
                title: {
                    text: 'จำนวนการลา/ครั้ง'

                }
            },
            series: <?php echo $series_data; ?>
            // colors: ['#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92', '#B5CA92', '#B5CA92']
        });
    });
    $(".select2").select2();
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        รายงานการลา

    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <center>
                    <?php echo form_open('Report/ajax_get_chart', array('class' => 'form-horizontal')); ?>
                    <div class="col-md-5">

                        <div class="form-group">
                            <label>เลือก เดือน</label>
                            <select class="form-control select2"name ="mounth">
                                <option selected="selected" value="01" <?php echo (@$m == '01') ? 'selected' : ''; ?>>มกราคม</option>
                                <option value="02" <?php echo (@$m == '02') ? 'selected' : ''; ?>>กุมภาพันธ์</option>
                                <option value="03" <?php echo (@$m == '03') ? 'selected' : ''; ?>>มีนาคม</option>
                                <option value="04" <?php echo (@$m == '04') ? 'selected' : ''; ?>>เมษายน</option>
                                <option value="05" <?php echo (@$m == '05') ? 'selected' : ''; ?>>พฤษภาคม</option>
                                <option value="06" <?php echo (@$m == '06') ? 'selected' : ''; ?>>มิถุนายน</option>
                                <option value="07" <?php echo (@$m == '07') ? 'selected' : ''; ?>>กรกฎาคม</option>
                                <option value="08" <?php echo (@$m == '08') ? 'selected' : ''; ?>>สิงหาคม</option>
                                <option value="09" <?php echo (@$m == '09') ? 'selected' : ''; ?>>กันยายน</option>
                                <option value="10" <?php echo (@$m == '10') ? 'selected' : ''; ?>>ตุลาคม</option>
                                <option value="11" <?php echo (@$m == '11') ? 'selected' : ''; ?>>พฤศจิกายน</option>
                                <option value="12" <?php echo (@$m == '12') ? 'selected' : ''; ?>>ธันวาคม</option>

                            </select>
                        </div>



                    </div>
                    <div class="col-md-5">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>เลือกปี พ.ศ.</label>
                            <select class="form-control select2" style="width: 150px;" name ="year">
                                <option selected="selected" value="2016" <?php echo (@$y == '2016') ? 'selected' : ''; ?>>2559</option>
                                <option value="2017" <?php echo (@$y == '2017') ? 'selected' : ''; ?>>2560</option>
                                <option value="2018" <?php echo (@$y == '2018') ? 'selected' : ''; ?>>2561</option>
                                <option value="2019" <?php echo (@$y == '2019') ? 'selected' : ''; ?>>2562</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-2 pull-left">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?></center>
            </div>
            <!-- /.row -->
        </div>

    </div>
    <!-- /.box -->
    <div class="row">
        <div class="col-md-12">
            <div class="box-body">

                <div id="container_chart" style="min-width: 400px; height: 350px; margin: 0 auto"></div>


            </div><!-- /.box-body -->

            <table class="table table-striped">
                <tr>
                    <th style="width: 320px">#</th>
                    <th>จำนวนการลา / วัน</th>
                    <?php
                    $this->db->order_by('id', 'asc');
                    $leavetype = $this->db->get('tbleave_type')->result_array();
                    $s_login = $this->session->userdata('s_login');
                    $user_id = $s_login['login_id'];
                    ?>

                </tr>
                <?php foreach ($leavetype AS $rs) : ?>
                
                    <tr>

                        <td><?php echo $rs['name']; ?></td>
                        <td>
                            <?php
                            $id = $rs['id'];
                            $sql = "SELECT tbleavemanage.leave_type_id ,tbleavemanage.user_id ,tbleavemanage.status FROM tbleavemanage";
                            $sql .= " WHERE tbleavemanage.leave_type_id ='$id'";
                            $sql .= " AND tbleavemanage.user_id ='$user_id' AND tbleavemanage.status = 'yes' AND tbleavemanage.dateregist like '%$y-$m%'";
                            $db = $this->db->query($sql)->num_rows();
                            echo $db;
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div><!-- box-footer -->
    </div><!-- /.box -->
</section>
<!-- /.content -->