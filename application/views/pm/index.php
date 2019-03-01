<style>
.inactive-card {
	background-color: #ccc !important;
}
.custom-card-icon {
	width: 125px;
	height: 125px;
	background-color: #1abc9c;
	border-radius: 3px;
	margin: auto;
	color: #fff;
}
.custom-card-icon:hover {
	background-color: #1ccdaa;
}
.custom-card-icon i, .card a {
	font-size: 42px;
	vertical-align: middle;
	margin: auto;
	color: #fff;
	padding-top: 35px;
	text-decoration: none;
}
.card-text {
	padding: 10px;
}
</style>
<?php


?>
<br>
<div class="container">
	<h3>First screen a user sees after registration. Probably something up here about expectations, i.e. 5 mins per survey and then you are on your way to being a millionaire.</h3>
	<div class="row">
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<a href="<?php echo base_url ('PM/personalForm'); ?>">
					<div class="custom-card-icon">
						<i class="fa fa-id-card"></i>
						<h4 class="card-title">
							Personal Details
						</h4>
					</div>
				</a>
				<div class="card-body">
					<p class="card-text small small">Some quick info to help us provide you with some perspective.</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<a href="<?php echo base_url ('PM/incomeForm'); ?>">
					<div class="custom-card-icon">
						<i class="fa fa-money-bill-alt"></i>
						<h4 class="card-title">Income</h4>
					</div>
				</a>
				<div class="card-body">
					<p class="card-text small">How much scratch do you bring in to the coffers?</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<a href="<?php echo base_url ('PM/assetsForm'); ?>">
					<div class="custom-card-icon inactive-card">
						<i class="fa fa-piggy-bank"></i>
						<h4 class="card-title">Assets</h4>
					</div>
				</a>
				<div class="card-body">
					<p class="card-text small">House, car, and bank accounts: totaled up.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<a href="<?php echo base_url ('PM/expensesForm'); ?>">
					<div class="custom-card-icon inactive-card">
						<i class="fa fa-cash-register"></i>
						<h4 class="card-title">Expenses</h4>
					</div>	
				</a>
				<div class="card-body">
					<p class="card-text small">What are you buying and why are you paying so much?</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<a href="<?php echo base_url ('PM/debtsForm'); ?>">
					<div class="custom-card-icon inactive-card">
						<i class="fa fa-credit-card"></i>
						<h4 class="card-title">Debts</h4>
					</div>
				</a>
				<div class="card-body">
					<p class="card-text small">Do you like snowballs or avalanches?</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<a href="<?php echo base_url ('PM/retirementForm'); ?>">
					<div class="custom-card-icon inactive-card">
						<i class="fa fa-chart-line"></i>
						<h4 class="card-title">Retirement</h4>
					</div>
				</a>
				<div class="card-body">
					<p class="card-text small">Getting old is expensive and inevitable.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<a href="#">
					<div class="custom-card-icon inactive-card">
						<i class="fa fa-kiwi-bird"></i>
						<h4 class="card-title">Planning / Other</h4>
					</div>
				</a>
				<div class="card-body">
					<p class="card-text small">We'll come back to it later but just wanted to get it down before I forget.</p>
				</div>
			</div>
		</div>
	</div>
</div>