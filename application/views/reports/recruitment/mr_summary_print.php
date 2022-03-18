<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=mr_summary.xls");
        header("Cache-Control: public");
    }

    $detailed_hdr = array('IL' => 'Initial Lineup', 'FL' => 'Final Lineup', 'CL' => 'Confirmed Lineup');
    $user = getdata("select name from settings_users where username='{$mr_info[0]['add_by']}'");
?>
<h3>Manpower Request Details Form</h3>
<table class="table table-bordered" width="50%">
    <tr valign="top">
        <td width="5%"><strong>Date Recieved:</strong></td>
        <td width="25%"><?php echo dateformat($mr_info[0]['rec_date']);?></td>
        <td width="5%"><strong>Employer:</strong></td>
        <td width="35%"><?php echo $mr_info[0]['principal'];?></td>
        <td width="5%"><strong>MR Ref.:</strong></td>
        <td width="25%"><?php echo $mr_info[0]['mr_ref'];?></td>
    </tr>
    <tr valign="top">
        <td><strong>Due Date:</strong></td>
        <td><?php echo dateformat($mr_info[0]['expiry_date']);?></td>
        <td><strong>Country:</strong></td>
        <td colspan="3"><?php echo $mr_info[0]['country'];?></td>
    </tr>
</table>

<br>

<table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
    <thead>
        <tr class="title">
            <td width="10%" class="text-left"><strong>No.</strong></td>
            <td width="70%" class="text-left"><strong>Job Title</strong></td>
            <td width="10%" class="text-center"><strong>Qty.</strong></td>
            <td width="10%" class="text-center"><strong>Salary</strong></td>
        </tr>
    </thead>
    <?php if($list_pos && count($list_pos)>0):?>
        <tbody>
            <?php
                $n = 0;
                $sal_range = array();
                foreach($list_pos as $i):
                    $n += 1;

                    if($i['salary_amt'] <> '' && trim($i['salary_amt'])<>'TBA'){
                        array_push($sal_range, $i['currency_code']." ".$i['salary_amt']);
                    }
            ?>
                <tr>
                    <td class="text-left"><?php echo $n;?></td>
                    <td class="text-left"><?php echo $i['position'];?><br><small><strong><?php echo nl2br($i['jobdesc']);?></strong></small></td>
                    <td class="text-center"><?php echo $i['required'];?></td>
                    <td class="text-center"><?php echo ($i['salary_amt'] <> '' && trim($i['salary_amt'])<>'TBA')?$i['currency_code']." ".$i['salary_amt']:"";?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    <?php endif;?>
</table>

<br>

<table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
    <thead>
        <tr class="title">
            <th colspan="9" class="text-center">EMPLOYMENT TERMS AND CONDITIONS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="5%">Salary Range</td>
            <td width="40%"><?php echo reset($sal_range);?> - <?php echo end($sal_range);?></td>
            <td width="10%">Contract Duration</td>
            <td width="45%"><?php echo $mr_info[0]['contract_duration'];?></td>
        </tr>
        <tr>
            <td>Allowance</td>
            <td><?php echo $mr_info[0]['allowance'];?></td>
            <td>Working Hrs/OT</td>
            <td><?php echo $mr_info[0]['work_hrs'];?></td>
        </tr>
        <tr>
            <td>Food</td>
            <td><?php echo $mr_info[0]['food'];?></td>
            <td>Transportation</td>
            <td><?php echo $mr_info[0]['transpo'];?></td>
        </tr>
        <tr>
            <td>Accomodation</td>
            <td><?php echo $mr_info[0]['accomodation'];?></td>
            <td>Ticket</td>
            <td><?php echo $mr_info[0]['ticket'];?></td>
        </tr>
        <tr>
            <td>Fee Condition</td>
            <td><?php echo ($mr_info[0]['fee_condition']<>'')?$this->fee_cond[$mr_info[0]['fee_condition']]:"";?></td>
            <td>Others</td>
            <td><?php echo $mr_info[0]['others'];?></td>
        </tr>
    </tbody>
</table>

<table>
    <tr>
        <td colspan="3">Project Department:</td>
    </tr>
    <tr>
        <td>Prepared By:<br><br><?php echo (isset($user[0]))?$user[0]['name']:"";?></td>
        <td>Approved By:<br><br>___________________________</td>
        <td>Checked By:<br><br>___________________________</td>
    </tr>
</table>