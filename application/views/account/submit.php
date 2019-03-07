<?php
if (isset($_POST) && !empty($_POST)) {
	var_dump($_POST);
	//echo $_POST['basicIncome'];
}
else {
	echo 'you went direct. need post for the good stuff.';
}
/*class Form extends CI_Controller {
public function __construct() {
parent::__construct();
}

$ID = $_POST['ID'];

$data = array('basicIncome' => , $_POST['basicIncome']);
echo '<br>';
public function updateCore($ID, $data) {
    $this->db->where("ID", $ID)->update("core", $data);
    echo $this->db->affected_rows();
}

updateCore($ID, $data);
}*/
?>