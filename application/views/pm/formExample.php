<script type="text/javascript">
jQuery(document).ready(function($){
	/*$.validator.methods.smartCaptcha = function(value, element, param) {
		return value == param;
	};*/
	var formdata = '';
    $("#smart-form").steps({
        headerTag: "h2",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        autoFocus: true,
        labels: {
            finish: "Save",
            next: "Continue",
            previous: "Go Back",
            loading: "Loading..."
        },	
        onStepChanging: function (event, currentIndex, newIndex){
        	//when going from one step to the next, run all the validation rules and messages
			if (currentIndex > newIndex){return true; }
			var form = $(this);
			if (currentIndex < newIndex){}
			return form.valid();
		},
        onStepChanged: function (event, currentIndex, priorIndex){
        	//after sucessfully passing validation, when the step changes to the next, submit changed data to DB
        	
            //check if anything in the form has been updated since last onStepChanged
            if (formdata !== $('#smart-form').serialize()) {
            	formdata = $('#smart-form').serialize();

            	$.ajax({
				    data: formdata,
				    type: "post",
				    url: "<?php echo base_url ('PM/submit'); ?>",
				    error: function(xhr, status, error) {
						var err = eval("(" + xhr.responseText + ")");
						alert(err.Message);
					},
				    success: function(data){
				        alert("Data returned: " + JSON.stringify(data));
				    }
				});
            }    
        },
        onFinishing: function (event, currentIndex){
            var form = $(this);
			form.validate().settings.ignore = ":disabled";
			return form.valid();
        },
        onFinished: function (event, currentIndex){
            var form = $(this);
			$(form).ajaxSubmit({
					target:'.result',			   
					beforeSubmit:function(){ 
					},
					error:function(){
					},
					success:function(){
						window.location = "<?php echo base_url ('PM/core'); ?>";
						
					}
			});	 
        }
    }).validate({
    	errorClass: "state-error",
		validClass: "state-success",
		errorElement: "em",
		onkeyup: false,
		onclick: false,
        rules: {
            basicIncome: {
                required: true,
                minlength: 5
            },
            basicCCDebt: {
				required: "#CCSwitch:checked"
			},
			basicCCInterest: {
				required: "#CCSwitch:checked"
			},
			basicAutoDebt: {
				required: "#AutoSwitch:checked"
			},
			basicAutoInterest: {
				required: "#AutoSwitch:checked"
			},
			basicMortgageDebt: {
				required: "#mortgageSwitch:checked"
			},
			basicMortgageInterest: {
				required: "#mortgageSwitch:checked"
			}
        },
        messages: {
	        basicIncome: {
	            required: 'Please fill in your annual income.',
	            minlength: 'If you make less than 5 digits, call the department of labor.'
	        }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.field').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.field').removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function(error, element) {
            if (element.is(":radio") || element.is(":checkbox")) {
                element.closest('.option-group').after(error);
            } else {
                error.insertAfter(element.parent());
            }
        }	
    });
    $('.smartfm-ctrl').formShowHide(); 
});

</script>
<?php
//echo '<pre>';
$currentUserID = $this->user->info->ID;
//echo $currentUserID;
//echo '</pre>';
?>
<div class="smart-wrap">
    <div class="smart-forms smart-container wrap-1">
    
        <div class="form-body smart-steps steps-theme-primary stp-three">
            <form method="post" id="smart-form" action="<?php echo base_url ('PM/submit'); ?>">
            	<!-- hidden field for the current User ID -->
            	<input type="hidden" name="ID" value="<?php echo $currentUserID; ?>">
            	<!-- hidden field for CSRF security token -->
            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <h2>Income</h2>
                <fieldset>
	    			<div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p><b>What is your annual income?</b></p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="basicIncome" id="basicIncome" class="gui-input" placeholder="25,000">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>
                
                <h2>Debts</h2>
                <fieldset>
	    			<div class="frm-row">
	                
		                <div class="section colm colm3">
		                	<p><b>Do you have any credit card debt?</b></p>
					        <label class="switch">
					            <input type="checkbox" name="CCSwitch" id="CCSwitch" class="smartfm-ctrl" data-show-id="ctr_CC">
					            <span class="switch-label" data-on="Yes" data-off="No"></span>
					        </label>
						</div><!-- end section -->

						<div id="ctr_CC" class="hiddenbox">
		                    <div class="section colm colm5">
		                    	 <p><b>What is your credit card balance?</b></p>
		                        <label class="field prepend-icon">
		                            <input type="number" name="basicCCDebt" id="basicCCDebt" class="gui-input" placeholder="1,000">
		                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
		                        </label>
		                    </div><!-- end section -->
		                    <div class="section colm colm4">
		                    	<p><b>What is the interest rate?</b></p>
		                    	<div class="colm colm6">
		                        <label class="field append-icon">
		                            <input type="number" name="basicCCInterest" id="basicCCInterest"class="gui-input" placeholder="25">
		                            <span class="field-icon"><i class="fas fa-percent"></i></span>
		                        </label>
		                        </div>
		                    </div><!-- end section -->
		                </div>

	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                
		                <div class="section colm colm3">
		                	<p><b>Do you have a car loan?</b></p>
					        <label class="switch">
					            <input type="checkbox" name="AutoSwitch" id="AutoSwitch" class="smartfm-ctrl" data-show-id="ctr_Auto">
					            <span class="switch-label" data-on="Yes" data-off="No"></span>
					        </label>
						</div><!-- end section -->

						<div id="ctr_Auto" class="hiddenbox">
		                    <div class="section colm colm5">
		                    	 <p><b>What is your remaining loan balance?</b></p>
		                        <label class="field prepend-icon">
		                            <input type="number" name="basicAutoDebt" id="basicAutoDebt" class="gui-input" placeholder="10,000">
		                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
		                        </label>
		                    </div><!-- end section -->
		                    <div class="section colm colm4">
		                    	<p><b>What is the interest rate?</b></p>
		                    	<div class="colm colm6">
		                        <label class="field append-icon">
		                            <input type="number" name="basicAutoInterest" id="basicAutoInterest" class="gui-input" placeholder="7">
		                            <span class="field-icon"><i class="fas fa-percent"></i></span>
		                        </label>
		                        </div>
		                    </div><!-- end section -->
		                </div>

	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                
		                <div class="section colm colm3">
		                	<p><b>Do you have a mortgage?</b></p>
					        <label class="switch">
					            <input type="checkbox" name="mortgageSwitch" id="mortgageSwitch" class="smartfm-ctrl" data-show-id="ctr_mortgage">
					            <span class="switch-label" data-on="Yes" data-off="No"></span>
					        </label>
						</div><!-- end section -->

						<div id="ctr_mortgage" class="hiddenbox">
		                    <div class="section colm colm5">
		                    	 <p><b>What is your remaining mortgage balance?</b></p>
		                        <label class="field prepend-icon">
		                            <input type="number" name="basicMortgageDebt" id="basicMortgageDebt" class="gui-input" placeholder="100,000">
		                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
		                        </label>
		                    </div><!-- end section -->
		                    <div class="section colm colm4">
		                    	<p><b>What is the interest rate?</b></p>
		                    	<div class="colm colm6">
		                        <label class="field append-icon">
		                            <input type="number" name="basicMortgageInterest" id="basicMortgageInterest" class="gui-input" placeholder="3.75">
		                            <span class="field-icon"><i class="fas fa-percent"></i></span>
		                        </label>
		                        </div>
		                    </div><!-- end section -->
		                </div>

	                </div><!-- end .frm-row section -->
                </fieldset>

                <h2>401k Match</h2>
                <fieldset>
	    			<div class="frm-row">
	                    <div class="section colm colm12">
		                	<p><b>Does your employer offer a retirement plan (401k, 403b, etc)?</b></p>
					        <label class="switch">
					            <input type="checkbox" name="retirementPlanSwitch" id="retirementPlanSwitch" class="smartfm-ctrl" data-show-id="ctr_match">
					            <span class="switch-label" data-on="Yes" data-off="No"></span>
					        </label>
						</div><!-- end section -->
	                </div><!-- end .frm-row section -->

	                <div id="ctr_match" class="hiddenbox">
		                <div class="frm-row">
		                    <div class="section colm colm12">
			                	<p><b>Do they match your contributions?</b></p>
						        <label class="switch">
						            <input type="checkbox" name="retirementMatchSwitch" id="retirementMatchSwitch" class="smartfm-ctrl" data-show-id="ctr_matchAmount">
						            <span class="switch-label" data-on="Yes" data-off="No"></span>
						        </label>
							</div><!-- end section -->
		                </div><!-- end .frm-row section -->
		                <div id="ctr_matchAmount" class="hiddenbox">
			                <div class="frm-row">
			                    <div class="section colm colm12">
				                	<p><b>What percentage do they match up to?</b></p>
							        <div class="colm colm3">
			                        <label class="field append-icon">
			                            <input type="number" name="retirementMatchAmount" id="retirementMatchAmount" class="gui-input" placeholder="3">
			                            <span class="field-icon"><i class="fas fa-percent"></i></span>
			                        </label>
			                        </div>
								</div><!-- end section -->
			                </div><!-- end .frm-row section -->
			                
			            </div>
			            <div class="frm-row">
			                    <div class="section colm colm12">
				                	<p><b>What total percentage of your income do you contribute to the plan?</b></p>
							        <div class="colm colm3">
			                        <label class="field append-icon">
			                            <input type="number" name="retirementContributionAmount" id="retirementContributionAmount" class="gui-input" placeholder="10">
			                            <span class="field-icon"><i class="fas fa-percent"></i></span>
			                        </label>
			                        </div>
								</div><!-- end section -->
			                </div><!-- end .frm-row section -->
		            </div>
		            <div class="result spacer-b10"></div><!-- end .result  section -->   
                </fieldset>
            </form>
            <small id="emailHelp" class="form-text text-muted"><i class="fas fa-lock"></i> We will never share your data. <a href="#">Privacy Policy</a></small>
        </div><!-- end .form-body section -->
    
    </div><!-- end .smart-forms section -->
</div><!-- end .smart-wrap section -->

<?php 
echo '<pre>test form stuff';

//replace with form POST in production use
$exampleFormArray = array(
        	'formName' => 'personal', 
        	'id' => 2, 
        	'name' => 'John Doe', 
        	'age' => '45'
        );
		//setup the basic variables consistent regardless of how many fields are passed
		$user_id = $exampleFormArray['id'];
        $table_name = $exampleFormArray['formName'];
        //take those rows off the array, 2 being first two fields of array, so the HTML has to pass them first
        $exampleFormArray = array_slice($exampleFormArray, 2); 

        //run through remaining values in array, find their attribute_id and insert
        foreach ($exampleFormArray as $key => $value) {
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
				        $this->db->insert($table_name.'Details', $data);
				}//end insert query
			}//end checking for empty data
        }//end foreach
        
echo '</pre>';
?>
