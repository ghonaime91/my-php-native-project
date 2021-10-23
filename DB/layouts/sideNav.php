


<div id="layoutSidenav_nav">





                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                           
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <?php 
                            
                                if($_SESSION['user']['role_id'] == 1) {

                                $modules = ["roles","users","matrials","contacts"];

                                } elseif ($_SESSION['user']['role_id'] == 2){
                                    $modules = ["matrials"];
                                }
                                

                                foreach ($modules as $k => $v) {

                            
                            ?>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts<?php echo $v;?>" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    <?php echo $v;?>    
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts<?php echo $v;?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo "http://localhost/myproject/DB/".$v;?>">Show</a>
                                    <a class="nav-link" href="<?php if($v != "contacts" ){echo "http://localhost/myproject/DB/".$v."/create.php";}?>"> <?php if($v != "contacts") {echo "Add";}?></a>
                                </nav>
                            </div>
                            
                            <?php }?>

                            
                </nav>
            </div>