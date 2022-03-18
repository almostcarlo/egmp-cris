<div class="modal fade" id="modalReportSettings" tabindex="-1" role="dialog" aria-labelledby="modalReportSettingsLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalReportSettingsLabel"><i class="fa fa-gear"></i> Report Settings</h4>

                <br>

                <div class="box-body">
                    <p><strong>Columns</strong> <a href="javascript:checkbox(1,'.chkCol','col');" id="btnCheck" class="hidden">Check All</a> <a href="javascript:checkbox(0,'.chkCol','col');" id="btnUncheck">Uncheck All</a></p>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <?php foreach($list_col as $name => $attr):?>
                                    <div class="col-sm-3">
                                        <label style="font-weight:normal;"><input type="checkbox" style="margin:0;" checked value="<?php echo $attr[0];?>" <?php echo ($attr[1]<>'')?"disabled":"class=\"chkCol\"";?> /> <?php echo $name;?></label><br/>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        
                    </div>

                    <hr>

                    <p><strong>Legend</strong> <a href="javascript:checkbox(1,'.chkRow','row');" id="btnCheckR" class="hidden">Check All</a> <a href="javascript:checkbox(0,'.chkRow','row');" id="btnUncheckR">Uncheck All</a></p>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <?php foreach($list_row as $name => $attr):?>
                                    <div class="col-sm-3">
                                        <label style="font-weight:normal;"><input type="checkbox" style="margin:0;" checked value="<?php echo $attr[0];?>" class="chkRow"/> <?php echo $name;?></label><br/>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-6">
                        <button type="button" class="btn btn-sm btn-flat btn-block btn-primary" onclick="save_report_settings();">Submit</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default btn-sm btn-block btn-flat" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>