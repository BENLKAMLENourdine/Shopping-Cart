<?php

namespace App;


class Cart
{
    public $items = array();
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            }
    }

    public function addItem($product, $id)
    {
        $storedItem = ['qty' => 0,'price' => $product->price,'item' => $product];
        if($this->items){
            if(!empty($this->items[$id])){//array_key_exists($id, $this->items)
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;
        $storedItem['price'] = $product->price * $storedItem['qty'];
        $this->items[$id] = array();
        if(is_array($this->items[$id])){
            $this->items[$id] = $storedItem;
        }
        $this->totalQty++;
        $this->totalPrice += $product->price;
    }

    public function reduce($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        if($this->items[$id]['qty'] <= 0)
            unset($this->items[$id]);
    }

    public function remove($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
