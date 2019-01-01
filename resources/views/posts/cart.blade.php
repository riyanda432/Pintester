@extends('layouts.app');

@section('content');
    
@if(Session::has('posts/cart'))
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <ul class="list-group">

            @foreach((array) $post as $p)
                <li>
                    <img src="/img/{{$p['item']['Image']}}" name="image" alt="" width="150px" height="150px">
                    <p> Image Title : {{$p['item']['title']}}</p>
                    <p> Image Price : {{$p['item']['price']}}</p>
                    <p> Image Owner : {{ Auth::user()->name }}</p>
                        <a href="{{route('cart.delete', ['id' => $p['item']['id']])}}" type="submit" class="btn btn-primary" style="background-color: crimson; margin-left: 60px">
                            Remove
                        </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
 <form method="POST" action="{{ url('/doCheckout/'.$pid) }} " enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total Price : {{$totalPrice}}</strong>
            <button type="submit" class="btn btn-primary" style="background-color: orange; margin-left: 70px">
                Checkout
            </button>
        </div>
    </div>
</form> 
@else
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <h2>There are no items in your cart..</h2>
    </div>
</div>

@if(session()->has('successCheck'))
    <div class="alert alert-danger">
        {{ session()->get('successCheck') }}
    </div>
@endif
@endif

@endsection

