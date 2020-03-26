<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

use Redirect;
use App\Product;
use App\Category;
use App\ProductImage;
use App\Users_details;
use App\Country;
use App\Region;
use App\City;
use App\Order;
use App\Order_item;

class OrderController extends Controller
{
    
    private function checkUser()
    {
        if(!Auth::check()) {
            return Redirect::to('/')->send();
        }
    }


    public function getUserOrders()
    {
        $this->checkUser();

        $data = array();
        $data['menu'] = $this->getMenu();
        $data['subview'] = 'user_orders';
        
        /* cart items */
        $data['cart'] = cartItems();
        
        $data['orders'] = Order::get()->where('user_id', Auth::user()->id)->toArray();
        
        //echo '<pre>' . print_r($data, TRUE) . '</pre>';
        //exit;

        return view('frontend.main')->with($data);
    }
 
    public function getUserOrderDetails(Request $request)
    {
        $this->checkUser();
        
        $data = array();
        $data['menu'] = $this->getMenu();
        $data['subview'] = 'user_order_details';
        
        /* cart items */
        $data['cart'] = cartItems();
        
        $data['order'] = Order::get()->where('id', $request->input('order_id'))->first()->toArray();
        
        $order_details = Order_item::get()->where('order_id', $request->input('order_id'))->toArray();
        
        // get products name and image
        foreach($order_details as $key => $val) {
            $product_name = Product::where('id', $val['product_id'])->get('name')->first()->toArray();
            
            $product_image = ProductImage::where('product_id', $val['product_id'])->get('image')->first()->toArray();
            $order_details[$key]['product_name'] = $product_name['name'];
            $order_details[$key]['image'] = $product_image['image'];
        }
        $data['order_details'] = $order_details;
        
        //echo '<pre>' . print_r($data, TRUE) . '</pre>';
        //exit;
        
        return view('frontend.main')->with($data);        
    }
}
