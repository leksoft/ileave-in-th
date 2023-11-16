
<script type="text/javascript">
    $(function () {

        $("#myform").validate();

    });


</script>
<section class="content-header">
    <h1>
        ประเภทการลา
       
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>main"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
    
                </div>
                <div class="box-body">
                    <!-- form start -->
                    <?php echo form_open('Main/LeaveTypeSave', array('role' => 'form','id'=>'myform')); ?>
                     <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">ชื่อประเภท</label>
                            <input type="text" class="form-control required" id="" name ="name" placeholder="ชื่อประเภท" value="<?php echo @$row['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">URL</label>
                            <input type="text" class="form-control required" id="" name ="url" placeholder="URL ภาษาอังกฤษเท่านั้น" value="<?php echo @$row['url'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">กำหนดวันที่ลาได้</label>
                            <input type="text" class="form-control" id=""  name ="totall"placeholder="กำหนดวันที่ลาได้" value="<?php echo @$row['totall']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">รายละเอียด</label>
                            <textarea class="form-control" rows="10" name ="description" placeholder="รายละเอียด"><?php echo @$row['description']; ?></textarea>

                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-bitbucket"><i class="fa fa-save"></i> บันทึกรายการ</button>
                    </div>
                    </form>
                </div>
                <!-- /.box -->
            </div><!-- /.box-body -->

        </div><!-- /.box -->
    </div>
</div>
</section>
<!-- /.content -->