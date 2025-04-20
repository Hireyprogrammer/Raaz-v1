<!DOCTYPE html>

<html dir="" lang="<?= $locale?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/jpg" sizes="16x16" href="<?= base_url() ?>public/assets/images/core/favicon.png">
    <title><?= isset($title) ? $title : 'Welcome Home...'; ?></title>
    <link rel="canonical" href="https://daleelcom.net/" />
    <!-- Custom CSS -->
    <!-- <link href="<?php //echo base_url(); ?>public/assets/css/chartist.min.css" rel="stylesheet"> -->
    <!-- <link href="<?php //echo base_url(); ?>public/assets/css/c3.min.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo base_url(); ?>public/assets/css/apexcharts.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/libs/select2/dist/css/select2.min.css">
    <!-- This page plugin CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>public/assets/css/dataTables.bootstrap4.css" rel="stylesheet"> -->
    
    <?php $dir='ltr'; if($locale == 'ar'): $dir='rtl';?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/font-arabic.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/font-awesome.css" rel="stylesheet">
    <?php endif;?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/style.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.js"></script> -->

    <style>
        td.details-control {
            background: url('<?php echo base_url(); ?>public/dist/js/pages/datatable/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('<?php echo base_url(); ?>public/dist/js/pages/datatable/details_close.png') no-repeat center center;
        }

        .lang-top {
            /*            width: 55px;
            height: 55px;*/
            /*position: fixed;*/
            /*            bottom: 30px;
            right: 30px;*/
            font-size: 14px !important;
            border-radius: 50%;
            z-index: 99;
            /*display: none;*/
            color: #fff;
            text-align: center;
            cursor: pointer;
            background: #026665;
            ;
            -webkit-animation: pulse 2s infinite;
            -o-animation: pulse 2s infinite;
            animation: pulse 2s infinite;
            padding: 8px;
            margin-top: 12px;
            text-align: center;
        }

        .lang-top a {
            font-size: 14px !important;
        }

        .lang-top::after {
            position: absolute;
            z-index: -1;
            content: '';
            top: 100%;
            left: 5%;
            height: 10px;
            width: 90%;
            opacity: 1;
            background: -webkit-radial-gradient(center, ellipse, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0) 80%);
            background: -webkit-radial-gradient(center ellipse, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0) 80%);
            background: radial-gradient(ellipse at center, rgba(190, 236, 27, 0.25) 0%, rgba(0, 0, 0, 0) 80%);
        }
    </style>
    <style>
        #add_form fieldset:not(:first-of-type) {
            display: none;
        }
        .logo-icon .dark-logo{
            left: -75px; position: inherit;
        }
        .logo-text {
            
            margin-left: 50px;
        }
        .logo-text img {
            position: relative;
            top:5px;
            left: -75px;
        }
            
        
    </style>
    
    <script src="<?php echo base_url() ?>public/assets/js/jquery.min.js"></script>

    <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;box-sizing: content-box;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
   
</head>

<body >
    <?php if($locale == 'ar'): ?>
        <style type="text/css">
            
            :root{
                --bs-body-font-family: 'Droid Arabic Naskh',"Rubik",sans-serif;
                --bs-body-font-size:1rem;
                --bs-body-font-style:normal;
                direction: rtl;

            }

            #main-wrapper[data-layout="vertical"][data-sidebartype="full"] .page-wrapper {
                margin-left: 0px;
                margin-right: 240px;
            }
            #main-wrapper[data-layout="vertical"][data-sidebar-position="fixed"][data-sidebartype="full"] .topbar .top-navbar .navbar-collapse{
                margin-left: 0px;
                margin-right: 240px;
            }
            .sidebar-nav .has-arrow::after {
                /* margin-right: 10px;
                
                margin-left: 15px;*/
                right: 210px; 
            }

            .logo-text {
                margin-right: 50px;
                margin-left: 0px;
            }

            .logo-text img {
                position: relative;
                top:5px;
                right: -75px;
            }
            .logo-icon .dark-logo{
                right: -75px; position: inherit;
            }
            .app-search .srh-btn {
                /* position: absolute;
                top: -19px; */
                right: 170px;
                
            }
            .sidebar-nav ul .sidebar-item .first-level .sidebar-item .sidebar-link {
                padding: 12px 47px 12px 15px;
            }
            .dropdown-menu-end[data-bs-popper] {
                left: 0;
                right: auto;
            }
            .dropdown-item{
                text-align: right;
            }
        </style>
    <?php endif;?>
    <div id="main-wrapper">
     
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href=" <?= base_url($locale.'/admin')?>">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                         <img src="<?= base_url()?>public/assets/images/core//logo-icon.png" alt="homepage" class="dark-logo" style="width: 70% !important;"  >


                        <!-- Light Logo icon -->
                        <img src="../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo">
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                        <img src="<?= base_url()?>public/assets/images/core/AL_RAYAN_Logo_04.png" alt="homepage" class="dark-logo" style="width: 130% !important;">
                        <!-- Light Logo text -->
                        <img src="<?= base_url()?>public/assets/images/core/logo-light-text.png" class="light-logo" alt="homepage">
                    </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin1">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left-circle feather-sm"><circle cx="12" cy="12" r="10"></circle><polyline points="12 8 8 12 12 16"></polyline><line x1="16" y1="12" x2="8" y2="12"></line></svg></a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Comment -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell feather-sm"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <div class="notify">
                            <span class="heartbit"></span> <span class="point"></span>
                        </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-start mailbox dropdown-menu-animate-up">
                        <ul class="list-style-none">
                            <li>
                            <div class="border-bottom rounded-top py-3 px-4">
                                <div class="mb-0 font-weight-medium fs-4">
                                Notifications
                                </div>
                            </div>
                            </li>
                            <li>
                            <div class="message-center notifications position-relative ps-container ps-theme-default" style="height: 230px" data-ps-id="b0a5a1a9-964b-8e70-d70e-f94e9c70d030">
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn btn-light-danger text-danger btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link feather-sm fill-white"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                    Luanch Admin
                                    </h5>
                                    <span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">Just see the my new admin!</span>
                                    <span class="fs-2 text-nowrap d-block subtext text-muted">9:30 AM</span>
                                </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn btn-light-success text-success btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar feather-sm fill-white"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                    Event today
                                    </h5>
                                    <span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">Just a reminder that you have event</span>
                                    <span class="fs-2 text-nowrap d-block subtext text-muted">9:10 AM</span>
                                </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn btn-light-info text-info btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings feather-sm fill-white"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                    Settings
                                    </h5>
                                    <span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">You can customize this template as you want</span>
                                    <span class="fs-2 text-nowrap d-block subtext text-muted">9:08 AM</span>
                                </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn btn-light-primary text-primary btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users feather-sm fill-white"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                    Pavan kumar
                                    </h5>
                                    <span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">Just see the my admin!</span>
                                    <span class="fs-2 text-nowrap d-block subtext text-muted">9:02 AM</span>
                                </div>
                                </a>
                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                            </li>
                            <li>
                            <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);">
                                <strong>Check all notifications</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Comment -->
                    <!-- ============================================================== -->
                                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item search-box d-none d-md-flex align-items-center">
                       <h4 style="color: white;"> <?=session()->get('branch_name')?></h4>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <?php 
                        $userimg = base_url('public/assets/images/users/').session()->get('user')['user_img'];
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?= $userimg?>" alt="user" class="profile-pic rounded-circle" width="30">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                            <div class="">
                            <img src="<?= $userimg?>" alt="user" class="rounded-circle" width="60">
                            </div>
                            <div class="ms-2">
                            <h4 class="mb-0 text-white"><?= session()->get('user')['fullname'] ?></h4>
                            <p class="mb-0"><?= session()->get('user')['user_email'] ?></p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="<?= base_url($locale.'/user/profile')?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user feather-sm text-info me-1 ms-1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            My Profile</a>
                        <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card feather-sm text-info me-1 ms-1"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                            My Balance</a>
                        <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail feather-sm text-success me-1 ms-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings feather-sm text-warning me-1 ms-1"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url($locale.'/admin/logout')?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out feather-sm text-danger me-1 ms-1"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            Logout</a>
                        <div class="dropdown-divider"></div>
                        <div class="pl-4 p-2">
                            <a href="<?= base_url($locale.'/user/profile')?>" class="btn d-block w-100 btn-info rounded-pill">View Profile</a>
                        </div>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Language  -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                          <?php if($locale == 'en'){ ?>
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-us"></i>EN</a>
                         <?php }else if($locale == 'ar'){ ?>
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-ye"></i>AR</a>
                        <?php } ?>   
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                        <a class="dropdown-item" href="<?= base_url('/en/admin')?>"><i class="flag-icon flag-icon-us"></i> English</a>
                        <a class="dropdown-item" href="<?= base_url('/ar/admin')?>"><i class="flag-icon flag-icon-ye"></i> العربية</a>
                        
                        </div>
                    </li>
                    </ul>
                </div>
              
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar ps-container ps-theme-default ps-active-y" data-ps-id="cac1f8f4-b00b-28f3-0993-3e932e5b0995">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="in">
                                             
        
                        <?= $access;?>
                    
                
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 3px;">
                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
        </div>
        <!-- End Sidebar scroll-->
        <!-- Bottom points-->
        <div class="sidebar-footer">
          <!-- item-->
          <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Settings" data-bs-original-title="Settings"><i data-feather="settings" class="feather-icon"></i></a>
          <!-- item-->
          <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Email" data-bs-original-title="Email"><i data-feather="mail" class="feather-icon"></i></a>
          <!-- item-->
          <a href="<?= base_url($locale.'/admin/logout')?>" class="link" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Logout" data-bs-original-title="Logout"><i data-feather="power" class="feather-icon"></i></a>
        </div>
        <!-- End Bottom points-->
      </aside>
      <div class="page-wrapper" style="display: block;">
            
            <?= $this->renderSection('content');?>
        

        <footer class="footer">
            &copy <?= date('Y', time()) . ' RAED Innovation & Technology. ';// . lang('setup')['footer']; ?>
        </footer>
      </div>
    </div>

    <!-- <script src="<?php //echo base_url() ?>public/assets/libs/popper.js/dist/umd/popper.min.js"></script> -->
    <script src="<?php echo base_url() ?>public/assets/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="<?php echo base_url() ?>public/assets/js/app.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/app.init.js"></script>
    <!-- <script src="<?php //echo base_url() ?>public/dist/js/app-style-switcher.js"></script> -->
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url() ?>public/assets/js/perfect-scrollbar.jquery.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>public/assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url() ?>public/assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>public/assets/js/feather.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/js/dataTables.bootstrap5.min.js"></script>


    <!-- ############################################################### -->
    <!-- This Page Js Files Here -->
    <!-- ############################################################### -->
    
    
   
    <!--This page plugins -->
    <!-- <script src="<?php echo base_url() ?>public/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>public/dist/js/pages/datatable/custom-datatable.js"></script>
    <script src="<?php echo base_url() ?>public/dist/js/pages/datatable/datatable-api.init.js"></script> -->

    <script src="<?php echo base_url() ?>public/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url() ?>public/assets/libs/select2/dist/js/select2.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>public/dist/js/pages/forms/select2/select2.init.js"></script> -->





</body>

</html>