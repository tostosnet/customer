<?php
$page_title = 'Profile';
$breadcrumb = ["Home", $page_title];
?>

@push('scripts')
    
    <!-- Theme JS files -->
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <script src="{{ asset('js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="<?= asset('js/plugins/forms/inputs/inputmask.js') ?>"></script>
    <script src="{{ asset('js/pages/profile.js') }}"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')

@section('content')

<div class="content mb-3">
    
    <div class="bg-white shadow rounded-lg d-block d-sm-flex">
        <!-- sidebar -->
        <div class="profile-tab-nav border-right">
            <div class="p-4">
                <div class="img-circle text-center mb-1">
                    <img src="<?= Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : asset('images/demo/users/face1.jpg') ?>" alt="Image" class="shadow" style="height:150px; width:150px;">
                </div>
                <h4 class="text-center mb-0"><?= ucwords(Auth::user()->surname . ' ' . Auth::user()->first_name . ' ' . Auth::user()->lastname); ?></h4>
                <p class="text-center"><i><?= Auth::user()->email ?></i></p>
            </div>
            <!-- sidebar navigation -->
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                    <i class="fa fa-home text-center mr-1"></i>
                    Account
                </a>
                <a class="nav-link" id="acc-settings-tab" data-toggle="pill" href="#acc-settings" role="tab" aria-controls="password" aria-selected="false">
                    <i class="fa fa-key text-center mr-1"></i>
                    Account Settings
                </a>
                <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">
                    <i class="fa fa-user text-center mr-1"></i>
                    Security
                </a>
                <a class="nav-link" id="application-tab" data-toggle="pill" href="#application" role="tab" aria-controls="application" aria-selected="false">
                    <i class="fa fa-tv text-center mr-1"></i>
                    Application
                </a>
                <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
                    <i class="fa fa-bell text-center mr-1"></i>
                    Notification
                </a>
            </div>
        </div>
        <!-- main content -->
        <div class="tab-content" id="v-pills-tabContent">

            <!-- account details section -->
            <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                <h3 class="p-3 border-bottom">Account Details</h3>
                <form action="{{ route('update_profile') }}" method="post" class="p-4">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-semibold">Surname</label>
                                <input type="text" name="surname" class="form-control text-capitalize @error('surname') is-invalid @enderror" value="<?= Auth::user()->surname ?>">
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-semibold">First Name</label>
                                <input type="text" name="first_name" class="form-control text-capitalize @error('first_name') is-invalid @enderror" value="<?= Auth::user()->first_name ?>">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-semibold">Second Name</label>
                                <input type="text" name="second_name" class="form-control text-capitalize @error('second_name') is-invalid @enderror" value="<?= Auth::user()->second_name ?>">
                                @error('second_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-semibold">Company</label>
                                <input type="text" name="company" class="form-control text-capitalize @error('company') is-invalid @enderror" placeholder="Your company's name" value="<?= ucwords(Auth::user()->company) ?>">
                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-semibold">Office Number</label>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="<?= Auth::user()->phone_number ?>">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="font-weight-semibold">Mobile Number</label>
                                <input type="text" name="phone_number2" class="form-control @error('phone_number2') is-invalid @enderror" value="<?= Auth::user()->phone_number2 ?>">
                                @error('phone_number2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-semibold">Street</label>
                                <input type="text" name="street" class="form-control text-capitalize @error('street') is-invalid @enderror" placeholder="Your office address" value="<?= ucwords(Auth::user()->street) ?>">
                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-semibold">City</label>
                                <input type="text" name="city" class="form-control text-capitalize @error('city') is-invalid @enderror" placeholder="Location" value="<?= ucwords(Auth::user()->city) ?>">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-semibold">State</label>
                                <select name="state" class="custom-select text-capitalize @error('state') is-invalid @enderror">
                                    <?php
                                    for ($i = 0; $i < count($keys); $i++) {
                                        $label = $keys[$i] ?>
                                        <optgroup label="<?= strtoupper($label) ?>">
                                            <?php
                                            for ($j = 0; $j < count($states); $j++) {
                                                $ltr = str_split(strtolower($states[$j]->name))[0];
                                                if ($ltr == $label) { ?>
                                                    <option value="<?= $states[$j]->id ?>" <?= ($states[$j]->id == Auth::user()->state) ? 'selected' : '' ?>>
                                                    <?= $states[$j]->name ?></option>
                                                <?php }
                                                if ($ltr > $label) break;
                                            } ?>
                                        </optgroup>
                                    <?php } ?>
                                </select>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-semibold">Bio</label>
                                <textarea name="about" class="form-control" rows="4" placeholder="Tell your clients a few information about yourself"><?= Auth::user()->about ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="account" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>

            <!-- account core section -->
            <div class="tab-pane fade" id="acc-settings" role="tabpanel" aria-labelledby="acc-settings-tab">
                <h3 class="p-3 border-bottom">Account Core Settings</h3>
                <div class="p-4">
                    
                    <!-- profile picture -->
                    <form action="{{ route('update_profile_photo') }}" method="post" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <h5 class="mb-3">Change Profile Picture</h5>

                        <div class="form-group">
                            <a href="<?= Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : asset('images/demo/users/face1.jpg') ?>" class="img-link mr-3" target="__blank">
                                <img src="<?= Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : asset('images/demo/users/face1.jpg') ?>" alt="User Image" class="" height="150px">
                            </a>

                            <button type="button" class="btn btn-primary btn-file" title="Change Photo"><i class="icon-file-plus mr-2"></i> Click to Change Profile Photo</button>

                            <input type="file" accept="image/*" name="photo" class="d-none" id="profile_photo_input" required>
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <button class="btn btn-success" name="photo_update" type="submit">Update Profile Photo</button>
                        </div>
                    </form>

                    <div class="row mb-4">
                    <!-- username update -->
                    <form action="{{ route('update_profile_username') }}" method="post" class="col-lg-6 mb-4 mb-lg-0">
                        @csrf
                        <h5 class="mb-3">Change Username</h5>
                        <label class="font-weight-semibold">Username</label>
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="<?= Auth::user()->username ?>" required>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-success" type="submit">Update Username</button>
                        </div>
                    </form>

                    <!-- email update -->
                    <form action="{{ route('update_profile_email') }}" method="post" class="col-lg-6">
                        @csrf
                        <h5 class="mb-3">Change Email Address</h5>
                        <label class="font-weight-semibold">Email Address</label>
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="new_email" name="email" value="<?= Auth::user()->email ?>" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-success" name="email_update" type="submit">Update Email</button>
                        </div>
                    </form>
                    </div>

                    <!-- password update -->
                    <form action="{{ route('update_profile_password') }}" method="post">
                        @csrf
                        <h5 class="mb-3">Change Password</h5>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-semibold">Old Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="old_psw" placeholder="Type your Old password" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-semibold">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="psw" name="new_password" minlength="4" maxlength="16" required oninput="(this.value == document.getElementById('confirm-psw').value) ? document.querySelector('button[name=password]').removeAttribute('disabled', false) : document.querySelector('button[name=password]').setAttribute('disabled', true)" placeholder="Type your new password">
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-semibold">Confirm New Password</label>
                                    <input type="password" id="confirm-psw" class="form-control" oninput="(this.value == document.getElementById('psw').value) ? document.querySelector('button[name=psw_update]').removeAttribute('disabled', false) : document.querySelector('button[name=psw_update]').setAttribute('disabled', true)" placeholder="Retype your new password">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-success" name="psw_update" type="submit" disabled>Update Password</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- security settings -->
            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <h3 class="p-4 border-bottom">Security Settings</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-semibold">Login</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-semibold">Two-factor auth</label>
                            <input type="text" name="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="recovery">
                                <label class="font-weight-semibold form-check-label" for="recovery">
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

            <!-- app settings -->
            <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
                <h3 class="mb-4">Application Settings</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="app-check">
                                <label class="font-weight-semibold form-check-label" for="app-check">
                                    App check
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="font-weight-semibold form-check-label" for="defaultCheck2">
                                    Lorem ipsum dolor sit.
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

            <!-- notification settings -->
            <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                <h3 class="mb-4">Notification Settings</h3>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="notification1">
                        <label class="font-weight-semibold form-check-label" for="notification1">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus, neque cupiditate quis
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="notification2">
                        <label class="font-weight-semibold form-check-label" for="notification2">
                            hic nesciunt repellat perferendis voluptatum totam porro eligendi.
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="notification3">
                        <label class="font-weight-semibold form-check-label" for="notification3">
                            commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
                        </label>
                    </div>
                </div>
                <div>
                    <button class="btn btn-success">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
