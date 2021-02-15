@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/countrySelect.css')}}">
@endpush
@section('content')
<!-- link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" -->

<div class="container-fluid  px-0 h-100">
    @include('layouts.nav_sec')
    <div class="row m-0 px-5 mt-5">
        <div class="col-md-3">
            <div class="card active" id="myProducts">
                My Products
            </div>
            <div class="card" id="orderTracking">
                Order Tracking
            </div>
            @if($loggedInPermission == 31)
            <div class="card" id="userAdmin">
                User Administration
            </div>
            @endif
        </div>
        <div class="col-md-9 suppliers">
            <div class="myProducts-form sub-panel">
                <h3>My Products</h3>
                <div class="panel-container">
                    <div class="table-panel">
                        <table>
                            <tr class="title">
                                <td>Product Code</td>
                                <td>Product Name</td>
                                <td>Min Order Quantity</td>
                                <td>View</td>
                            </tr>
                            @if(!empty($products))
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->product_code}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="viewOriginalProduct('{{$product->vrml_name}}')"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach                            
                            @endif
                        </table>
                    </div>
                </div>
            </div>            
            <div class="orderTracking-form sub-panel">
                <h3>Order Tracking</h3>
                <div class="panel-container">
                    <div class="table-panel">
                        <table>
                            <tr class="title">
                                <td>Order Number</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Phone Number</td>
                                <td>Company</td>
                                <td>Order Contents</td>
                                <td>Order Date</td>
                                <td>Request Delivery Date</td>
                                <td>Order Status</td>
                                <td>Order Quantity</td>
                            </tr>
                            @if(!empty($orders))
                            @foreach($orders as $order)
                                @if(!empty($order))
                                <tr>
                                    <td>{{$order[0]->orderNumber}}</td>
                                    <td>{{$order[0]->name}}</td>
                                    <td>{{$order[0]->email}}</td>
                                    <td>{{$order[0]->phone}}</td>
                                    <td>{{$order[0]->company}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="viewOrderContentsSuppliers('{{$order[0]->orders}}', '{{$order[0]->quantities}}')">View</a>
                                    </td>
                                    <td>
                                        <?php 
                                            $createdDate = $order[0]->created_at;
                                            $buf = explode(" ", $createdDate);
                                            $createdDate = $buf[0];
                                            $buf = explode("-", $createdDate);
                                            $result=$buf[1]."/".$buf[2]."/".$buf[0];
                                            echo $result;
                                        ?>
                                    </td>
                                    <td>{{$order[0]->deliveryDate}}</td>
                                    <td>
                                    @if($loggedInPermission < 33)
                                        <input class="order-id" value="{{$order[0]->id}}" hidden>
                                        @if($order[0]->orderStatus == 0)
                                            <span style="color: #fe001a" class="txt-order">New Order</span>
                                        @elseif($order[0]->orderStatus == 1)
                                            <select class="setOrder-admin order-{{$order[0]->id}}">
                                                <option value="1" selected>In Processing</option>
                                                <option value="2" >Manufacturing</option>
                                                <option value="3" >In Transit</option>
                                                <option value="4" >Delivered</option>
                                            </select>
                                        @elseif($order[0]->orderStatus == 2)
                                            <select class="setOrder-admin order-{{$order[0]->id}}">
                                                <option value="1" >In Processing</option>
                                                <option value="2" selected>Manufacturing</option>
                                                <option value="3" >In Transit</option>
                                                <option value="4" >Delivered</option>
                                            </select>
                                        @elseif($order[0]->orderStatus == 3)
                                            <select class="setOrder-admin order-{{$order[0]->id}}">                                           
                                                <option value="1" >In Processing</option>    
                                                <option value="2" >Manufacturing</option>
                                                <option value="3" selected>In Transit</option>
                                                <option value="4" >Delivered</option>
                                            </select>
                                        @else
                                            <select class="setOrder-admin order-{{$order[0]->id}}">  
                                                <option value="1" >In Processing</option>                                             
                                                <option value="2" >Manufacturing</option>
                                                <option value="3" >In Transit</option>
                                                <option value="4" selected>Delivered</option>
                                            </select>
                                        @endif
                                    @else
                                        @if($order[0]->orderStatus == 0)
                                            <span style="color: #fe001a" class="txt-order">New Order</span>
                                        @elseif($order[0]->orderStatus == 1)
                                            <span style="color: #fe8d47" class="txt-order">In Processing</span>
                                        @elseif($order[0]->orderStatus == 2)
                                            <span style="color: #d8c704" class="txt-order">Manufacturing</span>
                                        @elseif($order[0]->orderStatus == 3)
                                            <span style="color: #29b8f1" class="txt-order">In Transit</span>
                                        @else
                                            <span style="color: #45c703" class="txt-order">Delivered</span>
                                        @endif
                                    @endif
                                    </td>
                                    <td>
                                        {{$quantities[$order[0]->orderNumber]}}
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="supplier-product-view-form sub-panel">
                <h3>Product Details</h3>
                <div class="panel-container">
                    <div class="row">
                        <div class="col-4">
                            <div class="thumbnail-rect">
                                <img id="thumbnail-IMG" src="#" alt="Product Thumbnail">
                            </div>
                            <div class="product-description">
                                <h5>Product Description:</h5>
                                <div class="txt"></div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="supplier-product-name-title">                                
                            </div>
                            <table class="supplier-product-details">
                                <tr>
                                    <td class="txt">Product Code</td>
                                    <td class="supplier-product-code"></td>
                                </tr>
                                <tr>
                                    <td class="txt">Product Name</td>
                                    <td class="supplier-product-name"></td>
                                </tr>
                                <tr>
                                    <td class="txt">Min Order Quantity</td>
                                    <td class="supplier-product-quantity"></td>
                                </tr>                                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if($loggedInPermission == 31)
            <div class="userAdmin-form sub-panel">
                <h3>User Administration</h3>
                <div class="panel-container">                    
                    <table>
                        <tr class="title">
                            <td>ID</td>
                            <td>Name</td>
                            <td>Reset Password</td>
                            <td>Permission</td>
                            @if($loggedInPermission == 31)
                                <td>Action</td>
                            @endif
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
                                    @if($loggedInPermission == 31)
                                        <select class="permission-part">
                                            <option value="32" {{$user->permission == 32 ? "selected" : ""}}>Editor</option>
                                            <option value="33" {{$user->permission == 33 ? "selected" : ""}}>Viewer</option>
                                        </select>
                                    @else
                                        @if($user->permission == 32)
                                            <span>Editor</span>
                                        @elseif($user->permission == 33)
                                            <span>Viewer</span>
                                        @endif
                                    @endif
                                </td>
                                @if($loggedInPermission == 31)
                                    <td>
                                        <a class="admin_email_reset" href="javascript:void(0)" onclick="supplierUserEdit('{{$user->id}}','{{$user->name}}', '{{$user->address1}}', '{{$user->address2}}', '{{$user->city}}', '{{$user->region}}', '{{$user->zipcode}}', '{{$user->country}}')">Edit</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ============ Preloading =========== -->
<div class="se-pre-con"></div>

@endsection
@push('after-scripts')
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/countrySelect.js')}}"></script>
<script>
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

    // Set Order Status
    $(".setOrder-admin").change(function(e){
        var val = $(e.target).val();
        var orderID = $(e.target).closest("td").find(".order-id").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('changeOrderStatus')}}",
            type: "POST",
            data: {"id":orderID, "status":val},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {     
                //console.log(data.status);
                var txt = $(".order-"+data.id).closest('tr').find('.txt-order');
                switch(data.status){
                    case "0":                         
                        txt.text("New Order");
                        txt.css("color", "#fe001a");
                        break;
                    case "1":
                        txt.text("Processing");
                        txt.css("color", "#fe8d47");
                        break;
                    case "2":
                        txt.text("Manufacturing");
                        txt.css("color", "#d8c704");
                        break;
                    case "3": 
                        txt.text("In Transit");
                        txt.css("color", "#29b8f1");
                        break;
                    case "4": 
                        txt.text("Delivered");
                        txt.css("color", "#45c703");
                        break;
                    default:                        
                }
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    });

    function viewOriginalProduct(vrml){
        $(".supplier-product-view-form").css("display", "block");
        $(".myProducts-form ").css("display", "none");
        $(".supplier-product-name-title").text(vrml);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('suppliers.productDetails')}}",
            type: "POST",
            data: {"vrml":vrml},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {     
                var vrml_img = (data.vrml).replace(".wrl", ".png");
                $("#thumbnail-IMG").attr("src","/images/products/"+vrml_img);
                $("#thumbnail-IMG").css("display", "block");
                $(".supplier-product-code").text(data.pd_code);
                $(".supplier-product-name").text(data.pd_name);
                $(".supplier-product-quantity").text(data.pd_quantity);  
                $(".product-description .txt").text(data.pd_description);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }

    function supplierUserEdit(id, name, address1, address2, city, region, zipcode, country){
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

</script>
@endpush

