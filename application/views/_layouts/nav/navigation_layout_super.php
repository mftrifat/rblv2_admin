<!-- ============================================================== -->
<!-- Topbar header -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="<?php echo base_url();?>home">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="<?php echo base_url();?>assets/img/logo.png" alt="homepage" class="dark-logo"/>
                    <!-- Light Logo icon -->
                    <img src="<?php echo base_url();?>assets/img/logo_white.png" alt="homepage" class="light-logo"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="<?php echo base_url();?>assets/img/logo.png" alt="homepage" class="dark-logo" />
                    <!-- Light Logo text -->
                    <!-- <img src="<?php echo base_url();?>assets/img/logo-light.png" class="light-logo" alt="homepage" /> -->
                    RBL | <?php echo $_SESSION['user_full_name'];?>
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">                
            </ul>

            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">                
                <!-- ============================================================== -->
                <!-- User profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url().$this->session->userdata('photo');?>" alt="user" class="rounded-circle" width="35">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right user-dd animated" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url();?>userprofile"><i class="ti-user m-r-5 m-l-5"></i>
                            User Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url();?>userprofilepic"><i class="m-r-5 m-l-5 mdi mdi-account-box"></i>
                            Profile Picture</a>
                        <a class="dropdown-item" href="<?php echo base_url();?>changepassword"><i class="m-r-5 m-l-5 mdi mdi-key-change"></i>
                            Change Password</a>
                        <li class="dropdown-divider"></li>
                        <a class="dropdown-item" href="<?php echo base_url();?>logout"><i class="m-r-5 m-l-5 mdi mdi-power"></i>
                            Logout</a>
                    </ul>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Left Sidebar  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20">
                        <div class="user-pic"><img src="<?php echo base_url().$this->session->userdata('photo');?>" alt="users"
                                class="rounded-circle" width="40" /></div>
                        <div class="user-content m-l-10" style="margin: unset;">
                            <h5 class="m-b-0 user-name font-medium" style="margin: 10px;vertical-align: bottom;"><?php echo $this->session->userdata('user_full_name');?></h5>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                
                <!-- Accounts -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-circle"></i>
                        <span class="hide-menu">Account</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>all_account" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">All Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>locked_account" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-account-key"></i>
                                <span class="hide-menu">Locked Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>single_account" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-account-star"></i>
                                <span class="hide-menu">Single Checked Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>price_list" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-cash-usd"></i>
                                <span class="hide-menu">Price List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Download -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-arrow-down-bold-circle"></i>
                        <span class="hide-menu">Download / Upload</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>upload_email" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-mail-ru"></i>
                                <span class="hide-menu">Upload Fresh Emails</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>locked_email" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-account-key"></i>
                                <span class="hide-menu">Locked Emails</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>download_account" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-download"></i>
                                <span class="hide-menu">Download Bulk Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>upload_account" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-cloud-upload"></i>
                                <span class="hide-menu">Upload Rejected Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>manage_downloads" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-folder-download"></i>
                                <span class="hide-menu">Manage Downloads</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Categogy -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Category</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>add_category" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-table"></i>
                                <span class="hide-menu">Add Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>manage_category" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-table-edit"></i>
                                <span class="hide-menu">Manage Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>add_sub_category" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-table-column-plus-after"></i>
                                <span class="hide-menu">Add Sub-Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>manage_sub_category" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-table-row-height"></i>
                                <span class="hide-menu">Manage Sub-Category</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-box-outline"></i>
                        <span class="hide-menu">User</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>add_user" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-account-plus"></i>
                                <span class="hide-menu">Add User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>manage_user" class="sidebar-link waves-effect waves-dark">
                                <i class="mdi mdi-account-edit"></i>
                                <span class="hide-menu">Manage User</span>
                            </a>
                        </li>
                    </ul>
                </li>                

                <!-- Payment-->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span class="hide-menu">Payment</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>pending_payment" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-cash"></i>
                                <span class="hide-menu">Pending Payment</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>all_payment" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-cash"></i>
                                <span class="hide-menu">All Payments</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>add_bonus_payment" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-cash"></i>
                                <span class="hide-menu">Bonus / Deduction</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url();?>transaction_summary" class="sidebar-link waves-effect waves-dark">
                                <i class="m-r-10 mdi mdi-cash"></i>
                                <span class="hide-menu">Transaction Summary</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar  -->
<!-- ==============================================================