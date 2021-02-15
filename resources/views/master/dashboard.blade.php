@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/countrySelect.css')}}">
@endpush
@section('content')

<div class="container-fluid  px-0 h-100">
    @include('layouts.nav_sec')
    <div class="row m-0 px-5 mt-5">
        <div class="col-md-3">
            <div class="card active" id="userManage">
                User Management
            </div>
            <ul class="user-types">
                <li class="select-suppliers">Supplier Members</li>
                <li class="select-companyMembers">Company Members</li>
                <li class="select-customers">Customer Members</li>                
            </ul>
            <div class="card" id="orderTracking">
                User Order Tracking
            </div>
            <div class="card" id="supplierManagement">
                Supplier Management
            </div>
            <div class="card" id="productManagement">
                Product Management
            </div>
            <div class="card" id="companyManagement">
                Company Management
            </div>
        </div>
        <div class="col-md-9">
            <div class="userManage-form sub-panel">
                <h3>User Management</h3>
                <div class="panel-container">
                    <!--<div class="btn-part">
                        <button class="addUser">+ Add User</button>
                        <button class="sendInvite">Send an Invite</button>
                    </div>-->
                    <table class="all">
                        <tr class="title">
                            <td>ID</td>
                            <td>Name</td>
                            <td>Company</td>
                            <td>Reset Password</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->companyName}}</td>
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
                                    <?php 
                                        $type = intdiv($user->permission,  10); 
                                        $permission = $user->permission % 10;
                                    ?>
                                    <input class="user-id" value="{{$user->id}}" hidden>                                    
                                    @if($loggedInPermission == 11)                                    
                                        <select class="permission-part">
                                            @if($type == 1)
                                            <option value="12" {{$permission == 2 ? "selected" : ""}}>Editor</option>
                                            <option value="13" {{$permission == 3 ? "selected" : ""}}>Viewer</option>
                                            @elseif($type == 2)
                                            <option value="21" {{$permission == 1 ? "selected" : ""}}>Admin</option>
                                            <option value="22" {{$permission == 2 ? "selected" : ""}}>Editor</option>
                                            <option value="23" {{$permission == 3 ? "selected" : ""}}>Viewer</option>
                                            @elseif($type == 3)
                                            <option value="31" {{$permission == 1 ? "selected" : ""}}>Admin</option>
                                            <option value="32" {{$permission == 2 ? "selected" : ""}}>Editor</option>
                                            <option value="33" {{$permission == 3 ? "selected" : ""}}>Viewer
                                            @endif
                                        </select>
                                    @else
                                        @if($permission == 1)
                                            <span>Admin</span>
                                        @elseif($permission == 2)
                                            <span>Editor</span>
                                        @elseif($permission == 3)
                                            <span>Viewer</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a class="admin_email_reset" href="javascript:void(0)" onclick="userEdit('{{$user->id}}','{{$user->name}}', '{{$user->address1}}', '{{$user->address2}}', '{{$user->city}}', '{{$user->region}}', '{{$user->zipcode}}', '{{$user->country}}')">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <table class="suppliers">
                        <tr class="title">
                            <td>ID</td>
                            <td>Name</td>
                            <td>Company</td>
                            <td>Reset Password</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach($users as $user)
                            <?php 
                                $type = intdiv($user->permission,  10); 
                                $permission = $user->permission % 10;
                            ?>
                            @if($type == 3)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->companyName}}</td>
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
                                    @if($loggedInPermission == 11)                                    
                                        <select class="permission-part">
                                            <option value="31" {{$permission == 1 ? "selected" : ""}}>Admin</option>
                                            <option value="32" {{$permission == 2 ? "selected" : ""}}>Editor</option>
                                            <option value="33" {{$permission == 3 ? "selected" : ""}}>Viewer
                                        </select>
                                    @else
                                        @if($permission == 1)
                                            <span>Admin</span>
                                        @elseif($permission == 2)
                                            <span>Editor</span>
                                        @elseif($permission == 3)
                                            <span>Viewer</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a class="admin_email_reset" href="javascript:void(0)" onclick="userEdit('{{$user->id}}','{{$user->name}}', '{{$user->address1}}', '{{$user->address2}}', '{{$user->city}}', '{{$user->region}}', '{{$user->zipcode}}', '{{$user->country}}')">Edit</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                    <table class="companyMembers">
                        <tr class="title">
                            <td>ID</td>
                            <td>Name</td>
                            <td>Company</td>
                            <td>Reset Password</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach($users as $user)
                            <?php 
                                $type = intdiv($user->permission,  10); 
                                $permission = $user->permission % 10;
                            ?>
                            @if($type == 1)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->companyName}}</td>
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
                                    @if($loggedInPermission == 11)                                    
                                        <select class="permission-part">
                                            <option value="12" {{$permission == 2 ? "selected" : ""}}>Editor</option>
                                            <option value="13" {{$permission == 3 ? "selected" : ""}}>Viewer
                                        </select>
                                    @else
                                        @if($permission == 2)
                                            <span>Editor</span>
                                        @elseif($permission == 3)
                                            <span>Viewer</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a class="admin_email_reset" href="javascript:void(0)" onclick="userEdit('{{$user->id}}','{{$user->name}}', '{{$user->address1}}', '{{$user->address2}}', '{{$user->city}}', '{{$user->region}}', '{{$user->zipcode}}', '{{$user->country}}')">Edit</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                    <table class="customers">
                        <tr class="title">
                            <td>ID</td>
                            <td>Name</td>
                            <td>Company</td>
                            <td>Reset Password</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach($users as $user)
                            <?php 
                                $type = intdiv($user->permission,  10); 
                                $permission = $user->permission % 10;
                            ?>
                            @if($type == 2)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->companyName}}</td>
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
                                    @if($loggedInPermission == 11)                                    
                                        <select class="permission-part">
                                            <option value="21" {{$permission == 1 ? "selected" : ""}}>Admin</option>
                                            <option value="22" {{$permission == 2 ? "selected" : ""}}>Editor</option>
                                            <option value="23" {{$permission == 3 ? "selected" : ""}}>Viewer
                                        </select>
                                    @else
                                        @if($permission == 1)
                                            <span>Admin</span>
                                        @elseif($permission == 2)
                                            <span>Editor</span>
                                        @elseif($permission == 3)
                                            <span>Viewer</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a class="admin_email_reset" href="javascript:void(0)" onclick="userEdit('{{$user->id}}','{{$user->name}}', '{{$user->address1}}', '{{$user->address2}}', '{{$user->city}}', '{{$user->region}}', '{{$user->zipcode}}', '{{$user->country}}')">Edit</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="orderTracking-form sub-panel">
                <h3>Order Tracking</h3>
                <div class="panel-container">
                    <div class="table-panel">
                        <table class="allOrders">
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
                                <td>Details</td>
                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->orderNumber}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->company}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="viewOrderContents('{{$order->orders}}', '{{$order->quantities}}')">View</a>
                                    </td>
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
                                    @if($loggedInPermission < 13)
                                        <td>
                                            <input class="order-id" value="{{$order->id}}" hidden>
                                            <select class="setOrder-admin order-{{$order->id}}">
                                                <option value="0" {{$order->orderStatus == 0 ? "selected" : ""}}>New Order</option>
                                                <option value="1" {{$order->orderStatus == 1 ? "selected" : ""}}>Processing</option>
                                                <option value="2" {{$order->orderStatus == 2 ? "selected" : ""}}>Manufacturing</option>
                                                <option value="3" {{$order->orderStatus == 3 ? "selected" : ""}}>In Transit</option>
                                                <option value="4" {{$order->orderStatus == 4 ? "selected" : ""}}>Delivered</option>
                                            </select>
                                        </td>
                                    @else
                                        <td>
                                            @if($order->orderStatus == 0)
                                                <span style="color: #fe001a" class="txt-order">New Order</span>
                                            @elseif($order->orderStatus == 1)
                                                <span style="color: #fe8d47" class="txt-order">In Processing</span>
                                            @elseif($order->orderStatus == 2)
                                                <span style="color: #d8c704" class="txt-order">Manufacturing</span>
                                            @elseif($order->orderStatus == 3)
                                                <span style="color: #29b8f1" class="txt-order">In Transit</span>
                                            @else
                                                <span style="color: #45c703" class="txt-order">Delivered</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        <a class="editOrderBtn" href="javascript:void(0)" onclick="editOrder('{{$order->id}}')">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <!--- Edit Part --->
                        <div class="editOrder">                            
                        </div><!-- edit order --->
                    </div>
                </div>
            </div>            
            <div class="supplierMg-form sub-panel">
                <h3>Supplier Management</h3>
                <div class="panel-container">
                    <table class="list-block">
                        <tr class="title">
                            <td>Suppliers</td>
                            <td>Delete or Freeze a Company</td>
                            <td>Status</td>
                            <td>Assign Products & Edit Company Details</td>                            
                        </tr>
                        @foreach($suppliers_company as $supplier)                            
                            <tr>
                                <td>{{$supplier->company_name}}</td>
                                <td>
                                    <div class="multibtn-part">
                                        <a class="del-btn" onclick="delSupplier({{$supplier->id}})">Delete</a>
                                        <a class="freeze-btn" onclick="freezeSupplier({{$supplier->id}})">Freeze</a>
                                    </div>
                                </td>
                                <td>
                                @if($supplier->status == 1)
                                    <span class="supplier-status-{{$supplier->id}}" style="color: green">Actived</span>
                                @else
                                    <span class="supplier-status-{{$supplier->id}}" style="color: red">Frozen</span>
                                @endif
                                </td>
                                <td>
                                    <button onclick="supplierEdit({{$supplier->id}}, '{{$supplier->company_name}}', '{{$supplier->address}}', '{{$supplier->email}}', '{{$supplier->phone}}')">Edit</button>
                                </td>                                
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="productMg-form sub-panel">
                <h3>Product Management</h3>                
                <div class="panel-container">
                    <div class="btn-part">
                        <button class="create-product">Create Product</button>
                    </div>
                    <div class="table-panel">
                        <table>
                            <tr class="title">
                                <td>Product Code</td>
                                <td>Product Name</td>
                                <td>Suppliers</td>
                                <td>View</td>
                            </tr>
                            @if(!empty($products))
                                @foreach($products as $product)    
                                <tr>
                                    <td>{{$product->product_code}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>
                                    <?php
                                        $supplier_id = $product->supplier_id;
                                        $ids = explode(",", $supplier_id);
                                        echo count($ids)-1;
                                    ?>
                                    </td>
                                    <td>
                                        <a class="admin_email_reset" href="javascript:void(0)" onclick="editProductDetails('{{$product->id}}')">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="product-create-form sub-panel">
                <h3>Product Management - Product Create</h3>                
                <div class="panel-container">
                    <div class="admin-upload">
                        <div class="row">
                            <div class="col-4">
                                <label class="select new-btn">
                                    <input type="file" id="select-product" name="step" hidden>Select Product (VRML)
                                </label>
                            </div>
                            <div class="col-8">
                                <div class="filename"></div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 15px;">
                            <div class="col-4">
                                <label class="select new-btn">
                                    <input type="file" id="select-thumbnail" name="thumbnail" hidden>Select Thumbnail
                                </label>
                                <div class="img-part">
                                    <div class="thumbnailname"></div>
                                    <div class="thumbnail-rect">
                                        <img id="thumbnail-IMG" src="#" alt="Product Thumbnail">
                                    </div>                                    
                                </div>
                                <div class="product-description">
                                    <h5>Product Description:</h5>
                                    <Textarea id="product-description" name="product_description" rows="8"></Textarea>
                                </div>
                            </div>
                            <div class="col-8">
                                <table>
                                    <tr>
                                        <td class="txt">Product Code</td>
                                        <td >
                                            <div class="editable-cell">
                                                <input name="code_value" class="code-value" readonly>
                                                <span>
                                                    <img src="/images/pencil.png">
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txt">Product Name</td>
                                        <td>
                                            <div class="editable-cell">
                                                <input name="name_value" class="name-value" readonly>
                                                <span>
                                                    <img src="/images/pencil.png">
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txt">Min Order Quantity</td>
                                        <td>
                                            <div class="editable-cell">
                                                <input name="quantity_value" class="quantity-value" readonly>
                                                <span>
                                                    <img src="/images/pencil.png">
                                                </span>
                                            </div>
                                        </td>
                                    </tr>                                    
                                </table>
                                <div class="supplier-part">
                                    <div class="tb-rect">
                                        <table class="left-table">
                                            <tr class="title">
                                                <td>Available Suppliers</td>
                                            </tr>
                                            @if(!empty($suppliers_company))
                                                @foreach($suppliers_company as $supplier)
                                                    <tr>                                                
                                                        <td class="assign-each">                                                            
                                                            {{$supplier->company_name}}
                                                        </td>
                                                    </tr>                                                    
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                    <div class="arrow-rect">
                                        <div class="btns">
                                            <p class="arrow right" id="productCreate-arrow-right">></p>
                                            <p class="arrow left" id="productCreate-arrow-left"><</p>
                                        </div>
                                    </div>
                                    <div class="tb-rect">
                                        <table class="right-table">
                                            <tr class="title">
                                                <td>Product Suppliers</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-part">
                            <button class="del" onclick="backProduct()">Back</button>
                            <button class="save" onclick="saveProduct()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-edit-form sub-panel">
                <h3>Product Management - Product Edit</h3>                
                <div class="panel-container">
                    <div class="admin-upload">
                        <div class="row" style="padding-top: 15px;">
                            <div class="col-4">                                
                                <div class="pd-thumbnail-rect">
                                    <span onclick="changeThumbnail()">
                                        <img src="/images/pencil.png">
                                    </span>
                                    <input type="file" id="change-thumbnail" name="change_thumbnail" hidden>
                                    <img id="edit-thumbnail" src="#" alt="Product Thumbnail">
                                </div>
                                <div class="pd-description">
                                    <h5>Product Description:
                                        <span onclick="enableDescription()">
                                            <img src="/images/pencil.png">
                                        </span>
                                    </h5>                                    
                                    <div>
                                        <textarea rows="8" class="txt" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="vrml-name">
                                </div>
                                <table>
                                    <tr>
                                        <td class="txt">Product Code</td>
                                        <td>
                                            <div class="editable-cell">
                                                <input name="code_value" class="code-value" readonly>
                                                <span>
                                                    <img src="/images/pencil.png">
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txt">Product Name</td>
                                        <td>
                                            <div class="editable-cell">
                                                <input name="name_value" class="name-value" readonly>
                                                <span>
                                                    <img src="/images/pencil.png">
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="txt">Min Order Quantity</td>
                                        <td>
                                            <div class="editable-cell">
                                                <input name="quantity_value" class="quantity-value" readonly>
                                                <span>
                                                    <img src="/images/pencil.png">
                                                </span>
                                            </div>
                                        </td>
                                    </tr>                                    
                                </table>
                                <div class="product-details">
                                    <table>
                                        <tr class="title">
                                            <td>Name</td>
                                            <td>Product Code</td>
                                            <td>Component Design</td>
                                            <td>Material</td>
                                        </tr>
                                        <tr>
                                            <td>Sprayer</td>
                                            <td>D120010</td>
                                            <td>Reference to Step File</td>
                                            <td>plastic</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>                                        
                                    </table>                                    
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="btn-part">
                        <input id="updateProductID" hidden>
                        <button class="upload" onclick="updateProduct()">Upload</button>
                    </div>                 
                </div>
            </div>
            <div class="companyMg-form sub-panel">
                <h3>Company Management</h3>
                <div class="panel-container">
                    <div class="table-panel">
                        <table>
                            <tr class="title">
                                <td>Company</td>
                                <td>Delete or Freeze a Company</td>
                                <td>Assign Products</td>
                                <td>Edit company details</td>
                                <td>Add a Logo</td>
                            </tr>
                            @if(!empty($companies))
                                @foreach($companies as $company)
                                <tr>
                                    <td>{{$company->name}}</td>
                                    <td>
                                        <div class="multibtn-part">
                                            <a class="del-btn" onclick="delCustomer({{$company->id}})">Delete</a>
                                            <a class="freeze-btn" onclick="freezeCustomer({{$company->id}})">Freeze</a>
                                        </div>
                                    </td>
                                    <td>
                                        <button onclick="assignCustomerClick({{$company->id}})">Assign</button>
                                    </td>
                                    <td>
                                        <button onclick="customerEdit({{$company->id}}, '{{$company->name}}', '{{$company->address}}', '{{$company->email}}', '{{$company->phone}}')">Edit</button>             
                                    </td>
                                    <td>
                                        <button>Add</button>             
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============ Preloading =========== -->
<div class="se-pre-con"></div>

<!-- ============ Modal =========== -->

<div class="modal fade" id="select-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">Please select the correct VRML(.wrl) file.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="thumbnail-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">Please select the correct image file(.png).</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="thumbnail-alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">The thumbnail name must be same to the product name.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">Success of uploading!</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">The product was already uploaded.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-thumbnail-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">Success of uploading!</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-thumbnail-alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">The thumbnail was already uploaded.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="save-product-alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">There is nothing the object to save. Please select the Thumbnail or VRML.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quantity-exceed-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">The total quantity has been exceeded.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quantity-alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">Please insert the quantity and select the suppliers.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="duplicatedSupplier-alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">The duplicated supplier couldn't be assigned.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="non-supplier-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">     
                <h3 class="modal-title">Please select the supplier.</h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button> 
            </div>
        </div>
    </div>
</div>

@endsection
@push('after-scripts')
<script src="{{asset('js/admin.js')}}"></script>  
<script src="{{asset('js/countrySelect.js')}}"></script>
<script>
    // dynamically added components' click event
    $(document).on('click', function(e){
        if(typeof $(e.target).attr('class') !== "undefined"){
            // Supplier Management Page --- assign the product to the supplier
            if( ($(e.target).attr('class')).indexOf("assign-each") > -1 ){
                if(($(e.target).attr('class')).indexOf("active") > 0){
                    $(e.target).removeClass("active");
                }else{
                    $(e.target).addClass("active");
                }
            }
            // Order Tracking Edit Page --- click the Supplier List input
            if(($(e.target).attr('class')).indexOf("piece-supplier-input") > -1){
                $(".piece-supplier-list").css("display", "none");
                $(e.target).closest(".suppliers-list-item .each").find(".piece-supplier-list").css("display", "block");
                //$(".piece-supplier-list.active").css("display", "block");
            }else{
                $(".piece-supplier-list").css("display", "none");
            }
            // Order Tracking Edit Page --- click the Supplier List input item
            if(($(e.target).attr('class')).indexOf("piece-supplier-list-item") > -1){
                var supplier = $(e.target).text();
                $(e.target).closest(".each").find(".piece-supplier-input").val(supplier);
                //$(".editOrder .supplier input").val(supplier);
            }
            /// click addMore
            if(($(e.target).attr('class')).indexOf("addMore") > -1){
                var total_quantity = parseInt(($(".editOrder .total-quantity").text()).replace("Total Quantity : ", ""));
                // check the each quantity to assign
                var piece_quantity_arr = $("input[name='piece-quantity[]']").map(function(){return $(this).val();}).get();
                var piece_quantity = 0;
                var last_flag = true;
                for(var i=0; i<piece_quantity_arr.length; i++){
                    if(piece_quantity_arr[i] != ""){
                        piece_quantity += parseInt(piece_quantity_arr[i]);
                    }else{
                        if(i == piece_quantity_arr.length-1){
                            last_flag = false;
                        }
                    }
                }

                // check the each suppliers to assign
                var piece_supplier_arr = $("input[name='piece-supplier-input[]']").map(function(){return $(this).val();}).get();
                var last_supplier = true;
                if(piece_supplier_arr[piece_supplier_arr.length-1] == ""){
                    last_supplier = false;
                }

                if(piece_quantity>0 && last_flag){                    
                    if(piece_quantity < total_quantity){
                        if(last_supplier){
                            var supplier_Dup_flag = false;
                            var sorted_suppliers = piece_supplier_arr.sort();
                            for(var j=0; j<sorted_suppliers.length; j++){
                                if (sorted_suppliers[j + 1] == sorted_suppliers[j]){
                                    supplier_Dup_flag = true;
                                    break;
                                }
                            }

                            if(supplier_Dup_flag){  /// case of duplicate suppliers
                                $("#duplicatedSupplier-alert-modal").modal("show");
                            }else{
                                var suppliers = "";
                                <?php
                                    foreach($suppliers_company as $supplier){
                                    ?>
                                        suppliers += '<p class="piece-supplier-list-item">'+'<?php echo $supplier->company_name;?>'+'</p>';
                                    <?php
                                    }    
                                ?>
                                $(".quantity-block").append('<div class="quantity-list-item"><input name="piece-quantity[]" class="piece-quantity" type="number"></div>');
                                $(".suppliers-list-item").append('<div class="each"><input name="piece-supplier-input[]" class="piece-supplier-input"><div class="piece-supplier-list">'+suppliers+'</div></div>');
                            }                            
                        }else{
                            $("#non-supplier-modal").modal("show");
                        }
                    }else{
                        $("#quantity-exceed-modal").modal("show");
                    }
                }else{
                    $("#quantity-alert-modal").modal("show");
                }
            }
            // supplier management edit -- arrow right
            if(($(e.target).attr('class')).indexOf("arrow right") > -1){                
                var left = [];
                $(".left-table .active").each(function(){
                    var selected = $(this).text(); 
                    selected = selected.trim();
                    left.push(selected);
                    $(this).closest("tr").remove();
                });
                var ID = $(e.target).attr('id');                
                // case of product management
                if(ID.indexOf("supplierMg-arrow-right")>-1){
                    for(var k=0; k<left.length; k++){
                        $(".supplierMg-form .right-table").append("<tr><td class='assign-each'>"+left[k]+"</td></tr>");
                    }
                }
                // case of product creation
                if(ID.indexOf("productCreate-arrow-right")>-1){
                    for(var k=0; k<left.length; k++){
                        $(".product-create-form .right-table").append("<tr><td class='assign-each'>"+left[k]+"</td></tr>");
                    }
                }
                // case of customer management
                if(ID.indexOf("customerMg-arrow-right")>-1){
                    for(var k=0; k<left.length; k++){
                        $(".companyMg-form .right-table").append("<tr><td class='assign-each'>"+left[k]+"</td></tr>");
                    }
                }
            }
            // supplier management edit -- arrow left
            if(($(e.target).attr('class')).indexOf("arrow left") > -1){
                var right = [];                
                $(".right-table .active").each(function(){
                    var selected = $(this).text(); 
                    selected = selected.trim();
                    right.push(selected);
                    $(this).closest("tr").remove();
                });
                var ID = $(e.target).attr('id');
                // case of product management
                if(ID.indexOf("supplierMg-arrow-left")>-1){
                    for(var k=0; k<right.length; k++){
                        $(".supplierMg-form .left-table").append("<tr><td class='assign-each'>"+right[k]+"</td></tr>");
                    }
                }
                // case of product creation
                if(ID.indexOf("productCreate-arrow-left")>-1){
                    for(var k=0; k<right.length; k++){
                        $(".product-create-form .left-table").append("<tr><td class='assign-each'>"+right[k]+"</td></tr>");
                    }
                }
                // case of customer management
                if(ID.indexOf("customerMg-arrow-left")>-1){
                    for(var k=0; k<right.length; k++){
                        $(".companyMg-form .left-table").append("<tr><td class='assign-each'>"+right[k]+"</td></tr>");
                    }
                }
            }
        }
    });     
    // select user types
    $(".select-customers").click(function(){
        $(".userManage-form h3").text("User Management - Customer Members");
        $(".userManage-form .all").css("display", "none");
        $(".userManage-form .suppliers").css("display", "none");
        $(".userManage-form .customers").css("display", "inline-table");
        $(".userManage-form .companyMembers").css("display", "none");
    });
    $(".select-suppliers").click(function(){
        $(".userManage-form h3").text("User Management - Supplier Members");
        $(".userManage-form .all").css("display", "none");
        $(".userManage-form .suppliers").css("display", "inline-table");
        $(".userManage-form .customers").css("display", "none");
        $(".userManage-form .companyMembers").css("display", "none");
    });
    $(".select-companyMembers").click(function(){
        $(".userManage-form h3").text("User Management - Company Members");
        $(".userManage-form .all").css("display", "none");
        $(".userManage-form .suppliers").css("display", "none");
        $(".userManage-form .customers").css("display", "none");
        $(".userManage-form .companyMembers").css("display", "inline-table");
    });

    /// edit user
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

/// Order Tracking
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
    
    // edit order
    function editOrder(id){
        $(".editTable").remove();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('editMasterOrder')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {                     
                $(".orderTracking-form .allOrders").css("display", "none");
                var order_content = "";
                var orders =  [];
                var companies = [];
                /// convert json array to string array
                $.each(data.order, function (i, elem) {
                    orders.push(elem);
                });
                $.each(data.companies, function (i, elem) {
                    companies.push(elem);
                });
                var pd_img ='<td rowspan="'+orders.length+'" class="tb-img-part">'+
                                '<img src="/images/products/'+data.pd_name+'.png">'+
                            '</td>';                 
                for(var i=0; i<orders.length; i++){                    
                    var buf = orders[i].split("-");
                    var title = buf[0].toLowerCase();
                    if(title.indexOf("nozzle")>-1){
                        if(i == 0){
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Nozzle:</td>'+
                                    '<td>#'+buf[1]+'</td>'+ pd_img+
                                '</tr>';
                        }else{
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Nozzle:</td>'+
                                    '<td>#'+buf[1]+'</td>'+ 
                                '</tr>';
                        }                        
                    }else if(title.indexOf("closure")>-1){
                        if(i == 0){
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Closure:</td>'+
                                    '<td>#'+buf[1]+'</td>'+ pd_img+
                                '</tr>';
                        }else{
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Closure</td>'+
                                    '<td>#'+buf[1]+'</td>'+ 
                                '</tr>';
                        } 
                    }else if(title.indexOf("shroud")>-1){
                        if(i == 0){
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Shroud:</td>'+
                                    '<td>#'+buf[1]+'</td>'+ pd_img+
                                '</tr>';
                        }else{
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Shroud:</td>'+
                                    '<td>#'+buf[1]+'</td>'+ 
                                '</tr>';
                        } 
                    }else if(title.indexOf("trigger")>-1){
                        if(i == 0){
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Trigger:</td>'+
                                    '<td>#'+buf[1]+'</td>'+ pd_img+
                                '</tr>';
                        }else{
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">Trigger:</td>'+
                                    '<td>#'+buf[1]+'</td>'+ 
                                '</tr>';
                        } 
                    }else if(title.indexOf("diptube")>-1){
                        if(i == 0){
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">'+buf[0]+':</td>'+
                                    '<td>#'+buf[1]+'</td>'+ pd_img+
                                '</tr>';
                        }else{
                            order_content += 
                                '<tr>'+
                                    '<td class="tb-left">'+buf[0]+':</td>'+
                                    '<td>#'+buf[1]+'</td>'+ 
                                '</tr>';
                        } 
                    }                    
                }
                var suppliers = "";
                for(var j=0; j<companies.length; j++){
                    suppliers += '<p class="piece-supplier-list-item">'+companies[j]+'</p>';
                }
                
                var router = "{{route('order.to.suppliers')}}";
              
                var supplier_block = "";
                if(data.old_supplierID == ""){
                    supplier_block = '<div class="each">'+
                                        '<input name="piece-supplier-input[]" class="piece-supplier-input">'+
                                        '<div class="piece-supplier-list">'+
                                            suppliers+
                                        '</div>'+
                                    '</div>';
                }else{
                    var index = 0;
                    data.old_supplierID.forEach(function(val){
                        if(index < data.old_supplierID.length-1){
                            supplier_block += '<div class="each">'+
                                        '<input name="piece-supplier-input[]" class="piece-supplier-input" value="'+val+'">'+
                                        '<div class="piece-supplier-list">'+
                                            suppliers+
                                        '</div>'+
                                    '</div>';
                        }else{
                            supplier_block += '<div class="each">'+
                                        '<input name="piece-supplier-input[]" class="piece-supplier-input" value="'+val+'">'+
                                        '<div class="piece-supplier-list">'+
                                            suppliers+
                                        '</div>'+
                                    '</div>';
                        }
                        
                        index++;
                    });
                }

                var quantity_block = "";
                if(data.old_quantity == ""){
                    quantity_block = 
                    '<div class="quantity-list-item">'+
                        '<input name="piece-quantity[]" class="piece-quantity" type="number">'+
                    '</div>';
                }else{
                    data.old_quantity.forEach(function(val){
                        quantity_block += 
                            '<div class="quantity-list-item">'+
                                '<input name="piece-quantity[]" class="piece-quantity" type="number" value="'+val+'">'+
                            '</div>';
                    });
                }

                var editTable = '<div class="editTable">'+
                                    '<strong>Customer Details</strong>'+
                                    '<table class="customer-details-tb">'+
                                        '<tr>'+
                                            '<td>Company Name</td>'+
                                            '<td>'+data.company+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td>Address:</td>'+
                                            '<td>'+data.address+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td>Email Address:</td>'+
                                            '<td>'+data.email+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td>Phone Number:</td>'+
                                            '<td>'+data.phone+'</td>'+
                                        '</tr>'+
                                    '</table>'+
                                    '<table>'+
                                        '<tr>'+
                                            '<td colspan="3" class="pd-name">Product Name : '+data.pd_name+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td colspan="3" class="tb-left" style="font-weight: bold">Component Colors:</td>'+
                                        '</tr>'+
                                        order_content+  //// component colors' table
                                    '</table>'+
                                    '<div class="total-quantity" style="font-weight: bold">'+
                                        'Total Quantity : '+data.quantity+
                                    '</div>'+
                                    /*'<div class="remaining-quantity" style="font-weight: bold; color: #888">'+
                                        'Remaining Quantity : '+data.quantity+
                                    '</div>'+*/
                                    '<form id="order-toSuppliers">'+
                                        '<div class="assign-supplier row">'+      
                                            '<input name="orderNum" value="'+data.orderNum+'" hidden>'+       
                                            '<div class="quantity col-4">'+
                                                '<p>Quantity</p>'+
                                                '<div class="quantity-block">'+
                                                    quantity_block+  
                                                '</div>'+   
                                                '<div class="addMore">'+
                                                    '+ Add More'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="supplier col-4">'+
                                                '<p>Supplier</p>'+
                                                '<div class="suppliers-list-item">'+
                                                    supplier_block+       
                                                '</div>'+                                            
                                            '</div>'+
                                        '</div>'+
                                    '</form>'+
                                    '<div class="btn-part">'+
                                        '<button class="del" onclick="delOrder('+id+')">Delete</button>'+
                                        '<button class="save" onclick="orderToSuppliers()">Save</button>'+
                                    '</div>'+
                                '</div>';
                $(".editOrder").append(editTable);
                $(".editOrder").css("display", "block");
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }

    function delOrder(id){
        $("#delOrder").remove();
        var modal= 
            '<div class="modal fade" id="delOrder" tabindex="-1" role="dialog">'+
                '<div class="modal-dialog">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header border-0">'+
                            '<h3 class="modal-title">Are you sure to delete this order?</h3>'+
                        '</div>'+
                        '<div class="modal-footer border-0">'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">Cancel</button>'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal" onclick="delOrderConfirm('+id+')">OK</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        $("body").append(modal);
        $("#delOrder").modal("show");        
    }
    // assign order to suppliers
    function orderToSuppliers(){
        var total_quantity = parseInt(($(".editOrder .total-quantity").text()).replace("Total Quantity : ", ""));
        // check the each quantity to assign
        var piece_quantity_arr = $("input[name='piece-quantity[]']").map(function(){return $(this).val();}).get();
        var piece_quantity = 0;
        var last_flag = true;
        for(var i=0; i<piece_quantity_arr.length; i++){
            if(piece_quantity_arr[i] != ""){
                piece_quantity += parseInt(piece_quantity_arr[i]);
            }else{
                if(i == 0){
                    last_flag = false;
                }
            }
        }

        // check the each suppliers to assign
        var piece_supplier_arr = $("input[name='piece-supplier-input[]']").map(function(){return $(this).val();}).get();
        var last_supplier = true;
        /*if(piece_supplier_arr[0] == ""){
            last_supplier = false;
        }*/
        if(piece_supplier_arr[piece_supplier_arr.length-1] == ""){
            last_supplier = false;
        }
        
        if(piece_quantity>0 && last_flag){
            if(piece_quantity <= total_quantity){
                if(last_supplier){  
                    var supplier_Dup_flag = false;
                    var sorted_suppliers = piece_supplier_arr.sort();
                    for(var j=0; j<sorted_suppliers.length; j++){
                        if (sorted_suppliers[j + 1] == sorted_suppliers[j]){
                            supplier_Dup_flag = true;
                            break;
                        }
                    }
                    if(supplier_Dup_flag){  /// case of duplicate suppliers
                        $("#duplicatedSupplier-alert-modal").modal("show");
                    }else{
                        var data = $("#order-toSuppliers").serialize();
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{route('order.to.suppliers')}}",
                            type: "POST",
                            data: {"data":data},
                            beforeSend: function(){ 
                                $(".se-pre-con").fadeIn("slow"); 
                            },
                            success: function(data){  
                                console.log(data.result);
                                $(".orderTracking-form .editOrder .editTable").remove();
                                $(".orderTracking-form .allOrders").css("display", "block");
                                $(".orderTracking-form .editOrder").css("display", "none");
                            },
                            error: function(data){
                                console.log("Errors!");
                            },
                            complete: function () {
                                $(".se-pre-con").fadeOut("slow"); 
                            },
                        });
                    }
                    
                }else{
                    $("#non-supplier-modal").modal("show");
                }
            }else{
                $("#quantity-exceed-modal").modal("show");
            }
        }else{
            $("#quantity-alert-modal").modal("show");
        }
            
    }

    function delOrderConfirm(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('delOrder')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                $("#delOrder").remove();
                $(".editTable").remove();
                //$(".orderTracking-form .allOrders").css("display", "block");
                location.reload(true);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
/// Supplier Management
    // edit supplier account 
    function supplierEdit(id, company_name, address, email, phone){
        if(company_name == null) company_name = "";
        if(address == null) address = "";
        if(email == null ) email = "";
        if(phone == null) phone ="";
        $(".supplierMg-form .list-block").css("display", "none");
        $(".supplierEditBlock").remove();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('supplierEdit')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () {
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                var products = "";
                for(i in data.products){
                    products += '<tr>'+
                                    '<td class="assign-each">'+
                                        data.products[i]+
                                    '</td>'+
                                '</tr>';
                }
                var block = 
                    '<div class="supplierEditBlock">'+
                        /*'<div class="btn-part left">'+
                            '<button class="freeze-account" onclick="freezeSupplier('+id+')">Freeze Account</button>'+
                            '<button class="del" onclick="delSupplier('+id+')">Delete</button>'+ 
                        '</div>'+*/
                        '<table>'+
                            '<tr>'+
                                '<td>Company Name:</td>'+
                                '<td class="className">'+company_name+'</td>'+
                                '<td>'+
                                    '<a href="javascript:void(0)" onclick="editCompany(1, \''+id+'\', \''+company_name+'\')" class="editCompanyName">Edit here</a>'+
                                '</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Address:</td>'+
                                '<td class="address">'+address+'</td>'+
                                '<td>'+
                                    '<a href="javascript:void(0)" onclick="editCompany(2, \''+id+'\', \''+address+'\')" class="editCompanyName">Edit here</a>'+
                                '</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Email Address:</td>'+
                                '<td class="email">'+email+'</td>'+
                                '<td>'+
                                    '<a href="javascript:void(0)" onclick="editCompany(3, \''+id+'\', \''+email+'\')" class="editCompanyName">Edit here</a>'+
                                '</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>Phone Number:</td>'+
                                '<td class="phone">'+phone+'</td>'+
                                '<td>'+
                                    '<a href="javascript:void(0)" onclick="editCompany(4, \''+id+'\', \''+phone+'\')" class="editCompanyName">Edit here</a>'+
                                '</td>'+
                            '</tr>'+
                        '</table>'+
                        '<div class="supplier-part">'+
                            '<div class="tb-rect">'+
                                '<table class="left-table">'+
                                    '<tr class="title">'+
                                        '<td>Available Products</td>'+
                                    '</tr>'+
                                    products+
                                '</table>'+
                            '</div>'+
                            '<div class="arrow-rect">'+
                                '<div class="btns">'+
                                    '<p class="arrow right" id="supplierMg-arrow-right">></p>'+
                                    '<p class="arrow left" id="supplierMg-arrow-left"><</p>'+
                                '</div>'+
                            '</div>'+
                            '<div class="tb-rect">'+
                                '<table class="right-table">'+
                                    '<tr class="title">'+
                                        '<td>Suppliers Products</td>'+
                                    '</tr>'+
                                '</table>'+
                            '</div>'+
                        '</div>'+
                        '<div class="btn-part">'+
                            '<button class="del" onclick="delSupplier('+id+')">Delete</button>'+
                            '<button class="save" onclick="assignSupplierProducts('+id+')">Save</button>'+
                        '</div>'+
                    '</div>';

                $(".supplierMg-form .panel-container").append(block);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }    
    // edit company name
    function editCompany(flag, id, value){
        $("#edit-company-modal").remove();
        var title="";
        var input='<input name="value" value="'+value+'">';
        if(flag == 1){
            title = '<h3 class="modal-title">Edit Company Name</h3>';
        }else if(flag == 2){
            title = '<h3 class="modal-title">Edit Company Address</h3>';
        }else if(flag == 3){
            title = '<h3 class="modal-title">Edit Company Email</h3>';
        }else{
            title = '<h3 class="modal-title">Edit Company Phone Number</h3>';
        }
        var modal = 
            '<div class="modal fade" id="edit-company-modal" tabindex="-1" role="dialog">'+
                '<div class="modal-dialog">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header border-0">'+
                            title+
                        '</div>'+
                        '<div class="modal-body">'+
                            input+
                        '</div>'+
                        '<div class="modal-footer border-0">'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">Cancel</button>'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill save" onclick="saveCompanyData('+id+','+flag+');" data-dismiss="modal">Save</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        $("body").append(modal);
        $("#edit-company-modal").modal("show");
    }
    // save the details of company
    function saveCompanyData(id, flag){
        var value = $("#edit-company-modal input").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('saveCompanyData')}}",
            type: "POST",
            data: {"id":id, "flag":flag, "value":value},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                $("#edit-company-modal").remove();
                /*if(data.flag == 1){
                    $(".supplierEditBlock .className").text(data.value);
                }else if(data.flag == 2){
                    $(".supplierEditBlock .address").text(data.value);
                }else if(data.flag == 3){
                    $(".supplierEditBlock .email").text(data.value);
                }else{
                    $(".supplierEditBlock .phone").text(data.value);
                }*/
                location.reload(true);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });        
    }
    function freezeSupplier(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('freezeSupplier')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                $(".supplier-status-"+data.id).text("Frozen");
                $(".supplier-status-"+data.id).css("color", "red");
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
    function delSupplier(id){
        $("#delSupplier").remove();
        var modal= 
            '<div class="modal fade" id="delSupplier" tabindex="-1" role="dialog">'+
                '<div class="modal-dialog">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header border-0">'+
                            '<h3 class="modal-title">Are you sure to delete this user?</h3>'+
                        '</div>'+
                        '<div class="modal-footer border-0">'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">Cancel</button>'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal" onclick="delSupplierConfirm('+id+')">OK</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        $("body").append(modal);
        $("#delSupplier").modal("show");        
    }
    function delSupplierConfirm(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('delSupplier')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                $("#delSupplier").remove();
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
    function assignSupplierProducts(id){
        //var values = $("input[name='supplierManagement_products[]']").map(function(){return $(this).val();}).get();
        var k = 1;
        var products = [];
        $(".supplierEditBlock .right-table .assign-each").each(function(){
            products.push($(this).text());
        });
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('assignSupplierProducts')}}",
            type: "POST",
            data: {"id":id, "products":products},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                console.log(data.result);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
   
///////////////////    
// product - edit
    function editProductDetails(id){        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url:"{{route('getAdminProductDetails')}}",
            type:"POST",
            data: {"id": id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function(data){
                $(".productMg-form").css("display", "none");
                $(".pd-description").css("display", "block");
                $(".product-edit-form .pd-description .txt").text(data.pd_description);
                $(".product-edit-form .vrml-name").text(data.pd_vrml);
                $(".product-edit-form .code-value").val(data.pd_code);
                $(".product-edit-form .name-value").val(data.pd_name);
                $(".product-edit-form .quantity-value").val(data.pd_quantity);
                $("#updateProductID").val(id);
                var img_src = "/images/products/"+data.pd_vrml;
                img_src = img_src.replace(".wrl", ".png");
                $("#edit-thumbnail").attr('src', img_src);

                $(".product-edit-form").css("display", "block");                
            },
            error: function(data){
                console.log("Errors!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
    function changeThumbnail(){        
        $("#change-thumbnail").click();
    }
    $("#change-thumbnail").on('change', function(e){
        var filename = e.target.files[0].name;
        if(filename.indexOf(".png")<0 ){
            $("#thumbnail-modal").modal("show");
            return false;
        }
        ////// compare the filename with VRML
        var model_name = $(".product-edit-form .vrml-name").text();
        model_name = model_name.replace(".wrl", ".png");

        if(filename !== model_name){
            $("#thumbnail-alert-modal").modal("show");
            return false;
        }
        
        //////////
        // loading img        
        var reader = new FileReader();    
        reader.onload = function(e) {
            $('#edit-thumbnail').attr('src', e.target.result);
        }
        
        reader.readAsDataURL($("#change-thumbnail").get(0).files[0]); // convert to base64 string

        var $fd = new FormData();
        $fd.append('thumbnail', $("#change-thumbnail").get(0).files[0]);

        // uploading
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{route('changeThumbnail')}}",
            type:"POST",
            data: $fd,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".se-pre-con").fadeIn("slow");
            },
            success: function(data){
                location.reload(true);
            },
            error: function(data){
                console.log("Errors!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });

    });
    function enableDescription(){
        $(".product-edit-form .pd-description .txt").attr("disabled", false);
        $(".product-edit-form .pd-description .txt").css("background", "#e2e2e2");
        $(".product-edit-form .pd-description .txt").focus();
    }
    function updateProduct(){
        var id = $("#updateProductID").val();
        var pdCode = $(".product-edit-form .code-value").val();
        var pdName =  $(".product-edit-form .name-value").val();
        var quantity = $(".product-edit-form .quantity-value").val();
        var description = $(".product-edit-form .pd-description .txt").val(); 
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });        
        $.ajax({
            url:"{{route('updateProduct')}}",
            type:"POST",
            data: {"id": id, "pdCode": pdCode, "pdName": pdName, "quantity": quantity, "description": description},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function(data){
                location.reload(true);
            },
            error: function(data){
                console.log("Errors!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
    // product - create
    $(".create-product").click(function(){
        $(".product-create-form").css("display", "block");
        $(".productMg-form").css("display", "none");
    });
    // upload the product
    $('#select-product').on('change', function (e) {
        var filename = e.target.files[0].name;
        if(filename.indexOf(".wrl")<0){
            $("#select-modal").modal("show");
            return false;
        }
        
        $(".filename").text(filename);
        
        // compare the filename with thumbnail
        var imgName = $(".thumbnailname").text();        
        if(imgName.length > 0){
            modelName = filename.replace(".wrl", "");           
            imgName = imgName.replace(".png", "");
        
            if(modelName !== imgName){
                $("#thumbnail-alert-modal").modal("show");
                $(".product-create-form .filename").text("");
                return false;
            }
        }        
        ////////////
        // uploading

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var $fd = new FormData();
        $fd.append('file', $("#select-product").get(0).files[0]);

        $.ajax({
            url:"{{route('uploadProduct')}}",
            type:"POST",
            data: $fd,
            contentType: false,
            processData: false,
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function(data){
                if(data.flag){
                    $("#upload-modal").modal("show");
                }else{
                    $("#upload-alert-modal").modal("show");
                    $(".product-create-form .filename").text("");
                }
            },
            error: function(data){
                console.log("Errors!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });        
    });

    // upload thumbnail png
    $('#select-thumbnail').on('change', function (e) {
        var filename = e.target.files[0].name;
        if(filename.indexOf(".png")<0 ){
            $("#thumbnail-modal").modal("show");
            return false;
        }     
        $(".thumbnailname").text(filename);   

        ////// compare the filename with VRML
        var modelName = $(".filename").text();
        if(modelName.length > 0){
            modelName = modelName.replace(".wrl", "");
            imgName = filename.replace(".png", "");
        
            if(modelName !== imgName){
                $("#thumbnail-alert-modal").modal("show");
                $(".product-create-form .thumbnailname").text("");
                return false;
            }
        }     
        //////////
        // loading img
        $("#thumbnail-IMG").css("display", "block");

        var reader = new FileReader();    
        reader.onload = function(e) {
            $('#thumbnail-IMG').attr('src', e.target.result);
        }
        
        reader.readAsDataURL($("#select-thumbnail").get(0).files[0]); // convert to base64 string

        // uploading
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var $fd = new FormData();
        $fd.append('thumbnail', $("#select-thumbnail").get(0).files[0]);

        $.ajax({
            url:"{{route('uploadThumbnail')}}",
            type:"POST",
            data: $fd,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".se-pre-con").fadeIn("slow");
            },
            success: function(data){
                if(data.flag){
                    $("#upload-modal").modal("show");
                    $(".img-part").css("display", "block");
                }else{
                    $("#upload-thumbnail-alert-modal").modal("show");
                    $(".product-create-form .thumbnailname").text("");
                }
            },
            error: function(data){
                console.log("Errors!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    });

    // click the editable table cell
    $(".editable-cell span").on("click", function(e){
        $(e.target).closest("td").find("input").attr("readonly", false);
        $(e.target).closest("td").find("input").css("background", "#e2e2e2");
        $(e.target).closest("td").find("input").focus();
    });

    // save the product
    function saveProduct(){
        var filename = $(".product-create-form .filename").text();
        var thumbname = $(".product-create-form .thumbnailname").text();

        if(filename == "" && thumbname == ""){
            $("#save-product-alert-modal").modal("show");
            return false;
        }

        var notes = $("#product-description").val();
        var productCode = $(".product-create-form .editable-cell .code-value").val();
        var productName = $(".product-create-form .editable-cell .name-value").val();
        var quantity = $(".product-create-form .editable-cell .quantity-value").val();
        var suppliers = [];
        $(".product-create-form .supplier-part .right-table .assign-each").each(function(){
            suppliers.push($(this).text());
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('saveProduct')}}",
            type: "POST",
            data: {"filename": filename, "thumbname": thumbname, "notes": notes, "productCode":productCode, "productName": productName, "quantity": quantity, "suppliers": suppliers},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                /*$(".product-create-form").css("display", "none");
                $(".product-create-form .filename").text("");
                $(".product-create-form .thumbnailname").text("");
                $("#product-description").val("");
                $(".product-create-form .editable-cell .code-value").val("");
                $(".product-create-form .editable-cell .name-value").val("");
                $(".product-create-form .editable-cell .quantity-value").val("");

                $(".productMg-form").css("display", "block");*/
                location.reload(true);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });

    }

    function backProduct(){
        $(".product-create-form").css("display", "none");
        $(".productMg-form").css("display", "block");
    }

//////////////////////
/// company management --- Customer
    function freezeCustomer(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('freezeCustomer')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                $(".supplier-status-"+data.id).text("Frozen");
                $(".supplier-status-"+data.id).css("color", "red");
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
    function delCustomer(id){
        $("#delCustomer").remove();
        var modal= 
            '<div class="modal fade" id="delCustomer" tabindex="-1" role="dialog">'+
                '<div class="modal-dialog">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header border-0">'+
                            '<h3 class="modal-title">Are you sure to delete this user?</h3>'+
                        '</div>'+
                        '<div class="modal-footer border-0">'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">Cancel</button>'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal" onclick="delCustomerConfirm('+id+')">OK</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        $("body").append(modal);
        $("#delCustomer").modal("show");
        
    }
    function delCustomerConfirm(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('delCustomer')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                $("#delCustomer").remove();
                location.reload(true);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
    function customerEdit(id, company_name, address, email, phone){
        if(company_name == null) company_name = "";
        if(address == null) address = "";
        if(email == null ) email = "";
        if(phone == null) phone ="";
        $(".companyMg-form .table-panel").css("display", "none");
        $(".customerEditBlock").remove();
        var block = 
            '<div class="customerEditBlock">'+                    
                '<table>'+
                    '<tr>'+
                        '<td>Company Name:</td>'+
                        '<td class="className">'+company_name+'</td>'+
                        '<td>'+
                            '<a href="javascript:void(0)" onclick="editCustomer(1, \''+id+'\', \''+company_name+'\')" class="editCompanyName">Edit here</a>'+
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Address:</td>'+
                        '<td class="address">'+address+'</td>'+
                        '<td>'+
                            '<a href="javascript:void(0)" onclick="editCustomer(2, \''+id+'\', \''+address+'\')" class="editCompanyName">Edit here</a>'+
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Email Address:</td>'+
                        '<td class="email">'+email+'</td>'+
                        '<td>'+
                            '<a href="javascript:void(0)" onclick="editCustomer(3, \''+id+'\', \''+email+'\')" class="editCompanyName">Edit here</a>'+
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Phone Number:</td>'+
                        '<td class="phone">'+phone+'</td>'+
                        '<td>'+
                            '<a href="javascript:void(0)" onclick="editCustomer(4, \''+id+'\', \''+phone+'\')" class="editCompanyName">Edit here</a>'+
                        '</td>'+
                    '</tr>'+
                '</table>'+
            '</div>';

        $(".companyMg-form .panel-container").append(block);
    }
    function editCustomer(flag, id, value){
        $("#edit-company-modal").remove();
        var title="";
        var input='<input name="value" value="'+value+'">';
        if(flag == 1){
            title = '<h3 class="modal-title">Edit Company Name</h3>';
        }else if(flag == 2){
            title = '<h3 class="modal-title">Edit Company Address</h3>';
        }else if(flag == 3){
            title = '<h3 class="modal-title">Edit Company Email</h3>';
        }else{
            title = '<h3 class="modal-title">Edit Company Phone Number</h3>';
        }
        var modal = 
            '<div class="modal fade" id="edit-company-modal" tabindex="-1" role="dialog">'+
                '<div class="modal-dialog">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header border-0">'+
                            title+
                        '</div>'+
                        '<div class="modal-body">'+
                            input+
                        '</div>'+
                        '<div class="modal-footer border-0">'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">Cancel</button>'+
                            '<button type="button" class="btn btn-outline-primary rounded-pill save" onclick="saveCustomerData('+id+','+flag+');" data-dismiss="modal">Save</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        $("body").append(modal);
        $("#edit-company-modal").modal("show");
    }
    function saveCustomerData(id, flag){
        var value = $("#edit-company-modal input").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('saveCustomerData')}}",
            type: "POST",
            data: {"id":id, "flag":flag, "value":value},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                /*$("#edit-company-modal").remove();
                if(data.flag == 1){
                    $(".customerEditBlock .className").text(data.value);
                }else if(data.flag == 2){
                    $(".customerEditBlock .address").text(data.value);
                }else if(data.flag == 3){
                    $(".customerEditBlock .email").text(data.value);
                }else{
                    $(".customerEditBlock .phone").text(data.value);
                }*/
                location.reload(true);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });        
    }
    function assignCustomerClick(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('assignCustomerClick')}}",
            type: "POST",
            data: {"id":id},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                var products = "";
                for(i in data.products){
                    products += '<tr>'+
                                    '<td class="assign-each">'+
                                        data.products[i]+
                                    '</td>'+
                                '</tr>';
                }
                $(".companyMg-form .table-panel").css("display", "none");
                $(".assignCustomerBlock").remove();
                var block = 
                    '<div class="assignCustomerBlock">'+
                        '<div class="supplier-part">'+
                            '<div class="tb-rect">'+
                                '<table class="left-table">'+
                                    '<tr class="title">'+
                                        '<td>Available Products</td>'+
                                    '</tr>'+
                                    products+
                                '</table>'+
                            '</div>'+
                            '<div class="arrow-rect">'+
                                '<div class="btns">'+
                                    '<p class="arrow right" id="customerMg-arrow-right">></p>'+
                                    '<p class="arrow left" id="customerMg-arrow-left"><</p>'+
                                '</div>'+
                            '</div>'+
                            '<div class="tb-rect">'+
                                '<table class="right-table">'+
                                    '<tr class="title">'+
                                        '<td>Suppliers Products</td>'+
                                    '</tr>'+
                                '</table>'+
                            '</div>'+
                        '</div>'+
                        '<div class="btn-part">'+
                            '<button class="del" onclick="backCustomer()">Back</button>'+
                            '<button class="save" onclick="assignCustomerProducts('+id+')">Save</button>'+
                        '</div>'+
                    '</div>';
                $(".companyMg-form .panel-container").append(block);
            },
            error: function(data) {
                console.log("Errors!!");
            },
            complete: function () {
                $(".se-pre-con").fadeOut("slow"); 
            },
        });
    }
    function backCustomer(){
        $(".assignCustomerBlock").remove();
        $(".table-panel").css("display", "block");
    }
    function assignCustomerProducts(id){       
        var products = [];
        $(".assignCustomerBlock .right-table .assign-each").each(function(){
            products.push($(this).text());
        });
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('assignCustomerProducts')}}",
            type: "POST",
            data: {"id":id, "products":products},
            beforeSend: function () { 
                $(".se-pre-con").fadeIn("slow"); 
            },
            success: function (data) {
                //console.log(data.result);
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