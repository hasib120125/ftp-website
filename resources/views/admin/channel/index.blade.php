@extends('admin.layouts.master2')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Channel List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('tv.create') }}"> Add New Channel</a>
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
            <th>Thumbnail</th>
            <th>URL</th>
            <th>Sort</th>
            <th>Created</th>
            <th width="280px;">Action</th>
        </tr>
    @foreach ($channel as $channel_single)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $channel_single->name}}</td>
        <td><img width=100 src="{{URL::to($channel_single->thumbnail)}}"></td>
        <td>{{ $channel_single->url}}</td>
        <td>{{ $channel_single->sort}}</td>
        <td>{{ $channel_single->created_at}}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('tv.edit',$channel_single->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['tv.destroy', $channel_single->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


    {!! $channel->links() !!}
@endsection