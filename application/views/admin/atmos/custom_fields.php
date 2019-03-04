<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_346") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="far fa-list-alt"></i>
                    </span>
                    <?php echo lang("ctn_346") ?>
                </h4>
                <p class="opacity-75"><?php echo lang("ctn_372") ?></p>
            </div>
        </div>
    </div>
</div>



<div class="container pull-up col-10">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table">
                        <div id="table_wrapper01" class="datatables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-right form-inline mb-2">
                                        <input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_373") ?>" data-toggle="modal" data-target="#memberModal" />
                                    </div>

                                    <table class="table datatable table-hover table-striped">
                                        <tr class="table-header">
                                            <td><?php echo lang("ctn_352") ?></td>
                                            <td><?php echo lang("ctn_358") ?></td>
                                            <td><?php echo lang("ctn_52") ?></td>
                                        </tr>
                                        <?php foreach($fields->result() as $r) : ?>
                                            <?php if($r->type == 0) {
                                                $type = lang("ctn_357");
                                            } elseif($r->type == 1) {
                                                $type = lang("ctn_353");
                                            } elseif($r->type == 2) {
                                                $type = lang("ctn_354");
                                            } elseif($r->type == 3) {
                                                $type = lang("ctn_355");
                                            } elseif($r->type == 4) {
                                                $type = lang("ctn_356");
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $r->name ?></td>
                                                <td><?php echo $type ?></td>
                                                <td>
                                                    <a href="<?php echo site_url("admin/edit_custom_field/" . $r->ID) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_55") ?>">
                                                        <span class="fas fa-cog"></span>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/delete_custom_field/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" onclick="return confirm('<?php echo lang("ctn_317") ?>')" title="<?php echo lang("ctn_57") ?>">
                                                        <span class="fas fa-trash"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_373") ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php echo form_open(site_url("admin/add_custom_field_pro"), array("class" => "form-horizontal")) ?>
            <div class="row mb-3">
                    <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_352") ?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="email-in" name="name">
                    </div>
            </div>
            <div class="row mb-3">
                    <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_358") ?></label>
                    <div class="col-md-9">
                        <select name="type" class="form-control">
                        <option value="0"><?php echo lang("ctn_357") ?></option>
                        <option value="1"><?php echo lang("ctn_353") ?></option>
                        <option value="2"><?php echo lang("ctn_354") ?></option>
                        <option value="3"><?php echo lang("ctn_355") ?></option>
                        <option value="4"><?php echo lang("ctn_356") ?></option>
                        </select>
                    </div>
            </div>
            <div class="row mb-3">
                    <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_359") ?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="email-in" name="options">
                        <span class="form-text text-muted small"><?php echo lang("ctn_360") ?></span>
                    </div>
            </div>
            <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_361") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="required" value="1"> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_362") ?></span>
                        </div>
                </div>
                <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_363") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="edit" value="1"> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_364") ?></span>
                        </div>
                </div>
                <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_365") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="profile" value="1"> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_366") ?></span>
                        </div>
                </div>
                <div class="row mb-3">
                        <label for="password-in" class="col-md-3 col-form-label"><?php echo lang("ctn_367") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="register" value="1"> <?php echo lang("ctn_53") ?>
                            <span class="form-text text-muted small"><?php echo lang("ctn_368") ?></span>
                        </div>
                </div>

                <div class="row mb-3">
                        <label for="cpassword-in" class="col-md-3 col-form-label"><?php echo lang("ctn_369") ?></label>
                        <div class="col-md-9">
                            <input type="text" name="help_text" class="form-control">
                            <span class="form-text text-muted small"><?php echo lang("ctn_370") ?></span>
                        </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
        <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_373") ?>" />
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
