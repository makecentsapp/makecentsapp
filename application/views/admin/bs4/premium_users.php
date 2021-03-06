<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="fas fa-user"></span> <?php echo lang("ctn_1") ?></div>
        <div class="db-header-extra form-inline input-group-sm">


            <!-- <div class="row mb-3 has-feedback no-margin">
                <div class="input-group"> -->
                    <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                    <div class="input-group-append">
                        <input type="hidden" id="search_type" value="0">
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-search" aria-hidden="true"></span></button>
                            <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
                              <li><a class="text-muted dropdown-item" href="#" onclick="change_search(0)"><span class="fas fa-check" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
                              <li><a class="text-muted dropdown-item" href="#" onclick="change_search(1)"><span class="fas fa-check no-display" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
                              <li><a class="text-muted dropdown-item" href="#" onclick="change_search(2)"><span class="fas fa-check no-display" id="user-exact"></span> <?php echo lang("ctn_339") ?></a></li>
                              <li><a class="text-muted dropdown-item" href="#" onclick="change_search(3)"><span class="fas fa-check no-display" id="email-exact"></span> <?php echo lang("ctn_78") ?></a></li>
                              <li><a class="text-muted dropdown-item" href="#" onclick="change_search(4)"><span class="fas fa-check no-display" id="premium-exact"></span> <?php echo lang("ctn_323") ?></a></li>
                          </ul>
                      </div><!-- /btn-group -->
                  <!-- </div>
              </div> -->

          </div>
      </div>

      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
          <li class="breadcrumb-item"><a href="<?php echo site_url("admin") ?>"><?php echo lang("ctn_1") ?></a></li>
          <li class="breadcrumb-item active"><?php echo lang("ctn_325") ?></li>
      </ol>


      <hr>




      <table id="premium-table" class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="table-header"><td><?php echo lang("ctn_77") ?>
            </td><td><?php echo lang("ctn_81") ?>
            </td><td><?php echo lang("ctn_78") ?>
            </td><td><?php echo lang("ctn_323") ?>
            </td><td><?php echo lang("ctn_324") ?>
            </td><td><?php echo lang("ctn_83") ?>
        </td><td><?php echo lang("ctn_52") ?></td></tr>
    </thead>
    <tbody>
    </tbody>


</table>


</div>
<script type="text/javascript">
    $(document).ready(function() {

     var st = $('#search_type').val();
     var table = $('#premium-table').DataTable({
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
        { "orderable" : false },
        { "orderable" : false },
        { "orderable" : false },
        null,
        null,
        { "orderable" : false },
        { "orderable" : false }
        ],
        "ajax": {
            url : "<?php echo site_url("admin/premium_users_page") ?>",
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
      "user-exact",
      "email-exact",
      "premium-exact"
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
