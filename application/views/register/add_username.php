<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_206") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                        <i class="fas fa-user"></i>
                    </span>
                    <?php echo lang("ctn_206") ?>
                </h4>
                <p><?php echo lang("ctn_207") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("register/add_username_pro"), array("class" => "form-horizontal")) ?>
                    <div class="form-group">
                        <label for="email-in" class="col-form-label"><?php echo lang("ctn_208") ?></label>
                        <div class="col-lg-12 col-md-12">
                            <input type="email" class="form-control" id="email-in" name="email" value="<?php if(isset($email)) echo $email; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username-in" class="col-form-label"><?php echo lang("ctn_209") ?></label>
                        <div class="col-lg-12 col-md-12">
                            <input type="text" class="form-control" id="username" name="username" value="<?php if(isset($username)) echo $username; ?>">
                        </div>
                    </div>
                    <input type="submit" name="s" value="<?php echo lang("ctn_211") ?>" class="btn btn-primary" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>