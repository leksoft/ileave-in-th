<?php if (isset($msg)): ?>
    <script type="text/javascript">
        $(function () {
    <?php echo $msg; ?>
        });
    </script>
<?php endif; ?>
<script type="text/javascript">
    $(function () {

        $("#myform").validate();
    });


</script>
<section class="content-header">
    <h1>
        ข้อมูล <?php echo $display_role;?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Profile/UserIndex?id=<?php echo $user_id;?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <?php echo form_open_multipart('Profile/UserSave', array('role' => 'form', 'id' => 'myform')); ?>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                  
                    <input type="hidden" id="id" name="id" value="<?php echo $user_id;?>"/>
                      <input type="hidden" id="role_id" name="role_id" value="<?php echo @$row['role_id']; ?>"/>
                 
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">ประเภทผู้ใช้งาน</label>
                           <?php echo $display_role;?>
                        </div>
                        <div class="form-group">
                            <label for="">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control required" id="name" name ="name" placeholder="ชื่อ-นามสกุล" value="<?php echo @$row['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">เลขบัตรประจำตัวประชาชน</label>
                            <input type="text" class="form-control required" id="card_id" name ="card_id" placeholder="รหัสบัตรประจำตัวประชาชน" value="<?php echo @$row['card_id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">วันเดือนปีเกิด</label>
                            <input type="text" class="form-control" id="birthday" name ="birthday" placeholder="วันเดือนปีเกิด" value="<?php echo @$row['birthday']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">ตำแหน่งงาน</label>
                            <input type="text" class="form-control required" id="position" name ="position" placeholder="ตำแหน่งงาน" value="<?php echo @$row['position']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">แผนก</label>
                            <select id="depart_id" name="depart_id" class="form-control" title="เลือกแผนก !" validate="required:true">
                                <option value="">*** เลือกแผนก ***</option>
                                <?php
                                foreach ($depart as $r):
                                    $selected = ($r['depart_id'] == @$row['depart_id']) ? 'selected' : '';
                                    ?>

                                    <option value="<?php echo $r['depart_id']; ?>" <?php echo $selected; ?>><?php echo $r['depart_name']." (".$r['team_name'].")"; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">โทรศัพท์</label>
                            <input type="text" class="form-control required" id="mobile" name ="mobile" placeholder="เบอร์โทรศัพท์" value="<?php echo @$row['mobile']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">เบอร์ภายใน(ถ้ามี)</label>
                            <input type="text" class="form-control" id="tel" name ="tel" placeholder="เบอร์ติดต่อภายใน" value="<?php echo @$row['tel']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">อีเมล์ติดต่อ</label>
                            <input type="email" class="form-control required" id="email" name ="email" placeholder="อีเมล์" value="<?php echo @$row['email']; ?>">
                        </div>


                    </div>
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ข้อมูลการเข้าระบบ</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label>ชื่อเข้าใช้งาน</label>
                                <?php if ($this->uri->segment(2) == "UserIndex") : ?>

                                    <input type="text" class="form-control required" id="username" name="username" placeholder="Username" value="<?php echo @$row['username']; ?>" disabled=""><br/>
                                    <input type="hidden" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo @$row['username']; ?>">
                                <?php else : ?>
                                    <input type="text" class="form-control required" id="username" name="username" placeholder="Username" value="<?php echo @$row['username']; ?>"><br/>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>รหัสผ่าน</label>

                                <div>
                                    <?php if ($this->uri->segment(2) == "UserIndex") : ?>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <small>ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</small>
                                    <?php else : ?>
                                        <input type="password" class="form-control required" id="password" name="password" placeholder="Password">
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box -->
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-bitbucket"><i class="fa fa-save"></i> บันทึกรายการ</button>
                    </div>

                </div>
                <!-- /.box -->
            </div><!-- /.box-body -->

        </div><!-- /.box -->
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-body">
                    <div class="well well-sm">

                        <div style="text-align:center">
                            <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-left:5px;">
                                <div class="fileinput-new thumbnail">
                                    <?php if (@$row['picture'] == '') : ?>
                                        <img src="<?php echo base_url(); ?>assets/img/nophoto.jpg" alt="ภาพประจำตัว" class="img-responsive">
                                    <?php else : ?>
                                        <img src="<?php echo base_url(); ?>assets/upload/user/<?php echo @$row['picture']; ?>" alt="ภาพประจำตัว" class="img-responsive">
                                    <?php endif; ?>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                    <span class="btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-picture-o"></i> เลือกรูปประจำตัว</span><span class="fileinput-exists">เปลี่ยน</span><input type="file" name="pic_file"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info text-center">ขนาดภาพที่เหมาะสมคือ<br/>150 x 150 pixel</div>

                    </div>
                </div>
            </div> 
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</section>
<!-- /.content -->