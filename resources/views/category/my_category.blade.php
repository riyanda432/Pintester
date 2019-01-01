
@extends('layouts.app')
@section('content')
<div class="w3-container">
        <a href="{{route('category.index')}}" class="btn btn-info" role="button">Add Category +</a>
    </div>
  <br><br>    
@foreach($category as $c)
    <tr>
         <td>
                {{$c->id}}
         </td>
        <td>
                {{$c->category_name}}
        </td>
        <a href='{{route('category.delete', ['id' => $c->id])}}'>Delete</a>
        <a href='{{route('category.edit', ['id' => $c->id])}}'>Edit</a>
    <hr>
    </tr>
@endforeach

@endsection
