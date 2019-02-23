<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BW extends CI_Controller
{
	public function index()
	{

		//loads full top and side bar
	/*$this->template->loadContent("pm/index.php", array(
			)
		);*/
	$arrayOfThings = array(
		'FieldOne' => 'Field One Value',
		'FieldTwo' => 'Field Two Value');
		//loads blank page, how to i get top nav bar?
	//$this->load->view('pm/index.php');

	//enabling the profiler to show more data on the view
	$this->output->enable_profiler(TRUE);

	//This system uses templating. Check Application/libraries/template.php to see
	$this->template->loadContent("bw/index.php", $arrayOfThings);
	}
}
