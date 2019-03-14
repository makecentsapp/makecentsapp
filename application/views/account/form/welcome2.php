<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="//makecentsapp.com/application/views/account/form/tiles.css" />

		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/smartforms/jquery-cloneya.min.js"></script>

		<link rel="stylesheet" type="text/css" href="//makecentsapp.com/assets/vendor/jquery.wizard/examples/styles.css" />
		<script type="text/javascript" src="//makecentsapp.com/assets/vendor/jquery.wizard/jquery.wizard.js"></script>
		<script type="text/javascript">
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
				$('#branchForm').show();
				var numAnswered = 0;
				var numTotal = 4;
				$('div.form-body').prepend('<div class="progress" style="height: 3px;"><div id="form-progress" class="progress-bar bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><p><span id="numAnswered">'+numAnswered+'</span>/'+numTotal+'</p>');
				$('#form-progress').css('width', (numAnswered/numTotal)*100+'%');

				$( "#branchForm" ).wizard({
					transitions: {
						goal: function( state, action ) {
							var branch = state.step.find( "[name=goal]:checked" ).val();
							if ( !branch ) {
								alert( "Please select a value to continue." );
							}
							return branch;
						}
					},
					afterSelect: function( event, state ) {
						$('#numAnswered').html(state.stepsComplete);
		   				$('#form-progress').css('width', (state.stepsComplete/numTotal)*100+'%');

					}
				}).validate({
			    	errorClass: "state-error",
					validClass: "state-success",
					errorElement: "em",
					onkeyup: false,
					onclick: false,
			        rules: {
			            retireAge: {
			                required: true,
			                minlength: 1,
			                maxlength: 3
			            }
			        },
			        messages: {
				        retireAge: {
				            required: 'Please fill in your target retirement age.',
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

				$("#slider").slider({
                        value: 0,
                        animate: true,
                        min: 0,
                        max: 200000,
                        step: 1000,
                        range: "min",
                        slide: function(event, ui) {
                            $("#annualIncome").val(addCommas(ui.value));
                        }
                    });
                    
                    $("#annualIncome").val($("#slider").slider("value"));
                    $("#annualIncome").blur(function() {
                            $("#slider").slider("value", $(this).val());
                    });
			});
		</script>
		<style>
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
		</style>
	</head>
	<body>
			<div id="branchForm" class="smart-wrap">
    			<div class="smart-forms wrap-1">
					<div class="form-body text-center">
						<form name="example-3">
							<div class="step">
								<p>START</p>
							</div>

							<div class="step" data-state="goal">
								<div class="form-row section">
	                				<div class="col-md-12">
										<label>Which goal are you most focused to accomplish?</label>
									</div>
									<div class="form-group col-md-12">
										<div class="radio-tile-group">
											<div class="input-container">
												<input type="radio" class="radio-button" name="goal" value="retire" id="goalretire" />
												<div class="radio-tile">
													<div class="icon">
														<img src="//makecentsapp.com/application/views/account/form/web.png" />
													</div>
													<label class="radio-tile-label" for="goalretire">Retire Early</label>
												</div>
											</div>
											<div class="input-container">
												<input type="radio" class="radio-button" name="goal" value="stability" id="goalstability" />
												<div class="radio-tile">
													<div class="icon">
														<img src="//makecentsapp.com/application/views/account/form/web.png" />
													</div>
													<label class="radio-tile-label" for="goalstability">Financial Stability</label>
												</div>
											</div>
											<div class="input-container">
												<input type="radio" class="radio-button" name="goal" value="debts" id="goaldebts" />
												<div class="radio-tile">
													<div class="icon">
														<img src="//makecentsapp.com/application/views/account/form/web.png" />
													</div>
													<label class="radio-tile-label" for="goaldebts">Pay Down Debts</label>
												</div>
											</div>
											<div class="input-container">
												<input type="radio" class="radio-button" name="goal" value="income" id="goalincome" />
												<div class="radio-tile">
													<div class="icon">
														<img src="//makecentsapp.com/application/views/account/form/web.png" />
													</div>
													<label class="radio-tile-label" for="goalincome">Something else</label>
													<p><small>Skip over the branch right to income</small></p>
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
											<input type="number" min="1" max="150" name="retireAge" id="retireAge" class="gui-input" placeholder="55">
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
									<p>Focus on high interest first</p>
								</div>
							</div>

							<div class="step" id="income">
								<div class="form-row section">
	                				<div class="col-md-12">
	                					<label for="annualIncome" class="field-label">What is your annual income? This can be a rough estimate for now. Either type it in or use the slider.</label>
	                				</div>
	                				<div class="form-group col-md-6 offset-md-3">
		                            	<div class="spacer-b20">
			                                
			                                <label class="field prepend-icon">
			                                	<input type="text" id="annualIncome" class="gui-input">
			                                	<span class="field-icon"><i class="fas fa-dollar-sign"></i></span>
			                                </label> 
			                            </div><!-- end .spacer -->             
			                            <div class="slider-wrapper blue-slider">
			                                <div id="slider"></div>
			                            </div><!-- end .slider-wrapper -->
		                        	</div>
		                        </div><!-- end section -->
			                    <button type="button" name="forward" class="forward btn">Skip</button>
							</div>

							<div class="step" id="end">
								<p>FINISH</p>
							</div>

							<div class="navigation">
								<ul class="clearfix">
									<li><button type="button" name="backward" class="backward btn">Back</button></li>
									<li><button type="button" name="forward" class="forward btn">Next</button></li>
								</ul>
							</div>
						</form>
						<small id="emailHelp" class="form-text text-muted"><i class="fas fa-lock"></i> We will never share your data. <a href="#">Privacy Policy</a></small>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>