<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
      <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_1") ?></a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("admin/user_groups") ?>"><?php echo lang("ctn_15") ?></a></li>
      <li class="breadcrumb-item active"><?php echo lang("ctn_16") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-users-cog"></i>
                    </span>
                    <?php echo lang("ctn_16") ?>
                </h4>
                <p><?php echo lang("ctn_17") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("admin/edit_group_pro/" . $group->ID), array("class" => "form-horizontal")) ?>
                    <div class="row mb-3">
                        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_18") ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="email-in" name="name" value="<?php echo $group->name ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_19") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="default_group" value="1" <?php if($group->default) echo "checked" ?>>
                            <span class="form-text text-muted small"><?php echo lang("ctn_20") ?></span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
