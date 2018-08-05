@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Create card in "{{$post->title}}"</h1>
  <p>Please Enter the card details</p>

  {!! Form::open(['action' => ['PostsController@storeCard', $post->id],'method' => 'POST','enctype'=>'multipart/form-data']) !!}
    <div class="forom-group">
      {{Form::label('title','Title')}}
      {{Form::text('title','',['class' => 'form-control','placeholder' =>'Title'])}}
    </div>
    <div class="forom-group">
      {{Form::label('body','Body')}}
      {{Form::textarea('body','',['id'=>'card-body', 'class' => 'form-control','placeholder' =>'Body Text'])}}
    </div>  
    <div style="padding: 30px;">
      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    </div>
  {!! Form::close() !!}

</div>

@endsection