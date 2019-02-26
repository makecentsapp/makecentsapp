<style>
.custom-card-icon {
	width: 125px;
	height: 125px;
	background-color: #1abc9c;
	border-radius: 3px;
	margin: auto;
	color: #fff;
}
.custom-card-icon i, .custom-card-icon a {
	font-size: 42px;
	line-height: 10px;
	margin: auto;
	color: #fff;
	padding-top: 35px;
}
.card-text {
	padding: 10px;
}
</style>
<?php


?>
<br>
<div class="container">
	<p>First screen a user sees after registration. 
	<div class="row">
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="custom-card-icon">
					<a href="<?php echo base_url ('PM/personalForm'); ?>">
						<i class="fa fa-id-card"></i>
						<h4 class="card-title">
							Personal Details
						</h4>
					</a>
				</div>
				<div class="card-body">
					<p class="card-text small small">Some quick info to help us provide you with some perspective.</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="custom-card-icon">
					<a href="<?php echo base_url ('PM/form/income'); ?>">
						<i class="fa fa-money-bill-alt"></i>
						<h4 class="card-title">Income</h4>
					</a>
				</div>
				<div class="card-body">
					<p class="card-text small">How much scratch do you bring in to the coffers?</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="custom-card-icon">
					<a href="<?php echo base_url ('PM/form/assets'); ?>">
						<i class="fa fa-piggy-bank"></i>
						<h4 class="card-title">Assets</h4>
					</a>
				</div>
				<div class="card-body">
					<p class="card-text small">House, car, and bank accounts: totaled up.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="custom-card-icon">
					<a href="<?php echo base_url ('PM/form/expenses'); ?>">
						<i class="fa fa-cash-register"></i>
						<h4 class="card-title">Expenses</h4>
					</a>
				</div>
				<div class="card-body">
					<p class="card-text small">What are you buying and why are you paying so much?</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="custom-card-icon">
					<a href="<?php echo base_url ('PM/form/debts'); ?>">
						<i class="fa fa-credit-card"></i>
						<h4 class="card-title">Debts</h4>
					</a>
				</div>
				<div class="card-body">
					<p class="card-text small">Do you like snowballs or avalanches?</p>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="custom-card-icon">
					<a href="<?php echo base_url ('PM/form/retirement'); ?>">
						<i class="fa fa-chart-line"></i>
						<h4 class="card-title">Retirement</h4>
					</a>
				</div>
				<div class="card-body">
					<p class="card-text small">Getting old is expensive and inevitable.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="custom-card-icon">
					<a href="<?php echo base_url ('PM/form/expenses'); ?>">
						<i class="fa fa-kiwi-bird"></i>
						<h4 class="card-title">Planning / Other</h4>
					</a>
				</div>
				<div class="card-body">
					<p class="card-text small">We'll come back to it later but just wanted to get it down before I forget.</p>
				</div>
			</div>
		</div>
	</div>
</div>