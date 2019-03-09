<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>
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
        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        var global_hash = "<?php echo $this->security->get_csrf_hash() ?>";
        </script>

        <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"   ></script>
        <script src="<?php echo base_url();?>assets/vendor/jquery-ui/jquery-ui.min.js"   ></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $( document ).tooltip();
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

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?>

    </head>
<body class="jumbo-page">

    <?php if($this->settings->info->cookie_option && !$accept_cookies) : ?>
        <div id="cookie-consent">
            <?php echo lang("ctn_483") ?> <a href="<?php echo site_url("login/privacy") ?>"><?php echo lang("ctn_481") ?></a>. <div class="cookie-close-box"><input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_482") ?>" onclick="accept_cookie()"></div>
        </div>
    <?php endif; ?>

<main class="admin-main  ">
    <div class="container-fluid" id="contentcontainer">
        <?php echo $content ?>
    </div>
</main>

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

</body>
</html>
