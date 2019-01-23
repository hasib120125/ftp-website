@extends('layouts.app')

<!-- SEO META -->
@section('style')
<script src="{{URL::to('public/js/jssor.slider-26.9.0.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $Cols: 1,
              $Align: 0,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 6,
                $Orientation: 2,
                $Align: 156
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1200;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth-30);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
        /* jssor slider loading skin spin css */
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        .jssorb111 .i {position:absolute;color:#fff;font-family:"Helvetica neue",Helvetica,Arial,sans-serif;text-align:center;cursor:pointer;z-index:0;}
        .jssorb111 .i .n {display:none;}
        .jssorb111 .i .b {fill:#fff;stroke:#000;stroke-width:500;stroke-miterlimit:10;stroke-opacity:.5;}
        .jssorb111 .i:hover .b {fill:#fea900;stroke:#fea900;stroke-width:6000;stroke-opacity:1;}
        .jssorb111 .iav .b {fill:#000;stroke-width:6000;stroke-opacity:1;}
        .jssorb111 .i.idn {opacity:.3;}
        .jssorb111 .iav .n, .jssorb111 .i:hover .n {display:block;}

        .jssort121 .p {position:absolute;top:0;left:0;border-bottom:1px solid rgba(255,255,255,.2);box-sizing:border-box;color:#fff;background:rgba(0,0,0,.1);opacity:.7;}
        .jssort121 .p .t {position:absolute;padding:10px;box-sizing:border-box;top:0;left:0;width:100%;height:100%;line-height:24px;overflow:hidden;}
        .jssort121 .p .i {margin-right:10px;position:relative;top:0;left:0;width:96px;height:48px;border:none;float:left;}
        .jssort121 .pav, .jssort121 .p:hover {color:#000;background:rgba(255,255,255,.7);}
        .jssort121 .p:hover {opacity:.75;}
        .jssort121 .pav, .jssort121 .p:hover.pdn {opacity:1;}
        .jssort121 .ti {position:relative;font-size:14px;font-weight:bold;}
        .jssort121 .d {position:relative;font-size:12px;}
        /*.jssort121 .d:before {content:'\a';white-space:pre;}*/
    </style>
@endsection

@section('content')

<!-- Home Page -->
<?php
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}
?>
<div class="container">
	<div class="row top_button" style="margin-bottom: 30px;">
        <div class="col-sm-3 text-left">
            <div class="btn-1" style="width: 15%; float: left;">
               <a href="{{URL::to('category',$category->parent_id)}}" class="btn btn-info">Back</a>
            </div>
        </div>
        <div class="col-sm-6 text-center">
            <form class="navbar-form" role="search" action="{{URL::to('search')}}">
                <div class="input-group add-on">
                  <input class="form-control" placeholder="Search" name="key" id="srch-term" type="text" required="">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </form>
        </div>
        <div class="col-sm-3">
            <div class="home_button text-right">
                <a href="{{URL::to('/')}}" class="btn btn-info">Home</a>
            </div>
        </div> 
    </div>
    @if($category_slide)
    @if(count($category_slide)>0)
    <div class="row">
        <div class="container">
            <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="{{URL::to('public/images/spin.svg')}}" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">

            
            @foreach($category_slide as $slide_single)
            <div data-p="170.00">
                <a href="{{URL::to('file',$slide_single->id)}}"><img data-u="image" src="{{URL::to($slide_single->thumbnail)}}" /></a>
                <div data-u="thumb">
                    <img data-u="thumb" class="i" src="{{URL::to($slide_single->thumbnail)}}" />
                    <span class="ti">{{substr($slide_single->name,0,15)}}</span><br />
                    <span class="d">{{substr($slide_single->tags,0,20)}}</span>
                </div>
            </div>
            @endforeach
            
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort121" style="position:absolute;left:0px;top:0px;width:268px;height:380px;overflow:hidden;cursor:default;" data-autocenter="2" data-scale-left="0.75">
            <div data-u="slides">
                <div data-u="prototype" class="p" style="width:268px;height:68px;">
                    <div data-u="thumbnailtemplate" class="t"></div>
                </div>
            </div>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb111" style="position:absolute;bottom:12px;right:12px;" data-scale="0.5">
            <div data-u="prototype" class="i" style="width:24px;height:24px;font-size:12px;line-height:24px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;">
                    <circle class="b" cx="8000" cy="8000" r="3000"></circle>
                </svg>
                <div data-u="numbertemplate" class="n"></div>
            </div>
        </div>
    </div>
        </div>
    </div>
    @endif
    @endif
    <h2 style="margin-top: 50px">ALL FILES</h2>  
    <div class="row box" style="margin-top: 20px">
        

        @if($category_files)
        @if(count($category_files)>0)
        @foreach($category_files as $cat_single)
        
        <div class="col-md-3 col-sm-6 media_box">
            <a href="{{URL::to('file',$cat_single->id)}}">
            <div class="service-box" style="background-color:#{{random_color()}}">
                <div class="service-icon" style="background-image:url('{{URL::to($cat_single->thumbnail)}}');background-size: cover; height: 100%;">
                    <div class="front-content">
                        <i class="{{$cat_single->icon}}"></i>
                        <h3>{{$cat_single->name}}</h3>
                    </div>
                </div>
                <div class="service-content">
                    <h3>{{$cat_single->name}}</h3>
                    <!-- <p>
                      <a class="btn btn-default btn-sm" href="{{URL::to('category',$cat_single->id)}}" style="color: #474747;text-decoration: none;"></a>

                      <a class="btn btn-default btn-sm" href="{{URL::to('category',$cat_single->id)}}" target="_blank" style="color: #474747;text-decoration: none;"></a>
                    </p> -->
                </div>
            </div>
        </a>
        </div>

        @endforeach
        @else
        <div class="col-md-12">
            Sorry! Not Available
        </div>
        @endif
        @else
        <div class="col-md-12">
            Sorry! Not Available
        </div>
        @endif
    </div>
    <div>{{$category_files->render()}}</div>
    <div style="height: 100px;">&nbsp;</div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">jssor_1_slider_init();</script>
@endsection