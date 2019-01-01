@extends('layouts.app')
<form action="{{route('searchPostt')}}" method="GET">
        <input type="text" name="search" placeholder="search by title">
        <input type="submit" value="submit">
    </form>
@section('content')
<h1>Pintesterr</h1>
@foreach ($posts as $post)
    {{--  {{ $post->id }}<br/>  --}}
    {{--  {{ $post->caption }}<br/>e
    {{ $post->price }}<br/>  --}}
    <a href="{{route('post.detail', ['id' => $post->id])}}"><img src="{{ asset('img/'.$post->Image) }}" width="200" height="auto"></a><br/>
    {{ $post->title }}<br/>
    {{ $post->category }}<br/>
    {{--  <a href='{{route('post.delete', ['id' => $post->id])}}'>Delete</a>
    <a href='{{route('post.edit', ['id' => $post->id])}}'>Edit</a>  --}}
    <br/>

@endforeach

{{ $posts->links() }}

@endsection
