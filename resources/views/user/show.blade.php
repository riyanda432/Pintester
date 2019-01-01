@extends('layouts.app')
@section('content')
    
@foreach ($user as $u)
    ID: {{$u->id}}<br/>
    Name: {{ $u->name }}<br/>
    Email: {{ $u->email }}<br/>
    Gender: {{ $u->gender }}<br/>

    <hr>
    <a href='{{route('user.delete', ['id' => $u->id])}}'>Delete</a>
    <a href='{{route('user.edit', ['id' => $u->id])}}'>Edit</a>
@endforeach

@endsection