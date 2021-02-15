<template>
<div class="row product-wrapper px-0 h-100">
    <div class="col-md-4 h-100 bg-white px-4 pt-4 component-sidebar">
        <form autocomplete="off"><!-- remove input cache-->
            <div id="myDropdown" class="component-search-container dropdown-content">
                <input id="myInput" type="text" class="form-control form-control-lg" placeholder="Product Selection" value="" readonly="readonly"></input>
                <i class="fa fa-arrow-down"></i>
                <div class="product-list">
                    <div class="product-name" v-for="prod in products"  v-on:click="selectStep" v-model="productName">
                        <span>{{prod}}</span>
                        <img v-bind:src="'/images/products/'+prod+'.png'">
                    </div>
                </div>
            </div>
        </form>
        <div class="init-back-comp">
            <!--<img :src="'/images/sprayer.png'"/>-->            
        </div>
        <ul class="list-group list-group-flush" id="components">
            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                <span>PARTS</span>
                <span>COLOR</span>
            </li>            
        </ul>
        <div class="pd-description">
            <h5>Product Description:</h5>
            <div class="txt">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>
    </div>
    <div class="col-md-8 h-100 component-image-container" id="canvas">        
        <button type="button" class="btn btn-link btn-chevron-left"><i
            class="fa fa-chevron-circle-left fa-lg"></i></button>
        <button type="button" class="btn btn-link btn-chevron-right"><i
            class="fa fa-chevron-circle-right fa-lg"></i></button>
        <div class="btn-group-vertical component-zoom">
          <button type="button" class="btn btn-link mb-4"><i class="fa fa-search-minus fa-lg"></i></button>
          <button type="button" class="btn btn-link"><i class="fa fa-search-plus fa-lg"></i></button>
        </div>
        <div class="btn-toolbar">
          <div class="btn-group mr-4">
            <button class="btn btn-primary rounded-pill add-cart" @click="addEvent">
                Add to cart
            </button>            
          </div>
          <div class="btn-group">
            <button class="btn btn-outline-primary rounded-pill next-cart" @click="goContactForm">
                Next
            </button>
          </div>
        </div>
    </div>

    <!-- ============ Preloading =========== -->
    <div class="se-pre-con"></div>

    <!-- =============== Modals ================== -->
    <div class="modal fade" id="alertModal1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title">Please decide the Diptube length.</h3>
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
                    <h3 class="modal-title">At least one product must be added to the cart.</h3>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alertModal3" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title">This product already was added to the cart.</h3>
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
                    <h3 class="modal-title">Are you sure?</h3>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-primary rounded-pill"
                        data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-pill" @click="addCart">Continue</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="doneModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">     
                    <h3 class="modal-title">Completed to add to the cart!</h3>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="diptubeModal" tabindex= "-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title">Dip tube length fully removed in mm’s</h3>
                </div>
                <div class="modal-header border-0">
                    <input type="text" class="custom-diptube" value="100">(mm)
                </div>
                <div class="modal-footer border-0">
                    <button type="button" @click="changeDipLength" class="btn btn-outline-primary rounded-pill" data-dismiss="modal">OK</button>                    
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import  *  as  THREE  from  'three' ;  // import three.s
    import VRMLLoader from 'three-vrml-loader';
    //import Stats from 'three/examples/jsm/libs/stats.module.js';
    import { BufferGeometryUtils } from 'three/examples/jsm/utils/BufferGeometryUtils.js';

    //import {StepToJsonParser} from 'step-to-json';
    
    export default {
        props: ['products'],
        data(){
            const object = null;
            const scene = null;            
            // CAMERA
            const camera = null;
            // renderer
            const renderer = null;
            // light
            const light = new THREE.SpotLight(0xdddddd, 1, 100);            
            // Model Loader
            const loader = new VRMLLoader();
            // controls
            const controls = null;
            // Stats
            //const stats = new Stats();
            
            // components
            const components = null;
            // each components           
            const ray_components = null;
            const component_colors = null;
            const updated_component_colors = null;
            const cart_colors = "";
            // mouse 
            const mouse = new THREE.Vector2();
            const offset = new THREE.Vector3(10,10,10);
            // picking data           
            const pickingScene = new THREE.Scene();
            const pickingTexture = null;
            const pickingData = new Array();
            const highlightMesh = null;
            // index array of components in left bar
            const indexs = null;    
            return{
                productName:'',
                model:'',
                w:0, h:0, id:0, 
                orderNumber: '',
                diptubeLength: 100,
                object, objectName:'', components, ray_components, component_colors, updated_component_colors, cart_colors,
                scene, camera, renderer, light, loader, controls, mouse, 
                pickingScene, pickingTexture, pickingData, highlightMesh,
            }
        },
        mounted() {
            const $canvas = document.getElementById("canvas");            
            this.w = $canvas.offsetWidth;
            this.h = $canvas.offsetHeight;
            
            // Real Scene
            this.scene = new THREE.Scene();
            this.scene.background = new THREE.Color( 0x000000 );

            //this.scene.add(new THREE.AxesHelper(500));
            // light
            this.scene.add(new THREE.DirectionalLight(0xaaaaaa, 1, 100)); 
            this.scene.add(this.light);
            
            this.renderer = new THREE.WebGLRenderer({
                antialias: true,
                preserveDrawingBuffer: true
            });
            this.renderer.setPixelRatio( window.devicePixelRatio );
           /* 
            this.renderer.toneMapping = THREE.ReinhardToneMapping;
            this.renderer.toneMappingExposure = 2.3;
            */
            this.renderer.setSize( this.w, this.h );
            //this.renderer.outputEncoding = THREE.sRGBEncoding;
            $canvas.appendChild( this.renderer.domElement );
            
            this.camera = new THREE.PerspectiveCamera(5, this.w / this.h, 0.05,100);　
            this.camera.position.set(0, 5, 5);
            //this.camera.position.z = 5;
            
            const OrbitControls = require('three-orbit-controls')(THREE);
            this.controls = new OrbitControls( this.camera, this.renderer.domElement );
      
            //$canvas.appendChild(this.stats.dom);
            
            //document.addEventListener( 'mousemove', this.mouseMove, false );
            this.renderer.domElement.addEventListener( 'mousedown', this.mouseDown, false );
            // picking
            this.pickingTexture = new THREE.WebGLRenderTarget(this.w, this.h);
            //this.pickingTexture=new THREE.WebGLRenderTarget(this.renderer.domElement.clientWidth, this.renderer.domElement.clientHeight);
            this.pickingScene.background = new THREE.Color( 0xf0f0f0 );
            this.pickingScene.add( new THREE.AmbientLight( 0xffffff ) );

            this.pickingMaterial =  new THREE.MeshBasicMaterial({ vertexColors:true });

            /////// dynamical add function for each component
            this.$el.addEventListener('click', this.onClick);
            //this.colorController();
            //this.cart_colors = new Array();
        },
        methods:{
            onClick: function(event){
                var className = event.target.className;
                var id = '';
                // select color picker of compoment
                if(className.indexOf('pcr-button')>-1){
                    id = event.target.closest("li").id;                                        
                    if(id.indexOf('comp')>-1){
                        this.id = id.replace("comp", "");                          
                    }
                }
                // click the component in left bar
                if(className.indexOf('nameTxt')>-1 || className.indexOf('valueDip')>-1){
                    id = event.target.closest("li").id;                                        
                    if(id.indexOf('comp')>-1){
                        this.id = id.replace("comp", "");   
                    }
                    this.zoom();
                }                       
            },
            onResize: function(event){
                alert();
            },
            zoom: function(){
                var id= event.target.id;
                if(id == 'diptube' || id == 'valueDip'){
                    $("#diptubeModal").modal("show");
                }else{
                    /*
                    console.log(this.ray_components[this.id]);
                    var scaleVector = new THREE.Vector3();
                    var scaleFactor = 1.5;
                    var sprite = this.ray_components[this.id];
                    var scale = scaleVector.subVectors(this.object.position, this.camera.position).length() * scaleFactor;
                    sprite.scale.set(scale, scale, scale); 
                    */
                }                
                //this.ray_components[this.id]; /// selected component
            },
            changeDipLength: function(){
                var length = $(".custom-diptube").val();
                $("#valueDip").text("("+length+"mm)");
                this.diptubeLength = length;
                $("#diptube").css("border-bottom", "none");
            },
            addEvent: function(){
                if(this.objectName == ""){                    
                    
                }else{
                    var str = $("#valueDip").text();
                    console.log(str);
                    if(str.indexOf('___')>0){
                        $("#alertModal1").modal('show');
                        $("#diptube").css("border-bottom", "1px solid red");
                    }else{
                        var temp = this.cart_colors;                        
                        // remove all '|' in cart_colors
                        const pattern = '|'.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                        temp = temp.replace(new RegExp(pattern, 'gi'), '');

                        var arr = temp.split(":");
                        if(arr.indexOf(this.objectName) < 0){
                            $("#confirmationModal").modal('show');                            
                        }else{
                            $("#alertModal3").modal('show');
                        }
                    }
                }    
            },
            addCart: function(){
                if(this.orderNumber == ''){
                    var date = new Date();                    
                    this.orderNumber = date.getFullYear()+""+(date.getMonth()+1)+""+date.getDate()+""+date.getHours()+""+date.getMinutes()+""+date.getSeconds();                    
                }
                // get and upload screenshot of scene
                var strMime = "image/jpeg";
                var imgData = this.renderer.domElement.toDataURL(strMime);
                var imgName = this.objectName;
                //this.saveImg(imgData, imgName+'.jpg');  //---- download the screenshot in broswer

                axios.post('/uploadProductImg', {imgData: imgData, imgName: imgName, orderNumber: this.orderNumber}, ( xhr ) => {
                        // called while loading is progressing
                        //console.log( `${( xhr.loaded / xhr.total * 100 )}% loaded` );
                        $(".se-pre-con").fadeIn("slow");                        
                    },
                    ( error ) => {
                        // called when loading has errors
                        console.error( 'An error happened', error );
                        $(".se-pre-con").fadeOut("slow");
                    },)
                .then((response)=>{
                    // show next button
                    $(".next-cart").css("display", "block");

                    $("#confirmationModal").modal('hide');
                    $(".modal-backdrop").css("display", "none");
                    
                    this.cart_colors += this.objectName+":";
                    var buf = "";
                    for(var i=0; i<this.updated_component_colors.length; i++){
                        //console.log(this.updated_component_colors[i]);
                        buf = (this.updated_component_colors[i]).replace("#", "-");
                        if(buf.indexOf("(")>0){
                            var start  = buf.indexOf("(")+1;
                            var end = buf.indexOf(")");
                            var res = buf.substring(start, end);
                            buf = buf.replace(res, this.diptubeLength+"mm");
                        }                    
                        this.cart_colors += buf+":";
                    }
                    this.cart_colors += "|";
                    // console.log(this.cart_colors);
                    // completion modal
                    $("#doneModal").modal('show');   
                });
                
                /////////////////                
            },
            saveImg: function(strData, filename){  /// download in browser
                var link = document.createElement('a');
                if (typeof link.download === 'string') {
                    document.body.appendChild(link); //Firefox requires the link to be in the body
                    link.download = filename;
                    link.href = strData;
                    link.click();
                    document.body.removeChild(link); //remove the link when done
                } else {
                    location.replace(uri);
                }
            },
            goContactForm: function(){
                if(this.cart_colors == null || this.cart_colors.length == 0){
                    $("#alertModal2").modal('show');
                }else{                    
                    // ajax token
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    window.location.href = '/contact-form?q='+this.cart_colors + this.orderNumber;
                }                                
            },            
            selectStep: function(e){
                // remove previous objects in scene
                if(this.object != null){
                    this.scene.remove(this.object);
                    //this.pickingScene.remove(this.object);
                }                
                // remove previous components in list of html
                document.querySelectorAll('.component-item').forEach(function(a){
                    a.remove();
                });
                
                ////////////////////////////////////
                var model_name = $(e.target).closest(".product-name").find('span').text();
                document.getElementById("myInput").value = model_name;
                var model_path = "../VRML/"+model_name+".wrl";
                
                this.objectName = model_name;
                
                this.loader.load(model_path,  this.loadModel,
                    ( xhr ) => {
                        // called while loading is progressing
                        //console.log( `${( xhr.loaded / xhr.total * 100 )}% loaded` );
                        //$(".se-pre-con").css("display", "block");
                        $(".se-pre-con").fadeIn("slow");
                    },
                    ( error ) => {
                        // called when loading has errors
                        console.error( 'An error happened', error );
                        $(".se-pre-con").fadeOut("slow");
                    },
                );
                this.animate();
            },
            loadModel: function(obj){
                this.object = obj;                
                //this.pickingObject = obj;
                this.components = this.getChildren();
                this.setColorPicker();
                //this.getPickingData();                
                
                this.scene.add(this.object);

                $("#components").css("display", "block");
                // show add cart button
                $(".add-cart").css("display", "block");
                // remove preloading
                $(".se-pre-con").fadeOut("slow");
                //$(".init-back-comp").css("display", "none");
                $(".pd-description").css("display", "block");
            },
            getChildren: function(){                
                var buf = this.object.children;
                 
                while(1){
                    if(buf.length<2){
                        buf = buf[0].children;
                    }else{
                        break;
                    }
                }
               
                return buf;
            },
            setColorPicker:function(){                
                this.component_colors = new Array();
                this.updated_component_colors = new Array();
           
                var temp = new Array();
                this.indexs = new Array();  // array of left bar components 

                for ( var i = 0; i < this.components.length; i++ ) {
                    var buf = this.components[i].children;
                    var pre_buf = null;
                    if(buf.length > 0){
                        while(1){
                            if(buf.length>0){
                                pre_buf = buf;
                                buf = buf[0].children;
                            }else{
                                break;
                            }
                        }
                        temp.push(pre_buf[0]);

                        this.component_colors.push('#'+pre_buf[0].material.color.getHexString());    // color array
                        
                    }else{
                        pre_buf = this.components[i];
                        temp.push(pre_buf);

                        this.component_colors.push('#'+pre_buf.material.color.getHexString());    // color array
                    }
                    
                    // append li that has 5 components into the page
                    var flag = 0;
                    var buf_name = temp[i].name.toLowerCase();
                    if(buf_name.indexOf("shroud") > -1){
                        flag = 1;
                    }else if(buf_name.indexOf("nozzle") > -1){
                        flag = 1;
                    }else if(buf_name.indexOf("trigger") > -1){
                        flag = 1;
                    }else if(buf_name.indexOf("closure") > -1){
                        flag = 1;
                    }else if(buf_name.indexOf("diptube") > -1){
                        flag = 2;
                    }else if(buf_name.indexOf("foamer") > -1){
                        flag = 1;
                    }

                    buf_name = temp[i].name;
                    if(buf_name.indexOf("_1") > -1){
                        buf_name = buf_name.replace("_1", "");
                    }
                     
                    if(flag == 1){           
                        this.indexs.push(i);
                        // pick color array
                        this.updated_component_colors.push(buf_name+'#'+temp[i].material.color.getHexString());  
                        
                        document.getElementById("components").innerHTML += '<li class="list-group-item d-flex justify-content-between align-items-center component-item" id="comp'+i+'" ><span class="nameTxt">'+buf_name+'</span></li>';

                    }else if(flag == 2){
                        this.indexs.push(i);
                        // pick color array
                        this.updated_component_colors.push(buf_name + "("+this.diptubeLength+"mm)" +'#'+temp[i].material.color.getHexString());  
                        
                        document.getElementById("components").innerHTML += '<li class="list-group-item d-flex justify-content-between align-items-center component-item" id="comp'+i+'" ><span class="nameTxt" id="diptube">'+buf_name+' <span class="valueDip" id="valueDip">( ___ mm)<span style="color:red"> *</span></span></span></li>';
                    }
                }
                this.ray_components = temp;
                //this.pmsColorPicker();
                this.colorController();
            },
            pmsColorPicker: function(){
                var componentArray = document.getElementsByClassName('component-item') || [];
                for (var i = 0; i < componentArray.length; i++) {
                    var component = componentArray.item(i);
                    var index = component.id;
                    index = index.replace("comp", "");
                    const newElement = document.createElement('div');
                    newElement.classList.add('color-picker-' + i);
                    component.appendChild(newElement);
                    //$(newElement).css("background", "red");
                    /*
                    $(newElement).CanvasColorPicker({
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
                    });*/
                }
            },
            colorController: function(){
                 // color picker
                var componentArray = document.getElementsByClassName('component-item') || [];
                for (var i = 0; i < componentArray.length; i++) {
                    var component = componentArray.item(i);
                    var index = component.id;
                    index = index.replace("comp", "");
                    const newElement = document.createElement('div');
                    newElement.classList.add('color-picker-' + i);
                    component.appendChild(newElement);
                    
                    const pickr = Pickr.create({
                        el: newElement,
                        theme: 'nano', // or 'monolith', or 'nano'
                        padding: 20,
                        comparison: false,
                        position: 'right-start',
                        default: this.component_colors[index],
                        components: {
                            // Main components
                            preview: false,
                            opacity: false,
                            hue: true,                       
                            // Input / output Options
                            interaction: {
                                hex: true,
                                rgba: true,
                                hsla: true,
                                hsva: true,
                                cmyk: true,
                                input: true,
                                clear: false,
                                save: false
                            }
                        }
                    });
                    pickr.on('init', instance => {
                        //console.log('init', instance);
                    }).on('hide', instance => {
                        //console.log('hide', instance);
                    }).on('show', (color, instance) => {
                        //console.log('show', color, instance);
                    }).on('save', (color, instance) => {               
                        //console.log('save', color, instance);
                    }).on('clear', instance => {
                        //console.log('clear', instance);
                    }).on('change', (color, instance) => {
                        // change model color
                        this.ray_components[this.id].material.color.set( instance._color.toHEXA().toString() );
                        // change pdf color 
                        var buf = parseInt(this.id);
                        var buf_name = this.ray_components[this.id].name;
                        if(buf_name.indexOf("_1") > -1){
                            buf_name = buf_name.replace("_1", "");
                        }
                        this.updated_component_colors[(this.indexs).indexOf(buf)] = buf_name+instance._color.toHEXA().toString();
                    }).on('changestop', instance => {
                        //console.log('changestop', instance);
                    }).on('cancel', instance => {
                        //console.log('cancel', instance);
                    }).on('swatchselect', (color, instance) => {
                        //console.log('swatchselect', color, instance);
                    });
                };
            },
            getPickingData: function(){
                var color= new THREE.Color();
                var group = new THREE.Group();
                
                var matrix = new THREE.Matrix4();
                matrix = this.object.matrix;
                console.log(this.object);
                
                for(var i=0; i<this.ray_components.length; i++){
                    console.log(this.ray_components[i]);
                    var geometry = new THREE.BoxBufferGeometry();
                    geometry = this.ray_components[i].geometry;
                    
                    geometry.applyMatrix4(matrix);
                    
                    var color_temp = Math.random() * 0xffffff;
                    var material = new THREE.MeshBasicMaterial({ color: color_temp });
                    var comp = new THREE.Mesh(geometry, material);
                    comp.position.set(this.ray_components[i].position);
                    group.add(comp);
                }
                //group.applyMatrix4(matrix);
                console.log(group);
                this.pickingScene.add(group);
            },
            mouseDown: function(event){
                event.preventDefault();
                //const canvas = document.getElementById("canvas");
                var canvas = document.querySelector('canvas');
                var rect = canvas.getBoundingClientRect();
                this.mouse.x = event.clientX-rect.left;
                this.mouse.y = event.clientY-rect.top;
                
                //this.pick();
                /*
                var already_selected = false;
                for ( var i = 0; i < this.ray_components.length; i++ ) {
                    if (already_selected == true) {
                        this.ray_components[i].material.color.setHex( Math.random() * 0xffffff );
                        already_selected = false;
                    }
                    else {
                        this.ray_components[i].material.color.setHex( Math.random() * 0xffffff );
                        already_selected = true;
                    }
                }
                */
            },
            pick: function(){
                //render the picking scene off-screen
                //set the view offset to represent just a single pixel under the mouse
				//this.camera.setViewOffset( this.renderer.domElement.width, this.mouse.x, this.mouse.x * window.devicePixelRatio | 0, this.mouse.y * window.devicePixelRatio | 0, 1, 1 );
                
                // render the scene
                this.renderer.setRenderTarget( this.pickingTexture );
                this.renderer.render( this.pickingScene, this.camera );

                // clear the view offset so rendering returns to normal
                //this.camera.clearViewOffset();
                
                //create buffer for reading single pixel
                var pixelBuffer = new Uint8Array(4);
                //read the pixel
                this.renderer.readRenderTargetPixels( this.pickingTexture, this.mouse.x, this.mouse.y, 1, 1, pixelBuffer );
                console.log(pixelBuffer);
                //interpret the pixel as an ID
                var id = ( pixelBuffer[0] << 16 ) | ( pixelBuffer[1] << 8 ) | ( pixelBuffer[2] );
                console.log("ID :: "+id);
                //var data = pickingData[ id ];
            },
            animate: function(){
                this.render();
                this.light.position.set(
                    this.camera.position.x,
                    this.camera.position.y,
                    this.camera.position.z,
                );
                requestAnimationFrame( this.animate );                
                //this.stats.update();
            },
            render: function(){
                this.controls.update();
                //this.pick();
                this.renderer.setRenderTarget(null);
                this.renderer.render( this.scene, this.camera );
            }
        }
    }
</script>