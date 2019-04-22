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

				//start the wizard
				$(formDiv).wizard({
					unidirectional: false,
					transitions: {
						//hardcoded logic branch for goal
						debts: function( state, action ) {
							//locate the goal branch and define a variable so that we can pass to the next step / validate properly
							var branch = state.step.find( "[name=debts]:checked" ).val();
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
		   				$('#bottomForward').addClass('btn-primary').removeClass('btn-success'); 

		   				//if we are on the last step, hide the buttons so wecan have a custom submit
		   				if (state.isFirstStep == true || state.isLastStep == true) {
		   					$('#bottomForward, #bottomBackward').hide();
		   				}

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
                $("#annualIncome").val($("#incomeSlider").slider("value"));
                $("#annualIncome").blur(function() {
                    $("#incomeSlider").slider("value", $(this).val());
                });

                //change the button color once there is some amount of form interaction, look to the afterselect function for the revert counterpart
                $('input').on('input', function() {
			        $('#bottomForward').removeClass('btn-primary').addClass('btn-success'); 
				});

                //hide the buttons at the beginning so that we can have a custom button
                $('#bottomForward, #bottomBackward').hide();

                //emoji slider for feelings
                //https://codepen.io/Guilh/pen/BxWyRP
                const range = document.querySelector('#feelingRange');
				const mojidiv = document.querySelector('.moji');
				//const mojis = ['😄','🙂','😐','😑','☹️','😩','😠'];
				const mojis = ['💩','😩','☹️','😑','😐','🙂','😄'];

				range.addEventListener('input', (e) => {
				  let rangeValue = e.target.value;
				  mojidiv.textContent = mojis[rangeValue];
				});
			});
		</script>
		<style>
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
		.bgBlock {
			background-color: #F53803;
			background-image: linear-gradient(141deg, #F53803 0%, #F5D020 75%);
			min-height: 500px;
			vertical-align: middle;
			display: block;
			padding-left: 30px;
			border-radius: 3px;
		}
		.titleBlock {
			max-width: 300px;
			color: #fff;
			font-size: 24px;
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
	</head>
	<body>
		<div id="main" class="container">
			<pre id="errorRpt"></pre>
			<div class="row m-h-50 align-items-center justify-content-center">
				<div class="col-lg-6 col-md-10 p-t-30">
					<div class="card">
						<form name="welcomeForm" id="welcomeForm" method="post" action="<?php echo base_url ('Account/submit'); ?>">
							<!-- hidden field for the current User ID -->
			            	<input type="hidden" name="ID" value="<?php echo $currentUserID; ?>">
			            	<!-- hidden field for CSRF security token -->
			            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
			            	<!-- hidden field for form name -->
							<input type="hidden" name="formName" value="welcome">

							<div class="step">
								<div class="bgBlock d-flex align-items-center">
									<div class="titleBlock text-left">
										<p>Let us help you achieve your financial goals with a free 2-minute online evaluation</p>
										<input type="hidden" name="startCheck" value="1">
										<button type="button" name="forward" class="forward btn btn-rounded btn-primary btn-lg">Get Started</button>
									</div>
								</div>
							</div>

							<!-- STEPS START HERE -->

							<div class="step">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="name">What is your name?</label>
										<p>Starting with an easy one</p>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
										<input type="text" name="name" id="name" class="form-control" placeholder="John Doe">
									</div>
								</div>
							</div>

							<div class="step">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="annualIncome">What is your household annual income?</label>
										<p>Pre tax ballpark off the top of your head</p>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
										<div class="input-group input-group-flush mb-3">
											<input type="tel" id="annualIncome" name="annualIncome" class="form-control form-control-prepended">
		                                    <div class="input-group-prepend">
		                                        <div class="input-group-text">
		                                            <span class="fas fa-dollar-sign"></span>
		                                        </div>
		                                    </div>
		                                </div>           
			                            <div id="incomeSlider"></div>
									</div>
								</div>
							</div>

							<div class="step">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="insuranceYes">Do you have health insurance?</label>
										<p>Any plan that covers you</p>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
	                                    <div class="option-box">
	                                        <input id="insuranceYes" name="insurance" value="yes" type="radio">
	                                        <label for="insuranceYes">
	                                        	<span class="radio-content"><p>Yes</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="insuranceNo" name="insurance" value="no" type="radio">
	                                        <label for="insuranceNo">
	                                        	<span class="radio-content"><p>No</p></span>
	                                        </label>
	                                    </div>
	                                    <div class="option-box">
	                                        <input id="insuranceNS" name="insurance" value="notsure" type="radio">
	                                        <label for="insuranceNS">
	                                        	<span class="radio-content"><p>I'm not sure</p></span>
                                        	</label>
	                                    </div>
	                                </div>
								</div>
							</div>

							<div class="step" data-state="debts">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="debtsYes">Do you have any debts other than a mortgage?</label>
										<p>Common examples are car loans, credit card debt, or student loans.</p>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
	                                    <div class="option-box">
	                                        <input id="debtsYes" name="debts" value="yes" type="radio">
	                                        <label for="debtsYes">
	                                        	<span class="radio-content"><p>Yes</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="debtsNo" name="debts" value="no" type="radio">
	                                        <label for="debtsNo">
	                                        	<span class="radio-content"><p>No</p></span>
	                                        </label>
	                                    </div>
	                                </div>
								</div>
							</div>

							<!-- this branch comes from id=yes -->
							<div class="branch" id="yes">
								<!-- this branch goes to id=expenses -->
								<div class="step" data-state="expenses">
									<div class="section">
									<div class="card-header m-b-0">
											<label for="name">What type of debts do you have?</label>
											<p>Select any and all that apply, we'll dig more into the numbers later</p>
											<hr class="card-line" align="left">
										</div>
										<div class="card-body m-b-30">
		                                    <div class="tag-input">
											    <input name="debtType[]" id="studentLoans" type="checkbox" value="studentLoans">
											    <label for="studentLoans">Student Loan</label>
											</div>
											<div class="tag-input">
											    <input name="debtType[]" id="carLoan" type="checkbox" value="carLoan">
											    <label for="carLoan">Car Loan</label>
											</div>
											<div class="tag-input">
											    <input name="debtType[]" id="creditCardDebt" type="checkbox" value="creditCardDebt">
											    <label for="creditCardDebt">Credit Card Debt</label>
											</div>
											<div class="tag-input">
											    <input name="debtType[]" id="medicalDebt" type="checkbox" value="medicalDebt">
											    <label for="medicalDebt">Medical Debt</label>
											</div>
											<div class="tag-input">
											    <input name="debtType[]" id="personalLoan" type="checkbox" value="personalLoan">
											    <label for="personalLoan">Personal Loan</label>
											</div>
											<div class="tag-input">
											    <input name="debtType[]" id="paydayLoan" type="checkbox" value="paydayLoan">
											    <label for="paydayLoan">Payday Loan</label>
											</div>
											<div class="tag-input">
											    <input name="debtType[]" id="otherDebt" type="checkbox" value="otherDebt">
											    <label for="otherDebt">Other Debt</label>
											</div>
		                                </div>
									</div>
								</div>
							</div>
							<!-- this branch comes from id=debtsNo -->
							<div class="branch" id="no">
								<!-- this branch goes to id=expenses -->
								<div class="step" data-state="expenses">
									<div class="section">
										<div class="card-header m-b-0">
											<label for="name">Great job!</label>
											<p>Being debt free makes all the math much easier</p>
											<hr class="card-line" align="left">
										</div>
										<div class="card-body m-b-30">
		                                    
		                                </div>
									</div>
								</div>
							</div>

							<div class="step" id="expenses">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="expenseRange1000">How much would you estimate your total monthly household expenses are?</label>
										<p>Housing payments, debt payments, utilities, groceries, etc.</p>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
	                                    <div class="option-box">
	                                        <input id="expenseRange1000" name="expenses" value="<1000" type="radio">
	                                        <label for="expenseRange1000">
	                                        	<span class="radio-content"><p>Less than $1,000</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="expenseRange2000" name="expenses" value="1000-2000" type="radio">
	                                        <label for="expenseRange2000">
	                                        	<span class="radio-content"><p>$1,000-$2,000</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="expenseRange3000" name="expenses" value="2000-3000" type="radio">
	                                        <label for="expenseRange3000">
	                                        	<span class="radio-content"><p>$2,000-$3,000</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="expenseRange4000" name="expenses" value="3000-4000" type="radio">
	                                        <label for="expenseRange4000">
	                                        	<span class="radio-content"><p>$3,000-$4,000</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="expenseRange5000" name="expenses" value="4000-5000" type="radio">
	                                        <label for="expenseRange5000">
	                                        	<span class="radio-content"><p>$4,000-$5,000</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="expenseRange6000" name="expenses" value=">5000" type="radio">
	                                        <label for="expenseRange6000">
	                                        	<span class="radio-content"><p>More than $5,000</p></span>
                                        	</label>
                                        </div>
	                                </div>
								</div>
							</div>

							<div class="step" id="retirement">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="retirementYes">Are you contributing to any retirement accounts?</label>
										<p>401k, 403b, IRA, etc.</p>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
	                                    <div class="option-box">
	                                        <input id="retirementYes" name="retirement" value="yes" type="radio">
	                                        <label for="retirementYes">
	                                        	<span class="radio-content"><p>Yes</p></span>
                                        	</label>
                                        </div>
                                        <div class="option-box">
	                                        <input id="retirementNo" name="retirement" value="no" type="radio">
	                                        <label for="retirementNo">
	                                        	<span class="radio-content"><p>No</p></span>
	                                        </label>
	                                    </div>
	                                    <div class="option-box">
	                                        <input id="retirementNS" name="retirement" value="notsure" type="radio">
	                                        <label for="retirementNS">
	                                        	<span class="radio-content"><p>I'm not sure</p></span>
                                        	</label>
	                                    </div>
	                                </div>
								</div>
							</div>

							<div class="step" id="goals">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="goals">What are your immediate financial goals?</label>
										<p>Why are you here and using this app?</p>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
										<div class="row form-group">
											<div class="col-sm-4 m-b-20">
			                                    <div class="option-box-grid">
			                                        <input type="checkbox" class="radio-button required" name="goals" value="retire" id="goalretire" />
			                                        <label for="goalretire">
			                                            <span class="radio-content p-all-10 text-center">
			                                                <span class="mdi h1 d-block mdi-golf"></span>
			                                                <span class="h5">Retire Early</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                                <div class="col-sm-4 m-b-20">
			                                    <div class="option-box-grid">
			                                        <input type="checkbox" class="radio-button" name="goals" value="stability" id="goalstability" />
			                                        <label for="goalstability">
			                                            <span class="radio-content p-all-10 text-center">
			                                                <span class="mdi h1 d-block mdi-chart-areaspline"></span>
			                                                <span class="h5">Financial Stability</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                                <div class="col-sm-4 m-b-20">
			                                    <div class="option-box-grid">
			                                        <input type="checkbox" class="radio-button" name="goals" value="debts" id="goaldebts" />
			                                        <label for="goaldebts">
			                                            <span class="radio-content p-all-10 text-center">
			                                                <span class="mdi h1 d-block mdi-credit-card"></span>
			                                                <span class="h5">Pay Down Debts</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>

			                                <div class="col-sm-4 m-b-20">
			                                    <div class="option-box-grid">
			                                        <input type="checkbox" class="radio-button" name="goals" value="expense" id="goalexpense" />
			                                        <label for="goalexpense">
			                                            <span class="radio-content p-all-10 text-center">
			                                                <span class="mdi h1 d-block mdi-home"></span>
			                                                <span class="h5">Save for an Expense</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                                <div class="col-sm-4 m-b-20">
			                                    <div class="option-box-grid">
			                                        <input type="checkbox" class="radio-button" name="goals" value="kids" id="goalchildren" />
			                                        <label for="goalchildren">
			                                            <span class="radio-content p-all-10 text-center">
			                                                <span class="mdi h1 d-block mdi-baby-buggy"></span>
			                                                <span class="h5">Put Money Away for Children</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                                <div class="col-sm-4 m-b-20">
			                                    <div class="option-box-grid">
			                                        <input type="checkbox" class="radio-button" name="goals" value="learn" id="goallearn" />
			                                        <label for="goallearn">
			                                            <span class="radio-content p-all-10 text-center">
			                                                <span class="mdi h1 d-block mdi-account-question"></span>
			                                                <span class="h5">I have no idea what I'm doing</span>
			                                            </span>
			                                        </label>
			                                    </div>
			                                </div>
			                            </div>
									</div>
								</div>
							</div>

							<div class="step" id="expenses">
								<div class="section">
									<div class="card-header m-b-0">
										<label for="expenseRange1000">How do you feel about managing your expenses?</label>
										<hr class="card-line" align="left">
									</div>
									<div class="card-body m-b-30">
	                                    <div class="form-group col-md-8 offset-md-2">
	                                    	<div class="moji">😄</div>
			                                <input type="range" class="custom-range" value="3" min="0" max="6" step="1" id="feelingRange" name="feeling">
			                            </div>
	                                </div>
								</div>
							</div>

							<!-- STEPS END HERE -->

							<div class="submit step" id="end">
								<div class="section">
									<div class="card-header m-b-0">
										<label>Just one thing left before we can show you some results!</label>
										<p>Something here to direct to a registration form, not sure how that will technologically work yet. Need Ben to weigh in on CodeIgniter shenanigans.</p>
									</div>
									<div class="card-body m-b-30">
										<button type="button" name="backward" class="backward btn btn-dark">Need to change some answers?</button>
										<br/><br/>
										<button type="submit" name="submit" class="submit btn btn-success btn-lg btn-block">Submit <i class="fas fa-check"></i></button>
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