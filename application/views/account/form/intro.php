<?php
	if ($this->user->loggedin) {
		$currentUserID = $this->user->info->ID;
	} else {
		$currentUserID = $this->welcome_model->reserveId('intro_ids');
	}
?>
<!-- Moved extenral JS calls to Intro controller Index -->

<!-- Moved custom JS to js file, called in Intro controller Index -->
<div id="main" class="container">
	<pre id="errorRpt"></pre>
	<div class="row m-h-50 align-items-center justify-content-center">
		<div class="col-lg-6 col-md-10 p-t-30">
			<div class="card">
				<form name="welcomeForm" id="welcomeForm" method="post" action="<?php echo base_url('Intro/submit'); ?>">
					<!-- hidden field for the current User ID -->
					<input type="hidden" name="ID" value="<?php echo $currentUserID; ?>">
					<!-- hidden field for CSRF security token -->
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<!-- hidden field for form name -->
					<input type="hidden" name="formName" value="intro">

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