<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin/email_templates") ?>"><?php echo lang("ctn_3") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_4") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-tasks"></i>
                    </span>
                    <?php echo lang("ctn_4") ?>
                </h4>
                <p><?php echo lang("ctn_5") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("admin/edit_email_template_pro/" . $email_template->ID), array("class" => "form-horizontal")) ?>
                            <div class="row mb-3">
                                <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_81") ?></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="<?php echo $email_template->name ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_11") ?></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="title" value="<?php echo $email_template->title ?>">
                                    <span class="form-text text-muted small"><?php echo lang("ctn_474") ?></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_404") ?></label>
                                <div class="col-md-8">
                                    <select name="hook" class="form-control">
                                        <option value="email_activation"><?php echo lang("ctn_405") ?></option>
                                        <option value="forgot_password" <?php if($email_template->hook == "forgot_password") echo "selected" ?>><?php echo lang("ctn_174") ?></option>
                                        <option value="welcome_email" <?php if($email_template->hook == "welcome_email") echo "selected" ?>><?php echo lang("ctn_475") ?></option>
                        <option value="member_invite" <?php if($email_template->hook == "member_invite") echo "selected" ?>><?php echo lang("ctn_502") ?></option>
                                    </select>
                                    <span class="form-text text-muted small"><?php echo lang("ctn_406") ?></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_148") ?></label>
                                <div class="col-md-8">
                                    <select name="language" class="form-control">
                                        <?php foreach($languages as $k=>$v) : ?>
                                          <option value="<?php echo $k ?>" <?php if($k == $email_template->language) echo "selected" ?>><?php echo $v['display_name'] ?></option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                          </div>
                          <table class="table table-bordered">
                              <tr><td>[NAME]</td><td> <?php echo lang("ctn_7") ?></td></tr>
                              <tr><td>[SITE_URL]</td><td> <?php echo lang("ctn_8") ?></td></tr>
                              <tr><td>[SITE_NAME]</td><td> <?php echo lang("ctn_9") ?></td></tr>
                              <tr><td>[EMAIL_LINK]</td><td> <?php echo lang("ctn_10") ?></td></tr>
                          </table>
                          <div class="row mb-3">
                            <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_3") ?></label>
                            <div class="col-md-12">
                                <textarea name="template" id="ann-area"><?php echo $email_template->message ?></textarea>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_13") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('ann-area', { height: '150'});
    });
</script>
