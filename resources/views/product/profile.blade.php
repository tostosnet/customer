<?php

$page_title = 'Product';
$breadcrumb = ["Home", $page_title];
require_once('functions.php');

?>

@push('scripts')
    
    <!-- Theme JS files -->
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/media/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/pages/profile.js') }}"></script>
    <script src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pages/list.js') }}"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

<div class="row product bg-white mb-4 d-lg-flex rounded-lg position-relative m-3">

    <div class="card col-md-6 product-image border-0 d-flex align-items-center m-4 shadow">
        @if ($product->discount)
            <span class="badge badge-danger-100 ml-auto mr-1">-<?= $product->discount ?>%</span>
        @endif
        <div class="card-img-actions border clearfix">
            <img src="<?= asset('storage/'. $product->fimage) ?>" class="rounded-lg card-img-top" height="300">
            <div class="card-img-actions-overlay card-img-top">
                <a href="<?= asset('storage/'. $product->fimage) ?>" class="btn btn-outline-white border-2 glightbox" data-gallery="gallery">Preview</a>
            </div>
        </div>
        <?php if ($product->images) : ?>
            <div class="card-body row pt-1">
                <?php foreach ($product->images as $img) { ?>
                    <div class="col-md-6 col-lg-3 ml-1 border" style="max-width: 32%;">
                        <div class="card-img-actions">
                            <img src="<?= asset('storage/'. $img->path) ?>" class="img-fluid card-img-top">
                            <div class="card-img-actions-overlay card-img-top">
                                <a href="<?= asset('storage/'. $img->path) ?>" class="btn btn-outline-white border-2 glightbox " data-gallery="gallery">Preview</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php endif ?>
    </div>

    <div class="col-md-5 py-4 pr-4 pl-4 pl-lg-0 product-details">
        <h4 class="font-weight-bold d-flex justify-content-between">
            <a href="#" class="text-dark" title="Elegant designed coffee plant for desktop decoration">
                <?= $product->name . " <span style='color:$product->color'>" . ucfirst($product->color) . "</span>" ?>
            </a>
            <a href="#" class="ml-2 text-muted"><i class="fa fa-heart-o"></i></a>
        </h4>
        <div class="d-flex align-items-baseline">
            <h2 class="mr-2"><?= '₦' . numToCurrency(currencyToNum($product->price) * (1 - ($product->discount / 100))) ?></h2>
            <h4 class="text-muted mr-3 font-weight-regular" style="text-decoration: line-through;"><?= $product->price ?></h4>
            <?php if ($product->discount) { ?><h5 class="text-success"><?= $product->discount ?>% off</h5> <?php } ?>
        </div>
        <h4><span class="font-weight-semibold">Initial Price: </span><?= $product->initial_price ?></h4>
        <div class="mb-3">
            <?= $product->description ?>
        </div>
        <div class="text-uppercase mb-2">
            Condition: <small class="text-capitalize font-weight-bold"><?= $product->cond ?></small>
        </div>
        <div class="text-uppercase mb-2">
            Category: <small class="text-capitalize font-weight-bold"><?= $product->category->name ?></small>
        </div>
        <div class="text-uppercase mb-2">
            Serial Number: <small class="text-capitalize font-weight-bold"><?= $product->sn ?></small>
        </div>
        <div class="text-uppercase mb-2">
            Repay Price: <small class="text-capitalize font-weight-bold"><?= $product->repay_price . ' ' . $product->repay_period ?></small>
        </div>
        <div class="text-uppercase mb-2">
            Status: <small class="text-capitalize font-weight-bold"><?= $product->status == 0 ? 'Available' : ($product->status == 1 ? 'On Installment' : ($product->status == 2 ? 'Completed' : '')) ?></small>
        </div>
        <div class="text-uppercase mb-2">
            Free Days: <small class="text-capitalize font-weight-bold"><?= json_decode($product->free_days) ? join(', ', json_decode($product->free_days)) : 'No Free Days' ?></small>
        </div>
        <!-- <button class="btn btn-outline-primary">Add to cart</button> -->
    </div>
</div>

@endsection
