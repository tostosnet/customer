<?php
$page_title = "Add Client Guarantor";
$breadcrumb = ["Home", $page_title];
require_once('functions.php');
$grt_id = isset($_GET['cid']) ? $_GET['cid'] : $grt_id;
?>
@push('scripts')
    <script src="{{ asset('js/plugins/forms/wizards/steps.min.js') }}"></script>
    <script src="{{ asset('js/plugins/forms/inputs/inputmask.js') }}"></script>
    <script src="{{ asset('js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('js/demo_pages/form_wizard.js') }}"></script>
    <script src="{{ asset('js/plugins/media/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/pages/add_user.js') }}"></script>

    <style>.custom-file-label:after {background-color: #2196f3; color: #fff!important}</style>
@endpush

@extends('layouts.app')

@section('content')

<div class='content'>

    <!-- New User Registration Form -->
    <div class="card m-2 mb-4 shadow border-0">

        <div class="card-header bg-white pb-0 mb-4" style="background-image: url('assets/images/backgrounds/seamless.png')">

            <div class="text-center mb-2">
                <i class="icon-plus3 text-success border-success border-3 rounded-pill p-3 mb-2 mt-1"></i>
                <h5 class="mb-0">New Guarantor Account For <span class="font-weight-semibold">Client <?= $grt_id ?></span></h5>
                <span class="d-block text-danger">Required fields are marked with *</span>
            </div>
            <h4 class="text-center"><i class="icon-user-plus mr-2"></i> Guarantor Form</a></h4>

        </div>

        <!-- Guarantor Form -->
        <div class="container mb-4">
            <form id="grt_form" name="grt_form" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" data-fouc>
                @csrf
                <input type="hidden" name="cid" value="<?= $grt_id ?>" />

                <h6>Personal data</h6>
                <fieldset>
                    <div class="mt-4 mb-4">
                        <!-- Name fields -->
                        <div class="row mt-2">

                            <!-- surname -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Surname: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required />
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- first name -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>First Name: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required />
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- other name -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Second Name: </label>
                                    <input type="text" class="form-control text-capitalize @error('second_name') is-invalid @enderror" name="second_name" value="{{ old('second_name') }}" />
                                    @error('second_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status Info -->
                        <div class="row mt-2">

                            <!-- gender -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="d-block">Gender:</label>

                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="gender" value="male" checked <?= old('gender') == 'male' ? 'checked' : '' ?> />
                                        <span class="custom-control-label">Male</span>
                                    </label>

                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="gender" value="female" <?= (old('gender') == 'female') ? 'checked' : '' ?> />
                                        <span class="custom-control-label">Female</span>
                                    </label>
                                </div>
                            </div>

                            <!-- marital status -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="d-block">Marital Status:</label>

                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="marital_status" value="single" checked <?= (old('marital_status') == 'single') ? 'checked' : '' ?> />
                                        <span class="custom-control-label">Single</span>
                                    </label>

                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="marital_status" value="married" <?= (old('marital_status') == 'married') ? 'checked' : '' ?> />
                                        <span class="custom-control-label">Married</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- email -->
                        <div class="row mt-2">
                            <div class="col-lg-4">
                                <label>Email Address: <span class="text-danger">*</span></label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="your@email.com" required />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- phone number 1 -->
                            <div class=" col-lg-4">
                                <div class="form-group">
                                    <label>Phone Number: <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="9999 999 9999" data-mask="9999 999 9999" required />
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone number 2 -->
                            <div class=" col-lg-4">
                                <div class="form-group">
                                    <label>Phone Number 2: </label>
                                    <input type="tel" class="form-control @error('phone_number2') is-invalid @enderror" name="phone_number2" value="{{ old('phone_number2') }}" placeholder="9999 999 9999" data-mask="9999 999 9999" />
                                    @error('phone_number2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Home Address -->
                        <div class=" row mt-2">
                            <!-- state -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Select State: <span class="text-danger">*</span></label>
                                    <select name="state" class="custom-select">
                                        <?php
                                        for ($i = 0; $i < count($keys); $i++) {
                                            $label = $keys[$i] ?>
                                            <optgroup label="<?= strtoupper($label) ?>">
                                                <?php
                                                for ($j = 0; $j < count($states); $j++) {
                                                    $ltr = str_split(strtolower($states[$j]->name))[0];
                                                    if ($ltr == $label) { ?>
                                                        <option value="<?= $states[$j]->id ?>" <?= ($states[$j]->id == old('state')) ? 'selected' : '' ?>>
                                                        <?= $states[$j]->name ?></option>
                                                    <?php }
                                                    if ($ltr > $label) break;
                                                } ?>
                                            </optgroup>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- city -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>City: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required />
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- street -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Street: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-capitalize @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required />
                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- ID card section -->
                <h6>Identity Card Information</h6>
                <fieldset>
                    <div class="mt-4 mb-4">
                        <div class="row mt-2">

                            <!-- ID card type -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>ID Card Type: <span class="text-danger">*</span></label>
                                    <select name="id_type" class="custom-select" required>
                                        <option value="">Select ID type</option>
                                        <option value="national" <?= (old('id_type') == 'national') ? 'selected' : '' ?>>National ID</option>
                                        <option value="voters" <?= (old('id_type') == 'voters') ? 'selected' : '' ?>>Voters Card</option>
                                        <option value="school" <?= (old('id_type') == 'school') ? 'selected' : '' ?>>School ID</option>
                                        <option value="international" <?= (old('id_type') == 'international') ? 'selected' : '' ?>>International Passport</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ID card number -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>ID Card Number: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" value="{{ old('id_number') }}" pattern="[A-Za-z0-9]*" required />
                                    @error('id_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- ID issue date -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>ID Issue Date: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('id_issue_date') is-invalid @enderror" name="id_issue_date" min="1990-12-31" max="<?= date('Y-m-d'); ?>" value="{{ old('id_issue_date') }}" required />
                                    @error('id_issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- ID expiry date -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>ID Expiry Date:</label>
                                    <input type="date" class="form-control @error('id_expiry_date') is-invalid @enderror" name="id_expiry_date" value="{{ old('id_expiry_date') }}" min="<?= date('Y-m-d'); ?>" max="<?= add_date('now', '10 years'); ?>" />
                                    @error('id_expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- ID card photo upload -->
                        <div class=" row mt-2">
                            <div class="col-lg-6 photo">
                                <div class="form-group">
                                    <label class="d-block">Upload ID Card Photo:</label>
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input @error('id_photo') is-invalid @enderror" name="id_photo" value="{{ old('id_photo') }}" />
                                        <span class="custom-file-label">Choose file</span>
                                    </label>
                                    @error('id_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="badge badge-danger-100 form-text">Accepted formats: jpg, png, pdf, doc. Max file size 2Mb</span>
                                </div>
                            </div>

                            <!-- id photo display -->
                            <div class="col-lg-6">
                                <div class="rounded clearfix" style="min-height: 200px;border: 1px dashed #ddd;">
                                    <div class="media user_photo">
                                        <?php if (old('id_photo')) : ?>
                                            <a href="<?= asset('storage/'.old('id_photo')) ?? ''; ?>">
                                                <img src="<?= asset('storage/'.old('id_photo')) ?? ''; ?>" alt="ID card photo" style="width: auto; height: auto; max-width: 300px; max-height: 300px; image-orientation: from-image;">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- documents upload section -->
                <h6>Upload Documents</h6>
                <fieldset>
                    <div class="content mt-4 mb-4">
                        <!-- upload user photo -->
                        <div class="row mt-2">
                            <div class="col-lg-6 photo">
                                <div class="form-group">
                                    <label class="d-block">Upload Guarantor Photo:</label>
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" required />
                                        <span class="custom-file-label">Choose file</span>
                                    </label>
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="badge badge-danger-100 form-text">Accepted formats: jpg, png, pdf, doc. Max file size 2Mb</span>
                                </div>
                            </div>

                            <!-- user photo display -->
                            <div class="col-lg-6">
                                <div class="rounded clearfix" style="min-height: 200px;border: 1px dashed #ddd;">
                                    <div class="media grt_photo">
                                        <?php if (old('photo')) : ?>
                                            <a href="<?= asset('storage/'.old('photo')) ?? ''; ?>">
                                                <img src="<?= asset('storage/'.old('photo')) ?? ''; ?>" alt="Guarantor photo" style="width: auto; height: auto; max-width: 300px; max-height: 300px; image-orientation: from-image;">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- upload form photo -->
                        <div class="row mt-2">
                            <div class="col-lg-6 photo">
                                <div class="form-group">
                                    <label class="d-block">Upload Form Photo:</label>
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input @error('form_photo') is-invalid @enderror" name="form_photo" value="{{ old('form_photo') }}" />
                                        <span class="custom-file-label">Choose file</span>
                                    </label>
                                    @error('form_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="badge badge-danger-100 form-text">Accepted formats: jpg, png, pdf, doc. Max file size 2Mb</span>
                                </div>
                            </div>

                            <!-- form photo display -->
                            <div class="col-lg-6">
                                <div class="rounded clearfix" style="min-height: 200px;border: 1px dashed #ddd;">
                                    <div class="media">
                                        <?php if (old('form_photo')) : ?>
                                            <a href="<?= asset('storage/'.old('form_photo')) ?? ''; ?>">
                                                <img src="<?= asset('storage/'.old('form_photo')) ?? ''; ?>" alt="Form photo" style="width: auto; height: auto; max-width: 300px; max-height: 300px; image-orientation: from-image;">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- user signature upload -->
                        <div class="row mt-2">
                            <div class="col-lg-6 photo">
                                <div class="form-group">
                                    <label class="d-block">Upload Signature Photo:</label>
                                    <label class="custom-file">
                                        <input type="file" class="custom-file-input @error('signature_photo') is-invalid @enderror" name="signature_photo" value="{{ old('signature_photo') }}" />
                                        <span class="custom-file-label">Choose file</span>
                                    </label>
                                    @error('signature_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="badge badge-danger-100 form-text">Accepted formats: jpg, png, pdf, doc. Max file size 2Mb</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="rounded clearfix" style="min-height: 200px;border: 1px dashed #ddd;">
                                    <div class="media">
                                        <?php if (old('signature_photo')) : ?>
                                            <a href="<?= asset('storage/'.old('signature_photo')) ?? ''; ?>">
                                                <img src="<?= asset('storage/'.old('signature_photo')) ?? ''; ?>" alt="Signature photo" style="width: auto; height: auto; max-width: 300px; max-height: 300px; image-orientation: from-image;">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form> <!-- /Guarantor form -->
        </div>
        
    </div>
    <!-- /Registration Form -->

</div>

@endsection
