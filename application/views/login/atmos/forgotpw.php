<div class="row m-h-100 ">
    <div class="col-md-8 col-lg-4  m-auto">
        <div class="card shadow-lg ">
            <div class="card-body ">
            	<?php $gl = $this->session->flashdata('globalmsg'); ?>
		        <?php if(!empty($gl)) :?>
		          <div class="alert alert-success"><b><span class="fas fa-check"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
		        <?php endif; ?>
                <div class=" padding-box-2 ">
                    <div class="text-center p-b-20 pull-up-sm">

                        <div class="avatar avatar-lg">
                            <span class="avatar-title rounded-circle bg-pink"> <i
                                        class="mdi mdi-key-change"></i> </span>
                        </div>

                    </div>
                    <h3 class="text-center"><?php echo lang("ctn_174") ?></h3>
                    <?php echo form_open(site_url("login/forgotpw_pro/")) ?>
                        <div class="form-group">
                            <label>Email</label>

                            <div class="input-group input-group-flush mb-3">
                                <input type="email" name="email" class="form-control form-control-prepended"
                                       placeholder="Email Address">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class=" mdi mdi-email "></span>
                                    </div>
                                </div>
                            </div>
                            <p class="small">
                                <?php echo lang("ctn_175") ?>
                            </p>
                        </div>


                        <div class="form-group">
                        	<input type="submit" class="btn text-uppercase btn-block btn-primary" value="Reset Password">
                        </div>
                    <?php echo form_close() ?>
                </div>
                <!-- <p class="decent-margin align-center"><a href="<?php echo site_url("login") ?>"> <?php echo lang("ctn_177") ?></a></p> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("main").addClass("bg-pattern");
        $("#contentcontainer").removeClass("container-fluid");
        $("#contentcontainer").addClass("container");
    });
</script>
