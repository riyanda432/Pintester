<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $items = null;
    public $totalPrice = 0;
    public $pid;

    public function __construct($cart)
    {
        if($cart){
            $this->items = $cart->items;
            $this->totalPrice = $cart->totalPrice;
            $this->pid = $cart->pid;
        }
    }

    public function add($item, $id){ // taro parameter 
        $storedItem = ['price' => $item->price,'item' => $item]; 
        if($this->items){
            if(array_key_exists($id, $this->items)){ 
                return back()->with('msgDupe', 'Cannot add more than 1 of the same Post!!');
            }
        }
        $storedItem['price'] = $item->price;
        $this->items[$id] = $storedItem;
        $this->totalPrice += $item->price;
        $this->pid = $item->id;
    }

    public function reducePrice($pid){
        $this->totalPrice -= $this->items[$pid]['item']['price'];

        if($this->totalPrice <= 0){
            unset($this->items[$pid]);
        }
    }
}
