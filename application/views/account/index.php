<style>
.node-card {
	min-height: 150px;

}
a.node-card>:hover {
    background-color: whitesmoke;
}
.card-header {
	border-radius: 3px 3px 0 0;
}
.mdi-48px {
    line-height: 32px;
}
.node .node-bg {
    height: 100%;
}
.node-text {
    padding: 0 10px;
}
.avatar-sm .avatar-title {
    font-size: 30px;
}
.avatar-xs .avatar-title {
    font-size: 18px;
}
#headingOne, #collapseOne .node .node-bg {background-color: midnightblue;}
#headingTwo, #collapseTwo .node .node-bg {background-color: tomato;}
#headingThree, #collapseThree .node .node-bg {background-color: darkgrey;}
#headingFour, #collapseFour .node .node-bg {background-color: orange;}
#headingFive, #collapseFive .node .node-bg {background-color: lightseagreen;}
</style>
<?php
$data = $this->_ci_cached_vars;
$fin = array();
foreach ($data['fin'] as $row) {
    $fin[$row['attribute_name']] = $row['value'];
}

if (!empty($fin['dob'])) {
    $age = date_diff(date_create($fin['dob']), date_create('now'))->y;
}
$foodExpense = 0;
$totalExpenses = 0;
$totalMinDebtPayment = 0;
$totalDebt = 0;
$totalAssets = 0;
//add up expenses, might need tweaking in the future
if ($fin['housing'] == 'rent') {
    $totalExpenses += $fin['rentAmount'];
}
if ($fin['foodExpense'] == 'customAmount') {
    $foodExpense += $fin['customFood'];
}
else {
    $foodExpense += $fin['foodExpense'];
}
$totalExpenses += $foodExpense;
if ($fin['car'] !== 'noCar') {
    $totalExpenses += $fin['carInsurance'];
}
$totalExpenses += $fin['healthInsurance'];

//add up debts
if (!empty($fin['debtMinimum'])) {
    $totalMinDebtPayment = array_sum(explode(',', $fin['debtMinimum']));
}
if (!empty($fin['debtAmount'])) {
    $totalDebt = array_sum(explode(',', $fin['debtAmount']));
}

//add up assets
if (!empty($fin['cashOnHand'])) {
    $totalAssets += $fin['cashOnHand'];
}
if ($fin['car'] !== 'noCar') {
    $totalAssets += $fin['carValue'];
}
if (!empty($fin['retirementSavings'])) {
    $totalAssets += $fin['retirementSavings'];
}

function writeNode ($data, $check, $title, $text, $interaction) {
	global $counter;
	$counter++;
    echo '<div class="col-md-4 node m-b-10">';
        echo '<a href="#" class="card node-card">';
            echo '<div class="card-body">
	            	<div class="row">
                        <div class="col-md-8">
                            <p class="fw-600 opacity-75">'.$counter.'</p>
                        </div>';
	            		
                if ($check == 1) {
                    echo '<div class="col-md-4 my-auto text-right">
                            <div class="avatar avatar-xs m-b-10">
			                    <div class="avatar-title badge-soft-success rounded-circle">
			                        <i class="mdi mdi-check"></i>
			                    </div>
			                </div>
                        </div>';
                }
                echo '</div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="fw-600">'.$title.'</h5>
                        </div>
                    </div>
                	<div class="row">
                		<div class="col-md-12">
                			<p class="text-muted">'.$text.'</p>
                            <p>'.$data.'</p>
                		</div>
                	</div>
            	</div>';
        	echo '</a>';
    echo '</div>';
}

?>
<script type="text/javascript">
jQuery(document).ready(function($){	

    var options = {
      chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      series: [{
        name: "$",
        data: [<?php echo rtrim($incomeGraphData, ","); ?>]
      }],
      title: {
        text: 'Income growth over time',
        align: 'left'
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
      	type: 'datetime',
        categories: [<?php echo rtrim($incomeGraphTimeline, ",'") . "'"; ?>],
        labels: {
        	show: true,
            rotate: -45,
            datetimeFormatter: {
                year: 'yyyy',
                month: "MMM 'yy",
                day: 'dd MMM',
                hour: 'HH:mm',
            },
        }
      }
    }

    var chart = new ApexCharts(
      document.querySelector("#incomeChart"),
      options
    );

    chart.render();

//interface for toggling all accordian at once
    $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.show').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
      console.log(numPanelOpen);
    } else {
      closeAllPanels(accordionId);
      console.log(numPanelOpen);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".show")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.show').collapse('hide');
  }

});
</script>

<section class="admin-content">
    <div class="bg-dark m-b-30">
        <div class="container">
            <div class="row p-b-60 p-t-60">

                <div class="col-md-6 text-white p-b-30">
                    <div class="media">
                        <div class="avatar avatar mr-3">
                            <img src="<?php echo base_url()?>uploads/<?php echo $data['user']->info->avatar; ?>" class="rounded-circle" alt="">
                        </div>
                        <div class="media-body">
                            <h2><?php echo $data['user']->info->first_name; ?></h2>
                            <div class="text-overline opacity-75"></div>
                            <div class="row">
                            	<div class="col-md-6">
		                            <ul>
		                            	<li><span class="text-overline opacity-75">Welcome Check:</span> <?php if(!empty($data['decimal'])) {echo 'Yes';} else {echo 'No';} ?></li>
		                            	<li><span class="text-overline opacity-75">Net Worth:</span> ?</li>
		                            </ul>
		                        </div>
		                        <div class="col-md-6">
		                            <ul>
		                            	<li><span class="text-overline opacity-75">Location:</span> <?php if(!empty($fin['location'])) {echo $fin['location'];} else {echo '?';} ?></li>
		                            	<li><span class="text-overline opacity-75">Age:</span> <?php if(!empty($age)) {echo $age;} else {echo '?';} ?></li>
		                            </ul>
		                        </div>
		                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-right text-white">
                    <div>
                        <div class="text-overline opacity-75 m-b-10">Enter the biz:</div>
                        <a class="text-underline" href="<?php echo base_url ('Account/welcome3'); ?>">Welcome Form ></a>
                        <br/>
                        <a class="text-underline" href="<?php echo base_url ('Account/main'); ?>">Main Form ></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container pull-up text-center">
    	<div class="row">
    		<div class="col-md-3">
                <div class="card m-b-30">
                    <div class="card-header">
                    	<div class="avatar avatar-sm m-b-10">
		                    <div class="avatar-title badge-soft-success rounded-circle">
		                        <i class="mdi mdi-cash"></i>
		                    </div>
		                </div>
                    	<p class="text-overline opacity-75">Income</p>
                    	<h4><?php echo '$'.number_format($fin['income']); ?><small> /yr</small></h4>
                        <h6><?php echo '$'.number_format($fin['income']*.88); ?><small> /yr after tax</small></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card m-b-30 text-center">
                    <div class="card-header">
                    	<div class="avatar avatar-sm m-b-10">
		                    <div class="avatar-title badge-soft-dark rounded-circle">
		                        <i class="mdi mdi-cookie"></i>
		                    </div>
		                </div>
                    	<p class="text-overline opacity-75">Expenses</p>
                    	<h4><?php echo '$'.number_format($totalExpenses*12); ?><small> /yr</small></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card m-b-30">
                    <div class="card-header">
                    	<div class="avatar avatar-sm m-b-10">
		                    <div class="avatar-title badge-soft-danger rounded-circle">
		                        <i class="mdi mdi-bank"></i>
		                    </div>
		                </div>
                    	<p class="text-overline opacity-75">Debts</p>
                    	<h4><?php echo '$'.number_format($totalDebt); ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card m-b-30">
                    <div class="card-header">
                    	<div class="avatar avatar-sm m-b-10">
		                    <div class="avatar-title badge-soft-warning rounded-circle">
		                        <i class="mdi mdi-hexagon-multiple"></i>
		                    </div>
		                </div>
                    	<p class="text-overline opacity-75">Assets</p>
                    	<h4><?php echo '$'.number_format($totalAssets); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="accordion-option">
                            <a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#dashAccordian">		<small>Expand/Collapse All</small>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="dashAccordian">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <a href="#!" class="d-block collapsed text-white text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" data-parent="#dashAccordian">
                                            Level One: The Essentials
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse show" aria-labelledby="headingOne" style="">
                                    <div class="card-body row">
                                        <!-- $data, $check, $title, $text, $interaction -->
                                        <?php
                                        switch ($fin['housing']) {
                                            case 'rent':
                                                $housingCost = $fin['rentAmount'];
                                                break;
                                            case 'mortgage':
                                            /**
                                             * @todo mortgage question needs to be revisisted to understand what the monthly payment amounts are, so then we can evaluate if it fits into a budget
                                             */
                                                $housingCost = $fin['mortgageAmount'];
                                                break;
                                            case 'paidOff':
                                                $housingCost = $fin['propertyTaxes'];
                                                break;
                                            case 'free':
                                                $housingCost = 0;
                                                break;
                                        }
                                        if ($fin['expenses'] != 'not') {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                        }

                                        writeNode('$'.number_format($housingCost), $check, 'Pay Rent / Mortgage','Includes renters or homeowners insurance, if required','');
                                        writeNode('$'.number_format($foodExpense),$check,'Buy Food / Groceries','Depending on the severity of your situiation and needs, you may wish to prioritize utilities before this node','');
                                        writeNode('',$check,'Pay Essential Utilities and Items','Power, water, heat, toiletries, etc','');
                                        writeNode('',$check,'Pay Income Earning Expenses','Commute expenses, internet, phone, or anything required to earn income','');
                                        if ($fin['healthInsurance'] > 0 && $fin['expenses'] != 'not') {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                        }
                                        writeNode('$'.number_format($fin['healthInsurance']),$check,'Pay Health Care','Health insurance and health care expenses','');
                                        if ($totalMinDebtPayment > 0 && $fin['expenses'] != 'not') {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                        }
                                        writeNode('$'.number_format($totalMinDebtPayment),$check,'Make Minimum Payments on all Debts & Loans','Student loans, credit cards, etc.','');
										?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a href="#!" class="d-block collapsed text-white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" data-parent="#dashAccordian">
                                            Level Two: Short-Term Stability
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse show" aria-labelledby="headingTwo" style="">
                                    <div class="card-body row">
                                        <!-- percentage, title, text, interaction (modal or url) -->
                                        <?php
                                        writeNode(0,0,'Save $1000 for an emergency fund',"Either $1000 or one months' worth of expenses, whichever is greater",'');
                                        writeNode(0,0,'Pay any non-essential bills in full','Cable, internet, phone, streaming media, etc.','');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <a href="#!" class="d-block collapsed text-white" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" data-parent="#dashAccordian">
                                            Level Three: Foundations of Success
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse show" aria-labelledby="headingThree">
                                    <div class="card-body row">
                                        <!-- percentage, title, text, interaction (modal or url) -->
                                        <?php
                                        writeNode(0,0,'Save for Retirement',"Does your employer offer a retirement account with an employer match?",'Account');
                                        writeNode(0,0,'Pay Off High Interest Debt','Any debt with an interest rate of 10% or higher.<br><br>Evaluate merits between avalanche and snowball.','');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <a href="#!" class="d-block collapsed text-white" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" data-parent="#dashAccordian">
                                            Level Four: Long-Term Stability
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse show" aria-labelledby="headingFour">
                                    <div class="card-body row">
                                    	<!-- percentage, title, text, interaction (modal or url) -->
                                        <?php
                                        writeNode(0,0,'Increase emergency fund',"Aim for 3-6 months' living expenses",'Account');
                                        writeNode(0,0,'Pay Off Moderate Interest Debt','Any debt with an interest rate of 4-5% or higher, excluding mortgage.','');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h5 class="mb-0">
                                        <a href="#!" class="d-block collapsed text-white" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" data-parent="#dashAccordian">
                                            <i class="mdi mdi-lock"></i> Level Five: Building Wealth
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse show" aria-labelledby="headingFive">
                                    <div class="card-body">
                                        <div class="alert alert-border-success" role="alert">
                                            <div class="d-flex">
                                                <div class="icon">
                                                    <i class="icon mdi mdi-alert-circle-outline"></i>
                                                </div>
                                                <div class="content">
                                                    <strong>Holy guacamole!</strong><br>This section is locked until you complete the steps above.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3>welcome Decimal:</h3>
                        <?php
                        if (!empty($data['decimal'])) {
		                    foreach ($data['decimal'] as $record) {
		                    	echo '<p class="text-muted">';
		                    	echo $data['translation'][$record['attribute_id']] . ' = ' . $record['value'];
		                    	echo '</p>';
		                    }
		                }
		                else {
		                	echo 'Go fill out the welcome form';
		                }
                        ?>
           			</div>
               	</div>
            </div>
            <div class="col-md-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3>main data:</h3>
                        <?php
                        if (!empty($fin)) {
	                        echo '<pre>';
                            var_dump($fin);
                            echo '</pre>';
	                    }
		                else {
		                	echo 'Go fill out the main form';
		                }
                        ?>
           			</div>
               	</div>
            </div>
        </div>
	    <div class="row m-b-10">
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
	                <div class="card-body text-center" id="incomeBlock">
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
	                <div class="card-body text-center" id="debtsBlock">
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
        <div class="row">
            <div class="col-lg-4 order-1 order-lg-0 m-b-30">
                <div class="card m-b-30">

                    <div class="card-header">
                        <div class="card-title">
                            <div class="avatar mr-2 avatar-xs">
                                <div class="avatar-title bg-primary rounded-circle">
                                    <i class="fas fa-question"></i>
                                </div>
                            </div>
                            More Questions
                        </div>

                    </div>
                    <div class="list-group list  list-group-flush">

                        <div class="list-group-item p-all-15 h6 ">
                            <i class="fas fa-anchor"></i><a href="#" class="text-underline"> How much yacht can you afford?</a>
                        </div>
                        <div class="list-group-item p-all-15 h6 ">
                            <i class="fas fa-gem"></i><a href="#" class="text-underline"> Are you planning on getting married?</a>
                        </div>
                        <div class="list-group-item p-all-15 h6 ">
                            <i class="fas fa-car"></i><a href="#" class="text-underline"> What is the true annual cost of your car?</a>
                        </div>
                        <div class="list-group-item p-all-15 h6 ">
                            <i class="fas fa-paw"></i><a href="#" class="text-underline"> Thinking about getting a pet?</a>
                        </div>

                    </div>
                </div>
                

            </div>
            <div class="col-lg-8 m-b-30">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Timeline</div>

                        <div class="card-controls">
                            <select class="custom-select">
                                <option value="">Everything</option>
                                <option value="">Charges</option>
                                <option value="">Upgrades</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="assets/img/logos/stripe.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Charged undefined</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">June 2, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="mdi mdi-account-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Account Upgraded</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">June 12, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-danger rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Support Ticket Opened</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">July 16, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="mdi mdi-check-all"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Ticket Resolved</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">July 20, 2018</div>

                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="assets/img/logos/stripe.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Payement Method: Stripe</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Aug 19, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-primary rounded-circle">
                                                <i class="mdi mdi-magnet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Join Development Group</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Sep 25, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="badge badge-soft-danger">
                                        Account Under Review
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Sep 10, 2018</div>
                                </div>


                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-info rounded-circle">
                                                <i class="mdi mdi-buffer"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Switched to Atoms</h6>

                                    </div>
                                    <div class="ml-auto col-auto text-muted">Oct 12, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="assets/img/logos/mailchimp.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Opened Newsletters</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Nov 13, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="assets/img/logos/instagram.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6 class="p-t-10">Uploaded Images</h6>
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <img src="assets/img/social/1.jpg" class="w-25" alt="">
                                                <img src="assets/img/social/2.jpg" class="w-25" alt="">
                                                <img src="assets/img/social/3.jpg" class="w-25" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Jan 5, 2017</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-warning rounded-circle">
                                                <i class="mdi mdi-magnet"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Free Plan Selected</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Dec 2, 2018</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="assets/img/logos/vimeo.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6 class="p-t-10">Shared Video</h6>
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe src="https://player.vimeo.com/video/265045525?color=f15f5f&amp;title=0&amp;byline=0&amp;portrait=0" width="640" height="360"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Jan 5, 2017</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" src="assets/img/logos/google.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Joined atmos</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">Jan 5, 2017</div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>