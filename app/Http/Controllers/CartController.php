<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
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
use App\Stoc;

class CartController extends Controller
{
    public function showCart()
    {
        $data['menu'] = $this->getMenu();
        $data['languages'] = Config::get('languages.items');
        $data['subview'] = 'showCart';
        
        /* cart items */
        $data['cart'] = cartItems();
        
        /* extra js file */
        $data['extra_js'][] = '/frontend/js/account-form-script.js';

        return view('frontend.main')->with($data);        
    }
    
    
    public function addToCart(Request $request)
    {
        //session()->forget('cart');
        $response = array(
            'status' => 'error',
            'message' => ''
        );
        
        $product = Product::where('id', $request->input('product_id'))->first();
        
        // get product image
        $productImage = ProductImage::where('product_id', $request->input('product_id'))->first();

        if(!$product) {
            abort(404);
        }

        $cart = session()->get('cart');
        $id = $product->id;
        
        // if cart is empty then this the first product
        if(!$cart) {
            $cart['items'] = [
                $id => [
                    "name" => $product->name,
                    "quantity" => $request->input('quantity'),
                    "price" => $product->price,
                    "image" => $productImage->image
                ]
            ];
        
        } else {
 
            // if cart not empty then check if this product exist then increment quantity
            if(isset($cart['items'][$id])) {
                $cart['items'][$id]['quantity'] += $request->input('quantity');
              } else {
                 // if item not exist in cart then add to cart with input quantity
                $cart['items'][$id] = [
                    "name" => $product->name,
                    "quantity" => $request->input('quantity'),
                    "price" => $product->price,
                    "image" => $productImage->image
                ];
            }
        }
        
        $this->updateCartData($cart);
        $data['cart'] = cartItems();
        
        $response['status'] = 'success';
        $response['html1'] = view('frontend.cart-items')->with($data)->render();
        $response['html2'] = view('frontend.my-cart')->with($data)->render();
        
        return response()->json($response);
    }
    
    public function removeFromCart(Request $request)
    {
        $response = array(
            'status' => 'error',
            'message' => ''
        );
                
        $cart = session()->get('cart');
        unset($cart['items'][$request->input('product_id')]);

        $this->updateCartData($cart);
        $data['cart'] = cartItems();
        
        $response['status'] = 'success';
        $response['html1'] = view('frontend.cart-items')->with($data)->render();
        $response['html2'] = view('frontend.my-cart')->with($data)->render();
        
        return response()->json($response);
    }
        
    public function updateCart(Request $request)
    {
        $cart = cartItems();
        if(count($cart['items']) == 0) {
            abort(404);
        }
        foreach($cart['items'] as $key => $val) {
            $cart['items'][$key]['quantity'] = $request->input('quantity')[$key];
            if( $cart['items'][$key]['quantity'] <= 0 ) {
                unset($cart['items'][$key]);
            }
        }

        $this->updateCartData($cart);
        
        return redirect()->back()->with('success', trans('lang.shop_page.update_basket_with_success'));
    }
    
    private function updateCartData($cart) 
    {
        if( count($cart['items']) == 0 ) {
            session()->forget('cart');
        } else {
            $subtotal = 0;
            $discount = 1;
            $coupon_discount = 1;
            $tax = Config::get('constants.ORDER_TAX');
            $order_shipping_cost = Config::get('constants.SHIPPING_ORDER_TAX');
            $order_total = 0;
            
            foreach($cart['items'] as $item){
                $subtotal += $item['quantity'] * $item['price'];
            }
            $cart['subtotal'] = $subtotal;
            $cart['discount'] = $discount;
            $cart['coupon_discount'] = $coupon_discount;
            $order_tax = $subtotal * $tax / 100;
            $cart['order_tax'] = $order_tax;
            $cart['order_shipping_cost'] = $order_shipping_cost;
            
            $order_total = $subtotal - $discount - $coupon_discount + $order_tax + $order_shipping_cost;
            
            /*echo '<pre>' . print_r($subtotal, TRUE) . '</pre>';
            echo '<pre>' . print_r($discount, TRUE) . '</pre>';
            echo '<pre>' . print_r($coupon_discount, TRUE) . '</pre>';
            echo '<pre>' . print_r($order_tax, TRUE) . '</pre>';
            echo '<pre>' . print_r($order_shipping_cost, TRUE) . '</pre>';
            echo '<pre>' . print_r($order_total, TRUE) . '</pre>';

            exit;*/

            $cart['order_total'] = $order_total;
            session()->put('cart', $cart);
        }
    }
    
    public function checkout()
    {
        if(!Auth::check()) {
            return redirect('shop');
        }

        $data['menu'] = $this->getMenu();
        $data['languages'] = Config::get('languages.items');
        $data['subview'] = 'checkout';
       
        $data['user_details'] = Users_details::where('user_id', Auth::user()->id)->first();
        //echo '<pre>' . print_r($data['user_details']->region, TRUE) . '</pre>';
        
        
        /* country */
        $data['countries'] = Country::all();

        /* regions */
        if(empty($data['user_details']->country)) {
            $countryRequest = Config::get('constants.DEFAULT_COUNTRY_ID');
        } else {
            $countryRequest = $data['user_details']->country;
        }
        $data['regions'] = Region::where('country_id', $countryRequest)->orderBy('name', 'asc')->get();
        //$first = Region::where('country_id', Config::get('constants.DEFAULT_COUNTRY_ID'))->orderBy('name', 'asc')->first();

        /* cities */
        if(empty($data['user_details']->city)) {
            $firstRegion = Region::where('country_id', Config::get('constants.DEFAULT_COUNTRY_ID'))->orderBy('name', 'asc')->first();
            $cityRequest = $firstRegion->id;
        } else {
            $cityRequest = $data['user_details']->region;
        }
        
        //$data['cities'] = City::where('region_id', $first->id)->get();
        $data['cities'] = City::where('region_id', $cityRequest)->get();

        /* cart items */
        $data['cart'] = cartItems();
        
        /* extra js file */
        $data['extra_js'][] = '/frontend/js/order-form-script.js';
        $data['extra_js'][] = '/frontend/js/country-region-script.js';

        return view('frontend.main')->with($data);
    }
    
    public function completeOrder(Request $request)
    {
        $data = array();
        
        /* cart items */
        $data['cart'] = cartItems();
        
        if(empty($data['cart'])) {
            return Redirect::to('/');
        }

        /* save / update user details */
        $user_details = Users_details::where('user_id', Auth::user()->id)->first();
       
        if( $user_details == NULL ) {
            $details = new Users_details();
            $details->user_id = Auth::user()->id;
            $details->phone = $request->input('phone');
            $details->region = $request->input('region');
            $details->city = $request->input('city');
            $details->zipcode = $request->input('zipcode');
            $details->country = $request->input('country');
            $details->address_street = $request->input('address_text');
            $details->address_street2 = $request->input('address_text2');
        } else {
            $details = $user_details;
            $details->region = $request->input('region');
            $details->city = $request->input('city');
            $details->zipcode = $request->input('zipcode');
            $details->country = $request->input('country');
            $details->address_street = $request->input('address_text');
            $details->address_street2 = $request->input('address_text2');
        }
        $details->save();

        // create order
        $order = new Order();
        
        $order->user_id = Auth::user()->id;
        $order->status = 1;
        $order->order_date = date('Y-m-d h:m:s');
        $order->address_street = $request->input('address_text');
        $order->address_street2 = $request->input('address_text2');
        $order->phone = $request->input('phone');
        $order->country = $request->input('country');
        $order->region = $request->input('region');
        $order->city = $request->input('city');
        $order->zipcode = $request->input('zipcode');
        $order->order_tax = $data['cart']['order_tax'];
        $order->order_shipping_cost = $data['cart']['order_shipping_cost'];
        $order->coupon_discount = $data['cart']['coupon_discount'];
        $order->discount = $data['cart']['discount'];
        $order->total = $data['cart']['order_total'];
        
        $order->save();
        
        $i = 1;
        foreach($data['cart']['items'] as $key => $val) {
            // create order item
            $order_items = new Order_item();
            
            $order_items->order_id = $order->id;
            $order_items->item_id = $i;
            $order_items->product_id = $key;
            $order_items->quantity = $val['quantity'];
            $order_items->unit_price = $val['price'];

            $order_items->save();
            $i++;
        }
        
        
        foreach($data['cart']['items'] as $key => $val) {
            // add stocs table entry
            $stocOut = new Stoc();
            $stocOut->product_id = $key;
            $stocOut->out = $val['quantity'];
            $stocOut->order_id = $order->id;
            
            $stocOut->save();
        }

        //reset data array
        $data = array(
            'firstname' => Auth::user()->firstname,
            'name'      => Auth::user()->name,
        );
        
        $user_detail = Users_details::find(Auth::user()->id);
        
        $region = Region::where('id', $user_detail->region)->get('name')->toArray();
        $region = $region[0]['name'];

        $city = City::where('id', $user_detail->city)->get('name')->toArray();
        $city = $city[0]['name'];

        $data['region_city_zipcode'] = $city . ', ' . $region . ', ' . $user_detail->zipcode;
        
        $country = Country::where('id', $user_detail->country)->get('name')->toArray();
        $country = $country[0]['name'];
        
        $data['country'] = $country;
        $data['address_text'] = $request->input('address_text');
        $data['address_text2'] = $request->input('address_text2');
        $data['phone'] = $request->input('phone');
        
        /* cart items */
        $data['cart'] = cartItems();

        Mail::send( ['html' => 'email/order_email_template'], $data, function($message) {
            $message->from( Config::get('mail.from.address'), Config::get('mail.from.name') );
            
            $message->to( 'vasile-ovidiu.cristea@artsoft-consult.ro' )->subject( trans('lang.shop_page.order_confirm') );
        }); 
        
        // empty session cart
        session()->forget('cart');
        
        $data['menu'] = $this->getMenu();
        $data['languages'] = Config::get('languages.items');
        
        $data['subview'] = 'endOrder';
        $data['success'] = trans('lang.shop_page.end_order');
        $data['message'] = trans('lang.shop_page.end_order_message');        
        
        return view('frontend.main')->with($data);
    }
}
