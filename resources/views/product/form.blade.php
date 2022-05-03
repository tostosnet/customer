<?php
// $referral_page = "Products";
$page_title = "Add New Product";
$breadcrumb = ["Home", $page_title];

?>

@push('scripts')
    
    <!-- Theme JS files -->
    <script src="{{ asset('js/plugins/forms/wizards/steps.min.js') }}"></script>
    <script src="{{ asset('js/plugins/forms/inputs/inputmask.js') }}"></script>
    <script src="{{ asset('js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('js/demo_pages/form_wizard.js') }}"></script>
    <script src="{{ asset('js/plugins/notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset('js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('js/demo_pages/form_multiselect.js') }}"></script>
    <script src="{{ asset('js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/demo_pages/uploader_bootstrap.js') }}"></script>
    <script src="{{ asset('js/pages/add_product.js') }}"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

    {{-- display errors if any --}}
    @if ($errors->all())
        <div class="alert alert-danger font-weight-semibold p-3 bg-white mb-0 ml-2 mr-2 mt-2">
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
    
<div class='content m-2 shadow mb-4'>

    <div class="card m-0">
        <div class="card-header border-bottom bg-white pb-0">
            <h5 class="">New Product Registration</h5>
        </div>

        <div class="card-body">
            <form id="user_form" name="new_product" class="wizard-form steps-validation" method="post" enctype="multipart/form-data" action="" data-fouc>
                @csrf

                <h6>Product Category</h6>
                <fieldset>

                    <!-- Name fields -->
                    <div class="row mt-4">
                        
                        <!-- Category -->
                        <div class="col">
                            <div class="form-group w-50 text-center mr-auto ml-auto mb-4" id="product_cat">
                                <label class="font-weight-semibold d-block">Product Category: <span class="text-danger">*</span></label>
                                <div class="cat-option position-relative">
                                    <a class="dropdown-toggle cat-input d-block" data-toggle="dropdown">
                                        <input type="text" name="cat" class="form-control" placeholder="Select a Product Category">
                                        <input type="hidden" name="cat_id">
                                    </a>

                                    <div class="dropdown-menu">
                                        
                                        @if ($categories)
                                            @foreach ($categories as $cat)
                                                @if ($cat->level == 0)
                                                    @if ($cat->has_child)
                                                        <div class="dropdown-submenu level-0">
                                                            <div class="dropdown-item border-bottom">
                                                                <a id="<?= $cat->id ?>"><?= $cat->name ?></a>
                                                            </div>
                                                            <div class="dropdown-menu">
                                                                @foreach ($categories as $cat1)
                                                                    @if ($cat1->level == 1 && $cat1->parent_id == $cat->id)
                                                                        @if ($cat1->has_child)
                                                                            <div class="dropdown-submenu level-1">
                                                                                <div class="dropdown-item border-bottom">
                                                                                    <a id="<?= $cat1->id ?>"><?= $cat1->name ?></a>
                                                                                </div>
                                                                                <div class="dropdown-menu">
                                                                                    @foreach ($categories as $cat2)
                                                                                        @if ($cat2->level == 2 && $cat2->parent_id == $cat1->id)
                                                                                            @if ($cat2->has_child)
                                                                                                <div class="dropdown-submenu level-2">
                                                                                                    <div class="dropdown-item border-bottom">
                                                                                                        <a id="<?= $cat2->id ?>"><?= $cat2->name ?></a>
                                                                                                    </div>
                                                                                                    <div class="dropdown-menu">
                                                                                                        @foreach ($categories as $cat3)
                                                                                                            @if ($cat3->level == 3 && $cat3->parent_id == $cat2->id)
                                                                                                                <div class="dropdown-item border-bottom">
                                                                                                                <a id="<?= $cat3->id ?>"><?= $cat3->name ?></a>
                                                                                                                <span class="badge badge-pink badge-pill ml-auto"><?= $cat3->products_count ?></span></div>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="dropdown-item border-bottom">
                                                                                                <a id="<?= $cat2->id ?>"><?= $cat2->name ?></a>
                                                                                                <span class="badge badge-pink badge-pill ml-auto"><?= $cat2->products_count ?></span></div>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="dropdown-item border-bottom">
                                                                            <a id="<?= $cat1->id ?>"><?= $cat1->name ?></a>
                                                                            <span class="badge badge-pink badge-pill ml-auto"><?= $cat1->products_count ?></span></div>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="dropdown-item border-bottom level-0">
                                                        <a class="" id="<?= $cat->id ?>"><?= $cat->name ?></a>
                                                        <span class="badge badge-pink badge-pill ml-auto"><?= $cat->products_count ?></span></div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 mb-4">
                        <!-- Brand -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-semibold">Product Brand / Company: <span class="text-danger">*</span></label>
                                <select id="product_brand" name="brand_id" class="custom-select" data-id="<?= old('brand_id') ?>">
                                    <option value="">Select Product Brand</option>
                                </select>
                            </div>
                        </div>

                        <!-- Model -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-semibold">Product Model / Type: <span class="text-danger">*</span></label>
                                <select id="product_model" name="model_id" class="custom-select" data-id="<?= old('model_id') ?>">
                                    <option value="">Select Product Model</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <!-- Product Details section -->
                <h6>Product Details</h6>
                <fieldset>

                    <div class="row mt-4">
                        <div class="col-lg-8">

                            <!-- Product name -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <h6 class="font-weight-semibold">Product Name:</h6>
                                        <input type="text" name="name" id="product_name" class="form-control w-50" readonly value="{{ old('name') }}" />
                                        <!-- <span class="border-1"></span> -->
                                    </div>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Product Description: </label>
                                        <textarea rows="3" cols="3" class="form-control" name="description" placeholder="You can give a brief description about your product"><?= old('description') ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">

                                <!-- Product Condition -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Product Condition: <span class="text-danger">*</span></label>
                                        <select onchange="toggleOnOptionSelect(this.value, 'used', '#condition_base', ['#age'])" name="cond" id="condition" class="custom-select">
                                            <option value="new" <?php if (old('cond') == 'new') echo 'selected'; ?>>Brand New</option>
                                            <option value="ng_used" <?php if (old('cond') == 'ng_used') echo 'selected'; ?>>Nigeria Used</option>
                                            <option value="fr_used" <?php if (old('cond') == 'fr_used') echo 'selected'; ?>>Foreign Used</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Product Color -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Product Color: <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="color" placeholder="Enter product color" value="<?= old('color') ?>" class="form-control @error('color') is-invalid @enderror" value="<?= old('color') ?>" />
                                        @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- If used condition is selected -->
                            <div class="row mt-2 <?php if (empty($cond) or $cond == 'new') echo 'd-none' ?>" id="condition_base">

                                <!-- Receipt -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Receipt Available: <span class="text-danger">*</span></label>
                                        <select name="receipt" class="custom-select" value="<?= old('receipt') ?>">
                                            <option value="1" <?php if (old('receipt') == '1') echo 'selected'; ?>>Yes</option>
                                            <option value="0" <?php if (old('receipt') == '0') echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Month old -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">How Old?: <span class="text-danger">*</span></label>
                                        <input type="month" name="age" id="age" placeholder="" pattern="[0-9]{3}" min="0" max="999" value="<?= old('age') ?>" class="form-control @error('age') is-invalid @enderror" value="<?= old('age') ?>" />
                                        @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="badge badge-info form-text">Since when?</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">

                                <!-- Product serial number -->
                                <div class="col">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Product SN: <span class="text-danger">*</span></label>
                                        <input type="text" name="sn" placeholder="Enter product ID number" value="<?= old('sn') ?>" class="form-control @error('sn') is-invalid @enderror" value="<?= old('sn') ?>" />
                                        @error('sn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="badge badge-info form-text"> Product serial number or engine number for industrial product</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <!-- SN Type -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold">SN Type: <span class="text-danger">*</span></label>
                                        <select name="sn_type" onchange="toggleOnOptionSelect(this.value, 'other', '#sn_type_base', ['#sn_type_base'])" class="custom-select @error('sn_type') is-invalid @enderror" value="<?= old('sn_type') ?>" >
                                            <option value="">Choose a serial number type</option>
                                            <option value="vin" <?php if (old('sn_type') == 'vin') echo 'selected'; ?>>Engine Number</option>
                                            <option value="phone_sn" <?php if (old('sn_type') == 'phone_sn') echo 'selected'; ?>>Phone SN</option>
                                            <option value="com_sn" <?php if (old('sn_type') == 'com_sn') echo 'selected'; ?>>Computer SN</option>
                                            <option value="elect_sn" <?php if (old('sn_type') == 'elect_sn') echo 'selected'; ?>>Electronic SN</option>
                                            <option value="other" <?php if (old('sn_type') == 'other') echo 'selected'; ?>>Other</option>
                                            <option value="none" <?php if (old('sn_type') == 'none') echo 'selected'; ?>>None</option>
                                        </select>
                                        @error('sn_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Other SN types -->
                                <div class="col-lg-6">
                                    <div class="form-group d-none" id="sn_type_base">
                                        <label class="font-weight-semibold">Specify SN Type: <span class="text-danger">*</span></label>
                                        <input type="text" name="other_sn_type" id="other_sn_type" pattern="[a-zA-Z]+" placeholder="Type of serial number" value="<?= old('other_sn_type') ?>" class="form-control @error('other_sn_type') is-invalid @enderror" value="<?= old('other_sn_type') ?>" />
                                        @error('other_sn_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-5">

                            <!-- publish status  -->
                            <div class="form-group">
                                <h6 class="font-weight-semibold d-block">Published Status</h6>
                                <div class="border-2 border-light" style="padding:8px 10px;border-radius: 20px">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="publish" value="2" <?= (old('publish') == '2') ? 'checked' : '' ?>>
                                        <span class="custom-control-label" title="Published and visible in shop">Publish</span>
                                    </label>

                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="publish" value="1" <?= (old('publish') == '1') ? 'checked' : '' ?>>
                                        <span class="custom-control-label" title="Product can be found but invisible in shop">Invisible</span>
                                    </label>

                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="publish" value="0" <?= (old('publish') == '0') ? 'checked' : '' ?>>
                                        <span class="custom-control-label" title="Will be saved and not published">Draft</span>
                                    </label>
                                </div>
                            </div>
                            
                            {{-- Product featured photo upload --}}
                            <div class="form-group">
                                <h5 class="font-weight-semibold d-block">Upload Product Featured Image:</h5>
                                
                                <div class="featured-image" id="fimage">
                                    <div class="file-preview">
                                        <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="file-drop-zone d-flex align-items-center justify-content-center clearfix" style="min-height: 10rem">

                                            <div class="file-drop-zone-title p-2" <?= old('fimage') ? 'style="display: none;"' : '' ?>>Upload A Featured Photo</div>

                                            <div class="file-preview-thumbnails clearfix">
                                                @if (old('fimage'))
                                                    <a href="<?= asset('storage/'.old('fimage')) ?>" target="__blank">
                                                        <img class="" src="<?= asset('storage/'.old('fimage')) ?>" style="max-height: 200px;">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                    @error('fimage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="btn btn-primary btn-block fimage btn-file" tabindex="500">
                                        <i class="icon-file-plus mr-2"></i>
                                        <span class="hidden-xs"><?= old('fimage') ? 'Change' : 'Browse' ?></span>
                                    </div>
                                    <input type="file" accept="image/*" name="fimage" class="d-none" id="fimage_input">
                                    <button class="btn btn-success w-100 d-none mt-2" type="submit">Update ID Card Photo</button>
                                </div>
                                <span class="badge badge-info form-text">Accepted formats: jpg, png. Max file size 2Mb</span>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- Product Price -->
                <h6>Product Installment</h6>
                <fieldset>

                    <div class="row mt-4">

                        <!-- Product Installment Price -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-semibold">Installment Price (₦): <span class="text-danger">*</span></label>
                                <input type="text" name="price" placeholder="Enter Price" maxlength="10" value="<?= old('price') ?>" class="form-control currency_format @error('price') is-invalid @enderror" />
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="badge badge-info form-text">How much are you given it out?</span>
                            </div>
                        </div>

                        <!-- Product Initial Price -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-semibold">Initial Price (₦): <span class="text-danger">*</span></label>
                                <input type="text" name="initial_price" placeholder="Enter Initial Price" maxlength="10" value="<?= old('initial_price') ?>" class="form-control currency_format @error('initial_price') is-invalid @enderror" />
                                @error('initial_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="badge badge-info form-text">What is your initial price?</span>
                            </div>
                        </div>

                        <!-- Product Repayment Price -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-semibold">Repayment Price (₦): <span class="text-danger">*</span></label>
                                <input type="text" name="repay_price" placeholder="Enter Price" maxlength="9" value="<?= old('repay_price') ?>" class="form-control currency_format @error('repay_price') is-invalid @enderror" />
                                @error('repay_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="badge badge-info form-text">How much will they be paying back?</span>
                            </div>
                        </div>
                        
                        {{-- Product Price Discount --}}
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="font-weight-semibold">Price Discount (optional): <span class="text-danger">*</span></label>
                                <select name="discount_option" class="custom-select" onchange="toggleOnDiscount(this)">
                                    <option value="">Select a discount option</option>
                                    <option value="coupon">Use Coupon</option>
                                    <option value="discount" <?= (old('disc_benefit') == 'discount') ? 'selected' : ''; ?>>Enter discount</option>
                                </select>
                                <span class="badge badge-info form-text">Would you like to give them a discount?</span>
                            </div>

                            <div class="form-group d-none" id="coupon">
                                <label class="font-weight-semibold">Select a coupon: <span class="text-danger">*</span></label>
                                <select name="coupon" class="custom-select">
                                    <option value="">Select a Coupon</option>
                                    <option value="custom" <?= (old('coupon') == 'custom') ? 'selected' : ''; ?>>Enter number</option>
                                </select>
                            </div>

                            <div class="form-group d-none" id="discount">
                                <label class="font-weight-semibold">Discount amount: <span class="text-danger">*</span></label>
                                <input type="text" name="discount" placeholder="Discount in %" maxlength="3" data-mask="99%" value="<?= old('discount') ?>" class="form-control @error('discount') is-invalid @enderror" />
                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                    </div>
                    
                    <div class="row mt-3">

                        <!-- Product Repayment Period -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-semibold">Repayment Period: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select onchange="toggleOnOptionSelect(this.value, 'daily', '#free_days')" name="repay_period" class="custom-select">
                                        <option value="daily" <?= (old('period') == 'daily') ? 'selected' : ''; ?>>Daily Repayment</option>
                                        <option value="weekly" <?= (old('period') == 'weekly') ? 'selected' : ''; ?>>Weekly Repayment</option>
                                        <option value="monthly" <?= (old('period') == 'monthly') ? 'selected' : ''; ?>>Monthly Repayment</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Repayment Free days -->
                        <div class="col-lg-4" id="free_days">
                            <div class="form-group">
                                <label class="font-weight-semibold">Free Days:</label>
                                <select name="free_days[]" class="form-control multiselect" multiple="multiple" data-fouc>
                                    <?php $free_days = is_array(old('free_days')) ? old('free_days') : [] ?>
                                    <option value="mon" <?= in_array('mon', $free_days) ? 'selected' : ''; ?>>Monday</option>
                                    <option value="tue" <?= in_array('tue', $free_days) ? 'selected' : ''; ?>>Tuesday</option>
                                    <option value="wed" <?= in_array('wed', $free_days) ? 'selected' : ''; ?>>Wednesday</option>
                                    <option value="thur" <?= in_array('thur', $free_days) ? 'selected' : ''; ?>>Thursday</option>
                                    <option value="fri" <?= in_array('fri', $free_days) ? 'selected' : ''; ?>>Friday</option>
                                    <option value="sat" <?= in_array('sat', $free_days) ? 'selected' : ''; ?>>Saturday</option>
                                    <option value="sun" <?= in_array('sun', $free_days) ? 'selected' : ''; ?>>Sunday</option>
                                </select>
                                <span class="badge badge-info form-text">Select days that are free</span>
                            </div>
                        </div>

                    </div>

                </fieldset>

                <!-- Gallery section -->
                <h6>Product Gallery</h6>
                <fieldset>

                    <!-- upload more photos -->
                    <div class="row mt-4">
                        <div class="col-1"></div>
                        <div class="col-lg-10">
                            <div class="form-group" id="gallery_field" data-max-file-upload="5">
                                <h4 class="text-center font-weight-semibold d-block mb-1">Upload More Photos</h4>
                                <h4 class="text-center">
                                    <small>Describe your product properly with more photos</small>
                                </h4>
                                <div class="file-preview" style="min-height:200px;border:2px dashed #ddd;margin-bottom:20px">
                                    <button type="button" class="close fileinput-remove" aria-label="Close" style="display: none;">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="file-dropzone clearfix">
                                        <div class="file-drop-zone-title" @if (old('gallery')) style="display: none;" @endif >No photos here</div>
                                        <div class="file-preview-thumbnails clearfix" id="gallery_preview">
                                            <!-- dynamic content here -->
                                            @if (old('gallery'))
                                                @foreach (old('gallery') as $id => $items)
                                                    <div class="card col-lg-4 p-0 file-preview-frame" id="<?= $id ?>" style="max-width:32%">
                                                        <div class="kv-file-content">
                                                            <img class="file-preview-image kv-preview-data" id="<?= $id ?>" src="<?= $items[2] ?>" alt="<?= $items[0] ?>" style="width: auto; height: auto; max-width: 100%; max-height: 100%; image-orientation: from-image;" />
                                                        </div>
                                                        <div class="file-thumbnail-footer">
                                                            <div class="file-footer-caption" title="<?= $items[0] ?>">
                                                                <div class="file-caption-info"><?= $items[0] ?></div>
                                                                <div class="file-size-info"> <samp><?= get_file_byte_unit($items[1]) ?></samp></div>
                                                            </div>
                                                            <div class="file-thumb-progress d-none">
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-info progress-bar-info progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="101" aria-valuemin="0" aria-valuemax="100" style="width: 101%;">Initializing..</div>
                                                                </div>
                                                            </div>
                                                            <div class="file-upload-indicator" title="Not uploaded yet"><i class="icon-file-plus text-success"></i></div>
                                                            <div class="file-actions">
                                                                <div class="file-footer-buttons"><button type="button" class="kv-file-upload " title="Upload file"><i class="icon-upload"></i></button> <button type="button" class="kv-file-remove " title="Remove file"><i class="icon-bin"></i></button><button type="button" class="kv-file-zoom " title="View Details"><i class="icon-zoomin3"></i></button></div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>

                                <div class="input-group file-caption-main">
                                    <div class="file-caption form-control kv-fileinput-caption icon-visible" tabindex="500">
                                        <span class="file-caption-icon"><i class="glyphicon glyphicon-file"></i></span>
                                        <input readonly="" class="file-caption-name" placeholder="Select files ..." title="No file selected">
                                    </div>
                                    <div class="input-group-btn input-group-append">
                                        <button type="button" title="Clear all unprocessed files" class="btn btn-default btn-secondary fileinput-remove fileinput-remove-button" tabindex="500" style="display: none;"><i class="icon-cross2 font-size-base mr-2"></i> <span class="hidden-xs">Remove</span></button>

                                        <div class="btn btn-primary btn-file rounded-right" tabindex="500"><i class="icon-file-plus mr-2"></i> <span class="hidden-xs">Browse</span>
                                        </div>
                                        <input type="file" accept="image/*" id="gallery" name="gallery[]" class="d-none" multiple="multiple" />
                                    </div>
                                </div>
                                @error('gallery')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="badge badge-info form-text">Accepted formats: jpg, png. Max size for each photo 2Mb</span>
                            </div>
                            <div class="col-1"></div>
                        </div>

                </fieldset>

            </form> <!-- /User form -->
        </div>
    </div>
</div>

@endsection
