@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
  
  <div class="container-fluid h-100 bg-white">
    <div class="row justify-content-center">
      <div class="col-md-6 form-container mt-3">
        <div class="text-center mb-4 thanks-logo">
          <a href="{{route('orderHistory')}}"><img src="{{ asset('images/logo.png') }}" class="logo"></a>
        </div>
        <div class="text-center">
          <a href="{{route('orderHistory')}}">Click above to return to homepage.</a>
        </div>

        <div class="mb-3">
          <div class="text-center form-title header">
            <h4>We will contact you shortly to confirm your order.</h4>
          </div>

          <div class="card-body">
            <!--<div class="text-center w-75 mx-auto">
              <h6>A sales representative will reach out shortly to help you complete your order.</h6>
            </div>-->
            <div class="text-center">
              
            </div>
            <div class="order-detail text-center">
              <ul class="mb-2">
                <li>Order number <b>{{$order['order_number']}}</b></li>
              </ul>
            </div>
            <div class="terms-privacy-container mx-auto">
            @if(Session::has('pdf_check')) 
              <a href="{{ route('printPDF', [ 'order' => $order ]) }}">
                <img src="{{ asset('images/pdf-download.png') }}" class="pdf-download">
              </a>
              <br>
              <a href="{{ route('printPDF', [ 'order' => $order ]) }}">View order details with PDF</a>
            @endif
            </div>
          </div>
        </div>
        <div class="sign-up-footer text-center">
          <div class="footer-menu">
            <ul class="mb-2">
              <li><a href="#">Terms of Use</a></li>
              <li><a href="#">Compliance</a></li>
              <li><a href="#">Support</a></li>
              <li><a href="#">Contacts</a></li>
            </ul>
            <div>&#169; 2020 Rapid Closures. All rights reserved.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
