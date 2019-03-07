<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_224") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_225") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-user-cog"></i>
                    </span>
                    <?php echo lang("ctn_225") ?>
                </h4>
                <p><?php echo lang("ctn_237") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header">

                    <div class="float-right m-2">
                        <a href="<?php echo site_url("user_settings") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_224_1") ?></a>
                        <a href="<?php echo site_url("user_settings/social_networks") ?>" class="btn btn-info btn-sm"><?php echo lang("ctn_422") ?></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo form_open(site_url("user_settings/change_password_pro"), array("class" => "form-horizontal")) ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label"><?php echo lang("ctn_238") ?></label>
                                <div class="">
                                  <input type="password" class="form-control" name="current_password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label"><?php echo lang("ctn_239") ?></label>
                                <div class="">
                                  <input type="password" class="form-control" name="new_pass1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label"><?php echo lang("ctn_240") ?></label>
                                <div class="">
                                  <input type="password" class="form-control" name="new_pass2">
                                </div>
                            </div>
                             <input type="submit" name="s" value="<?php echo lang("ctn_241") ?>" class="btn btn-primary" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

