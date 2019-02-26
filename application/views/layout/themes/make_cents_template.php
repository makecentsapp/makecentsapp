<!DOCTYPE html>
<?php if($enable_rtl) : ?>
<html dir="rtl">
<?php else : ?>
<html lang="en">
<?php endif; ?>
    <head>
        <title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <!-- <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


         <!-- Styles -->
        <link href="<?php echo base_url();?>styles/layouts/makecents/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>styles/layouts/makecents/responsive.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url();?>styles/elements.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,500,550,600,700' rel='stylesheet' type='text/css'>
        <!-- <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" /> -->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        var global_hash = "<?php echo $this->security->get_csrf_hash() ?>";
        </script>
        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js "></script> -->

        <!-- New Datatables for BS4 -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.css"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.js"></script>

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

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?>

        <!-- Favicon: http://realfavicongenerator.net -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url() ?>images/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo base_url() ?>images/favicon/manifest.json">
        <link rel="mask-icon" href="<?php echo base_url() ?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <!-- Smart Forms - added by PM 2/22-->
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>styles/smartForms/smart-forms.css">
        <link rel="stylesheet" type="text/css"  href="<?php echo base_url();?>styles/smartForms/smart-addons.css">

        <script type="text/javascript" src="<?php echo base_url();?>scripts/libraries/smartForms/jquery.steps.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>scripts/libraries/smartForms/jquery-ui-custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>scripts/libraries/smartForms/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>scripts/libraries/smartForms/additional-methods.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>scripts/libraries/smartForms/jquery.form.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>scripts/libraries/smartForms/smart-form.js"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->


    </head>
    <body>

      <?php if($this->settings->info->cookie_option && !$accept_cookies) : ?>
      <div id="cookie-consent">
        <?php echo lang("ctn_483") ?> <a href="<?php echo site_url("login/privacy") ?>"><?php echo lang("ctn_481") ?></a>. <div class="cookie-close-box"><input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_482") ?>" onclick="accept_cookie()"></div>
      </div>
  <?php endif; ?>


    <nav class="navbar navbar-expand-md sticky-top navbar-inverse navbar-header2 py-0">
        <!-- <div class="conatiner-fluid"> -->
            <?php if($this->settings->info->logo_option) : ?>
                <a class="navbar-brand navbar-brand-two" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" width="123" height="32"></a>
            <?php else : ?>
                <a class="navbar-brand" style="max-height:54px; padding:5px !important;" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><?php echo $this->settings->info->site_name ?></a>
            <?php endif; ?>
            <span class="badge badge-success">BS4</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar" >
                <?php if($this->user->loggedin) : ?>
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto d-flex justify-content-center align-items-center">
                        <li class="py-0 nav-item dropdown">
                            <a class="nav-link h-50" href="#" data-target="#" onclick="load_notifications()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="noti-menu-drop">
                                <span class="fas fa-bell notification-icon"></span>
                                <?php if($this->user->info->noti_count > 0) : ?>
                                    <span class="badge notification-badge small-text">
                                    <?php echo $this->user->info->noti_count ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="noti-menu-drop">
                                <li class="py-0 nav-item">
                                    <div class="notification-box-title">
                                        <?php echo lang("ctn_412") ?> <?php if($this->user->info->noti_count > 0) : ?>
                                            <span class="badge click" id="noti-click-unread" onclick="load_notifications_unread()"><?php echo $this->user->info->noti_count ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div id="notifications-scroll">
                                        <div id="loading_spinner_notification">
                                            <span class="fas fa-redo" id="ajspinner_notification"></span>
                                        </div>
                                    </div>
                                    <div class="notification-box-footer">
                                        <a class="nav-link" href="<?php echo site_url("home/notifications") ?>"><?php echo lang("ctn_414") ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="py-0 nav-item user_bit"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar">
                            <a class="nav-link h-50" href="javascript:void(0)" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo $this->user->info->username ?></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <li class="py-0 nav-item">
                                    <a class="nav-link" href="<?php echo site_url("profile/" . $this->user->info->username) ?>">Profile</a>
                                </li>
                                <li class="py-0 nav-item">
                                    <a class="nav-link h-50" href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_156") ?></a>
                                </li>
                                <?php if($this->common->has_permissions(array("admin", "admin_members", "admin_payment", "admin_settings"), $this->user)) : ?>
                                    <li role="separator" class="divider">
                                    </li>
                                    <li class="py-0 nav-item">
                                        <a class="nav-link h-50" href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_157") ?></a>
                                    </li>
                                 <?php endif; ?>
                            </ul>
                        </li>
                        <li class="py-0 nav-item">
                            <a class="nav-link h-50" href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_149") ?></a>
                        </li>
                <?php else : ?>
                        <li class="py-0 nav-item">
                            <a class="nav-link h-50" href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a>
                        </li>
                        <li class="py-0 nav-item">
                            <a class="nav-link h-50" href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        <!-- </div> -->
    </nav>


    <div class="sidebar">
      <?php if(isset($sidebar)) : ?>
          <?php echo $sidebar ?>
        <?php endif; ?>
          <?php include(APPPATH . "views/layout/makecents_sidebar_links.php") ?>
    </div>

    <div id="main-content">

        <?php include(APPPATH . "views/layout/mobile_links.php") ?>

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
    <div id="footer" class="clearfix">
        <span class="float-left"><?php echo lang("ctn_170") ?>
            <a href="https://www.patchesoft.com/">Patchesoft</a>
            <?php echo $this->settings->info->site_name ?> V<?php echo $this->settings->version ?>
        </span>
        <span class="float-right"><?php echo lang("ctn_430") ?>: <a href="<?php echo site_url("members/index/1") ?>"><?php echo $this->settings->info->currently_online ?></a> - <a href="<?php echo site_url("home/change_language") ?>"><?php echo lang("ctn_171") ?></a>
        </span>
    </div>

    <!-- SCRIPTS -->
    <script src="<?php echo base_url();?>scripts/custom/global.js"></script>
    <!-- <script src="<?php echo base_url();?>scripts/libraries/jquery.nicescroll.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script type="text/javascript">
      $.widget.bridge('uitooltip', $.ui.tooltip);
    </script>

    <!-- 2/23/19 BW Bootstrap 4.3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script> -->

     <script type="text/javascript">
            $(document).ready(function() {
              $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    <script type="text/javascript">
     $(document).ready(function() {
        // Get sidebar height
        resize_layout();
        var sb_h = $('.sidebar').height();
        var mc_h = $('#main-content').height();
        if(sb_h > mc_h) {
          $('#main-content').css("min-height", sb_h+50 + "px");
        }

        $('.nav-sidebar li').on('shown.bs.collapse', function () {
           $(this).find(".fa-chevron-right")
                 .removeClass("fa-chevron-right")
                 .addClass("fa-chevron-down");
            resize_layout();
        });
        $('.nav-sidebar li').on('hidden.bs.collapse', function () {
           $(this).find(".fa-chevron-down")
                 .removeClass("fa-chevron-down")
                 .addClass("fa-chevron-right");
            resize_layout();
        });

        function resize_layout()
        {
          var sb_h = $('.sidebar').height();
          var mc_h = $('#main-content').height();
          var w_h = $(window).height();
          if(sb_h > mc_h) {
            $('#main-content').css("min-height", sb_h+50 + "px");
          }
          if(w_h > mc_h) {
            $('#main-content').css("min-height", (w_h-(51+30)) +"px");
          }
        }
     });

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
