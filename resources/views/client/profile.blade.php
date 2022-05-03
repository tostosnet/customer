<?php
$page_title = 'Client';
$breadcrumb = ["Home", $page_title];
require_once('functions.php');

?>

@push('scripts')
    
    <!-- Theme JS files -->
    <link href="<?= asset('css/profile.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?= asset('js/plugins/forms/inputs/inputmask.js') ?>"></script>
    <script src="<?= asset('js/plugins/tables/datatables/datatables.min.js') ?>"></script>
    <script src="<?= asset('js/plugins/media/glightbox.min.js') ?>"></script>
    <script src="<?= asset('js/pages/profile.js') ?>"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

<div class="content">
    <!-- profile header -->
    <div class="p-3 bg-white shadow m-2">
        <div class="img-thumbnail mr-3 d-inline-block position-relative">
            <a href="<?= asset('storage/'.$client->photo) ?>" class="img-link" target="__blank">
                <img src="<?= asset('storage/'.$client->photo) ?>" alt="User Image" class="shadow" width="100px" height="100px">
            </a>
        </div>
        <div class="d-inline-block" style="vertical-align: middle">
            <h4 class="mb-1 font-weight-semibold text-capitalize"><?= $client->surname.' '.$client->first_name.' '.$client->second_name ?></h4>
            <div class="">
                <a href="mailto:<?= $client->email ?>" class="btn btn-danger-100 btn-outline-danger btn-icon rounded-pill" data-popup="tooltip" data-original-title="Send mail"><i class="icon-envelop"></i></a>
                
                <a href="tel:<?= join('', explode('-', $client->phone_number)) ?>" class="btn btn-success-100 text-success border-success btn-icon rounded-pill ml-2" data-popup="tooltip" data-original-title="Call client"><i class="icon-phone2"></i></a>
                
                <a href="<?= route('chat', [$client->id]) ?>" class="btn btn-secondary-100 btn-outline-secondary btn-icon rounded-pill ml-2" data-popup="tooltip" data-original-title="Chat client"><i class="icon-bubble2"></i></a>
            </div>
            {{-- <a href="" class="btn btn-danger rounded-circle btn-float mr-2 p-2">
                <i class="" style="font-size: 20px"></i></a>
            <a href="" class="btn btn-success rounded-circle btn-float mr-2 p-2"><i class="" style="font-size: 20px"></i></a>
            <a href="" class="btn btn-info rounded-circle btn-float p-2">
                <i class="icon-bubble2" style="font-size: 20px"></i></a> --}}
        </div>
    </div>

    <div class="d-sm-flex mb-2 ml-2 mr-2">

        <!-- profile sidebar -->
        <div class="profile-tab-nav shadow mr-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                    <i class="fa fa-home text-center mr-1"></i>
                    Account
                </a>
                <a class="nav-link" id="payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="payment" aria-selected="false">
                    <i class="fa fa-credit-card text-center mr-1"></i>
                    Payments
                </a>
                <a class="nav-link" id="location-tab" data-toggle="pill" href="#location" role="tab" aria-controls="location" aria-selected="false">
                    <i class="fa fa-map-marker text-center mr-1"></i>
                    Location
                </a>
                <a class="nav-link" id="product-tab" data-toggle="pill" href="#product" role="tab" aria-controls="product" aria-selected="false">
                    <i class="fa fa-shopping-bag text-center mr-1"></i>
                    Products
                </a>
                <a class="nav-link" id="grt-tab" data-toggle="pill" href="#grt" role="tab" aria-controls="guarantors" aria-selected="false">
                    <i class="fa fa-users text-center mr-1"></i>
                    Guarantors
                </a>
                <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">
                    <i class="fa fa-cog text-center mr-1"></i>
                    Settings
                </a>
            </div>
        </div>

        <div class="card tab-content mb-0 border-0 bg-transparent" id="v-pills-tabContent">

            {{-- display errors if any --}}
            @if ($errors->all())
                <div class="alert alert-danger font-weight-semibold p-3 bg-white mb-2">
                    <button type="button" class="close error-remove" aria-label="Close" onclick="this.parentNode.style.display='none'">
                        <span aria-hidden="true">×</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type: none">
                            {{ $error }}
                        </li>
                    @endforeach
                </div>
            @endif
            
            {{-- Account section --}}
            <div class="tab-pane fade show active mb-4" id="account" role="tabpanel" aria-labelledby="account-tab">
                <form action="<?= route('client.update', [$client->id]) ?>" method="post" enctype="multipart/form-data">
                    @csrf
                    <h3 class="p-3 shadow bg-white">Account Information</h3>
                    <div class="p-3 mt-2 shadow bg-white">

                        <!-- name -->
                        <div class="row">
                            <h5 class="section-title col-12 mt-2 font-weight-semibold">Name</h5>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" value="<?= $client->surname ?>" required />
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="<?= $client->first_name ?>" required />
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Second Name</label>
                                    <input type="text" name="second_name" class="form-control @error('second_name') is-invalid @enderror" value="<?= $client->second_name ?>">
                                    @error('second_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="custom-select" required>
                                        <option value="">Select gender</option>
                                        <option value="male" <?= ($client->gender == 'male') ? 'selected' : '' ?>>Male</option>
                                        <option value="female" <?= ($client->gender == 'female') ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Marital Status</label>
                                    <select name="marital_status" class="custom-select" required>
                                        <option value="">Select status</option>
                                        <option value="single" <?= ($client->marital_status == 'single') ? 'selected' : '' ?>>Single</option>
                                        <option value="married" <?= ($client->marital_status == 'married') ? 'selected' : '' ?>>Married</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- contact section --}}
                        <div class="row">
                            <h5 class="section-title col-12 mt-2 font-weight-semibold">Contact</h5>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="<?= $client->email ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="<?= $client->phone_number ?>" placeholder="9999 999 9999" data-mask="9999 999 9999" maxlength="13" required>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone number 2</label>
                                    <input type="tel" name="phone_number2" class="form-control @error('phone_number2') is-invalid @enderror" value="<?= $client->phone_number2 ?>" placeholder="9999 999 9999" data-mask="9999 999 9999" maxlength='13'>
                                    @error('phone_number2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- address --}}
                        <div class="row">
                            <h5 class="section-title col-12 mt-2 font-weight-semibold">Address</h5>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="custom-select text-capitalize" required>
                                        <option value="">Select state</option>
                                        <?php
                                        for ($i = 0; $i < count($keys); $i++) {
                                            $label = $keys[$i] ?>
                                            <optgroup label="<?= strtoupper($label) ?>">
                                                <?php
                                                for ($j = 0; $j < count($states); $j++) {
                                                    $ltr = str_split(strtolower($states[$j]->name))[0];
                                                    if ($ltr == $label) { ?>
                                                            <option value="<?= $states[$j]->id ?>" <?= ($states[$j]->id == $client->state) ? 'selected' : '' ?>>
                                                            <?= $states[$j]->name ?></option>
                                                        <?php }
                                                        if ($ltr > $label) break;
                                                } ?>
                                            </optgroup>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="<?= $client->city ?>" required />
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Street</label>
                                    <input type="text" name="street" class="form-control @error('street') is-invalid @enderror" value="<?= $client->street ?>" required />
                                    @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ID card type --}}
                        <div class="row">
                            <h5 class="section-title col-12 mt-2 font-weight-semibold">Identity Card</h5>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>ID Card Type: <span class="text-danger">*</span></label>
                                    <select name="id_type" class="custom-select" required>
                                        <option value="">Select ID type</option>
                                        <option value="national" <?= ($client->id_type == 'national') ? 'selected' : '' ?>>National ID</option>
                                        <option value="voters" <?= ($client->id_type == 'voters') ? 'selected' : '' ?>>Voters Card</option>
                                        <option value="school" <?= ($client->id_type == 'school') ? 'selected' : '' ?>>School ID</option>
                                        <option value="international" <?= ($client->id_type == 'international') ? 'selected' : '' ?>>International Passport</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ID card number -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>ID Card Number: <span class="text-danger">*</span></label>
                                    <input type="text" name="id_number" value="<?= $client->id_number ?>" class="form-control @error('id_number') is-invalid @enderror" pattern="[A-Za-z0-9 ,]*" required>
                                    @error('id_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- ID issue date -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>ID Issue Date: <span class="text-danger">*</span></label>
                                    <input type="date" name="id_issue_date" class="form-control @error('id_issue_date') is-invalid @enderror" min="1990-12-31" max="<?= date('Y-m-d'); ?>" value="<?= $client->id_issue_date ?>" required>
                                    @error('id_issue_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- ID expiry date -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>ID Expiry Date:</label>
                                    <input type="date" name="id_expiry_date" class="form-control @error('id_expiry_date') is-invalid @enderror" min="<?= date('Y-m-d'); ?>" max="<?= add_date('now', '10 years'); ?>" value="<?= $client->id_expiry_date ?>">
                                    @error('id_expiry_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- documents section --}}
                    <div class="mt-2 p-3 shadow bg-white">
                        <div class="row">
                            <h3 class="section-title col-12 mt-2 mb-3">Uploaded Documents</h3>
                            {{-- id photo --}}
                            <div class="col-md-4">
                                <div class="file-preview" id="id_photo">
                                    <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="file-drop-zone clearfix">

                                        <div class="file-drop-zone-title p-2" <?= $client->id_photo ? 'style="display: none;"' : '' ?>>No ID Card Photo Uploaded</div>

                                        <div class="file-preview-thumbnails clearfix">
                                            <?php if ($client->id_photo) { ?>
                                                <div class="card m-0">
                                                    <a href="<?= asset('storage/'.$client->id_photo) ?>" target="__blank">
                                                        <img class="card-img-top" src="<?= asset('storage/'.$client->id_photo) ?>" style="max-height: 200px;">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">ID Card</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- form photo --}}
                            <div class="col-md-4">
                                <div class="file-preview" id="form_photo">
                                    <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="file-drop-zone clearfix">

                                        <div class="file-drop-zone-title p-2" <?= $client->form_photo ? 'style="display: none;"' : '' ?>>No Form Photo Uploaded</div>

                                        <div class="file-preview-thumbnails clearfix">
                                            <?php if ($client->form_photo) { ?>
                                                <div class="card m-0">
                                                    <a href="<?= asset('storage/'.$client->form_photo) ?>" target="__blank">
                                                        <img class="card-img-top" src="<?= asset('storage/'.$client->form_photo) ?>" style="max-height: 200px;">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Form</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- signature photo --}}
                            <div class="col-md-4">
                                <div class="file-preview" id="signature_photo">

                                    <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    <div class="file-drop-zone clearfix">

                                        <div class="file-drop-zone-title p-2" <?= $client->signature_photo ? 'style="display: none;"' : '' ?>>No Signature Photo Uploaded</div>

                                        <div class="file-preview-thumbnails clearfix">
                                            <?php if ($client->signature_photo) { ?>
                                                <div class="card m-0">
                                                    <a href="<?= asset('storage/'.$client->signature_photo) ?>" target="__blank">
                                                        <img class="card-img-top" src="<?= asset('storage/'.$client->signature_photo) ?>" style="max-height: 200px;">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Signature</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-2 d-flex justify-content-center">
                        <button class="btn btn-success pr-4 pl-4 p-2" name="submit" type="submit">Update Profile</button>
                    </div>
                </form>
            </div>

            {{-- Payment section --}}
            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">

                <div class="header-elements-inline p-3 mt-2 shadow bg-white mb-2">
                    <h3 class="mb-0">Payments</h3>
                    <div class="header-elements">
                        <span class="">Total rows:</span>
                        <span class="font-weight-bold text-danger ml-2" id="total_rows"><?= isset($total_rows) ? $total_rows : 0 ?></span>
                        <div class="list-icons ml-3">
                            <div class="dropdown">
                                <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item"><i class="icon-sync"></i> Refresh table</a>
                                    <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a>
                                    <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 shadow bg-white">
                    <table class="table">
                        <thead>
                            <tr class="center">
                                <th style="width:10px">PID</th>
                                <th class="sort">Payment <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="sort">Total Paid <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="sort">Balance <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="sort">Date <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="sort">Time <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="text-center" id="table-hide" style="width: 20px;">Actions</th>
                            </tr>
                        </thead>

                        <?php if ($payments) { ?>
                            <tbody>
                                <?php foreach ($payments as $payment) { ?>
                                    <tr>
                                        <td class="font-size-lg font-weight-bold text-center">
                                            <?= $payment->id ?>
                                        </td>
                                        <td>
                                            <span class="text-secondary font-weight-bold font-size-lg">₦<?= numToCurrency($payment->amount) ?></span>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">₦<?= numToCurrency($payment->total_paid) ?></h6>
                                        </td>
                                        <td>
                                            ₦<?= numToCurrency($payment->balance) ?>
                                        </td>
                                        <td>
                                            <?= format_date($payment->date, 'd') ?>
                                        </td>
                                        <td>
                                            <?= format_date($payment->time, 't') ?>
                                        </td>
                                        <td class="text-center actions">
                                            <div class="list-icons">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="dropdown-item view"><i class="icon-eye"></i> View full info</div>
                                                        <div class="dropdown-item delete"><i class="icon-bin text-danger"></i> Delete payment</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        <?php } ?>
                    </table>

                    <div id="table-placeholder" <?= ($payments) ? "style='display:none; font-size: 16px;'" : '' ?>>
                        <p class="text-center p-3">No Payment Made Yet by this Client</p>
                    </div>
                </div>
                <!-- <div class="mt-5">
                    <button class="btn btn-success">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </div> -->
            </div>

            {{-- location section --}}
            <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                <h3 class="mb-4">Client Location</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Two-factor auth</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="recovery">
                                <label class="form-check-label" for="recovery">
                                    Recovery
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-success">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </div>
            </div>

            {{-- Product section --}}
            <div class="tab-pane fade mb-4" id="product" role="tabpanel" aria-labelledby="product-tab">
                <h3 class="p-3 shadow bg-white">All Products</h3>

                <div class="card border-0 mt-2 shadow">
                    {{-- <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title">All Products</h6>
                    </div> --}}

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead style="min-height: 60px">
                                <tr>
                                    <th colspan="2" class="text-center">Product Name</th>
                                    <th>Colour</th>
                                    <th>Price</th>
                                    <th>Repay Price</th>
                                    <th>Period</th>
                                    <th>Free Days</th>
                                    <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($products) {
                                    foreach ($products as $product) { ?>
                                        <tr>
                                            <td class="pr-0" style="width: 45px;">
                                                <a href="<?= asset('storage/'.$product->fimage) ?>" target="__blank">
                                                    <img class="rounded" src="<?= asset('storage/'.$product->fimage) ?>" alt="" height="70">
                                                </a>
                                            </td>
                                            <td class="font-weight-semibold"><?= $product->name ?>
                                                <div class="text-muted font-size-sm">
                                                    <span class="badge badge-mark bg-secondary border-dark mr-1"></span>
                                                    <?= $product->category->name ?>
                                                </div>
                                            </td>
                                            <td class="text-capitalize">
                                                <?= $product->color ?></td>
                                            <td>
                                                <?= '₦' . $product->price ?></td>
                                            <td>
                                                <?= '₦' . $product->repay_price ?></td>
                                            <td class="text-capitalize">
                                                <?= $product->repay_period ?></td>
                                            <td>
                                                <?= ucwords($product->free_days) ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <a href="<?= route('product.profile', [$product->id]) ?>"><i class="icon-eye text-dark" data-popup="tooltip" data-original-title="View Product" data-placement="left"></i></a>
                                                    <a href="#" class="return_product" data-id="<?= $product->id ?>"><i class="radio-check icon-radio-unchecked" data-popup="tooltip" data-original-title="Mark as returned" data-placement="left"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4 mb-2">
                    <button class="btn btn-primary btn-labeled btn-labeled-left" id="add_pro_btn" onclick="document.getElementById('product_cont').classList.toggle('d-none')"><b><i class="icon-add"></i></b> Add Product
                    </button>
                </div>

                {{-- available product list --}}
                <div class="mt-4 text-center bg-white shadow pt-3 d-none" id="product_cont">
                    <form action="<?= route('order.create', [$client->id]) ?>" method="post">
                        @csrf
                        <h5>Available Products</h5>
                        <select name="product_id" id="new_product" class="custom-select w-lg-50" onchange="getProduct(this)">
                            @if ($availProducts)
                                <option value="">Select a product</option>
                                @foreach ($availProducts as $pro)
                                    <option value="{{ $pro->id }}">{{ $pro->name }}
                                    </option>
                                @endforeach
                            @else <option value="">No Available Product</option>
                            @endif
                        </select>
                        <div class="row text-left mt-4 m-2" id="product_view">
                            <!-- product goes here -->
                        </div>
                    </form>
                </div>
            </div>

            {{-- Guarantor section --}}
            <div class="tab-pane fade" id="grt" role="tabpanel" aria-labelledby="grt-tab">
                <h3 class="p-3 shadow bg-white">Guarantors</h3>

                <div class="card border-0 mb-0 mt-2 shadow">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="">Photo</th>
                                    <th colspan="1" class="">Name</th>
                                    <th class="">Email Address</th>
                                    <th class="">Phone Number</th>
                                    <th class="">Address</th>
                                    <th class="">Gender</th>
                                    <th class="">Verified</th>
                                    <th class="text-center" style="width: 20px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($guarantors) {
                                    foreach ($guarantors as $grt) { ?>
                                        <tr>
                                            <td class="pr-0" style="width: 45px;">
                                                <a href="<?= asset('storage/'.$grt->photo) ?>" target="__blank">
                                                    <img class="rounded-circle" src="<?= asset('storage/'.$grt->photo) ?>" alt="" height="50">
                                                </a>
                                            </td>
                                            <td class="font-weight-semibold">
                                                <a href="<?= route('grt.profile', [$grt->id]) ?>" class="text-black">
                                                <?= ucwords($grt->surname . ' ' . $grt->first_name . ' ' . $grt->second_name) ?></a>
                                            </td>
                                            <td class="">
                                                <a href="mailto:<?= $grt->email ?>"><?= $grt->email ?></a>
                                            </td>
                                            <td class="text-capitalize">
                                                <a href="tel:<?= $grt->phone_number ?>"><?= $grt->phone_number ?></a><?= $grt->phone_number2 ? " | <a href='tel:$grt->phone_number2'>$grt->phone_number2</a>" : '' ?>
                                            </td>
                                            <td class="">
                                                <span class=""><?= $grt->street . ', ' . $grt->city . ', ' . $grt->state ?></span>
                                            </td>
                                            <td class="">
                                                <span class=""><?= ucfirst($grt->gender) ?></span>
                                            </td>
                                            <td class="">
                                                <span class=""><?= $grt->verified ? '<i class="icon-check text-success"  data-popup="tooltip" data-original-title="Verified"></i>' : '<i class="icon-cross2 text-danger"  data-popup="tooltip" data-original-title="Not Verified"></i>' ?></span>
                                            </td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <form action="<?= route('client.del.grt', [$client->id, $grt->id]) ?>" method="post" class="d-inline-block">
                                                        @csrf
                                                        <a href="#" class="text-danger" onclick="confirmAction('You are about to Delete A Guarantor for this Client. This Action cannot be Undone', 'Confirm Delete', delGrt, 'Delete', this)" data-popup="tooltip" data-original-title="Delete Guarantor" data-placement="left">
                                                        <i class="icon-bin"></i></a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                                </tr>
                            </tbody>
                        </table>

                        <div id="table-placeholder" <?= (!$guarantors) ?: "style='display:none; font-size: 16px;'" ?>>
                            <p class="text-center p-3">No Guarantor Registered for this Client</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-2">
                    <a href="<?= route('grt.form', ['cid' => $client->id]) ?>" class="btn btn-primary btn-labeled btn-labeled-left" id="add_grt_btn"><b><i class="icon-add"></i></b> Add New Guarantor</a>
                    <?php if ($guarantors) { ?>
                        <form action="<?= route('client.del.grt.all', [$client->id]) ?>" method="post" class="d-inline-block">
                            @csrf
                            <button type="button" class="btn btn-danger btn-labeled btn-labeled-left ml-2" onclick="confirmAction('Are you sure you want to Delete All Guarantors for this Client?', 'Confirm Delete', delGrt, 'Delete', this)"><b><i class="icon-bin"></i></b> Delete All Guarantors</button>
                        </form>
                    <?php } ?>
                </div>
            </div>

            {{-- Settings section --}}
            <div class="tab-pane fade mb-4" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <h3 class="p-3 shadow bg-white">Settings</h3>

                <!-- profile picture -->
                <div class="p-3 mt-2 shadow bg-white">
                    <div class="row">
                        <h5 class="mb-3 col-12">Update Client Photos</h5>
                        {{-- user photo --}}
                        <div class="col-lg-3">
                            <form action="<?= route('client.photo.update', [$client->id]) ?>" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="file-preview" id="photo">
                                    <div class="file-drop-zone clearfix">
                                        <div class="file-preview-thumbnails clearfix">
                                            <?php if ($client->photo) { ?>
                                                <div class="card m-0">
                                                    <a href="<?= asset('storage/'.$client->photo) ?>" target="__blank">
                                                        <img class="card-img-top" src="<?= asset('storage/'.$client->photo) ?>" style="max-height: 200px;">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">User Photo</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="btn btn-primary btn-block photo btn-file" tabindex="500">
                                    <i class="icon-file-plus mr-2"></i>
                                    <span class="hidden-xs"><?= $client->photo ? 'Change' : 'Browse' ?></span>
                                </div>
                                <input type="file" accept="image/*" name="photo" class="d-none" id="photo_input">
                                <button type="submit" class="btn btn-success w-100 d-none mt-2">Update User Photo</button>
                            </form>
                        </div>
                        {{-- id photo --}}
                        <div class="col-lg-3">
                            <form action="<?= route('client.photo.update', [$client->id]) ?>" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="file-preview" id="id_photo">
                                    <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="file-drop-zone clearfix">

                                        <div class="file-drop-zone-title p-2" <?= $client->id_photo ? 'style="display: none;"' : '' ?>>No ID Card Photo Uploaded</div>

                                        <div class="file-preview-thumbnails clearfix">
                                            <?php if ($client->id_photo) { ?>
                                                <div class="card m-0">
                                                    <a href="<?= asset('storage/'.$client->id_photo) ?>" target="__blank">
                                                        <img class="card-img-top" src="<?= asset('storage/'.$client->id_photo) ?>" style="max-height: 200px;">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">ID Card</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="btn btn-primary btn-block id_photo btn-file" tabindex="500">
                                    <i class="icon-file-plus mr-2"></i>
                                    <span class="hidden-xs"><?= $client->id_photo ? 'Change' : 'Browse' ?></span>
                                </div>
                                <input type="file" accept="image/*" name="id_photo" class="d-none" id="id_photo_input">
                                <button class="btn btn-success w-100 d-none mt-2" type="submit">Update ID Card Photo</button>
                            </form>
                        </div>
                        {{-- form photo --}}
                        <div class="col-lg-3">
                            <form action="<?= route('client.photo.update', [$client->id]) ?>" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="file-preview" id="form_photo">
                                    <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="file-drop-zone clearfix">

                                        <div class="file-drop-zone-title p-2" <?= $client->form_photo ? 'style="display: none;"' : '' ?>>No Form Photo Uploaded</div>

                                        <div class="file-preview-thumbnails clearfix">
                                            <?php if ($client->form_photo) { ?>
                                                <div class="card m-0">
                                                    <a href="<?= asset('storage/'.$client->form_photo) ?>" target="__blank">
                                                        <img class="card-img-top" src="<?= asset('storage/'.$client->form_photo) ?>" style="max-height: 200px;">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Form</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="btn btn-primary btn-block form_photo btn-file" tabindex="500">
                                    <i class="icon-file-plus mr-2"></i>
                                    <span class="hidden-xs"><?= $client->form_photo ? 'Change' : 'Browse' ?></span>
                                </div>
                                <input type="file" accept="image/*" name="form_photo" class="d-none" id="form_photo_input">
                                <button class="btn btn-success w-100 d-none mt-2" type="submit">Update Form Photo</button>
                            </form>
                        </div>
                        {{-- signature photo --}}
                        <div class="col-lg-3">
                            <form action="<?= route('client.photo.update', [$client->id]) ?>" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="file-preview" id="signature_photo">

                                    <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    <div class="file-drop-zone clearfix">

                                        <div class="file-drop-zone-title p-2" <?= $client->signature_photo ? 'style="display: none;"' : '' ?>>No Signature Photo Uploaded</div>

                                        <div class="file-preview-thumbnails clearfix">
                                            <?php if ($client->signature_photo) { ?>
                                                <div class="card m-0">
                                                    <a href="<?= asset('storage/'.$client->signature_photo) ?>" target="__blank">
                                                        <img class="card-img-top" src="<?= asset('storage/'.$client->signature_photo) ?>" style="max-height: 200px;">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Signature</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                                <div class="btn btn-primary btn-block signature_photo btn-file" tabindex="500">
                                    <i class="icon-file-plus mr-2"></i>
                                    <span class="hidden-xs"><?= $client->signature_photo ? 'Change' : 'Browse' ?></span>
                                </div>
                                <input type="file" accept="image/*" name="signature_photo" class="d-none" id="signature_photo_input">
                                <button class="btn btn-success w-100 d-none mt-2" type="submit">Update Signature Photo</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- email update -->
                <div class="p-3 mt-2 shadow bg-white">
                    <div class="row">
                        <div class="col">
                            <form action="<?= route('client.email.update', [$client->id]) ?>" method="post">
                                @csrf
                                <h5 class="mb-3">Change Email Address</h5>
                                <label>Email Address</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="new_email" name="email" value="<?= $client->email ?>" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="btn btn-success" type="submit">Update Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
