<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BW extends CI_Controller
{
    public function index()
    {

        //loads full top and side bar
    /*$this->template->loadContent("pm/index.php", array(
            )
        );*/
        $cuid = $this->user->info->ID;
    $arrayOfThings = array(
        'FieldOne' => 'Field One Value',
        'FieldTwo' => 'Field Two Value',
        'userid' => $cuid);
        //loads blank page, how to i get top nav bar?
    //$this->load->view('pm/index.php');

    //enabling the profiler to show more data on the view
    $this->output->enable_profiler(TRUE);

    //This system uses templating. Check Application/libraries/template.php to see
    $this->template->layout = '/layout/themes/atmos.php';
    $this->template->loadContent("bw/index.php", $arrayOfThings);
    }

    public function adminindex()
    {
        $this->template->loadData("activeLink",
            array("admin" => array("general" => 1)));
                $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/index.php", array(
            )
        );

    }

    public function user_logs()
    {
        if(!$this->common->has_permissions(array("admin",
            "admin_members"), $this->user)) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("user_logs" => 1)));

        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/user_logs.php", array(
            )
        );
    }

    public function custom_fields()
    {
        if(!$this->common->has_permissions(array("admin",
            "admin_members"), $this->user)) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("custom_fields" => 1)));

        $this->load->model("admin_model");

        $fields = $this->admin_model->get_custom_fields(array());
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/custom_fields.php", array(
            "fields" => $fields
            )
        );

    }

    public function edit_custom_field($id)
    {
        if(!$this->common->has_permissions(array("admin",
            "admin_members"), $this->user)) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("custom_fields" => 1)));
        $this->load->model("admin_model");
        $id = intval($id);
        $field = $this->admin_model->get_custom_field($id);
        if($field->num_rows() == 0) {
            $this->template->error(lang("error_77"));
        }

        $field = $field->row();
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/edit_custom_field.php", array(
            "field" => $field
            )
        );
    }

    public function user_roles()
    {
        if(!$this->user->info->admin) $this->template->error(lang("error_2"));
                $this->load->model("admin_model");
        $this->template->loadData("activeLink",
            array("admin" => array("user_roles" => 1)));
        $roles = $this->admin_model->get_user_roles();

        $permissions = $this->get_default_permissions();
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/user_roles.php", array(
            "roles" => $roles,
            "permissions" => $permissions
            )
        );
    }
        private function get_default_permissions()
    {
        $urp = $this->admin_model->get_user_role_permissions();
        $permissions = array();
        foreach($urp->result() as $r) {
            $permissions[$r->hook] = array(
                "name" => lang($r->name),
                "desc" => lang($r->description),
                "id" => $r->ID,
                "class" => $r->classname,
                "selected" => 0
            );
        }
        return $permissions;
    }

    public function edit_user_role($id)
    {
        if(!$this->user->info->admin) $this->template->error(lang("error_2"));
        $id = intval($id);
                $this->load->model("admin_model");
        $role = $this->admin_model->get_user_role($id);
        if ($role->num_rows() == 0) $this->template->error(lang("error_65"));

        $role = $role->row();
        $this->template->loadData("activeLink",
            array("admin" => array("user_roles" => 1)));

        $permissions = $this->get_default_permissions();
        foreach($permissions as $k=>$v) {
            if($role->{$k}) {
                $permissions[$k]['selected'] = 1;
            }
        }
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/edit_user_role.php", array(
            "role" => $role,
            "permissions" => $permissions
            )
        );
    }

    public function user_groups()
    {
        if(!$this->user->info->admin && !$this->user->info->admin_members) {
            $this->template->error(lang("error_2"));
        }
        $this->load->model("admin_model");
        $this->template->loadData("activeLink",
            array("admin" => array("user_groups" => 1)));
        $groups = $this->admin_model->get_user_groups();
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/groups.php", array(
            "groups" => $groups
            )
        );
    }

        public function view_group($id, $page=0)
    {
        if(!$this->user->info->admin && !$this->user->info->admin_members) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("user_groups" => 1)));
        $this->load->model("admin_model");
        $id = intval($id);
        $page = intval($page);
        $group = $this->admin_model->get_user_group($id);
        if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

        $users = $this->admin_model->get_users_from_groups($id, $page);

        $this->load->library('pagination');
        $config['base_url'] = site_url("admin/view_group/" . $id);
        $config['total_rows'] = $this->admin_model
            ->get_total_user_group_members_count($id);
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;

        include (APPPATH . "/config/page_config.php");

        $this->pagination->initialize($config);

        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/view_group.php", array(
            "group" => $group->row(),
            "users" => $users,
            "total_members" => $config['total_rows']
            )
        );

    }

    public function edit_group($id)
    {
        if(!$this->user->info->admin && !$this->user->info->admin_members) {
            $this->template->error(lang("error_2"));
        }
        $this->load->model("admin_model");
        $id = intval($id);
        $group = $this->admin_model->get_user_group($id);
        if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

        $this->template->loadData("activeLink",
            array("admin" => array("user_groups" => 1)));
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/edit_group.php", array(
            "group" => $group->row()
            )
        );
    }

    public function members()
    {
        if(!$this->user->info->admin && !$this->user->info->admin_members) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("members" => 1)));

        $this->load->model("admin_model");
        $this->load->model("user_model");

        $user_roles = $this->admin_model->get_user_roles();

        $fields = $this->user_model->get_custom_fields(array("register"=>1));

        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/members.php", array(
            "user_roles" => $user_roles,
            "fields" => $fields
            )
        );
    }

    public function member_user_groups($id)
    {
        if(!$this->common->has_permissions(array("admin", "admin_members"),
         $this->user)) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("members" => 1)));
                $this->load->model("admin_model");
        $this->load->model("user_model");
        $id = intval($id);

        $member = $this->user_model->get_user_by_id($id);
        if ($member->num_rows() ==0 ) $this->template->error(lang("error_13"));

        $member = $member->row();

        // Groups
        $user_groups = $this->user_model->get_user_groups($id);
        $groups = $this->admin_model->get_user_groups();
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/member_user_groups.php", array(
            "member" => $member,
            "user_groups" => $user_groups,
            "groups" => $groups
            )
        );
    }

    public function edit_member($id)
    {
        if(!$this->user->info->admin && !$this->user->info->admin_members) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("members" => 1)));
                $this->load->model("admin_model");
        $this->load->model("user_model");
        $id = intval($id);

        $member = $this->user_model->get_user_by_id($id);
        if ($member->num_rows() ==0 ) $this->template->error(lang("error_13"));

        $user_groups = $this->user_model->get_user_groups($id);
        $user_roles = $this->admin_model->get_user_roles();
        $fields = $this->user_model->get_custom_fields_answers(array(
            ), $id);
                $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/edit_member.php", array(
            "member" => $member->row(),
            "user_groups" => $user_groups,
            "user_roles" => $user_roles,
            "fields" => $fields
            )
        );
    }

        public function social_settings()
    {
        if(!$this->user->info->admin && !$this->user->info->admin_settings) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("social_settings" => 1)));
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/social_settings.php", array(
            )
        );
    }

    public function settings()
    {
        if(!$this->user->info->admin && !$this->user->info->admin_settings) {
            $this->template->error(lang("error_2"));
        }
        $this->template->loadData("activeLink",
            array("admin" => array("settings" => 1)));

        $this->load->model("admin_model");
        $this->load->model("user_model");

        $roles = $this->admin_model->get_user_roles();
        $layouts = $this->admin_model->get_layouts();
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("admin/atmos/settings.php", array(
            "roles" => $roles,
            "layouts" => $layouts
            )
        );
    }

//USER SETTINGS DUPES
        public function usersettingsindex()
    {
        $this->load->model("user_model");
        $fields = $this->user_model->get_custom_fields_answers(array(
            "edit" => 1
            ), $this->user->info->ID);
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("user_settings/atmos/index.php", array(
            "fields" => $fields
            )
        );
    }
        public function change_password()
    {
        $this->load->model("user_model");
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("user_settings/atmos/change_password.php", array(
            )
        );
    }

        public function social_networks()
    {
        $this->load->model("user_model");
        $user_data = $this->user_model->get_user_data($this->user->info->ID);
        if($user_data->num_rows() == 0) {
            $this->user_model->add_user_data(array(
                "userid" => $this->user->info->ID
                )
            );
            $user_data = $this->user_model->get_user_data($this->user->info->ID);
        }
        $user_data = $user_data->row();
        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("user_settings/atmos/social_networks.php", array(
            "user_data" => $user_data
            )
        );
    }
//HOME CONTROLLER DUPES

    public function homeindex()
    {
        if (defined('REQUEST') && REQUEST == "external") {
            return;
        }
                $this->load->model("user_model");
        $this->load->model("home_model");
        $new_members = $this->user_model->get_new_members(5);
        $months = array();

        // Graph Data
        $current_month = date("n");
        $current_year = date("Y");

        // First month
        for($i=6;$i>=0;$i--) {
            // Get month in the past
            $new_month = $current_month - $i;
            // If month less than 1 we need to get last years months
            if($new_month < 1) {
                $new_month = 12 + $new_month;
                $new_year = $current_year - 1;
            } else {
                $new_year = $current_year;
            }
            // Get month name using mktime
            $timestamp = mktime(0,0,0,$new_month,1,$new_year);
            $count = $this->user_model
                ->get_registered_users_date($new_month, $new_year);
            $months[] = array(
                "date" => date("F", $timestamp),
                "count" => $count
                );
        }


        $javascript = 'var data_graph = {
                        labels: [';
            foreach($months as $d) {
                $javascript .= '"'.$d['date'].'",';
            }
            $javascript.='],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [';
                    foreach($months as $d) {
                        $javascript .= $d['count'].',';
                    }
                    $javascript.=']
                }
            ]
        };';

        $stats = $this->home_model->get_home_stats();
        if($stats->num_rows() == 0) {
            $this->template->error(lang("error_24"));
        } else {
            $stats = $stats->row();
            if($stats->timestamp < time() - $this->settings->info->cache_time) {
                $stats = $this->get_fresh_results($stats);
                // Update Row
                $this->home_model->update_home_stats($stats);
            }
        }


        $javascript .= ' var social_data = [
            {
                value: '.$stats->google_members.',
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Google"
            },
            {
                value: '.($stats->total_members - ($stats->google_members +
                 $stats->facebook_members + $stats->twitter_members)).',
                color: "#39bc2c",
                highlight: "#5AD3D1",
                label: "'.lang("ctn_242").'"
            },
            {
                value: '.$stats->facebook_members.',
                color: "#2956BF",
                highlight: "#FFC870",
                label: "Facebook"
            },
            {
                value: '.$stats->twitter_members.',
                color: "#5BACD4",
                highlight: "#7db864",
                label: "Twitter"
            }
        ];';

        $javascript .= '
            var options = {
                chart: {
                    width: 380,
                    type: "donut",
                },
                legend: {
                            position: "bottom",
                            containerMargin: {
                              left: 35,
                              right: 35
                            }
                        },
                series: [
                '.$stats->google_members.',
                '.($stats->total_members - ($stats->google_members + $stats->facebook_members + $stats->twitter_members)).',
                '.$stats->facebook_members.',
                '.$stats->twitter_members.'
                ],
                labels: ["Google", "'.lang("ctn_242").'", "Facebook", "Twitter"],
                plotOptions: {
                    pie: {
                        customScale: 1,
                        donut: {
                            size: "50%"
                        }
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }]
            }
            window.onload = function() {
                var apxchart = new ApexCharts(
                    document.querySelector("#apexmembers"),
                    options
                );
                apxchart.render();

                var apxlineoptions = {
                    colors: colors,
                    chart: {
                        type: "area",
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: "smooth"
                    },
                    series: [{
                        name: "Registrations",
                        data: [';
                        foreach($months as $d) {
                            $javascript .= $d['count'].',';
                        }
                        $javascript.=']
                    }],

                    xaxis: {
                        labels: {
                            rotate: -70,
                        },
                        categories: [';
                        foreach($months as $d) {
                            $javascript .= '"'.$d['date'].'",';
                        }
                        $javascript.='],
                    },
                    tooltip: {
                        fixed: {
                            enabled: false,
                            position: "topRight"
                        }
                    },
                    responsive: [
                    {
                      breakpoint: 600,
                      options: {
                        legend: {
                          position: "bottom"
                        },
                        xaxis: {
                          labels: {
                            rotate: -70,
                          }
                        }
                      }
                    }
                  ]
                };

                var apxlinechart = new ApexCharts(
                document.querySelector("#apxmembersactivity"),
                apxlineoptions
                );

                apxlinechart.render();

            };
               ';


        $this->template->loadExternal(
            '<script type="text/javascript" src="'.base_url().'scripts/libraries/Chart.min.js" /></script>
            <script type="text/javascript">'.$javascript.'</script>
            <script type="text/javascript" src="'.base_url().'scripts/custom/home.js" /></script>'
        );

        $online_count = $this->user_model->get_online_count();

        $this->template->layout = '/layout/themes/atmos.php';
        $this->template->loadContent("home/atmos/index.php", array(
            "new_members" => $new_members,
            "stats" => $stats,
            "online_count" => $online_count
            )
        );
    }

    private function get_fresh_results($stats)
    {
        $data = new STDclass;

        $data->google_members = $this->user_model->get_oauth_count("google");
        $data->facebook_members = $this->user_model->get_oauth_count("facebook");
        $data->twitter_members = $this->user_model->get_oauth_count("twitter");
        $data->total_members = $this->user_model->get_total_members_count();
        $data->new_members = $this->user_model->get_new_today_count();
        $data->active_today = $this->user_model->get_active_today_count();

        return $data;
    }




    public function echo_post()
    {
        $this->output->enable_profiler(TRUE);
        $postdata = $this->input->post();
        foreach ($postdata as $key => $value) {
            echo "Post Key: " . $key . " Value: " . $value;
            echo "<br>";
        }
    }

}
