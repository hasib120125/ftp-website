<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Channel Name:*</strong>
            {!! Form::text('name', null, array('placeholder' => 'Channel Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Thumbnail:</strong>
            {!! Form::file('thumbnail', null, array('placeholder' => 'Thumbnail','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Channel URL:</strong>
            {!! Form::text('url', null, array('placeholder' => 'URL','class' => 'form-control')) !!}
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