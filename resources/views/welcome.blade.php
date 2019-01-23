@extends('layouts.app')

<!-- SEO META -->


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
<div class="container" style="margin-top: 80px;">
    <div class="row box">

        @if($parent_category)
        @if(count($parent_category)>0)
        @foreach($parent_category as $cat_single)
        <div class="col-md-3 col-sm-6 media_box">
            <a href="{{URL::to('category',$cat_single->id)}}">
            <div class="service-box" style="background-color:#{{random_color()}}">
                <div class="service-icon">
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
        @endif
        @endif
        <div class="col-md-3 col-sm-6 media_box">
            <a href="{{asset('tv')}}">
            <div class="service-box  orange">
                <div class="service-icon ">
                    <div class="front-content">
                        <i class="fa fa-television"></i>
                        <h3>Television</h3>
                    </div>
                </div>
                <div class="service-content">
                    <h3>Television</h3>
                    <!-- <p>
                      <a class="btn btn-default btn-sm" href="{{asset('tv')}}" style="color: #474747;text-decoration: none;">Open</a>

                      <a class="btn btn-default btn-sm" href="{{asset('tv')}}" target="_blank" style="color: #474747;text-decoration: none;">Open in New Tab</a>
                    </p> -->
                </div>
            </div>
        </a>
        </div>
    </div>
    
</div>

@endsection

@section('javascript')

@endsection
