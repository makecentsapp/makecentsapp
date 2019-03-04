<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_15") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-users"></i>
                    </span>
                    <?php echo lang("ctn_15") ?>
                </h4>
                <p><?php echo lang("ctn_51") ?></p>
            </div>
        </div>
    </div>
</div>


<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table">
                        <div id="table_wrapper01" class="datatables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-right form-inline mb-2">
                                        <input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_14") ?>" data-toggle="modal" data-target="#memberModal" />
                                    </div>
								    <table class="table datatable table-hover table-striped">
								        <tr class="table-header">
								            <td><?php echo lang("ctn_18") ?></td>
								            <td><?php echo lang("ctn_19") ?></td>
								            <td><?php echo lang("ctn_52") ?></td>
								        </tr>
								        <?php foreach($groups->result() as $r) : ?>
								            <tr>
								                <td><?php echo $r->name ?></td>
								                <td><?php if($r->default) { echo lang("ctn_53");}else{ echo lang("ctn_54"); } ?></td>
								                <td><a href="<?php echo site_url("admin/edit_group/" . $r->ID) ?>" class="btn btn-warning btn-xs" title="<?php echo lang("ctn_55") ?>">
								                    <span class="fas fa-cog"></span>
								                </a>
								                <a href="<?php echo site_url("admin/delete_group/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" onclick="return confirm('<?php echo lang("ctn_56") ?>')" title="<?php echo lang("ctn_57") ?>">
								                    <span class="fas fa-trash"></span>
								                </a>
								                <a href="<?php echo site_url("admin/view_group/" . $r->ID) ?>" class="btn btn-primary btn-xs"><?php echo lang("ctn_58") ?></a>
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
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_14") ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(site_url("admin/add_group_pro"), array("class" => "form-horizontal")) ?>
                    <div class="row mb-3">
                        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_18") ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="email-in" name="name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_19") ?></label>
                        <div class="col-md-9">
                            <input type="checkbox" name="default_group" value="1">
                            <span class="form-text text-muted small"><?php echo lang("ctn_59") ?></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
                    <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_61") ?>" />
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
