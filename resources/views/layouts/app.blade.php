<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>COLAZ</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap core CSS-->
  <link href="{{asset('public/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('public/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{asset('public/css/style.css')}}" rel="stylesheet">
  @yield('style')
  <style type="text/css">
    html {
    position: relative;
    min-height: 100%;
}
.carousel-fade .carousel-inner .item {
    opacity: 0;
    transition-property: opacity;
}
.carousel-fade .carousel-inner .active {
    opacity: 1;
}
.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
    left: 0;
    opacity: 0;
    z-index: 1;
}
.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
    opacity: 1;
}
.carousel-fade .carousel-control {
    z-index: 2;
}
@media all and (transform-3d),
(-webkit-transform-3d) {
    .carousel-fade .carousel-inner > .item.next,
    .carousel-fade .carousel-inner > .item.active.right {
        opacity: 0;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.prev,
    .carousel-fade .carousel-inner > .item.active.left {
        opacity: 0;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.next.left,
    .carousel-fade .carousel-inner > .item.prev.right,
    .carousel-fade .carousel-inner > .item.active {
        opacity: 1;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
}
.carousel {
    z-index: -99;
}
.carousel .item {
    position: fixed;
    width: 100%;
    height: 100%;
}
.title {
  text-align: center;
  margin-top: 20px;
  padding: 10px;
  text-shadow: 2px 2px #000;
  color: #FFF;
}
  </style>
</head>

<body >
<?php
$background_img = App\Model\Background::orderBy('sort','asc')->get();
?>

@if($background_img)
@if(count($background_img)>0)
<?php
$total_bimg = count($background_img);
$ci = 1;
$randn = mt_rand(1,$total_bimg);
?>
  <div class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($background_img as $file_single)
            <div class="item @if($ci == $randn) active @endif" style="background: url({{asset($file_single->image)}}) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
            </div>
            <?php $ci++; ?>
            @endforeach
        </div>
    </div>
@endif
@endif

<section>

    @yield('content')
</section>
<div class="clearfix" style="clear: both;">
  
</div>
<section>
  <div class="main_footer">
    <div style="display: inline-block;text-align: left;float: left;">
      Developed By <a href="http://technobari.com" target="_blank">TechnoBari</a>
    </div>
    <div style="display: inline-block;text-align: right;float: right;">&copy; Copyright 2018, <a href="{{URL::to('/')}}" target="_blank">COLAZ </a> All Rights Reserved.</div>
    <div style="clear: both;float: none;"></div>
  </div>
</section>
       

    

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/js/sb-admin.js')}}"></script>
    @yield('javascript')
    <script type="text/javascript">
       $('.carousel').carousel();
    </script>
</body>


</html>
