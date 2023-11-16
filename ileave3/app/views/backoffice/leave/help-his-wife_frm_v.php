<?php if (isset($msg)): ?>
    <script type="text/javascript">
        $(function () {
    <?php echo $msg; ?>
        });
    </script>
<?php endif; ?>
<script>
    $(function () {


        $("#myform").validate({
            onkeyup: false
        });
        $.metadata.setType("attr", "validate");
        //Datemask dd/mm/yyyy
        $("#datefrom").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        $("#dateto").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Date picker
        $('#datefrom').datepicker({
            autoclose: true, format: 'yyyy-mm-dd'
        });
         $('#date_newbihelp').datepicker({
            autoclose: true, format: 'yyyy-mm-dd'
        });
        $('#dateto').datepicker({
            autoclose: true, format: 'yyyy-mm-dd'
        });

        $(".select2").select2();
        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
    function save() {

        if (($('#dateto').val()) <= ($('#datefrom').val())) {
            $.msgGrowl({
                type: 'warning'
                , title: 'ไม่สามารถบันทึกการลาได้'
                , text: 'ช่อง ถึงวันที่ ต้องมีค่ามากกว่า ช่อง ตั้งแต่วันที่'
                , position: 'bottom-center'

            });
        } else {
            $('#myform').submit();
        }
        return false;
    }

</script>


<!-- Content Header (Page header) -->
<section class="content-header">

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<br/>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"> <?php echo $page_title; ?>	</h3>
                    <br/>
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
                    <?php echo form_open('formleave/save', array('id' => 'myform')); ?>
                    <input type="hidden" name="leave_type_id" value="<?php echo @$row_leave_type['id']; ?>"/>

                    <div class="col-md-6">
                        <div class="box box-success">

                            <div class="form-group">
                                <label>เขียนที่ <span class="required">*</span></label>

                                <input type="text"  class="form-control required" id="writing" name ="writing" value="">

                            </div>
                            <div class="form-group">
                                <label>เรื่อง</label>

                                <input type="text"  class="form-control required" id="title" name ="title" value="ขอ<?php echo @$row_leave_type['name']; ?>">

                            </div>
                            <div class="form-group">
                                <label>เนื่องจาก</label>

                                <textarea cols="3" rows="3" class="form-control required"  id="comment" name ="comment"></textarea>

                            </div>
                            <div class="form-group">
                                <label>เรียน <span class="required">*</span></label>

                                <input type="text" class="form-control required" id="president" name ="president">

                            </div>

                            <div class="form-group">
                                <label>ข้าพเจ้า</label>

                                <input type="text" class="form-control required" disabled="" id="member_name" value="<?php echo @$row_member['name']; ?>">

                            </div>

                            <div class="form-group">
                                <label>ตำแหน่ง</label>

                                <input type="text" class="form-control required" disabled=""id="position" value="<?php echo @$row_member['position']; ?>">

                            </div>
                            <div class="form-group">
                                <label>สังกัดแผนก</label>


                                <input type="text" class="form-control required" disabled=""id="position" value="<?php echo $person_m->display_depart(@$row_member['depart_id']); ?>">


                            </div>
                            <div class="form-group">
                                <label>เลือกช่วงเวลา <small>หากไม่เลือก จะถูกกำหนดเป็นเต็มวันอัตโนมัติ</small></label>
                                <select class="form-control required select2 " name="timerang" title="เลือกช่วงเวลา !" validate="required:true">
                                    <option selected="selected" value="08:30-16:30">---เลือกช่วงเวลา---</option>
                                    <option value="08:30-16:30">เต็มวัน</option>
                                    <option value="08:30-12:00">ครึ่งวันเช้า</option>
                                    <option value="12:00-16:30">ครึ่งวันบ่าย</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>ตั้งแต่วันที่ <span class="required">*</span></label>

                                <input class="form-control required" id="datefrom" type="text" name ="datefrom" value="">

                            </div>
                            <div class="form-group">
                                <label>ถึงวันที่ <span class="required">*</span></label>

                                <input class="form-control required" id="dateto" type="text" name ="dateto" value="">

                            </div>
                             <div class="form-group">
                                <label>ชื่อภริยาโดยชอบตามกฎหมาย <span class="required">*</span></label>

                                <input type="text" class="form-control required"  id="newbihelp" name ="newbihelp" value="<?php echo @$row_member['newbihelp']; ?>">

                            </div>
                            
                             <div class="form-group">
                                <label>ซึ่งคลอดบุตรเมื่อวันที่ <span class="required">*</span></label>

                                <input type="text" class="form-control required"  id="date_newbihelp" name="date_newbihelp" value="<?php echo @$row_member['date_newbihelp']; ?>">

                            </div>
                            
                             
                            
                            
                            <div class="form-group">
                                <label>ในระหว่างลาจะติดต่อข้าพเจ้าได้ที่ <span class="required">*</span></label>

                                <textarea cols="3" rows="3"  id="address" class="form-control required" name ="address"></textarea>

                            </div>
                            <div class="form-group">
                                <label>โทร</label>

                                <input type="text" disabled=""class="form-control" value="<?php echo @$row_member['mobile']; ?>">

                            </div>
                            <div class="form-group">
                                <label></label>

                                <button  onclick="return save();" class="btn btn-google btn-large">บันทึกการลา</button>

                            </div>
                            <div style="color : red;">

                                <h4 class="alert-heading">คำเตือน!</h4>
                                โปรดตรวจสอบข้อมูลว่าถูกต้องแล้ว ก่อนกดปุ่ม บันทึกการลา
                            </div> <!-- ./alert -->
                        </div> <!-- /span6 -->


                    </div> <!-- /row-fluid -->
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="well">
                                <h4>แนวปฎิบัติและระเบียบการลาที่ควรทราบสำหรับผู้ลา</h4>
                                <hr/>
                                <p><?php echo @$row_leave_type['description']; ?></p>

                            </div>


                        </div> <!-- /span6 -->
                    </div>
                    <?php echo form_close(); ?>
                </div> <!-- /step -->

            </div> <!-- /wizard -->

        </div><!-- /.box-body -->
        <div class="box-footer">
         
        </div><!-- box-footer -->
    </div><!-- /.box -->

</section>
<!-- /.content --> 
