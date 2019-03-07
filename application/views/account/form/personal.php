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
				    //url: "<?php echo base_url ('PM/submit'); ?>",
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
			window.location = "<?php echo base_url ('PM/index'); ?>";
        }
    }).validate({
    	errorClass: "state-error",
		validClass: "state-success",
		errorElement: "em",
		onkeyup: false,
		onclick: false,
        rules: {
            personalName: {
                required: true
            },
            personalAge: {
                required: true,
                minlength: 1,
                maxlength: 3
            }
        },
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
        <div class="form-body smart-steps steps-theme-primary stp-two">
            <form method="post" id="smart-form" action="<?php echo base_url ('PM/submit'); ?>">
            	<!-- hidden field for the current User ID -->
            	<input type="hidden" name="ID" value="<?php echo $currentUserID; ?>">
            	<!-- hidden field for CSRF security token -->
            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <h2>Start</h2>
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
	                    	<p><b>How old are you?</b></p>
	                    	<div class="colm colm6">
		                        <label class="field">
		                            <input type="number" min="1" max="150" name="personalAge" id="personalAge" class="gui-input" placeholder="">
		                        </label>
	                        </div>
	                    </div><!-- end section -->
	                </div><!-- end .frm-row section -->
                </fieldset>
               
                <h2>Location</h2>
                <fieldset>
	    			<div class="frm-row">
	    				<div class="section colm colm12">
		    				<p><b>Click the pin to automatically find your location or enter your address.</b></p>
	                        <div class="smart-widget sm-right smr-50">
                            <label class="field">
                                <input type="text" name="personalLocation" id="personalLocation" class="gui-input" placeholder="Address">
                            </label>
                            <button type="button" id="getLocation" class="button"> <i class="fa fa-map-marker"></i> </button>
                        </div><!-- end .smart-widget section --> 
                    </div><!-- end section -->

	                </div><!-- end .frm-row section -->
                </fieldset>
				<div class="result spacer-b10"></div><!-- end .result  section -->   
            </form>
            <small id="emailHelp" class="form-text text-muted"><i class="fas fa-lock"></i> We will never share your data. <a href="#">Privacy Policy</a></small>
        </div><!-- end .form-body section -->
    
    </div><!-- end .smart-forms section -->
</div><!-- end .smart-wrap section -->


