<?php
$CI_vars_loaded = $this->_ci_cached_vars;
?>
<div class="jumbotron p-t-15">
    <div class="row">
        <div class="col-lg-6 col-xlg-4">
            <h3 class="">Hi <?php echo $this->user->info->first_name; ?>, Welcome Back</h3>
            <p class="text-muted">
                <?php echo lang("ctn_326") ?> <b><?php echo date($this->settings->info->date_format, $this->user->info->online_timestamp); ?></b>
            </p>
        </div>
    </div>
    <pre>
    <?php //print_r($CI_vars_loaded); ?>
    </pre>
    <div class="row">

    </div>
    <div class="row">
        <div class="col-xlg-6 m-b-30 col-lg-6 col-sm-6">
            <div class="col-12 m-b-20">
                <h5> <i class="fe fe-zap"></i> Membership Status</h5>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="pb-2">
                                <div class="avatar avatar-lg">
                                    <div class="avatar-title bg-soft-primary rounded-circle">
                                        <i class="fe fe-users"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-muted text-overline m-0"><?php echo lang("ctn_136") ?></p>
                                <h1 class="fw-400"><?php echo number_format($stats->total_members) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="pb-2">
                                <div class="avatar avatar-lg">
                                    <div class="avatar-title bg-soft-primary rounded-circle">
                                        <i class="mdi mdi-account-plus-outline"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-muted text-overline m-0"><?php echo lang("ctn_137") ?></p>
                                <h1 class="fw-400"><?php echo number_format($stats->new_members) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="pb-2">
                                <div class="avatar avatar-lg">
                                    <div class="avatar-title bg-soft-primary rounded-circle">
                                        <i class="mdi mdi-motion-sensor"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-muted text-overline m-0"><?php echo lang("ctn_138") ?></p>
                                <h1 class="fw-400"><?php echo number_format($stats->active_today) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="pb-2">
                                <div class="avatar avatar-lg">
                                    <div class="avatar-title bg-soft-primary rounded-circle">
                                        <i class="mdi mdi-wifi"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-muted text-overline m-0"><?php echo lang("ctn_139") ?></p>
                                <h1 class="fw-400"><?php echo number_format($online_count) ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><h5><?php echo lang("ctn_140") ?></h5></div>
                </div>
                <div class="card-body">
                    <div class="responsive-chart">
                        <div id="apxmembersactivity" class="chart-canvas"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xlg-6 col-lg-6 col-sm-6">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="card-title"><h5><?php echo lang("ctn_141") ?></h5></div>
                </div>
                <div class="list-group list-group-flush ">
                    <?php foreach($new_members->result() as $r) : ?>
                        <?php
                        if($r->joined + (3600*24) > time()) {
                            $joined = lang("ctn_144");
                        } else {
                            $joined = date($this->settings->info->date_format, $r->joined);
                        }

                        if($r->oauth_provider == "twitter") {
                            $ava = "images/social/twitter.png";
                        } elseif($r->oauth_provider == "facebook") {
                            $ava = "images/social/facebook.png";
                        } elseif($r->oauth_provider == "google") {
                            $ava = "images/social/google.png";
                        } else {
                            $ava = $this->settings->info->upload_path_relative . "/default.png";
                        }

                        ?>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $r->avatar ?>" class="avatar-img avatar-sm rounded-circle" alt="<?php echo $r->username ?>">
                                </div>
                            </div>
                            <div class="">
                                <div><?php echo $r->username ?></div>
                                <div class="text-muted"><?php echo $joined ?>
                                </div>
                            </div>
                            <div class="ml-auto">
                                <a href="<?php echo site_url("profile/" . $r->username) ?>" class="btn btn-white">Profile</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="card">
                            <div class="card-header">
                                <div class="card-title"><h5><?php echo lang("ctn_145") ?></h5></div>
                            </div>
                            <div class="card-body">
                                <div class="responsive-chart">
                                    <div id="apexmembers" class="chart-canvas"></div>
                                </div>
                            </div>
                        </div>
        </div>
    </div>

</div>


