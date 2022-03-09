<?php 

$page = 'dashboard';
if (!empty($_GET['page'])) {
    $page = Secure($_GET['page']);
}


$page_loaded = '';
$pages = array(
    'social-login',
    'dashboard',
    'general-settings',
    'chat',
    'manage-users',
    'settings',
    'manage-languages',
    'add-language',
    'manage-announcements',
    'add-university',
    'add-program',
    'edit-lang',
    'edit-application',
    'manage-reports',
    'agent-account-requests',
    'manage-pages',
    'changelog',
    'ban-users',
    'manage-universities',
    'manage-applications',
    'edit-university',
    'edit-program',
    'add-department',
    'manage-programs',
    'backup',
    'fake-users',
    'view-application'
 
);

if (in_array($page, $pages)) {
    $page_loaded = LoadAdminPage("$page/content");
} 

if (empty($page_loaded)) {
    header("Location: " . UrlLink('admincp'));
    exit();
}

if ($page == 'dashboard') {
    // $update_information = '';
   // if ($kd->config->last_admin_collection < (time() - 1800)) {
        $update_information = UpdateAdminDetails();
  //  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel | <?php echo $kd->config->title; ?></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo LoadAdminLink('/assets/media/image/favicon.png' ); ?>"/>
  <!-- CSS only -->

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/vendors/bundle.css'); ?>" type="text/css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- Daterangepicker -->
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/vendors/datepicker/daterangepicker.css'); ?>" type="text/css">
 
    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/vendors/dataTable/datatables.min.css'); ?>" type="text/css">
   <link rel="stylesheet" href="<?php echo LoadAdminLink('/vendors/charts/morsis/morris.css'); ?>" type="text/css">
   <!-- Jquery init -->
    <script src="<?php echo LoadAdminLink('vendors/jquery/jquery.min.js'); ?>"></script>
<!-- App css -->
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/assets/css/app.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/assets/css/custom.css'); ?>" type="text/css">

  
</head>
<body class=" small-navigation">
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-icon"></div>
    <span>Loading...</span>
</div>
<!-- ./ Preloader -->

<!-- Sidebar group -->
<div class="sidebar-group">

    <!-- BEGIN: Settings -->
    <div class="sidebar" id="settings">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title d-flex justify-content-between">
                    Settings
                    <a class="btn-sidebar-close" href="#">
                        <i class="ti-close"></i>
                    </a>
                </h6>
                <ul class="list-group list-group-flush" id="list-group">
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label" for="customSwitch1">Allow notifications.</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2">Hide user requests</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                            <label class="custom-control-label" for="customSwitch3">Speed up demands</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch4" checked>
                            <label class="custom-control-label" for="customSwitch4">Hide menus</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch5">
                            <label class="custom-control-label" for="customSwitch5">Remember next visits</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch6">
                            <label class="custom-control-label" for="customSwitch6">Enable report
                                generation.</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Settings -->


</div>
<!-- ./ Sidebar group -->

<!-- Layout wrapper -->
<div class="layout-wrapper">

    <!-- Header -->
    <div class="header d-print-none">
        <div class="header-container">
            <div class="header-left">
                <div class="navigation-toggler">
                    <a href="#" data-action="navigation-toggler">
                        <i data-feather="menu"></i>
                    </a>
                </div>

                <div class="header-logo">
                    <a href="<?php echo $kd->config->site_url; ?>">
                        <img class="logo" src="https://www.globalacademia.com/wp-content/uploads/2017/12/global-logo-Kopie.png" style="object-fit: contain;" alt="logo" >
                    </a>
                </div>
            </div>

            <div class="header-body">
                <div class="header-body-left">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-3">
                            <div class="header-search-form">
                                <form>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn header-search-close-btn">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                      
                    </ul>
                </div>

                <div class="header-body-right">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                <i data-feather="search"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown d-none d-md-block">
                            <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                <i class="maximize" data-feather="maximize"></i>
                                <i class="minimize" data-feather="minimize"></i>
                            </a>
                        </li>

                        

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link nav-link-notify" title="Notifications" data-toggle="dropdown">
                                <i data-feather="bell"><span  id="all-notifications"></span></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div
                                    class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Notifications</h5>
                                    <small class="opacity-7"><span  id="all-notifications"></span></small>
                                </div>
                                <div class="dropdown-scroll">
                                    <ul class="list-group list-group-flush" id="notifyy">
                                        
                                    </ul>
                                </div>
                                <div class="px-4 py-3 text-right border-top">
                                    <ul class="list-inline small">
                                        <li class="list-inline-item mb-0" id="mark_as_read">
                                            <a href="#">Mark All Read</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" title="Settings" data-sidebar-target="#settings">
                                <i data-feather="settings"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                <figure class="avatar avatar-sm">
                                    <img src="<?php   echo (!empty($user->avatar)) ? $user->avatar :   'assets/d-avatar.jpg'; ?>"
                                         class="rounded-circle"
                                         alt="avatar">
                                </figure>
                                <span class="ml-2 d-sm-inline d-none"><?php echo $user->name; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div class="text-center py-4">
                                    <figure class="avatar avatar-lg mb-3 border-0">
                                        <img src="<?php   echo  $user->avatar; ?>"
                                             class="rounded-circle" alt="image">
                                    </figure>
                                    <h5 class="text-center"><?php echo $user->name; ?></h5>
                                    <div class="mb-3 small text-center text-muted">@<?php echo $user->username; ?></div>
                                    <a href="#" class="btn btn-outline-light btn-rounded">Manage Your Account</a>
                                </div>
                                <div class="list-group">
                                    <a href="profile.html" class="list-group-item">View Profile</a>
                                    <a href="<?php echo $kd->config->site_url;?>/logout" class="list-group-item text-danger">Sign Out!</a>
                                </div>
                                <div class="p-4">
                                    <div class="mb-4">
                                        <h6 class="d-flex justify-content-between">
                                            Storage
                                            <span>%25</span>
                                        </h6>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 40%;"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <hr class="mb-3">
                                    <p class="small mb-0">
                                        <a href="#">Privacy policy</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item header-toggler">
                    <a href="#" class="nav-link">
                        <i data-feather="arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./ Header -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- begin::navigation -->
        <div class="navigation">
            <div class="navigation-header">
                <span>Navigation</span>
                <a href="#">
                    <i class="ti-close"></i>
                </a>
            </div>
            <div class="navigation-menu-body">
                <ul>
                    <li>
                        <a href="<?php echo  LoadAdminLinkSettings('dashboard'); ?>" <?php echo ($page == 'dashboard') ? 'class="active"' : '' ?>>
                    <span class="nav-link-icon">
                        <i data-feather="pie-chart"></i>
                    </span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-link-icon">
                                 <i data-feather="tool"></i>
                            </span>
                            <span>Tools</span>
                        </a>
                        <ul>
                        
                             <li><a href="<?php echo LoadAdminLinkSettings('backup'); ?>">Backup SQL & Files</a></li>
                       
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-link-icon">
                                 <i data-feather="shopping-bag"></i>
                            </span>
                            <span>Programs</span>
                        </a>
                        <ul>
                           
                             <li><a href="<?php echo LoadAdminLinkSettings('manage-programs'); ?>"> Manage  programs</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#">
                            <span class="nav-link-icon">
                                 <i data-feather="shopping-bag"></i>
                            </span>
                            <span>Applications</span>
                        </a>
                        <ul>
                            
                            <li><a href="<?php echo LoadAdminLinkSettings('manage-applications'); ?>"> Manage applications</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#">
                            <span class="nav-link-icon">
                                 <i data-feather="shopping-bag"></i>
                            </span>
                            <span>Universities</span>
                        </a>
                        <ul>
                            <li><a href="<?php echo LoadAdminLinkSettings('manage-universities'); ?>"> Manage universities</a></li>
                            <li><a href="<?php echo LoadAdminLinkSettings('add-department'); ?>"> Manage Departments</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-link-icon">
                                 <i data-feather="globe"></i>
                            </span>
                            <span>Languages</span>
                        </a>
                        <ul>
                            <li><a href="<?php echo LoadAdminLinkSettings('add-language'); ?>"> Add New Language Key</a></li>
                            <li><a href="<?php echo LoadAdminLinkSettings('manage-languages'); ?>"> Manage Languages</a></li>
                        </ul>
                    </li>
                  
                    <li>
                        <a  href="<?php echo LoadAdminLinkSettings('settings'); ?>"  <?php echo ($page == 'settings') ? 'class="active"' : ''; ?>>
                            <span class="nav-link-icon">
                                <i data-feather="settings"></i>
                            </span><span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"  <?php echo ($page == 'manage-users') ? 'class="active"' : ''; ?>>
                    <span class="nav-link-icon">
                        <i data-feather="users"></i>
                    </span><span>Users</span>
                        </a>
                        <ul>
                            <li>
                                <a  href="<?php echo LoadAdminLinkSettings('manage-users'); ?>">Manage Users</a>
                            </li>
                            <li>
                                <a   href="<?php echo LoadAdminLinkSettings('manage-reports'); ?>">Manage Reports</a>
                            </li>
                            <li>
                                <a   href="<?php echo LoadAdminLinkSettings('agent-account-requests'); ?>">Manage Join Agent Requests</a>
                            </li>
                            <li>
                                <a   href="<?php echo LoadAdminLinkSettings('manage-announcements'); ?>">Manage Join Agent Requests</a>
                            </li>
                            
                            
                            
                        </ul>
                    </li>
                 
                   
                   
                   
                </ul>
            </div>
        </div>
        <!-- end::navigation -->

        <!-- Content body -->
        <div class="content-body">
            <!-- Content -->
            <div class="content ">
                    
        

     <?php echo $page_loaded; ?>
      

    <!-- Modal -->
 <!--    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="row my-3">
                        <div class="col-md-6 ml-auto mr-auto">
                            <figure>
                                <img class="img-fluid" src="../../assets/media/svg/upgrade.svg" alt="upgrade">
                            </figure>
                        </div>
                    </div>
                    <h4 class="mb-3 text-center">Get an Upgrade</h4>
                    <div class="row my-3">
                        <div class="col-md-10 ml-auto mr-auto">
                            <p class="text-muted">Get additional 500 GB space for your documents and files. Expand your storage and enjoy your business. Change plan for more space.</p>
                            <button class="btn btn-primary" data-dismiss="modal">Plan Upgrade</button>
                        </div>
                    </div>
                    <a href="#" class="align-items-center d-flex link-1 small justify-content-center" data-dismiss="modal">
                        <i class="ti-close font-size-10 mr-1"></i>Close
                    </a>
                </div>
            </div>
        </div>
    </div> -->
            </div>
            <!-- ./ Content -->

            <!-- Footer -->
            <footer class="content-footer">
                <div>© 2020 Bigg Ajans - <a href="http://biggajans.com" target="_blank">Big Ajans</a></div>
                <div>
                    <nav class="nav">
                      
                    </nav>
                </div>
            </footer>
            <!-- ./ Footer -->
        </div>
        <!-- ./ Content body -->
    </div>
    <!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->
 
<!-- Main scripts -->
    <script src="<?php echo $kd->config->theme_url; ?>/js/jquery-2.1.1.min.js"></script>

    <script src="<?php echo LoadAdminLink('/vendors/bundle.js'); ?>"></script>
    <script src="<?php echo LoadAdminLink('/vendors/jquery/jquery-ui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $kd->config->theme_url; ?>/js/jquery.form.min.js"></script>x
    <script><?php echo LoadAdminPage('js/main'); ?></script>
    <!-- Apex chart -->
    <script src="<?php echo LoadAdminLink('/vendors/charts/apex/apexcharts.min.js'); ?>"></script>
    <!-- Daterangepicker -->
    <script src="<?php echo LoadAdminLink('/vendors/datepicker/daterangepicker.js'); ?>"></script>
    <!-- DataTable -->
    <script src="<?php echo LoadAdminLink('/vendors/dataTable/datatables.min.js'); ?>"></script>

    <!-- Dashboard scripts -->
    <script src="<?php echo LoadAdminLink('/assets/js/examples/pages/dashboard.js'); ?>"></script>
  

<!-- App scripts -->
<script src="<?php echo LoadAdminLink('/assets/js/app.min.js'); ?> "></script>


   <script src="<?php echo LoadAdminLink('/assets/js/examples/sweet-alert.js'); ?>"></script>


<!--- USer list -->
    <script src="<?php echo LoadAdminLink('/assets/js/examples/pages/user-list.js'); ?>"></script>
</body>
</html>
              