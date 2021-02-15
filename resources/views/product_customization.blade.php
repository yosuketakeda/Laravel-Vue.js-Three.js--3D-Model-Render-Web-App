@extends('layouts.main')
@push('before-styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css" />
@endpush
@section('content')
  <div class="container-fluid px-0 h-100">
    @include('layouts.nav')   
    <!--
    <div class="cp1"></div>
    <div id="Matchingto">Pick a RGB color, then you will know what Pantone colors are closed.</div>
    <div id="PMScolors" style="background-color:#FFFFFF">&nbsp;</div>
    -->
    <div id="app">
      <step-component v-bind:products="{{($products)}}"></step-component>
    </div>
  </div>
@endsection
@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
<script src="{{ asset('js/modernizr.js')}}"></script>

<script src="{{ asset('js/jquery-color-picker.js')}}"></script>
<script src="{{ asset('js/pms.js')}}"></script>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function(){       
        $("#myInput").click(function(){
            $(".product-list").show();
        });
        $(document).click(function(){
            var search_dropdown = $("#myDropdown");
            if (!search_dropdown.is(event.target) && !search_dropdown.has(event.target).length) {
                $(".product-list").hide();
            }
        }); 
        var viewer_width = $(".3d-space").width();
        $(".3d-space").height(viewer_width);

        // get color value via color picker
        $(".colorpicker").each(function(){
            $(this).change(function(){
                console.log($(this).val());
            });
        });

        $(".product-name").click(function(event){
            $(".product-list").hide();
            /*
            file_path = file_path.replace("file_path", product);
            console.log(file_path);
            $.get(file_path, function(result){   ////// parsing step file
              //parser(result);
              //render_three(file_path);
              console.log(result);
            });
            */
        });      
/*
        $(".cp1").CanvasColorPicker({
            flat:true,
            color:{r:255,g:204,b:0}, 
            onColorChange:function(rgb,hsv){
                var hex = COLOR_SPACE.RGB2HEX(rgb);
                var cmyk = COLOR_SPACE.rgb2ymck(rgb);  
                var p = this.getProximity();
                
                $('#Matchingto').html('PMS colors close to RGB color #' + hex + '&nbsp;<span style="background-color:#'+ hex +';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> ' + 
                ', max color distance : ' + p );  
                var m = PMSColorMatching(hex,p);
                var m2 = '';
                if ((m.length) > 0){
                m2 = '<table border="0" cellpadding="3" style="font-family:arial;font-size:12px;font-weight:bold">';
                var ipms = 0;
                var mtr = Math.ceil(m.length / 5);
                for(var i=0; i < mtr ;i++){
                m2 += '<tr align="center">';   
                for(var j=0; j < 5 ;j++){
                m2 = m2 + '<td><div>' ;
                if (ipms < m.length){
                rgbcode = PMS2RGB(m[ipms]);
                m2 = m2 + m[ipms] + '</div><div title="' + rgbcode + '" style="background-color:#' + rgbcode + ';height:90px;width:90px;">&nbsp;';
                ipms = ipms + 1;   
                } 
                m2 = m2 + '</div></td>';   
                }
                m2 = m2 + '</tr>';   
                }
                m2 = m2 + '</table>';     
                }
                $('#PMScolors').html(m2);  
            }
        });
*/
    });    
</script>
@endpush