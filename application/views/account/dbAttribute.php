<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">

                <h4 class="">  Form elements
                </h4>
                <p class="opacity-75 ">
                    Examples for form control styles, layout options, and custom components for
                    creating a wide variety of forms elements.
                    <br>
                    we have included dropzone for file uploads, datepicker and select2 for custom controls.
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
	'personal' => 'Personal Table', 
	'income' => 'Income Table'
	);
$typeOptions = array(
	'decimal' => 'Decimal', 
	'varchar' => 'VarChar'
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