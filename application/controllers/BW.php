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
	$this->template->layout = '/layout/themes/make_cents_template.php';
	$this->template->loadContent("bw/index.php", $arrayOfThings);
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
		$this->template->layout = '/layout/themes/make_cents_template.php';
		$this->template->loadContent("admin/bs4/settings.php", array(
			"roles" => $roles,
			"layouts" => $layouts
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
		$this->template->layout = '/layout/themes/make_cents_template.php';
		$this->template->loadContent("admin/bs4/social_settings.php", array(
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

		$this->template->layout = '/layout/themes/make_cents_template.php';
		$this->template->loadContent("admin/bs4/members.php", array(
			"user_roles" => $user_roles,
			"fields" => $fields
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
		$this->template->layout = '/layout/themes/make_cents_template.php';
		$this->template->loadContent("admin/bs4/custom_fields.php", array(
			"fields" => $fields
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

		$this->template->layout = '/layout/themes/make_cents_template.php';
		$this->template->loadContent("admin/bs4/user_logs.php", array(
			)
		);
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
