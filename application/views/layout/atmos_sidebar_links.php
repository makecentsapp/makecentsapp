<!--sidebar Begins-->
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <!-- <img class="admin-brand-logo" src="<?php echo base_url();?>assets/img/logo.svg" width="40" alt="Logo"> -->
        <?php if($this->settings->info->logo_option) : ?>
            <a class="admin-brand-logo" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" width="40" alt="MakeCents Logo"></a>
        <?php else : ?>
            <a class="admin-brand-content" style="max-height:54px; padding:5px !important;" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><?php echo $this->settings->info->site_name ?></a>
        <?php endif; ?>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <!-- Menu List Begins-->
        <ul class="menu">
           <?php if($this->user->loggedin && isset($this->user->info->user_role_id) &&
           ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment)) : ?>

                <!--list item begins-->
                <li class="menu-item <?php if(isset($activeLink['admin'])) echo "active" ?>">
                    <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                            <span class="menu-name"><?php echo lang("ctn_157") ?>
                                <span class="menu-arrow"></span>
                            </span>
                            <span class="menu-info">Settings etc</span>
                        </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-wrench-outline"></i>
                            </span>
                    </a>
                    <!--submenu-->
                    <ul class="sub-menu">
                        <?php if($this->user->info->admin || $this->user->info->admin_settings) : ?>
                            <li class="menu-item <?php if(isset($activeLink['admin']['settings'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/settings") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_158") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['admin']['social_settings'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/social_settings")?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_159") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                            <li class="menu-item <?php if(isset($activeLink['admin']['members'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/members") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_160") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['admin']['custom_fields'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/custom_fields") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_346") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['admin']['user_logs'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/user_logs") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_471") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($this->user->info->admin) : ?>
                            <li class="menu-item <?php if(isset($activeLink['admin']['user_roles'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/user_roles") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_316") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                            <li class="menu-item  <?php if(isset($activeLink['admin']['user_groups'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/user_groups") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_161") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['admin']['ipblock'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/ipblock") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_162") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($this->user->info->admin) : ?>
                            <li class="menu-item <?php if(isset($activeLink['admin']['email_templates'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/email_templates") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_163") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                            <li class="menu-item <?php if(isset($activeLink['admin']['email_members'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/email_members") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_164") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($this->user->info->admin || $this->user->info->admin_payment) : ?>
                            <li class="menu-item <?php if(isset($activeLink['admin']['payment_settings'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/payment_settings") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_246") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['admin']['payment_plans'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/payment_plans") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_258") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['admin']['payment_logs'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/payment_logs") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_288") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['admin']['premium_users'])) echo "active" ?>">
                                <a href="<?php echo site_url("admin/premium_users") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_325") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                        L
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--list item ends-->
            <?php endif; ?>

            <li class="menu-item <?php if(isset($activeLink['home']['general'])) echo "active" ?>">
                <a href="<?php echo site_url() ?>" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name"><?php echo lang("ctn_154") ?>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-home"></i>
                    </span>
                </a>
            </li>
            <li class="menu-item <?php if(isset($activeLink['members']['general'])) echo "active" ?>">
                <a href="<?php echo site_url("members") ?>" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name"><?php echo lang("ctn_155") ?>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-account"></i>
                    </span>
                </a>
            </li>
            <li class="menu-item <?php if(isset($activeLink['settings']['general'])) echo "active" ?>">
                <a href="<?php echo site_url("user_settings") ?>" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name"><?php echo lang("ctn_156") ?>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-settings"></i>
                    </span>
                </a>
            </li>

            <?php if($this->user->info->admin || $this->user->info->admin_settings) : ?>
                <li class="menu-item <?php if(isset($activeLink['restricted'])) echo "active" ?>">
                    <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                            <span class="menu-name"><?php echo lang("ctn_166") ?>
                                <span class="menu-arrow"></span>
                            </span>
                            <span class="menu-info">Admins Only</span>
                        </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-lock"></i>
                            </span>
                    </a>
                    <!--submenu-->
                    <ul class="sub-menu">
                        <li class="menu-item <?php if(isset($activeLink['restricted']['general'])) echo "active" ?>">
                            <a href="<?php echo site_url("test/restricted_admin") ?>" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name"><?php echo lang("ctn_167") ?></span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder mdi mdi-wrench">
                                    </i>
                                </span>
                            </a>
                        </li>
                        <li class="menu-item <?php if(isset($activeLink['restricted']['groups'])) echo "active" ?>">
                            <a href="<?php echo site_url("test/restricted_group") ?>" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name"><?php echo lang("ctn_168") ?></span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder">
                                    </i>
                                </span>
                            </a>
                        </li>
                        <li class="menu-item <?php if(isset($activeLink['restricted']['users'])) echo "active" ?>">
                            <a href="<?php echo site_url("test/restricted_user") ?>" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name"><?php echo lang("ctn_169") ?></span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder">
                                    </i>
                                </span>
                            </a>
                        </li>
                        <li class="menu-item <?php if(isset($activeLink['restricted']['premium'])) echo "active" ?>">
                            <a href="<?php echo site_url("test/restricted_premium") ?>" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name"><?php echo lang("ctn_289") ?></span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder">
                                    </i>
                                </span>
                            </a>
                        </li>

                        <?php if($this->settings->info->payment_enabled) : ?>

                            <li class="menu-item <?php if(isset($activeLink['funds']['general'])) echo "active" ?>">
                                <a href="<?php echo site_url("funds") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_245") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder fas fa-piggy-bank">
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item <?php if(isset($activeLink['funds']['plans'])) echo "active" ?>">
                                <a href="<?php echo site_url("funds/plans") ?>" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name"><?php echo lang("ctn_273") ?></span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder fas fa-list-alt">
                                        </i>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="menu-item <?php if(isset($activeLink['test']['general'])) echo "active" ?>">
                            <a href="<?php echo site_url("test") ?>" class=" menu-link">
                                <span class="menu-label">
                                    <span class="menu-name"><?php echo lang("ctn_165") ?></span>
                                </span>
                                <span class="menu-icon">
                                    <i class="icon-placeholder fas fa-heart">
                                    </i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
        <!-- Menu List Ends-->
    </div>
</aside>
<!--sidebar Ends-->
