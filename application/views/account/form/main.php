<!doctype html>
<html>
	<head>
		<?php
		$currentUserID = $this->user->info->ID;
		$CI_vars = $this->_ci_cached_vars;
		if (!empty($CI_vars['varchar'])) {
			foreach ($CI_vars['varchar'] as $record) {
				if ($record['attribute_id'] == 1) {
					//need to get whatever the last question was out of DB
					$lastStepCompleted = $record['value'];

				}
			}
		}
		
		?>

		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/smartforms/jquery.formShowHide.min.js"></script>
		<!-- cleave is for imput masking -->
		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/cleave/cleave.min.js"></script>
		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/smartforms/jquery.maskedinput.js"></script>
		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/smartforms/jquery-cloneya.min.js"></script>
		<!-- touchpunch necessary for mobile tap to slide sliders - thanks chris! -->
		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/jquery.touchpunch/touchpunch.min.js"></script>

		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/jquery.wizard/jquery.wizard.js"></script>
		<script type="text/javascript">

			//extend jquery validation script to allow commas, if we keep trying to use commas
			$.validator.methods.range = function (value, element, param) {
			    var globalizedValue = value.replace(",", ".");
			    return this.optional(element) || (globalizedValue >= param[0] && globalizedValue <= param[1]);
			}
			 
			$.validator.methods.number = function (value, element) {
			    return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:[\s\.,]\d{3})+)(?:[\.,]\d+)?$/.test(value);
			}

			jQuery(function($) {
				//define form name for validation
				var form = $("#mainForm");
				var formDiv = ("#main");

				var writeMode = true;
				var formdata = '';

				//to make the form a little more pretty, it is hidden by default and below shows it again on page load
				$(formDiv).show();

				//add in the progress bar to the top of the form container
				$(form).prepend('<div class="progress" style="height: 3px;"><div id="form-progress" class="progress-bar bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div>');
				$('#form-progress').css('width', '0%');


				//jquery validate has to be attached to a form tag, not a div
				$(form).validate({
					errorClass: "state-error text-center m-t-10",
					validClass: "state-success",
					errorElement: "p",
					onkeyup: false,
					onclick: false,
			        rules: {
			        	name: {
			        		required: true
			        	},
			        	debts: {
			            	required: true
			            },
			            annualIncome: {
			            	required: true,
			            	pattern: /^[0-9,]+$/,
			            	minlength: 4
			            }
			        },
			        messages: {
			        	name: {
			        		required: 'YO GIRL WHATS YA NAME?'
			        	},
			        	debts: {
			        		required: 'Please indicate if you have any debts'
			        	},
				        annualIncome: {
				        	minlength: 'You make $0 a year?'
				        }
			        },
			        highlight: function(element, errorClass, validClass) {
			            $(element).closest('.field').addClass(errorClass).removeClass(validClass);
			        },
			        unhighlight: function(element, errorClass, validClass) {
			            $(element).closest('.field').removeClass(errorClass).addClass(validClass);
			        },
			        errorPlacement: function(error, element) 
			        {
		        		console.log('inserting error');
			            if ( element.is(":radio") ||  element.is(":checkbox")) 
			            {
			                error.appendTo( element.parents('.card-body') );
			            }
			            else 
			            { // This is the default behavior 
			                //error.insertAfter( element );
			                error.appendTo( element.parents('.card-body') );
			            }
			        }
			    });

				//step counter to allow user to pick up where they left off, with a little bit of null handling so JS doesnt get pissy
				
				var lastStepCompleted = "<?php if (!empty($lastStepCompleted)) {echo $lastStepCompleted;} else {echo '';} ?>";
				console.log(lastStepCompleted);
				//start the wizard
				$(formDiv).wizard({
					stepClasses: {
						current: "current",
						exclude: "exclude",
						stop: "stop",
						submit: "submit",
						unidirectional: "unidirectional"
					},
					transitions: {
						//hardcoded logic branch for goal
						children: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=children]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						debts: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=debts]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						debtsYes: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=debtsYes]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						debtsHighInterest: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=debtsHighInterest]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						mortgage: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=mortgage]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						mortgageNo: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=mortgageNo]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						rent: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=rent]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						rentYes: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=rentYes]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
						retirementMatch: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=retirementMatch]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						},
					},
					beforeSelect: function( event, state ) {
						//logic for use of enter key to move to next step
		   				$(document).keyup(function (e) {
			   				if (e.keyCode == 13) {
			   					//the two little bits at the end are to stop trigger from firing twice, ala stackoverflow
					            $('#bottomForward').trigger('click').stopPropagation().preventDefault();
					            return false; 
					        }
					    });
						//check if we are on the last step, if so change some elements up to show a the big finale
		   				if (state.isLastStep == false) {
		   					$('#bottomForward, #bottomBackward').show();
		   				}
		   				
					},
					beforeForward: function( event, state ) {
						//check if the button pressed to advance was a id=skip, otherwise validate according to rules
						if (typeof(event['currentTarget']) != "undefined" && event['currentTarget'] !== null) {
							if (event['currentTarget']['id'] !== 'skip') {
								form.validate().settings.ignore = ":disabled,:hidden";
	        					return form.valid();
							}
						}

					},
					afterSelect: function( event, state ) {
						//advance progress bar
						$('#numAnswered').html(state.stepsComplete);
						$('#numTotal').html(state.stepsPossible);
		   				$('#form-progress').css('width', (state.percentComplete)+'%');
		   				//reset forward button color
		   				$('#bottomForward').addClass('btn-primary').removeClass('btn-success');

		   				//get name from current step and set hidden form field value, for the pickup function
		   				$('#mainCurrentStep').val(state.step.find("input").attr("name"));

		   				//if we are on the last step, hide the buttons so wecan have a custom submit
		   				if (state.isLastStep == true) {
		   					$('#bottomForward, #bottomBackward').hide();
		   				}
		   				if (state.isLastStep == true) {
		   					nextMsg();
		   				}

		   				//testing wizard history
		   				console.log(state);

		   				//check if anything in the form has been updated since last afterSelect call
			            if (formdata !== $(form).serialize()) {
			            	formdata = $(form).serialize();
			            	//if writemode is on, ajax post the data to handler
			            	if (writeMode == true) {
			            		//$('#errorRpt').append("<p class='alert alert-info'>Send: " + formdata + "</p>");
				            	$.ajax({
								    data: formdata,
								    type: "post",
								    url: "<?php echo base_url ('Account/submit'); ?>",
									error: function (XMLHttpRequest, textStatus, errorThrown) {
						                $('#errorRpt').append("<p class='alert alert-danger'>Status: " + textStatus + "</p>");
						                $('#errorRpt').append("<p class='alert alert-danger'>Error: " + XMLHttpRequest.responseText + "</p>");
						            },
								    success: function(data){
								        //$('#errorRpt').append("<p class='alert alert-success'>Return: " + JSON.stringify(data) + "</p>");
								    }
								});
							}
			            }

					}
				});
				//initialize the slider
				$("#incomeSlider").slider({
                    min: 0,
                    max: 100000,
                    step: 1000,
                    range: "min",
                    slide: function(event, ui) {
                    	//change the next button color if there is any interaction with the slider
                    	$('#bottomForward').removeClass('btn-primary').addClass('btn-success');  
                    	//run function to add commas to thousands/millions
                        //$("#annualIncome").val(addCommas(ui.value));
                        $("#annualIncome").attr('value', ui.value).val(ui.value);
                    }
                });
				//hide the buttons at the beginning so that we can have a custom button on opening step
                if (lastStepCompleted.length !== 0) {
	                $('#bottomForward, #bottomBackward').hide();
	            }
                //initialize the clone fields
                $('#debt-clone-fields').cloneya();

                //setup the showHide for the country selector as well as disable fields which are not displayed
            	$('.smartfm-ctrl').change(function(){
            		$('.hiddenbox').hide();
            		$('.hiddenbox :input').attr('disabled','disabled');
    				$('#' + $(this).val()).show();
    				$('#' + $(this).val() + " :input").removeAttr('disabled');
            	});

                //set the textbox attached to the slider, value equal to default slider value
                $("#annualIncome").val($("#incomeSlider").slider("value"));
                $("#annualIncome").blur(function() {
                    $("#incomeSlider").slider("value", $(this).val());
                });

                //change the button color once there is some amount of form interaction, look to the afterselect function for the revert counterpart
                $('input').on('input', function() {
			        $('#bottomForward').removeClass('btn-primary').addClass('btn-success'); 
				});

                //routine for the final step to cycle through some messages
			    function nextMsg() {
			    	// list of messages to display
		            
	                if (msgs.length == 0) {
	                    // once there is no more message, show final submit button
	                    $('#msg').hide();
	                    $('#finalmsg').show();
	                } 
	                else {
	                    // change content of msg, fade in, wait, fade out and continue with next msg
	                    $('#msg').html(msgs.pop()).fadeIn(500).delay(1000).fadeOut(500, nextMsg);
	                }
            	};
            	//messages to show on final step, must be outside of the function
            	var msgs = [
	                "Calculating dollars",
	                "Running debt models",
	                "Predicting retirement hobbies",
	            ].reverse();

	            //find the field that we left off on, pulled in from DB in variable $lastStepCompleted
	            //if statement checks if something was stored in the DB
	            if (lastStepCompleted.length !== 0) {
	            	var select = $(formDiv).wizard("form").find("[name="+lastStepCompleted+"]").closest(".step");
	            }
	            //fire when user clicks the button
	            $('#pickup').click( function(){
	            	//find how many steps it takes to get back to where they were
					selectStepCount = $(formDiv).wizard("stepIndex", select);
					//step foward the number of steps, subtracting one to get exactly where they left off
					/*console.log(selectStepCount);
					$(formDiv).wizard("forward", selectStepCount-1);*/
					$(formDiv).wizard("select", select);
	            });

			});
		</script>
		<style>
		#finalmsg {display: none;}​
		.state-error {
			color: red;
		}
		.card, .card:hover {
			/* overriding default atmos card styles, aka the giant shadow. this should be written into the css at some point */
			box-shadow: none;
		}
		.btn {
			box-shadow: none;
		}
		.navigation {
			background-color: #4c66fb;
			border-radius: 0 0 3px 3px;
		}
		.navigation button {
			padding: 10px 40px;
		}
		.card-header label {
			font-size: 24px !important;
		}
		.option-box {
			width: 49%;
		}
		.option-box-grid {
			width: 100%;
		}
		.option-box-grid label {
			min-height: 150px;
		}
		.card-body label {
			font-size: 16px !important;
			padding-bottom: 5px;
			width: 100%;
		}
		.card-line {
			width: 35px;
			border: 1px solid grey;
		}
		#main {display: none;}
		.hiddenbox {display: none;}
		.ui-slider-range {
			background-color: #4c66fb;
		}
		.moji {
		  font-size: 60px;
		  text-align: center;
		}
		@media only screen and (max-width: 600px) {
			.option-box {
				width: 100%;
			}
			.card-body label {
				width: 100%;
				padding-left: 25px;
			}
		}
		</style>
<?php
function writePickup () {
	echo '<div class="step exclude"><div class="section"><div class="card-header m-b-0">';
		echo '<label for="pickup">Pick up where you left off</label>';
				echo '<p>We saved your progress</p>';
				echo '<hr class="card-line" align="left">';
		echo '</div><div class="card-body m-b-30">';
				echo '<button type="button" id="pickup" name="forward" class="forward btn btn-primary">Get back in there</button>';
	echo '</div></div></div>';
}
//branchExit is only used to put an alternative step class on which includes a data-state
function writeTextQuestion ($id, $name, $label, $message, $placeholder, $branchExit) {
	if (!empty($branchExit)) {
		echo '<div class="step" data-state="'.$branchExit.'">';
	}
	else {
		echo '<div class="step" id="'.$id.'">';
	}
	echo '<div class="section"><div class="card-header m-b-0">
			<label for="'.$id.'">'.$label.'</label>
				<p>'.$message.'</p>
				<hr class="card-line" align="left">
		</div><div class="card-body m-b-30">
				<input type="text" name="'.$name.'" id="input'.$id.'" class="form-control" placeholder="'.$placeholder.'">
	</div></div></div>';
}
//branchExit is only used to put an alternative step class on which includes a data-state
function writeDollarQuestion ($id, $name, $label, $message, $placeholder, $branchExit) {
	if (!empty($branchExit)) {
		echo '<div class="step" data-state="'.$branchExit.'">';
	}
	else {
		echo '<div class="step" id="'.$id.'">';
	}
	echo '<div class="section"><div class="card-header m-b-0">
			<label for="'.$id.'">'.$label.'</label>
				<p>'.$message.'</p>
				<hr class="card-line" align="left">
		</div><div class="card-body m-b-30">
				<input type="tel" name="'.$name.'" id="input'.$id.'" class="form-control" placeholder="'.$placeholder.'">
	</div></div></div>';
	echo '<script>
		var cleave'.$id.' = new Cleave("#input'.$id.'", {
	    prefix: "$",
	    numeral: true,
    	numeralThousandsGroupStyle: "thousand"
		});
	</script>';
}
//branchExit is only used to put an alternative step class on which includes a data-state
function writeDateQuestion ($id, $name, $label, $message, $placeholder, $branchExit) {
	if (!empty($branchExit)) {
		echo '<div class="step" data-state="'.$branchExit.'">';
	}
	else {
		echo '<div class="step" id="'.$id.'">';
	}
	echo '<div class="section"><div class="card-header m-b-0">
			<label for="'.$id.'">'.$label.'</label>';
			if (!empty($message)) {
				echo '<p>'.$message.'</p>';
			}
				echo '<hr class="card-line" align="left">
		</div><div class="card-body m-b-30">
				<input type="text" name="'.$name.'" id="input'.$id.'" class="form-control" placeholder="'.$placeholder.'">
	</div></div></div>';
	echo '<script>
		var cleave'.$id.' = new Cleave("#input'.$id.'", {
	    date: true,
    	delimiter: "/",
    	datePattern: ["m", "d", "Y"]
		});
	</script>';
}
function writeRadioQuestion ($id, $options, $label, $message, $branch) {
	if ($branch == true) {
		echo '<div class="step" data-state="'.$id.'">';
	}
	else {
		echo '<div class="step" id="'.$id.'">';
	}
	echo '<div class="section">
			<div class="card-header m-b-0">
				<label>'.$label.'</label>';
				if (!empty($message)) {
					echo '<p>'.$message.'</p>';
				}
				echo '<hr class="card-line" align="left">
			</div>
			<div class="card-body m-b-30">';
			foreach ($options as $option) {
				echo '<div class="option-box p-r-10">
                    <input id="'.$option['name'].'" name="'.$id.'" value="'.$option['label'].'" type="radio">
                    <label for="'.$option['name'].'">
                    	<span class="radio-content"><p>'.$option['label'].'</p></span>
                	</label>
                </div>';
			}
                
            echo '</div>
		</div>
	</div>';
}

/**
 * Writes a boolean question.
 * dont forget to hard code into the javascript for the branch step
 * @param      string          $id          only needed if this is a regular step, meaning that $branchName is false
 * @param      string          $name        name for the form field and DB submit
 * @param      string          $label       The label
 * @param      string          $message     The text under the label
 * @param      boolean|string  $branchName  The branch name, must be repeated in the JS
 * @param      string          $gotoYes     where to send the wizard to next if yes is answered
 * @param      string          $gotoNo      where to send the wizard to next if no is answered
 */
function writeBooleanQuestion ($id, $name, $label, $message, $branchName, $gotoYes, $gotoNo) {
	global $boolID;
	$boolID++;
	//if both are filled in then this is an offshoot of a branch and is also the beginning of another branch
	if (!empty($branchName) && !empty($id)) {
		echo '<div class="step" id="'.$id.'" data-state="'.$branchName.'">';
	}
	//this is part of a branch
	else if (!empty($branchName)) {
		echo '<div class="step" data-state="'.$branchName.'">';
	}
	//this means it is just a regular one off step
	else {
		echo '<div class="step" id="'.$id.'">';
	}
	echo '<div class="section">
			<div class="card-header m-b-0">
				<label for="bool-'.$boolID.'">'.$label.'</label>';
				if (!empty($message)) {
					echo '<p>'.$message.'</p>';
				}
				echo '<hr class="card-line" align="left">
			</div>
			<div class="card-body m-b-30">
                <div class="option-box p-r-10">
                    <input id="bool-'.$boolID.'" data-goto="'.$gotoYes.'" name="'.$name.'" value="yes" type="radio">
                    <label for="bool-'.$boolID.'">
                    	<span class="radio-content"><p>Yes</p></span>
                	</label>
                </div>
                <div class="option-box">
                    <input id="bool-'.$boolID.'No" data-goto="'.$gotoNo.'" name="'.$name.'" value="no" type="radio">
                    <label for="bool-'.$boolID.'No">
                    	<span class="radio-content"><p>No</p></span>
                    </label>
                </div>
            </div>
		</div>
	</div>';
}

//branchValue is always either Yes or No for the boolean functions
//exitTo is the id of the question that should appear after completing the current sub branch
function writeBranchSubQuestion_Text ($branchValue, $id, $name, $label, $message, $placeholder, $exitTo) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeTextQuestion ($id, $name, $label, $message, $placeholder, $exitTo);
	echo '</div>';
}
function writeBranchSubQuestion_Boolean ($branchValue, $nestedBranchName, $id, $name, $label, $message, $branchName, $gotoYes, $gotoNo) {
	if (!empty($nestedBranchName)) {
		echo '<div class="branch" id="'.$branchValue.'" data-state="'.$nestedBranchName.'">';
			writeBooleanQuestion ($id, $name, $label, $message, $branchName, $gotoYes, $gotoNo);
		echo '</div>';
	}
	else {
		echo '<div class="branch" id="'.$branchValue.'">';
			writeBooleanQuestion ($id, $name, $label, $message, $branchName, $gotoYes, $gotoNo);
		echo '</div>';
	}
}
function writeBranchSubQuestion_Dollar ($branchValue, $id, $name, $label, $message, $placeholder, $exitTo) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeDollarQuestion ($id, $name, $label, $message, $placeholder, $exitTo);
	echo '</div>';
}
function writeBranchSubQuestion_Radio ($branchValue, $id, $options, $label, $message, $branch) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeRadioQuestion ($id, $options, $label, $message, $branch);
	echo '</div>';
}

?>
	</head>
	<body>
		<div id="main" class="container">
			<pre id="errorRpt"></pre>
			<div class="row m-h-50 align-items-center justify-content-center">
				<div class="col-lg-6 col-md-10 p-t-30">
					<div class="card">
						<form name="mainForm" id="mainForm" method="post" action="<?php echo base_url ('Account/submit'); ?>">
							<!-- hidden field for the current User ID -->
			            	<input type="hidden" name="ID" value="<?php echo $currentUserID; ?>">
			            	<!-- hidden field for CSRF security token -->
			            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
			            	<!-- hidden field for form name -->
							<input type="hidden" name="formName" value="main">
							<!-- hidden field for current step in main form -->
							<input type="hidden" id="mainCurrentStep" name="mainCurrentStep" value="">

							<!-- STEPS START HERE -->

							<?php
							if (!empty($lastStepCompleted)) {
								writePickup();
							}

							//$id, $name, $label, $message, $placeholder
							writeTextQuestion('location', 'location', 'What is your address?', 'We will use this to compare your financial profile to others in your area', 'Street Address','');
							writeDateQuestion('dob', 'dob', 'What is your date of birth?', 'We will use this to help you plan for the future', 'MM/DD/YYYY','');
							$statusRadio = array(
								array(
									'name' => 'single',
									'label' => 'Single'
								),
								array(
									'name' => 'married',
									'label' => 'Married'
								)
							);
							writeRadioQuestion ('status', $statusRadio, 'What is your relationship status?', '', false);
							//$id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
							writeBooleanQuestion ('','children','Do you have any children?','', 'children', 'childrenYes', 'income');
								writeBranchSubQuestion_Text ('childrenYes', 'childrenYes', 'childrenAge', 'What are their ages?', 'This will help us account for them in your financial plan', 'Please enter an age', 'income');
							writeDollarQuestion('income', 'income', 'What is your annual household income before taxes?', '', 'anything','');
							writeDollarQuestion('healthInsurance', 'healthInsurance', 'How much are you paying for health insurance per month?', '', 'anything','');

							//$id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
							writeBooleanQuestion ('','debts','Do you have any debts?','Other than a mortgage on your home', 'debts', 'debtsYes', 'cashOnHand');
								//$branchValue, $nestedBranchName, $id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
								writeBranchSubQuestion_Boolean ('debtsYes', 'debtsHighInterest', '', 'debtsHighInterest', 'Does any of this debt have an interest rate over 10%?', '', 'debtsHighInterest', 'debtsHighInterestList', 'debtsModerateInterestList');
									//$branchValue, $id, $name, $label, $message, $placeholder, $exitTo
									writeBranchSubQuestion_Text ('debtsHighInterestList', 'debtsHighInterestList', 'debtsHighInterest1', 'List you debts over 10% interest.', 'need to build in clone fields', 'descrip / int rate / amount', 'debtsModerateInterestList');
									writeBranchSubQuestion_Text ('debtsModerateInterestList', 'debtsModerateInterestList', 'debtsModerateInterest1', 'List you debts under 10% interest.', 'need to build in clone fields', 'descrip / int rate / amount', 'cashOnHand');		

							writeDollarQuestion('cashOnHand', 'cashOnHand', 'How much do you have saved total in a checking or savings accounts?', "You can also include cash on hand. Please don't include investment accounts or any money that isn't easily accessible.", '','');

							//$id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
							writeBooleanQuestion ('','mortgage','Do you have a mortgage on your home?','', 'mortgage', 'mortgageYes', 'mortgageNo');

								//$branchValue, $id, $name, $label, $message, $placeholder, $branchExit
								//@todo mortgage balance not progressing
								writeBranchSubQuestion_Dollar('mortgageYes', 'mortgageBalance', 'mortgageBalance', 'What is the remaining balance on your mortgage?', '', '', 'retirementMatch');
								//$branchValue, $nestedBranchName, $id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
								writeBranchSubQuestion_Boolean ('mortgageNo', 'rent', '', 'rent', 'Do you pay rent for your housing?', '', 'rent', 'rentYes', 'retirementMatch');
									writeBranchSubQuestion_Dollar('rentYes', 'rentAmount', 'rentAmount', 'How much do you pay per month for rent?', '', '', 'retirementMatch');

							//$id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
							writeBooleanQuestion ('retirementMatch','retirementMatch','Do your employer offer a retirement match?', '', 'retirementMatch', 'retirementMatchYes', 'last');
								
								$contributionRadio = array(
									array(
										'name' => 'noContribution',
										'label' => 'I dont contribute at all'
									),
									array(
										'name' => 'contributionMatch',
										'label' => 'I contribute up to the employer match'
									),
									array(
										'name' => 'contributionAbove',
										'label' => 'I contribute above the employer match'
									),
									array(
										'name' => 'contributionUnknown',
										'label' => 'I dont know'
									),
								);
								
								//$branchValue, $id, $options, $label, $message, $branch
								//@todo retirement match yes not progressing
								writeBranchSubQuestion_Radio ('retirementMatchYes','retirementMatchContribution', $contributionRadio, 'Are you contributing to this retirement account?', '', 'last');

								writeTextQuestion('last', 'last', 'last question before end', 'filler to point form to while working', 'anything','');
							?>

							<!-- STEPS END HERE -->

							<div class="submit step" id="end">
								<div class="section">
									<div class="card-header m-b-0" id="submitHeader">
										<p id="msg"></p>
									</div>
									<div class="card-body m-b-30">
										<div id="finalmsg">
											<label>You made it to the end!</label>
											<button type="button" name="backward" class="backward btn btn-dark">Need to change some answers?</button>
											<br/><br/>
											<button type="submit" name="submit" class="submit btn btn-success btn-lg btn-block">Submit <i class="fas fa-check"></i></button>
										</div>
									</div>
								</div>
							</div>

							<div class="navigation">
								<div class="">
									<button type="button" id="bottomBackward" name="backward" class="backward btn btn-primary"><i class="fas fa-arrow-left"></i></button>
									<button type="button" id="bottomForward" name="forward" class="forward float-right btn btn-primary"><i class="fas fa-arrow-right"></i></button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>