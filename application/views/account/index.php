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

$calcs = array(
    'totalExpenses' => 0,
    'foodExpense' => 0,
    'totalAssets' => 0,
    );

if (!empty($fin['dob'])) {
    $calcs['age'] = date_diff(date_create($fin['dob']), date_create('now'))->y;
}

//add up expenses, might need tweaking in the future
switch ($fin['housing']) {
    case 'rent':
        $calcs['housingCost'] = $fin['rentAmount'];
        break;
    case 'mortgage':
    /**
     * @todo mortgage question needs to be revisisted to understand what the monthly payment amounts are, so then we can evaluate if it fits into a budget
     */
        $calcs['housingCost'] = $fin['mortgageAmount'];
        break;
    case 'paidOff':
        $calcs['housingCost'] = $fin['propertyTaxes'];
        break;
    case 'free':
        $calcs['housingCost'] = 0;
        break;
}
if ($fin['housing'] == 'rent') {
    $calcs['totalExpenses'] += $fin['rentAmount'];
}
if ($fin['foodExpense'] == 'customAmount') {
    $calcs['foodExpense'] += $fin['customFood'];
}
else {
    $calcs['foodExpense'] += $fin['foodExpense'];
}
$calcs['totalExpenses'] += $calcs['foodExpense'];
if ($fin['car'] !== 'noCar') {
    $calcs['totalExpenses'] += $fin['carInsurance'];
}
$calcs['totalExpenses'] += $fin['healthInsurance'];

//add up debts
if (!empty($fin['debtMinimum'])) {
    $calcs['totalMinDebtPayment'] = array_sum(explode(',', $fin['debtMinimum']));
}
if (!empty($fin['debtAmount'])) {
    $calcs['totalDebt'] = array_sum(explode(',', $fin['debtAmount']));
}
//get the debt stuff into a useable format and also classify the risk of the debt
$countDebt = count(explode(',', $fin['debtAmount']));
$i = 0;
$debtDescriptions = explode(',', $fin['debtDescription']);
$debtAmounts = explode(',', $fin['debtAmount']);
$debtInterestRates = explode(',', $fin['debtInterestRate']);
$debtMinimums = explode(',', $fin['debtMinimum']);
while ($i < $countDebt) {
    $calcs['debts'][$i]['debtDescription'] = ucwords(str_replace('_', ' ', array_shift($debtDescriptions)));
    $calcs['debts'][$i]['debtAmount'] = array_shift($debtAmounts);
    $calcs['debts'][$i]['debtInterestRate'] = array_shift($debtInterestRates);
    $calcs['debts'][$i]['debtMinimum'] = array_shift($debtMinimums);
    if ($calcs['debts'][$i]['debtInterestRate'] >= 10) {
        $calcs['debts'][$i]['debtClassification'] = 'high';
    }
    else {
        $calcs['debts'][$i]['debtClassification'] = 'moderate';
    }
    $i++;
}


$calcs['minEmergencyFund'] = $calcs['totalExpenses'] + $calcs['totalMinDebtPayment'];
if ($calcs['minEmergencyFund'] < 1000) {
    $calcs['minEmergencyFund'] = 1000;
}
$calcs['targetEmergencyFund'] = $calcs['minEmergencyFund'] * 3;

//add up assets
if (!empty($fin['cashOnHand'])) {
    $calcs['totalAssets'] += $fin['cashOnHand'];
}
if ($fin['car'] !== 'noCar') {
    $calcs['totalAssets'] += $fin['carValue'];
}
if (!empty($fin['retirementSavings'])) {
    $calcs['totalAssets'] += $fin['retirementSavings'];
}

//retirement
switch ($fin['retirementMatchContribution']) {
    case 'noContribution':
        $calcs['retirementContribution'] = 'I dont contribute at all';
        break;
    case 'contributionMatch':
        $calcs['retirementContribution'] = 'I contribute up to the employer match';
        break;
    case 'contributionAbove':
        $calcs['retirementContribution'] = 'I contribute above the employer match';
        break;
    case 'contributionUnknown':
        $calcs['retirementContribution'] = 'I dont know';
        break;
}

//calculate the appropriate next steps, in line with the generation of the nodes when checks are made
global $nextSteps;
$nextSteps = array();
global $i;
$i = 0;
function writeNextStep ($urgency, $type, $message) {
    global $nextSteps;
    global $i;
    $nextSteps[$i]['urgency'] = $urgency;
    $nextSteps[$i]['type'] = $type;
    $nextSteps[$i]['message'] = $message;
    $i++;
}


function writeNode ($data, $check, $title, $text, $interaction) {
    global $counter;
    $counter++;
    echo '<div class="col-md-4 node m-b-10">';
        echo '<a href="#" class="card node-card">';
            echo '<div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="fw-600 opacity-75">'.$counter.'</p>
                        </div>';
                        
                if ($check == 1) {
                    echo '<div class="col my-auto text-right">
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
		                            	<li><span class="text-overline opacity-75">Age:</span> <?php if(!empty($calcs['age'])) {echo $calcs['age'];} else {echo '?';} ?></li>
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
                    	<h4><?php echo '$'.number_format($calcs['totalExpenses']*12); ?><small> /yr</small></h4>
                        <h6><?php echo round((($calcs['totalExpenses']*12)/($fin['income']*.88))*100,0); ?>%<small> of post tax income</small></h6>
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
                    	<h4><?php echo '$'.number_format($calcs['totalDebt']); ?></h4>
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
                    	<h4><?php echo '$'.number_format($calcs['totalAssets']); ?></h4>
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
                                        if ($fin['expenses'] != 'not') {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                            //identify if user is failing to pay essential bills or has a poor income to expense ratio
                                            writeNextStep('critical', 'expense', 'You are in a financial crisis - Either get income up or expenses down so you can pay your bills');
                                        }

                                        writeNode('$'.number_format($calcs['housingCost']), $check, 'Pay Rent / Mortgage','Includes renters or homeowners insurance, if required','');
                                        writeNode('$'.number_format($calcs['foodExpense']),$check,'Buy Food / Groceries','Depending on the severity of your situiation and needs, you may wish to prioritize utilities before this node','');
                                        /**
                                         * @todo need a question to quantify this step
                                         */
                                        writeNode('',$check,'Pay Essential Utilities and Items','Power, water, heat, toiletries, etc','');
                                        /**
                                         * @todo need a question to qualify and quantify this step
                                         */
                                        writeNode('',$check,'Pay Income Earning Expenses','Commute expenses, internet, phone, or anything required to earn income','');
                                        if ($fin['healthInsurance'] > 0) {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                            //identify if user has health care
                                            writeNextStep('critical', 'expense', 'You need health insurance - the risk of a massive bills due to a unpredicted medical event can be proven with data');
                                        }
                                        writeNode('$'.number_format($fin['healthInsurance']),$check,'Pay Health Care','Health insurance and health care expenses','');
                                        if ($calcs['totalMinDebtPayment'] > 0 && $fin['expenses'] != 'not') {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                            //identify if user is meeting minimum debt payments
                                            writeNextStep('critical', 'debt', 'You need to make the minimum payments on all your debts');
                                        }
                                        writeNode('$'.number_format($calcs['totalMinDebtPayment']),$check,'Make Minimum Payments on all Debts & Loans','Student loans, credit cards, etc.','');
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
                                        <!-- $data, $check, $title, $text, $interaction -->
                                        <?php
                                        if ($fin['cashOnHand'] > $calcs['minEmergencyFund']) {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                            writeNextStep('critical', 'saving', 'Start saving as much money as possible into a checking or savings account to cover small emergencies');
                                        }
                                        writeNode('$'.number_format($calcs['minEmergencyFund']),$check,'Save $1000 for an emergency fund',"Either $1000 or one months' worth of expenses, whichever is greater",'');
                                        if ($fin['expenses'] != 'not') {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;   
                                        }
                                        /**
                                         * @todo need a question to qualify this step
                                         */
                                        writeNode('',$check,'Pay any non-essential bills in full','Cable, internet, phone, streaming media, etc.','');
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
                                        <!-- $data, $check, $title, $text, $interaction -->
                                        <?php
                                        if ($fin['retirementMatch'] == 'yes' && $fin['retirementMatchContribution'] != 'noContribution') {
                                            $check = 1;
                                        }
                                        else {
                                            $check = 0;
                                            writeNextStep('critical', 'retirement', 'If your employer offers a retirement match, you should contribute up to it. Essentially a 100% ROI');
                                        }
                                        writeNode($calcs['retirementContribution'],$check,'Save for Retirement',"Does your employer offer a retirement account with an employer match?",'Account');

                                        $highDebtString = '';
                                        $moderateDebtString = '';
                                        $highDebtCheck = 1;
                                        $moderateDebtCheck = 1;

                                        foreach ($calcs['debts'] as $debt) {
                                            if ($debt['debtClassification'] == 'high') {
                                                $highDebtString .= $debt['debtDescription'] . ' - $' . number_format($debt['debtAmount']) . ' @ ' . $debt['debtInterestRate'] . '%';
                                                $highDebtCheck = 0;
                                                
                                            }
                                            else if ($debt['debtClassification'] == 'moderate') {
                                                $moderateDebtString .= $debt['debtDescription'] . ' - $' . number_format($debt['debtAmount']) . ' @ ' . $debt['debtInterestRate'] . '%';
                                                $moderateDebtCheck = 0;
                                                
                                            }
                                        }
                                        //need to do these two additions to next steps separatly so that it isnt dependent on the order in which the user input their debts
                                        if ($highDebtCheck == 0) {
                                            writeNextStep('critical', 'debt', 'Reduce your high interest debt to $0 as soon as possible.');  
                                        }
                                        if ($moderateDebtCheck == 0) {
                                            writeNextStep('urgent', 'debt', 'Reduce your moderate interest debt to $0 as soon as possible.'); 
                                        }
                                        writeNode($highDebtString,$highDebtCheck,'Pay Off High Interest Debt','Any debt with an interest rate of 10% or higher.<br><br>Evaluate merits between avalanche and snowball.','');
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
                                    	<!-- $data, $check, $title, $text, $interaction -->
                                        <?php
                                        if ($fin['cashOnHand'] > $calcs['targetEmergencyFund']) {
                                            $check = 1;
                                            $emergencyFundString = '~$' . number_format($calcs['targetEmergencyFund']);
                                        }
                                        else {
                                            $check = 0;
                                            $emergencyFundString = '$' . number_format($fin['cashOnHand']) . ' / ' . '$' . number_format($calcs['targetEmergencyFund']);

                                            writeNextStep('urgent', 'saving', 'Start saving money into a checking or savings account to cover medium-to-large emergencies');
                                        }
                                        writeNode($emergencyFundString,$check,'Increase emergency fund',"Aim for 3-6 months' living expenses",'Account');
                                        writeNode($moderateDebtString,$moderateDebtCheck,'Pay Off Moderate Interest Debt','Any debt with an interest rate of 4-5% or higher, excluding mortgage.','');
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
            <div class="col-md-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3>calc'd data:</h3>
                        <?php
                        if (!empty($calcs)) {
                            echo '<pre>';
                            var_dump($calcs);
                            echo '</pre>';
                        }
                        else {
                            echo 'Go fill out the main form';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3>next steps:</h3>
                        <?php
                        if (!empty($nextSteps)) {
                            echo '<pre>';
                            var_dump($nextSteps);
                            echo '</pre>';
                        }
                        else {
                            echo 'no next steps for user';
                        }
                        ?>
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