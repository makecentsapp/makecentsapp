<!-- include the calls for these two scripts in the template at some point -->
<script type="text/javascript" src="http://makecentsapp.com/assets/vendor/smartforms/jquery.formShowHide.min.js"></script>
<script type="text/javascript" src="http://makecentsapp.com/assets/vendor/smartforms/jquery-cloneya.min.js"></script>
<script type="text/javascript" src="http://makecentsapp.com/assets/vendor/smartforms/jquery.geocomplete.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7x_A4xjZJPfv2dMuDpyUlB67pUCfSuwE&libraries=places"></script>

<script type="text/javascript">
jQuery(document).ready(function($){
	/*$.validator.methods.smartCaptcha = function(value, element, param) {
		return value == param;
	};*/
	var writeMode = false;
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

            	if (writeMode == true) {
	            	$.ajax({
					    data: formdata,
					    type: "post",
					    //url: "<?php echo base_url ('Account/submit'); ?>",
					    url: "#",
					    error: function(xhr, status, error) {
							var err = eval("(" + xhr.responseText + ")");
							alert(err.Message);
						},
					    success: function(data){
					        alert("Data returned: " + JSON.stringify(data));
					    }
					});
				}
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
					}
			});
			window.location = "<?php echo base_url ('Account/index'); ?>";
        }
    }).validate({
    	errorClass: "state-error",
		validClass: "state-success",
		errorElement: "em",
		onkeyup: false,
		onclick: false,
        /*rules: {
            personalName: {
                required: true
            },
            personalAge: {
                required: true,
                minlength: 1,
                maxlength: 3
            }
        },*/
        messages: {
	        personalName: {
	            required: 'Please fill in your name.',
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
    $('#clone-fields').cloneya();
    $("#geoComplete").geocomplete();
    
    //start functions for getting location from browser
    //2-25 based on https://stackoverflow.com/questions/5423938/html-5-geo-location-prompt-in-chrome it looks like we need HTTPS before we can use this set of code
	var x = document.getElementById("personalLocation");

	function getLocation() {
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(showPosition, showError);
	  } else {
	    x.value = "Geolocation is not supported by this browser.";
	  }
	}

	function showPosition(position) {
	  x.value = "Latitude: " + position.coords.latitude + 
	  " | Longitude: " + position.coords.longitude; 
	}

	function showError(error) {
	  switch(error.code) {
	    case error.PERMISSION_DENIED:
	      x.value = "User denied the request for Geolocation. Probably needs to be HTTPS, see comments."
	      break;
	    case error.POSITION_UNAVAILABLE:
	      x.value = "Location information is unavailable."
	      break;
	    case error.TIMEOUT:
	      x.value = "The request to get user location timed out."
	      break;
	    case error.UNKNOWN_ERROR:
	      x.value = "An unknown error occurred."
	      break;
	  }
	}

	$("#getLocation").click(function() { getLocation() });

	$('[data-toggle="tooltip"]').tooltip();

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
        <div class="form-body smart-steps steps-theme-primary stp-nine">
            <form method="post" id="smart-form" action="<?php echo base_url ('Account/submit'); ?>">
            	<!-- hidden field for the current User ID -->
            	<input type="hidden" name="ID" value="<?php echo $currentUserID; ?>">
            	<!-- hidden field for CSRF security token -->
            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            	<!-- hidden field for form name -->
				<input type="hidden" name="formName" value="welcome">
                <h2>About You</h2>
                <fieldset>
	    			<div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p><b>What is your name?</b></p>
	                        <label class="field">
	                            <input type="text" name="personalName" id="personalName" class="gui-input" placeholder="">
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                    <div class="section colm colm4">
	                    	<p><b>How old are you?</b> <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="This will help us know how long we have to work with until your target retirement."></i></p>
	                        <label class="field">
	                            <input type="number" min="1" max="150" name="personalAge" id="personalAge" class="gui-input" placeholder="">
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	    				<div class="section colm colm12">
		    				<p><b>Click the pin or start typing to automatically find your location or enter your address.</b></p>
		    				<p>Current errors because we need to set up google maps API stuff</p>
	                        <div class="smart-widget sm-right smr-50">
	                            <label class="field">
	                                <input type="text" id="geoComplete" name="personalLocation" id="personalLocation" class="gui-input" placeholder="Address">
	                            </label>
	                            <button type="button" id="getLocation" class="button"> <i class="fa fa-map-marker"></i> </button>
                        	</div><!-- end .smart-widget section --> 
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>
               
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
                <h2>Housing</h2>
                <fieldset>
                	<div class="section">
                		<p><b>Do you rent or own your home? Alternativly, is your house paid off / live with your parents?</b></p>
                        <div class="option-group field">
                            <label class="option">
                                <input type="radio" name="housing" class="smartfm-ctrl" value="" data-show-id="rent">
                                <span class="radio"></span> Rent
                            </label>
                            <label class="option">
                                <input type="radio" name="housing" class="smartfm-ctrl" value="" data-show-id="mortgage">
                                <span class="radio"></span> Mortgage                
                            </label>
                            <label class="option">
                                <input type="radio" name="housing" class="smartfm-ctrl" value="" data-show-id="ctr_corporate">
                                <span class="radio"></span> Free               
                            </label>                                                                   
                        </div>
                    </div>
                    <div id="rent" class="hiddenbox">
                    	<div class="frm-row">
		                    <div class="section colm colm6">
		                    	<p><b>What is your monthly rent?</b></p>
		                        <label class="field prepend-icon">
		                            <input type="number" name="rent" id="rent" class="gui-input" placeholder="500">
		                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
		                        </label>
		                    </div><!-- end section -->
		                </div><!-- end .frm-row section -->
                    </div>
                    <div id="mortgage" class="hiddenbox">
                    	<div class="frm-row">
		                    <div class="section colm colm6">
		                    	<p><b>What is your monthly mortgage payment + tax?</b></p>
		                        <label class="field prepend-icon">
		                            <input type="number" name="mortgage" id="mortgage" class="gui-input" placeholder="1,000">
		                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
		                        </label>
		                    </div><!-- end section -->
		                </div><!-- end .frm-row section -->
                    </div>
                </fieldset>
                <h2>Results 1</h2>
                <fieldset>
                	<p><b>Need to come back to this once we start writing to the DB and have ajax load it into variables to be read and calculated.<br><br>This stage would show what % of income is going to housing and how that stacks up with other users near location.</b></p>
                </fieldset>
                <h2>Essentials</h2>
                <fieldset>
                	<div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p><b>How much do you spend per month on the following categories:</b></p>
	                    	<p>Utilities (Power + Water + Heat + Garbage)?</p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="utilities" id="utilities" class="gui-input" placeholder="250">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p>Groceries (Food + Hygiene Products)?</p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="grocery" id="grocery" class="gui-input" placeholder="200">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p>Health Insurance + Health Care?</p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="healthCare" id="healthCare" class="gui-input" placeholder="150">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>
                <h2>Earning Expenses</h2>
                <fieldset>
                	<div class="frm-row">
	                    <div class="section colm colm12">
	                    	<p><b>How much do you spend per month on the following categories:</b></p>
	                    	<p>Transportation (Car Payments + Gas + Parking / Public Transportation)?</p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="transportation" id="transportation" class="gui-input" placeholder="150">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                    <div class="section colm colm6">
	                    	<p>Cell Phone?</p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="cellPhone" id="cellPhone" class="gui-input" placeholder="50">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
	                <div class="frm-row">
	                    <div class="section colm colm12">
	                    	<p>Internet (if you bundle with TV and/or other services, put total bill)?</p>
	                        <label class="field prepend-icon">
	                            <input type="number" name="internet" id="internet" class="gui-input" placeholder="50">
	                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
	                        </label>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>
                <h2>Results 2</h2>
                <fieldset>
                <p><b>Need to come back to this once we start writing to the DB and have ajax load it into variables to be read and calculated.<br><br>This stage would show what % of income is going to necessary expenses and how that stacks up with other users near location. If high, maybe suggest generic products or reduce bills by switching carriers. If low, congratulate.</b></p>
                </fieldset>
                <h2>Debts</h2>
                <fieldset>
                <p><b>Do you have any debts or loans that you are currently paying back?</b></p>
	    			<div id="clone-fields">
                        <div class="toclone clone-widget">
	                        <div class="frm-row">
	                        	<div class="spacer-b10 colm colm5">
		                            <input type="text" name="debtDescription[]" id="debtDescription" class="gui-input" placeholder="Description">
		                        </div>
			                    <div class="spacer-b10 colm colm4">
			                    	<label class="field prepend-icon">
			                            <input type="number" name="debtAmount[]" id="debtAmount" class="gui-input" placeholder="Debt / Loan Amount">
			                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
		                       		</label>
		                        </div>
		                        <div class="spacer-b10 colm colm3">
		                            <label class="append-icon">
		                                <input type="number" name="debtInterestRate[]" id="debtInterestRate" class="gui-input" placeholder="Interest Rate">
		                                <span class="field-icon"><i class="fas fa-percent"></i></span> 
		                            </label>
		                        </div>
	                        </div><!-- end .frm-row section -->
			                <a href="#" class="clone button btn-primary"><i class="fa fa-plus"></i></a>
		                    <a href="#" class="delete button"><i class="fa fa-minus"></i></a>
	                    </div>
	                </div>
                </fieldset>
                <h2>Emergency Fund</h2>
                <fieldset>
                	<div class="frm-row">
		                <div class="section colm colm6">
		                	<p><b>Do you have $1,000 or one months worth of expenses (whichever is greater) in a bank account?</b></p>
					        <label class="switch">
					            <input type="checkbox" name="emergencyFund" id="emergencyFund">
					            <span class="switch-label" data-on="Yes" data-off="No"></span>
					        </label>
						</div><!-- end section -->
					</div>
                </fieldset>
				<div class="result spacer-b10"></div><!-- end .result  section -->
            </form>
            <small id="emailHelp" class="form-text text-muted"><i class="fas fa-lock"></i> We will never share your data. <a href="#">Privacy Policy</a></small>
        </div><!-- end .form-body section -->
    </div><!-- end .smart-forms section -->
</div><!-- end .smart-wrap section -->