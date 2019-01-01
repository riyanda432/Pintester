@extends('layouts.app');
@section('content');
    
<form action="{{route('post.storeee')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    Title: <input type="text" name="title"><br/>
    Category: <select id="category" name="category" class="form-control">
        <option value="0">-- Choose One --</option>
        @foreach($category as $c)
            <option value="{{ $c->category_name }}">{{$c->category_name}}</option>
        @endforeach
    </select> <br/>
    Caption: <input type="text" name="caption"><br/>
    Image: <input type="file" name="Image"><br/>
    Price: <input type="text" name="price"><br/>
    <input type="submit">
</form>

@endsection
