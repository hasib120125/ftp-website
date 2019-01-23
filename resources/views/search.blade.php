@extends('layouts.app')

<!-- SEO META -->
@section('style')
<style type="text/css">
.btn {
    margin-bottom: 5px;
}

.grid {
    position: relative;
    width: 100%;
    background: #fff;
    color: #666666;
    border-radius: 2px;
    margin-bottom: 25px;
    box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
}

.grid .grid-body {
    padding: 15px 20px 15px 20px;
    font-size: 0.9em;
    line-height: 1.9em;
}

.search table tr td.rate {
    color: #f39c12;
    line-height: 50px;
}

.search table tr:hover {
    cursor: pointer;
}

.search table tr td.image {
	width: 50px;
}

.search table tr td img {
	width: 50px;
	height: 50px;
}

.search table tr td.rate {
	color: #f39c12;
	line-height: 50px;
}

.search table tr td.price {
	font-size: 1.5em;
	line-height: 50px;
}

.search #price1,
.search #price2 {
	display: inline;
	font-weight: 600;
}
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
    <div class="row top_button" style="margin-bottom: 20px;">
	        <div class="col-sm-8">
	        	<div class="home_button text-left">
                	<button type="button" class="btn btn-info" onclick="window.history.back()">Back</button>
              </div>
	        </div>
	        <div class="col-sm-4">
	        	<div class="home_button text-right">
                	<a href="{{URL::to('/')}}" class="btn btn-info">Home</a>
              </div>
	        </div>
	</div>

	<div class="row">
	<!-- BEGIN SEARCH RESULT -->
	<div class="col-md-12">
		<div class="grid search">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN RESULT -->
					<div class="col-md-12">
						<h2><i class="fa fa-file-o"></i> Search Result</h2>
						<hr>
						<!-- BEGIN SEARCH INPUT -->
						<form class="navbar-form" role="search" action="{{URL::to('search')}}">
						<div class="input-group">
							<input name="key" type="text" class="form-control" value="{{$key}}" required="">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit" style="margin-bottom: inherit;">Search</button>
							</span>
						</div>
						</form>
						<!-- END SEARCH INPUT -->
						<p>Showing all results matching "{{$key}}"</p>
						
						<div class="padding"></div>
						
						<div class="row">
						
						
						<!-- BEGIN TABLE RESULT -->
						<div class="table-responsive">
							<table class="table table-hover">
								<tbody>
								@if($category)
					            @if(count($category)>0)
					            @foreach($category as $cat_single)
								<tr>
									<td class="number text-center">{{++$i}}</td>
									<td></td>
									<td class="product"><strong><a href="{{URL::to('category/details',$cat_single->id)}}">{{$cat_single->name}}</a></strong><br>@if($cat_single->getParent)
										Parent Category : <a href="{{URL::to('category',$cat_single->getParent->id)}}">{{$cat_single->getParent->name}}</a>
									@endif
									</td>
									<td class="text-left">Type : Category</td>
									<td class="text-left"></td>
								</tr>
								@endforeach
					            @endif
					            @endif

					            @if($files)
					            @if(count($files)>0)
					            @foreach($files as $file_single)
								<tr>
									<td class="number text-center">{{++$i}}</td>
									<td class="image"><a href="{{URL::to('file',$file_single->id)}}"><img src="{{asset($file_single->thumbnail)}}" alt=""></a></td>
									<td class="product"><strong><a href="{{URL::to('file',$file_single->id)}}">{{$file_single->name}}</a></strong><br>{{substr($file_single->tags,0,30)}}</td>
									<td class="text-left">Type : @if($file_single->type == 1)
									Video
									@elseif($file_single->type == 2)
									Audio
									@else
									File
									@endif</td>
									<td class="text-left">@if($file_single->category)
										Category : <a href="{{URL::to('category',$file_single->category->id)}}">{{$file_single->category->name}}</a>
									@endif
									<br>
									@if($file_single->parent)
										Parent Category : <a href="{{URL::to('category',$file_single->parent->id)}}">{{$file_single->parent->name}}</a>
									@endif
								</td>
								</tr>
								@endforeach
					            @endif
					            @endif
							</tbody></table>
						</div>
						<!-- END TABLE RESULT -->
						
						<!-- BEGIN PAGINATION -->
						{{$files->render()}}
						<!-- END PAGINATION -->
					</div>
					<!-- END RESULT -->
				</div>
			</div>
		</div>
	</div>
	<!-- END SEARCH RESULT -->
</div>
</div>
</div>
<div style="height: 50px;">&nbsp;</div>

@endsection