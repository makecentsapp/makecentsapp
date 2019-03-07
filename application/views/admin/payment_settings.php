<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_246") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-file-invoice-dollar"></i>
                    </span>
                    <?php echo lang("ctn_246") ?>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("admin/payment_settings_pro"), array("class" => "form-horizontal")) ?>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_251") ?></label>
                            <div class="col-sm-10">
                                <input type="checkbox" class="" id="name-in" name="payment_enabled" <?php if($this->settings->info->payment_enabled) echo "checked" ?> value="1">
                                <span class="form-text text-muted small"><?php echo lang("ctn_252") ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_286") ?></label>
                            <div class="col-sm-10">
                                <input type="checkbox" id="name-in" name="global_premium" <?php if($this->settings->info->global_premium) echo "checked" ?> value="1">
                                <span class="form-text text-muted small"><?php echo lang("ctn_287") ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_253") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name-in" name="paypal_email" placeholder="" value="<?php echo $this->settings->info->paypal_email ?>">
                                <span class="form-text text-muted small"><?php echo lang("ctn_254") ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_255") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name-in" name="paypal_currency" placeholder="" value="<?php echo $this->settings->info->paypal_currency ?>">
                                <span class="form-text text-muted small"><?php echo lang("ctn_256") ?>: <a href="https://developer.paypal.com/docs/classic/api/currency_codes/">https://developer.paypal.com/docs/classic/api/currency_codes/</a>.</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_257") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name-in" name="payment_symbol" placeholder="" value="<?php echo $this->settings->info->payment_symbol ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_376") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name-in" name="stripe_secret_key" placeholder="" value="<?php echo $this->settings->info->stripe_secret_key ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_377") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name-in" name="stripe_publish_key" placeholder="" value="<?php echo $this->settings->info->stripe_publish_key ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_397") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name-in" name="checkout2_secret" placeholder="" value="<?php echo $this->settings->info->checkout2_secret ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name-in" class="col-sm-2 col-form-label"><?php echo lang("ctn_398") ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name-in" name="checkout2_accountno" placeholder="" value="<?php echo $this->settings->info->checkout2_accountno ?>">
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>



