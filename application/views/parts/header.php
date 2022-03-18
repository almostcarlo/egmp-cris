<?php
    if($_SESSION['rs_user']['picture'] <> ''){
        $hdr_picture = BASE_URL."home/my_profile_pic";
    }else{
        $hdr_picture = BASE_URL."public/images/!logged-user.jpg";
    }
?>
<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="<?php echo BASE_URL;?>home/dashboard" class="logo">
            <img src="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_LOGO;?>" height="38" alt="<?php echo PROGRAM_NAME;?>" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <form action="pages-search-results.html" class="search nav-form hidden">
            <div class="input-group input-search">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="<?php echo $hdr_picture;?>" class="img-circle" data-lock-picture="<?php echo BASE_URL;?>public/images/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="">
                    <span class="name"><?php echo $_SESSION['rs_user']['name']?></span>
                    <span class="role"><?php echo $_SESSION['rs_user']['position']?></span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <!--<li>
                        <a role="menuitem" tabindex="-1" href="applicant-profile.html"><i class="fa fa-user"></i> My Profile</a>
                    </li>-->

                    <li>
                        <a role="menuitem" tabindex="-1" href="<?php echo BASE_URL;?>change-photo"><i class="fa fa-user"></i> Change Photo</a>
                    </li>

                    <li>
                        <a role="menuitem" tabindex="-1" href="<?php echo BASE_URL;?>change-password"><i class="fa fa-lock"></i> Change Password</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="<?php echo BASE_URL;?>logout/"><i class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->