<!doctype html>
<html>
	<head>
		<?php $currentUserID = $this->user->info->ID; ?>
		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/smartforms/jquery.formShowHide.min.js"></script>
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

			//function to add commas to long numbers such as the income slider, should be moved to its own JS file at some point
			function addCommas(nStr)
			{
			    nStr += '';
			    x = nStr.split('.');
			    x1 = x[0];
			    x2 = x.length > 1 ? '.' + x[1] : '';
			    var rgx = /(\d+)(\d{3})/;
			    while (rgx.test(x1)) {
			        x1 = x1.replace(rgx, '$1' + ',' + '$2');
			    }
			    return x1 + x2;
			}

			jQuery(function($) {
				//define form name for validation
				var form = $("#welcomeForm");
				var formDiv = ("#branchForm");

				var writeMode = true;
				var formdata = '';

				//to make the form a little more pretty, it is hidden by default and below shows it again on page load
				$('#branchForm').show();

				//add in the progress bar to the top of the form container
				$('div.smart-forms').prepend('<div class="progress" style="height: 3px;"><div id="form-progress" class="progress-bar bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><p><span id="numAnswered"></span>/<span id="numTotal"></span></p>');
				$('#form-progress').css('width', '0%');


				//jquery validate has to be attached to a form tag, not a div
				$(form).validate({
					errorClass: "state-error",
					validClass: "state-success",
					errorElement: "em",
					onkeyup: false,
					onclick: false,
			        rules: {
			        	dob: {
			        		required: true,
			        		date: true
			        	},
			        	goal: {
			            	required: true
			            },
			            retireAge: {
			                required: true
			            },
			            annualIncome: {
			            	required: true,
			            	pattern: /^[0-9,]+$/,
			            	minlength: 4
			            }
			        },
			        messages: {
			        	dob: {
			        		required: 'Knowing your age is essential for us to help provide you valuable advice.',
			        		date: 'Please enter a valid date (Day / Month / Year)'
			        	},
			        	goal: {
			        		required: 'No goal? Pick the last option to skip.'
			        	},
				        retireAge: {
				            required: 'Please fill in your goal age.'
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
			            if ( element.is(":radio") ) 
			            {
			                error.appendTo( element.parents('.form-group') );
			            }
			            else 
			            { // This is the default behavior 
			                error.insertAfter( element );
			            }
			        }
			    });

				//start the wizard
				$(formDiv).wizard({
					skip: '.skip',
					transitions: {
						//hardcoded logic branch for goal
						goal: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=goal]:checked" ).val();
							if ( !branch ) {
								form.validate().settings.ignore = ":disabled,:hidden";
        						return form.valid();
							}
							return branch;
						}
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
		   				if (state.isFirstStep == false || state.isLastStep == false) {
		   					$('#bottomForward, #bottomBackward').show();
		   				}
					},
					beforeForward: function( event, state ) {
						//check if the button pressed to advance was a id=skip, otherwise validate according to rules
						if (event['currentTarget']['id'] !== 'skip') {
							form.validate().settings.ignore = ":disabled,:hidden";
        					return form.valid();
						}
					},
					afterSelect: function( event, state ) {
						//advance progress bar
						$('#numAnswered').html(state.stepsComplete);
						$('#numTotal').html(state.stepsPossible);
		   				$('#form-progress').css('width', (state.stepsComplete/state.stepsPossible)*100+'%');
		   				//reset forward button color
		   				$('#bottomForward').addClass('btn-outline-primary').removeClass('btn-primary'); 

		   				//if we are on the last step, hide the buttons so wecan have a custom submit
		   				if (state.isFirstStep == true || state.isLastStep == true) {
		   					$('#bottomForward, #bottomBackward').hide();
		   				}

		   				//get form values out of steps and show them mid form to user
		   				//only necessary if there is a mid page results section
		   				if (state.step[0]['id'] == 'results1') {
		   					var dobVal = $('#dobInput').val();
		   					$('#dobLi').append(dobVal);
		   					var countryVal = $('#countryInput').val();
		   					$('#countryLi').append(countryVal);
		   					var incomeVal = $('#annualIncome').val();
		   					$('#incomeLi').append(incomeVal);
		   					var goalVal = $("[name='goal'] :selected").val();
		   					$('#goalLi').append(goalVal);
		   				}

		   				//check if anything in the form has been updated since last afterSelect call
			            if (formdata !== $(form).serialize()) {
			            	formdata = $(form).serialize();
			            	//if writemode is on, ajax post the data to handler
			            	if (writeMode == true) {
			            		$('#errorRpt').append("<p class='alert alert-info'>Send: " + formdata + "</p>");
				            	$.ajax({
								    data: formdata,
								    type: "post",
								    url: "<?php echo base_url ('Account/submit'); ?>",
									error: function (XMLHttpRequest, textStatus, errorThrown) {
						                $('#errorRpt').append("<p class='alert alert-danger'>Status: " + textStatus + "</p>");
						                $('#errorRpt').append("<p class='alert alert-danger'>Error: " + XMLHttpRequest.responseText + "</p>");
						            },
								    success: function(data){
								        $('#errorRpt').append("<p class='alert alert-success'>Return: " + JSON.stringify(data) + "</p>");
								    }
								});
							}
			            }

					}
				});
				//initialize the slider
				$("#slider").slider({
                    value: 0,
                    min: 0,
                    max: 200000,
                    step: 1000,
                    range: "min",
                    slide: function(event, ui) {
                    	//change the next button color if there is any interaction with the slider
                    	$('#bottomForward').removeClass('btn-outline-primary').addClass('btn-primary');  
                    	//run function to add commas to thousands/millions
                        //$("#annualIncome").val(addCommas(ui.value));
                        $("#annualIncome").attr('value', ui.value).val(ui.value);
                    }
                });

                //initialize the clone fields
                $('#debt-clone-fields').cloneya();

                //put the date mask on the DOB field
                $("#dobInput").mask('99/99/9999', {placeholder:'MM/DD/YYYY'});

                //setup the showHide for the country selector as well as disable fields which are not displayed
            	$('.smartfm-ctrl').change(function(){
            		$('.hiddenbox').hide();
            		$('.hiddenbox :input').attr('disabled','disabled');
    				$('#' + $(this).val()).show();
    				$('#' + $(this).val() + " :input").removeAttr('disabled');
            	});

                //set the textbox attached to the slider, value equal to default slider value
                $("#annualIncome").val($("#slider").slider("value"));
                $("#annualIncome").blur(function() {
                    $("#slider").slider("value", $(this).val());
                });

                //change the button color once there is some amount of form interaction, look to the afterselect function for the revert counterpart
                $('input').on('input', function() {
			        $('#bottomForward').removeClass('btn-outline-primary').addClass('btn-primary'); 
				});

                //hide the buttons at the beginning so that we can have a custom button
                $('#bottomForward, #bottomBackward').hide();
			});
		</script>
		<style>
		.bgBlock {
			background-color: #F53803;
			background-image: linear-gradient(141deg, #F53803 0%, #F5D020 75%);
			min-height: 500px;
			min-width: 500px;
			vertical-align: middle;
			display: block;
		}
		.titleBlock {
			max-width: 300px;
			color: #fff;
			font-size: 24px;
		}
		.navigation button {
			padding: 10px 40px;
			margin: 0 20px;
		}
		.form-row label {
			padding-bottom: 10px;
			font-size: 24px !important;
			text-align: center !important;
			margin: auto;
		}
		.form-group label {
			font-size: 14px !important;
			padding-bottom: 5px;
		}
		#branchForm {display: none;}
		.hiddenbox {display: none;}
		</style>
	</head>
	<body>
		<div id="branchForm" class="container">
			<pre id="errorRpt"></pre>
			<div class="row">
				<div class="smart-forms card col-md-12">
					<div class="form-body text-center">
						<form name="welcomeForm" id="welcomeForm" class="">
							<!-- hidden field for the current User ID -->
			            	<input type="hidden" name="ID" value="<?php echo $currentUserID; ?>">
			            	<!-- hidden field for CSRF security token -->
			            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
			            	<!-- hidden field for form name -->
							<input type="hidden" name="formName" value="welcome">

							<div class="step">
								<div class="bgBlock jumbotron d-flex align-items-center">
									<div class="titleBlock text-left">
										<p>Let us help you achieve your financial goals with a free 2-minute online evaluation</p>
										<input type="hidden" name="startCheck" value="1">
										<button type="button" name="forward" class="forward btn btn-rounded btn-primary btn-lg">Get Started</button>
									</div>
								</div>
							</div>



							<div class="step" id="dob">
								<div class="form-row section">
	                				<div class="col-md-12">
					                	<label for="dobInput">What is your date of birth? <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="This will help us put context to all of your information."></i></label>
					                </div>
					                <div class="form-group col-md-4 offset-md-4">
										<input type="text" name="dob" id="dobInput" class="gui-input" placeholder="MM/DD/YYYY">
									</div>
		                        </div><!-- end section -->
		                        <button type="button" id="skip" class="forward btn btn-sm btn-outline-dark">I don't want to say.</button>
							</div>

							<div class="step" id="location">
								<div class="form-row section">
									<div class="col-md-12">
										<label>Where do you live?</label>
										<p>Where you are located can be a major factor in determining your cost of living. With a rough estimate of your location, we can personalize your results to provide you financial insights.</p>
										<label for="countryInput">Country</label>
				                        <label class="field select">
				                            <select name="locationCountry" id="countryInput" class="smartfm-ctrl">
				                                <option value="" selected></option>
				                                <option value="US">United States</option>
				                                <option value="CA">Canada</option>
				                                <option value="Other">Other</option>
				                            </select>
				                            <i class="arrow double"></i>
				                        </label>
				                	</div>
				                </div>
			                    <div id="US" class="hiddenbox">
									<div class="form-row section">
										<div class="col-md-12">
											<label for="inputState">State</label>
											<label class="field select">
												<select id="inputState" name="locationState" class="gui-input" disabled>
													<option selected></option>
													<option value="AL">Alabama</option>
													<option value="AK">Alaska</option>
													<option value="AZ">Arizona</option>
													<option value="AR">Arkansas</option>
													<option value="CA">California</option>
													<option value="CO">Colorado</option>
													<option value="CT">Connecticut</option>
													<option value="DE">Delaware</option>
													<option value="DC">District Of Columbia</option>
													<option value="FL">Florida</option>
													<option value="GA">Georgia</option>
													<option value="HI">Hawaii</option>
													<option value="ID">Idaho</option>
													<option value="IL">Illinois</option>
													<option value="IN">Indiana</option>
													<option value="IA">Iowa</option>
													<option value="KS">Kansas</option>
													<option value="KY">Kentucky</option>
													<option value="LA">Louisiana</option>
													<option value="ME">Maine</option>
													<option value="MD">Maryland</option>
													<option value="MA">Massachusetts</option>
													<option value="MI">Michigan</option>
													<option value="MN">Minnesota</option>
													<option value="MS">Mississippi</option>
													<option value="MO">Missouri</option>
													<option value="MT">Montana</option>
													<option value="NE">Nebraska</option>
													<option value="NV">Nevada</option>
													<option value="NH">New Hampshire</option>
													<option value="NJ">New Jersey</option>
													<option value="NM">New Mexico</option>
													<option value="NY">New York</option>
													<option value="NC">North Carolina</option>
													<option value="ND">North Dakota</option>
													<option value="OH">Ohio</option>
													<option value="OK">Oklahoma</option>
													<option value="OR">Oregon</option>
													<option value="PA">Pennsylvania</option>
													<option value="RI">Rhode Island</option>
													<option value="SC">South Carolina</option>
													<option value="SD">South Dakota</option>
													<option value="TN">Tennessee</option>
													<option value="TX">Texas</option>
													<option value="UT">Utah</option>
													<option value="VT">Vermont</option>
													<option value="VA">Virginia</option>
													<option value="WA">Washington</option>
													<option value="WV">West Virginia</option>
													<option value="WI">Wisconsin</option>
													<option value="WY">Wyoming</option>
													<option value="AS">American Samoa</option>
													<option value="GU">Guam</option>
													<option value="MP">Northern Mariana Islands</option>
													<option value="PR">Puerto Rico</option>
													<option value="UM">United States Minor Outlying Islands</option>
													<option value="VI">Virgin Islands</option>
													<option value="AA">Armed Forces Americas</option>
													<option value="AP">Armed Forces Pacific</option>
													<option value="AE">Armed Forces Others</option>
												</select>
												<i class="arrow double"></i>
											</label>
										</div>
									</div>
									<div class="form-row section">
	                    				<div class="col-md-12">
											<label for="inputCity">City</label>
											<input type="text" name="locationCity" id="inputCity" class="gui-input" placeholder="New Haven" disabled>
										</div>
									</div>
								</div>
								<div id="CA" class="hiddenbox">
									<div class="form-group col-md-6 offset-md-1">
										<label for="inputCity">City</label>
										<input type="text" name="locationCity" class="form-control" id="inputCity" placeholder="Montreal" disabled>
									</div>
									<div class="form-group col-md-4">
										<label for="inputState">Territory</label>
										<select id="inputState" name="locationState" class="form-control" disabled>
											<option selected></option>
											<option value="AB">Alberta</option>
											<option value="BC">British Columbia</option>
											<option value="MB">Manitoba</option>
											<option value="NB">New Brunswick</option>
											<option value="NL">Newfoundland and Labrador</option>
											<option value="NS">Nova Scotia</option>
											<option value="ON">Ontario</option>
											<option value="PE">Prince Edward Island</option>
											<option value="QC">Quebec</option>
											<option value="SK">Saskatchewan</option>
											<option value="NT">Northwest Territories</option>
											<option value="NU">Nunavut</option>
											<option value="YT">Yukon</option>
										</select>
									</div>
								</div>
								<div id="Other" class="hiddenbox">
									<div class="form-group col-md-6 offset-md-1">
										<label for="inputCountry">Country</label>
										<input type="text" class="form-control" name="locationCountry" id="inputCountry" placeholder="Mexico" disabled>
									</div>
								</div>
							</div>

							<div class="step" data-state="goal">
								<div class="form-row section">
	                				<div class="col-md-12">
										<label>Which goal are you most focused on accomplishing?</label>
									</div>
									<div class="form-group col-md-12">
										<div class="row">
											<div class="col-sm-3 m-b-30">
			                                    <div class="option-box-grid">
			                                        <input type="radio" class="radio-button required" name="goal" value="retire" id="goalretire" />
			                                        <label for="goalretire">
			                                            <span class="radio-content p-all-15 text-center">
			                                                <span class="mdi h1 d-block mdi-golf"></span>
			                                                <span class="h5">Retire Early</span>
			                                                <span class="d-block text-overline text-muted">The American Dream</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                                <div class="col-sm-3 m-b-30">
			                                    <div class="option-box-grid">
			                                        <input type="radio" class="radio-button" name="goal" value="stability" id="goalstability" />
			                                        <label for="goalstability">
			                                            <span class="radio-content p-all-15 text-center">
			                                                <span class="mdi h1 d-block mdi-chart-areaspline"></span>
			                                                <span class="h5">Financial Stability</span>
			                                                <span class="d-block text-overline text-muted">placeholder</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                                <div class="col-sm-3 m-b-30">
			                                    <div class="option-box-grid">
			                                        <input type="radio" class="radio-button" name="goal" value="debts" id="goaldebts" />
			                                        <label for="goaldebts">
			                                            <span class="radio-content p-all-15 text-center">
			                                                <span class="mdi h1 d-block mdi-credit-card"></span>
			                                                <span class="h5">Pay Down Debts</span>
			                                                <span class="d-block text-overline text-muted">placeholder</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                                <div class="col-sm-3 m-b-30">
			                                    <div class="option-box-grid">
			                                        <input type="radio" class="radio-button" name="goal" value="income" id="skipbranch" />
			                                        <label for="skipbranch">
			                                            <span class="radio-content p-all-15 text-center">
			                                                <span class="mdi h1 d-block mdi-motorbike"></span>
			                                                <span class="h5">Saving for an Expense</span>
			                                                <span class="d-block text-overline text-muted">Skip to income</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                            </div>
									</div>
								</div>
							</div>

							<div class="branch" id="retire">
								<div class="step" data-state="income">
									<div class="form-row">
						                <div class="col-md-12">
							                <label>Many people want to retire before the age of 60, but it can be difficult. We can help you plan and maximize every dollar to help you meet your goals!</label>
							            </div>
						                <div class="form-group col-md-4 offset-md-4">
						                	<label for="retireAge">At what age do you hope to retire?</label>
											<input type="tel" name="retireAge" id="retireAge" class="gui-input required" placeholder="55">
										</div>
									</div>
								</div>
							</div>

							<div class="branch" id="stability">
								<div class="step" data-state="income">
									<p>Get your budget in order</p>
								</div>
							</div>

							<div class="branch" id="debts">
								<div class="step" data-state="income">
									<div class="form-row">
										<div class="col-md-12">
							                <label>Debts are often not paid off in the correct order. Please fill in the following fields for any debts you have and we can make sure you are out of the red as soon as possible!</label>
							            </div>
										<div id="debt-clone-fields">
					                        <div class="toclone clone-widget">
						                        <div class="frm-row">
						                        	<div class="form-group spacer-b10 colm colm5">
							                            <input type="text" name="debtDescription[]" id="debtDescription" class="gui-input" placeholder="Description">
							                        </div>
								                    <div class="form-group spacer-b10 colm colm4">
								                    	<label class="field prepend-icon">
								                            <input type="number" name="debtAmount[]" id="debtAmount" class="gui-input" placeholder="Debt / Loan Amount">
								                            <span class="field-icon"><i class="fas fa-dollar-sign"></i></span>  
							                       		</label>
							                        </div>
							                        <div class="form-group spacer-b10 colm colm3">
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
									</div>
								</div>
							</div>

							<div class="step" id="income">
								<div class="form-row section">
	                				<div class="col-md-12">
	                					<label for="annualIncome" class="field-label">What is your annual income? This can be a rough estimate for now. Either type it in or use the slider.</label>
	                					<p>I dropped comma separators for now, they might not be possible with this combo input/slider control</p>
	                				</div>
	                				<div class="form-group col-md-6 offset-md-3">
		                            	<div class="spacer-b20">
			                                
			                                <label class="field prepend-icon">
			                                	<input type="text" id="annualIncome" name="annualIncome" class="gui-input">
			                                	<span class="field-icon"><i class="fas fa-dollar-sign"></i></span>
			                                </label> 
			                            </div><!-- end .spacer -->             
			                            <div class="slider-wrapper blue-slider">
			                                <div id="slider"></div>
			                            </div><!-- end .slider-wrapper -->
		                        	</div>
		                        </div><!-- end section -->
			                    <button type="button" name="skip" class="forward btn btn-outline-dark">I'm not sure.</button>
							</div>

							<div class="step" id="results1">
								<div class="form-row section">
	                				<div class="col-md-12">
	                					<label for="" class="field-label">You're almost done!</label>
	                					<p>Here is what we know so far. Whenever you're ready, select <b>Continue</b> and we'll dive into some details.</p>
	                					<div class="row">
		                					<div class="col-md-4 m-b-30">
			                					<div class="card text-left m-b-30 shadow-lg">
				                            		<div class="card-header bg-primary text-white">
					                                	<p><i class="mdi h1 d-block mdi-account"></i>Personal info so far:</p>
					                                </div>
					                                <div class="card-body">
						                                <ul>
						                                	<li id="dobLi">Born: </li>
						                                	<li id="countryLi">Lives in: </li>
						                                </ul>
					                                </div>
					                            </div>
					                        </div>
					                        <div class="col-md-4 m-b-30">
			                					<div class="card text-left m-b-30 shadow-lg">
				                            		<div class="card-header bg-success text-white text-center">
					                                	<p>
					                                		<span class="mdi h1 d-block mdi-cash-multiple"></span>
					                                		Income we'll start with:
					                                	</p>
					                                </div>
					                                <div class="card-body">
						                                <ul>
						                                	<li id="incomeLi">Annual: </li>
						                                </ul>
					                                </div>
					                            </div>
					                        </div>
					                        <div class="col-md-4 m-b-30">
			                					<div class="card text-left m-b-30 shadow-lg">
				                            		<div class="card-header bg-dark text-white">
					                                	<p><i class="mdi h1 d-block mdi-target-variant"></i>Goal we are aiming for:</p>
					                                </div>
					                                <div class="card-body">
						                                <ul>
						                                	<li id="goalLi"></li>
						                                </ul>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
	                				</div>
		                        </div><!-- end section -->
							</div>

							<div class="submit step" id="end">
								<p>You made it to the end!</p>
								<button type="button" name="backward" class="backward btn btn-outline-primary">Need to change some answers?</button>
								<br/><br/>
								<button type="submit" name="forward" class="submit btn btn-success btn-lg btn-block">Submit <i class="fas fa-check"></i></button>
							</div>

							<div class="navigation">
									<hr>
									<button type="button" id="bottomBackward" name="backward" class="backward btn btn-outline-primary btn-lg float-left">Back</button>
									<button type="button" id="bottomForward" name="forward" class="forward btn btn-outline-primary btn-lg float-right">Continue</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<small id="emailHelp" class="form-text text-muted text-center"><i class="fas fa-lock"></i> We will never share your data without your permission. <a href="#">Privacy Policy</a></small>
	</body>
</html>