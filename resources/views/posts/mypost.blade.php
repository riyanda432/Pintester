@extends('layouts.app')
<form action="{{route('searchPost')}}" method="GET">
    <input type="text" name="search" placeholder="search by title">
    <input type="submit" value="submit">
</form>
@section('content')

<div class="w3-container">
    <a href="{{route('post.create')}}" class="btn btn-info" role="button">Add Post +</a>
</div>
  
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">

  <!-- First Photo Grid-->
  <div class="w3-row-padding w3-padding-16 w3-center" id="food">
    <div class="w3-quarter">
    @foreach ($posts as $post)
        <img src="{{ asset('img/'.$post->Image) }}" width="200" height="auto"><br/>
       
        {{ $post->title }}<br/>
        {{ $post->category }}<br/>

        <a href='{{route('post.delete', ['id' => $post->id])}}'>Delete</a>
        <a href='{{route('post.edit', ['id' => $post->id])}}'>Edit</a>
        <hr>
    @endforeach
    </div>
    
  </div>
  <div>
      {{$posts->links()}}
  </div>

  <!-- Pagination -->
  <p>
        {{$posts->appends(['search'=>request()->search])->links()}}
    </p>
   
    
@endsection
