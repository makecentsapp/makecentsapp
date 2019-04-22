<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_146") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-language"></i>
                    </span>
                    <?php echo lang("ctn_146") ?>
                </h4>
                <p><?php echo lang("ctn_147") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <?php echo form_open(site_url("home/change_language_pro"), array("class" => "form-horizontal")) ?>
                    <div class="form-group">
                        <label for="languageselect" class="col-form-label"><?php echo lang("ctn_148") ?></label>
                        <div class="">
                            <select name="languageselect" class="form-control">
                            <?php foreach($languages as $k=>$v) : ?>
                                <option value="<?php echo $k ?>" <?php if($k == $user_lang) echo "selected" ?>><?php echo $v['display_name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_146") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
