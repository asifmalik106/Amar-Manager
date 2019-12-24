        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top custom-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle toggle-button-rwd" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Retail Manager<sup>®</sup></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
                        <span class=""><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['data']['adminName']; ?> <i class="fa fa-caret-down"></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo BASE_URL; ?>admin/settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo BASE_URL; ?>main/logout/"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       
                        <li class="sidebar-search">
                            <small>Executive Management Panel for</small>
                           <h4>Asif Malik</h4>
                           <p>Bangladesh</p>
                            <!-- /input-group -->
                        </li>

                        <li>
                            <a href="<?php echo BASE_URL; ?>executive"><i class="fa fa-desktop fa-lg"></i>  Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo BASE_URL; ?>executive/subscription"><i class="fa fa-cart-plus fa-lg"></i>  New Subscription</a>
                        </li>
                        
                      
                      
                        <li>
                            <a href="<?php echo BASE_URL; ?>executive/payment"><i class="fa fa-credit-card fa-lg"></i>  Payment</a>
                        </li>
<!--
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-lg"></i>  Settings</a>
                        </li>
-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

                    </nav>