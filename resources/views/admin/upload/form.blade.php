<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>File Name:*</strong>
            {!! Form::text('name', null, array('placeholder' => 'File Name','class' => 'form-control')) !!}
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
            <strong>Select File:</strong>
            {!! Form::file('file', null, array('placeholder' => 'File','class' => 'form-control')) !!}
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
            <strong>File Type:</strong>
            <select name="type" class="form-control">
                <option value="0">Select File Type</option>
                <option value="1">Video</option>
                <option value="2">Audio</option>
                <option value="3">File</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Parent Category:</strong>
            <select name="parent_id" class="form-control">
                <option value="0">Select Parent Category</option>
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
            <strong>Sub Category:</strong>
            <select name="category_id" class="form-control">
                <option value="0">Select Sub Category</option>
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
            <strong>Languages: </strong>
            {!! Form::text('language', null, array('placeholder' => 'Languages','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Origin:</strong>
            {!! Form::text('origin', null, array('placeholder' => 'Origin','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {!! Form::textarea('tags', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
        
</div>

@section('javascript')
<script type="text/javascript">
    $(document).on({'change':function(){
        var selected_cat = $(this).val();
        var base_url = '{{URL::to("admin/findcategory")}}';
        $.get(base_url+'/'+selected_cat,{},function(r){
            $('[name="category_id"]').html(r);
        });
    }},'[name="parent_id"]');

</script>
@endsection
