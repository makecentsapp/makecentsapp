<?php
$this->load->library('session');
if (isset($this->session->attributeReturn)) {
	echo $this->session->attributeReturn;
}
$this->load->helper('form');
echo form_open('PM/submit');
$selectOptions = array(
	'personal' => 'Personal Table', 
	'income' => 'Income Table'
	);
echo form_dropdown('table', $selectOptions, 'personal');
echo form_input('attribute_name', '', 'placeholder="new attribute name"');
echo form_submit('attributeSubmit', 'Save');
?>