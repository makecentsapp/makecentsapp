<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_62") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-envelope-square"></i>
                    </span>
                    <?php echo lang("ctn_62") ?>
                </h4>
                <p><?php echo lang("ctn_63") ?></p>
                <div class="col-6">
                    <div class="form-inline input-group input-group-sm">
                        <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                        <div class="input-group-append">
                            <input type="hidden" id="search_type" value="0">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-search" aria-hidden="true"></span>
                            </button>
                            <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
                                <li><a class="text-muted dropdown-item" href="#" onclick="change_search(0)"><span class="fas fa-check" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
                                <li><a class="text-muted dropdown-item" href="#" onclick="change_search(1)"><span class="fas fa-check no-display" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
                                <li><a class="text-muted dropdown-item" href="#" onclick="change_search(2)"><span class="fas fa-check no-display" id="title-exact"></span> <?php echo lang("ctn_11") ?></a></li>
                                <li><a class="text-muted dropdown-item" href="#" onclick="change_search(3)"><span class="fas fa-check no-display" id="language-exact"></span> <?php echo lang("ctn_148") ?></a></li>
                            </ul>
                        </div>
                        <input type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" value="<?php echo lang("ctn_407") ?>">
                    </div>
                </div>
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
                                    <table id="ann-table" class="table datatable table-striped table-hover table-bordered">
                                        <thead>
                                            <tr class="table-header">
                                                <td><?php echo lang("ctn_81") ?></td>
                                                <td><?php echo lang("ctn_11") ?></td>
                                                <td><?php echo lang("ctn_404") ?></td>
                                                <td><?php echo lang("ctn_148") ?></td>
                                                <td><?php echo lang("ctn_52") ?></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
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

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg mw-100 w-75" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><span class="fas fa-paper-plane"></span> <?php echo lang("ctn_407") ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
       <?php echo form_open(site_url("admin/add_email_template"), array("class" => "form-horizontal")) ?>
       <div class="row mb-3 col-md-10 mx-auto">
        <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_81") ?></label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="name" value="">
        </div>
    </div>
    <div class="row mb-3 col-md-10 mx-auto">
        <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_11") ?></label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="title" value="">
            <span class="form-text text-muted small"><?php echo lang("ctn_474") ?></span>
        </div>
    </div>
    <div class="row mb-3 col-md-10 mx-auto">
        <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_404") ?></label>
        <div class="col-md-8">
            <select name="hook" class="form-control">
                <option value="email_activation"><?php echo lang("ctn_405") ?></option>
                <option value="forgot_password"><?php echo lang("ctn_174") ?></option>
                <option value="welcome_email"><?php echo lang("ctn_475") ?></option>
                        <option value="member_invite"><?php echo lang("ctn_502") ?></option>
            </select>
            <span class="form-text text-muted small"><?php echo lang("ctn_406") ?></span>
        </div>
    </div>
    <div class="row mb-3 col-md-10 mx-auto">
        <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_148") ?></label>
        <div class="col-md-8">
            <select name="language" class="form-control">
                <?php foreach($languages as $k=>$v) : ?>
                    <option value="<?php echo $k ?>"><?php echo $v['display_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <p class="col-md-10 mx-auto">Variables for the email template:</p>
    <div class="col-md-10 mx-auto">
        <table class="table table-bordered">
            <tr><td>[NAME]</td><td> <?php echo lang("ctn_7") ?></td></tr>
            <tr><td>[SITE_URL]</td><td> <?php echo lang("ctn_8") ?></td></tr>
            <tr><td>[SITE_NAME]</td><td> <?php echo lang("ctn_9") ?></td></tr>
            <tr><td>[EMAIL_LINK]</td><td> <?php echo lang("ctn_10") ?></td></tr>
        </table>
    </div>
    <div class="row mb-0 h-50">
        <label for="p-in" class="col-md-4 col-form-label"><?php echo lang("ctn_3") ?></label>
        <div class="col-md-12 h-25">
            <textarea name="template" id="ann-area"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang("ctn_60") ?></button>
    <input type="submit" class="btn btn-primary" value="<?php echo lang("ctn_407") ?>">
    <?php echo form_close() ?>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('ann-area', { height: '150'});
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
     var st = $('#search_type').val();
     var table = $('#ann-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
        "order": [

        ],
        "columns": [
        null,
        null,
        null,
        null,
        { "orderable": false }
        ],
        "ajax": {
            url : "<?php echo site_url("admin/email_template_page") ?>",
            type : 'GET',
            data : function ( d ) {
                d.search_type = $('#search_type').val();
            }
        },
        "drawCallback": function(settings, json) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
     $('#form-search-input').on('keyup change', function () {
        table.search(this.value).draw();
    });

 } );
    function change_search(search)
    {
      var options = [
      "search-like",
      "search-exact",
      "title-exact",
      "language-exact"
      ];
      set_search_icon(options[search], options);
      $('#search_type').val(search);
      $( "#form-search-input" ).trigger( "change" );
  }

  function set_search_icon(icon, options)
  {
      for(var i = 0; i<options.length;i++) {
        if(options[i] == icon) {
          $('#' + icon).fadeIn(10);
      } else {
          $('#' + options[i]).fadeOut(10);
      }
  }
}
</script>
