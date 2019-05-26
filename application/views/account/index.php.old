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
$CI_vars = $this->_ci_cached_vars;

$incomeGraphData = '';
$incomeGraphTimeline = "'";
if (!empty($CI_vars['decimal'])) {
	foreach ($CI_vars['decimal'] as $record) {
		if ($record['attribute_id'] == 2) {
			$incomeGraphData .= $record['value'] . ',';
			$incomeGraphTimeline .= date('Y-m-d h:i:s', strtotime($record['date_added'])) . "','";
			$mostRecentIncome = $record['value'];
		}
	}
}
if (!empty($CI_vars['varchar'])) {
	foreach ($CI_vars['varchar'] as $key => $value) {
		$varchars[$CI_vars['translation'][$value['attribute_id']]] = $value['value'];
	}
}
//var_dump($varchars);

$welcomeFormPercentage = 100;
$personalFormPercentage = 1;
$incomeFormPercentage = 50;
$assetsFormPercentage = 30;
$expensesFormPercentage = 0;
$debtsFormPercentage = 0;
$retirementFormPercentage = 0;

$welcomeModalContent = array(
    'id' => 'welcomeModal', 
    'style' => 'modal-slide-right', 
    'title' => 'The welcome form', 
    'body' => '<p>If you got to this point you already finished it, great job!</p>
        <div class="alert alert-info" role="alert">
                                modal-slide-right
                            </div>'
    );
$personalModalContent = array(
    'id' => 'personalModal', 
    'style' => 'modal-bottom-right', 
    'title' => 'Personal details', 
    'body' => '<p>Age and location are important factors in giving you accurate feedback.</p>
        <div class="alert alert-info" role="alert">
                                modal-bottom-right
                            </div>'
    );
$incomeModalContent = array(
    'id' => 'incomeModal', 
    'title' => 'Income details', 
    'body' => '<p>In the welcome questionaire you provided your annual income. To better understand your financial health, we need both pre and post tax amounts so that we know what your weekly take-home pay is.</p>
        <div class="row">
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div id="incomeChart" class="apexcharts-canvas"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-info" role="alert">
                                no style supplied (default)
                            </div>'
    );
$expensesModalContent = array(
    'id' => 'expensesModal', 
    'style' => 'modal-top-right', 
    'img' => '/assets/img/rich-c.jpg', 
    'body' => '<h4>No need to spend like a baller</h4><p>How much you spend on groceries, essential bills, and income earning expenses.</p>
        <div class="alert alert-info" role="alert">
                                modal-top-right
                            </div>'
    );
$healthModalContent = array(
    'id' => 'healthModal', 
    'style' => 'modal-lg', 
    'body' => '<h1>Why is this important?</h1>
<p>Healthcare costs past retirement age are expensive! In addition to this, unhealthy lifestyles can have a negative effect on your current financial situation. There is already a lot of overlap between personal finance and lifestyle choices, so lets take a look at some immediate improvements you can make for your future.</p>

<h2>Reducing your Risk of Heart Disease (Cost $3,000 - $38,501)</h2>
<p>Leading a healthy lifestyle is the biggest way to reduct your risk of heart disease. Among these lifestyle choices:</p>
<ul>
<li>Not using tobacco (Source 1, Source 2, Source 3)</li>

<li>Being physically active (Same sources as above)</li>

<li>Maintaining a healthy weight (Same sources as above)</li>

<li>Making healthy food choices (Same sources as above)</li>

<li>Stress management (Source)</li>
</ul>
<p>Some of the above also have a side effect of immediate financial impact:</p>
<ul>
<li>Not using tobacco: $1,610 - $3,750 per year (Source)</li>

<li>Making healthy food choices: comparative savings of $14 per meal (fast food, family of 4) (Source)</li>
</ul>
Reducing your Risk of Cancer (Cost $19,901 - $60,885 per annum)
The lifestyle choices below have been shown to reduce the risk of cancer:

Not using tobacco (Source 1, Source 2, Source 3, Source 4)

Maintaining a healthy weight (Same sources as above)

Limiting alcohol intake (Same sources as above)

Get screened for cancer and/or Hepatitis C (Same sources as above)

Protect yourself from the sun (Same sources as above)

Note that a few of these are carried over from the first section on heart disease! There are some immediate financial impacts of reducing your alcohol intake: You can save about $750 USD per year by going dry.

Reducing chronic lower respiratory diseases (Cost $6,000 more in medical care than those without)
The lifestyle choices below have been shown to reduce the risk of COPD:

Not smoking (Source 1, Source 2, Source 3)

Avoid respiratory infections and get vaccinated (Same sources as above)

Avoid home and workplace air pollutants, lung irritants, or dust (Same sources as above)

Exercise regularly to improve your breathing

Address allergic conditions'
    );

function writeNode ($percentage, $title, $text, $interaction) {
	global $counter;
	$counter++;
    echo '<div class="col-md-4 node m-b-10">';
        if (isset($interaction['id']) && isset($interaction['body'])) {
        	//if no style is set at all for the modal, just use a generic center align
        	if (!isset($interaction['style']) || empty($interaction['style'])) {
	            $interaction['style'] = '';
	        }
            echo '<a href="#" class="card node-card" data-toggle="modal" data-target="#'.$interaction['id'].'">';
            echo '<div class="modal fade '.$interaction['style'].' show" id="'.$interaction['id'].'" tabindex="-1" role="dialog" aria-labelledby="'.$interaction['id'].'Label" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">';
                        if (isset($interaction['title'])) {
                            echo '<div class="modal-header">
                                <h5 class="modal-title" id="'.$interaction['id'].'Label">'.$interaction['title'].'</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
                        }
                        else if (isset($interaction['img'])) {
                            echo '<div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <img src="'.base_url($interaction['img']).'" class="rounded-top" alt="'.$interaction['id'].'">
                                    </div>';
                        }
                        else {
                            echo '<div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                    </button>
                                </div>';
                        }
                            echo '<div class="modal-body">
                                '.$interaction['body'].'
                                </div>
                            </div>
                    </div>
                </div>';
        }
        elseif (!is_array($interaction)) {
            echo '<a href="'. base_url ($interaction) . '" class="card node-card">';
        }
        elseif (empty($interaction)) {
        	echo '<a href="#" class="card node-card">';
        }
            /*if ($percentage > 0) {
                echo '<div class="node-bg" style="width: '.$percentage.'%"></div>';
            }*/
            echo '<div class="card-body">
	            	<div class="row">
                        <div class="col-md-8">
                            <p class="fw-600 opacity-75">'.$counter.'</p>
                        </div>';
	            		
                if ($percentage == 100) {
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
                            <img src="<?php echo base_url()?>uploads/<?php echo $CI_vars['user']->info->avatar; ?>" class="rounded-circle" alt="">
                        </div>
                        <div class="media-body">
                            <h2><?php echo $CI_vars['user']->info->first_name; ?></h2>
                            <div class="text-overline opacity-75"></div>
                            <div class="row">
                            	<div class="col-md-6">
		                            <ul>
		                            	<li><span class="text-overline opacity-75">Welcome Check:</span> <?php if(!empty($CI_vars['decimal'])) {echo 'Yes';} else {echo 'No';} ?></li>
		                            	<li><span class="text-overline opacity-75">Net Worth:</span> ?</li>
		                            </ul>
		                        </div>
		                        <div class="col-md-6">
		                            <ul>
		                            	<li><span class="text-overline opacity-75">Location:</span> ?</li>
		                            	<li><span class="text-overline opacity-75">DOB:</span> ?</li>
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
                    	<h4><?php echo '$'.number_format($mostRecentIncome); ?></h4>
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
                    	<h4><?php echo '$'.$varchars['expenses']; ?></h4>
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
                    	<h4><?php echo $varchars['debts']; ?></h4>
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
                    	<h4><?php echo $varchars['retirement']; ?></h4>
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
                                        <!-- percentage, title, text, interaction (modal or url) -->
                                        <?php
                                        writeNode(100,'Pay Rent / Mortgage','Includes renters or homeowners insurance, if required',$welcomeModalContent);
                                        writeNode(100,'Buy Food / Groceries','Depending on the severity of your situiation and needs, you may wish to prioritize utilities before this node',$personalModalContent);
                                        writeNode(100,'Pay Essential Utilities and Items','Power, water, heat, toiletries, etc',$expensesModalContent);
                                        writeNode(100,'Pay Income Earning Expenses','Commute expenses, internet, phone, or anything required to earn income',$expensesModalContent);
                                        writeNode(0,'Pay Health Care','Health insurance and health care expenses',$healthModalContent);
                                        writeNode(100,'Make Minimum Payments on all Debts & Loans','Student loans, credit cards, etc.',$expensesModalContent);
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
                                        writeNode(0,'Save $1000 for an emergency fund',"Either $1000 or one months' worth of expenses, whichever is greater",$expensesModalContent);
                                        writeNode(0,'Pay any non-essential bills in full','Cable, internet, phone, streaming media, etc.',$expensesModalContent);
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
                                        writeNode(0,'Save for Retirement',"Does your employer offer a retirement account with an employer match?",'Account');
                                        writeNode(0,'Pay Off High Interest Debt','Any debt with an interest rate of 10% or higher.<br><br>Evaluate merits between avalanche and snowball.','');
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
                                        writeNode(0,'Increase emergency fund',"Aim for 3-6 months' living expenses",'Account');
                                        writeNode(0,'Pay Off Moderate Interest Debt','Any debt with an interest rate of 4-5% or higher, excluding mortgage.',$expensesModalContent);
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
                        if (!empty($CI_vars['decimal'])) {
		                    foreach ($CI_vars['decimal'] as $record) {
		                    	echo '<p class="text-muted">';
		                    	echo $CI_vars['translation'][$record['attribute_id']] . ' = ' . $record['value'];
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
                        <h3>welcome VarChar:</h3>
                        <?php
                        if (!empty($CI_vars['varchar'])) {
	                        foreach ($CI_vars['varchar'] as $record) {
	                        	echo '<p class="text-muted">';
	                        	echo $CI_vars['translation'][$record['attribute_id']] . ' = ' . $record['value'];
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