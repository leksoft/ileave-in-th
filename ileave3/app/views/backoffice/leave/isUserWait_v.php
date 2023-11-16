<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th width ="110px"></th>
            <th width ="100px">สถานะ</th>
            <th width ="180px">วันที่ลา</th>
            <th>เรื่อง</th>
            <th width ="110px">จำนวนวันลา</th>
            <th width ="110px">วันที่ทำรายการ</th>

        </tr>
    </thead>
    <tbody>

        <?php
        $irow = 0;
        $i = $this->uri->segment(2) + 1;
        foreach ($query as $r) {
            $irow++;
            $id = $r['id'];
            ?>
            <tr>
                <td class="">
                    <div class="btn-group">

                        <button type="button" class="btn btn-xs btn-dropbox dropdown-toggle" data-toggle="dropdown">
                            จัดการ <span class="fa fa-cogs"></span> 
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">

                            <?php if ($r['status'] == 'disapproval' || $r['status'] == 'cancel' || $r['status'] == 'approve') { ?>
                                <li><a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId='.$r['id']);?>"><i class="fa fa-eye"></i> ดูรายละเอียด</a></li>

                            <?php } else { ?>
                                <li><a href="<?php echo base_url('Formleave/LeaveProfile?LeaveId='.$r['id']);?>"><i class="fa fa-eye"></i> ดูรายละเอียด</a></li>
                                <li><a href = "<?php echo base_url('Formleave/CancelLeave?id=' . $r['id']); ?>"  onClick="javascript:return confirm('คุณต้องการยกเลิกการลาใช่หรือไม่');" ><i class="fa fa-trash-o"></i> ยกเลิกการลา</a></li>

                            <?php } ?>
                        </ul>
                    </div>

                </td>
                <td class=""><a href="">
                        <?php echo $leave_m->display_LeaveStatus($r['status']); ?>
                    </a></td>
                <td class="mailbox-name">
                    <?php echo $mydate->dateThaiLong($r['datefrom']) . ' - ' . $mydate->dateThaiLong($r['dateto']); ?>
                </td>
                <td class="mailbox-subject"><b><?php echo $r['title']; ?></b><br/> - <?php echo $r['comment']; ?>
                </td>
                <td class=""><?php echo number_format($r['amountdate']); ?> (<?php echo $r['timerang']; ?>)</td>
                <td class="mailbox-date"><?php echo $mydate->dateThaiLong($r['dateregist']); ?></td>
            </tr>
            <?php
        }
        if ($irow == 0) {
            echo "<tr><td colspan='6' class='center'>*** ไม่พบข้อมูลการลาของคุณ ***</td></tr>";
        }
        ?>
    </tbody>
</table>