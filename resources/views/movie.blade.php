@extends('layouts.app')

<!-- SEO META -->
@section('style')
<link href="http://vjs.zencdn.net/6.4.0/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <style type="text/css">
  .video-js {
    width: 100%;
    height: 450px;
    margin: 0 auto;
}
    .my-video-dimensions {
    width: 100%;
    height: 520px;
}
.video-js .vjs-big-play-button {
    top: 45%;
    left: 48%;
   
}
  </style>
@endsection
@section('content')

<!-- Home Page -->
<?php
  $getID3 = new \getID3;
  $a_file = $getID3->analyze($file->file);
  // dd($a_file);
  // dd($a_file['mime_type']);
  // echo("Duration: ".$a_file['playtime_string'].
  // " / Dimensions: ".$a_file['video']['resolution_x']." wide by ".$a_file['video']['resolution_y']." tall".
  // " / Filesize: ".$a_file['filesize']." bytes<br />");
?>
<div class="container">
        <div class="row" style="margin-top: 40px; width: 100%;">
           <div class="col-sm-12">
              <div class="btn-1" style="width: 15%; float: left;">
                   <a href="{{URL::to('category/details',$file->category)}}" class="btn btn-info">Back</a>
              </div>
              <div class="btn-1" style="width: 15%; float: right;">
                <div class="home_button">
                <a href="{{URL::to('/')}}" class="btn btn-info">Home</a>
              </div>
            </div>
          </div> 
          <div class="col-sm-12"><h2 class="section-heading" style="    padding: 25px 0;
    padding-bottom: 13px;@if($file->type == 3) text-align: center; @endif">{{$file->name}}</h2></div>
          
          @if($file->type != 3)
            <div class="col-sm-12">
                <div class="col-sm-12 side-padding" style="padding: 0;">
                   <div class="video-wrapper">
                    <video id="my-video" class="video-js" controls preload="auto" 
                      poster="{{asset($file->thumbnail)}}" data-setup="{}">
                        <source src="{{asset($file->file)}}" type='video/mp4'>
                        <source src="{{asset($file->file)}}" type="video/ogg"></source>
                        <source src="{{asset($file->file)}}" type='video/webm'>
                        <source src="{{asset($file->file)}}" type='{{$a_file["mime_type"]}}'>
                       <p class="vjs-no-js">
                          To view this video please enable JavaScript, and consider upgrading to a web browser that
                          <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    
                </div> 
                </div>
            </div>
            @endif

            <div class="clearfix"></div>
            <div class="col-sm-12 side-padding" style="padding-bottom:120px;">
              @if($file->type != 3)
                <h2 class="section-heading" style="padding: 25px 0;padding-bottom: 13px;">{{$file->name}}</h2>
              @endif

              @if($file->type == 3)
                <div style="text-align: center;margin-bottom: 30px;">
                  <img src="{{asset($file->thumbnail)}}">
                </div>
                
              @endif
               
         <table class="table table-dark ">
            <tbody>
              
              <tr>
                <td>File Size:</td>
                <td>
                  {{number_format(($a_file['filesize']/1024/1024), 2, '.', ' ')}} MB
                </td>

                <td rowspan="5" style="width:200px; vertical-align: middle;"><a href="{{asset($file->file)}}" download>
                  
                
                    <img src="{{URL::to('public/images/Download-button.png')}}" style="width:200px">
                         
                 
                </a>
              </td>
                
              </tr>
              @if($file->type != 3)
              <tr>
                <td>Country of Origin:</td>
                <td>{{$file->origin}}</td>
                
              </tr>
              @endif
              <tr>
                <td>Details:</td>
                <td>{{$file->tags}}</td>
              </tr>

              <tr>
                <td>Total Views:</td>
                <td>{{$file->total_view}}</td>
                
              </tr>
              <tr>
                <td>Uploaded:</td>
                <td>{{$file->created_at}}</td>
                
              </tr>
            </tbody>

          </table>
              
          </div>
      </div>
</div>
   
<script src="http://vjs.zencdn.net/6.4.0/video.js"></script> 
@endsection
