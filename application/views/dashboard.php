<!doctype html>
<html class="fixed">

    <?php include APPPATH.'views/parts/head.php'; ?>
	
	<body>
		<section class="body">
    
            <?php include APPPATH.'views/parts/header.php'; ?>

			<div id="dashboard" class="inner-wrapper">
    
				<section class="container-fluid">
                
                    <div class="row">
                    
                        <div class="col-md-9 col-sm-8">
                            
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h1 class="total-number no-mb"><?php echo $_SESSION['rs_dashboard']['total_applicant'];?></h1>Total No. of Applicants
                                </div>
                                <div class="col-md-4 text-center">
                                    <h1 class="total-number no-mb"><?php echo $_SESSION['rs_dashboard']['total_deployed'];?></h1>Total No. of Deployed Applicants
                                </div>
                                <div class="col-md-4 text-center">
                                    <h1 class="total-number no-mb"><?php echo $_SESSION['rs_dashboard']['total_jobs'];?></h1>Total No. of Active Jobs
                                </div>
                            </div>
                            
                            <hr />
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <section class="panel panel-transparent">
                                        <header class="panel-heading">
                                            <div class="panel-heading-icon bg-green mt-sm">
                                                <a href="<?php echo BASE_URL;?>applicant/create"><img src="<?php echo BASE_URL;?>public/images/icons/applicant.png" class="dashboard-icon" /></a>
                                            </div>
                                        </header>
                                        <div class="panel-body">
                                            <h3 class="mt-none text-center dashboard-title"><a href="<?php echo BASE_URL;?>applicant/create">Add Applicant</a></h3>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-3">
                                    <section class="panel panel-transparent">
                                        <header class="panel-heading">
                                            <div class="panel-heading-icon bg-green mt-sm">
                                                <a href="<?php echo BASE_URL;?>applicant"><img src="<?php echo BASE_URL;?>public/images/icons/search.png" class="dashboard-icon" /></a>
                                            </div>
                                        </header>
                                        <div class="panel-body">
                                            <h3 class="mt-none text-center dashboard-title"><a href="<?php echo BASE_URL;?>applicant">Search Applicant</a></h3>
                                        </div>
                                    </section>
                                </div>
                                <?php if($_SESSION['rs_user']['access_level'] == 'admin'):?>
                                    <div class="col-md-3">
                                        <section class="panel panel-transparent">
                                            <header class="panel-heading">
                                                <div class="panel-heading-icon bg-green mt-sm">
                                                    <a href="<?php echo BASE_URL;?>settings/add_user"><img src="<?php echo BASE_URL;?>public/images/icons/user.png" class="dashboard-icon" /></a>
                                                </div>
                                            </header>
                                            <div class="panel-body">
                                                <h3 class="mt-none text-center dashboard-title"><a href="<?php echo BASE_URL;?>settings/add_user">Add User</a></h3>
                                            </div>
                                        </section>
                                    </div>
                                
                                    <div class="col-md-3">
                                        <section class="panel panel-transparent">
                                            <header class="panel-heading">
                                                <div class="panel-heading-icon bg-green mt-sm">
                                                    <a href="<?php echo BASE_URL;?>settings/add_principal"><img src="<?php echo BASE_URL;?>public/images/icons/principal.png" class="dashboard-icon" /></a>
                                                </div>
                                            </header>
                                            <div class="panel-body">
                                                <h3 class="mt-none text-center dashboard-title"><a href="<?php echo BASE_URL;?>settings/add_principal">Add Principal</a></h3>
                                            </div>
                                        </section>
                                    </div>
                                <?php endif;?>
                            <!-- </div>

                            <div class="row"> -->
                                <!-- <div class="col-md-3 col-md-offset-3"> -->
                                <?php if($_SESSION['rs_user']['menu'] && array_key_exists(3,$_SESSION['rs_user']['menu'][1][0])):?>
                                    <div class="col-md-3">
                                        <section class="panel panel-transparent">
                                            <header class="panel-heading">
                                                <div class="panel-heading-icon bg-green mt-sm">
                                                    <a href="<?php echo BASE_URL;?>jobs"><img src="<?php echo BASE_URL;?>public/images/icons/job-posting.png" class="dashboard-icon" /></a>
                                                </div>
                                            </header>
                                            <div class="panel-body">
                                                <h3 class="mt-none text-center dashboard-title"><a href="<?php echo BASE_URL;?>jobs">Job Posting</a></h3>
                                            </div>
                                        </section>
                                    </div>
                                <?php endif;?>
                                
                                <?php if($_SESSION['rs_user']['menu'] && array_key_exists(4,$_SESSION['rs_user']['menu'][1][0])):?>
                                    <div class="col-md-3">
                                        <section class="panel panel-transparent">
                                            <header class="panel-heading">
                                                <div class="panel-heading-icon bg-green mt-sm">
                                                    <a href="<?php echo BASE_URL;?>announcement"><img src="<?php echo BASE_URL;?>public/images/icons/news.png" class="dashboard-icon" /></a>
                                                </div>
                                            </header>
                                            <div class="panel-body">
                                                <h3 class="mt-none text-center dashboard-title"><a href="<?php echo BASE_URL;?>announcement">News &amp; Announcements</a></h3>
                                            </div>
                                        </section>
                                    </div>
                                <?php endif;?>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <section class="panel panel-featured panel-featured-success">
                                        <header class="panel-heading">
                                            <h2 class="panel-title">New Applicants</h2>
                                        </header>
                                        <div class="panel-body">

                                            <section id="sectionNewApplicant">
                                            
                                            	<?php if($latest_applicants):?>
                                            		<?php foreach ($latest_applicants as $info):?>
                                            			<?php
                                            			    if($info['position']){
                                            			        $pos_info = explode('|', $info['position']);
                                            			        $position = character_limiter(ucwords(strtolower($pos_info[0])),35)." / ";
                                                            }else{
                                                                $position = "";
                                                            }
                                            			?>
                                                        <div class="alert alert-success">
                                                            <a href="<?php echo BASE_URL;?>profile/<?php echo $info['id'];?>"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 2)?></a> - <?php echo $position;?><?php echo getAge($info['birthdate']);?> years old. <?php echo $info['city'].", ".$info['province'];?>
                                                        </div>
                                            		<?php endforeach;?>
                                            		
                                            		<a href="<?php echo BASE_URL;?>applicant">View All Aplicants</a>
                                            	<?php else:?>
                                                    <div class="alert alert-success">
                                                        No record found
                                                    </div>
                                            	<?php endif;?>
                                            </section>
                                            
                                        </div>
                                    </section>
                                </div>
                                
                                <div class="col-md-6">
                                    <section class="panel panel-featured panel-featured-info">
                                        <header class="panel-heading">
                                            <h2 class="panel-title">Job Openings</h2>
                                        </header>
                                        <div class="panel-body">
                                            
                                            <section id="sectionJobOpenings">
                                            	<?php if($latest_jobs):?>
                                            		<?php foreach ($latest_jobs as $info):?>
                                                        <div class="alert alert-info">
                                                            <a href="#"><?php echo ucwords(strtolower($info['position']));?></a> - <?php echo ucwords(strtolower($info['principal']));?>, <?php echo ucwords(strtolower($info['country']));?>
                                                        </div>
                                            		<?php endforeach;?>

                                                	<a href="<?php echo BASE_URL;?>jobs">View All Job Openings</a>
                                            	<?php else:?>
                                                    <div class="alert alert-success">
                                                        No record found
                                                    </div>
                                                <?php endif;?>
                                                
                                            </section>
                                            
                                        </div>
                                    </section>
                                </div>
                                
                            </div>
                            
                        </div>
                    
                        <div class="col-md-3 col-sm-4">
                            <?php if(MR_REQUIRED):?>
                                <!-- INTERVIEW SCHED -->
                                <section class="panel panel-featured">
                                    <header class="panel-heading">
                                        <h2 class="panel-title">Schedule of Interview<!-- /PRA --></h2>
                                        <a href="<?php echo BASE_URL;?>recruitment/calendar"><small><?php echo date("l, jS \of F, Y");?></small></a>
                                    </header>
                                    <div class="panel-body">
                                        
                                        <section id="sectionUserRecentActivity">
                                            <?php if($sched_today):?>
                                                <?php foreach ($sched_today as $info):?>
                                                    <div class="alert alert-default">
                                                        <?php echo strtoupper($info['principal']);?>
                                                        <br>
                                                        MR Reference: <?php echo $info['mr_ref'];?>
                                                        <br>
                                                        Venue: <?php echo ucwords(strtolower($info['venue']));?>
                                                    </div>
                                                <?php endforeach;?>
                                            <?php else:?>
                                                <div class="alert alert-default">
                                                    No schedule for today.
                                                </div>
                                            <?php endif;?>
                                            <a href="<?php echo BASE_URL;?>recruitment/calendar">View Calendar</a>
                                        </section>
                                        
                                    </div>
                                </section>
                            <?php else:?>
                                <!-- LOGS -->
                                <section class="panel panel-featured">
                                    <header class="panel-heading">
                                        <h2 class="panel-title">Recent Activity</h2>
                                    </header>
                                    <div class="panel-body">
                                        
                                        <section id="sectionUserRecentActivity">
                                            <?php if($latest_logs):?>
                                                <?php foreach ($latest_logs as $info):?>
                                                    <div class="alert alert-default">
                                                        <?php echo $info['action'];?> - <?php echo character_limiter($info['remarks'],20);?> [Applicant No.: <?php echo $info['applicant_id'];?>] <?php echo date("M d, Y h:ia", strtotime($info['add_date']));?>
                                                    </div>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </section>
                                        
                                    </div>
                                </section>
                            <?php endif;?>
                            
                        </div>
                    
                    </div>
                    
                </section>
                
			</div>
            
		</section>
    
		<?php include APPPATH.'views/parts/script.php'; ?>
        
	</body>
</html>