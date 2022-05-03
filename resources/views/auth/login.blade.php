@extends('auth.app')

@section('content')

    <!-- Inner content -->
    <div class="content-inner content-wrapper pt-5">

        <div class="content d-flex justify-content-center align-items-center">

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
    
            <!-- Login form -->
            <form class="login-form" action="{{ route('login') }}" method="post">
                @csrf
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-reading icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">{{ __('Login to your account') }}</h5>
                            <span class="d-block text-muted">{{ __('Enter your credentials below') }}</span>
                        </div>
                        
                        <!-- Username field -->
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <!-- Password field -->
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <div class="input-group">
                                <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
                                <i class="icon-lock2 text-muted"></i>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label class="custom-control custom-switch">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                <span class="custom-control-label">{{ __('Remember Me') }}</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="login">{{ __('Sign in') }}</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
