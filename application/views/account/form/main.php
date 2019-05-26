<!doctype html>
<html>
	<head>
		<?php
		$currentUserID = $this->user->info->ID;
		$CI_vars = $this->_ci_cached_vars;
		global $varchars;
		global $datetimes;
		global $decimals;
		if (!empty($CI_vars['datetime'])) {
			foreach ($CI_vars['datetime'] as $key => $value) {
				$datetimes[$CI_vars['translation'][$value['attribute_id']]] = $value['value'];
			}
		}
		if (!empty($CI_vars['varchar'])) {
			foreach ($CI_vars['varchar'] as $key => $value) {
				$varchars[$CI_vars['translation'][$value['attribute_id']]] = $value['value'];
			}
		}
		if (!empty($CI_vars['decimal'])) {
			foreach ($CI_vars['decimal'] as $key => $value) {
				$decimals[$CI_vars['translation'][$value['attribute_id']]] = $value['value'];
			}
		}
		$lastStepCompleted = str_replace('[]', '', $varchars['mainCurrentStep']);
		var_dump($lastStepCompleted);
		echo '<div class="row"><div class="col-md-4"><h3>varchars</h3><pre>';
			var_dump($varchars);
			//var_dump($transDB);
		echo '</pre></div>';
		echo '<div class="col-md-4"><h3>datetimes</h3><pre>';
			var_dump($datetimes);
			//var_dump($transDB);
		echo '</pre></div>';
		echo '<div class="col-md-4"><h3>decimals</h3><pre>';
			var_dump($decimals);
			//var_dump($transDB);
		echo '</pre></div></div>';
		?>

		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/smartforms/jquery.formShowHide.min.js"></script>
		<!-- cleave is for imput masking -->
		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/cleave/cleave.min.js"></script>
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
			            if (element.is(":radio") ||  element.is(":checkbox")) {
			                error.appendTo( element.parents('.card-body') );
			            }
			            else { 
			            	// This is the default behavior 
			                //error.insertAfter( element );
			                error.appendTo( element.parents('.card-body') );
			            }
			        }
			    });

				//step counter to allow user to pick up where they left off, with a little bit of null handling so JS doesnt get pissy
				
				var lastStepCompleted = "<?php if (!empty($lastStepCompleted)) {echo $lastStepCompleted;} else {echo '';} ?>";
				//console.log(lastStepCompleted);
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
						childrenYes: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=childrenYes]:checked" ).attr('data-goto');
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
						housing: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=housing]:checked" ).attr('data-goto');
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
        						if( form.valid() == true ){
        							var branch = 'retirementMatch';
        						}
							}
							return branch;
						},
						upcomingExpense: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=upcomingExpense]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						if( form.valid() == true ){
        							var branch = 'upcomingExpense';
        						}
							}
							return branch;
						},
						foodExpense: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=foodExpense]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						if( form.valid() == true ){
        							var branch = 'foodExpense';
        						}
							}
							return branch;
						},
						car: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=car]:checked" ).attr('data-goto');
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						if( form.valid() == true ){
        							var branch = 'car';
        						}
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
						//console.log(state);
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
		   				//console.log(state);

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
				//hide the buttons at the beginning so that we can have a custom button on opening step
                if (lastStepCompleted.length !== 0) {
	                $('#bottomForward, #bottomBackward').hide();
	            }

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
                	//for radio questions (which includes boolean), when the user clicks on an option, just go to the next step by clicking the forward button for them
                	if ($(this).attr('type') == 'radio') {
						$('#bottomForward').trigger('click');
						return false;
                	}
                	
                	
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
	            	//if nothing was found to match on the name field in the input, then look for it under an ID since I used them somewhat interchanably depending on how the input needed to be created. This is particularly relevant on anything that submits as an array, for example clone or checkbox inputs.
	            	if (select.length == 0) {
	            		select = $(formDiv).wizard("form").find("[id="+lastStepCompleted+"]").closest(".step");
	            	}
	            }
	            //fire when user clicks the button
	            $('#pickup').click( function(){
	            	//old way -
		            	//find how many steps it takes to get back to where they were
						//selectStepCount = $(formDiv).wizard("stepIndex", select);
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
		.clone-block {
			position: relative;
			padding-right: 90px;
		}
		a.delete {
			position: absolute;
			top: 0;
			right: 0;
		}
		a.clone {
			position: absolute;
			top: 0;
			right: 45px;
		}
		.bg-custom {
			background-color: powderblue;
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
function writeMidResults ($id, $label, $message) {

	echo '<div class="step" id="'.$id.'">
			<div class="section text-center bg-custom"><div class="card-header p-t-20 p-b-0 bg-custom">
			<label for="'.$id.'">'.$label.'</label>
		</div><div class="card-body p-t-0 p-b-30 bg-custom">
				<p>'.$message.'</p>
	</div></div></div>';
}
//branchExit is only used to put an alternative step class on which includes a data-state, only use this if the step is in a branch
function writeTextQuestion ($id, $name, $label, $message, $placeholder, $branchExit, $additionalClass) {
	global $varchars;
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
		</div><div class="card-body m-b-30">';
		$inputClass = 'form-control';
		if (!empty($additionalClass)) {
			$inputClass = 'form-control '. $additionalClass;
		}
				echo '<input type="text" name="'.$name.'" id="input'.$id.'" class="'.$inputClass.'" placeholder="'.$placeholder.'" ';
				if (isset($varchars[$id])) {
                	echo 'value="'.$varchars[$id].'">';
                }
                else {
                	echo '>';
                }
	echo '</div></div></div>';
}
//branchExit is only used to put an alternative step class on which includes a data-state, only use this if the step is in a branch
function writeDollarQuestion ($id, $name, $label, $message, $placeholder, $branchExit, $additionalClass, $sliderOptions) {
	global $decimals;
	if (!empty($branchExit)) {
		echo '<div class="step" data-state="'.$branchExit.'">';
	}
	else {
		echo '<div class="step" id="'.$id.'">';
	}
	$inputClass = '';
	if (!empty($additionalClass)) {
		$inputClass .= ' '. $additionalClass;
	}
	echo '<div class="section"><div class="card-header m-b-0">
			<label for="'.$id.'">'.$label.'</label>
				<p>'.$message.'</p>
				<hr class="card-line" align="left">
		</div>
		<div class="card-body m-b-30">
			<div class="input-group '.$inputClass.'">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
				</div>
		';
			echo '<input type="tel" name="'.$name.'" id="input'.$id.'" class="form-control" placeholder="'.$placeholder.'" data-goto="'.$branchExit.'"';
			if (isset($decimals[$id])) {
            	echo 'value="'.$decimals[$id].'">';
            }
            else {
            	echo '>';
            }
        //initialize the slider
		echo '</div><br><div id="'.$id.'Slider"></div>';
				
	echo '</div></div></div>';
	echo '<script>
		var cleave'.$id.' = new Cleave("#input'.$id.'", {
	    numeral: true,
    	numeralThousandsGroupStyle: "thousand"
		});

		$("#'.$id.'Slider").slider({';
		if (isset($decimals[$id])) {
			echo 'value: '.$decimals[$id].',';
		}
		elseif (isset($sliderOptions['value'])) {
			echo 'value: '.$sliderOptions['value'].',';
		}
		if (isset($sliderOptions['min'])) {
			echo 'min: '.$sliderOptions['min'].',';
		}
		if (isset($sliderOptions['max'])) {
			echo 'max: '.$sliderOptions['max'].',';
		}
		if (isset($sliderOptions['step'])) {
			echo 'step: '.$sliderOptions['step'].',';
		}
	        echo 'range: "min",
	        slide: function(event, ui) {
	        	//change the next button color if there is any interaction with the slider
	        	$("#bottomForward").removeClass("btn-primary").addClass("btn-success");
	        	$("#input'.$id.'").attr("value", ui.value).val(ui.value);
	        }
	    });
	    //set the textbox attached to the slider, value equal to default slider value
        $("#input'.$id.'").val($("#'.$id.'Slider").slider("value"));
        $("#input'.$id.'").blur(function() {
            $("#'.$id.'Slider").slider("value", $(this).val());
        });
	</script>';
}
//branchExit is only used to put an alternative step class on which includes a data-state
function writeDateQuestion ($id, $name, $label, $message, $placeholder, $branchExit) {
	global $datetimes;
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
				<input type="tel" name="'.$name.'" id="input'.$id.'" class="form-control" placeholder="'.$placeholder.'" ';
				if (isset($datetimes[$id])) {
                	echo 'value="'.date('m/d/Y', strtotime($datetimes[$id])).'">';
                }
                else {
                	echo '>';
                }
	echo '</div></div></div>';
	echo '<script>
		var cleave'.$id.' = new Cleave("#input'.$id.'", {
	    date: true,
    	delimiter: "/",
    	datePattern: ["m", "d", "Y"]
		});
	</script>';
}
function writeRadioQuestion ($id, $options, $label, $message, $branchName) {
	global $varchars;
	global $radioID;
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
				<label>'.$label.'</label>';
				if (!empty($message)) {
					echo '<p>'.$message.'</p>';
				}
				echo '<hr class="card-line" align="left">
			</div>
			<div class="card-body m-b-30">';
			foreach ($options as $option) {
				$radioID++;
				echo '<div class="option-box p-r-10">
                    <input id="'.$radioID.'" name="'.$id.'" value="'.$option['name'].'" ';
                    //check if there is a stored value in the DB for the question and if so, pre-check the radio selector for that option
                    if (isset($varchars[$id]) && $varchars[$id] == $option['name']) {
                    	echo 'checked ';
                    }
                    if (isset($option['data-goto'])) {
                    	echo 'data-goto="'.$option['data-goto'].'" type="radio">';
                    }
                    else {
                    	echo 'type="radio">';
                    }
                    
                    echo '<label for="'.$radioID.'">
                    	<span class="radio-content"><p>'.$option['label'].'</p></span>
                	</label>
                </div>';
			}
                
            echo '</div>
		</div>
	</div>';
}
function writeSelectQuestion ($id, $options, $label, $message, $branchName) {
	global $varchars;
	global $selectID;
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
				<label>'.$label.'</label>';
				if (!empty($message)) {
					echo '<p>'.$message.'</p>';
				}
				echo '<hr class="card-line" align="left">
			</div>
			<div class="card-body m-b-30">';
			foreach ($options as $option) {
				$selectID++;
				echo '<div class="option-box p-r-10">
                    <input id="'.$option['name'].'Checkbox'.$selectID.'" name="'.$id.'[]" value="'.$option['name'].'" ';

                    $selectExp = explode(',', $varchars[$id]);
                    foreach ($selectExp as $v) {
                    	//check if there is a stored value in the DB for the question and if so, pre-check the selector for that option
                		if ($v == $option['name']) {
                    		echo 'checked ';
                    	}
                    }
                    if (isset($option['data-goto'])) {
                    	echo 'data-goto="'.$option['data-goto'].'" type="checkbox">';
                    }
                    else {
                    	echo 'type="checkbox">';
                    }
                    
                    echo '<label for="'.$option['name'].'Checkbox'.$selectID.'">
                    	<span class="radio-content"><p>'.$option['label'].'</p></span>
                	</label>
                </div>';
			}
                
            echo '</div>
		</div>
	</div>';
}
//branchExit is only used to put an alternative step class on which includes a data-state
//clone button not working? make sure all cloneTargetID variables are different
function writeCloneQuestion ($id, $cloneTargetID, $questions, $label, $message, $branchExit) {
	global $varchars;
	echo '<script>
			jQuery(function($) {
				$("#'.$cloneTargetID.'").cloneya();
			});
			</script>';
	if (!empty($branchExit)) {
		echo '<div class="step" data-state="'.$branchExit.'">';
	}
	else {
		echo '<div class="step" id="'.$id.'">';
	}
	echo '<div class="section">
			<div class="card-header m-b-0">
			<label for="'.$id.'">'.$label.'</label>
				<p>'.$message.'</p>
				<hr class="card-line" align="left">
			</div>
			<div class="card-body m-b-30" id="'.$cloneTargetID.'">';
			echo '<div class="row">';
			//put the labels in their own row, requires a loop through because it needs to both: go outside the clone block and involve the qestion specific classes
			foreach ($questions as $question) {
				echo '<div class="'.$question['class'].'">
						<p><small>'.$question['placeholder'].'</small></p>
					</div>';
				//if there was a previously entered data set for the clone question, try to parse it into a usable format to recreate the number of rows created with the clone input
				if (isset($varchars[$question['name']])) {
					$cloneExp = explode(',', $varchars[$question['name']]);
					$i=0;
					foreach ($cloneExp as $v) {
						$cloneRow[$i][$question['name']] = $v;
						$i++;
					}
				}
				//if the result of this was nothing because there was no data stored previously, just set up an empty array to actually kick the next foreach
				if (empty($cloneRow)) {
					$cloneRow[0] = array('' => '');
				}
			}
			echo '</div>';
			foreach ($cloneRow as $row) {
				echo '<div class="toclone clone-block">
    				<div class="form-row">';
			foreach ($questions as $question) {
				echo '<div class="form-group '.$question['class'].'">';
					if (isset($question['fieldLabel']) && isset($question['icon'])) {
						echo '<div class="input-group mb-3">';
						if ($question['fieldLabel'] == 'input-group-prepend') {
							echo '<div class="'.$question['fieldLabel'].'">
									<span class="input-group-text"><i class="'.$question['icon'].'"></i></span>
								</div>';
						}	 	
					}
    					//holy shit this might be a dumpster - sorry future pete and ben
						//first go through the row for each individual stored value, to be used later 
    					foreach ($row as $rkey => $rvalue) {
    						//start with any questions that are select inputs, they needs special handling to select the appropriate value. also match that the question name is the appropriate loop of the row
    						if ($question['type'] == 'select' && $rkey == $question['name']) {
								echo '<select name="'.$question['name'].'[]" id="'.$question['id'].'" class="form-control">';
								//loop through the available options provided in the question function
								foreach ($question['options'] as $key => $option) {
									//if we find a match between the option and the stored value, write selected to the HTML option
									if ($option == $rvalue) {
										echo '<option value="'.$option.'" selected>'.ucwords(str_replace('_', ' ', $option)).'</option>';
									}
									else {
										echo '<option value="'.$option.'">'.ucwords(str_replace('_', ' ', $option)).'</option>';
									}
								}
								echo '</select>';
							}
							//if this is a normal input, match on the question name and write the input with values
    						else if ($rkey == $question['name']) {
	    						if (isset($rkey) && !empty($rvalue)) {
	    							echo '<input type="'.$question['type'].'" name="'.$question['name'].'[]" id="'.$question['id'].'" class="form-control" value="'.$rvalue.'">';
		    					}
		    					//if the stored values exist, but at empty, dont write values
		    					else {
		    						echo '<input type="'.$question['type'].'" name="'.$question['name'].'[]" id="'.$question['id'].'" class="form-control">';
		    					}
		    				}
    					}
    				if (isset($question['fieldLabel']) && isset($question['icon'])) {
						if ($question['fieldLabel'] == 'input-group-append') {
							echo '<div class="'.$question['fieldLabel'].'">
									<span class="input-group-text"><i class="'.$question['icon'].'"></i></span>
								</div>';
						}
						echo '</div>';//end input group
					}
    				echo '</div>';//end form group
			}
				
				echo '</div>
		          	<a href="#" class="clone btn btn-success"><i class="fa fa-plus"></i></a>
	      			<a href="#" class="delete btn btn-success"><i class="fa fa-minus"></i></a>
	        	</div>';//end clone-block
	        }//end number of rows loop
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
	global $varchars;
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
                    <input id="bool-'.$boolID.'" data-goto="'.$gotoYes.'" name="'.$name.'" value="yes" type="radio" ';
                    if (isset($varchars[$name]) && $varchars[$name] == 'yes') {
                    	echo 'checked >';
                    }
                    else {
                    	echo '>';
                    }
                    echo '<label for="bool-'.$boolID.'">
                    	<span class="radio-content"><p>Yes</p></span>
                	</label>
                </div>
                <div class="option-box">
                    <input id="bool-'.$boolID.'No" data-goto="'.$gotoNo.'" name="'.$name.'" value="no" type="radio" ';
                    if (isset($varchars[$name]) && $varchars[$name] == 'no') {
                    	echo 'checked >';
                    }
                    else {
                    	echo '>';
                    }
                    echo '<label for="bool-'.$boolID.'No">
                    	<span class="radio-content"><p>No</p></span>
                    </label>
                </div>
            </div>
		</div>
	</div>';
}

//branchValue is always either Yes or No for the boolean functions
//exitTo is the id of the question that should appear after completing the current sub branch
function writeBranchSubQuestion_Text ($branchValue, $id, $name, $label, $message, $placeholder, $exitTo, $additionalClass) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeTextQuestion ($id, $name, $label, $message, $placeholder, $exitTo, $additionalClass);
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
function writeBranchSubQuestion_Dollar ($branchValue, $id, $name, $label, $message, $placeholder, $exitTo, $additionalClass, $sliderOptions) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeDollarQuestion ($id, $name, $label, $message, $placeholder, $exitTo, $additionalClass, $sliderOptions);
	echo '</div>';
}
function writeBranchSubQuestion_Radio ($branchValue, $id, $options, $label, $message, $branch) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeRadioQuestion ($id, $options, $label, $message, $branch);
	echo '</div>';
}
function writeBranchSubQuestion_Date ($branchValue, $id, $name, $label, $message, $placeholder, $branchExit) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeDateQuestion ($id, $name, $label, $message, $placeholder, $branchExit);
	echo '</div>';
}
function writeBranchSubQuestion_Clone ($branchValue, $id, $cloneTargetID, $questions, $label, $message, $branchExit) {
	echo '<div class="branch" id="'.$branchValue.'">';
		writeCloneQuestion ($id, $cloneTargetID, $questions, $label, $message, $branchExit);
	echo '</div>';
}


?>
	</head>
	<body>
		<div id="main" class="container">
			<pre id="errorRpt"></pre>
			<div class="row m-h-50 align-items-center justify-content-center">
				<div class="col-lg-10 col-md-10 p-t-30">
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

				writeMidResults ('resultsStart', 'Personal Info', "First, let's ask a couple questions about you.");

							//$id, $name, $label, $message, $placeholder
							writeTextQuestion('location', 'location', 'What is your address?', 'We will use this to compare your financial profile to others in your area', 'Street Address','','');
							writeDateQuestion('dob', 'dob', 'What is your date of birth?', 'We will use this to help you plan for the future', 'MM/DD/YYYY','');
							$genderRadio = array(
								array(
									'name' => 'male',
									'label' => 'Male'
								),
								array(
									'name' => 'female',
									'label' => 'Female'
								),
								array(
									'name' => 'na',
									'label' => 'N/A'
								)
							);
							writeRadioQuestion ('gender', $genderRadio, 'What is your gender?', '', false);
							$educationRadio = array(
								array(
									'name' => 'unfinishedHS',
									'label' => 'Less Than High School'
								),
								array(
									'name' => 'HS',
									'label' => 'High School Diploma or Equivalent'
								),
								array(
									'name' => 'unfinishedCollege',
									'label' => 'Some College, No Degree'
								),
								array(
									'name' => 'associates',
									'label' => "Associate's Degree"
								),
								array(
									'name' => 'bachelors',
									'label' => "Bachelor's Degree"
								),
								array(
									'name' => 'postSecondary',
									'label' => "Post-secondary Non-degree Award"
								),
								array(
									'name' => 'masters',
									'label' => "Master's Degree"
								),
								array(
									'name' => 'doctoral',
									'label' => "Doctoral of Professional Degree"
								)
							);
							writeRadioQuestion ('educationLevel', $educationRadio, 'What is the highest level of education you have completed?', '', false);
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
							writeBooleanQuestion ('','children','Do you have any children under the age of 18?','', 'children', 'childrenYes', 'resultsPersonal');
								//writeBranchSubQuestion_Text ('childrenYes', 'childrenYes', 'childrenAge', 'What are their ages?', 'This will help us account for them in your financial plan', 'Please enter an age', 'childrenEducation','');

								$childrenAges = array (
									array(
										'class' => 'col-md-12',
										'type' => 'tel',
										'name' => 'childrenAge',
										'id' => 'childrenAge',
										'placeholder' => 'Age'
									),
								);
								//$branchValue, $id, $cloneTargetID, $questions, $label, $message, $branchExit
								writeBranchSubQuestion_Clone ('childrenYes', 'childrenYes', 'caClone', $childrenAges, 'What are their ages?', 'Click the + or - buttons for additional children. This will help us account for them in your financial plan', 'childrenEducation');

								$childrenEducationRadio = array(
									array(
										'name' => 'yes',
										'label' => 'Yes'
									),
									array(
										'name' => 'no',
										'label' => 'No'
									)
								);
								writeRadioQuestion ('childrenEducation', $childrenEducationRadio, 'Will they be attending some form of higher education after highschool?', '', false);

				writeMidResults ('resultsPersonal', 'Great! Now, what about your income and savings?', '');
							$defaultSliderOptions = array(
													'min' => 0,
													'max' => 100000,
													'step' => 1000,
													'value' => 0
													);
							$smSliderOptions = array(
													'min' => 0,
													'max' => 5000,
													'step' => 50,
													'value' => 0
													);
							$lgSliderOptions = array(
													'min' => 0,
													'max' => 5000000,
													'step' => 10000,
													'value' => 0
													);
							writeDollarQuestion('income', 'income', 'What is your annual household income before taxes?', '', 'anything','','col-md-6 mx-auto', $defaultSliderOptions);
							writeDollarQuestion('cashOnHand', 'cashOnHand', 'How much do you have saved total in a checking or savings accounts?', "You can also include cash on hand. Please don't include investment accounts or any money that isn't easily accessible.", '','','', $defaultSliderOptions);

				writeMidResults ('resultsIncome', 'Great! Now, On To Your Expenses!', "<b>In our welcome form you told us you average expense are X,XXX - X,XXX per month. We'd like to know a little more abut what's in that number. BTW - It fine to still use approximate numbers, you'll always have a chance to refine later on!  :-)</b>");

							$expensesRadio = array(
								array(
									'name' => 'not',
									'label' => 'I am not able to pay all my expenses'
								),
								array(
									'name' => 'paycheck',
									'label' => 'I pay all my expenses paycheck-to-paycheck'
								),
								array(
									'name' => 'comfortable',
									'label' => 'I am able to pay all my expenses comfortably'
								),
								array(
									'name' => 'saving',
									'label' => 'I am able to pay all my expenses comfortably and save extra money'
								),
							);
							//$id, $options, $label, $message, $branchName
							writeRadioQuestion ('expenses', $expensesRadio, 'What best describes how you are managing your expenses?', '', '');
							$housingRadio = array(
								array(
									'name' => 'rent',
									'label' => 'I Rent',
									'data-goto' => 'rentAmount'
								),
								array(
									'name' => 'mortgage',
									'label' => 'I have a Mortgage On My Home',
									'data-goto' => 'mortgageAmount'
								),
								array(
									'name' => 'paidOff',
									'label' => 'My Home Is Paid For',
									'data-goto' => 'propertyTaxes'
								),
								array(
									'name' => 'free',
									'label' => 'I dont have a housing expense',
									'data-goto' => 'foodExpense'
								)

							);
							//$id, $options, $label, $message, $branchName
							writeRadioQuestion ('housing', $housingRadio, 'What best describes your housing costs?', '', 'housing');
								//$branchValue, $id, $name, $label, $message, $placeholder, $exitTo
								writeBranchSubQuestion_Dollar('rentAmount', 'rentAmount', 'rentAmount', 'How much do you pay per month for rent?', '', '', 'foodExpense','', $smSliderOptions);
								writeBranchSubQuestion_Dollar('mortgageAmount', 'mortgageAmount', 'mortgageAmount', 'What is the remaining balance on your mortgage?', '', '', 'foodExpense','', $lgSliderOptions);								
								writeBranchSubQuestion_Dollar('propertyTaxes', 'propertyTaxes', 'propertyTaxes', 'How much do you pay per year in property taxes?', '', '', 'foodExpense','', $defaultSliderOptions);

							$foodRadio = array(
								array(
									'name' => '50',
									'label' => '$50',
									'data-goto' => 'car'
								),
								array(
									'name' => '100',
									'label' => '$100',
									'data-goto' => 'car'
								),
								array(
									'name' => '200',
									'label' => '$200',
									'data-goto' => 'car'
								),
								array(
									'name' => '300',
									'label' => '$300',
									'data-goto' => 'car'
								),
								array(
									'name' => '400',
									'label' => '$400',
									'data-goto' => 'car'
								),
								array(
									'name' => '500',
									'label' => '$500',
									'data-goto' => 'car'
								),
								array(
									'name' => '600',
									'label' => '$600',
									'data-goto' => 'car'
								),
								array(
									'name' => '700',
									'label' => '$700',
									'data-goto' => 'car'
								),
								array(
									'name' => '800',
									'label' => '$800',
									'data-goto' => 'car'
								),
								array(
									'name' => '900',
									'label' => '$900',
									'data-goto' => 'car'
								),
								array(
									'name' => '1000',
									'label' => '$1000',
									'data-goto' => 'car'
								),
								array(
									'name' => 'customAmount',
									'label' => 'Custom Input',
									'data-goto' => 'customFood'
								)

							);
							//$id, $options, $label, $message, $branchName
							writeRadioQuestion ('foodExpense', $foodRadio, 'Estimate how much you spend on food and groceries per month.', 'Include going out to eat. Remember, an estimate is fine for now.', 'foodExpense');
								//$branchValue, $id, $name, $label, $message, $placeholder, $branchExit
								writeBranchSubQuestion_Dollar('customFood', 'customFood', 'customFood', 'About how much do you pay per month for food?', '', '', 'car','', $defaultSliderOptions);

							$carRadio = array(
								array(
									'name' => 'noCar',
									'label' => "I don't have a car",
									'data-goto' => 'healthInsurance'
								),
								array(
									'name' => 'leaseCar',
									'label' => "I lease a car(s)",
									'data-goto' => 'carValue'
								),
								array(
									'name' => 'ownCar',
									'label' => "I own my car outright",
									'data-goto' => 'carValue'
								),
								array(
									'name' => 'loanCar',
									'label' => "I have a car loan(s)",
									'data-goto' => 'carValue'
								),

							);
							//$id, $options, $label, $message, $branchName
							writeRadioQuestion ('car', $carRadio, 'What best describes your car ownership?', '', 'car');
								//$branchValue, $id, $name, $label, $message, $placeholder, $branchExit
								writeBranchSubQuestion_Dollar('carValue', 'carValue', 'carValue', 'About how much is your car worth if sold to a private party?', 'Link to KBB? USE KBB API?', '', 'carInsurance','', $defaultSliderOptions);
								writeBranchSubQuestion_Dollar('carInsurance', 'carInsurance', 'carInsurance', 'About how much do you spend on car insurance per month?', '', '', 'healthInsurance','', $smSliderOptions);
							
							writeDollarQuestion('healthInsurance', 'healthInsurance', 'How much are you paying for health insurance per month?', '', '','','', $smSliderOptions);

				writeMidResults ('resultsExpenses', 'Great! How about those debts? :-/', "");

							

							//$id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
							writeBooleanQuestion ('','debts','Do you have any debts?','Other than a mortgage on your home', 'debts', 'debtsList', 'retirementMatch');
								//if using select type with options, options must be punctuated by underscores. they will be replaced by spaces when showing the label
								$debtClone = array (
									array(
										'class' => 'col-md-3',
										'type' => 'select',
										'options' => array (
												'','student_loan', 'car_loan', 'credit_card_debt', 'medical_debt', 'personal_loan', 'payday_loan', 'HELOC', 'mortgage', '401k_loan', 'other_debt'
											),
										'name' => 'debtDescription',
										'id' => 'debtDescription',
										'placeholder' => 'Type'
									),
									array(
										'class' => 'col-md-3',
										'type' => 'tel',
										'name' => 'debtAmount',
										'id' => 'debtAmount',
										'placeholder' => 'Balance',
										'fieldLabel' => 'input-group-prepend',
										'icon' => 'fas fa-dollar-sign'
									),
									array(
										'class' => 'col-md-3',
										'type' => 'tel',
										'name' => 'debtInterestRate',
										'id' => 'debtInterestRate',
										'placeholder' => 'Interest Rate',
										'fieldLabel' => 'input-group-prepend',
										'icon' => 'fas fa-percent'
									),
									array(
										'class' => 'col-md-3',
										'type' => 'tel',
										'name' => 'debtMinimum',
										'id' => 'debtMinimum',
										'placeholder' => 'Min Payment',
										'fieldLabel' => 'input-group-prepend',
										'icon' => 'fas fa-dollar-sign'
									),
								);
								//$branchValue, $id, $cloneTargetID, $questions, $label, $message, $branchExit
								writeBranchSubQuestion_Clone ('debtsList', 'debtsList', 'dhClone', $debtClone, 'List your debts.', 'Click the + or - buttons for additional debts', 'retirementMatch');

							//$id, $name, $label, $message, $branchName, $gotoYes, $gotoNo
							writeBooleanQuestion ('retirementMatch','retirementMatch','Do your employer offer a retirement match?', '', 'retirementMatch', 'retirementMatchYes', 'retirementSavings');
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
								writeBranchSubQuestion_Radio ('retirementMatchYes','retirementMatchContribution', $contributionRadio, 'Are you contributing to this retirement account?', '', 'retirementSavings');

							writeDollarQuestion('retirementSavings', 'retirementSavings', 'Estimate how much you have saved in total for retirement.', "Total the amount in any IRA, SEP, 401K, 403b, etc. Do not include money in your checking or savings account.", '','','', $lgSliderOptions);
							writeBooleanQuestion ('upcomingExpense','upcomingExpense','Do you have any large upcoming expenses in the near future?', 'This would include a wedding, education program, etc', 'upcomingExpense', 'upcomingExpenseYes', 'goals');
								writeBranchSubQuestion_Dollar('upcomingExpenseYes', 'upcomingExpenseAmount', 'upcomingExpenseAmount', 'How much do you do you expect this expense to be?', '', '', 'upcomingExpenseDate','', $defaultSliderOptions);
								writeDateQuestion('upcomingExpenseDate', 'upcomingExpenseDate', 'When would you have to have the money saved by?', '', 'MM/DD/YYYY','');

							$goalsRadio = array(
								array(
									'name' => 'debt',
									'label' => "Get out of debt",
									'data-goto' => 'end'
								),
								array(
									'name' => 'retirement',
									'label' => "Get on the right path for retirement",
									'data-goto' => 'end'
								),
								array(
									'name' => 'compare',
									'label' => "Find out how I compare to others",
									'data-goto' => 'end'
								),
								array(
									'name' => 'kids',
									'label' => "Save for my kids education",
									'data-goto' => 'end'
								),
								array(
									'name' => 'largeExpense',
									'label' => "To make sure I'm prepared for a large upcoming expense",
									'data-goto' => 'end'
								),
								array(
									'name' => 'help',
									'label' => "I have no idea what I'm doing with my money! Anything will help!",
									'data-goto' => 'end'
								),
								array(
									'name' => 'expense',
									'label' => "To prepare for an upcoming expense",
									'data-goto' => 'end'
								),
							);
							//$id, $options, $label, $message, $branchName
							writeSelectQuestion ('goals', $goalsRadio, 'What are you financial goals?', '', '');
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