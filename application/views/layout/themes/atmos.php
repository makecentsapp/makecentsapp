<!DOCTYPE html>
<?php if($enable_rtl) : ?>
<html dir="rtl">
<?php else : ?>
<html lang="en">
<?php endif; ?>
<?php
if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
?>
    <head>
        <title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>
        <meta charset="UTF-8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">

        <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/logo.png"/>
        <link rel="icon" href="<?php echo base_url();?>assets/img/logo.png" type="image/png" sizes="16x16">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/pace/pace.css">
        <script src="<?php echo base_url();?>assets/vendor/pace/pace.min.js"></script>

        <!--vendors-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendor/jquery-scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/select2/css/select2.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
        <!--Material Icons-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/materialdesignicons/materialdesignicons.min.css">
        <!--Material Icons-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/feather/feather-icons.css">
        <!--Bootstrap + atmos Admin CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/atmos.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-social.css">
        <!-- Additional library for page -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- ProLogin Tags css- for dropzones etc -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/elements.css">

        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        var global_hash = "<?php echo $this->security->get_csrf_hash() ?>";
        </script>

        <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"   ></script>
        <script src="<?php echo base_url();?>assets/vendor/jquery-ui/jquery-ui.min.js"   ></script>


        <!-- Datatables -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/DataTables/datatables.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
        <script src="<?php echo base_url();?>assets/vendor/DataTables/datatables.min.js"></script>
        <!-- Datatables add-ons -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.css"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.js"></script>

        <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

        <?php if(isset($datatable_lang) && !empty($datatable_lang)) : ?>
        <script type="text/javascript">
            $(document).ready(function() {
              $.extend( true, $.fn.dataTable.defaults, {
              "language": {
                "url": "<?php echo $datatable_lang ?>"
            }
              });
          });
        </script>
        <?php endif; ?>

        <!-- Smart Forms - added by PM 2/22-->
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/vendor/smartforms/smart-forms-customized.css">
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>assets/vendor/smartforms/smart-addons.css">

        <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/smartforms/jquery.steps.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/smartforms/jquery-ui-custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/smartforms/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/smartforms/additional-methods.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/smartforms/jquery.form.min.js"></script>

        <!-- Extra Atmos Assets - added by PM 3/2-->
        <script type="text/javascript" src="<?php echo base_url();?>assets/vendor/jquery.bootstrap.wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendor/apexchart/apexcharts.min.js"></script>
        <!-- JS base_url for ajax calls. Sub php method with: 'base_url+"some/other"' -->
        <script>var base_url = '<?php echo base_url() ?>';</script>

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="sidebar-pinned">

        <?php if($this->settings->info->cookie_option && !$accept_cookies) : ?>
            <div id="cookie-consent">
                <?php echo lang("ctn_483") ?> <a href="<?php echo site_url("login/privacy") ?>"><?php echo lang("ctn_481") ?></a>. <div class="cookie-close-box"><input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_482") ?>" onclick="accept_cookie()"></div>
            </div>
        <?php endif; ?>

        <?php if(isset($sidebar)) : ?>
            <?php echo $sidebar ?>
        <?php endif; ?>
        <?php include(APPPATH . "views/layout/atmos_sidebar_links.php") ?>
        <?php //include(APPPATH . "views/layout/mobile_links.php") //removed depending on atmos to work with mobile?>
        <main class="admin-main">

            <header class="admin-header">

                <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
                
                <?php if($this->user->info->admin) : ?>
                <nav class=" mr-auto my-auto">
                    <ul class="nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
                                <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>

                <nav class=" ml-auto">
                    <ul class="nav align-items-center">
                        <?php if($this->user->loggedin) : ?>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a href="#" class="nav-link" data-toggle="dropdown" onclick="load_notifications()" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                                        <span class="notification-counter"></span>
                                        <?php if($this->user->info->noti_count > 0) : ?>
                                            <span class="badge badge-soft-secondary">
                                                <?php echo $this->user->info->noti_count ?>
                                            </span>
                                        <?php endif; ?>
                                    </a>

                                    <div class="dropdown-menu notification-container dropdown-menu-right">
                                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                                            <a href="<?php echo site_url("home/notifications") ?>" class="mdi mdi-18px mdi-settings text-muted" ></a>
                                            <span class="h5 m-0">
                                                <?php echo lang("ctn_412") ?> <?php if($this->user->info->noti_count > 0) : ?>
                                                    <span class="badge badge-soft-secondary" id="noti-click-unread" onclick="load_notifications_unread()"><?php echo $this->user->info->noti_count ?></span>
                                                <?php endif; ?>
                                            </span>
                                            <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                                        </div>
                                        <div class="notification-events bg-gray-300">
                                            <div class="text-overline m-b-5">today</div>
                                            <a href="#" class="d-block m-b-10">
                                                <div class="card">
                                                    <div class="card-body"> <i class="mdi mdi-circle text-success"></i> All systems operational.</div>
                                                </div>
                                            </a>
                                            <a href="#" class="d-block m-b-10">
                                                <div class="card">
                                                    <div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload successful.</div>
                                                </div>
                                            </a>
                                            <a href="#" class="d-block m-b-10">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-sm avatar-online">
                                        <span class="avatar-title rounded-circle bg-dark"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar"></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right"   >
                                    <a class="dropdown-item" href="<?php echo site_url("profile/" . $this->user->info->username) ?>">Profile</a>
                                    <a class="dropdown-item" href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_156") ?></a>
                                    <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings"), $this->user)) : ?>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_157") ?></a>
                                    <?php endif; ?>
                                    <a class="dropdown-item" href="#">Help</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#aboutusmodal">About</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_149") ?></a>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </header>

            <div class="modal fade" id="aboutusmodal" tabindex="-1" role="dialog" aria-labelledby="aboutusmodal" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content bg-dark bg-cover" style="background-image: url('<?php echo base_url();?>assets/img/patterns/circles.svg')">
                        <div class="modal-body">
                            <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="text-white p-b-10">
                                <div class="avatar avatar-xl my-auto">
                                    <div class="avatar-title bg-success rounded-circle">
                                        <i class="mdi mdi-information-outline"></i>
                                    </div>
                                </div>
                                <h5 class="p-t-20">About <?php echo $this->settings->info->site_name ?> V <?php echo $this->settings->version ?></h5>
                                <p class="opacity-75">
                                We are, seriously awesome.
                                </p>
                                <p class="opacity-50">
                                    &copy; 2019 - <?PHP echo date("Y"); ?> - <?php echo $this->settings->info->site_name ?>
                                </p>
                                <p></p>
                                <p class="Text-Primary">
                                    <?php echo lang("ctn_430") ?>: <a href="<?php echo site_url("members/index/1") ?>"><?php echo $this->settings->info->currently_online ?></a>
                                </p>
                                <p>
                                    <a href="<?php echo site_url("home/change_language") ?>"><?php echo lang("ctn_171") ?></a>
                                </p>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="admin-content">
                <div class="">

                    <?php $gl = $this->session->flashdata('globalmsg'); ?>
                    <?php if(!empty($gl)) :?>
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="alert alert-success"><b><span class="fas fa-check"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                                    </div>
                                </div>
                    <?php endif; ?>

                    <?php echo $content ?>

                </div>
            </section>

        </main>

<?php if($this->user->info->admin) : ?>
    <div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body p-all-0" id="site-search">
                    <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
                        <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                        <div class="container-fluid">
                            <div class="col-md-10 p-t-10 m-auto">
                                <input type="search" placeholder="Search Something"
                                    class=" search form-control form-control-lg">

                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                            results
                        </div>
                        <div class="list-group list  ">


                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"   src="<?php echo base_url();?>assets/img/users/user-3.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Eric Chen</div>
                                    <div class="text-muted">Developer</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                        src="<?php echo base_url();?>assets/img/users/user-4.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Sean Valdez</div>
                                    <div class="text-muted">Marketing</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                        src="<?php echo base_url();?>assets/img/users/user-8.jpg" alt="user-image"></div>
                                </div>
                                <div class="">
                                    <div class="name">Marie Arnold</div>
                                    <div class="text-muted">Developer</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">SRS Document</div>
                                    <div class="text-muted">25.5 Mb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-dark rounded"><i
                                                    class="mdi mdi-24px mdi-file-document-box"></i></div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">Design Guide.pdf</div>
                                    <div class="text-muted">9 Mb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm  ">
                                            <div class="avatar-title bg-primary rounded"><i
                                                        class="mdi mdi-24px mdi-code-braces"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">response.json</div>
                                    <div class="text-muted">15 Kb</div>
                                </div>


                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar avatar-sm ">
                                            <div class="avatar-title bg-info rounded"><i
                                                        class="mdi mdi-24px mdi-file-excel"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="name">June Accounts.xls</div>
                                    <div class="text-muted">6 Mb</div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php endif; ?>



    <!-- SCRIPTS -->
    <script src="<?php echo base_url();?>scripts/custom/global.js"></script>
        <script src="<?php echo base_url();?>assets/vendor/popper/popper.js"   ></script>
        <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"   ></script>
        <script src="<?php echo base_url();?>assets/vendor/select2/js/select2.full.min.js"   ></script>
        <script src="<?php echo base_url();?>assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"   ></script>
        <script src="<?php echo base_url();?>assets/vendor/listjs/listjs.min.js"   ></script>
        <script src="<?php echo base_url();?>assets/vendor/moment/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendor/daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/vendor/bootstrap-notify/bootstrap-notify.min.js"   ></script>
        <script src="<?php echo base_url();?>assets/js/atmos.min.js"></script>
    <script type="text/javascript">
      $.widget.bridge('uitooltip', $.ui.tooltip);
    </script>

     <script type="text/javascript">

     function accept_cookie() {
              $.ajax({
                url: global_base_url + 'login/accept_cookie',
                data: {
                  hash : global_hash
                },
                success: function(msg) {
                  $('#cookie-consent').fadeOut(100);
                }
              });
            }
    </script>
    </body>
</html>
