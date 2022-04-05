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
    'manage-workers',
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
    'manage_emails',
    'changelog',
    'ban-users',
    'fake-users',
    'manage-invitation-keys',
    'manage-universities',
    'manage-applications',
    'create-new-sitemap',
    'edit-university',
    'edit-program',
    'add-department',
    'manage-programs',
    'backup',
    'mass-notifications',
    'send_email',
    'manage-invitation',
    'fake-users',
    'mailing-list',
    'auto-friend',
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
    if ($kd->config->last_admin_collection < (time() - 1800)) {
        $db->where('is_pro',1)->where('pro_time',time() - (60 * 60 * 24 * 30),'<')->update(T_USERS,array('is_pro' => 0,
                                                                                                         'pro_time' => 0));
        $update_information = UpdateAdminDetails();
   }
}
$notify_count = $db->where('recipient_id',0)->where('admin',1)->where('seen',0)->getValue(T_NOTIFICATIONS,'COUNT(*)');
$notifications = $db->where('recipient_id',0)->where('admin',1)->where('seen',0)->orderBy('id','DESC')->get(T_NOTIFICATIONS);
$old_notifications = $db->where('recipient_id',0)->where('admin',1)->where('seen',0,'!=')->orderBy('id','DESC')->get(T_NOTIFICATIONS,5);
$mode = 'day';
if (!empty($_COOKIE['mode']) && $_COOKIE['mode'] == 'night') {
    $mode = 'night';
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
    <link rel="stylesheet" href="<?php echo(LoadAdminLink('vendors/datepicker/daterangepicker.css')) ?>" type="text/css">
 
    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/vendors/dataTable/datatables.min.css'); ?>" type="text/css">
   <link rel="stylesheet" href="<?php echo LoadAdminLink('/vendors/charts/morsis/morris.css'); ?>" type="text/css">
   
   <!-- Jquery init -->
<!-- App css -->
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/assets/css/app.min.css'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo LoadAdminLink('/assets/css/custom.css'); ?>" type="text/css">

    <script src="<?php echo(LoadAdminLink('vendors/bundle.js')) ?>"></script>

   <!-- Apex chart -->
   <script src="<?php echo(LoadAdminLink('vendors/charts/apex/apexcharts.min.js')) ?>"></script>

<!-- Daterangepicker -->
<script src="<?php echo(LoadAdminLink('vendors/datepicker/daterangepicker.js')) ?>"></script>

<!-- DataTable -->
<script src="<?php echo(LoadAdminLink('vendors/dataTable/datatables.min.js')) ?>"></script>

<!-- Dashboard scripts -->
<script src="<?php echo(LoadAdminLink('assets/js/examples/pages/dashboard.js')) ?>"></script>
<script src="<?php echo LoadAdminLink('vendors/charts/chartjs/chart.min.js'); ?>"></script>

<!-- App scripts -->


<link href="<?php echo LoadAdminLink('vendors/sweetalert/sweetalert.css'); ?>" rel="stylesheet" />
<script src="<?php echo LoadAdminLink('assets/js/admin.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo(LoadAdminLink('vendors/select2/css/select2.min.css')) ?>" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script src="<?php echo LoadAdminLink('vendors/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>

<script src="<?php echo LoadAdminLink('vendors/bootstrap-tagsinput/src/bootstrap-tagsinput.js'); ?>"></script>
<link href="<?php echo LoadAdminLink('vendors/bootstrap-tagsinput/src/bootstrap-tagsinput.css'); ?>" rel="stylesheet" />

<?php if ($page == 'custom-code') { ?>

<?php } ?>
<?php if ($page == 'bank-receipts' || $page == 'agent-account-requests' || $page == 'monetization-requests' || $page == 'manage-user-ads' || $page == 'manage-artists') { ?>
        <!-- Css -->
        <link rel="stylesheet" href="<?php echo(LoadAdminLink('vendors/lightbox/magnific-popup.css')) ?>" type="text/css">

        <!-- Javascript -->
        <script src="<?php echo(LoadAdminLink('vendors/lightbox/jquery.magnific-popup.min.js')) ?>"></script>
        <script src="<?php echo(LoadAdminLink('vendors/charts/justgage/raphael-2.1.4.min.js')) ?>"></script>
        <script src="<?php echo(LoadAdminLink('vendors/charts/justgage/justgage.js')) ?>"></script>
    <?php } ?>
<script src="<?php echo LoadAdminLink('assets/js/jquery.form.min.js'); ?>"></script>

</head>
<!-- <script type="text/javascript">
    $(function() {
        $(document).on('click', 'a[data-ajax]', function(e) {
            $(document).off('click', '.ranges ul li');
            $(document).off('click', '.applyBtn');
            e.preventDefault();
            if (($(this)[0].hasAttribute("data-sent") && $(this).attr('data-sent') == '0') || !$(this)[0].hasAttribute("data-sent")) {
                if (!$(this)[0].hasAttribute("data-sent") && !$(this).hasClass('waves-effect')) {
                    $('.navigation-menu-body').find('a').removeClass('active');
                    $(this).addClass('active');
                }
                window.history.pushState({state:'new'},'', $(this).attr('href'));
                $(".barloading").css("display","block");
                if ($(this)[0].hasAttribute("data-sent")) {
                    $(this).attr('data-sent', "1");
                }
                var url = $(this).attr('data-ajax');
                $.post("<?php echo($kd->config->site_url) ?>/admin_load.php" + url, {url:url}, function (data) {
                    $(".barloading").css("display","none");
                    if ($('#redirect_link')[0].hasAttribute("data-sent")) {
                        $('#redirect_link').attr('data-sent', "0");
                    }
                    json_data = JSON.parse($(data).filter('#json-data').val());
                    $('.content').html(data);
                    $('.content').animate({
                        scrollTop: $('.content').offset().top - 350
                    });
                    setTimeout(function () {
                      $(".content").getNiceScroll().resize()
                    }, 300);
                });
            }
        });
        $(window).on("popstate", function (e) {
            location.reload();
        });
    });
</script> -->

<body <?php echo ($mode == 'night' ? 'class="dark"' : ''); ?>>
    <div class="barloading"></div>
    <a id="redirect_link" href="" data-ajax="" data-sent="0"></a>
    <input type="hidden" class="main_session" value="<?php echo createMainSession();?>">
    <div class="colors"> <!-- To use theme colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-bright"></div>
        <div class="bg-secondary"></div>
        <div class="bg-secondary-bright"></div>
        <div class="bg-info"></div>
        <div class="bg-info-bright"></div>
        <div class="bg-success"></div>
        <div class="bg-success-bright"></div>
        <div class="bg-danger"></div>
        <div class="bg-danger-bright"></div>
        <div class="bg-warning"></div>
        <div class="bg-warning-bright"></div>
    </div>
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-icon"></div>
    <span>Loading...</span>
</div>
<!-- ./ Preloader -->

<!-- Sidebar group -->
<div class="sidebar-group">

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
                    <a href="<?php echo($kd->config->site_url) ?>">
                       <img class="logo" src="https://www.globalacademia.com/wp-content/uploads/2017/12/global-logo-Kopie.png" style="object-fit: contain;" alt="logo" >
                    </a>
                </div>
            </div>

            <div class="header-body">
                <div class="header-body-left">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-3">
                            <div class="header-search-form">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn">
                                            <i data-feather="search"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search"  onkeyup="searchInFiles($(this).val())">
                                    <div class="pt_admin_hdr_srch_reslts" id="search_for_bar"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="header-body-right">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link <?php if ($notify_count > 0) { ?> nav-link-notify<?php } ?>" title="Notifications" data-toggle="dropdown">
                                <i data-feather="bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div
                                    class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Notifications</h5>
                                    <?php if ($notify_count > 0) { ?>
                                    <small class="opacity-7"><?php echo $notify_count; ?>   unread notifications</small>
                                    <?php } ?>
                                </div>
                                <div class="dropdown-scroll">
                                    <ul class="list-group list-group-flush">
                                        <?php if ($notify_count > 0) { ?>
                                            <li class="px-4 py-2 text-center small text-muted bg-light">Unread Notifications</li>
                                            <?php if (!empty($notifications)) {
                                                    foreach ($notifications as $key => $notify) {
                                                        $page_ = '';
                                                        $text = '';
                                                        if ($notify->type == 'job_applied') {
                                                            $page_ = 'manage-applications';
                                                            $text = 'You have a new Application awaiting your review';
                                                        }
                                                        elseif ($notify->type == 'verify') {
                                                            $page_ = 'agent-account-requests';
                                                            $text = 'You have a new Agent account verification requests awaiting your approval';
                                                        }
                                                ?>
                                            <li class="px-4 py-3 list-group-item">
                                                <a href="<?php echo LoadAdminLinkSettings($page_); ?>" class="d-flex align-items-center hide-show-toggler">
                                                    <div class="flex-shrink-0">
                                                        <figure class="avatar mr-3">
                                                            <span
                                                                class="avatar-title bg-info-bright text-info rounded-circle">
                                                                <?php if ($notify->type == 'bank') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                                                <?php }elseif ($notify->type == 'verify') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196f3" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"></path></svg>
                                                                <?php }elseif ($notify->type == 'copyright') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                                                <?php }elseif ($notify->type == 'with') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                                                <?php }elseif ($notify->type == 'report') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                                                <?php }elseif ($notify->type == 'artist') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                                                <?php }elseif ($notify->type == 'refund') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                                                <?php } ?>

                                                            </span>
                                                        </figure>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                            <?php echo $text; ?>
                                                        </p>
                                                        <span class="text-muted small"><?php echo time_Elapsed_String($notify->time); ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php } } ?>
                                        <?php } ?>
                                        <?php if ($notify_count == 0 && !empty($old_notifications)) { ?>
                                            <li class="px-4 py-2 text-center small text-muted bg-light">Old Notifications</li>
                                            <?php
                                                    foreach ($old_notifications as $key => $notify) {
                                                        $page_ = '';
                                                        $text = '';
                                                        if ($notify->type == 'new_application') {
                                                            $page_ = 'manage-applications';
                                                            $text = 'Hello you have new applications';
                                                        }
                                                        elseif ($notify->type == 'verify') {
                                                            $page_ = 'verification-requests';
                                                            $text = 'You have a new verification requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'copyright') {
                                                            $page_ = 'manage-copyright-reports';
                                                            $text = 'You have a new copyright requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'with') {
                                                            $page_ = 'payment-requests';
                                                            $text = 'You have a new withdrawal requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'report') {
                                                            $page_ = 'manage-reports';
                                                            $text = 'You have a new reports awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'artist') {
                                                            $page_ = 'manage-artists';
                                                            $text = 'You have a new artist requests awaiting your approval';
                                                        }
                                                        elseif ($notify->type == 'refund') {
                                                            $page_ = 'manage-refund';
                                                            $text = 'You have a new refund requests awaiting your approval';
                                                        }
                                                ?>
                                            <li class="px-4 py-3 list-group-item">
                                                <a href="<?php echo LoadAdminLinkSettings($page_); ?>" class="d-flex align-items-center hide-show-toggler">
                                                    <div class="flex-shrink-0">
                                                        <figure class="avatar mr-3">
                                                            <span class="avatar-title bg-secondary-bright text-secondary rounded-circle">
                                                                <?php if ($notify->type == 'bank') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                                                <?php }elseif ($notify->type == 'verify') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196f3" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"></path></svg>
                                                                <?php }elseif ($notify->type == 'copyright') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                                                <?php }elseif ($notify->type == 'with') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                                                <?php }elseif ($notify->type == 'report') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                                                <?php }elseif ($notify->type == 'artist') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>
                                                                <?php }elseif ($notify->type == 'refund') { ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                                                <?php } ?>
                                                            </span>
                                                        </figure>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                            <?php echo $text; ?>
                                                        </p>
                                                        <span class="text-muted small"><?php echo time_Elapsed_String($notify->time); ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                                <?php if ($notify_count > 0) { ?>
                                <div class="px-4 py-3 text-right border-top">
                                    <ul class="list-inline small">
                                        <li class="list-inline-item mb-0">
                                            <a href="javascript:void(0)" onclick="ReadNotify()">Mark All Read</a>
                                        </li>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                <figure class="avatar avatar-sm">
                                    <img src="<?php echo $user->avatar; ?>"
                                         class="rounded-circle"
                                         alt="avatar">
                                </figure>
                                <span class="ml-2 d-sm-inline d-none"><?php echo $user->name; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div class="text-center py-4">
                                    <figure class="avatar avatar-lg mb-3 border-0">
                                        <img src="<?php echo $user->avatar; ?>"
                                             class="rounded-circle" alt="image">
                                    </figure>
                                    <h5 class="text-center"><?php echo $user->name; ?></h5>
                                    <div class="mb-3 small text-center text-muted"><?php echo $user->email; ?></div>
                                    <a href="<?php echo $user->url; ?>" class="btn btn-outline-light btn-rounded">View Profile</a>
                                </div>
                                <div class="list-group">
                                    <a href="<?php echo(UrlLink('logout')) ?>" class="list-group-item text-danger">Sign Out!</a>
                                    <?php if ($mode == 'night') { ?>
                                        <a href="javascript:void(0)" class="list-group-item admin_mode" onclick="ChangeMode('day')">
                                            <span id="night-mode-text">Day mode</span>
                                            <svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="javascript:void(0)" class="list-group-item admin_mode" onclick="ChangeMode('night')">
                                            <span id="night-mode-text">Night mode</span>
                                            <svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                                        </a>
                                    <?php } ?>

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
                        <a <?php echo ($page == 'manage-announcements' || $page == 'mass-notifications' || $page == 'manage-invitation-keys' || $page == 'ban-users' || $page == 'fake-users' || $page == 'create-new-sitemap' || $page == 'backup' || $page == 'auto-friend' || $page == 'manage_emails' || $page == 'manage-invitation' ) ? 'class="open"' : ''; ?> href="javascript:void(0);">
                            <span class="nav-link-icon">
                                <i class="material-icons">build</i>
                            </span>
                            <span>Tools</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a <?php echo ($page == 'manage_emails') ? 'class="active"' : ''; ?> data-ajax="?path=manage_emails" href="<?php echo LoadAdminLinkSettings('manage_emails'); ?>">Manage Emails</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'manage-invitation') ? 'class="active"' : ''; ?> data-ajax="?path=manage-invitation" href="<?php echo LoadAdminLinkSettings('manage-invitation'); ?>">Users Invitation</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'manage-announcements') ? 'class="active"' : ''; ?> data-ajax="?path=manage-announcements" href="<?php echo LoadAdminLinkSettings('manage-announcements'); ?>">Manage Announcements</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'auto-friend') ? 'class="active"' : ''; ?> data-ajax="?path=auto-friend" href="<?php echo LoadAdminLinkSettings('auto-friend'); ?>">Auto Follow</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'mass-notifications') ? 'class="active"' : ''; ?> data-ajax="?path=mass-notifications" href="<?php echo LoadAdminLinkSettings('mass-notifications'); ?>">Mass Notifications</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'ban-users') ? 'class="active"' : ''; ?> data-ajax="?path=ban-users" href="<?php echo LoadAdminLinkSettings('ban-users'); ?>">Ban Users</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'fake-users') ? 'class="active"' : ''; ?> data-ajax="?path=fake-users" href="<?php echo LoadAdminLinkSettings('fake-users'); ?>">Fake User Generator</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'create-new-sitemap') ? 'class="active"' : ''; ?> data-ajax="?path=create-new-sitemap" href="<?php echo LoadAdminLinkSettings('create-new-sitemap'); ?>">Generate SiteMap</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'manage-invitation-keys') ? 'class="active"' : ''; ?> data-ajax="?path=manage-invitation-keys" href="<?php echo LoadAdminLinkSettings('manage-invitation-keys'); ?>">Invitation Codes</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'backup') ? 'class="active"' : ''; ?> data-ajax="?path=backup" href="<?php echo LoadAdminLinkSettings('backup'); ?>">Backup</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'send_email') ? 'class="active"' : ''; ?> data-ajax="?path=send_email" href="<?php echo LoadAdminLinkSettings('send_email'); ?>">Send E-mail</a>
                            </li>
                            <li>
                                <a <?php echo ($page == 'mailing-list') ? 'class="active"' : ''; ?> data-ajax="?path=mailing-list" href="<?php echo LoadAdminLinkSettings('mailing-list'); ?>">Maling List</a>
                            </li>
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
                   <?php if($kd->user->access_level === 1) {?>
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
                                <a  href="<?php echo LoadAdminLinkSettings('manage-workers'); ?>">Manage Staff</a>
                            </li>
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
                                <a   href="<?php echo LoadAdminLinkSettings('manage-announcements'); ?>">User Announcements</a>
                            </li>
                            
                            
                            
                        </ul>
                    </li> 
                   <?php } ?> 
                            
                   
                </ul>
            </div>
        </div>
        <!-- end::navigation -->

        <!-- Content body -->
        <div class="content-body">
            <!-- Content -->
            <div class="content ">
                <?php echo $page_loaded; ?>
            </div>
            <!-- ./ Content -->

            <!-- Footer -->
            <footer class="content-footer">
                <div>© 2022 Czest Tech - <a href="http://czesttech.com" target="_blank">Czest Tech</a></div>
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
 

  

<script src="<?php echo LoadAdminLink('vendors/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?php echo(LoadAdminLink('vendors/select2/js/select2.min.js')) ?>"></script>
<script src="<?php echo(LoadAdminLink('assets/js/examples/select2.js')) ?>"></script>
<script src="<?php echo(LoadAdminLink('assets/js/app.min.js')) ?>"></script>

    <script type="text/javascript">
        function ChangeMode(mode) {
            if (mode == 'day') {
                $('body').removeClass('dark');
                $('.admin_mode').html('<span id="night-mode-text">Night mode</span><svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>');
                $('.admin_mode').attr('onclick', "ChangeMode('night')");
            }
            else{
                $('body').addClass('dark');
                $('.admin_mode').html('<span id="night-mode-text">Day mode</span><svg class="feather feather-moon float-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>');
                $('.admin_mode').attr('onclick', "ChangeMode('day')");
            }
            hash_id = $('.main_session').val();
            $.get('<?php echo $kd->config->ajax_url; ?>',{hash_id: hash_id,mode:mode}, function(data) {});
        }
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
            var hash = $('.main_session').val();
              $.ajaxSetup({
                data: {
                    hash_id: hash
                },
                cache: false
              });
        });
        $('body').on('click', function (e) {
            $('.dropdown-animating').removeClass('show');
            $('.dropdown-menu').removeClass('show');
        });
        function searchInFiles(keyword) {
            if (keyword.length > 2) {
                $.post('<?php echo $kd->config->ajax_url; ?>/ap/search_in_pages', {keyword: keyword}, function(data, textStatus, xhr) {
                    if (data.html != '') {
                        $('#search_for_bar').html(data.html)
                    }
                    else{
                        $('#search_for_bar').html('')
                    }
                });
            }
            else{
                $('#search_for_bar').html('')
            }
        }
        jQuery(document).ready(function($) {
            jQuery.fn.highlight = function (str, className) {
                if (str != '') {
                    var aTags = document.getElementsByTagName("h2");
                    var bTags = document.getElementsByTagName("label");
                    var cTags = document.getElementsByTagName("h3");
                    var dTags = document.getElementsByTagName("h6");
                    var searchText = str.toLowerCase();

                    if (aTags.length > 0) {
                        for (var i = 0; i < aTags.length; i++) {
                            var tag_text = aTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(aTags[i]).addClass(className)
                            }
                        }
                    }

                    if (bTags.length > 0) {
                        for (var i = 0; i < bTags.length; i++) {
                            var tag_text = bTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(bTags[i]).addClass(className)
                            }
                        }
                    }

                    if (cTags.length > 0) {
                        for (var i = 0; i < cTags.length; i++) {
                            var tag_text = cTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(cTags[i]).addClass(className)
                            }
                        }
                    }

                    if (dTags.length > 0) {
                        for (var i = 0; i < dTags.length; i++) {
                            var tag_text = dTags[i].textContent.toLowerCase();
                            if (tag_text.indexOf(searchText) != -1) {
                                $(dTags[i]).addClass(className)
                            }
                        }
                    }
                }
            };
            jQuery.fn.highlight("<?php echo (!empty($_GET['highlight']) ? $_GET['highlight'] : '') ?>",'highlight_text');
        });
        $(document).on('click', '#search_for_bar a', function(event) {
            event.preventDefault();
            location.href = $(this).attr('href');
        });
        function ReadNotify() {
            hash_id = $('.main_session').val();
            $.get('<?php echo $kd->config->ajax_url; ?>/ap/ReadNotify',{hash_id: hash_id});
            location.reload();
        }
        function delay(callback, ms) {
          var timer = 0;
          return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
              callback.apply(context, args);
            }, ms || 0);
          };
        }
        function RemoveSizeIssue() {
            hash_id = $('.main_session').val();
            $.post("<?php echo $kd->config->ajax_url; ?>/ap/save-settings", {hash_id: hash_id,size_issue: ''}, function(data, textStatus, xhr) {});
        }
    </script>
</body>
</html>
              