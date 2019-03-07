<style>
.guide-item {
	min-height: 250px;
}
.card-header {
	border-radius: 3px 3px 0 0;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function($){	
	var options= {
		chart:{
			height:350,
			type:"radialBar"
		},
		plotOptions:{
			radialBar:{
				startAngle:-90,
				endAngle:90,
				dataLabels:{
					name:{
						show:false
					},
					value:{
						offsetY:0,
						fontSize:"22px"
					}
				}
			}
		},
		fill:{
			type:"gradient",
			gradient:{
				shade:"dark",
				shadeIntensity:.15,
				inverseColors:false,
				opacityFrom:1,
				opacityTo:1,
				stops:[0,50,65,91]
			}
		},
		stroke:{
			dashArray:4
		},
		series:[67]
	};
	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
});
</script>
<?php
$CI_vars = $this->_ci_cached_vars;
echo '<pre>';
foreach ($CI_vars['personalRows']->result() as $value) {
	$personalFormPercentage = ($value->countOfPersonalAttributes / $value->countOfPopulatedPersonalAttributes)*100;
	$incomeFormPercentage = 50;
	$assetsFormPercentage = 0;
	$expensesFormPercentage = 0;
	$debtsFormPercentage = 0;
	$retirementFormPercentage = 0;

}
echo '</pre>';
?>
<br>
<div class="container p-t-20">
	<div class="row">
		<div class="col-lg-12">
			<p>before anything else - <a href="<?php echo base_url ('Account/welcome'); ?>">Onboarding Questionaire</a></p>
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 my-auto">
                            <h2>Welcome <?php echo $CI_vars['user']->info->first_name; ?></h2>
                            <p class="text-muted">
                                First screen a user sees after registration. Probably something up here about expectations, i.e. 5 mins per survey and then you are on your way to being a millionaire.
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div id="chart" class="apexcharts-canvas"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="container pull-up">
	    <div class="row m-b-90">
	        <div class="col-lg-4 col-md-6">
	            <a href="<?php echo base_url ('Account/personalForm'); ?>" class="card shadow-lg guide-item m-b-30">
	                <div class="card-header bg-primary text-white">
	                    <h4 class=" p-t-20 ">Personal Details</h4>
	                    <p>Some quick info to help us provide you with some perspective.</p>
	                </div>
	                <div class="card-body text-center">
		                <div class="progress" style="height: 10px">
	                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php echo $personalFormPercentage; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
	                    </div>
	                    <p><small><?php echo $personalFormPercentage . '% of questions answered.'; ?></small></p>
	                    <button type="button" class="btn btn-primary btn-rounded">
	                    <?php
	                    if ($personalFormPercentage == 0) {
	                    	echo 'Start Now';
	                    }
	                    else {
	                    	echo 'Edit Answers';
	                    }
	                    ?>
	                    </button>
	                </div>
	            </a>
	            <a href="<?php echo base_url ('Account/incomeForm'); ?>" class="card shadow-lg guide-item m-b-30">
	                <div class="card-header bg-warning text-white">
	                    <h4 class=" p-t-20 ">Expenses</h4>
	                    <p>What are you buying and why are you paying so much?</p>
	                </div>
	                <div class="card-body text-center">
		                <div class="progress" style="height: 10px">
	                        <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: <?php echo $expensesFormPercentage; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
	                    </div>
	                    <p><small><?php echo $expensesFormPercentage . '% of questions answered.'; ?></small></p>
	                    <button type="button" class="btn btn-warning btn-rounded">
	                    <?php
	                    if ($expensesFormPercentage == 0) {
	                    	echo 'Start Now';
	                    }
	                    else {
	                    	echo 'Edit Answers';
	                    }
	                    ?>
	                    </button>
	                </div>
	            </a>
	        </div>
	        <div class="col-lg-4 col-md-6">
	        	<a href="<?php echo base_url ('Account/incomeForm'); ?>" class="card shadow-lg guide-item m-b-30">
	                <div class="card-header bg-success text-white">
	                    <h4 class=" p-t-20 ">Income</h4>
	                    <p>How much scratch do you bring in to the coffers?</p>
	                </div>
	                <div class="card-body text-center">
		                <div class="progress" style="height: 10px">
	                        <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: <?php echo $incomeFormPercentage; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
	                    </div>
	                    <p><small><?php echo $incomeFormPercentage . '% of questions answered.'; ?></small></p>
	                    <button type="button" class="btn btn-success btn-rounded">
	                    <?php
	                    if ($incomeFormPercentage == 0) {
	                    	echo 'Start Now';
	                    }
	                    else {
	                    	echo 'Edit Answers';
	                    }
	                    ?>
	                    </button>
	                </div>
	            </a>
	            <a href="<?php echo base_url ('Account/incomeForm'); ?>" class="card shadow-lg guide-item m-b-30">
	                <div class="card-header bg-danger text-white">
	                    <h4 class=" p-t-20 ">Debts</h4>
	                    <p>Do you like snowballs or avalanches?</p>
	                </div>
	                <div class="card-body text-center">
		                <div class="progress" style="height: 10px">
	                        <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: <?php echo $debtsFormPercentage; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
	                    </div>
	                    <p><small><?php echo $debtsFormPercentage . '% of questions answered.'; ?></small></p>
	                    <button type="button" class="btn btn-danger btn-rounded">
	                    <?php
	                    if ($debtsFormPercentage == 0) {
	                    	echo 'Start Now';
	                    }
	                    else {
	                    	echo 'Edit Answers';
	                    }
	                    ?>
	                    </button>
	                </div>
	            </a>
	        </div>
	        <div class="col-lg-4 col-md-6">
	            <a href="<?php echo base_url ('Account/assetsForm'); ?>" class="card shadow-lg guide-item m-b-30">
	                <div class="card-header bg-dark text-white">
	                    <h4 class=" p-t-20 ">Assets</h4>
	                    <p>House, car, and bank accounts: totaled up.</p>
	                </div>
	                <div class="card-body text-center">
		                <div class="progress" style="height: 10px">
	                        <div class="progress-bar bg-dark progress-bar-striped" role="progressbar" style="width: <?php echo $assetsFormPercentage; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
	                    </div>
	                    <p><small><?php echo $assetsFormPercentage . '% of questions answered.'; ?></small></p>
	                    <button type="button" class="btn btn-dark btn-rounded">
	                    <?php
	                    if ($assetsFormPercentage == 0) {
	                    	echo 'Start Now';
	                    }
	                    else {
	                    	echo 'Edit Answers';
	                    }
	                    ?>
	                    </button>
	                </div>
	            </a>
	            <a href="<?php echo base_url ('Account/assetsForm'); ?>" class="card shadow-lg guide-item m-b-30">
	                <div class="card-header bg-info text-white">
	                    <h4 class=" p-t-20 ">Retirement</h4>
	                    <p>Getting old is expensive and inevitable.</p>
	                </div>
	                <div class="card-body text-center">
		                <div class="progress" style="height: 10px">
	                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: <?php echo $retirementFormPercentage; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
	                    </div>
	                    <p><small><?php echo $retirementFormPercentage . '% of questions answered.'; ?></small></p>
	                    <button type="button" class="btn btn-info btn-rounded">
	                    <?php
	                    if ($retirementFormPercentage == 0) {
	                    	echo 'Start Now';
	                    }
	                    else {
	                    	echo 'Edit Answers';
	                    }
	                    ?>
	                    </button>
	                </div>
	            </a>
	        </div>
	    </div>
	</div>
</div>