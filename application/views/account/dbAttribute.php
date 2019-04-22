<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class="">Form fields -> DB
                </h4>
                <p class="opacity-75 ">
                    Interface to add new attributes to the database tables. This allows to create new receptors for form fields without having to open DB software.
                    <br>
                    Input form type, field type, action, and name.
                </p>


            </div>
        </div>
    </div>
</div>
<div class="container  pull-up">
<?php
$this->load->library('session');
if (isset($this->session->attributeReturn)) {
	echo $this->session->attributeReturn;
}
$selectOptions = array(
	'welcome' => 'Welcome Table', 
	'main' => 'Main Table', 
	);
$typeOptions = array(
	'decimal' => 'Decimal', 
	'varchar' => 'VarChar',
	'datetime' => 'DateTime'
	);
$writeOptions = array(
	'insert' => 'Insert (keep historical data)', 
	'update' => 'Update (overwrite with newest value)'
	);

$this->load->helper('form');
echo form_open('Account/submit');
echo '<div class="row">';
	echo '<div class="col">';
echo form_dropdown('table', $selectOptions, '', 'class="form-control"');
	echo '</div>';
	echo '<div class="col">';
echo form_dropdown('type', $typeOptions, 'decimal', 'class="form-control"');
	echo '</div>';
	echo '<div class="col">';
echo form_dropdown('behavior', $writeOptions, 'update', 'class="form-control"');
	echo '</div>';
	echo '<div class="col">';
echo form_input('name', '', 'placeholder="new attribute name" class="form-control"');
	echo '</div>';
	echo '<div class="col">';
echo form_submit('attributeSubmit', 'Save', 'class="btn btn-primary"');
	echo '</div>';
echo '</div>';
?>
</div>