<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PM extends CI_Controller {
	public function index() {
	//enabling the profiler to show more data on the view
	//$this->output->enable_profiler(TRUE);

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
	public function incomeForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/form/income.php");
	}
	public function assetsForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/form/assets.php");
	}
	public function expensesForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/form/expenses.php");
	}
	public function debtsForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/form/debts.php");
	}
	public function retirementForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/form/retirement.php");
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

        $exampleFormArray = array(
        	'formName' => 'personal', 
        	'id' => 2, 
        	'name' => 'John Doe', 
        	'age' => '45'
        );

        $tableName = $exampleFormArray['formName'];
        foreach ($exampleFormArray as $key => $value) {
        	$this->db->where('attribute_name', $key);
        	//$this->db->insert($tableName, $basics);
        }
        

	    $send = array('result' => $this->db->affected_rows() . ' row(s) added.');
        exit(json_encode($send, JSON_FORCE_OBJECT));
	}
}