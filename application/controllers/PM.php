<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PM extends CI_Controller {
	public function index() {
	//enabling the profiler to show more data on the view
	$this->output->enable_profiler(TRUE);
	//Remove after BS4 re-code:
	$this->template->layout = '/layout/themes/light_blue_layout.php';
	$this->template->loadContent("pm/index.php");
	}
	public function formExample() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/formExample.php");
	}
	public function personalForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/form/personal.php");
	}
	public function submit() {
        $this->formpost($_POST);
	}
	private function formpost($array) {
		if (!is_array($array)) return false;

        if (!headers_sent()) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r'));
            header('Content-type: application/json');
        }

        $basics = array('ID' => $array['ID'], 'basicIncome' => $array['basicIncome']);
        $this->db->insert('core', $basics);

	    $send = array('result' => $this->db->affected_rows() . ' row(s) added.');
        exit(json_encode($send, JSON_FORCE_OBJECT));
	}


}
