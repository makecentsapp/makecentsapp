<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_269") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-file-invoice"></i>
                    </span>
                    <?php echo lang("ctn_269") ?>
                </h4>
                <p><?php echo lang("ctn_270") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("admin/edit_payment_plan_pro/" . $plan->ID), array("class" => "form-horizontal")) ?>
                        <div class="row mb-3">
                            <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_260") ?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="email-in" name="name" value="<?php echo $plan->name ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_271") ?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="email-in" name="description" value="<?php echo $plan->description ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_261") ?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="email-in" name="cost" value="<?php echo $plan->cost ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_266") ?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control jscolor" id="email-in" name="color" value="<?php echo $plan->hexcolor ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_272") ?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control jscolor" id="username" name="fontcolor" value="<?php echo $plan->fontcolor ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_262") ?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="email-in" name="days" value="<?php echo $plan->days ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_347") ?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="username" name="icon" value="<?php echo $plan->icon ?>">
                                <span class="form-text text-muted small"><?php echo lang("ctn_348") ?> <a href="http://getbootstrap.com/components/">http://getbootstrap.com/components/</a>. <?php echo lang("ctn_349") ?></span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
