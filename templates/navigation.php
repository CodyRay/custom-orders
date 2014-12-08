        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="."><?php echo $website_name; ?></a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="listcustomer.php"><i class="fa fa-users fa-fw"></i> All Customers</a>
                        </li>
                        <li>
                            <a href="editcustomer.php"><i class="fa fa-plus-circle fa-fw"></i> New Customer</a>
                        </li>
                        <li>
                            <a href="listorders.php"><i class="fa fa-wrench fa-fw"></i> Admin<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="listneeded.php">List Needed Plants</a>
                                </li>
                                <li>
                                    <a href="listorders.php">List All Orders</a>
                                </li>
                                <li>
                                    <a href="listorders_markcomplete.php">Mark Orders Complete</a>
                                </li>                                
								<li>
                                    <a href="listorders_notpickedup.php">Mark Orders Picked Up</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
