<?php

$page_title = 'Guarantor';
$breadcrumb = ["Home", $page_title];
require_once('functions.php');

?>

@push('scripts')

    <!-- Theme JS files -->
    <link href="<?= asset('css/profile.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?= asset('js/plugins/forms/inputs/inputmask.js') ?>"></script>
    <script src="<?= asset('js/pages/profile.js') ?>"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')

@section('content')
<div class='content m-2'>
    <div class="text-center">
        <h1><small>Guarantor's Profile</small></h1>
    </div>
    <div class="card grt-profile rounded bg-transparent p-2 border-0">
        <div class="row">
            {{-- profile header --}}
            <div class="col-lg-3 col-md-12 p-0 bg-white shadow" style="max-height: 30em">
                <form action="<?= route('grt.photo.update', [$grt->id]) ?>" method="post" enctype="multipart/form-data" class="">
                    @csrf
                    <div class="text-center pb-3 py-5 position-relative" id="photo">
                        <a href="<?= asset('storage/' . $grt->photo) ?>" class="img-link d-block mt-3" target="_blank" rel="noopener noreferrer">
                            <img src="<?= asset('storage/' . $grt->photo) ?>" class="shadow rounded-circle" alt="User Image" height="150px">
                        </a>
                        <h5 class="font-weight-bold mt-2 pb-0 text-capitalize"><?= $grt->surname . ' ' . $grt->first_name . ' ' . $grt->second_name ?></h5>

                        <a href="mailto:<?= $grt->email ?>" class="text-black-50 d-block"><?= $grt->email ?></a>

                        <button type="button" class="btn btn-primary-100 text-primary border-primary btn-icon rounded-pill mt-3 btn-file" data-popup="tooltip" data-original-title="Change Photo"><i class="icon-file-plus"></i></button>
                        
                        <button type="submit" class="btn btn-success-100 text-success border-success btn-icon rounded-pill mt-3 ml-2 d-none" data-popup="tooltip" data-original-title="Update photo"><i class="icon-file-upload"></i></button>

                        <input type="file" accept="image/*" name="photo" class="d-none" id="profile_photo_input" />
                    </div>
                </form>
            </div>

            {{-- personal info --}}
            <div class="col-lg-6 col-md-12">
                <form action="<?= route('grt.update', [$grt->id]) ?>" method="post" class="pr-2 pl-2 bg-white shadow">
                    @csrf
                    <div class="row">
                        <!-- personal infomation -->
                        <div class="col-12 py-4">
                            <div class="row">
                                <h5 class="section-title col-12 font-weight-semibold">Personal Info</h5>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Surname</label>
                                        <input type="text" name="surname" class="form-control text-capitalize @error('surname') is-invalid @enderror" value="<?= $grt->surname ?>" placeholder="Surname" required>
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">First name</label>
                                        <input type="text" name="first_name" class="form-control text-capitalize @error('first_name') is-invalid @enderror" placeholder="First name" value="<?= $grt->first_name ?>">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Second name</label>
                                        <input type="text" name="second_name" class="form-control text-capitalize @error('second_name') is-invalid @enderror" value="<?= $grt->second_name ?>" placeholder="Other name">
                                        @error('second_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Gender</label>
                                        <select name="gender" class="custom-select" required>
                                            <option value="">Select gender</option>
                                            <option value="male" <?= ($grt->gender == 'male') ? 'selected' : '' ?>>Male</option>
                                            <option value="female" <?= ($grt->gender == 'female') ? 'selected' : '' ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Marital Status</label>
                                        <select name="marital_status" class="custom-select" required>
                                            <option value="">Select status</option>
                                            <option value="single" <?= ($grt->marital_status == 'single') ? 'selected' : '' ?>>Single</option>
                                            <option value="married" <?= ($grt->marital_status == 'married') ? 'selected' : '' ?>>Married</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Mobile Number</label>
                                        <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="<?= $grt->phone_number ?>" placeholder="9999 999 9999" data-mask="9999 999 9999" maxlength="13" required>
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Mobile Number 2</label>
                                        <input type="tel" name="phone_number2" class="form-control @error('phone_number2') is-invalid @enderror" value="<?= $grt->phone_number2 ?>" placeholder="9999 999 9999" data-mask="9999 999 9999" maxlength="13" />
                                        @error('phone_number2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">State</label>
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
                                                            <option value="<?= $states[$j]->id ?>" <?= ($states[$j]->id == $grt->state) ? 'selected' : '' ?>>
                                                            <?= $states[$j]->name ?></option>
                                                        <?php }
                                                        if ($ltr > $label) break;
                                                    } ?>
                                                </optgroup>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">City</label>
                                        <input type="text" name="city" class="form-control text-capitalize @error('city') is-invalid @enderror" value="<?= $grt->city ?>" required />
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Street</label>
                                        <input type="text" name="street" class="form-control text-capitalize @error('street') is-invalid @enderror" value="<?= $grt->street ?>" required />
                                        @error('street')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="font-weight-semibold">Email Address</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="email" name="email" class="form-control" placeholder="Enter email address" value="<?= $grt->email ?>" required>
                                    </div>
                                </div>
                            </div>
                            <!-- ID card type -->
                            <div class="row mt-2">
                                <h5 class="section-title col-12 font-weight-semibold">Identity Card</h5>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">ID Card Type: <span class="text-danger">*</span></label>
                                        <select name="id_type" class="custom-select" required>
                                            <option value="">Select ID type</option>
                                            <option value="national" <?= ($grt->id_type == 'national') ? 'selected' : '' ?>>National ID</option>
                                            <option value="voters" <?= ($grt->id_type == 'voters') ? 'selected' : '' ?>>Voters Card</option>
                                            <option value="school" <?= ($grt->id_type == 'school') ? 'selected' : '' ?>>School ID</option>
                                            <option value="international" <?= ($grt->id_type == 'international') ? 'selected' : '' ?>>International Passport</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ID card number -->
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">ID Card Number: <span class="text-danger">*</span></label>
                                        <input type="text" name="id_number" value="<?= $grt->id_number ?>" class="form-control @error('id_number') is-invalid @enderror" pattern="[A-Za-z0-9]*" required>
                                        @error('id_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- ID issue date -->
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">ID Issue Date: <span class="text-danger">*</span></label>
                                        <input type="date" name="id_issue_date" class="form-control @error('id_issue_date') is-invalid @enderror" min="1990-12-31" max="<?= date('Y-m-d'); ?>" value="<?= $grt->id_issue_date ?>" required>
                                        @error('id_issue_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- ID expiry date -->
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">ID Expiry Date:</label>
                                        <input type="date" name="id_expiry_date" class="form-control @error('id_expiry_date') is-invalid @enderror" min="<?= date('Y-m-d'); ?>" max="<?= add_date('now', '10 years'); ?>" value="<?= $grt->id_expiry_date ?>">
                                        @error('id_expiry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 mb-3 ml-auto mr-auto text-center">
                                <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            {{-- documents section --}}
            <div class="col-lg-3 col-md-12 shadow py-4 bg-white">
                <h5 class="section-title col-12 mb-3 font-weight-semibold">Uploaded Documents</h5>
                {{-- id photo --}}
                <form action="<?= route('grt.photo.update', [$grt->id]) ?>" method="post" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="file-preview" id="id_photo">
                        <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="file-drop-zone clearfix">

                            <div class="file-drop-zone-title p-2" <?= $grt->id_photo ? 'style="display: none;"' : '' ?>>No ID Card Photo Uploaded</div>

                            <div class="file-preview-thumbnails clearfix">
                                <?php if ($grt->id_photo) { ?>
                                    <div class="card m-0">
                                        <a href="<?= asset('storage/'.$grt->id_photo) ?>" target="__blank">
                                            <img class="card-img-top" src="<?= asset('storage/'.$grt->id_photo) ?>" style="max-height: 200px;">
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
                        <span class="hidden-xs"><?= $grt->id_photo ? 'Change' : 'Browse' ?></span>
                    </div>
                    <input type="file" accept="image/*" name="id_photo" class="d-none" id="id_photo_input">
                    <button class="btn btn-success w-100 d-none mt-2" type="submit">Update ID Card Photo</button>
                </form>
                {{-- form photo --}}
                <form action="<?= route('grt.photo.update', [$grt->id]) ?>" method="post" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="file-preview" id="form_photo">
                        <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="file-drop-zone clearfix">

                            <div class="file-drop-zone-title p-2" <?= $grt->form_photo ? 'style="display: none;"' : '' ?>>No Form Photo Uploaded</div>

                            <div class="file-preview-thumbnails clearfix">
                                <?php if ($grt->form_photo) { ?>
                                    <div class="card m-0">
                                        <a href="<?= asset('storage/'.$grt->form_photo) ?>" target="__blank">
                                            <img class="card-img-top" src="<?= asset('storage/'.$grt->form_photo) ?>" style="max-height: 200px;">
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
                        <span class="hidden-xs"><?= $grt->form_photo ? 'Change' : 'Browse' ?></span>
                    </div>
                    <input type="file" accept="image/*" name="form_photo" class="d-none" id="form_photo_input">
                    <button class="btn btn-success w-100 d-none mt-2" type="submit">Update Form Photo</button>
                </form>
                {{-- signature photo --}}
                <form action="<?= route('grt.photo.update', [$grt->id]) ?>" method="post" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="file-preview" id="signature_photo">

                        <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                            <span aria-hidden="true">×</span>
                        </button>

                        <div class="file-drop-zone clearfix">

                            <div class="file-drop-zone-title p-2" <?= $grt->signature_photo ? 'style="display: none;"' : '' ?>>No Signature Photo Uploaded</div>

                            <div class="file-preview-thumbnails clearfix">
                                <?php if ($grt->signature_photo) { ?>
                                    <div class="card m-0">
                                        <a href="<?= asset('storage/'.$grt->signature_photo) ?>" target="__blank">
                                            <img class="card-img-top" src="<?= asset('storage/'.$grt->signature_photo) ?>" style="max-height: 200px;">
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
                        <span class="hidden-xs"><?= $grt->signature_photo ? 'Change' : 'Browse' ?></span>
                    </div>
                    <input type="file" accept="image/*" name="signature_photo" class="d-none" id="signature_photo_input">
                    <button class="btn btn-success w-100 d-none mt-2" type="submit">Update Signature Photo</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
