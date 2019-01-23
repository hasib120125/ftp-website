@extends('admin.layouts.master2')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Background List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('background.create') }}"> Add New Background</a>
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
            <th>Background Image</th>
            <th>Sort</th>
            <th>Created</th>
            <th width="280px;">Action</th>
        </tr>
    @foreach ($background as $background_single)
    <tr>
        <td>{{ ++$i }}</td>
        <td><a target="_blank" href="{{URL::to($background_single->image)}}"><img width=100 src="{{URL::to($background_single->image)}}"></a></td>
        <td>{{ $background_single->sort}}</td>
        <td>{{ $background_single->created_at}}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('background.edit',$background_single->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['background.destroy', $background_single->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


    {!! $background->links() !!}
@endsection