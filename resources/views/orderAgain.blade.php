@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
    <div class="container-fluid px-0 h-100 bg-white viewOrderStatus">        
        @include('layouts.nav')
    </div>

@endsection
@push('after-scripts')

<script type="application/javascript" src="{{asset('js/admin.js')}}"></script>

@endpush