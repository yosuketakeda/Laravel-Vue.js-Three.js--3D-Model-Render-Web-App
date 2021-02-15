@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
    <div class="container-fluid px-0 h-100 bg-white">        
        @include('layouts.nav')
        <div class="row m-0 px-5 mt-5">            
            <div class="col-md-8 border rounded">
                <div class="quoteNumber">
                    Quote Number : {{empty($reflag) ? $orderNumber : $reOrderNumber}}
                </div>            
                <ul class="list-group list-group-flush bg-white px-4 component-sidebar mt-2">                    
                    @foreach($cartData as $data)
                    <div class="para">
                        <h4>{{$data[0]}}</h4>
                        <li class="d-flex justify-content-between align-items-center component-item mb-4">                            
                            <span class="col-md-10">                             
                                <span class="col-md-12 d-flex">
                                    <span class="col-md-6">                               
                                    <?php $i=0;?>
                                    @foreach($data as $d)
                                        <?php
                                            if($i > 0){
                                                $buf = explode("-", $d);
                                                ?>
                                                <div>                                        
                                                    <span class="comp-name">{{$buf[0]}}: #{{$buf[1]}}</span>
                                                    <span style="background: #{{$buf[1]}}" class="comp-color"></span>
                                                </div>
                                            <?php }
                                            $i++;
                                        ?>    
                                    @endforeach
                                    @if(!empty($reflag))
                                    <div class="delete">
                                        <button class="del-order">Delete</button>
                                    </div>
                                    @endif
                                    </span>
                                    <span class="col-md-6">
                                    <img class="product-img" src="../images/cart/{{$orderNumber}}/{{$data[0]}}.jpg">
                                    </span>
                                </span>
                            </span>                            
                            <span class="col-md-2">
                                <span class="quantity-txt">Quantity <span style="color: red; font-size: 20px"> *</span></span>
                                <input type="number" class="quantity form-control form-control-lg" name="quantity" value="">
                            </span>
                        </li>
                    </div>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4">
                <form method="POST" action="{{ route('thanks') }}" id="contactForm">
                    {{ csrf_field() }}
                    <input type="text" name="orderNumber" value="{{empty($reflag) ? $orderNumber : $reOrderNumber}}" hidden>
                    <input type="text" name="reflag" value="{{empty($reflag) ? 0 : 1}}" hidden>
                    <input type="text" name="preOrderNum" value="{{$orderNumber}}" hidden>
                    <input type="text" id="cartStr" name="cartStr" value="{{$cartStr}}" hidden>
                    <input type="text" name="quantities" class="quantities" value="" hidden>
                    <div class="form-title mb-3">
                        <h4>Requested Delivery Date</h4>
                        <input type="text" id="datepicker" name="deliveryDate" readonly="readonly">
                        <i class="contact-calendar fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <div class="form-group row">
                        
                    </div> 
                    <div class="form-title mb-3">
                        <h4>Customer Order Information</h4>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="" placeholder="Name" required>
                            <!-- Error -->
                            <!--@if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif-->
                            <span class="text-danger name">This field is required.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="company" type="text" class="form-control" name="company" value=""
                                placeholder="Company" required>
                            <!-- Error -->
                            <!--@if ($errors->has('company'))
                            <span class="text-danger">{{ $errors->first('company') }}</span>
                            @endif-->
                            <span class="text-danger company">This field is required.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="phone" type="tel" class="form-control" name="phone" value=""
                                placeholder="Phone"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                            <!-- Error -->
                            <!--@if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif-->
                            <span class="text-danger phone">This field is required.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control" name="email" value=""
                                placeholder="Email" required>
                            <!-- Error -->
                            <!--@if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif--> 
                            <span class="text-danger email">This field is required.</span>
                            <span class="wrong-email">The email format is not correct.</span>
                        </div>
                    </div>
                    <div class="form-group form-check row">
                        <div class="col-md-12 text-muted">
                            <input type="checkbox" name="pdf_check" class="form-check-input" id="save-summary-pdf">
                            <label class="form-check-label" for="save-summary-pdf">
                            An email summary will be sent to you shortly, would you also like to save as PDF at this time?
                            </label>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea id="note" type="text" class="form-control" name="note" value="" placeholder="Notes" rows="8"></textarea>
                        </div>
                    </div>
                    </br>
                    <div class="form-group row">
                        <div class="col-md-6">
                            @if(empty($reflag))
                            <a href="{{ url('/product-customization') }}" class="btn btn-lg w-100 btn-outline-primary rounded-pill">Back</a>
                            @else
                            <a href="{{route('viewOrderStatus', ['id' => $orderID])}}" class="btn btn-lg w-100 btn-outline-primary rounded-pill">Back</a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-lg w-100 rounded-pill submitEvent">
                                Submit
                            </button>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
        <div class="modal fade" id="alertModal2" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="modal-title">The delivery date must be over at least 2 months.</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h3 class="modal-title" id="confirmationModal">Are you sure?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-primary rounded-pill"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary rounded-pill" id="continue">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
<script>
    $(document).ready(function(){
        $(".submitEvent").click(function(){            
            var quantities = "";
            var flag = 0;
            $(".quantity").each(function(){
                $(this).css("border","1px solid #ced4da");
                if($(this).val()==""){
                    flag = 1;                    
                    $(this).css("border","1px solid red");
                }
                else{
                    quantities += $(this).val()+"|";
                }                
            });
            if(flag == 0){
                $(".quantities").val(quantities);
                var return_flag = false;
                if($("#name").val() == ""){
                    $(".text-danger.name").css("display", "block");
                    return_flag = true;
                }else{
                    $(".text-danger.name").css("display", "none");
                }
                if($("#company").val() == ""){
                    $(".text-danger.company").css("display", "block");
                    return_flag = true;
                }else{
                    $(".text-danger.company").css("display", "none");
                }
                if($("#phone").val() == ""){
                    $(".text-danger.phone").css("display", "block");
                    return_flag = true;
                }else{
                    $(".text-danger.phone").css("display", "none");
                }
                if($("#email").val() == ""){
                    $(".text-danger.email").css("display", "block");
                    return_flag = true;
                }else{
                    $(".text-danger.email").css("display", "none");
                    // Check email validation
                    var email = $("#email").val();
                    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(!regex.test(email)) {
                        $(".wrong-email").css("display", "block");
                        return_flag = true;
                    }else{
                        $(".wrong-email").css("display", "none");
                    } 
                }
                
                if(return_flag) return false;                

                $("#confirmationModal").modal('show');    
            }else{
                $("#alertModal").modal('show');
            }            
        });
        $("#continue").click(function(){            
            $("#contactForm").submit();
        });  
        
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

        // ---------------------- reorder part ---------------------- //
        // delete order product
        $(".del-order").click(function(e){
            var p = $(e.target).closest('.para');
            var name = p.find("h4").text();
                        
            var cartStr = $("#cartStr").val();
            var arr = cartStr.split("|");
            var updatedStr = "";
            for(var i=0; i<arr.length; i++){
                var buf = arr[i].split(":");
                var flag = true;
                for(var j=0; j<buf.length; j++){
                    if(buf[j] === name){
                        flag = false;
                        break;
                    }
                }
                if(flag){
                    if(i == arr.length-1){
                        updatedStr += arr[i];
                    }else{
                        updatedStr += arr[i]+"|";
                    }                    
                }
            }
            console.log(updatedStr);
            if(updatedStr.indexOf("|")<0){
                alert("You cant delete all products.");
            }else{
                p.remove();
                $("#cartStr").val(updatedStr).trigger("change");
            }            
        });
    });    
</script>
@endpush