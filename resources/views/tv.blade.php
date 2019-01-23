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
<div class="container" style="border: 2px solid black">
    <header>
        <h1>Television</h1>
    </header>
    <div class="row">
        <div class="col-sm-2 sidebar">
                <ul>
                  <li><a href="#"><img src="{{asset('public/images/TV/image1.jpg')}}" alt="" width="241px"></a></li>
                  <li><a href="#"><img src="{{asset('public/images/TV/image2.png')}}" alt="" width="241px"></a></li>
                  <li><a href="#"><img src="{{asset('public/images/TV/image3.jpg')}}" alt="" width="241px"></a></li>
                  <li><a href="#"><img src="{{asset('public/images/TV/image4.png')}}" alt="" width="241px"></a></li>
                </ul>
        </div>
        <div class="col-sm-10">
          <div class="media-player">
            <video class="made-player-video" poster="https://media.w3.org/2010/05/sintel/poster.png">
             <source src="http://www.sample-videos.com/video/mkv/720/big_buck_bunny_720p_1mb.mkv" type="video/mp4">
             <source src="https://media.w3.org/2010/05/sintel/trailer.webm" type="video/webm">
             <source src="https://media.w3.org/2010/05/sintel/trailer.ogv" type="video/ogg">
             <p>Your user agent does not support the HTML5 Video element.</p>
           </video>
          </div>
          <!-- .media-player -->

          <!-- 
        On peut un peu contrôler le player de manière externe (play, pause, son,...)
        -->
          <div>
            <h2>Media player functions tests</h2>
            <button class="play">Play | Pause</button>
            <button class="goto">Go to 30s</button>
            <button class="stop">Stop</button>
            <button class="mute">Mute</button>
            <button class="volume">Volume max</button>
          </div>
            <!-- <h1>Responsive Video.js Example (v4.3)</h1>
              <p></p>
              <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" data-setup='{ "asdf": true }' poster="http://video-js.zencoder.com/oceans-clip.png">
                <source src="https://vjs.zencdn.net/v/oceans.mp4" type='video/mp4'>
                <source src="https://vjs.zencdn.net/v/oceans.webm" type='video/webm'>
              </video>
 -->
        </div>
    </div>
      <footer>Copyright &copy; <a href="https://technobari.com" target="_blank" style="color: white">Technobari</a> Ltd. All Rights Reserved.</footer>
</div>
<style type="text/css">
  @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
  @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);
  * {
    box-sizing: border-box;
  }
</style>
<script type="text/javascript">
    //  videojs.autoSetup();

    // videojs('my_video_1').ready(function(){
    //   console.log(this.options()); //log all of the default videojs options
      
    //    // Store the video object
    //   var myPlayer = this, id = myPlayer.id();
    //   // Make up an aspect ratio
    //   var aspectRatio = 264/640; 

    //   function resizeVideoJS(){
    //     var width = document.getElementById(id).parentElement.offsetWidth;
    //     myPlayer.width(width).height( width * aspectRatio );

    //   }
      
    //   // Initialize resizeVideoJS()
    //   resizeVideoJS();
    //   // Then on resize call resizeVideoJS()
    //   window.onresize = resizeVideoJS; 
    // });
       /*
    * MediaPlayer
    */
   var MediaPlayer = function(el) {

     var self = this,
       media_player = el,
       video = el.querySelector('video'),
       controls_bar,
       play_button,
       progress_bar,
       progress_text,
       sound_button,
       sound_bar,
       loading,
       full_screen_button,
       progressDrag = false,
       soundDrag = false,
       isClicking = false,
       isInFullscreen = false,
       click_timer,
       show_controls_timer,
       hide_controls_timer;

     function createControls() {

       var html = '<div class="media-player-controls"><button class="play-button"><i class="material-icons">play_arrow</i></button><progress class="progress-bar" min="0" max="100" value="0"></progress><span class="progress-text"></span><button class="sound-button"><i class="material-icons">volume_up</i></button><progress class="sound-bar" min="0" max="100" value="0"></progress><button class="fullscreen-button"><i class="material-icons">fullscreen</i></button></div>';

       media_player.insertAdjacentHTML('beforeend', html);
     }

     function createLoader() {

       var html = '<div class="media-player-loading"><div class="loader"><div class="circle"></div><div class="circle"></div><div class="circle"></div></div></div>';

       media_player.insertAdjacentHTML('beforeend', html);
     }

     function showLoader() {
       loading.style.display = 'block';
     }

     function hideLoader() {
       loading.style.display = 'none';
     }

     function showControls() {

       if (isClicking || controls_bar.style.opacity == 1) return false;

       var opacity = 0,
         current_time = 0,
         duration = 300;

       clearInterval(show_controls_timer);
       show_controls_timer = setInterval(function() {
         controls_bar.style.opacity = opacity;

         opacity += .05;
         current_time += 16;
         if (opacity >= 1 && current_time >= duration) {
           controls_bar.style.opacity = 1;
           clearInterval(show_controls_timer);
           return false;
         }
       }, 16);
     }

     function hideControls() {

       if (isClicking || controls_bar.style.opacity == 0 || video.currentTime == video.duration || (video.currentTime == 0 && video.paused)) return false;

       var opacity = 1,
         current_time = 0,
         duration = 300;

       clearInterval(hide_controls_timer);
       hide_controls_timer = setInterval(function() {
         controls_bar.style.opacity = opacity;

         opacity -= .05;
         current_time += 16;
         if (opacity <= 0 && current_time >= duration) {
           controls_bar.style.opacity = 0;
           clearInterval(hide_controls_timer);
           return false;
         }
       }, 16);
     }

     function togglePlayPause() {

       launch_click_timer();

       if (video.paused || video.ended) {
         play_button.innerHTML = '<i class="material-icons">pause</i>';
         video.play();
       } else {
         play_button.innerHTML = '<i class="material-icons">play_arrow</i>';
         video.pause();
       }
     }

     function launch_click_timer() {
       isClicking = true;
       clearTimeout(click_timer);
       click_timer = setTimeout(function() {
         isClicking = false;
       }, 500);
     }

     function stop() {
       video.pause();
       video.currentTime = 0;
       play_button.innerHTML = '<i class="material-icons">play_arrow</i>';
       showControls(false);
     }

     function updateProgress() {
       var percentage = Math.floor((100 / video.duration) * video.currentTime);
       progress_bar.value = percentage;
       // progress_text.innerHTML = percentage + '%';
       progress_text.innerHTML = formatTime(video.currentTime);
     }

     function setProgress(e) {
       var offsetLeft = progress_bar.getBoundingClientRect().left;
       var position = e.pageX - offsetLeft;
       var percentage = 100 * position / progress_bar.clientWidth;

       if (percentage > 100) {
         percentage = 100;
       }
       if (percentage < 0) {
         percentage = 0;
       }

       video.currentTime = video.duration * percentage / 100;
     }

     function goTo(time) {

       if (time > video.duration) {
         time = video.duration;
       }

       video.currentTime = time;
     }

     function toggleMute(e) {

       launch_click_timer();

       if (video.muted) {
         video.muted = false;
         updateVolume_controls(video.volume);
       } else {
         video.muted = true;
         updateVolume_controls(0);
       }
     }

     function updateVolume(e) {
       var offsetLeft = sound_bar.getBoundingClientRect().left;
       var position = e.pageX - offsetLeft;
       var volume = position / sound_bar.clientWidth;

       setVolume(volume);
     }

     function setVolume(volume) {

       console.log(typeof e);

       if (volume < .01) {
         volume = 0;
       }
       if (video.muted) {
         video.muted = false;
       }

       video.volume = volume;
       updateVolume_controls(volume);
     }

     function formatTime(time) { // 360.121313 secs

       // 1 heure = 3600 sec
       var hours = Math.floor(time / 3600);
       // 1 min = 60 sec
       var minutes = Math.floor((time - (hours * 3600)) / 60);
       var seconds = Math.floor(time - (hours * 3600) - (minutes * 60));

       var result = hours < 10 ? '0' + hours : hours;
       result += ':';
       result += minutes < 10 ? '0' + minutes : minutes;
       result += ':';
       result += seconds < 10 ? '0' + seconds : seconds;
       return result;
     };

     function updateVolume_controls(volume) {

       if (volume == 0) {
         sound_button.innerHTML = '<i class="material-icons">volume_off</i>';
       } else if (volume < .5) {
         sound_button.innerHTML = '<i class="material-icons">volume_down</i>';
       } else {
         sound_button.innerHTML = '<i class="material-icons">volume_up</i>';
       }

       sound_bar.value = volume * 100;
     }

     function init() {

       createControls();
       createLoader();

       controls_bar = document.querySelector('.media-player-controls');
       play_button = document.querySelector('.play-button');
       stop_button = document.querySelector('.stop-button');
       progress_bar = document.querySelector('.progress-bar');
       progress_text = document.querySelector('.progress-text');
       sound_button = document.querySelector('.sound-button');
       sound_bar = document.querySelector('.sound-bar');
       loading = document.querySelector('.media-player-loading');
       full_screen_button = document.querySelector('.fullscreen-button');

       // options
       video.controls = false;
       video.volume = .7;
       sound_bar.value = 70;
       progress_text.innerHTML = "00:00:00";

       // Loader
       video.addEventListener('waiting', showLoader);
       video.addEventListener('canplay', hideLoader);
       video.addEventListener('seeked', hideLoader);

       // Show / Hide controls
       video.addEventListener('loadedmetadata', showControls);
       media_player.addEventListener('mouseenter', showControls);
       media_player.addEventListener('mouseleave', hideControls);

       // user Play / Pause
       video.addEventListener('click', togglePlayPause);
       play_button.addEventListener('click', togglePlayPause);

       // progress
       video.addEventListener('timeupdate', updateProgress);
       // user change progress (drag, click)
       progress_bar.addEventListener('mousedown', function(e) {
         progressDrag = true;
       });
       document.addEventListener('mouseup', function(e) {
         if (progressDrag) {
           setProgress(e);
           progressDrag = false;
         }
         if (soundDrag) {
           soundDrag = false;
           updateVolume(e);
         }
       });
       document.addEventListener('mousemove', function(e) {
         if (progressDrag) {
           setProgress(e);
         }
         if (soundDrag) {
           updateVolume(e);
         }
       });
       progress_bar.addEventListener('click', updateProgress);

       // video ended
       video.addEventListener('ended', function() {
         // replay ?                       
         play_button.innerHTML = '<i class="material-icons">play_arrow</i>';
         showControls();
       });

       // Mute
       sound_button.addEventListener('click', toggleMute);
       // Volume change
       sound_bar.addEventListener('mousedown', function(e) {
         soundDrag = true;
       });
       sound_bar.addEventListener('click', updateVolume);

       // full screen
       full_screen_button.addEventListener('click', function() {

         if (video.webkitEnterFullscreen) {
           video.webkitEnterFullscreen();
         } else if (video.mozEnterFullscreen) {
           video.mozEnterFullscreen();
         } else {
           // no support
         }

       });
       video.addEventListener("mozfullscreenchange", function() {
         isInFullscreen = document.mozFullScreen;
       }, false);

       video.addEventListener("webkitfullscreenchange", function() {
         isInFullscreen = document.webkitIsFullScreen;
       }, false);

       // gestion du son en fullscreen
       video.addEventListener('volumechange', function() {
         if (isInFullscreen) {

           var volume = video.muted ? 0 : video.volume;
           sound_bar.value = volume * 100;

           if (volume == 0) {
             sound_button.innerHTML = '<i class="material-icons">volume_off</i>';
           } else if (volume < .5) {
             sound_button.innerHTML = '<i class="material-icons">volume_down</i>';
           } else {
             sound_button.innerHTML = '<i class="material-icons">volume_up</i>';
           }
         }
       });
     }

     init();

     return {
       goTo: goTo,
       hideControls: hideControls,
       setVolume: setVolume,
       showControls: showControls,
       stop: stop,
       toggleMute: toggleMute,
       togglePlayPause: togglePlayPause,
       version: '0.1.0'
     }
   }

   /*
    * Code
    */
   function initialize() {

     var el = document.querySelector('.media-player'),
       mediaPlayer = new MediaPlayer(el);

     var play_test_button = document.querySelector('.play'),
       goto_test_button = document.querySelector('.goto'),
       stop_test_button = document.querySelector('.stop'),
       mute_test_button = document.querySelector('.mute'),
       volume_test_button = document.querySelector('.volume');

     play_test_button.addEventListener('click', function() {
       mediaPlayer.togglePlayPause();
     });

     goto_test_button.addEventListener('click', function() {
       mediaPlayer.goTo(30);
     });

     stop_test_button.addEventListener('click', function() {
       mediaPlayer.stop();
     });

     mute_test_button.addEventListener('click', function() {
       mediaPlayer.toggleMute();
     });

     volume_test_button.addEventListener('click', function() {
       mediaPlayer.setVolume(1);
     });
   }

   document.addEventListener('DOMContentLoaded', initialize);
</script>

</div>

@endsection
