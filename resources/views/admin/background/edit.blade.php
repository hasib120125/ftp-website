@extends('admin.layouts.master2')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Background Image</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('background.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($target_background, ['files'=>true,'method' => 'PATCH','route' => ['background.update', $target_background->id]]) !!}
        @include('admin.background.form')
    {!! Form::close() !!}


@endsection