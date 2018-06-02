<?php

use Illuminate\Database\Seeder;

class ProductTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'imagePath' => 'http://demo.ajax-cart.com/var/photo/product/2000x4000/4/176/4.jpg',
            'title' => 'Screen',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
            'price' => 20,
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => 'http://demo.ajax-cart.com/var/photo/product/2000x4000/65/237/5.jpg',
            'title' => 'Phone Screen',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
            'price' => 50,
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => 'http://demo.ajax-cart.com/var/photo/product/2000x4000/62/234/2.jpg',
            'title' => 'Laptop Screen',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
            'price' => 20,
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => 'http://demo.ajax-cart.com/var/photo/product/2000x4000/81/253/6.jpg',
            'title' => 'Tv Screen',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
            'price' => 30,
        ]);

        $product->save();
    }
}
