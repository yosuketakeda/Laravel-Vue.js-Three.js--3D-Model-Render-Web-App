@include('layouts.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container mt-3">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" class="logo">
            </div>
            <div class="card mb-3">
                <div class="text-center form-title header">
                    <h4>Log In</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{route('login')}}" id="suppliersForm">
                        @csrf                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                       required autocomplete autofocus placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                        
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <button href="javascript:void(0)" class="btn btn-primary btn-lg w-100 suppliersCheck">
                                    Log In
                                </button>
                            </div>
                        </div>
                        
                        <div class="terms-privacy-container mx-auto">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="sign-up-footer text-center">
                <div class="log-in mb-2">
                    Don't have an account<a href="{{route('suppliers.register')}}" class="ml-2">Sign Up</a>
                </div>                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="emptyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">This email was not registered. Please sign up.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lockedModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">Sorry. This account was locked.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="suppliersModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">This account is not the supplier account.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="suppliersAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">If you are the account owner, please ensure you login to rapidclosure.com/suppliers-admin</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    
    $(".suppliersCheck").click(function(e){    
        e.preventDefault();

        var email = $("#email").val();
        console.log(email);
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('suppliers.check')}}",
            type: "POST",
            data: {"emailTxt": email},
            success: function (data) {  
                console.log(data.check);
                if(data.check == -1){  // empty
                    $("#emptyModal").modal('show');                    
                }else if(data.check == 0){  // locked
                    $("#lockedModal").modal("show");
                }else if(data.check == 1){
                    $("#suppliersForm").submit();
                }else if(data.check == 2){
                    $("#suppliersAdminModal").modal("show");
                }else{  // not suppliers
                    $("#suppliersModal").modal("show");
                }
            },
            error: function(data) {
                console.log("Errors!!");
            }
        });
    });
</script>

