<?php

namespace App\Http\Controllers;
use App\Cart;
use Session;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function addCart(Request $request ,$id)
    {
        //
        $post = new Post();
        $post = Post::find($id);
        $cart = Session::has('posts/cart') ? Session::get('posts/cart') : null;
        $carts = new Cart($cart);

        $carts->add($post, $post->id);
        $request->session()->put('posts/cart', $carts);

        return back();
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function cart(){
        $post = new Post();
        if(!Session::has('posts/cart')){
            return view('posts/cart'); 
        }
        $cart = Session::get('posts/cart');
        $carts = new Cart($cart);
        //dd($carts);
        return view('posts/cart', ['post' => $carts->items, 'totalPrice' => $carts->totalPrice,
            'pid' => $carts->pid]);    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid)
    {
        //
        $post = new Post();

        $cart = Session::has('posts/cart') ? Session::get('posts/cart') : null;
        $carts = new Cart($cart);
        $carts->reducePrice($pid);

        unset($carts->items[$pid]);

        if(count($carts->items) > 0){
            Session::put('posts/cart', $carts);
        }else{
            Session::forget('posts/cart');
        }
        
        return redirect()->back();

    
    }
}
