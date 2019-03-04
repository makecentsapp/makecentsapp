<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_258") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-file-invoice"></i>
                    </span>
                    <?php echo lang("ctn_258") ?>
                </h4>
                <p><?php echo lang("ctn_259") ?></p>
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
                                        <input type="button" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_268") ?>" data-toggle="modal" data-target="#planModal" />
                                    </div>
                                    <table class="table datatable table-hover table-striped">
                                        <tr class="table-header">
                                            <td><?php echo lang("ctn_260") ?></td>
                                            <td><?php echo lang("ctn_261") ?></td>
                                            <td><?php echo lang("ctn_262") ?></td>
                                            <td><?php echo lang("ctn_263") ?></td>
                                            <td><?php echo lang("ctn_52") ?></td>
                                        </tr>
                                        <?php foreach($plans->result() as $r) : ?>
                                            <tr>
                                                <td><?php echo $r->name ?></td>
                                                <td><?php echo number_format($r->cost, 2) ?></td>
                                                <td><?php echo $r->days ?></td>
                                                <td><?php echo $r->sales ?></td>
                                                <td>
                                                    <a href="<?php echo site_url("admin/edit_payment_plan/" . $r->ID) ?>" class="btn btn-warning btn-xs" title="<?php echo lang("ctn_55") ?>">
                                                        <span class="fas fa-cog"></span>
                                                    </a>
                                                    <a href="<?php echo site_url("admin/delete_payment_plan/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" title="<?php echo lang("ctn_57") ?>">
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

<div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_264") ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <?php echo form_open(site_url("admin/add_payment_plan"), array("class" => "form-horizontal")) ?>
      <div class="row mb-3">
        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_260") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="name">
        </div>
    </div>
    <div class="row mb-3">
        <label for="email-in" class="col-md-3 col-form-label"><?php echo lang("ctn_271") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="email-in" name="description">
        </div>
    </div>
    <div class="row mb-3">

        <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_265") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="username" name="cost">
        </div>
    </div>
    <div class="row mb-3">

        <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_266") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control jscolor" id="username" name="color">
        </div>
    </div>
    <div class="row mb-3">

        <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_272") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control jscolor" id="username" name="fontcolor">
        </div>
    </div>
    <div class="row mb-3">

        <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_262") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="username" name="days">
            <span class="form-text text-muted small"><?php echo lang("ctn_267") ?></span>
        </div>
    </div>
    <div class="row mb-3">

        <label for="username-in" class="col-md-3 col-form-label"><?php echo lang("ctn_347") ?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="username" name="icon" value="fas fa-piggy-bank">
            <span class="form-text text-muted small"><?php echo lang("ctn_348") ?> <a href="http://getbootstrap.com/components/">http://getbootstrap.com/components/</a>. <?php echo lang("ctn_349") ?></span>
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
