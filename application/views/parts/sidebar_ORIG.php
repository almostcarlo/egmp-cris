<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li>
                        <a href="<?php echo BASE_URL;?>home/dashboard"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-group" aria-hidden="true"></i>
                            <span>Applicant</span>
                        </a>
                        <ul class="nav nav-children">
                            <li><a href="<?php echo BASE_URL;?>applicant/create">Add New Applicant</a></li>
                            <li><a href="<?php echo BASE_URL;?>applicant">Search Applicant</a></li>
                        </ul>
                    </li>
                    <?php if($_SESSION['rs_user']['access_level'] == 'admin'):?>
                        <li class="nav-parent">
                            <a>
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <span>Settings</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="nav-parent">
                                    <a>User Manager</a>
                                    <ul class="nav nav-children">
                                        <li><a href="<?php echo BASE_URL;?>settings/user">Search User</a></li>
                                        <li><a href="<?php echo BASE_URL;?>settings/add_user">Add User</a></li>
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a>Principal Manager</a>
                                    <ul class="nav nav-children">
                                        <li><a href="<?php echo BASE_URL;?>settings/principal">Search Principal</a></li>
                                        <li><a href="<?php echo BASE_URL;?>settings/add_principal">Add Principal</a></li>
                                    </ul>
                                </li>
                                <li class="nav-parent">
                                    <a>Company Manager</a>
                                    <ul class="nav nav-children">
                                        <li><a href="<?php echo BASE_URL;?>settings/company">Search Company</a></li>
                                        <li><a href="<?php echo BASE_URL;?>settings/add_company">Add Company</a></li>
                                    </ul>
                                </li>
                                <li class="nav">
                                    <a href="<?php echo BASE_URL;?>settings/position">Position Manager</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif;?>
                    <li>
                        <a href="<?php echo BASE_URL;?>jobs"><i class="fa fa-briefcase" aria-hidden="true"></i><span>Job Posting</span></a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL;?>announcement"><i class="fa fa-list-alt" aria-hidden="true"></i><span>Announcements</span></a>
                    </li>
                    <!--<li><a href="applicant-new.php"><i class="fa fa-plus" aria-hidden="true"></i><span>Add New Applicant</span></a></li>
                    <li><a href="index.php"><i class="fa fa-search" aria-hidden="true"></i><span>Search Applicant</span></a></li>-->
                    
                    <!--<li>
                        <a href="#"><i class="fa fa-folder-open" aria-hidden="true"></i><span>My Documents</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-comments" aria-hidden="true"></i><span>My Messages</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i><span>Job Vacancies</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bars" aria-hidden="true"></i><span>My Applied Job</span></a>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-align-left" aria-hidden="true"></i>
                            <span>Menu Levels</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a>First Level</a>
                            </li>
                            <li class="nav-parent">
                                <a>Second Level</a>
                                <ul class="nav nav-children">
                                    <li class="nav-parent">
                                        <a>Third Level</a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a>Third Level Link #1</a>
                                            </li>
                                            <li>
                                                <a>Third Level Link #2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a>Second Level Link #1</a>
                                    </li>
                                    <li>
                                        <a>Second Level Link #2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </nav>
            
        </div>

    </div>

</aside>
<!-- end: sidebar -->