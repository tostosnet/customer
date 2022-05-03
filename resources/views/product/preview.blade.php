<?php require_once('functions.php'); ?>

<div class="col-12 mb-2 p-0">
    <div class="card mb-0">
        <div class="card-img-actions clearfix">
            <img src="<?= asset('storage/'.$product->fimage) ?>" alt="<?= asset('storage/'.$product->fimage) ?>" class=" card-img-top">
            <div class="card-img-actions-overlay card-img-top">
                <a href="<?= asset('storage/'.$product->fimage) ?>" class="btn btn-outline-white border-2 glightbox" data-gallery="gallery">Preview</a>
            </div>
        </div>
        <?php if ($product->images) : ?>
            <div class="card-body row">
                <?php foreach ($product->images as $img) { ?>
                    <div class="col-md-6 col-lg-3 rounded border border-1" style="max-width: 32%;">
                        <div class="card-img-actions">
                            <img src="<?= asset('storage/'.$img->name) ?>" alt="<?= asset('storage/'.$img->name) ?>" class="img-fluid card-img-top">
                            <div class="card-img-actions-overlay card-img-top">
                                <a href="<?= asset('storage/'.$img->name) ?>" class="btn btn-outline-white border-2 glightbox " data-gallery="gallery">Preview</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php endif ?>
    </div>
</div>
<!-- about section -->
<div class="col-lg-6 pl-0">
    <div class="card mb-2 mb-0">
        <div class="card-header bg-primary-100 border-0">
            <h2 class="font-weight-semibold m-0"><small>About <?= $product->name ?></small></h2>
        </div>
        <div class="card-body">
            <p class="mb-3"><?= $product->description ? ucfirst($product->description) : 'No description' ?></p>
            <p class="pb-2"><span class="d-inline-block font-weight-semibold" style="width:30%">Color: </span><span style="color:<?= $product->color ?>"><?= ucfirst($product->color) ?></span></p>
            <p class="pb-2"><span class="d-inline-block font-weight-semibold" style="width:30%">Condition: </span><span><?= $product->cond ?></span></p>
            <?php if ($product->cond != 'New') { ?> 
                <p class="pb-2"><span class="d-inline-block font-weight-semibold" style="width:30%">Reciept: </span><span class="mr-3"><?= $product->receipt ? 'Yes' : 'No' ?></span>Since: <span><?= $product->month_old ?></span></p> 
            <?php } ?>
            <p class=""><span class="d-inline-block font-weight-semibold" style="width:30%">Category: </span><span><?= $product->category->name . ' | ' . $product->category->parent->name ?></span></p>
        </div>
    </div>
</div>

    <!-- installment section -->
<div class="col-lg-6 p-0">
    <div class="card mb-2 text-capitalize">
        <div class="card-header bg-primary-100 border-0">
            <h2 class="font-weight-semibold m-0"><small>Installment Details</small></h2>
        </div>
        <div class="card-body">
            <p class="pb-2"><span class="d-inline-block font-weight-semibold w-50">Installment Price: </span><?= '₦'.$product->price ?></p>
            <p class="pb-2"><span class="d-inline-block font-weight-semibold w-50">Repayment Price: </span><span><?= '₦'.$product->repay_price ?></span></p>
            <p class="pb-2"><span class="d-inline-block font-weight-semibold w-50">Repayment Period: </span><span><?= ucfirst($product->repay_period) ?></span></p>
            <?php if ($product->repay_period == 'daily') { ?> 
                <p class="pb-2"><span class="d-inline-block font-weight-semibold w-50">Free days: </span><span><?= $product->free_days ? $product->free_days : 'No free days' ?></span>
            <?php } ?>
            <p class="pb-2"><span class="d-inline-block font-weight-semibold w-50">Discount: </span><span><?= $product->discount ? $product->discount.'%' : 'No discount' ?></span></p>
            <p class=""><span class="d-inline-block font-weight-semibold w-50">Total Price To Pay: </span><span><?php 
                if ($product->discount) {
                    $price = currencyToNum($product->price);
                    $total_price = $price - (($product->discount/100) * $price);
                    echo '₦'.numToCurrency($total_price);
                } else echo '₦'.$product->price ?></span></p>
        </div>
    </div>
</div>
<div class="w-100 text-center mb-3 mt-3">
    <button class="btn btn-success w-25" type="submit">Submit Product</button>
</div>

