@extends('admin.layouts.master2')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Channel</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tv.index') }}"> Back</a>
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


    {!! Form::model($target_channel, ['files'=>true,'method' => 'PATCH','route' => ['tv.update', $target_channel->id]]) !!}
        @include('admin.channel.form')
    {!! Form::close() !!}


@endsection