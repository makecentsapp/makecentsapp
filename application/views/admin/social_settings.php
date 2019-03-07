<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_115") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fab fa-facebook-square"></i>
                    </span>
                    <?php echo lang("ctn_115") ?>
                </h4>
                <p><?php echo lang("ctn_116") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("admin/social_settings_pro"), array("class" => "form-horizontal")) ?>

                    <div class="row mb-3">
                        <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_117") ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" id="name-in" name="disable_social_login" value="1" <?php if($this->settings->info->disable_social_login) echo "checked" ?>>
                            <span class="form-text text-muted"><?php echo lang("ctn_118") ?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_119") ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name-in" name="twitter_consumer_key" placeholder="" value="<?php echo $this->settings->info->twitter_consumer_key ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_120") ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name-in" name="twitter_consumer_secret" placeholder="" value="<?php echo $this->settings->info->twitter_consumer_secret ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_121") ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name-in" name="facebook_app_id" placeholder="" value="<?php echo $this->settings->info->facebook_app_id ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_122") ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name-in" name="facebook_app_secret" placeholder="" value="<?php echo $this->settings->info->facebook_app_secret ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_123") ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name-in" name="google_client_id" placeholder="" value="<?php echo $this->settings->info->google_client_id ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_124") ?></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name-in" name="google_client_secret" placeholder="" value="<?php echo $this->settings->info->google_client_secret ?>">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
