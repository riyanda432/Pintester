

@extends('layouts.app');
@section('content');
   
<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
   
    Category: <input type="text" name="category_name"><br/> 
    
    <input type="submit">
</form>


@endsection