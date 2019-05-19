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

                <?php if(!empty($fail)) : ?>
                    <div class="alert alert-danger"><?php echo $fail ?></div>
                <?php endif; ?>

                <h3 class="text-center p-b-20 fw-400">Register</h3>
                    <?php echo form_open(site_url("register"), array("id" => "register_form")) ?>
                    <div class="form-row">
                        <div class="form-group floating-label col-md-12">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="<?php echo lang("ctn_214") ?>">
                        </div>
                        <div class="form-group floating-label col-md-12">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo lang("ctn_215") ?>">
                        </div>
                        <div class="form-group floating-label col-md-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="*********">
                        </div>
                        <div class="form-group floating-label col-md-12">
                            <label>Password Again</label>
                            <input type="password" name="password2" class="form-control" placeholder="*********">
                        </div>
                    </div>

                    <?php foreach($fields->result() as $r) : ?>
                        <div class="form-group floating-label col-md-12">

                            <p><label for="name-in" class="col-form-label"><?php echo $r->name ?> <?php if($r->required) : ?>*<?php endif; ?></label></p>

                            <?php if($r->type == 0) : ?>
                                <input type="text" class="form-control" id="name-in" name="cf_<?php echo $r->ID ?>" value="<?php if(isset($_POST['cf_'. $r->ID])) echo $_POST['cf_' . $r->ID] ?>">
                            <?php elseif($r->type == 1) : ?>
                                <textarea name="cf_<?php echo $r->ID ?>" rows="8" class="form-control"><?php if(isset($_POST['cf_'. $r->ID])) echo $_POST['cf_' . $r->ID] ?></textarea>
                            <?php elseif($r->type == 2) : ?>
                                    <?php $options = explode(",", $r->options); ?>
                                <?php if(count($options) > 0) : ?>
                                    <?php foreach($options as $k=>$v) : ?>
                                    <div class="form-group"><input type="checkbox" name="cf_cb_<?php echo $r->ID ?>_<?php echo $k ?>" value="1" <?php if(isset($_POST['cf_cb_' . $r->ID . "_" . $k])) echo "checked" ?>> <?php echo $v ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php elseif($r->type == 3) : ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if(count($options) > 0) : ?>
                                    <?php foreach($options as $k=>$v) : ?>
                                    <div class="form-group"><input type="radio" name="cf_radio_<?php echo $r->ID ?>" value="<?php echo $k ?>" <?php if(isset($_POST['cf_radio_' . $r->ID]) && $_POST['cf_radio_' . $r->ID] == $k) echo "checked" ?>> <?php echo $v ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php elseif($r->type == 4) : ?>
                                <?php $options = explode(",", $r->options); ?>
                                <?php if(count($options) > 0) : ?>
                                    <select name="cf_<?php echo $r->ID ?>" class="form-control">
                                    <?php foreach($options as $k=>$v) : ?>
                                    <option value="<?php echo $k ?>" <?php if(isset($_POST['cf_' . $r->ID]) && $_POST['cf_'.$r->ID] == $k) echo "selected" ?>><?php echo $v ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            <?php endif; ?>
                            <span class="form-text text-muted"><?php echo $r->help_text ?></span>
                        </div>
                    <?php endforeach; ?>


                    <?php if(!$this->settings->info->disable_captcha) : ?>
                        <div class="form-group floating-label col-md-12">
                            <p><?php echo $cap['image'] ?></p>
                            <input type="text" class="form-control" id="captcha-in" name="captcha" placeholder="<?php echo lang("ctn_306") ?>" value="">
                        </div>
                    <?php endif; ?>

                    <?php if($this->settings->info->google_recaptcha) : ?>
                        <div class="form-group floating-label col-md-12">
                            <div class="g-recaptcha" data-sitekey="<?php echo $this->settings->info->google_recaptcha_key ?>"></div> 
                        </div>
                    <?php endif ?>

                    <button type="submit" name="s" class="btn btn-primary btn-block btn-lg"><?php echo lang("ctn_221") ?></button>

                    <hr>

                    <p><?php echo lang("ctn_222") ?></p>

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

                    <p class="form-inline p-t-10">
                    <a href="<?php echo site_url("login") ?>" class="text-underline mr-auto"><?php echo lang("ctn_473") ?></a>
                    </p>
            </div>
        <?php echo form_close() ?>
        </div>
    </div>
    <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('<?php echo base_url() ?>assets/img/login.svg');">
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var form = "register_form";
    $('#'+form + ' input').on("focus", function(e) {
      clearerrors();
    });

    $('#username').on("change", function() {
    	$.ajax({
	        url : global_base_url + "register/check_username",
	        type : 'GET',
	        data : {
	          username : $(this).val(),
	        },
	        dataType: 'JSON',
	        success: function(data) {
	        	if(data.success) {
							$("#username").removeClass("is-invalid");
	        		$("#username").addClass("is-valid");
	        	} else {
							$("#username").removeClass("is-valid");
							$("#username").addClass("is-invalid");
	        		if(data.field_errors) {
			            var errors = data.fieldErrors;
			            for (var property in errors) {
			                if (errors.hasOwnProperty(property)) {
			                    // Find form name
			                    var field_name = '#' + form + ' input[name="'+property+'"]';
			                    $(field_name).addClass("is-invalid r");
			                    if(errors[property]) {
				                    // Get input group of field
				                    $(field_name).parent().closest('.form-group').after('<div class="form-error">'+errors[property]+'</div>');
				                }
			                    

			                }
			            }
			          }
	        	}
	        }
	    });
    });

    $('#email').on("change", function() {
    	$.ajax({
	        url : global_base_url + "register/check_email",
	        type : 'GET',
	        data : {
	          email : $(this).val(),
	        },
	        dataType: 'JSON',
	        success: function(data) {
	        	if(data.success) {
	        		$("#email").removeClass("is-invalid");
	        		$("#email").addClass("is-valid");
	        	} else {
							$("#email").removeClass("is-valid");
							$("#email").addClass("is-invalid");
	        		if(data.field_errors) {
			            var errors = data.fieldErrors;
			            for (var property in errors) {
			                if (errors.hasOwnProperty(property)) {
			                    // Find form name
			                    var field_name = '#' + form + ' input[name="'+property+'"]';
			                    $(field_name).addClass("is-invalid t");
			                    if(errors[property]) {
				                    // Get input group of field
				                    $(field_name).parent().closest('.form-group').after('<div class="form-error">'+errors[property]+'</div>');
				                }
			                    

			                }
			            }
			          }
	        	}
	        }
	    });
    });

    $('#'+form).on("submit", function(e) {

      e.preventDefault();
      // Ajax check
      var data = $(this).serialize();
      $.ajax({
        url : global_base_url + "register/ajax_check_register",
        type : 'POST',
        data : {
          formData : data,
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash() ?>'
        },
        dataType: 'JSON',
        success: function(data) {
          if(data.error) {
            $('#'+form).prepend('<div class="form-group is-invalid form-error">'+data.error_msg+'</div>');
          }
          if(data.success) {
            // allow form submit
            $('#'+form).unbind('submit').submit();
          }
          if(data.field_errors) {
            var errors = data.fieldErrors;
            for (var property in errors) {
                if (errors.hasOwnProperty(property)) {
                    // Find form name
                    var field_name = '#' + form + ' input[name="'+property+'"]';
                    $(field_name).addClass("is-invalid tt");
                    if(errors[property]) {
	                    // Get input group of field
	                    $(field_name).parent().closest('.form-group').after('<div class="form-error">'+errors[property]+'</div>');
	                }
                    

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
    //$('.is-invalid').remove();
  }
</script>