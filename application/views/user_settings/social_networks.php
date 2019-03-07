<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("user_settings") ?>"><?php echo lang("ctn_224") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_422") ?></li>
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
                    <?php echo lang("ctn_422") ?>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="float-right m-2">
                        <a href="<?php echo site_url("user_settings") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_224_1") ?></a>
                        <a href="<?php echo site_url("user_settings/change_password") ?>" class="btn btn-info btn-sm"><?php echo lang("ctn_225") ?></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo form_open(site_url("user_settings/social_networks_pro"), array("class" => "form-horizontal")) ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label"><?php echo lang("ctn_426") ?></label>
                            <div class="">
                              <input type="text" class="form-control" name="twitter" value="<?php echo $user_data->twitter ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label"><?php echo lang("ctn_427") ?></label>
                            <div class="">
                              <input type="text" class="form-control" name="facebook" value="<?php echo $user_data->facebook ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label"><?php echo lang("ctn_428") ?></label>
                            <div class="">
                              <input type="text" class="form-control" name="google" value="<?php echo $user_data->google ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label"><?php echo lang("ctn_429") ?></label>
                            <div class="">
                              <input type="text" class="form-control" name="linkedin" value="<?php echo $user_data->linkedin ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label"><?php echo lang("ctn_425") ?></label>
                            <div class="">
                              <input type="text" class="form-control" name="website" value="<?php echo $user_data->website ?>">
                            </div>
                        </div>

                         <input type="submit" name="s" value="<?php echo lang("ctn_13") ?>" class="btn btn-primary" />
                <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
