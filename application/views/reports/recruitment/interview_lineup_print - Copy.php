<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=interview_lineup_sheet.xls");
        header("Cache-Control: public");
    }

    $detailed_hdr = array('IL' => 'Initial Lineup', 'FL' => 'Final Lineup', 'CL' => 'Confirmed Lineup');
?>
<h3>Interview Line-up Sheet per MR</h3>
<table class="table table-bordered" width="50%">
    <tr valign="top">
        <td width="5%"><strong>Employer:</strong></td>
        <td width="35%"><?php echo $mr_info[0]['principal'];?></td>
        <td width="5%"><strong>Date Recieved:</strong></td>
        <td width="25%"><?php echo dateformat($mr_info[0]['rec_date']);?></td>
        <td width="5%"><strong>MR Ref.:</strong></td>
        <td width="25%"><?php echo $mr_info[0]['mr_ref'];?></td>
    </tr>
    <tr valign="top">
        <td><strong>Jobsite:</strong></td>
        <td><?php echo $mr_info[0]['country'];?></td>
        <td><strong>Interview Date:</strong></td>
        <td colspan="3"><?php echo ($_POST['selectSched']=='')?"All":dateformat($list_sched[0]['interview_date']);?></td>
    </tr>
</table>

<br>

<table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
    <thead>
        <tr class="title">
            <td width="60%" class="text-left"><strong>Name of Applicant</strong></td>
            <td width="10%" class="text-center"><strong>Status</strong></td>
            <td width="10%" class="text-center"><strong>Interview Date</strong></td>
            <td width="10%" class="text-center"><strong>Contact No</strong></td>
            <td width="10%" class="text-center"><strong>Salary</strong></td>
            <td width="10%" class="text-center"><strong>Rqmts</strong></td>
            <td width="10%" class="text-center"><strong>Sent</strong></td>
            <td width="10%" class="text-center"><strong>Balance</strong></td>
            <td width="10%" class="text-center"><strong>Selected</strong></td>
        </tr>
    </thead>
    <?php if($list_pos && count($list_pos)>0):?>
        <tbody>
            <?php
                $n = 0;
                foreach($list_pos as $p):
                    $n += 1;
            ?>
                <tr>
                    <td class="text-left" colspan="4"><strong><?php echo $n.". ".$p['position'];?></strong></td>
                    <td class="text-center"><strong><?php echo $p['salary'];?></strong></td>
                    <td class="text-center"><strong><?php echo $p['required'];?></strong></td>
                    <td class="text-center"><strong>[sent]</strong></td>
                    <td class="text-center"><strong>[bal]</strong></td>
                    <td class="text-center"><strong>[selected]</strong></td>
                </tr>
                <?php if(array_key_exists($p['id'], $list_lineup) && count($list_lineup[$p['id']])>0):?>
                    <?php foreach($list_lineup[$p['id']] as $a):?>
                        <tr>
                            <td class="text-left"><?php echo nameformat($a['fname'], $a['mname'], $a['lname']);?></td>
                            <td class="text-center">LINED-UP</td>
                            <td class="text-center"><?php echo dateformat($a['interview_date']);?></td>
                            <td class="text-center"><?php echo $a['mobile_no'];?></td>
                            <td class="text-center"><?php echo $a['mob_result'];?></td>
                            <td class="text-left" colspan="4"><?php echo $a['mob_remarks']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
                <tr><td colspan="10">&nbsp;</td></tr>
            <?php endforeach;?>
        </tbody>
    <?php endif;?>
</table>

<table>
    <tr>
        <td colspan="3">MR Assigned to:<br><br><?php echo $mr_info[0]['rs'];?></td>
        <td>Prepared By:<br><br><?php echo $_SESSION['rs_user']['name'];?></td>
    </tr>
</table>