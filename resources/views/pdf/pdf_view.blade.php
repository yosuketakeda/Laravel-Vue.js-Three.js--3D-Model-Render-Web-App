<!DOCTYPE html>
<html lang="en">
<head>
 <title>{{ $title }}</title>
 <style>
   .main{    
     width: 100%;
   }
   .pd{
     width: 95%;
     margin-top: 10px;
   }
   .title{
     padding: 20px 0 0;
   }
   .name{
     font-weight: bold;
   }
   .items{
     padding-left: 50px;
   }
   .item{
     width: 200px;
     margin-right: 20px;
     display: inline-block;
     margin-bottom: 10px;
   }
   .item-color{
    width: 15px;
    height: 15px;   
    display: inline-block;
    border: 1px solid #aaa; 
   }
   .date{
     padding-top: 20px 0 0;
     text-align: right;
   }
   .pdImg{
     position: absolute;
     left: 60%;
     padding-top: 60px;
   }
   .pdImg img{
     width: 80%;
   }
 </style>
</head>
<body>  
  <h1>{{$heading}}</h1>
  <h4>Order Number: {{$title}}</h4>
  <div class="main">
    <?php $k=0;?> 
    @foreach($products as $pd)
      <?php $i=0; ?>
      <div class="pd">
        @foreach($pd as $p)
        <?php 
          if($i==0){ ?>
          <div class="title">
            <span class="name">Product Name : </span>{{$p}}
          </div>
          <div class="pdImg">
            @if($reflag == 0 )
              <img src="{{public_path('/images/cart/'.$title.'/'.$p.'.jpg')}}">
            @else
              <img src="{{public_path('/images/cart/'.$preOrderNum.'/'.$p.'.jpg')}}">
            @endif
          </div>
          <p style="padding-left: 20px;">Component Colors : </p>
          <?php
          }else{
            $arr = explode("-", $p);
          ?>
          <div class="items">
            <span class="item">{{$arr[0]}}: #{{$arr[1]}}</span>
            <span style="background: #{{$arr[1]}}" class="item-color"></span>                  
          </div>
          <?php
          }
          $i++;
        ?>      
        @endforeach  
        <span class="name" style="padding-left: 20px;">Quantity : </span>{{$quantities[$k]}}
        <?php $k++;?>
      </div><!-- pd -->
    @endforeach
    <div class="date">
      Order Date : {{$date}}
    </div>
    <div class="date">
      Requested Delivery Date : {{$deliveryDate}}
    </div>
  </div><!-- main -->
</body>
</html>