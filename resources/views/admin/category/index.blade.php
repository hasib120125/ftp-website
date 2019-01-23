@extends('admin.layouts.master2')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a>
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
            <th>Type</th>
            <th>Parent Category</th>
            <th>Icon</th>
            <th>Sort</th>
            <th width="280px;">Action</th>
        </tr>
    @foreach ($category as $category_single)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $category_single->name}}</td>
        <td>{{ $category_single->slug}}</td>
        <td>{{ $category_single->type}}</td>
        <td>
            @if($category_single->parent_id != 0)
                @if($category_single->getParent)
                    {{$category_single->getParent->name}}
                @else
                    Not Available
                @endif
            @else
                -
            @endif
        </td>
        <td>{{ $category_single->icon}}</td>
        <td>{{ $category_single->sort}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('category.show',$category_single->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('category.edit',$category_single->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['category.destroy', $category_single->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


    {!! $category->links() !!}
@endsection