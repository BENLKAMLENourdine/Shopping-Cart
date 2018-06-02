<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Order;
use Auth;
use Session;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::all();
        //dd($request->session()->get('cart'));
        return view('shop.index',['products' => $products]);
    }

    function addToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addItem($product,$product->id);

        $request->session()->put('cart',$cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('product.index');
            }

        function reduce($id){
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->reduce($id);
                if(count($cart->items) > 0)
                    Session::put('cart',$cart);
                else
                    Session::forget('cart');
                return redirect()->route('products.shoppingcart');
            }

            function remove($id){
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->remove($id);
                if(count($cart->items) > 0)
                    Session::put('cart',$cart);
                else
                    Session::forget('cart');
                return redirect()->route('products.shoppingcart');
            }

        public function getCart()
        {
            if(!Session::has('cart'))
                return view('shop.shopping_cart');
            else{
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                return view('shop.shopping_cart',[
                    'totalPrice' => $cart->totalPrice,
                    'products' => $cart->items
                ]);
            }
        }

        public function getCheckout()
        {
            if(!Session::has('cart'))
                return view('products.shoppingcart');

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $totalPrice = $cart->totalPrice;
            return view('shop.checkout',['total' => $totalPrice]);
        }

        public function postCheckout(Request $request)
        {
            if(!Session::has('cart'))
                return redirect()->route('products.shoppingcart');

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            \Stripe\Stripe::setApiKey("sk_test_2nwZNq5HqnWIzh6m1fhnADmA");
            try{
                $charge = \Stripe\Charge::create(array(
                  "amount" => $cart->totalPrice * 100,
                  "currency" => "usd",
                  "source" => $request->input('stripeToken'),
                  "description" => "Charge test"
                ));

                $order = new Order();
                $order->cart = serialize($cart);
                $order->name = $request->input('name');
                $order->address = $request->input('address');
                $order->payment_id = $charge->id;
                Auth::user()->orders()->save($order);
            }
            catch(\Exception $e){
                return redirect()->route('checkout')->with('error',$e->getMessage());
            }

            Session::forget('cart');
            return redirect()->route('product.index')->with('success','successfly purchased products');
        }
}
