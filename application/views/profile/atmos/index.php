<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/summernote/summernote-bs4.css"/>
<div class="bg-dark m-b-30">
    <div class="container">
        <div class="row p-b-60 p-t-60">

            <div class="col-md-6 text-white p-b-30">
                <div class="media">
                    <div class="avatar mr-3  avatar-xl">
                        <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>" alt="profile picture" class="avatar-img rounded-circle">
                    </div>
                    <div class="media-body m-auto">
                        <h5 class="mt-0"><?php echo $user->first_name ?> <?php echo $user->last_name ?></h5>
                        <div class="opacity-75">@<a href="<?php echo site_url("profile/" . $user->username) ?>"><?php echo $user->username ?></a></div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 text-white my-auto text-md-right p-b-30">

                <div class="">
                    <p class="opacity-75">Channels</p>
                    <div class="avatar-group">
                        <?php if(isset($user_data) && $user_data->twitter) : ?>
                        <div class="avatar ">
                            <a href="https://twitter.com/<?php echo $this->security->xss_clean($user_data->twitter) ?>" class="avatar-title rounded-circle btn btn-lg btn-social-icon btn-twitter" >
                                <span class="fab fa-twitter"></span><!-- Sign in with Twitter -->
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($user_data) && $user_data->facebook) : ?>
                        <div class="avatar ">
                            <a href="https://www.facebook.com/<?php echo $this->security->xss_clean($user_data->facebook) ?>" class="avatar-title rounded-circle btn btn-lg btn-social-icon btn-facebook" >
                                <span class="fab fa-facebook"></span> <!-- Sign in with Facebook -->
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($user_data) && $user_data->google) : ?>
                        <div class="avatar ">
                            <a href="https://plus.google.com/<?php echo $this->security->xss_clean($user_data->google) ?>" class="avatar-title rounded-circle btn btn-lg btn-social-icon btn-google" >
                                <span class="fab fa-google"></span> <!-- Sign in with Google -->
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($user_data) && $user_data->linkedin) : ?>
                        <div class="avatar ">
                            <a href="https://www.linkedin.com/in/<?php echo $this->security->xss_clean($user_data->google) ?>" class="avatar-title rounded-circle btn btn-lg btn-social-icon btn-linkedin" >
                                <span class="fab fa-linkedin"></span>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($user_data) && $user_data->website) : ?>
                        <div class="avatar">
                            <a href="<?php echo $this->security->xss_clean($user_data->website) ?>" class="avatar-title rounded-circle bg-primary" title="<?php echo $this->security->xss_clean($user_data->website) ?>">
                                <span class="fab fa-chrome"></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="container pull-up">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Single post-->
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="media">
                                <div class="avatar mr-3 my-auto  avatar-xs">
                                    <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>" alt="profile picture" class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body m-auto">
                                    <h5 class="m-0">Profile</h5>
                                    <div class="opacity-75 text-muted"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-raw"></div>

                        <div class="card-body">

                            <?php if(empty($user->aboutme)) : ?>
                                <p><?php echo lang("ctn_759") ?></p>
                            <?php else : ?>
                                <p><?php echo nl2br($user->aboutme) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($this->settings->info->profile_comments && $user->profile_comments) : ?>

                        <?php foreach($comments->result() as $r) : ?>
                            <div class="card m-b-30">
                                <div class="card-header">
                                    <div class="media">
                                        <div class="avatar mr-3 my-auto  avatar-s">
                                            <?php echo $this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)) ?>
                                            <!-- <img src="assets/img/users/user-3.jpg" alt="..." class="avatar-img rounded-circle"> -->
                                        </div>
                                        <div class="media-body m-auto">
                                            <h5 class="m-0">Comment</h5>
                                            <div class="opacity-75 text-muted"><?php echo date($this->settings->info->date_format, $r->timestamp) ?></div>
                                        </div>
                                    </div>
                                    <?php if($r->userid == $this->user->info->ID || $r->profileid == $this->user->info->ID || $this->common->has_permissions(array("admin", "admin_members"), $this->user) ) : ?>
                                        <div class="card-controls">
                                            <a href="<?php echo site_url("profile/delete_comment/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang("ctn_57") ?>"><span class="fas fa-trash"></span></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-raw"> </div>
                                <div class="card-body">
                                    <?php echo $r->comment ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="align-center"><?php echo $this->pagination->create_links() ?></div>

                        <?php echo form_open(site_url("profile/comment/" . $user->ID), array("class" => "form-horizontal")) ?>
                        <div class="card m-b-30">
                            <div class="card-header">
                                <div class="media">
                                    <div class="media-body m-auto">
                                        <h5 class="m-0">Post a Comment</h5>
                                        <div class="opacity-75 text-muted"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <textarea name="comment" id="msg-area"></textarea>
                            </div>
                            <div class="m-2 d-flex justify-content-right">
                                <input type="submit" class="btn btn-primary btn-sm" value="<?php echo lang("ctn_421") ?>" />
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4">

                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="avatar mr-2 avatar-xs">
                                <div class="avatar-title bg-dark rounded-circle">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                            Statistics
                        </div>
                        <div class="list-group list  list-group-flush">

                            <?php if($groups->num_rows() > 0) : ?>
                            <div class="list-group-item ">
                                <h6 class=""><?php echo lang("ctn_15") ?></h6>
                            <?php foreach($groups->result() as $r) : ?>
                                <label class="badge badge-soft-primary"><?php echo $r->name ?></label>
                            <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                            <div class="list-group-item ">
                                <i class="far fa-eye"></i> <?php echo lang("ctn_415") ?> <span class="badge badge-soft-success"> <?php echo number_format($user->profile_views) ?></span>
                            </div>
                            <div class="list-group-item ">
                                <i class="fas fa-comments"></i> <?php echo lang("ctn_416") ?> <span href="#" class="badge badge-soft-info"><?php echo $comment_count ?></span>
                            </div>
                            <div class="list-group-item ">
                                <i class="fas fa-wifi"></i> <?php echo lang("ctn_418") ?>
                                <?php if($user->online_timestamp > time() - (60*15)) : ?>
                                    <span class="profile-online"><?php echo lang("ctn_139") ?></span>
                                <?php else : ?>
                                    <span class="profile-offline"><?php echo lang("ctn_335") ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="avatar mr-2 avatar-xs">
                                <div class="avatar-title bg-primary rounded-circle">
                                    <i class="fas fa-info"></i>
                                </div>
                            </div>
                            <?php echo lang("ctn_419") ?>
                        </div>
                        <div class="list-group list  list-group-flush">

                            <div class="list-group-item ">
                                <div class="text-muted"><?php echo lang("ctn_201") ?></div>
                                <div class="name"><?php echo $user->first_name ?> <?php echo $user->last_name ?></div>
                            </div>
                            <div class="list-group-item ">
                                <div class="text-muted"><?php echo lang("ctn_322") ?></div>
                                <div class="name"><?php echo $role ?></div>
                            </div>
                            <div class="list-group-item ">
                                <div class="text-muted"><?php echo lang("ctn_202") ?></div>
                                <div class="name"><?php echo date($this->settings->info->date_format, $user->joined) ?></div>
                            </div>
                            <div class="list-group-item ">
                                <div class="text-muted"><?php echo lang("ctn_203") ?></div>
                                <div class="name"><?php echo date($this->settings->info->date_format, $user->online_timestamp) ?></div>
                            </div>
                            <?php if( $this->common->has_permissions(array("admin", "project_admin"), $this->user)) : ?>
                                <div class="list-group-item ">
                                    <div class="text-muted"><?php echo lang("ctn_24") ?> </div>
                                    <div class="name"><?php echo $user->email ?></div>
                                </div>
                                <div class="list-group-item ">
                                    <div class="text-muted"><?php echo lang("ctn_391") ?> </div>
                                    <div class="name"><?php echo $user->address_1 ?></div>
                                </div>
                                <div class="list-group-item ">
                                    <div class="text-muted"><?php echo lang("ctn_392") ?> </div>
                                    <div class="name"><?php echo $user->address_2 ?></div>
                                </div>
                                <div class="list-group-item ">
                                    <div class="text-muted"><?php echo lang("ctn_393") ?> </div>
                                    <div class="name"><?php echo $user->city ?></div>
                                </div>
                                <div class="list-group-item ">
                                    <div class="text-muted"><?php echo lang("ctn_394") ?>  </div>
                                    <div class="name"><?php echo $user->state ?></div>
                                </div>
                                <div class="list-group-item ">
                                    <div class="text-muted"><?php echo lang("ctn_395") ?></div>
                                    <div class="name"><?php echo $user->zipcode ?></div>
                                </div>
                                <div class="list-group-item ">
                                    <div class="text-muted"><?php echo lang("ctn_396") ?> </div>
                                    <div class="name"><?php echo $user->country ?></div>
                                </div>
                            <?php endif; ?>
                            <?php foreach($fields->result() as $r) : ?>
                                <?php if($r->type == 1) : ?>
                                    <div class="list-group-item ">
                                        <div class="text-muted"><?php echo $r->name ?></div>
                                        <div class="name"><?php echo $r->value ?></div>
                                    </div>
                                <?php else : ?>
                                    <div class="list-group-item ">
                                        <div class="text-muted"><?php echo $r->name ?></div>
                                        <div class="name"><?php echo $r->value ?></div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<script    src="<?php echo base_url();?>assets/vendor/summernote/summernote-bs4.min.js"></script>
<script type="text/javascript">
    (function ($) {
    'use strict';
    $("#msg-area").summernote({
        height: 450,
        toolbar: false
    });

})(window.jQuery);
</script>

