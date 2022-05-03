@extends('auth.app')

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
    
    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Registration form -->
        <form class="login-form" name="register" action="{{ route('register') }}" method="post" onsubmit="return validateForm()">
            @csrf
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-pill p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">{{ __('Create account') }}</h5>
                        <span class="d-block text-muted">{{ __('All fields are required') }}</span>
                    </div>

                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">{{ __('Your credentials') }}</span>
                    </div>

                    <!-- Surname -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" placeholder="Your surname" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <!-- First name -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" placeholder="Your first name" autofocus>
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <!-- Last name -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" placeholder="Your last name" autofocus>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>
																					
                    <!-- Username -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-control-feedback">
                            <i class="icon-user-check text-muted"></i>
                        </div>
                        <span class="badge badge-info form-text text-wrap">Must be 30 characters or less, letters, digits and @/./+/-/_ only</span>
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <div class="input-group">
                            <input type="password" placeholder="Password" class="form-control border-right-0 @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="password" oninput="(this.value == document.getElementById('password_confirm').value) ? document.querySelector('button[type=submit]').removeAttribute('disabled', false) : document.querySelector('button[type=submit]').setAttribute('disabled', true)" />
                            <span class="input-group-append" style="margin-top: 1px;margin-bottom: -1px;">
                                <i class="icon-eye btn border border-left-0" onclick="togglePasswordView(this)" style="line-height: 20px;border: 2px solid #ddd !important; border-radius: 0 0.8rem 0.8rem 0"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>

                    <!-- Confirm password -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <input id="password_confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation" placeholder="Confirm password" oninput="(this.value == document.getElementById('password').value) ? document.querySelector('button[type=submit]').removeAttribute('disabled', false) : document.querySelector('button[type=submit]').setAttribute('disabled', true)" />
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                        <span id='psw_confirm_error'></span>
                    </div>
                    
                    <!-- Contact section -->
                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">{{ __('Your contacts') }}</span>
                    </div>
    
                    <!-- Email -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <input type="email" name="email" class="form-control" placeholder="{{ __('Your email') }}">
                        <div class="form-control-feedback">
                            <i class="icon-mention text-muted"></i>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="form-group form-group-feedback form-group-feedback-left mb-2">
                        <input type="tel" name="phone_number" class="form-control" placeholder="Phone number" pattern="[0-9]{5}[0-9]{3}[0-9]{3}">
                        <div class="form-control-feedback">
                            <i class="icon-phone text-muted"></i>
                        </div>
                    </div>
				
                    <!-- Additional section -->
                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">{{ __('Additions') }}</span>
                    </div>

                    <!-- test account -->
                    <div class="form-group">
                        <label class="custom-control custom-switch mb-2">
                            <input type="checkbox" name="acct" class="custom-control-input" checked>
                            <span class="custom-control-label">{{ __('Send me') }} <a href="#">&nbsp;{{ __('test account settings') }}</a></span>
                        </label>

                        <!-- news -->
                        <label class="custom-control custom-switch mb-2">
                            <input type="checkbox" name="news" class="custom-control-input" checked>
                            <span class="custom-control-label">{{ __('Subscribe to monthly newsletter') }}</span>
                        </label>

                        <!-- terms of service (tos) -->
                        <label class="custom-control custom-switch">
                            <input type="checkbox" id='tos' name="tos" class="custom-control-input">
                            <span class="custom-control-label">{{ __('Accept') }} <a href="#">&nbsp;{{ __('terms of service') }}</a></span>
                        </label>
                    </div>

                    <button type="submit" id='submit' class="btn btn-teal btn-block" disabled>{{ __('Register') }}</button>
                </div>
            </div>
        </form>
        <!-- /registration form -->
    </div>
    <!-- /content area -->

    <script>
        function confirmPassword(ps2) {
            ps1 = document.getElementById('password').value;
            if(ps2 != ps1) {
                document.getElementById('psw_confirm_error').innerHTML = 'Password does not match';
                document.getElementById('psw_confirm_error').style.color = 'red';
                // document.getElementById('submit').setAttribute('disabled', true);
            } else {
                document.getElementById('psw_confirm_error').innerHTML = 'Password match';
                document.getElementById('psw_confirm_error').style.color = 'green';
                // document.getElementById('submit').removeAttribute('disabled')
            }
        }

        function validateForm() {
            let ps1 = document.getElementById('password').value;
            let ps2 = document.getElementById('password_confirm').value;
            let tos = document.forms["register"]["tos"];
            if (tos.checked == false) {
                alert("You need to accept our terms of service to continue");
                return false;
            }
            if (ps2 != ps1) {
                alert("You need to confirm your password to continue");
                return false;
            }
        }
    </script>
@endsection
