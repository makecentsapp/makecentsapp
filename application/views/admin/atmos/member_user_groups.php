<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin/members") ?>"><?php echo lang("ctn_21") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_15") ?></li>
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
                    <?php echo lang("ctn_15") ?>
                </h4>
                <p> Edit membership to groups for user: <?php echo $member->username; ?> </p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="table_wrapper01" class="datatables_wrapper dt-bootstrap4">
                            <div class="row mx-auto">
                                <div class="col-sm-12">
                                    <div class="float-right form-inline mb-2">
                                        <a href="<?php echo site_url("admin/edit_member/" . $member->ID) ?>" class="btn btn-warning btn-sm"><?php echo lang("ctn_22") ?></a>
            							<input type="button" class="btn btn-primary btn-sm" value="Add To User Group" data-toggle="modal" data-target="#addModal" />
                                    </div>
								    <table class="table datatable table-hover table-striped">
								        <tr class="table-header">
								            <td><?php echo lang("ctn_389") ?></td>
								            <td><?php echo lang("ctn_52") ?></td>
								        </tr>
								        <?php foreach($user_groups->result() as $r) : ?>
								            <tr>
								                <td><?php echo $r->name ?></td>
								                <td>
								                    <a href="<?php echo site_url("admin/remove_user_from_group/" . $r->userid . "/" . $r->groupid . "/" . $this->security->get_csrf_hash()) ?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-xs" title="<?php echo lang("ctn_130") ?>">
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

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo lang("ctn_129") ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <?php echo form_open(site_url("admin/add_member_to_group_pro/" . $member->ID), array("class" => "form-horizontal")) ?>
                <div class="row mb-3">
                    <label for="email-in" class="col-md-3 col-form-label">User Group</label>
                    <div class="col-md-9">
                       	<select name="groupid" class="form-control">
                           	<?php foreach($groups->result() as $r) : ?>
                                <option value="<?php echo $r->ID ?>"><?php echo $r->name ?></option>
                           	<?php endforeach; ?>
                       	</select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
                <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_61") ?>" />
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
