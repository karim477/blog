@extends('layouts.app')

@section('content')
<div class="container">
  <a href="/posts" class="btn btn-default" style="background-color: orange;">Go Back</a>
  <a href="/posts/{{$post->id}}/create-card" class="btn btn-primary" style="background-color: orange;">Add Card</a>
  <h1>{{$post->title}}</h1>
  <!-- <img  style="width:100%; " src="/storage/cover_image/{{$post->cover_image}}"> -->
  <br><br>
  @foreach($cards as $card)
    {{$card->id}}/{{$card->title}}<br>
  @endforeach
  <div>
    {!!$post->body!!}
  </div>
  <hr>
  <small>Writen on{{$post->created_at}} by {{$post->user->name}}</small>
  <hr>
  @if(!Auth::guest())
    @if(Auth::user()->id==$post->user_id)
      <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
      {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
      {!!Form::close()!!}
    @endif
  @endif
</div>

@endsection
