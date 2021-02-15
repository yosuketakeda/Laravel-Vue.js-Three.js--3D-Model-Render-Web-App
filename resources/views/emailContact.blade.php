@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
    <div class="container-fluid px-0 h-100 bg-white viewOrderStatus">        
        @include('layouts.nav')
        <div class="contact-form">
            <form method="POST" action="{{ route('emailSend') }}" id="contactForm">
                {{ csrf_field() }}  
                <input type="text" name="orderNumber" value="{{$orderNumber}}" hidden>              
                <div class="form-title mb-3">
                    <h4>Customer Order Information</h4>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name" value="" placeholder="Name" required>
                        <!-- Error -->
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        <input id="company" type="text" class="form-control" name="company" value=""
                            placeholder="Company" required>
                        <!-- Error -->
                        @if ($errors->has('company'))
                        <span class="text-danger">{{ $errors->first('company') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        <input id="phone" type="tel" class="form-control" name="phone" value=""
                            placeholder="Phone"   >
                        <!-- Error -->
                        @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        <input id="email" type="text" class="form-control" name="email" value=""
                            placeholder="Email" required>
                        <!-- Error -->
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <span class="wrong-email">The email format is not correct.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10" style="color: #2eaae1; font-size: 20px; font-weight: bold;">
                        Quote Number : {{$orderNumber}}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        <textarea id="note" type="text" class="form-control" name="note" value="" placeholder="Notes" rows="8" required></textarea>
                    </div>
                </div>
                </br>
                <div class="form-group row">
                    <div class="col-md-5">
                        <a href="{{route('viewOrderStatus', ['id' => $orderID])}}" class="btn btn-lg w-100 btn-outline-primary rounded-pill">Back</a>
                    </div>
                    <div class="col-md-5">
                        <button class="btn btn-primary btn-lg w-100 rounded-pill submitEvent">
                            Submit
                        </button>                            
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('after-scripts')

<script type="application/javascript" src="{{asset('js/admin.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".submitEvent").click(function(){
            var email = $("#email").val();
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
                $(".wrong-email").css("display", "block");
                return false;
            }                        
        });
    });
</script>
@endpush