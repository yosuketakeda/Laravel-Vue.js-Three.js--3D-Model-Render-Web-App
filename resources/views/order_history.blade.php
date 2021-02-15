@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/countrySelect.css')}}">
@endpush
@section('content')
    <div class="container-fluid px-0 h-100 bg-white">        
        @include('layouts.nav')
        <div class="row m-0 px-2 mt-5">            
            <div class="col-md-3">
                <div class="card active" id="allOrders">
                    All Orders
                </div>
                <div class="card" id="newOrders">
                    New Orders
                </div>
                <div class="card" id="processingOrders">
                    Processing
                </div>
                <div class="card" id="confirmOrders">
                    Order Confirmed
                </div>
                <div class="card" id="manufacturingOrders">
                    Manufacturing
                </div>
                <div class="card" id="inTransitOrders">
                    In Transit
                </div>
                <div class="card" id="deliveredOrders">
                    Delivered
                </div>               
                @if($permission == 21)
                <div class="card" id="userManagement">
                    User Management
                </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="allOrders-form sub-panel">
                    <h3>All Orders</h3>
                    <div class="panel-container">
                        <table>
                            <tr class="title">
                                <td>Order Number</td>
                                <td>Date</td>
                                <td>Request Delivery Date</td>
                                <td>Products</td>
                                <td>Status</td>
                            </tr>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->orderNumber}}</td>
                                <td>
                                    <?php 
                                        $createdDate = $order->created_at;
                                        $buf = explode(" ", $createdDate);
                                        $createdDate = $buf[0];
                                        $buf = explode("-", $createdDate);
                                        $result=$buf[1]."/".$buf[2]."/".$buf[0];
                                        echo $result;
                                    ?>
                                </td>
                                <td>
                                    {{$order->deliveryDate}}
                                    <!--<input type="text" class="datepicker" name="deliveryDate" readonly="readonly">-->
                                </td>
                                <td>
                                    <a href="javascript:void(0)" onclick="viewOrderContents('{{$order->orders}}', '{{$order->quantities}}')"><i class="fa fa-eye" aria-hidden="true"></i></a>   
                                </td>
                                <td>
                                    <a href="{{route('viewOrderStatus', ['id' => $order->id])}}" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="newOrders-form sub-panel">
                    <h3>New Orders</h3>
                    <div class="panel-container">
                        <table>
                            <tr class="title">
                                <td>Order Number</td>
                                <td>Date</td>
                                <td>Request Delivery Date</td>
                                <td>Products</td>
                                <td>Status</td>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->orderStatus == 0)
                                <tr>
                                    <td>{{$order->orderNumber}}</td>
                                    <td>
                                        <?php 
                                            $createdDate = $order->created_at;
                                            $buf = explode(" ", $createdDate);
                                            $createdDate = $buf[0];
                                            $buf = explode("-", $createdDate);
                                            $result=$buf[1]."/".$buf[2]."/".$buf[0];
                                            echo $result;
                                        ?>
                                    </td>
                                    <td>{{$order->deliveryDate}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="viewOrderContents('{{$order->orders}}', '{{$order->quantities}}')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('viewOrderStatus', ['id' => $order->id])}}" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="processingOrders-form sub-panel">
                    <h3>Processing Orders</h3>
                    <div class="panel-container">
                        <table>
                            <tr class="title">
                                <td>Order Number</td>
                                <td>Date</td>
                                <td>Request Delivery Date</td>
                                <td>Products</td>
                                <td>Status</td>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->orderStatus == 1)
                                <tr>
                                    <td>{{$order->orderNumber}}</td>
                                    <td>
                                        <?php 
                                            $createdDate = $order->created_at;
                                            $buf = explode(" ", $createdDate);
                                            $createdDate = $buf[0];
                                            $buf = explode("-", $createdDate);
                                            $result=$buf[1]."/".$buf[2]."/".$buf[0];
                                            echo $result;
                                        ?>
                                    </td>
                                    <td>{{$order->deliveryDate}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="viewOrderContents('{{$order->orders}}', '{{$order->quantities}}')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('viewOrderStatus', ['id' => $order->id])}}" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="confirmOrders-form sub-panel">
                    <h3>Order Confirmed</h3>
                    <div class="panel-container">
                        
                    </div>
                </div>
                <div class="manufacturingOrders-form sub-panel">
                    <h3>Manufacturing</h3>
                    <div class="panel-container">
                        <table>
                            <tr class="title">
                                <td>Order Number</td>
                                <td>Date</td>
                                <td>Request Delivery Date</td>
                                <td>Products</td>
                                <td>Status</td>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->orderStatus == 2)
                                <tr>
                                    <td>{{$order->orderNumber}}</td>
                                    <td>
                                        <?php 
                                            $createdDate = $order->created_at;
                                            $buf = explode(" ", $createdDate);
                                            $createdDate = $buf[0];
                                            $buf = explode("-", $createdDate);
                                            $result=$buf[1]."/".$buf[2]."/".$buf[0];
                                            echo $result;
                                        ?>
                                    </td>
                                    <td>{{$order->deliveryDate}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="viewOrderContents('{{$order->orders}}', '{{$order->quantities}}')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('viewOrderStatus', ['id' => $order->id])}}" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="inTransitOrders-form sub-panel">
                    <h3>In Transit</h3>
                    <div class="panel-container">
                        <table>
                            <tr class="title">
                                <td>Order Number</td>
                                <td>Date</td>
                                <td>Request Delivery Date</td>
                                <td>Products</td>
                                <td>Status</td>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->orderStatus == 3)
                                <tr>
                                    <td>{{$order->orderNumber}}</td>
                                    <td>
                                        <?php 
                                            $createdDate = $order->created_at;
                                            $buf = explode(" ", $createdDate);
                                            $createdDate = $buf[0];
                                            $buf = explode("-", $createdDate);
                                            $result=$buf[1]."/".$buf[2]."/".$buf[0];
                                            echo $result;
                                        ?>
                                    </td>
                                    <td>{{$order->deliveryDate}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="viewOrderContents('{{$order->orders}}', '{{$order->quantities}}')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('viewOrderStatus', ['id' => $order->id])}}" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="deliveredOrders-form sub-panel">
                    <h3>Delivered Orders</h3>
                    <div class="panel-container">
                        <table>
                            <tr class="title">
                                <td>Order Number</td>
                                <td>Date</td>
                                <td>Request Delivery Date</td>
                                <td>Products</td>
                                <td>Status</td>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->orderStatus == 4)
                                <tr>
                                    <td>{{$order->orderNumber}}</td>
                                    <td>
                                        <?php 
                                            $createdDate = $order->created_at;
                                            $buf = explode(" ", $createdDate);
                                            $createdDate = $buf[0];
                                            $buf = explode("-", $createdDate);
                                            $result=$buf[1]."/".$buf[2]."/".$buf[0];
                                            echo $result;
                                        ?>
                                    </td>
                                    <td>{{$order->deliveryDate}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="viewOrderContents('{{$order->orders}}', '{{$order->quantities}}')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('viewOrderStatus', ['id' => $order->id])}}" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="userManageOrders-form sub-panel">
                    <h3>User Management</h3>
                    <div class="panel-container">                        
                        <table class="all">
                            <tr class="title">
                                <td>ID</td>
                                <td>Name</td>
                                <td>Reset Password</td>
                                <td>Permission</td>
                                <td>Action</td>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf                                        
                                            <input type="email" name="email" value="{{$user->email}}" hidden>
                                            <button type="submit" class="admin_email_reset">
                                                Email Reset
                                            </button>
                                        </form>
                                    </td>
                                    <td>                                       
                                        <input class="user-id" value="{{$user->id}}" hidden>           
                                        <select class="permission-part">
                                            <option value="22" {{$user->permission == 22 ? "selected" : ""}}>Editor</option>
                                            <option value="23" {{$user->permission == 23 ? "selected" : ""}}>Viewer</option>
                                        </select>                                       
                                    </td>
                                    <td>
                                        <a class="admin_email_reset" href="javascript:void(0)" onclick="userEdit('{{$user->id}}','{{$user->name}}', '{{$user->address1}}', '{{$user->address2}}', '{{$user->city}}', '{{$user->region}}', '{{$user->zipcode}}', '{{$user->country}}')">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>                        
                    </div>
                </div>
            </div>
        </div>

        <!-- ============ Preloading =========== -->
        <div class="se-pre-con"></div>
        
        <!-- Modals -->
        
        <div class="modal fade" id="alertModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="modal-title">Please decide the quantity in the red colored field.</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('after-scripts')

<script type="application/javascript" src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/countrySelect.js')}}"></script>
<script>
    // delivery date
    var d = new Date(), day = d.getDate(), m = d.getMonth(), y = d.getFullYear();
    // month -- 0 ~ 11
    var delivery_month = m + 3;
    if(delivery_month > 12){
        y++;
        delivery_month -= 12;
    }

    var $datepicker = $('#datepicker');
    $datepicker.datepicker();
    $datepicker.datepicker('setDate', delivery_month + "/" + day + "/" + y);
    
    var months=["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    // next button in clendar
    $(document).on("click",".ui-datepicker-next",function() {            
        $(".ui-datepicker-prev").css("display", "block");
    });
    // prev button in calendar
    $(document).on("click", ".ui-datepicker-prev", function(){            
        var month = $(".ui-datepicker-month").text();            
        var index = months.indexOf(month) + 1;
                    
        if(index > delivery_month){
            $(".ui-datepicker-prev").css("display", "block");
        }else{
            var year = $(".ui-datepicker-year").text();
            if(year > y){
                $(".ui-datepicker-prev").css("display", "block");
            }else{
                $(".ui-datepicker-prev").css("display", "none");
            }
        }
    });
    // open calendar
    $("#datepicker").click(function(){
        var date = $("#datepicker").val();
        var dates = date.split("/");
        var sltmonth = dates[0];
        var sltyear = dates[2];
        if(sltmonth > delivery_month){                
            $(".ui-datepicker-prev").css("display", "block");
        }else{
            if(sltyear > y){
                $(".ui-datepicker-prev").css("display", "block");
            }
        }
    });
    // select the day in calendar
    $("#datepicker").change(function(){
        var date = $("#datepicker").val();
        var dates = date.split("/");
        var sltmonth = dates[0];
        var sltday = dates[1];
        var sltyear = dates[2];
        if(sltyear == y && sltmonth == delivery_month){
            if(sltday < day){
                $("#alertModal2").modal("show");
                $datepicker.datepicker('setDate', delivery_month + "/" + day + "/" + y);
            }
        }            
    });

    function userEdit(id, name, address1, address2, city, region, zipcode, country){
        // remove added old modal
        $("#userAdminModal").remove();
        ////
        var modal =  '<div class="modal fade" id="userAdminModal" tabindex="-1" role="dialog">'+
            '<div class="modal-dialog">'+
                '<div class="modal-content">'+
                    '<div class="modal-header border-0">'+
                        '<h3 class="modal-title">Contact Details</h3>'+
                    '</div>'+
                    '<div class="modal-body border-0">'+
                        '<div class="row">'+
                            '<div class="col-4">Full Name</div>'+
                            '<div class="col-8">'+
                                '<input class="name" type="text" name="name" value="'+name+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-4">Address Line 1</div>'+
                            '<div class="col-8">'+
                                '<input class="address1" type="text" name="address1" value="'+address1+'">'+
                                '<p>Street address, P.O box, company name, c/o</p>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-4">Address Line 2</div>'+
                            '<div class="col-8">'+
                                '<input class="address2" type="text" name="address2" value="'+address2+'">'+
                                '<p>Appartment, suite, unit, building, floor, ect.</p>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-4">City</div>'+
                            '<div class="col-8">'+
                                '<input class="city" type="text" name="city" value="'+city+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-4">State/Province/Region</div>'+
                            '<div class="col-8">'+
                                '<input class="region" type="text" name="region" value="'+region+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-4">Zip/Postal Code</div>'+
                            '<div class="col-8">'+
                                '<input class="zipcode" type="text" name="zipcode" value="'+zipcode+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-4">Country</div>'+
                            '<div class="col-8">'+
                                '<input type="text" id="country_selector" name="country" value="">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="modal-footer border-0">'+
                        '<button type="button" class="btn btn-outline-primary rounded-pill update" data-dismiss="modal" onclick="updateUser('+id+')">Update</button>'+
                        '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">Cancel</button>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';
        ////
        $("body").append(modal);
        $("#userAdminModal").modal("show");

        $("#country_selector").countrySelect({
            defaultStyling:"inside",
            preferredCountries: ['us', 'cn']
        });
        if(country.length > 0){
            $("#country_selector").countrySelect("setCountry", country);
        }else{
            $("#country_selector").countrySelect({
                defaultCountry:"us"
            }); 
        }
    }
    function updateUser(id){
        var name = $("#userAdminModal .name").val();
        var address1 = $("#userAdminModal .address1").val();
        var address2 = $("#userAdminModal .address2").val();
        var city = $("#userAdminModal .city").val();
        var region = $("#userAdminModal .region").val();
        var zipcode = $("#userAdminModal .zipcode").val();
        var country = $("#country_selector").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('updateUser')}}",
            type: "POST",
            data: {"id":id, "name":name, "address1":address1, "address2":address2, "city":city, "region":region, "zipcode":zipcode, "country":country},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {     
                location.reload();
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
    // change permission
    $(".permission-part").change(function(e){
        var val = $(e.target).val();
        var userID = $(e.target).closest("td").find(".user-id").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('changeUserPermission')}}",
            type: "POST",
            data: {"id":userID, "permission":val},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                console.log(data.name);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    });
</script>

@endpush