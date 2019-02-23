<script type="text/javascript">
		$.validator.methods.smartCaptcha = function(value, element, param) {
			return value == param;
		};
        $("#smart-form").steps({
            headerTag: "h2",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            stepsOrientation: "vertical",
            autoFocus: true,
            labels: {
                finish: "Submit Form",
                next: "Continue",
                previous: "Go Back",
                loading: "Loading..."
            },	
            onStepChanging: function (event, currentIndex, newIndex){
            
                /* WHEN CHANGING A STEP */	
            
            },
            onStepChanged: function (event, currentIndex, priorIndex){
                
                /* AFTER CHANGING A STEP */		
        
            },
            onFinishing: function (event, currentIndex){
                
                /* WHEN COMPLETING CHANGING A STEP */	
            },
            onFinished: function (event, currentIndex){
                
                /* AJAX SUBMIT HANDLER GOES HERE */	 
            }
        }).validate({
        	errorClass: "state-error",
			validClass: "state-success",
			errorElement: "em",
            rules: {
                
                basicIncome: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                
                messages: {
			        basicIncome: {
			            required: 'Please fill the Income field, dick.'
			        }                                  
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
</script>
<?php
echo '<pre>';
print_r($this->_ci_cached_vars);
echo '</pre>';
?>

<div class="smart-wrap">
    <div class="smart-forms smart-container wrap-1">
    
        <div class="form-body smart-steps stp-three">
            <form method="post" id="smart-form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                <h2>Income</h2>
                <fieldset>
	    			<div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p><b>What is your annual income?</b></p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="basicIncome" id="basicIncome" class="gui-input" placeholder="25,000">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                        <small id="emailHelp" class="form-text text-muted"><i class="fas fa-lock"></i> We will never share your data. <a href="#">Privacy Policy</a></small>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>
                
                <h2>Debts</h2>
                <fieldset>
	    			<div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p><b>Credit Card Debt?</b></p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="basicCCDebt" id="basicCCDebt" class="gui-input" placeholder="1,000">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                    <div class="section colm colm6">
	                    	<p><b>Credit Card Interest Rate?</b></p>
	                    		<div class="colm colm4">
			                        <label class="field">
			                            <input type="number" name="basicCCInterest" id="basicCCInterest" class="gui-input" placeholder="25%">
			                        </label>
			                    </div>
	                    </div><!-- end section -->
	                    
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p><b>Car Loan?</b></p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="basicCarDebt" id="basicCarDebt" class="gui-input" placeholder="10,000">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                    <div class="section colm colm6">
	                    	<p><b>Car Loan Interest Rate?</b></p>
	                    	<div class="colm colm4">
		                        <label class="field">
		                            <input type="number" name="basicCarInterest" id="basicCarInterest" class="gui-input" placeholder="10%">
		                        </label>
	                        </div>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                
		                <div class="section colm colm2">
		                <p><b>Do you have a mortgage?</b></p>
						    
						        <label class="switch">
						            <input type="checkbox" name="switch1" id="switch1" value="switch1">
						            <span class="switch-label" data-on="Yes" data-off="No"></span>
						        </label>
						    
						</div><!-- end section -->
	                    <div class="section colm colm5">
	                    	 <p><b>Mortgage Balance?</b></p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="basicMortgageDebt" id="basicMortgageDebt" class="gui-input" placeholder="100,000">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                    <div class="section colm colm5">
	                    	<p><b>Mortgage Interest Rate?</b></p>
	                    	<div class="colm colm4">
		                        <label class="field">
		                            <input type="number" name="basicMortgageInterest" id="basicMortgageInterest" class="gui-input" placeholder="5%">
		                        </label>
		                    </div>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>

                <h2>401k Match</h2>
                <fieldset>
	    			<div class="frm-row">
	                    <div class="section colm">
	                        <label class="field prepend-icon">
	                        	<p><b>Does your employer offer a 401k plan? If so, do they match contributions and how much?</b></p>
	                            <input type="number" name="basic401kMatch" id="basic401kMatch" class="gui-input" placeholder="3%">
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>
            </form>                                                                                   
        </div><!-- end .form-body section -->
    
    </div><!-- end .smart-forms section -->
</div><!-- end .smart-wrap section -->


