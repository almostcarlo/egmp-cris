<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=lineup_monitoring.xls");
        header("Cache-Control: public");
    }

    $detailed_hdr = array('IL' => 'Initial Lineup', 'FL' => 'Final Lineup', 'CL' => 'Confirmed Lineup');
?>
<h3>Lineup Monitoring Report</h3>
<table class="table" width="50%">
    <tr valign="top">
        <td width="5%"><strong>Rerefence No.:</strong></td>
        <td width="20%"><?php echo $mr_info[0]['mr_ref'];?></td>
        <td width="7%"><strong>Interview Venue:</strong></td>
        <td>
            <?php
                foreach($list_sched as $s){
                    echo $s['venue']." (".dateformat($s['interview_date'],5).")<br>";
                }
            ?>
        </td>
    </tr>
    <tr valign="top">
        <td width="5%"><strong>Assigned RS:</strong></td>
        <td width="20%"><?php echo ucwords(strtolower($mr_info[0]['rs']));?></td>
    </tr>
</table>

<br>

<table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
    <tbody>
        <tr>
            <td width="60%" class="text-left"><strong>Category</strong></td>
            <td width="10%" class="text-center"><strong>Qty. Required</strong></td>
            <td width="10%" class="text-center"><strong>Initial Lineup</strong></td>
            <td width="10%" class="text-center"><strong>Final Lineup</strong></td>
            <td width="10%" class="text-center"><strong>Confirmed Lineup</strong></td>
        </tr>
        <?php
            $ttl_req = 0;
            $ttl_IL = 0;
            $ttl_FL = 0;
            $ttl_CL = 0;
            foreach($list_pos as $p){
        ?>
                <tr>
                    <td class="text-left"><?php echo $p['position'];?></td>
                    <td class="text-center"><?php echo $p['required'];?></td>
                    <td class="text-center"><?php echo (isset($list_lineup['IL'][$p['id']]))?count($list_lineup['IL'][$p['id']]):0;?></td>
                    <td class="text-center"><?php echo (isset($list_lineup['FL'][$p['id']]))?count($list_lineup['FL'][$p['id']]):0;?></td>
                    <td class="text-center"><?php echo (isset($list_lineup['CL'][$p['id']]))?count($list_lineup['CL'][$p['id']]):0;?></td>
                </tr>
        <?php
                $ttl_req += $p['required'];
                $ttl_IL += (isset($list_lineup['IL'][$p['id']]))?count($list_lineup['IL'][$p['id']]):0;
                $ttl_FL += (isset($list_lineup['FL'][$p['id']]))?count($list_lineup['FL'][$p['id']]):0;
                $ttl_CL += (isset($list_lineup['CL'][$p['id']]))?count($list_lineup['CL'][$p['id']]):0;
            }
        ?>
        <tr>
            <td class="text-left"><strong>Total</strong></td>
            <td class="text-center"><strong><?php echo $ttl_req;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_IL;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_FL;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_CL;?></strong></td>
        </tr>
    </tbody>
</table>

<br>

<table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
    <thead>
        <tr class="title">
            <th colspan="9">Report Analysis</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="20%" class="text-left"><strong>Category</strong></td>
            <td width="10%" class="text-center"><strong>Qty. Required</strong></td>
            <td width="10%" class="text-center"><strong>Total Initial Lineup</strong></td>
            <td width="10%" class="text-center"><strong>Total Final Lineup</strong></td>
            <td width="10%" class="text-center"><strong>Total Confirmed Lineup</strong></td>
            <td width="10%" class="text-center"><strong>Total Reported CL</strong></td>
            <td width="10%" class="text-center"><strong>Total Walk-in</strong></td>
            <td width="10%" class="text-center"><strong>Shortage</strong></td>
            <td width="10%" class="text-center"><strong>Excess</strong></td>
        </tr>
        <?php
            $ttl_req = 0;
            $ttl_IL = 0;
            $ttl_FL = 0;
            $ttl_CL = 0;
            $ttl_WI = 0;
            $ttl_RP = 0;
            $ttl_SH = 0;
            $ttl_EX = 0;
            foreach($list_pos as $p){
        ?>
                <tr>
                    <td class="text-left"><?php echo $p['position'];?></td>
                    <td class="text-center"><?php echo $p['required'];?></td>
                    <td class="text-center"><?php echo (isset($list_lineup['IL'][$p['id']]))?count($list_lineup['IL'][$p['id']]):0;?></td>
                    <td class="text-center"><?php echo (isset($list_lineup['FL'][$p['id']]))?count($list_lineup['FL'][$p['id']]):0;?></td>
                    <td class="text-center"><?php echo (isset($list_lineup['CL'][$p['id']]))?count($list_lineup['CL'][$p['id']]):0;?></td>
                    <!-- REPORTED -->
                    <td class="text-center"><?php echo (isset($list_lineup['RP'][$p['id']]))?count($list_lineup['RP'][$p['id']]):0;?></td>
                    <!-- WALK-IN -->
                    <td class="text-center"><?php echo (isset($list_lineup['WI'][$p['id']]))?count($list_lineup['WI'][$p['id']]):0;?></td>
                    <!-- SHORTAGE -->
                    <td class="text-center"><?php echo (isset($list_lineup['CL'][$p['id']]) && count($list_lineup['CL'][$p['id']])<$p['required'])?($p['required']-count($list_lineup['CL'][$p['id']])):0?></td>
                    <!-- EXCESS -->
                    <td class="text-center"><?php echo (isset($list_lineup['CL'][$p['id']]) && count($list_lineup['CL'][$p['id']])>$p['required'])?(count($list_lineup['CL'][$p['id']])-$p['required']):0;?></td>
                </tr>
        <?php
                $ttl_req += $p['required'];
                $ttl_IL += (isset($list_lineup['IL'][$p['id']]))?count($list_lineup['IL'][$p['id']]):0;
                $ttl_FL += (isset($list_lineup['FL'][$p['id']]))?count($list_lineup['FL'][$p['id']]):0;
                $ttl_CL += (isset($list_lineup['CL'][$p['id']]))?count($list_lineup['CL'][$p['id']]):0;
                $ttl_WI += (isset($list_lineup['WI'][$p['id']]))?count($list_lineup['WI'][$p['id']]):0;
                $ttl_RP += (isset($list_lineup['RP'][$p['id']]))?count($list_lineup['RP'][$p['id']]):0;
                $ttl_SH += (isset($list_lineup['CL'][$p['id']]) && count($list_lineup['CL'][$p['id']])<$p['required'])?($p['required']-count($list_lineup['CL'][$p['id']])):0;
                $ttl_EX += (isset($list_lineup['CL'][$p['id']]) && count($list_lineup['CL'][$p['id']])>$p['required'])?(count($list_lineup['CL'][$p['id']])-$p['required']):0;
            }
        ?>
        <tr>
            <td class="text-left"><strong>Total</strong></td>
            <td class="text-center"><strong><?php echo $ttl_req;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_IL;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_FL;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_CL;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_RP;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_WI;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_SH;?></strong></td>
            <td class="text-center"><strong><?php echo $ttl_EX;?></strong></td>
        </tr>
    </tbody>
</table>

<!-- APPLICANT DETAILS -->
<?php
    foreach($detailed_hdr as $k => $title){
        if(isset($list_lineup[$k])){
?>
            <br>
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
                <thead>
                    <tr class="title">
                        <th colspan="9"><?php echo $title;?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="3%" class="text-left"><strong>#</strong></td>
                        <td width="16%" class="text-left"><strong>Name</strong></td>
                        <td width="6%" class="text-center"><strong>Mobile No.</strong></td>
                        <td width="6%" class="text-center"><strong>Status</strong></td>
                        <td width="21%" class="text-left"><strong>Position</strong></td>
                        <td width="6%" class="text-center"><strong>Interview Date</strong></td>
                        <td width="21%" class="text-left"><strong>Internal Advisory</strong></td>
                        <td width="21%" class="text-left"><strong>Applicant Advisory</strong></td>
                    </tr>
<?php
                    $n = 1;
                    foreach($list_pos as $p){
                        if(isset($list_lineup[$k][$p['id']])){
                            foreach($list_lineup[$k][$p['id']] as $a){
                                /*ADVISORY*/
                                $int_adv = "";
                                $app_adv = "";
                                
                                if(array_key_exists($a['applicant_id'],$all_adv)){
                                    if(array_key_exists('internal',$all_adv[$a['applicant_id']])){
                                        $adv_i = reset($all_adv[$a['applicant_id']]['internal']);
                                        $int_adv = "<i>".dateformat($adv_i['add_date'],1)." ".$adv_i['add_by']."</i>: ".$adv_i['message'];
                                    }
                                }
                                
                                if(array_key_exists($a['applicant_id'],$all_adv)){
                                    if(array_key_exists('applicant',$all_adv[$a['applicant_id']])){
                                        $adv_a = reset($all_adv[$a['applicant_id']]['applicant']);
                                        $app_adv = "<i>".dateformat($adv_a['add_date'],1)." ".$adv_a['add_by']."</i>: ".$adv_a['message'];
                                    }
                                }
?>
                                <tr>
                                    <td class="text-left"><?php echo $n;?>.</td>
                                    <td class="text-left"><?php echo nameformat($a['fname'], $a['mname'], $a['lname']);?></td>
                                    <td class="text-center"><?php echo $a['mobile_no'];?></td>
                                    <td class="text-center"><?php echo $a['status'];?></td>
                                    <td class="text-left"><?php echo $p['position'];?></td>
                                    <td class="text-center"><?php echo ($k=='IL')?"N/A":dateformat($a['interview_date'],5);?></td>
                                    <td class="text-left"><?php echo $int_adv;?></td>
                                    <td class="text-left"><?php echo $app_adv;?></td>
                                </tr>
<?php
                                $n++;
                            }
                        }
                    }
?>
                </tbody>
            </table>
<?php
        }
    }
?>
<!-- END APPLICANT DETAILS -->

<p><small><strong>Qty. Required</strong> - Number of manpower requirement.</small><br>
<small><strong>Initial Lineup</strong> - Total initial line up from databank, line up is subject for confirmation.</small><br>
<small><strong>Final Lineup</strong> - Total final line up candidates who are confirmed and were confirmed for the line up; applicants here are subject for interview scheduling and waiting for confirmation.</small><br>
<small><strong>Confirmed Lineup</strong> - Total number of applicants who are confirmed with the given interview schedule.</small><br>
<small><strong>Reported CL</strong> - Total number of applicants from CL who reported for client interview; applicant’s names are reflected in the FOR CLIENT INTERVIEW form until the interview result has been updated.</small><br>
<small><strong>Walk-In</strong> - Total number of applicants who reported for interview other than those applicants from CL and those newly lined up applicants for the day who were endorsed for client interview.</small><br>
<small><strong>Shortage</strong> - Computes the shortage of line up from the formula quantity required less quantity of total confirmed LU.</small><br>
<small><strong>Excess</strong> - Computes the number of excess line up from the formula total confirmed LU less quantity required.</small></p>