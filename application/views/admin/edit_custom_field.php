<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin/custom_fields") ?>"><?php echo lang("ctn_346") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_371") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-th-list"></i>
                    </span>
                    <?php echo lang("ctn_371") ?>
                </h4>
                <p class="opacity-75">Change custom field properties or settings</p>
            </div>
        </div>
    </div>
</div>


<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("admin/edit_custom_field_pro/" . $field->ID), array("class" => "form-horizontal")) ?>
                    <div class="row mb-3">
                        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_352") ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="email-in" name="name" value="<?php echo $field->name ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_358") ?></label>
                        <div class="col-md-9">
                            <select name="type" class="form-control">
                                <option value="0"><?php echo lang("ctn_357") ?></option>
                                <option value="1" <?php if($field->type == 1) echo "selected" ?>><?php echo lang("ctn_353") ?></option>
                                <option value="2" <?php if($field->type == 2) echo "selected" ?>><?php echo lang("ctn_354") ?></option>
                                <option value="3" <?php if($field->type == 3) echo "selected" ?>><?php echo lang("ctn_355") ?></option>
                                <option value="4" <?php if($field->type == 4) echo "selected" ?>><?php echo lang("ctn_356") ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_359") ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="email-in" name="options" value="<?php echo $field->options ?>">
                            <span class="form-text text-muted small"><?php echo lang("ctn_360") ?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_361") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="required" value="1" <?php if($field->required) echo "checked" ?>> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_362") ?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_363") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="edit" value="1" <?php if($field->edit) echo "checked" ?>> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_364") ?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_365") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="profile" value="1" <?php if($field->profile) echo "checked" ?>> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_366") ?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_367") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="register" value="1" <?php if($field->register) echo "checked" ?>> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_368") ?></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cpassword-in" class="col-md-3 col-form-label"><?php echo lang("ctn_369") ?></label>
                        <div class="col-md-9">
                            <input type="text" name="help_text" class="form-control" value="<?php echo $field->help_text ?>">
                            <span class="form-text text-muted small"><?php echo lang("ctn_370") ?></span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_371") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
