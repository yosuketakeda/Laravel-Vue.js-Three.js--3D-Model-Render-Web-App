@include('layouts.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container mt-3">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" class="logo">
            </div>
            <div class="card mb-3">
                <div class="text-center form-title header">
                    <h4>Reset Password</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                       required autocomplete="email" autofocus placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="sign-up-footer text-center">
                <div class="mb-2">
                    <a href="{{ route('login') }}" class="ml-2"><i class='fa fa-arrow-left mr-2'></i>Go Back</a>
                </div>
                <div class="footer-menu">
                    <ul class="mb-2">
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Compliance</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
                    <div>&#169; 2020 Stracos. All rights reserved.</div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')