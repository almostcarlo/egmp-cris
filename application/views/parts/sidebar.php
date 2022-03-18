<?php
    $base_url = BASE_URL;
?>
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
                    <?php
                        if($_SESSION['rs_user']['menu']){
                            foreach ($_SESSION['rs_user']['menu'][1] as $p1 => $data1){
                                foreach ($data1 as $id1 => $v1){
                                    if(isset($_SESSION['rs_user']['menu'][2][$id1])){
                                        /* WITH SUBMENU */
                                        echo "<li class=\"nav-parent\">
                                                <a>
                                                    <i class=\"fa {$v1['css_class']}\" aria-hidden=\"true\"></i><span>{$v1['title']}</span>
                                                </a>
                                                <ul class=\"nav nav-children\">";
                                        foreach ($_SESSION['rs_user']['menu'][2][$id1] as $p2 => $data2){
                                            if(isset($_SESSION['rs_user']['menu'][3][$p2])){
                                                /* WITH SUBMENU */
                                                echo "<li class=\"nav-parent\">
                                                        <a>{$data2['title']}</a>
                                                        <ul class=\"nav nav-children\">";

                                                foreach ($_SESSION['rs_user']['menu'][3][$p2] as $p3 => $data3){
                                                    /* LEVEL 3 */
                                                    echo "<li><a href=\"{$base_url}{$data3['url']}\">{$data3['title']}</a></li>";
                                                }

                                                echo "  </ul>
                                                    </li>";
                                            }else{
                                                /* NO SUBMENU */
                                                echo "<li><a href=\"{$base_url}{$data2['url']}\">{$data2['title']}</a></li>";
                                            }
                                        }
                                        echo "  </ul>
                                            </li>";
                                    }else{
                                        /* NO SUBMENU */
                                        echo "<li><a href=\"{$base_url}{$v1['url']}\"><i class=\"fa {$v1['css_class']}\" aria-hidden=\"true\"></i><span>{$v1['title']}</span></a>";
                                    }
                                }
                            }
                        }
                    ?>
                </ul>
            </nav>
            
        </div>

    </div>

</aside>
<!-- end: sidebar -->