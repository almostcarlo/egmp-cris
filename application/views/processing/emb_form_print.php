<!doctype html>
<html class="fixed">
    <head>
    
        <!-- Basic -->
        <meta charset="UTF-8">
        
        <title><?php echo PROGRAM_NAME;?></title>
        <meta name="keywords" content="recruitment, system, recruitment system" />
        <meta name="description" content="<?php echo PROGRAM_NAME;?>">
        <meta name="author" content="Karl Gerald Saul | JSOFT.net">
        
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        
        <link rel="shortcut icon" href="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_ICON;?>"/>
        
        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        
        <!-- Vendor CSS -->
        <!-- <link rel="stylesheet" href="<?php echo BASE_URL;?>public/stylesheets/print.css" /> -->
    </head>
    <body class="print">
    
        <table class="table border-less" cellspacing="0" width="100%">
        
            <thead>
                <tr>
                    <th align="left"><img src="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_LOGO;?>" /></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <style>
                            /*body { font-family: verdana, Arial, Helvetica, sans-serif; font-size:14px;}*/
                            /*td { font-family: verdana, arial, Helvetica, sans-serif; font-size:16px;}*/
                            .big { font-family: verdana, arial, Helvetica, sans-serif; font-size:18px;}
                            .bigger { font-family: verdana, arial, Helvetica, sans-serif; font-size:20px;}
                            .med { font-family: verdana, arial, Helvetica, sans-serif; font-size:16px;}
                            .def { font-family: verdana, arial, Helvetica, sans-serif; font-size:13px;}
                            .td_br {height:40px;}
                        </style>
                        <table border="0" cellpadding="0" cellspacing="0" width="99%">
                            <tr>
                                <td width="50%" class="bigger">
                                    Date / <u><?=date("F d, Y", strtotime("tomorrow"))?></u>
                                </td>
                                <td width="50%" class="bigger">
                                    Sponsor Information
                                </td>
                            </tr>
                            <tr class="td_br">
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <table cellpadding="3" cellspacing="0" class="tbl_sponsor" width="80%" border="1">
                                        <tr>
                                            <td width="20%" class="med" align="center"><b>Agency<br>Box No.</b></td>
                                            <td width="20%" class="med"><b>NAME</b></td>
                                            <td width="65%" class="med"><?php echo $info[0]['principal'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="med" rowspan="3" align="center" style="font-size:25px;">&nbsp;<b><?php echo AGENCY_BOX_NO;?></b></td>
                                            <td class="med"><b>VISA</b></td>
                                            <td class="med"><?php echo $info[0]['visa_no'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="med"><b>SPONSOR ID</b></td>
                                            <td class="med"><?php echo $info[0]['sponsor_no'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="med"><b>AUTH</b></td>
                                            <td class="med"><?php echo $info[0]['transmittal_auth'];?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="td_br">
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="bigger">Care of the Consular Section,</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="bigger">Royal Embassy of Saudi Arabia - Manila</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="bigger">Enclosed the agency requesting for VISA Issuance</td>
                            </tr>
                            <tr class="td_br">
                                <td>&nbsp;</td>
                            </tr>
                            <tr align="center">
                                <td colspan="2" class="bigger"><u>Applicant</u></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table border="1" width="100%" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td class="def" align="center" width="22%"><b>Name</b></td>
                                            <td class="def" align="center" width="22%"><b>Category</b></td>
                                            <td class="def" align="center" width="8%"><b>Passport#</b></td>
                                            <td class="def" align="center" width="22%"><b>Clinic</b></td>
                                            <td class="def" align="center" width="8%"><b>Religion</b></td>
                                            <td class="def" align="center" width="8%"><b>E-Code</b></td>
                                        </tr>
                                        <tr>
                                            <td class="def" align="left"><?php echo nameformat($info[0]['fname'], $info[0]['mname'], $info[0]['lname'],1);?></td>
                                            <td class="def" align="left"><?php echo $info[0]['visa_cat'];?></td>
                                            <td class="def" align="center"><?php echo $info[0]['ppt_no'];?></td>
                                            <td class="def" align="left"><?php echo $info[0]['clinic'];?></td>
                                            <td class="def" align="center"><?php echo $info[0]['religion'];?></td>
                                            <td class="def" align="center"><?php echo $info[0]['transmittal_ecode'];?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="td_br">
                                <td>&nbsp;</td>
                            </tr>
                            <tr align="center">
                                <td colspan="2" class="bigger"><u>Checking & Remarks</u></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" style="border:solid 1px;">
                                    <table border="0" width="100%" cellpadding="5" cellspacing="0" style="font-family: verdana, arial, Helvetica, sans-serif; font-size:10px;">
                                        <tr>
                                            <td align="right" width="14%">Diploma<input type="checkbox" />__</td>
                                            <td align="right" width="20%">Islam Certificate<input type="checkbox" />__</td>
                                            <td align="right" width="16%">Visa<input type="checkbox" checked="checked" />__</td>
                                            <td align="right" width="16%">No Medical<input type="checkbox" />__</td>
                                            <td align="right" width="16%">NBI<input type="checkbox" checked="checked" />__</td>
                                            <td align="center" width="18%">Remarks</td>
                                        </tr>
                                        <tr>
                                            <td align="right">Contract<input type="checkbox" checked="checked" />__</td>
                                            <td align="right">Passport Validity<input type="checkbox" />__</td>
                                            <td align="right">Request<input type="checkbox" checked="checked" />__</td>
                                            <td align="right">Medical Exp<input type="checkbox" />__</td>
                                            <td align="right">No Sticker<input type="checkbox" />__</td>
                                            <td align="left" rowspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="right">OEC<input type="checkbox" />__</td>
                                            <td align="right">Over/Under,Age<input type="checkbox" />__</td>
                                            <td align="right">E-Code<input type="checkbox" checked="checked" />__</td>
                                            <td align="right">Unfit Med.<input type="checkbox" />__</td>
                                            <td align="right">Exp Visa<input type="checkbox" />__</td>
                                        </tr>
                                        <tr>
                                            <td align="right">LTO<input type="checkbox" />__</td>
                                            <td align="right">No Authority<input type="checkbox" />__</td>
                                            <td align="right">Transmittal<input type="checkbox" checked="checked" />__</td>
                                            <td align="right">Coded Other<input type="checkbox" />__</td>
                                            <td align="right">R._____<input type="checkbox" />__</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="td_br">
                                <td>&nbsp;</td>
                            </tr>
                            <!-- <tr class="td_br">
                                <td colspan="2" class="bigger">&nbsp;</td>
                            </tr> -->
                            <tr class="td_br">
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table border="0" cellpadding="3" cellspacing="0" width="95%">
                                        <tr>
                                            <td class="med" width="40%"><b><?php echo SIGNATORY_2;?>&nbsp;&nbsp;<!-- / --></b></td>
                                            <td class="med" width="60%"><!-- <b><?php echo SIGNATORY_2;?></b> -->&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="med"><?php echo SIGNATORY_POS_2;?></td>
                                            <td class="med"><!-- <?php echo SIGNATORY_POS_2;?> -->&nbsp</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td align="left" width="15%"><font size="1px">Enclosed</font></td>
                                            <td align="left">
                                                <font size="1px">ORIGINAL COPY of Consular Letter and E-Visa Authority</font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left"><font size="1px">Reference No.</font></td>
                                            <td align="left"><font size="1px"><?php echo $info[0]['visa_no'];?></font></td>
                                        </tr>
                                        <tr>
                                            <td align="left"><font size="1px">Transmittal No.</font></td>
                                            <td align="left"><font size="1px"><?php echo $info[0]['transmittal_no'];?></font></td>
                                        </tr>               
                                    </table>    
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

    </body>
</html>