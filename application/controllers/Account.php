<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct()
      {
        parent::__construct();

        if(!$this->user->loggedin) {
            redirect(site_url("login"));
        }
        $this->template->loadData("activeLink", array("home" => array("account" => 1)));
				$this->load->model('user_model');
				$this->load->model('Welcome_model');
				$this->load->model('Form_model');

		$userdata = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
		$findata = $this->db
			->select('*')
			->from('main_data_union')
			->where('user_id', $this->user->info->ID)
			->order_by('attribute_id', 'ASC')
			->get();
		$weldata = $this->db
			->select('*')
			->from('welcome_data_union')
			->where('user_id', $this->user->info->ID)
			->order_by('attribute_id', 'ASC')
			->get();


			$wel = array();
			foreach ($weldata->result_array() as $row) {
			    $wel[$row['attribute_name']] = $row['value'];
			}
			$fin = array();
			foreach ($findata->result_array() as $row) {
			    $fin[$row['attribute_name']] = $row['value'];
			}

			$calcs = array(
			    'totalExpenses' => 0,
			    'foodExpense' => 0,
			    'totalAssets' => 0,
			    );

			if (!empty($fin['dob'])) {
			    $calcs['age'] = date_diff(date_create($fin['dob']), date_create('now'))->y;
			}

			//add up expenses, might need tweaking in the future
			switch ($fin['housing']) {
			    case 'rent':
			        $calcs['housingCost'] = $fin['rentAmount'];
			        break;
			    case 'mortgage':
			    /**
			     * @todo mortgage question needs to be revisisted to understand what the monthly payment amounts are, so then we can evaluate if it fits into a budget
			     */
			        $calcs['housingCost'] = $fin['mortgageAmount'];
			        break;
			    case 'paidOff':
			        $calcs['housingCost'] = $fin['propertyTaxes'];
			        break;
			    case 'free':
			        $calcs['housingCost'] = 0;
			        break;
			}
			/**
			 * @todo integrate the expense total estimate from the welcome form and compare to calculated total expense, use whatever is greater.
			 */
			if ($fin['housing'] == 'rent') {
			    $calcs['totalExpenses'] += $fin['rentAmount'];
			}
			if ($fin['foodExpense'] == 'customAmount') {
			    $calcs['foodExpense'] += $fin['customFood'];
			}
			else {
			    $calcs['foodExpense'] += $fin['foodExpense'];
			}
			$calcs['totalExpenses'] += $calcs['foodExpense'];
			if ($fin['car'] !== 'noCar') {
			    $calcs['totalExpenses'] += $fin['carInsurance'];
			}
			$calcs['totalExpenses'] += $fin['healthInsurance'];

			//add up debts
			if (!empty($fin['debtMinimum'])) {
			    $calcs['totalMinDebtPayment'] = array_sum(explode(',', $fin['debtMinimum']));
			}
			if (!empty($fin['debtAmount'])) {
			    $calcs['totalDebt'] = array_sum(explode(',', $fin['debtAmount']));
			}
			//get the debt stuff into a useable format and also classify the risk of the debt
			if (!empty ($fin['debtAmount'])) {
			$countDebt = count(explode(',', $fin['debtAmount']));
			}
			else {
			    $countDebt = 0;
			}
			$i = 0;
			if (!empty ($fin['debtDescription'])) {
			    $debtDescriptions = explode(',', $fin['debtDescription']);
			}
			if (!empty ($fin['debtAmount'])) {
			    $debtAmounts = explode(',', $fin['debtAmount']);
			}
			if (!empty ($fin['debtInterestRate'])) {
			    $debtInterestRates = explode(',', $fin['debtInterestRate']);
			}
			if (!empty ($fin['debtMinimum'])) {
			    $debtMinimums = explode(',', $fin['debtMinimum']);
			}
			if ($countDebt > 0) {
			    while ($i < $countDebt) {
			        $calcs['debts'][$i]['debtDescription'] = ucwords(str_replace('_', ' ', array_shift($debtDescriptions)));
			        $calcs['debts'][$i]['debtAmount'] = array_shift($debtAmounts);
			        $calcs['debts'][$i]['debtInterestRate'] = array_shift($debtInterestRates);
			        $calcs['debts'][$i]['debtMinimum'] = array_shift($debtMinimums);
			        if ($calcs['debts'][$i]['debtInterestRate'] >= 10) {
			            $calcs['debts'][$i]['debtClassification'] = 'high';
			        }
			        else {
			            $calcs['debts'][$i]['debtClassification'] = 'moderate';
			        }
			        $i++;
			    }
			}

			$calcs['minEmergencyFund'] = $calcs['totalExpenses'] + $calcs['totalMinDebtPayment'];
			if ($calcs['minEmergencyFund'] < 1000) {
			    $calcs['minEmergencyFund'] = 1000;
			}
			$calcs['targetEmergencyFund'] = $calcs['minEmergencyFund'] * 3;

			//add up assets
			if (!empty($fin['cashOnHand'])) {
			    $calcs['totalAssets'] += $fin['cashOnHand'];
			}
			if ($fin['car'] !== 'noCar') {
			    $calcs['totalAssets'] += $fin['carValue'];
			}
			if (!empty($fin['retirementSavings'])) {
			    $calcs['totalAssets'] += $fin['retirementSavings'];
			}

			//retirement
			switch ($fin['retirementMatchContribution']) {
			    case 'noContribution':
			        $calcs['retirementContribution'] = 'I dont contribute at all';
			        break;
			    case 'contributionMatch':
			        $calcs['retirementContribution'] = 'I contribute up to the employer match';
			        break;
			    case 'contributionAbove':
			        $calcs['retirementContribution'] = 'I contribute above the employer match';
			        break;
			    case 'contributionUnknown':
			        $calcs['retirementContribution'] = 'I dont know';
			        break;
			}

			global $array;
			$array = array(
				'user' => $this->user,
				'fin' => $fin,
				'wel' => $wel,
				'calcs' => $calcs
			);
	    }

	public function index() {
	//enabling the profiler to show more data on the view
	//$this->output->enable_profiler(TRUE);
	
		global $array;
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/index.php", $array);
	}
	public function debts() {
	//enabling the profiler to show more data on the view
	//$this->output->enable_profiler(TRUE);
	
		global $array;
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/node/debts.php", $array);
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
		$translationQuery = $this->db
		->select('*')
		->from('main')
		->get();
		foreach ($translationQuery->result_array() as $row) {
			$translationArray[$row['attribute_id']] = $row['attribute_name'];
		}
		$userdata = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
		$dateQuery = $this->db
			->select('*')
			->from('mainDetails_datetime')
			->where('user_id', $this->user->info->ID)
			->order_by('date_added', 'ASC')
			->get();
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
			'datetime' => $dateQuery->result_array(),
			'decimal' => $decQuery->result_array(),
			'varchar' => $vcharQuery->result_array()

			//'userid' => $userdata
		);
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/dbAttribute.php", $array);
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
		$dateQuery = $this->db
			->select('*')
			->from('mainDetails_datetime')
			->where('user_id', $this->user->info->ID)
			->order_by('date_added', 'ASC')
			->get();
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
			'datetime' => $dateQuery->result_array(),
			'decimal' => $decQuery->result_array(),
			'varchar' => $vcharQuery->result_array()

			//'userid' => $userdata
		);
		//Remove after BS4 re-code:
		$this->template->layout = '/layout/themes/atmos.php';
		$this->template->loadContent("account/form/main.php", $array);
	}

	public function main2() {
		$translationArray = $this->Form_model->getTranslationArray();
		
		$dateQuery = $this->Form_model->getDateQuery($this->user->info->ID);
		$decQuery = $this->Form_model->getDecimalQuery($this->user->info->ID);
		$vcharQuery = $this->Form_model->getVarcharQuery($this->user->info->ID);

	  $array = array(
			'translation' => $translationArray,
			'user' => $this->user,
			'datetime' => $dateQuery->result_array(),
			'decimal' => $decQuery->result_array(),
			'varchar' => $vcharQuery->result_array()
		);
		$this->template->loadExternal(
			'
			<script type="text/javascript" src="'.base_url().'assets/vendor/smartforms/jquery.formShowHide.min.js"></script>
			<!-- cleave is for imput masking -->
			<script type="text/javascript" src="'.base_url().'assets/vendor/cleave/cleave.min.js"></script>
			<script type="text/javascript" src="'.base_url().'assets/vendor/smartforms/jquery-cloneya.min.js"></script>

			<script type="text/javascript" src="'.base_url().'assets/vendor/jquery.touchpunch/touchpunch.min.js"></script>
	
			<script type="text/javascript" src="'.base_url().'assets/vendor/jquery.wizard/jquery.wizard.js"></script>

			<script type="text/javascript" src="'.base_url().'scripts/makecents/account/main.js" /></script>
			<link href="'.base_url().'styles/main_form.css" rel="stylesheet" type="text/css">
			'
		);
		$this->template->loadContent("account/form/main2.php", $array);
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
						if ($attribute_type == 'decimal') {
							$value = str_replace(',', '', $value);
							$value = str_replace('$', '', $value);
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
				//if a blank value is passed, clear out the DB for that field
				/**
				 * @todo need to build this still
				 */
				else if (empty($value)) {

				}
				if ($key == 'submit') {
					redirect('Account/index');
				}
			}//end foreach
			//give some debug return for the console on the ajax
			exit(json_encode($send, JSON_FORCE_OBJECT));
		}
	}
}