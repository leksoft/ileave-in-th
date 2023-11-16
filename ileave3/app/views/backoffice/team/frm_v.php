
<script type="text/javascript">
    $(function () {

        $("#myform").validate();

    });


</script>
<section class="content-header">
    <h1>
        ข้อมูลหน่วยงาน
       
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
                    <?php echo form_open('Main/TeamSave', array('role' => 'form','id'=>'myform')); ?>
                     <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">หน่วยงาน</label>
                            <input type="text" class="form-control required" id="" name ="name" placeholder="หน่วยงาน" value="<?php echo @$row['name']; ?>">
                        </div>
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="" class="btn btn-flat btn-bitbucket"><i class="fa fa-save"></i> Demo Version</button>
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