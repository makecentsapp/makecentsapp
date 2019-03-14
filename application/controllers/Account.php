<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();

        if(!$this->user->loggedin) {
            redirect(site_url("login"));
        }

         $this->load->model('user_model');
      }

	public function index() {
	//enabling the profiler to show more data on the view
	//$this->output->enable_profiler(TRUE);
	$userdata = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
	$query = $this->db
		->select('*')
		->from('formProgress')
		->where('user_id', $this->user->info->ID)
		->get();


    $array = array(
		'personalRows' => $query,
		'user' => $this->user
		//'userid' => $userdata
	);
	$this->template->layout = '/layout/themes/atmos.php';
	$this->template->loadContent("account/index.php", $array);
	}

	public function welcome() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/welcome.php");
	}
	public function welcome2() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/welcome2.php");
	}

	public function dbAttribute() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/dbAttribute.php");
	}
	public function personalForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/personal.php");
	}
	public function incomeForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/income.php");
	}
	public function assetsForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/assets.php");
	}
	public function expensesForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/expenses.php");
	}
	public function debtsForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/debts.php");
	}
	public function retirementForm() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/retirement.php");
	}
	public function submit() {
        $this->formpost($_POST);
	}
	private function formpost($array) {
		var_dump($array);
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
			$data = array(
				'attribute_name' => $array['name'],
				'attribute_type' => $array['type'],
				'attribute_behavior' => $array['behavior'],
			);
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
		    	$returnData = array('attributeReturn' => 'That attribute name already exists in the '. $table_name . ' table');
		    	$this->session->set_userdata($returnData);
		    }
		    redirect('Account/dbAttribute');
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