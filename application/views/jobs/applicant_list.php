<section class="panel">
    <div class="panel-body scroll">

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title"><?php echo strtoupper($info[0]['principal']);?></h4>
                    <?php if(MR_REQUIRED):?>
                        <h4 class="modal-"><?php echo strtoupper($info[0]['mr_ref']);?></h4>
                    <?php endif;?>
                    <h4 class="modal-"><?php echo strtoupper($info[0]['position']);?></h4>
                </div>
            </div>
        
            <div class="table-responsive">
                <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchJobs">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="50%">Name</th>
                            <th width="20%">Status</th>
                            <th width="20%">Date of Application</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($list)>0):?>
                            <?php
                                $n = 1;
                                foreach($list as $i){
                            ?>
                                    <tr>
                                        <td><?php echo $n?>.</td>
                                        <td><a href="<?php echo BASE_URL?>profile/<?php echo $i['id'];?>/lineup" target="_blank"><?php echo nameformat($i['fname'],$i['mname'],$i['lname']);?></a></td>
                                        <td><?php echo $i['status'];?></td>
                                        <td><?php echo dateformat($i['add_date'],5);?></td>
                                    </tr>
                            <?php
                                    $n++;
                                }
                            ?>
                        <?php else:?>
                            <tr>
                                <td colspan="10"><span class="required">No record found.</span></td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <!-- <a href=""></a> -->
                    <input type="button" class="btn btn-block btn-danger" onclick="$.facebox.close();" value="Close">
                </div>
            </div>

        </form>
        
    </div>
</section>