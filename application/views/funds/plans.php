<div class="bg-dark">
    <ol class="breadcrumb my-0 py-0 text-primary bg-dark">
        <li class="breadcrumb-item"><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
        <li class="breadcrumb-item active"><?php echo lang("ctn_273") ?></li>
    </ol>
</div>
<div class="bg-dark">
    <div class="container m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-20 p-b-90">
                <h4>
                    <span class="badge">
                    <i class="fas fa-piggy-bank"></i>
                    </span>
                    <?php echo lang("ctn_273") ?>
                </h4>
                <p class="opacity-75"><?php echo lang("ctn_274") ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container pull-up">
    <div class="row">
        <div class="col-12 m-b-10">
            <div class="db-header-extra"> <a href="<?php echo site_url("funds/payment_log") ?>" class="btn btn-info btn-sm"><?php echo lang("ctn_388") ?></a> <a href="<?php echo site_url("funds") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_245") ?></a>
            </div>
        </div>
        <?php foreach($plans->result() as $r) : ?>
            <div class="col-lg-4 m-b-30">
                <div class="card" style="background: #<?php echo $r->hexcolor ?>; color: #<?php echo $r->fontcolor ?>;">
                    <div class="card-header">
                        <h4 class="card-title m-b-0"><?php echo $r->name ?></h4>
                        <div class="justify-content-center center-text">
                            <div class="plan-icon">
                                <span class="<?php echo $r->icon ?>" style="font-size: 28pt; color: #<?php //echo $r->hexcolor ?>; "></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><?php echo $r->description ?></p>
                        <hr>
                        <?php if($r->days >0) : ?>
                            <p class="text-center"><?php echo $r->days ?> <?php echo lang("ctn_277") ?></p>
                            <?php else : ?>
                                <p class="text-center"><?php echo lang("ctn_283") ?></p>
                        <?php endif; ?>
                        <p class="text-center"><?php echo $this->settings->info->payment_symbol ?><?php echo number_format($r->cost,2) ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo site_url("funds/buy_plan/" . $r->ID . "/" . $this->security->get_csrf_hash()) ?>" class="btn btn-primary btn-block" role="button"><?php echo lang("ctn_284") ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <hr>

        <p><?php echo lang("ctn_248") ?>: <?php echo number_format($this->user->info->points,2) ?></p>

        <?php if($this->user->info->premium_time > 0) : ?>
            <?php $time = $this->common->convert_time($this->user->info->premium_time) ?>
            <p><?php echo lang("ctn_276") ?> <?php echo $this->common->get_time_string($time) ?> <?php echo lang("ctn_281") ?></p>
            <?php elseif($this->user->info->premium_time == -1) : ?>
                <p><?php echo lang("ctn_282") ?></p>
            <?php endif; ?>

        </div>
