<?php

$page_title = "Coupons";
$breadcrumb = ["Home", $page_title];

?>

@push('scripts')
    
    <!-- Theme JS files -->
    <script src="{{ asset('js/plugins/forms/inputs/inputmask.js') }}"></script>
    <script src="{{ asset('js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/notifications/pnotify.min.js') }}"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

<div class="content">
    
            <!-- Product Price Discount -->
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="font-weight-semibold">Price Discount (optional):</label>
                    <input type="text" name="discount" placeholder="Discount in %" maxlength="3" data-mask="99%" value="<?= old('discount') ?>" class="form-control @error('discount') is-invalid @enderror" onblur="toggleOnInputChange(this)" />
                    @error('discount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

        </div>
        
        <div class="row mt-3" id="discount" style="display: none">
            
            <!-- Price Discount Options -->
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="font-weight-semibold">Discount Expiry:</label>
                    <select name="on_expire" class="custom-select" onchange="toggleOnOptionSelect(this.value, 'expire_on_date')" >
                        <option value="no_expiry">No Expiry</option>
                        <option value="expire_on_date">Choose Date and Time</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 d-none" id="expire_on_date">
                <div class="row">
                    <!-- Product Discount Start Date and Time -->
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-semibold">Discount Start Date and Time: <span class="text-danger">*</span></label>
                            <input type="datetime-local" min="<?= date('Y-m-d') ?>" name="discount_start" id="discount_start" class="form-control  @error('discount_start') is-invalid @enderror" value="<?= old('discount_start') ?>" />
                            @error('discount_start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="badge badge-info form-text">Choose a start date and time</span>
                        </div>
                    </div>
                    
                    {{-- Product Discount End Date and Time  --}}
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-semibold">Discount End Date and Time: <span class="text-danger">*</span></label>
                            <input type="datetime-local" min="<?= date('Y-m-d') ?>" name="discount_end" id="discount_end" class="form-control  @error('discount_end') is-invalid @enderror" value="<?= old('discount_end') ?>" />
                            @error('discount_end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="badge badge-info form-text">Choose a end date and time</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product Discount Beneficiaries --}}
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="font-weight-semibold">Discount Beneficials: <span class="text-danger">*</span></label>
                    <select name="disc_benefit" class="custom-select" onchange="toggleOnBeneficialSelect(this)">
                        <option value="all" <?= (old('disc_benefit') == 'all') ? 'selected' : ''; ?>>Everybody</option>
                        <option value="n_people" <?= (old('disc_benefit') == 'n_people') ? 'selected' : ''; ?>>First number of people</option>
                        <option value="coupon" <?= (old('disc_benefit') == 'coupon') ? 'selected' : ''; ?>>Everyone with coupon code</option>
                        <option value="coupon_n_people" <?= (old('disc_benefit') == 'coupon') ? 'selected' : ''; ?>>First number of people with coupon code</option>
                    </select>
                    @error('disc_benefit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="badge badge-info form-text text-wrap">How many poeple should benefit this discount?</span>
                </div>
            </div>

                {{-- Number of beneficials --}}
            <div class="col-lg-3">
                <div class="form-group d-none" id="coupon">
                    <label class="font-weight-semibold">Coupon Code: <span class="text-danger">*</span></label>
                    <input type="text" maxlength="10" name="coupon" class="form-control @error('coupon') is-invalid @enderror" value="<?= old('coupon') ?>" placeholder="Enter Coupon Code" title="Share with your clients. Any one with this coupon code will benefit this discount" />
                    @error('coupon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="badge badge-info form-text text-wrap">Enter combination of letters and numbers, 10 characters maximum to form a unique coupon code.</span>
                </div>
                <div class="form-group d-none" id="n_people">
                    <label class="font-weight-semibold">Number of People: <span class="text-danger">*</span></label>
                    <input type="number" min="1" name="n_people" class="form-control @error('n_people') is-invalid @enderror" value="<?= old('n_people') ?>" placeholder="Enter number of people" />
                    @error('n_people')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

</div>




@endsection
