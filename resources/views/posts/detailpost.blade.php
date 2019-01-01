@extends('layouts.app')

@section('content')


{{--  {{ Auth::user()->role}}<br/><br/>  --}}
@if(Auth::guest()) 
<div class="tab-content">
    <h2><b>{{$post->title}}</b></h2>
    {{--  <p>{{$post->category}}</p>  --}}
    {{--  <img src="/uploads/posts/{{$post->Image}}" width="748px" height="400px">  --}}
    <p>{{$post->caption}}</p>
</div>
@endif
    <a href="{{route('cart.add',['id' => $post->id])}}" class="btn btn-info" role="button">Add Cart</a>
</div>

<div class="card">
    <h3> {{ $post->title}}<br/></h3>
    Category: {{ $post->category}}<br/>
    <img src="{{ asset('img/'.$post->Image) }}" alt="Avatar" style="width:100%">
    <div class="container">
     
    </div>
    Caption: {{ $post->caption }}<br/>
    <h3>Comments</h3>
   
    @forelse ($post->comments as $comment)
        {{--  <p>{{ $comment->user->name }} {{$comment->created_at}}</p>  --}}
        <img src="{{ asset('img/'.Auth::user()->image) }}" style="height: 18px; width: 18px; border-radius: 36px; margin-right: 6px;"> {{ Auth::user()->name }} 
         <p>{{ $comment->comment }}</p>
        
        <hr>
    @empty
        <p>This post has no comments</p>
    @endforelse
   
    @if (Auth::check())
    {{ Form::open(['route' => ['comment.store'], 'method' => 'POST']) }}
    <p>{{ Form::textarea('comment', old('comment')) }}</p>
    {{ Form::hidden('post_id', $post->id) }}
    <p>{{ Form::submit('Add Comment') }}</p>
  {{ Form::close() }}
  @endif
  
</div>

@endsection