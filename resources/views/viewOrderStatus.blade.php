@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
    <div class="container-fluid px-0 h-100 bg-white viewOrderStatus">        
        @include('layouts.nav')
        <div class="title-bar">
            <div class="row">            
                <div class="item">
                    <p class="txt">Order Placed</p>
                    <p>{{$date}}</p>
                </div>
                <div class="item">
                    <p class="txt">Order Number</p>
                    <p>{{$orderNum}}</p>
                </div>
                <div class="item">
                    <p class="txt">Products</p>
                    @foreach($products as $pd)
                        <p>{{$pd}}</p>
                    @endforeach
                </div>
                <div class="item">
                    <p class="txt">Ordered By</p>
                    <p>{{$name}}</p>
                </div>
                <div class="item">
                    <p class="txt">Status</p>
                    {{$status}}
                </div>
            </div>
        </div>
        <div class="graphic-part">
            <div class="row">
                <div class="item">
                    <span class="bold-txt">New Order</span>
                </div>
                <div class="item">
                    <span class="bold-txt">Processing</span>
                </div>
                <div class="item">
                    <span class="bold-txt">Manufacturing</span>
                </div>
                <div class="item">
                    <span class="bold-txt">In Transit</span>
                </div>
                <div class="item">
                    <span class="bold-txt">Delivered</span>
                </div>
            </div>
            <div class="orderline"></div>
            <div class="row">
                <div class="item">
                    @if($statusNum == 0)
                        <img src="{{asset('images/orderStatus/New order-2.jpg')}}">
                    @else
                        <img src="{{asset('images/orderStatus/New order.jpg')}}">
                    @endif
                </div>
                <div class="item">
                    @if($statusNum == 1)
                        <img src="{{asset('images/orderStatus/Processing-2.jpg')}}">
                    @else
                        <img src="{{asset('images/orderStatus/Processing.jpg')}}">
                    @endif
                </div>
                <div class="item">
                    @if($statusNum == 2)
                        <img src="{{asset('images/orderStatus/Manufacturing-2.jpg')}}">
                    @else
                        <img src="{{asset('images/orderStatus/Manufacturing.jpg')}}">
                    @endif
                </div>
                <div class="item">
                    @if($statusNum == 3)
                        <img src="{{asset('images/orderStatus/In Transit-2.jpg')}}">
                    @else
                        <img src="{{asset('images/orderStatus/In Transit.jpg')}}">
                    @endif
                </div>
                <div class="item">
                    @if($statusNum == 4)
                        <img src="{{asset('images/orderStatus/Delivered-2.jpg')}}">
                    @else
                        <img src="{{asset('images/orderStatus/Delivered.jpg')}}">
                    @endif
                </div>
            </div>
            
        </div>
        <div class="bottom-part">
            <a href="{{route('emailContact', ['orderNumber' => $orderNum])}}">Email Query</a>
            <a href="{{route('orderAgain', ['orderID' => $orderID])}}">Order Again</a>
        </div>
    </div>

@endsection
@push('after-scripts')

<script type="application/javascript" src="{{asset('js/admin.js')}}"></script>

@endpush