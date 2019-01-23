@extends('admin.layouts.master2')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>File List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('upload.create') }}"> Create New File</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Sub-Category</th>
            <th>Origin</th>
            <th>Type</th>
            <th>Total View</th>
            <th>Created</th>
            <th width="280px;">Action</th>
        </tr>
    @foreach ($files as $files_single)
    <tr>
        <td>{{ ++$i }}</td>
        <td><a target="_blank" href="{{URL::to('file',$files_single->id)}}">{{ $files_single->name}}</a></td>
        <td>{{ $files_single->slug}}</td>
        <td>
            @if($files_single->parent)
                {{$files_single->parent->name}}
            @else
                -
            @endif
        </td>
        <td>
            @if($files_single->category)
                {{$files_single->category->name}}
            @else
                -
            @endif
        </td>
        <td>{{ $files_single->origin}}</td>
        <td>@if($files_single->type == 1)
            Video
            @elseif($files_single->type == 2)
            Audio
            @else
            File
            @endif
        </td>
        <td>{{ $files_single->total_view}}</td>
        <td>{{ $files_single->created_at}}</td>
        <td>
            <a target="_blank" class="btn btn-info" href="{{URL::to('file',$files_single->id)}}">Show</a>
            <a class="btn btn-primary" href="{{ route('upload.edit',$files_single->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['upload.destroy', $files_single->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


    {!! $files->links() !!}
@endsection