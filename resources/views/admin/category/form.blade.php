<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Category Name:*</strong>
            {!! Form::text('name', null, array('placeholder' => 'Category Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Slug:</strong>
            {!! Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Type:</strong>
            {!! Form::text('type', null, array('placeholder' => 'Type','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Font Awesome Icon: <mute>i.e: fa fa-book</mute></strong>
            {!! Form::text('icon', null, array('placeholder' => 'Font Awesome Icon Class','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Parent Category:</strong>
            <select name="parent_id" class="form-control">
            	<option value="0">Make Parent</option>
            	@if($category)
            	@if(count($category)>0)
            	@foreach($category as $category_single)
            		<option value="{{$category_single->id}}">{{$category_single->name}}</option>
            	@endforeach
            	@endif
            	@endif
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Sort:</strong>
            {!! Form::number('sort', 1, array('placeholder' => 'Sort','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>