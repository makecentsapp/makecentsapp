<div class="row ">
    <div class="col-lg-4  bg-white">
        <div class="row align-items-center m-h-100">
            <?php $gl = $this->session->flashdata('globalmsg'); ?>
            <?php if(!empty($gl)) :?>
                <div class="alert alert-success">
                    <b><span class="fas fa-check"></span></b>
                    <?php echo $this->session->flashdata('globalmsg') ?>
                </div>
            <?php endif; ?>
            <div class="mx-auto col-md-8">
                <div class="p-b-20 text-center">
                    <p>
                        <img src="<?php echo base_url() ?>assets/img/logo.svg" width="80" alt="">

                    </p>
                    <p class="admin-brand-content">
                        <?php echo $this->settings->info->site_name ?>
                    </p>
                </div>
                <h3 class="text-center p-b-20 fw-400">Login</h3>
                    <?php if(isset($_GET['redirect'])) : ?>
                        <?php echo form_open(site_url("login/pro/" . urlencode($_GET['redirect'])), array("id" => "login_form")) ?>
                    <?php else : ?>
                        <?php echo form_open(site_url("login/pro"), array("id" => "login_form")) ?>
                    <?php endif; ?>
                    <div class="form-row">
                        <div class="form-group floating-label col-md-12">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" placeholder="<?php echo lang("ctn_303") ?>">
                        </div>
                        <div class="form-group floating-label col-md-12">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="*********">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo lang("ctn_150") ?></button>
                </form>
                <p class="form-inline p-t-10">
                    <a href="<?php echo site_url("login/forgotpw") ?>" class="text-underline mr-auto"><?php echo lang("ctn_181") ?></a>
                    <a href="<?php echo site_url("register") ?>" class="text-underline ml-auto"><?php echo lang("ctn_151") ?></a>
                </p>
                <?php if(!$this->settings->info->disable_social_login) : ?>
                    <div class="d-flex justify-content-between p-t-10">
                        <?php if(!empty($this->settings->info->twitter_consumer_key) && !empty($this->settings->info->twitter_consumer_secret)) : ?>
                            <div class="btn-group">
                                <a href="<?php echo site_url("login/twitter_login") ?>" class="btn btn-lg btn-social-icon btn-twitter" >
                                    <span class="fab fa-twitter"></span><!-- Sign in with Twitter -->
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($this->settings->info->facebook_app_id) && !empty($this->settings->info->facebook_app_secret)) : ?>
                            <div class="btn-group">
                                <a href="<?php echo site_url("login/facebook_login") ?>" class="btn btn-lg btn-social-icon btn-facebook" >
                                    <span class="fab fa-facebook"></span> <!-- Sign in with Facebook -->
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($this->settings->info->google_client_id) && !empty($this->settings->info->google_client_secret)) : ?>
                            <div class="btn-group">
                                <a href="<?php echo site_url("login/google_login") ?>" class="btn btn-lg btn-social-icon btn-google" >
                                  <span class="fab fa-google"></span> <!-- Sign in with Google -->
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php echo form_close() ?>
        </div>
    </div>
    <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('<?php echo base_url() ?>assets/img/login.svg');">
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var form = "login_form";
    $('#'+form + ' input').on("focus", function(e) {
      clearerrors();
    });
    $('#'+form).on("submit", function(e) {

      e.preventDefault();
      // Ajax check
      var data = $(this).serialize();
      $.ajax({
        url : global_base_url + "login/ajax_check_login",
        type : 'POST',
        data : {
          formData : data,
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash() ?>'
        },
        dataType: 'JSON',
        success: function(data) {
          if(data.error) {
            $('#'+form).prepend('<div class="form-error">'+data.error_msg+'</div>');
          }
          if(data.success) {
            // allow form submit
            $('#'+form+ ' input[type="submit"]').val("Logging In ...");
            $('#'+form).unbind('submit').submit();
          }
          if(data.field_errors) {
            var errors = data.fieldErrors;
            console.log(errors);
            for (var property in errors) {
                if (errors.hasOwnProperty(property)) {
                    // Find form name
                    var field_name = '#' + form + ' input[name="'+property+'"]';
                    $(field_name).addClass("errorField");
                    // Get input group of field
                    $('#'+form).prepend('<div class="form-error">'+errors[property]+'</div>');


                }
            }
          }
        }
      });

      return false;


    });
  });

  function clearerrors()
  {
    console.log("Called");
    $('.form-error').remove();
    $('.errorField').removeClass('errorField');
  }
</script>
