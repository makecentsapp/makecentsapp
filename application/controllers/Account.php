<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();

        if(!$this->user->loggedin) {
            redirect(site_url("login"));
        }
         $this->template->loadData("activeLink",
			array("home" => array("account" => 1)));
         $this->load->model('user_model');
      }

	public function index() {
	//enabling the profiler to show more data on the view
	//$this->output->enable_profiler(TRUE);
	$translationQuery = $this->db
		->select('*')
		->from('welcome')
		->get();
	foreach ($translationQuery->result_array() as $row) {
		$translationArray[$row['attribute_id']] = $row['attribute_name'];
	}
	$userdata = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
	$decQuery = $this->db
		->select('*')
		->from('welcomeDetails_decimal')
		->where('user_id', $this->user->info->ID)
		->order_by('date_added', 'ASC')
		->get();
	$vcharQuery = $this->db
		->select('*')
		->from('welcomeDetails_varchar')
		->where('user_id', $this->user->info->ID)
		->order_by('date_added', 'ASC')
		->get();

    $array = array(
		'translation' => $translationArray,
		'user' => $this->user,
		'decimal' => $decQuery->result_array(),
		'varchar' => $vcharQuery->result_array()

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
	public function welcome3() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/welcome3.php");
	}

	public function dbAttribute() {
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/dbAttribute.php");
	}
	public function main() {
		$translationQuery = $this->db
		->select('*')
		->from('main')
		->get();
		foreach ($translationQuery->result_array() as $row) {
			$translationArray[$row['attribute_id']] = $row['attribute_name'];
		}
		$userdata = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
		$decQuery = $this->db
			->select('*')
			->from('mainDetails_decimal')
			->where('user_id', $this->user->info->ID)
			->order_by('date_added', 'ASC')
			->get();
		$vcharQuery = $this->db
			->select('*')
			->from('mainDetails_varchar')
			->where('user_id', $this->user->info->ID)
			->order_by('date_added', 'ASC')
			->get();

	    $array = array(
			'translation' => $translationArray,
			'user' => $this->user,
			'decimal' => $decQuery->result_array(),
			'varchar' => $vcharQuery->result_array()

			//'userid' => $userdata
		);
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/main.php", $array);
	}
	public function submit() {
        $this->formpost($_POST);
	}
	private function formpost($array) {
		$this->load->library('session');
		$send = array();
		$write = true;
		//if the post isnt an array, stop
		if (!is_array($array)) return false;
        if (!headers_sent()) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r'));
            header('Content-type: application/json');
        }
        //if the request is coming from dbAttribute view with the array submit value set
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
		        $returnData = array('attributeReturn' => '<span class="alert alert-success" role="alert">Sucessfully inserted '. $this->db->affected_rows() . ' row.</span>');
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
			$user_id = $array['ID'];
	        $table_name = $array['formName'];
	        //take those rows off the array, 2 being first two fields of array, so the HTML has to pass them first
	        $array = array_slice($array, 2); 

	        //run through remaining values in array, find their attribute_id and insert
	        //IMPORTANT - names on the form have to match the attribute_name in the respective table
	        foreach ($array as $key => $value) {
	        	//reset query variable
	        	$query = '';
	        	if (is_array($value)) {
	        		$value = implode(',', $value);
	        	}
	        	if (!empty($value)) {
		        	$query = $this->db
		        		->select('attribute_id, attribute_type, attribute_behavior')
		        		->from($table_name)
		        		->where('attribute_name', $key)
		        		->get();
					if ($query->num_rows() > 0) {
						//parse the return of the select statement into something useable
						$row = $query->row_array();
				        $attribute_id = $row['attribute_id'];
				        $attribute_type = $row['attribute_type'];
				        $attribute_behavior = $row['attribute_behavior'];
				        //prepare the data array for insert
				        if ($attribute_type == 'datetime') {
				        	//dealing with the date format masking (slashes) as a result of the jquery function
			        		$value = date('Y-m-d H:i:s', strtotime(htmlspecialchars_decode($value)));
			        	}
				        $data = array(
				        	'user_id' => $user_id, 
				        	'attribute_id' => $attribute_id,
				        	'value' => $value);
				        //do the dirty
				        if ($write == true || isset($data)) {
				        	//stitch the name of the table to write to based on the info we know
				        	$prepared_table_name = $table_name.'Details_'.$attribute_type;
				        	//lookup the data to check for update statement
				        	$query = $this->db
		        					->select('attribute_id, value')
		        					->from($prepared_table_name)
		        					->where('user_id', $user_id)
		        					->where('attribute_id', $attribute_id)
		        					->order_by('date_added', 'DESC')
		        					->get();
				        	//deal with update behaviors first, checking if it exists already to determine the inner update/insert
				        	if ($attribute_behavior == 'update') {
	        					if ($query->num_rows() > 0) {
					        		$this->db->where('user_id', $user_id);
					        		$this->db->where('attribute_id', $attribute_id);
					        		$this->db->update($prepared_table_name, $data);
					        		$send[$key.$value] = array('result' => $this->db->affected_rows() . ' row updated.', 'data' => $data);
					        	}
					        	else {
					        		$this->db->insert($prepared_table_name, $data);
					        		$send[$key.$value] = array('result' => $this->db->affected_rows() . ' row first insert.', 'data' => $data);
					        	}
				        	}
				        	else if ($attribute_behavior == 'insert') {
				        		if ($value != $query->row(0)->value && $value > 0) {
				        			$this->db->insert($prepared_table_name, $data);
				        			$send[$key.$value] = array('result' => $this->db->affected_rows() . ' row inserted.', 'data' => $data);
				        		}
				        		else {
				        			$send[$key.$value] = array('result' => '0 rows inserted.', 'data' => $data);
				        		}
				        	}
				        }
				        
					}//end insert query
					else {
						//$data = 'no data returned from SQL select for parameters passed | key= '.$key.' | value= '.serialize($value).' | query= '.serialize($query);
						$data = 'no insert or update';
					}
				}//end checking for empty data
				if ($key == 'submit') {
		        	redirect('Account/index');
		        }
	        }//end foreach
	        
	        //give some debug return for the console on the ajax
	        exit(json_encode($send, JSON_FORCE_OBJECT));
		}
	}
}