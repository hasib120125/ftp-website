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
<div class="container">
    <div class="row top_button">
        <div class="col-sm-6">
            <a href="{{asset('/')}}" class="btn btn-info">Back</a>
        </div>
        <div class="col-sm-6 home_button">
            <a href="{{URL::to('/')}}" class="btn btn-info">Home</a>
        </div>
    </div>
    <div class="row box">

        @if($category)
        @if(count($category)>0)
        @foreach($category as $cat_single)
        <div class="col-md-3 col-sm-6 media_box">
            <a href="{{URL::to('category/details',$cat_single->id)}}">
            <div class="service-box" style="background-color:#{{random_color()}}">
                <div class="service-icon">
                    <div class="front-content">
                        <i class="{{$cat_single->icon}}"></i>
                        <h3>{{$cat_single->name}}</h3>
                    </div>
                </div>
                <div class="service-content">
                    <h3>{{$cat_single->name}}</h3>
                   
                </div>
            </div>
        </a>
        </div>
        @endforeach
        @endif
        @endif
    </div>
</div>

@endsection
