<style>
a.node-card>:hover {
    background-color: whitesmoke;
}
.timeline .timeline-item:hover {
	background-color: transparent;
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
.avatar-lg {
    font-size: 48px;
}
.avatar-sm .avatar-title {
    font-size: 24px;
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
//pull data in from controller and setup for use
$data = $this->_ci_cached_vars;
$wel = $data['wel'];
$fin = $data['fin'];
$calcs = $data['calcs'];

//calculate the appropriate next steps, in line with the generation of the nodes when checks are made
global $nextSteps;
$nextSteps = array();
global $i;
$i = 0;
global $c;
$c = 0;
function writeNextStep ($urgency, $type, $message) {
    global $nextSteps;
    global $i;
    $nextSteps[$i]['urgency'] = $urgency;
    $nextSteps[$i]['type'] = $type;
    $nextSteps[$i]['message'] = $message;
    $i++;
}

//gamify variables
$calcs['combo'] = 0;
$calcs['comboCount'] = 0;

function writeCardNode ($type, $data, $check, $title, $text, $interaction) {
    global $counter;
    $counter++;
    echo '<div class="row">
    	<div class="offset-1 col-md-1">';
        	if ($check == 1) {
                echo '<div class="avatar avatar-sm m-b-10">
                            <div class="avatar-title badge-soft-success rounded-circle">
                                <i class="mdi mdi-check"></i>
                            </div>
                        </div>';
            }
            else {
            	echo '<div class="avatar avatar-sm m-b-10">
                            <div class="avatar-title badge-soft-danger rounded-circle">
                            	<span class="fw-600">'.$counter.'</span>
                            </div>
                        </div>';
            }
        	echo '</div>
    	<div class="col-10 node m-b-10">';
    	if (isset($interaction) && !empty($interaction)) {
	    	$url = base_url ('Account/'.$interaction);
	    	echo '<a href="'.$url.'" class="card node-card">';
	    }
	    else {
        	echo '<a class="card node-card">';
        }
            echo '<div class="card-body">
                    <div class="row p-t-10">
                    	
                        <div class="col-md-6">
                            <h5 class="fw-600">'.$title.'</h5>
                            <p class="text-muted">'.$text.'</p>
                            
                        </div>
                        <div class="col-md-4">';
	                        if ($type == 'expense' && !empty($data)) {
	                        	echo '<p class="text-overline opacity-75">You:</p>';
	                        	echo '<p class="h1 fw-600">'.$data.'</p>';
	                        }
	                        else if ($type == 'saving' && !empty($data)) {
	                        	echo '<p class="text-overline opacity-75">You:</p>';
	                        	if (is_array($data) && isset($data['target']) && isset($data['amount'])) {
	                        		if ($data['amount'] > $data['target']) {
	                        			$percentComplete = 100;
	                        		}
	                        		else if ($data['target'] > 0) {
	                        			$percentComplete = ($data['amount'] / $data['target']) * 100;
	                        		}
	                        		else {
	                        			$percentComplete = 0;
	                        		}
	                        		
	                        		echo '<p class="h5 fw-600">$'.number_format($data['amount']).' / $'.number_format($data['target']) .'</p><div class="progress" style="height: 15px">
                                        <div class="progress-bar" role="progressbar" style="width: '.$percentComplete.'%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">'.$percentComplete.'%</div>
                                    </div>';
                                    if (is_array($data) && isset($data['date'])) {
                                    	echo '<br><p class="h5 fw-600">by ' . $data['date'] . '</p>';
                                    }
	                        	}
	                        	else {
	                        		echo '<p class="h1 fw-600">'.$data.'</p>';
	                        	}
	                        }
	                        else if ($type == 'retirement' && !empty($data)) {
	                        	echo '<p class="text-overline opacity-75">You:</p>';
	                        	echo '<p class="h5 fw-600">'.$data.'</p>';
	                        }
	                        else if ($type == 'debt' && !empty($data)) {
	                        	echo '<p class="text-overline opacity-75">You:</p>';
	                        	echo '<p>'.$data.'</p>';
	                        }
                        echo '</div>
                        <div class="col-md-1">';
                            if (isset($interaction) && !empty($interaction)) {
			                	echo '<div class="avatar-lg m-b-10">
			                			<i class="mdi mdi-chevron-right"></i>
			                		  </div>';
			                }
                        echo '</div>
                    </div>
                </div>';
            echo '</a>';
    echo '</div>
    </div>';
}

function writeNodeArray ($level, $type, $data, $check, $title, $text, $interaction) {
	global $nodeArray;
	global $c;
	$c++;
	$nodeArray[$level][$c]['type'] = $type;
	$nodeArray[$level][$c]['data'] = $data;
	$nodeArray[$level][$c]['check'] = $check;
	$nodeArray[$level][$c]['title'] = $title;
	$nodeArray[$level][$c]['text'] = $text;
	$nodeArray[$level][$c]['interaction'] = $interaction;
}

function writeTimelineNode ($title, $text, $icon, $nodeArray) {
    echo '<div class="timeline-item">
        <div class="timeline-wrapper" style="align-items: flex-start;">
            <div class="">
                <div class="avatar avatar-sm">';
                if (isset($icon) && !empty($icon)) {
                    echo '<div class="avatar-title badge-soft-success rounded-circle">
                            <i class="'.$icon.'"></i>
                          </div>';
                }
                else {
                    echo '<div class="avatar-title badge-soft-primary rounded-circle">
                            <i class="mdi mdi-comment-processing-outline"></i>
                          </div>';
                }
                echo '</div>
            </div>
            <div class="col-auto p-t-10">
                <h5 class="fw-600">'.$title.'</h5>
                <p class="text-muted">'.$text.'</p>
            </div>
        </div>';
            foreach ($nodeArray as $node) {
            	writeCardNode ($node['type'],$node['data'],$node['check'],$node['title'],$node['text'],$node['interaction']);
            }
        echo '</div>';
}

global $nodeArray;
$nodeArray = array();

//////////// level 1 //////////

if ($fin['expenses'] != 'not') {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
    //identify if user is failing to pay essential bills or has a poor income to expense ratio
    writeNextStep('critical', 'expense', 'You are in a financial crisis - Either get income up or expenses down so you can pay your bills');
}
writeNodeArray(1, 'expense', '$'.number_format($calcs['housingCost']), $check, 'Pay Rent / Mortgage','Includes renters or homeowners insurance, if required','');
if ($fin['expenses'] != 'not') {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
}
writeNodeArray(1, 'expense', '$'.number_format($calcs['foodExpense']),$check,'Buy Food / Groceries','Depending on the severity of your situiation and needs, you may wish to prioritize utilities before this node','');
/**
 * @todo need a question to quantify this step
 */
if ($fin['expenses'] != 'not') {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
}
writeNodeArray(1, 'expense', '',$check,'Pay Essential Utilities and Items','Power, water, heat, toiletries, etc','');
/**
 * @todo need a question to qualify and quantify this step
 */
if ($fin['expenses'] != 'not') {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
}
writeNodeArray(1, 'expense', '',$check,'Pay Income Earning Expenses','Commute expenses, internet, phone, or anything required to earn income','');
if ($fin['healthInsurance'] > 0) {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
    //identify if user has health care
    writeNextStep('critical', 'expense', 'You need health insurance - the risk of a massive bills due to a unpredicted medical event can be proven with data');
}
writeNodeArray(1, 'expense', '$'.number_format($fin['healthInsurance']),$check,'Pay Health Care','Health insurance and health care expenses','');
if ($calcs['totalMinDebtPayment'] > 0 && $fin['expenses'] != 'not') {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
    //identify if user is meeting minimum debt payments
    writeNextStep('critical', 'debt', 'You need to make the minimum payments on all your debts');
}
writeNodeArray(1, 'expense', '$'.number_format($calcs['totalMinDebtPayment']),$check,'Make Minimum Payments on all Debts & Loans','Student loans, credit cards, etc.','debts');

//////////// level 2 //////////

if ($fin['cashOnHand'] > $calcs['minEmergencyFund']) {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
    writeNextStep('critical', 'saving', 'Start saving as much money as possible into a checking or savings account to cover small emergencies');
}
writeNodeArray(2, 'saving', array('target' => $calcs['minEmergencyFund'], 'amount' => $fin['cashOnHand']), $check,'Save a small emergency fund',"Either $1000 or one months' worth of expenses, whichever is greater",'');

//////////// level 3 //////////

if ($fin['expenses'] != 'not') {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;   
}
/**
 * @todo need a question to qualify this step
 */
writeNodeArray(3, 'expense', '',$check,'Pay any non-essential bills in full','Cable, internet, phone, streaming media, etc.','');

//////////// level 4 //////////

if ($fin['retirementMatch'] == 'yes' && $fin['retirementMatchContribution'] != 'noContribution') {
    $check = 1;
    if ($calcs['combo'] == 0) {
        $calcs['comboCount']++;
    }
}
else {
    $check = 0;
    $calcs['combo'] = 1;
    writeNextStep('critical', 'retirement', 'If your employer offers a retirement match, you should contribute up to it. Essentially a 100% ROI');
}
writeNodeArray(4, 'retirement', $calcs['retirementContribution'],$check,'Contribute up to Employer Match Retirement Plan',"Does your employer offer a retirement account with an employer match? If so, meet the match",'');

//////////// level 5 //////////

$highDebtString = '';
$moderateDebtString = '';
$highDebtCheck = 1;
$moderateDebtCheck = 1;

foreach ($calcs['debts'] as $debt) {
    if ($debt['debtClassification'] == 'high') {
        $highDebtString .= $debt['debtDescription'] . ' - $' . number_format($debt['debtAmount']) . ' @ ' . $debt['debtInterestRate'] . '%<hr>';
        $highDebtCheck = 0;
        
    }
    else if ($debt['debtClassification'] == 'moderate') {
        $moderateDebtString .= $debt['debtDescription'] . ' - $' . number_format($debt['debtAmount']) . ' @ ' . $debt['debtInterestRate'] . '%<hr>';
        $moderateDebtCheck = 0;
        
    }
}
//need to do these two additions to next steps separatly so that it isnt dependent on the order in which the user input their debts
if ($highDebtCheck == 0) {
    writeNextStep('critical', 'debt', 'Reduce your high interest debt to $0 as soon as possible. Cut back on any expenses possible and over pay as much as possible.');
    $calcs['combo'] = 1;
}
else {
	if ($calcs['combo'] == 0) {
	    $calcs['comboCount']++;
	}
	$highDebtString = 'No high interest debts - nice!';
}

writeNodeArray(5, 'debt', $highDebtString,$highDebtCheck,'Pay Off High Interest Debt','Any debt with an interest rate of 10% or higher.','debts');

//////////// level 6 //////////

if ($fin['cashOnHand'] > $calcs['targetEmergencyFund']) {
	$check = 1;
	if ($calcs['combo'] == 0) {
	    $calcs['comboCount']++;
	}
}
else {
	$check = 0;
	$calcs['combo'] = 1;

	writeNextStep('urgent', 'saving', 'Start saving money into a checking or savings account to cover medium-to-large emergencies');
}
writeNodeArray(6, 'saving', array('target' => $calcs['targetEmergencyFund'], 'amount' => $fin['cashOnHand']) ,$check,'Increase emergency fund',"Aim for 3-6 months' living expenses",'');

//////////// level 7 //////////

//need to do these two additions to next steps separatly so that it isnt dependent on the order in which the user input their debts
if ($moderateDebtCheck == 0) {
    writeNextStep('urgent', 'debt', 'Reduce your moderate interest debt to $0 as soon as possible. Cut back on any expenses possible and over pay as much as possible.');
    $calcs['combo'] = 1;
}
else {
	if ($calcs['combo'] == 0) {
	    $calcs['comboCount']++;
	}
	$moderateDebtString = 'No moderate interest debts - nice!';
}
writeNodeArray(7, 'debt', $moderateDebtString,$moderateDebtCheck,'Pay Off Moderate Interest Debt','Any debt with an interest rate of 4% or higher, excluding mortgage.','');

//////////// level 8 //////////

if ($fin['upcomingExpense'] == 'yes') {
	if ($fin['upcomingExpense'] == 'yes' && ($fin['cashOnHand'] - $calcs['targetEmergencyFund']) > $fin['upcomingExpenseAmount']) {
	    $check = 1;
	    if ($calcs['combo'] == 0) {
		    $calcs['comboCount']++;
		}
	}
	else {
	    $check = 0;
	    $calcs['combo'] = 1;

    	writeNextStep('notice', 'saving', 'Put remaining money in a checking or savings account until you have enough for the expense.');
	}
	writeNodeArray(8, 'saving', array('target' => $fin['upcomingExpenseAmount'], 'amount' => $fin['cashOnHand'], 'date' => date('Y-m-d', strtotime($fin['upcomingExpenseDate']))) ,$check,'Save for Upcoming Large Expense',"Meet minimums on debt payments and start saving for the expense. Resume aggressive debt payments after.",'');
}

/**
 * @todo needs a string and check
 */
writeNodeArray(8, 'retirement', 'increaseContribString',0,'Increase Retirement Contributions to 15% of Income','descriptionString.','');

//////////// level 9 //////////
/**
 * @todo needs a string and check
 * @todo needs to be wrapped in an if statement for determing if they have an HSA account
 */
writeNodeArray(9, 'retirement', 'maxHSAString',0,'Max Out HSA Contributions','descriptionString.','');
/**
 * @todo needs a string and check
 */
if ($fin['children'] == 'yes' && $fin['childrenEducation'] == 'yes') {
	writeNodeArray(9, 'retirement', 'ages ' . $fin['childrenAge'],0,"Save for Your Children's College Fund",'descriptionString.','');
}
/**
 * @todo needs a string and check
 */
writeNodeArray(9, 'goal', 'Your goals: '.$fin['goals'],0,'Personal Goals','You made it this far - Now lets prioritize what is important to you!','');


$calcs['mcScore'] = ($calcs['comboCount'] / 20) * 1000;
$calcs['totalNodes'] = 0;
foreach ($nodeArray as $level) {
	$calcs['totalNodes'] += count($level);
}
$calcs['mcScoreBarWidth'] = (($calcs['totalNodes'] / 20) * 1000)/5;
$calcs['scorePercent'] = $calcs['comboCount']/$calcs['totalNodes'];
?>
<script type="text/javascript">
jQuery(document).ready(function($){	
    var options = {
        chart: {
            type: 'bar',
            height: 75,
            stacked: true,
            sparkline: {
		        enabled: true,
		    }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '20%',
            }
        },
        stroke: {
            width: 3,
            colors: ['#fff']
        },
        fill: {
        	colors: ['#bc2126', '#ef4723', '#fff200', '#7dbb42', '#1a9146'],
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            data: [<?php echo $calcs['mcScoreBarWidth']; ?>]
        },{
            data: [<?php echo $calcs['mcScoreBarWidth']; ?>]
        },{
            data: [<?php echo $calcs['mcScoreBarWidth']; ?>]
        },{
            data: [<?php echo $calcs['mcScoreBarWidth']; ?>]
        },{
            data: [<?php echo $calcs['mcScoreBarWidth']; ?>]
        }],
        tooltip: {
        	enabled: false
        },
        annotations: {
            xaxis: [{
	          x: <?php echo $calcs['mcScore']; ?>,
	          borderColor: '#000',
	          label: {
	            style: {
	              fontSize: '10px',
	              color: '#fff',
	              background: '#fff',
	            },
	            offsetY: 10,
	            text: 'You',
	          },
	        }]
	    }
    }
	var chart = new ApexCharts(document.querySelector("#chart"), options);
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
        <div class="container  text-white">
            <div class="row p-b-60 p-t-60">

                <div class="col-md-8 p-b-30">
                    <div class="media">
                        <div class="avatar avatar mr-3">
                            <img src="<?php echo base_url()?>uploads/<?php echo $data['user']->info->avatar; ?>" class="rounded-circle" alt="">
                        </div>
                        <div class="media-body">
                            <h2><?php echo $data['user']->info->first_name; ?></h2>
                            <div class="text-overline opacity-75"><p>
                        		<span class="text-overline opacity-75">Location:</span> <?php if(!empty($fin['location'])) {echo $fin['location'];} else {echo '?';} ?>
                        		<br>
                        		<span class="text-overline opacity-75">Age:</span> <?php if(!empty($calcs['age'])) {echo $calcs['age'];} else {echo '?';} ?>
                        	</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-right">
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
    <div class="container pull-up">
    	<div class="row">
    		<div class="col-md-6">
                <div class="card m-b-30">
                    <div class="card-header">
                    	<div class="avatar avatar-sm m-b-10">
		                    <div class="avatar-title badge-soft-warning rounded-circle">
		                        <i class="mdi mdi-star"></i>
		                    </div>
		                </div>

                		<div class="row">
                        	<div class="col-md-4">
	                            <span class="text-overline opacity-75">MC Score:</span> <?php echo $calcs['mcScore']; ?>
	                        </div>
	                        <div class="col-md-8">
	                            <div id="chart"></div>
	                        </div>
	                    </div>
	                    	
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card m-b-30">
                    <div class="card-header">
                    	<div class="avatar avatar-sm m-b-10">
		                    <div class="avatar-title badge-soft-danger rounded-circle">
		                        <i class="mdi mdi-hexagon-multiple"></i>
		                    </div>
		                </div>
                    	<p class="text-overline opacity-75">Your Next Steps:</p>
                    	<?php 
                    		if (!empty($nextSteps)) {
                    			echo '<ol>';
                    			foreach ($nextSteps as $step) {
                    				if ($step['urgency'] == 'urgent') {
                    					echo '<li><span class="badge badge-pill badge-danger">'.$step['urgency'].'</span> '.$step['message'].'</li>';
                    				}
                    				else if ($step['urgency'] == 'critical') {
                    					echo '<li><span class="badge badge-pill badge-warning">'.$step['urgency'].'</span> '.$step['message'].'</li>';
                    				}
                    				else {
                   						echo '<li><span class="badge badge-pill badge-info">'.$step['urgency'].'</span> '.$step['message'].'</li>';
                    				}
                    				
                    			}
                    			echo '</ol>';
                    		}
                    		else {
                    			echo '<h4>Optimize?</h4>';
                    		}
                    	?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-header">
                    	<div class="avatar avatar-sm m-b-10">
		                    <div class="avatar-title badge-soft-dark rounded-circle">
		                        <i class="mdi mdi-cash"></i>
		                    </div>
		                </div>
                    	<div class="row">
	                    	<div class="col-md-3">
	                    		<h4><span class="text-overline opacity-75">Income:</span> <?php echo '$'.number_format($fin['income']); ?><small> /yr</small></h4>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<h4><span class="text-overline opacity-75">Expenses:</span> <?php echo '$'.number_format($calcs['totalExpenses']*12); ?><small> /yr</small></h4>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<h4><span class="text-overline opacity-75">Debts:</span> <?php echo '$'.number_format($calcs['totalDebt']); ?></h4>
	                    	</div>
	                    	<div class="col-md-3">
	                    		<h4><span class="text-overline opacity-75">Assets:</span> <?php echo '$'.number_format($calcs['totalAssets']); ?></h4>
	                    	</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="timeline">
	    			<!-- $data, $check, $title, $text, $interaction -->
	                <?php
	                writeTimelineNode ('Essential Bills', 'sub description','', $nodeArray[1]);
	                writeTimelineNode ('Small Emergency Fund', 'sub description','', $nodeArray[2]);
	                writeTimelineNode ('Non-Essential Bills', 'sub description','', $nodeArray[3]);
	                writeTimelineNode ('Employer Retirement Match', 'sub description','', $nodeArray[4]);
	                writeTimelineNode ('High Interest Debt', 'sub description','', $nodeArray[5]);
	                writeTimelineNode ('Increase Emergency Fund', 'sub description','', $nodeArray[6]);
	                writeTimelineNode ('Moderate Interest Debt', 'sub description','', $nodeArray[7]);
	                writeTimelineNode ('Start Saving', 'sub description','', $nodeArray[8]);
	                writeTimelineNode ('Niche Buckets', 'sub description','', $nodeArray[9]);

					?>
                </div>
    		</div>
    	</div>
    </div>
</section>