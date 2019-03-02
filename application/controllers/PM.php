<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PM extends CI_Controller {
	public function index() {
	//enabling the profiler to show more data on the view
	//$this->output->enable_profiler(TRUE);

	//Remove after BS4 re-code:
	$this->template->layout = '/layout/themes/light_blue_layout.php';
	$this->template->loadContent("pm/index.php");
	}
	public function dbAttribute() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/light_blue_layout.php';
		$this->template->loadContent("pm/dbAttribute.php");
	}
	public function formExample() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
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
		$this->load->library('session');
		$write = true;
		//if the post isnt an array, stop
		if (!is_array($array)) return false;
        if (!headers_sent()) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r'));
            header('Content-type: application/json');
        }

        if (isset($array['attributeSubmit'])) {
        	$table_name = $array['table'];
			$data = array('attribute_name' => $array['attribute_name']);
        	$query = $this->db
        		->select('attribute_id')
        		->from($table_name)
        		->where('attribute_name', $array['attribute_name'])
        		->get();
			if ($query->num_rows() == 0) {
	        	
	        	if ($write == true) {
		        	$this->db->insert($table_name, $data);
		        }
		        $returnData = array('attributeReturn' => 'Sucessfully inserted '. $this->db->affected_rows() . ' row.');
		        $this->session->set_userdata($returnData);
		    }
		    else {
		    	$returnData = array('attributeReturn' => 'That attribute already exists in the '. $table_name . ' table');
		    	$this->session->set_userdata($returnData);
		    }
		    redirect('PM/dbAttribute');
        }
        else {
			//setup the consistent variables, regardless of how many fields are passed
			$user_id = $array['id'];
	        $table_name = $array['formName'];
	        //take those rows off the array, 2 being first two fields of array, so the HTML has to pass them first
	        $array = array_slice($array, 2); 

	        //run through remaining values in array, find their attribute_id and insert
	        foreach ($array as $key => $value) {
	        	if (!empty($value)) {
		        	$query = $this->db
		        		->select('attribute_id')
		        		->from($table_name)
		        		->where('attribute_name', $key)
		        		->get();
					if ($query->num_rows() > 0) {
						//parse the return of the select statement into something useable
						$row = $query->row_array();
				        $attribute_id = $row['attribute_id'];
				        //prepare the data array for insert
				        $data = array(
				        	'user_id' => $user_id, 
				        	'attribute_id' => $attribute_id,
				        	'value' => $value);
				        //do the dirty
				        if ($write == true) {
				        	$this->db->insert($table_name.'Details', $data);
				        }
					}//end insert query
				}//end checking for empty data
	        }//end foreach
	        //give some debug return for the console on the ajax
		    $send = array('result' => $this->db->affected_rows() . ' row(s) added.');
	        exit(json_encode($send, JSON_FORCE_OBJECT));
		}
	}
}