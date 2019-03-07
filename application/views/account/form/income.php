<script type="text/javascript" src="<?php echo base_url();?>scripts/libraries/smartForms/jquery-cloneya.min.js"></script>
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

    $('#clone-fields').cloneya();
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
                <h2>Income</h2>
                <fieldset>
                	<p><b>Give your income a description and how much income you make from it weekly.</b></p>
	    			<div id="clone-fields">
                        <div class="toclone clone-widget">
	                        <div class="frm-row">
			                    <div class="spacer-b10 colm colm6">
		                            <input type="text" name="personalIncomeName[]" id="personalIncomeName" class="gui-input" placeholder="Full Time Job, Uber Driver, Rental Property, etc.">
		                        </div>
		                        <div class="spacer-b10 colm colm6">
		                            <label class="prepend-icon">
		                                <input type="number" name="personalIncomeAmount[]" id="personalIncomeAmount" class="gui-input" placeholder="500">
		                                <span class="field-icon"><i class="fas fa-dollar-sign"></i></span> 
		                            </label>
		                        </div>
	                        </div><!-- end .frm-row section -->
			                <a href="#" class="clone button btn-primary"><i class="fa fa-plus"></i></a>
		                    <a href="#" class="delete button"><i class="fa fa-minus"></i></a>
	                    </div>
	                </div>
	                
                </fieldset>
                <h2>Second</h2>
                <fieldset>
	    			<p>Nothing yet but wanted to preserve the step functionality.</p>	                
                </fieldset>

				<div class="result spacer-b10"></div><!-- end .result  section -->   
            </form>
            <small id="emailHelp" class="form-text text-muted"><i class="fas fa-lock"></i> We will never share your data. <a href="#">Privacy Policy</a></small>
        </div><!-- end .form-body section -->
    
    </div><!-- end .smart-forms section -->
</div><!-- end .smart-wrap section -->


