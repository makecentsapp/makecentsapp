<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_66") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-user-times"></i>
                    </span>
                    <?php echo lang("ctn_66") ?>
                </h4>
                <p><?php echo lang("ctn_67") ?></p>
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
                                        <input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_65") ?>" data-toggle="modal" data-target="#ipModal" />
                                    </div>
                                    <table class="table table-bordered tbl">
                                        <tr class="table-header">
                                            <td><?php echo lang("ctn_68") ?></td>
                                            <td><?php echo lang("ctn_69") ?></td>
                                            <td><?php echo lang("ctn_70") ?></td>
                                            <td><?php echo lang("ctn_52") ?></td>
                                        </tr>
                                        <?php foreach($ipblock->result() as $r) : ?>
                                            <tr>
                                                <td><?php echo $r->IP ?></td>
                                                <td><?php echo $r->reason ?></td>
                                                <td><?php echo date($this->settings->info->date_format, $r->timestamp) ?></td>
                                                <td><a href="<?php echo site_url("admin/delete_ipblock/" . $r->ID) ?>" class="btn btn-danger btn-xs" title="<?php echo lang("ctn_57") ?>"><span class="fas fa-trash"></span></a></td>
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

<div class="modal fade" id="ipModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_71") ?></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(site_url("admin/add_ipblock"), array("class" => "form-horizontal")) ?>
                <div class="row mb-3">
                    <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_68") ?></label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="email-in" name="ip">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_72") ?></label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" id="username" name="reason">
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
