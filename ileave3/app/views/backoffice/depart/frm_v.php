
<script type="text/javascript">
    $(function () {

        $("#myform").validate();

    });


</script>
<section class="content-header">
    <h1>
        ข้อมูลแผนก
       
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
                    <?php echo form_open('Main/DepartSave', array('role' => 'form','id'=>'myform')); ?>
                     <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">แผนก</label>
                            <input type="text" class="form-control required" id="" name ="name" placeholder="แผนก" value="<?php echo @$row['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">สังกัดหน่วยงาน</label>
                            
                            <select id="team_id" name="team_id" class="form-control" title="เลือกหน่วยงาน !" validate="required:true">
                            <option value="">*** เลือกหน่วยงาน ***</option>
                            <?php
                            foreach ($team as $r):
                                $selected = ($r['id'] == @$row['team_id']) ? 'selected' : '';
                                ?>

                                <option value="<?php echo $r['id']; ?>" <?php echo $selected; ?>><?php echo $r['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
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