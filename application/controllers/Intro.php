<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intro extends CI_Controller
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("register_model");
        $this->load->model("welcome_model");
        //loading kint for debugging, can remove later
        $this->load->library('kint');
	}

    public function index()
	{
		/**
		 * @todo intro error view
		 */
		$this->template->set_page_title(lang("ctn_1501"));
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/intro_layout.php");
		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}
		if ($this->user->loggedin) {
			redirect(base_url());
        }
        $this->template->loadExternal(
            '
            <script type="text/javascript" src="'.base_url().'assets/vendor/smartforms/jquery.formShowHide.min.js"></script>
            <script type="text/javascript" src="'.base_url().'assets/vendor/smartforms/jquery.maskedinput.js"></script>
            <script type="text/javascript" src="'.base_url().'assets/vendor/smartforms/jquery-cloneya.min.js"></script>
            <!-- touchpunch necessary for mobile tap to slide sliders - thanks chris! -->
            <script type="text/javascript" src="'.base_url().'assets/vendor/jquery.touchpunch/touchpunch.min.js"></script>
    
            <script type="text/javascript" src="'.base_url().'assets/vendor/jquery.wizard/jquery.wizard.js"></script>
            <script type="text/javascript" src="'.base_url().'scripts/makecents/welcome/intro.js" /></script>
            <link href="'.base_url().'styles/welcome_and_intro.css" rel="stylesheet" type="text/css">
            '
        );
        
		$this->template->loadContent("account/form/intro.php", array());
    }
	
	public function submit()
	{
		$this->introPost($_POST);
	}
	private function introPost($array)
    {
		$this->load->library('session');
		$this->load->model("welcome_model");
        $send = array();
        $write = true;
        //if the post isnt an array, stop
        if (!is_array($array)) {
            return false;
        }

        if (!headers_sent()) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r'));
            header('Content-type: application/json');
        }
		//if the request is coming from dbAttribute view with the array submit value set
		/**
		 * @todo Make welcome model functions for this part
		 */
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
                $returnData = array('attributeReturn' => '<span class="alert alert-success" role="alert">Sucessfully inserted ' . $this->db->affected_rows() . ' row.</span>');
                $this->session->set_userdata($returnData);
            } else {
                $returnData = array('attributeReturn' => 'That attribute name already exists in the ' . $table_name . ' table');
                $this->session->set_userdata($returnData);
            }
            redirect('Account/dbAttribute');
        } else {
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
                    $query = $this->welcome_model->getAttribute($table_name, $key);
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
                            $prepared_table_name = $table_name . 'Details_' . $attribute_type;
                            //lookup the data to check for update statement
                            $query = $this->welcome_model->getAttributeDetail($prepared_table_name, $user_id, $attribute_id);
                            //deal with update behaviors first, checking if it exists already to determine the inner update/insert
                            if ($attribute_behavior == 'update') {
                                if ($query->num_rows() > 0) {
									$updateAffected = $this->welcome_model->updateUserAttribute($user_id, $attribute_id, $prepared_table_name, $data);
                                    $send[$key . $value] = array('result' => $updateAffected . ' row updated.', 'data' => $data);
                                } else {
                                    $this->db->insert($prepared_table_name, $data);
                                    $send[$key . $value] = array('result' => $this->db->affected_rows() . ' row first insert.', 'data' => $data);
                                }
                            } else if ($attribute_behavior == 'insert') {
                                if ($query->num_rows() > 0) {
                                    if ($value != $query->row(0)->value && $value > 0) {
                                        $send[$key . $value] = array('result' => $this->welcome_model->insertData($prepared_table_name, $data) . ' row inserted.', 'data' => $data);
                                    } else {
                                        $send[$key . $value] = array('result' => '0 rows inserted.', 'data' => $data);
                                    }
                                } else {
                                    $send[$key . $value] = array('result' => '0 rows inserted.', 'data' => $data);
                                }
                            }
                        }

                    } //end insert query
                    else {
                        //$data = 'no data returned from SQL select for parameters passed | key= '.$key.' | value= '.serialize($value).' | query= '.serialize($query);
                        $data = 'no insert or update';
                    }
                } //end checking for empty data
                if ($key == 'submit') {
                    $details = array();
                    $resultsQuery = $this->welcome_model->getUserAttributesData($table_name, $user_id);
                    foreach($resultsQuery->result_array() as $k=>$v) {
                        $details[$k] = $v;
                    }
                    $details['user_id'] = $details[0]['user_id'];
                    $details['table'] = $table_name;
                    $results = array('details' => $details);
                    $this->session->set_userdata($results);
                    
                    redirect('Intro/results');
                }
            } //end foreach

            //give some debug return for the console on the ajax
            exit(json_encode($send, JSON_FORCE_OBJECT));
        }
	}
	
	public function results()
	{
		/**
		 * @todo results error view
		 */
		$this->template->set_page_title(lang("ctn_1502"));
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/intro_layout.php");
		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}
		if ($this->user->loggedin) {
			redirect(base_url());
        }
        $this->template->loadExternal(
            '
            <script type="text/javascript" src="'.base_url().'scripts/makecents/welcome/results.js" /></script>
            '
        );
		$this->template->loadContent("account/form/results.php");
    }
}
