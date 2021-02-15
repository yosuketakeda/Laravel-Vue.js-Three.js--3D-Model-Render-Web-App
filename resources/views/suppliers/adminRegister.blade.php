@include('layouts.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container mt-3">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" class="logo">
            </div>
            <div class="card mb-3">
                <div class="card-header text-center form-title header">
                    <h4>Sign Up</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input name="admin" value="31" hidden>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                       required autocomplete autofocus placeholder="Full Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="phoneNumber" type="text" class="form-control form-control-lg" name="phoneNumber" required autocomplete placeholder="Phone Number">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="companyName" type="text" class="form-control form-control-lg" name="companyName" autocomplete placeholder="Company Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" value=""
                                       required placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control form-control-lg"
                                       name="password_confirmation" value="" required placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    Sign Up
                                </button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
            <div class="sign-up-footer text-center">
                <div class="log-in mb-2">
                    Already have an account?<a href="/suppliers" class="ml-2">Log in</a>
                </div>                
            </div>
        </div>
    </div>
</div>

<div id="policy-modal"></div>

@include('layouts.footer')