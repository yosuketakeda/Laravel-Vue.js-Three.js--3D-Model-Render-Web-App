
//$(document).ready(function(){
    $(".card").on("click", function(e){
        $(e.target).addClass("active");
        var id = e.target.id;

        // Admin order page 
        if(id.indexOf("userManage")>-1){
            $(".user-types").css("display", "block");
            $("#orderTracking").removeClass("active");            
            $("#supplierManagement").removeClass("active");
            $("#productManagement").removeClass("active");
            $("#companyManagement").removeClass("active");
            
            $(".userManage-form h3").text("User Management");
            $(".userManage-form .all").css("display", "inline-table");
            $(".userManage-form .suppliers").css("display", "none");
            $(".userManage-form .customers").css("display", "none");
            $(".userManage-form .companyMembers").css("display", "none");
            
            $(".userManage-form").css("display", "block");
            $(".orderTracking-form").css("display", "none");
            $(".supplierMg-form").css("display", "none");
            $(".productMg-form").css("display", "none");
            $(".product-create-form").css("display", "none");
            $(".product-edit-form").css("display", "none");
            $(".companyMg-form").css("display", "none");

        }else if(id.indexOf("orderTracking")>-1){
            $(".user-types").css("display", "none");
            $("#userManage").removeClass("active");
            $("#supplierManagement").removeClass("active");
            $("#productManagement").removeClass("active");
            $("#companyManagement").removeClass("active");

            $(".orderTracking-form .allOrders").css("display", "table");
            $(".orderTracking-form .editOrder").css("display", "none");
            $(".userManage-form").css("display", "none");
            $(".orderTracking-form").css("display", "block");            
            $(".supplierMg-form").css("display", "none");
            $(".productMg-form").css("display", "none");
            $(".product-create-form").css("display", "none");
            $(".product-edit-form").css("display", "none");
            $(".companyMg-form").css("display", "none");

        }else if(id.indexOf("supplierManagement")>-1){
            $(".user-types").css("display", "none");
            $("#orderTracking").removeClass("active");
            $("#userManage").removeClass("active");
            $("#productManagement").removeClass("active");
            $("#companyManagement").removeClass("active");

            $(".userManage-form").css("display", "none");
            $(".orderTracking-form").css("display", "none");            
            $(".supplierMg-form").css("display", "block");
            $(".productMg-form").css("display", "none");
            $(".product-create-form").css("display", "none");
            $(".product-edit-form").css("display", "none");
            $(".companyMg-form").css("display", "none");
            $(".supplierMg-form .list-block").css("display", "table");
            $(".supplierMg-form .supplierEditBlock").remove();

        }else if(id.indexOf("productManagement")>-1){
            $(".user-types").css("display", "none");
            $("#orderTracking").removeClass("active");
            $("#userManage").removeClass("active");
            $("#supplierManagement").removeClass("active");
            $("#companyManagement").removeClass("active");

            $(".userManage-form").css("display", "none");
            $(".orderTracking-form").css("display", "none");            
            $(".supplierMg-form").css("display", "none");
            $(".productMg-form").css("display", "block");
            $(".product-create-form").css("display", "none");
            $(".product-edit-form").css("display", "none");
            $(".companyMg-form").css("display", "none");

        }else if(id.indexOf("companyManagement")>-1){
            $(".user-types").css("display", "none");
            $("#orderTracking").removeClass("active");
            $("#userManage").removeClass("active");
            $("#supplierManagement").removeClass("active");
            $("#productManagement").removeClass("active");
            
            $(".userManage-form").css("display", "none");
            $(".orderTracking-form").css("display", "none");            
            $(".supplierMg-form").css("display", "none");
            $(".productMg-form").css("display", "none");
            $(".product-create-form").css("display", "none");
            $(".product-edit-form").css("display", "none");
            $(".companyMg-form").css("display", "block");
            $(".companyMg-form .table-panel").css("display", "block");
            $(".companyMg-form .customerEditBlock").remove();
            $(".companyMg-form .assignCustomerBlock").remove();
        }

        // suppliers account 
        if(id.indexOf("myProducts")>-1){
            $("#orderTracking").removeClass("active");
            $("#userAdmin").removeClass("active");

            $(".myProducts-form").css("display", "block");
            $(".orderTracking-form").css("display", "none");
            $(".supplier-product-view-form").css("display", "none"); 
            $(".userAdmin-form").css("display", "none"); 

        }else if(id.indexOf("orderTracking")>-1){
            $("#userAdmin").removeClass("active");
            $("#myProducts").removeClass("active");

            $(".supplier-product-view-form").css("display", "none"); 
            $(".myProducts-form").css("display", "none");
            $(".userAdmin-form").css("display", "none"); 

        }else if(id.indexOf("userAdmin")>-1){
            $("#orderTracking").removeClass("active");
            $("#myProducts").removeClass("active");

            $(".orderTracking-form").css("display", "none");
            $(".supplier-product-view-form").css("display", "none"); 
            $(".myProducts-form").css("display", "none");
            $(".userAdmin-form").css("display", "block"); 
        }

        //User account order page
        if(id.indexOf("allOrders")>-1){
            $("#newOrders").removeClass("active");
            $("#processingOrders").removeClass("active");
            $("#confirmOrders").removeClass("active");
            $("#manufacturingOrders").removeClass("active");
            $("#inTransitOrders").removeClass("active");
            $("#deliveredOrders").removeClass("active");
            $("#userManagement").removeClass("active");
            
            $(".allOrders-form").css("display", "block");
            $(".newOrders-form").css("display", "none");
            $(".processingOrders-form").css("display", "none");
            $(".confirmOrders-form").css("display", "none");
            $(".manufacturingOrders-form").css("display", "none");
            $(".inTransitOrders-form").css("display", "none");
            $(".deliveredOrders-form").css("display", "none");
            $(".userManageOrders-form").css("display", "none");

        }else if(id.indexOf("newOrders")>-1){
            $("#allOrders").removeClass("active");
            $("#processingOrders").removeClass("active");
            $("#confirmOrders").removeClass("active");
            $("#manufacturingOrders").removeClass("active");
            $("#inTransitOrders").removeClass("active");
            $("#deliveredOrders").removeClass("active");
            $("#userManagement").removeClass("active");

            $(".allOrders-form").css("display", "none");
            $(".newOrders-form").css("display", "block");
            $(".processingOrders-form").css("display", "none");
            $(".confirmOrders-form").css("display", "none");
            $(".manufacturingOrders-form").css("display", "none");
            $(".inTransitOrders-form").css("display", "none");
            $(".deliveredOrders-form").css("display", "none");
            $(".userManageOrders-form").css("display", "none");

        }else if(id.indexOf("processingOrders")>-1){
            $("#allOrders").removeClass("active");
            $("#newOrders").removeClass("active");
            $("#confirmOrders").removeClass("active");
            $("#manufacturingOrders").removeClass("active");
            $("#inTransitOrders").removeClass("active");
            $("#deliveredOrders").removeClass("active");
            $("#userManagement").removeClass("active");

            $(".allOrders-form").css("display", "none");
            $(".newOrders-form").css("display", "none");
            $(".processingOrders-form").css("display", "block");
            $(".confirmOrders-form").css("display", "none");
            $(".manufacturingOrders-form").css("display", "none");
            $(".inTransitOrders-form").css("display", "none");
            $(".deliveredOrders-form").css("display", "none");
            $(".userManageOrders-form").css("display", "none");

        }else if(id.indexOf("confirmOrders")>-1){
            $("#allOrders").removeClass("active");
            $("#newOrders").removeClass("active");
            $("#processingOrders").removeClass("active");
            $("#manufacturingOrders").removeClass("active");
            $("#inTransitOrders").removeClass("active");
            $("#deliveredOrders").removeClass("active");
            $("#userManagement").removeClass("active");

            $(".allOrders-form").css("display", "none");
            $(".newOrders-form").css("display", "none");
            $(".processingOrders-form").css("display", "none");
            $(".confirmOrders-form").css("display", "block");
            $(".manufacturingOrders-form").css("display", "none");
            $(".inTransitOrders-form").css("display", "none");
            $(".deliveredOrders-form").css("display", "none");
            $(".userManageOrders-form").css("display", "none");

        }else if(id.indexOf("manufacturingOrders")>-1){
            $("#allOrders").removeClass("active");
            $("#newOrders").removeClass("active");
            $("#processingOrders").removeClass("active");
            $("#confirmOrders").removeClass("active");            
            $("#inTransitOrders").removeClass("active");
            $("#deliveredOrders").removeClass("active");
            $("#userManagement").removeClass("active");

            $(".allOrders-form").css("display", "none");
            $(".newOrders-form").css("display", "none");
            $(".processingOrders-form").css("display", "none");
            $(".confirmOrders-form").css("display", "none");
            $(".manufacturingOrders-form").css("display", "block");
            $(".inTransitOrders-form").css("display", "none");
            $(".deliveredOrders-form").css("display", "none");
            $(".userManageOrders-form").css("display", "none");

        }else if(id.indexOf("inTransitOrders")>-1){
            $("#allOrders").removeClass("active");
            $("#newOrders").removeClass("active");            
            $("#processingOrders").removeClass("active");
            $("#confirmOrders").removeClass("active");
            $("#manufacturingOrders").removeClass("active");
            $("#deliveredOrders").removeClass("active");
            $("#userManagement").removeClass("active");

            $(".allOrders-form").css("display", "none");
            $(".newOrders-form").css("display", "none");
            $(".processingOrders-form").css("display", "none");
            $(".confirmOrders-form").css("display", "none");
            $(".manufacturingOrders-form").css("display", "none");
            $(".inTransitOrders-form").css("display", "block");
            $(".deliveredOrders-form").css("display", "none");
            $(".userManageOrders-form").css("display", "none");

        }else if(id.indexOf("deliveredOrders")>-1){
            $("#allOrders").removeClass("active");
            $("#newOrders").removeClass("active");            
            $("#processingOrders").removeClass("active");
            $("#confirmOrders").removeClass("active");
            $("#manufacturingOrders").removeClass("active");
            $("#inTransitOrders").removeClass("active");
            $("#userManagement").removeClass("active");

            $(".allOrders-form").css("display", "none");
            $(".newOrders-form").css("display", "none");
            $(".processingOrders-form").css("display", "none");
            $(".confirmOrders-form").css("display", "none");
            $(".manufacturingOrders-form").css("display", "none");
            $(".inTransitOrders-form").css("display", "none");
            $(".deliveredOrders-form").css("display", "block");
            $(".userManageOrders-form").css("display", "none");

        }else if(id.indexOf("userManagement")>-1){
            $("#allOrders").removeClass("active");
            $("#newOrders").removeClass("active");            
            $("#processingOrders").removeClass("active");
            $("#confirmOrders").removeClass("active");
            $("#manufacturingOrders").removeClass("active");
            $("#inTransitOrders").removeClass("active");
            $("#deliveredOrders").removeClass("active");

            $(".allOrders-form").css("display", "none");
            $(".newOrders-form").css("display", "none");
            $(".processingOrders-form").css("display", "none");
            $(".confirmOrders-form").css("display", "none");
            $(".manufacturingOrders-form").css("display", "none");
            $(".inTransitOrders-form").css("display", "none");
            $(".deliveredOrders-form").css("display", "none");
            $(".userManageOrders-form").css("display", "block");
        }
    });     
    
    function viewOrderContentsSuppliers(orders, quantities){
        // remove added old modal
        $("#order-modal").remove();
        ////
        var arr= orders.split("|");
        
        var orderNum = arr[arr.length-1];
        var quantArr = quantities.split("|");
        console.log("orders : " + orders);
        console.log("quantity : " + quantities);
        var modal='<div class="modal fade" id="order-modal" tabindex="-1" role="dialog">'+
            '<div class="modal-dialog orderViewer">'+
                '<div class="modal-content">'+
                    '<div class="main">';
                        var body = "";
                        for(var i=0;i<arr.length-1; i++){
                            var buf = arr[i].split(":");
                            //if(buf[0] === '28-400 High Quality Standard Sprayer'){
                            //if(buf[0] === 'Dingman F2X2 Quality Sprayer'){
                                body += '<div class="pd">'+
                                    '<div class="title">'+
                                        '<span class="name">Product Name : '+buf[0]+'</span>'+
                                    '</div>'+
                                    '<div class="pdImg">'+
                                        '<img src="/images/cart/'+orderNum+'/'+buf[0]+'.jpg">'+
                                    '</div>'+
                                    '<p class="sub-title">Component Colors : </p>';
                                    var items = "";
                                    for(var j=1; j<buf.length-1; j++){
                                        var tt = buf[j].split("-");
                                        items += '<div class="items">'+
                                                '<span class="item">'+tt[0]+':  #'+tt[1]+'</span>'+
                                                '<span style="background: #'+tt[1]+'" class="item-color"></span>'+
                                            '</div>';                                    
                                    }
                                body += items;
                                body +='<span class="quantity">Quantity : '+quantArr[i]+'</span>'+
                                '</div>';
                            /*}else{
                                continue;
                            }*/
                        }
                    modal += body;
                    modal += '</div>'+
                    '<div class="modal-footer border-0">'+
                        '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal" >OK</button>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

        $("body").append(modal);
        $("#order-modal").modal("show");
    }  

    function viewOrderContents(orders, quantities){
        // remove added old modal
        $("#order-modal").remove();
        ////
        var arr= orders.split("|");
        
        var orderNum = arr[arr.length-1];
        var quantArr = quantities.split("|");
        var modal='<div class="modal fade" id="order-modal" tabindex="-1" role="dialog">'+
            '<div class="modal-dialog orderViewer">'+
                '<div class="modal-content">'+
                    '<div class="main">';
                        var body = "";
                        for(var i=0;i<arr.length-1; i++){
                            var buf = arr[i].split(":");
                            body += '<div class="pd">'+
                                '<div class="title">'+
                                    '<span class="name">Product Name : '+buf[0]+'</span>'+
                                '</div>'+
                                '<div class="pdImg">'+
                                    '<img src="/images/cart/'+orderNum+'/'+buf[0]+'.jpg">'+
                                '</div>'+
                                '<p class="sub-title">Component Colors : </p>';
                                var items = "";
                                for(var j=1; j<buf.length-1; j++){
                                    var tt = buf[j].split("-");
                                    items += '<div class="items">'+
                                            '<span class="item">'+tt[0]+':  #'+tt[1]+'</span>'+
                                            '<span style="background: #'+tt[1]+'" class="item-color"></span>'+
                                        '</div>';                                    
                                }
                            body += items;
                            body +='<span class="quantity">Quantity : '+quantArr[i]+'</span>'+
                            '</div>';
                        }
                    modal += body;
                    modal += '</div>'+
                    '<div class="modal-footer border-0">'+
                        '<button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal" >OK</button>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

        $("body").append(modal);
        $("#order-modal").modal("show");
    }  
   
//});