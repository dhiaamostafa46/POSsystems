@extends('layouts.dashboard')
<style>
  body {
  background: #333;
  text-align: center;
  margin: 0;
  padding: 0;
  width: 100%;
}

html {
  margin: 0;
  padding: 0;
  width: 100%;
}

#main {
  background: -webkit-gradient(linear, left top, left bottom, from(lightgrey), to(transparent)), -webkit-gradient(linear, left top, right top, from(skyblue), to(transparent)), -webkit-gradient(linear, right top, left top, from(coral), to(transparent));
  background: -webkit-linear-gradient(lightgrey, transparent), -webkit-linear-gradient(left, skyblue, transparent), -webkit-linear-gradient(right, coral, transparent);
  background: -o-linear-gradient(lightgrey, transparent), -o-linear-gradient(left, skyblue, transparent), -o-linear-gradient(right, coral, transparent);
  background: linear-gradient(lightgrey, transparent), linear-gradient(90deg, skyblue, transparent), linear-gradient(-90deg, coral, transparent);
  background-blend-mode: screen;
  margin: 0 auto;
  border-radius: 5px;
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
          box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
  margin-top: 25px;
  margin-bottom: 50px;
  min-width: 768px;
  padding-bottom: 20px;
  padding-top: 10px;
  display: inline-block;
}

.container {
  width: 750px;
  text-align: left;
}

@media (max-width: 800px) {
  #main {
    margin-top: 0;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 0px;
    width: 100%;
    min-width: 0px;
  }

  .container {
    width: 100%;
  }

  .github-banner {
    display: none;
  }
}
#userInput {
  height: 35px;
}

#barcode {
  vertical-align: middle;
}

#title {
  display: inline-block;
  margin-left: auto;
  margin-right: auto;
  text-align: left;
  line-height: 90%;
}

#title a:link {
  text-decoration: none;
  color: #000;
}

#title a:visited {
  text-decoration: none;
  color: #000;
}

#title a:hover {
  text-decoration: underline;
  color: #000;
}

#title a:active {
  text-decoration: underline;
  color: #000;
}

#invalid {
  display: none;
  color: #DE0000;
  margin-top: 10px;
  font-size: 14pt;
  vertical-align: middle;
}

#barcodeType {
  height: 35px;
}

.barcode-container {
  height: 200px;
  line-height: 200px;
  text-align: center;
  vertical-align: middle;
  margin-left: 25px;
  margin-right: 25px;
}

.description-text {
  height: 42px;
}

.description-text p {
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

.value-text {
  height: 42px;
  text-align: right;
}

.value-text p {
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

.center-text {
  text-align: center;
}

.search-bar {
  margin-bottom: 20px;
}

.slider-container {
  margin-top: 17px;
}

.input-container {
  margin-top: 5px;
}

.barcode-select {
  border-color: #ccc;
}
</style>
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">قائمة المنتجات</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">قائمة المنتجات</a></li>
          <li class="breadcrumb-item active">تفاصيل المنتج</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">التفاصيل</h3>
          </div>
          <div class="card-body">
            <div id="main">
              <div class="container">
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div id="title">
                      <h1>Barcode Generator</h1>
                      Real-time barcode generator. Powered by <a href="https://github.com/lindell/JsBarcode">JsBarcode</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="barcode-container">
                <svg id="barcode"></svg>
                <span id="invalid">Not valid data for this barcode type!</span>
              </div>
              <div class="container">
                <div class="row search-bar">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-barcode fa-fw"></i></span>
                      <input class="form-control" id="userInput" type="text" value="Example 1234" placeholder="Barcode" autofocus>
                      <span class="input-group-btn">
                        <select class="btn barcode-select" id="barcodeType" title="CODE128">
                          <option value="CODE128">CODE128 auto</option>
                          <option value="CODE128A">CODE128 A</option>
                          <option value="CODE128B">CODE128 B</option>
                          <option value="CODE128C">CODE128 C</option>
                          <option value="EAN13">EAN13</option>
                          <option value="EAN8">EAN8</option>
                          <option value="UPC">UPC</option>
                          <option value="CODE39">CODE39</option>
                          <option value="ITF14">ITF14</option>
                          <option value="ITF">ITF</option>
                          <option value="MSI">MSI</option>
                          <option value="MSI10">MSI10</option>
                          <option value="MSI11">MSI11</option>
                          <option value="MSI1010">MSI1010</option>
                          <option value="MSI1110">MSI1110</option>
                          <option value="pharmacode">Pharmacode</option>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>
                <!-- Bar width -->
                <div class="row">
                  <div class="col-md-2 col-xs-12 col-md-offset-1 description-text"><p>Bar Width</p></div>
                  <div class="col-md-7 col-xs-11 slider-container"><input id="bar-width" type="range" min="1" max="4" step="1" value="2"/></div>
                  <div class="col-md-1 col-xs-1 value-text"><p><span id="bar-width-display"></span></p></div>
                </div>
                <!-- Height -->
                <div class="row">
                  <div class="col-md-2 col-xs-12 col-md-offset-1 description-text"><p>Height</p></div>
                  <div class="col-md-7 col-xs-11 slider-container"><input id="bar-height" type="range" min="10" max="150" step="5" value="100"/></div>
                  <div class="col-md-1 col-xs-1 value-text"><p><span id="bar-height-display"></span></p></div>
                </div>
                <!-- Margin -->
                <div class="row">
                  <div class="col-md-2 col-xs-12 col-md-offset-1 description-text"><p>Margin</p></div>
                  <div class="col-md-7 col-xs-11 slider-container"><input id="bar-margin" type="range" min="0" max="25" step="1" value="10"/></div>
                  <div class="col-md-1 col-xs-1 value-text"><p><span id="bar-margin-display"></span></p></div>
                </div>
                <!-- Background (color) -->
                <div class="row">
                  <div class="col-md-2 col-xs-12 col-md-offset-1 description-text"><p>Background</p></div>
                  <div class="col-md-7 col-xs-11 input-container"><input id="background-color" class="form-control color" value="#FFFFFF"/></div>
                  <div class="col-md-1 col-xs-1 value-text"></div>
                </div>
                <!-- Line color -->
                <div class="row">
                  <div class="col-md-2 col-xs-12 col-md-offset-1 description-text"><p>Line Color</p></div>
                  <div class="col-md-7 col-xs-11 input-container"><input id="line-color" class="form-control color" value="#000000"/></div>
                  <div class="col-md-1 col-xs-1 value-text"></div>
                </div>
                <!-- Show text -->
                <div class="row checkbox-options">
                  <div class="col-md-2 col-md-offset-1 col-xs-12 col-xs-offset-0 description-text"><p>Show text</p></div>
                  <div class="col-md-7 col-xs-12 center-text">
                    <div class="btn-group btn-group-md" role="toolbar">
                      <button type="button" class="btn btn-default btn-primary display-text" value="true">Show</button>
                      <button type="button" class="btn btn-default display-text" value="false">Hide</button>
                    </div>
                  </div>
                  <div class="col-md-1 col-xs-0"></div>
                </div>
                <div id="font-options">
                  <!-- Text align -->
                  <div class="row checkbox-options">
                    <div class="col-md-2 col-md-offset-1 col-xs-12 col-xs-offset-0 description-text"><p>Text Align</p></div>
                    <div class="col-md-7 center-text">
                      <div class="btn-group btn-group-md" role="toolbar">
                        <button type="button" class="btn btn-default text-align" value="left">Left</button>
                        <button type="button" class="btn btn-default btn-primary text-align" value="center">Center</button>
                        <button type="button" class="btn btn-default text-align" value="right">Right</button>
                      </div>
                    </div>
                    <div class="col-md-1"></div>
                  </div>
                  <!-- Font -->
                  <div class="row">
                    <div class="col-md-2 col-md-offset-1 col-xs-12 col-xs-offset-0 description-text"><p>Font</p></div>
                    <div class="col-md-7 center-text">
                      <select class="form-control" id="font" style="font-family: monospace">
                        <option value="monospace" style="font-family: monospace" selected="selected">Monospace</option>
                        <option value="sans-serif" style="font-family: sans-serif">Sans-serif</option>
                        <option value="serif" style="font-family: serif">Serif</option>
                        <option value="fantasy" style="font-family: fantasy">Fantasy</option>
                        <option value="cursive" style="font-family: cursive">Cursive</option>
                      </select>
                    </div>
                    <div class="col-md-1"></div>
                  </div>
                  <!-- Font options -->
                  <div class="row checkbox-options">
                    <div class="col-md-2 col-md-offset-1 col-xs-12 col-xs-offset-0 description-text"><p>Font Options</p></div>
                    <div class="col-md-7 center-text">
                      <div class="btn-group btn-group-md" role="toolbar">
                        <button type="button" class="btn btn-default font-option" value="bold" style="font-weight: bold">Bold</button>
                        <button type="button" class="btn btn-default font-option" value="italic" style="font-style: italic">Italic</button>
                      </div>
                    </div>
                    <div class="col-md-1"></div>
                  </div>
                  <!-- Font size -->
                  <div class="row">
                    <div class="col-md-2 col-md-offset-1 col-xs-12 col-xs-offset-0 description-text"><p>Font Size</p></div>
                    <div class="col-md-7 col-xs-11 slider-container"><input id="bar-fontSize" type="range" min="8" max="36" step="1" value="20"/></div>
                    <div class="col-md-1 col-xs-1 value-text"><p><span id="bar-fontSize-display"></span></p></div>
                  </div>
                  <!-- Text margin -->
                  <div class="row">
                    <div class="col-md-2 col-md-offset-1 col-xs-12 col-xs-offset-0 description-text"><p>Text Margin</p></div>
                    <div class="col-md-7 col-xs-11 slider-container"><input id="bar-text-margin" type="range" min="-15" max="40" step="1" value="0"/></div>
                    <div class="col-md-1 col-xs-1 col-xs-11 value-text"><p><span id="bar-text-margin-display"></span></p></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
<script>
  var defaultValues = {
     CODE128 : "Example 1234",
     CODE128A : "EXAMPLE",
     CODE128B : "Example text",
     CODE128C : "12345678",
     EAN13 : "1234567890128",
     EAN8 : "12345670",
     UPC : "123456789999",
     CODE39 : "EXAMPLE TEXT",
     ITF14 : "10012345000017",
     ITF : "123456",
     MSI : "123456",
     MSI10 : "123456",
     MSI11 : "123456",
     MSI1010 : "123456",
     MSI1110 : "123456",
     pharmacode : "1234"
 };
 
 $(document).ready(function(){
     $("#userInput").on('input',newBarcode);
     $("#barcodeType").change(function(){
         $("#userInput").val( defaultValues[$(this).val()] );
 
         newBarcode();
     });
 
     $(".text-align").click(function(){
       $(".text-align").removeClass("btn-primary");
       $(this).addClass("btn-primary");
 
       newBarcode();
     });
 
     $(".font-option").click(function(){
       if($(this).hasClass("btn-primary")){
         $(this).removeClass("btn-primary");
       }
       else{
         $(this).addClass("btn-primary");
       }
 
       newBarcode();
     });
 
     $(".display-text").click(function(){
       $(".display-text").removeClass("btn-primary");
       $(this).addClass("btn-primary");
 
       if($(this).val() == "true"){
         $("#font-options").slideDown("fast");
       }
       else{
         $("#font-options").slideUp("fast");
       }
 
       newBarcode();
     });
 
     $("#font").change(function(){
       $(this).css({"font-family": $(this).val()});
       newBarcode();
     });
 
     $('input[type="range"]').rangeslider({
         polyfill: false,
         rangeClass: 'rangeslider',
         fillClass: 'rangeslider__fill',
         handleClass: 'rangeslider__handle',
         onSlide: newBarcode,
         onSlideEnd: newBarcode
     });
 
     $('.color').colorPicker({renderCallback: newBarcode});
 
     newBarcode();
 });
 
 var newBarcode = function() {
     //Convert to boolean
     $("#barcode").JsBarcode(
         $("#userInput").val(),
         {
           "format": $("#barcodeType").val(),
           "background": $("#background-color").val(),
           "lineColor": $("#line-color").val(),
           "fontSize": parseInt($("#bar-fontSize").val()),
           "height": parseInt($("#bar-height").val()),
           "width": $("#bar-width").val(),
           "margin": parseInt($("#bar-margin").val()),
           "textMargin": parseInt($("#bar-text-margin").val()),
           "displayValue": $(".display-text.btn-primary").val() == "true",
           "font": $("#font").val(),
           "fontOptions": $(".font-option.btn-primary").map(function(){return this.value;}).get().join(" "),
           "textAlign": $(".text-align.btn-primary").val(),
           "valid":
             function(valid){
               if(valid){
                 $("#barcode").show();
                 $("#invalid").hide();
               }
               else{
                 $("#barcode").hide();
                 $("#invalid").show();
               }
             }
         });
 
     $("#bar-width-display").text($("#bar-width").val());
     $("#bar-height-display").text($("#bar-height").val());
     $("#bar-fontSize-display").text($("#bar-fontSize").val());
     $("#bar-margin-display").text($("#bar-margin").val());
     $("#bar-text-margin-display").text($("#bar-text-margin").val());
 }; 
 </script>