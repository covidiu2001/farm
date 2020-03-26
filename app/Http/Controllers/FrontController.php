<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Slider;
use App\Category;
use App\Contact;
use App\Product;
use App\Stoc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource - front page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'sliders' => Slider::get()->where('status', true),
            'categories' => Category::get()->where('status', true),
        );
        //Session::forget('cart');

        $data['menu'] = $this->getMenu();
        $data['menu']['Home']['li_class'] = 'nav-item active';
        $data['languages'] = Config::get('languages.items');
        
        $data['products'] = Product::getFrontPageProducts();

        /* cart items */
        $data['cart'] = cartItems();

        //echo '<pre>' . print_r(Session::all(), TRUE) . '</pre>';
        
        return view('frontend.main')->with($data);
    }

    /**
     * Display the specified resource - category with availables products.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCategoryProducts(Request $request, $id)
    {
        $data['menu'] = $this->getMenu();
        $data['menu']['Categories']['li_class'] = 'dropdown nav-item active';
        $data['subview'] = 'displayCategory';
        
        // breadcrumbs
        $breadcrumbs['header'] = trans(Config::get('menu.notLoggedIn.Categories.text'));
        $breadcrumbs['items']['Home'] = Config::get('menu.notLoggedIn.Home');
        $breadcrumbs['items']['Categories'] = Config::get('menu.notLoggedIn.Categories');
        
        $data['breadcrumbs'] = $this->createBreadCrumbs($breadcrumbs);

        // languages
        $data['languages'] = Config::get('languages.items');
        
        /* get category */
        $data['category'] = Category::get()->where('id', $id)->first();

        /* get all products belongs to category */
        $data['products'] = Product::where('category_id', $id)->paginate(Config::get('constants.FRONT_PAGE_PAGINATION'));
        
        /* get product image and stocs */
        foreach($data['products'] as $product) {
            $data['product_image']['product_id_' . $product->id] = DB::table('product_images')->where('product_id', $product->id)->first();
            $data['stoc']['product_id_' . $product->id] = Stoc::getProductData($product->id);
        }
        

        /* set min and max for slider */
        $min = $max = 0;
        foreach($data['products'] as $products) {
            if($products->price < $min || $min == 0) {
                $min = $products->price;
            }
            if($products->price > $max || $max ==0) {
                $max = $products->price;
            }
        }
        $data['min_price'] = floor($min);
        $data['max_price'] = ceil($max);

        /* display type */
        $data['listView'] = '#list-view';
        
        /* cart items */
        $data['cart'] = cartItems();
        
        $data['extra_js'][] = '/frontend/js/change-product-display-script.js';
        
        return view('frontend.main')->with($data);        
    }
    
    public function filterProducts(Request $request)
    {
        $response = array(
            'status' => 'error',
            'message' => ''
        );
        $id = $request->input('cat_id');
        
        /* get all products belongs to category */
        $filter = $request->input('filter');
        
        $data = array();
        $data['listView'] =  $request->input('list_view');

        $search = $request->input('search');
        switch ($filter) {
            
            case 'price_asc':
                $products = Product::whereRaw('category_id = ? and name like ?', [$request->input('cat_id'), "%{$search}%"])->orderBy('price', 'asc')->get();
                
                $response['status'] = 'success';
                break;
            case 'price_desc':
                $products = Product::whereRaw('category_id = ? and name like ?', [$request->input('cat_id'), "%{$search}%"])->orderBy('price', 'desc')->get();
                
                $response['status'] = 'success';
                break;
            case 'searchProduct':
                //$search = $request->input('search');
                $products = Product::whereRaw('category_id = ? and name like ?', [$request->input('cat_id'), "%{$search}%"])
                    ->orderBy('id', 'asc')
                    //->paginate(Config::get('constants.FRONT_PAGE_PAGINATION'));
                    ->get();                    
                
                $response['status'] = 'success';
                break;
            default:
                $products = Product::where('category_id', $id)->orderBy('id', 'asc')->get();
                
                $response['status'] = 'success';
                break;
        }
        
        $data['products'] = $products;
        
        /* get product image ans stocs */
        foreach($data['products'] as $product) {
            $data['product_image']['product_id_' . $product->id] = DB::table('product_images')->where('product_id', $product->id)->first();
            $data['stoc']['product_id_' . $product->id] = Stoc::getProductData($product->id);            
        }        
        
        $response['message'] = view('frontend.product_display')->with($data)->render();

        //$products = Product::get()->where('category_id', $id);
        
        //$returnHTML = view('frontend.product_display')->with('products', $products)->render();
        //$returnHTML = '<div>order change</div>';
        //return response()->json(array('status' => 'success', 'message'=> $returnHTML));
        
        return response()->json($response);
    }
    
    public function contact()
    {
        $data['menu'] = $this->getMenu();
        $data['menu']['Contact']['li_class'] = 'nav-item active';
        $data['subview'] = 'contact';

        $breadcrumbs['header'] = trans(Config::get('menu.notLoggedIn.Contact.text'));
        $breadcrumbs['items']['Home'] = Config::get('menu.notLoggedIn.Home');
        $breadcrumbs['items']['Account'] = Config::get('menu.notLoggedIn.Contact');
        $data['languages'] = Config::get('languages.items');

        $data['breadcrumbs'] = $this->createBreadCrumbs($breadcrumbs);

        /* cart items */
        $data['cart'] = cartItems();
        
        /* js variable */
        $data['js_values'] = array('defaultMessage' => trans('lang.required_form_fields'));
        return view('frontend.main')->with($data);
    }
    
    /**
     * Save massage form contact page and send e-mail
     */
    public function sendMessage(Request $request)
    {
        $response = array(
            'status' => 'success',
            'message' => trans('lang.contact_page.message_send')
        );
            
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {        
            $response = array(
                'status' => 'error',
                'message' => $validator->errors()->first()
            );
            return response()->json($response);
        }
        
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');

        $contact->save();

        $data = array(
            'name'      => $contact->name,
            'subject'   => $contact->subject,
            'message'   => $contact->message,
            'view'      => 'email/contact_email_template',
        );
     
        Mail::to($contact->email)->send(new SendMail($data));

        if( count(Mail::failures()) > 0 ) {
            $response = array(
                'status' => 'error',
                'message' => trans('lang.contact_page.message_send_error')
            );
        }
        
        return response()->json($response);
        //return back()->with('success', 'Thanks for contacting us!');        
    }
 
    /**
     * Create front page breadcrumbs
     */
    
    private function createBreadCrumbs($data)
    {
        $breadcrumbs = array();
        if(empty($data['header'])) {
            $breadcrumbs['header'] = trans(Config::get('menu.notLoggedIn.Home.text'));
        } else {
            $breadcrumbs['header'] = $data['header'];
        }
        
        if(!empty($data['items'])) {
            $breadcrumbs['items'] = $data['items'];
        }

        return $breadcrumbs;
    }

    /**
     * User login account page
     */
    public function accountLogin()
    {
        $data['menu'] = $this->getMenu();
        $data['menu']['Account']['li_class'] = 'nav-item active';
        $data['subview'] = 'account';
        $data['languages'] = Config::get('languages.items');
        $data['extra_js'][] = '/frontend/js/account-form-script.js';
        
        if(Auth::check()) {
            $data['subview'] = 'user_account';
        }

        $breadcrumbs['header'] = trans(Config::get('menu.notLoggedIn.Account.text'));
        $breadcrumbs['items']['Home'] = Config::get('menu.notLoggedIn.Home');
        $breadcrumbs['items']['Account'] = Config::get('menu.notLoggedIn.Account');

        $data['breadcrumbs'] = $this->createBreadCrumbs($breadcrumbs);
        
        /* cart items */
        $data['cart'] = cartItems();
        
        return view('frontend.main')->with($data);
    }   

    /**
     * Create account
     */
    public function createAccount()
    {
        $data['menu'] = $this->getMenu();
        $data['menu']['Account']['li_class'] = 'nav-item active';
        $data['subview'] = 'createAccount';
        $data['languages'] = Config::get('languages.items');
        $data['extra_js'][] = '/frontend/js/account-form-script.js';
        
        if(Auth::check()) {
            $data['subview'] = 'user_account';
        }

        $breadcrumbs['header'] = trans(Config::get('menu.notLoggedIn.Account.text'));
        $breadcrumbs['items']['Home'] = Config::get('menu.notLoggedIn.Home');
        $breadcrumbs['items']['Account'] = Config::get('menu.notLoggedIn.Account');

        $data['breadcrumbs'] = $this->createBreadCrumbs($breadcrumbs);
        
        /* cart items */
        $data['cart'] = cartItems();
        
        return view('frontend.main')->with($data);        
    }
    
    /**
     * Create account
     */
    public function register(Request $request)
    {
        dd($request);
    }    
    
    public function showProduct($id)
    {
        $data['menu'] = $this->getMenu();
        $data['menu']['Categories']['li_class'] = 'dropdown nav-item active';
        $data['subview'] = 'showProduct';
        $data['languages'] = Config::get('languages.items');

        $data['product'] = Product::where('id', $id)->get()->first();
        $data['product_stoc'] = Stoc::getProductData($id)[0];
        
        // get products images
        $product_id = $data['product']->id;
        $data['product_images'] = DB::table('product_images')->where('product_id', $product_id)->get()->toArray();
        
        //get related products except this product
        $data['product_related_items'] = Product::get()->where('category_id', $data['product']->category_id)->where('id', '!=', $data['product']->id);

        // get related product image
        foreach($data['product_related_items'] as $related_product) {
            $data['related_product_images']['product_id_' . $related_product->id] = DB::table('product_images')->where('product_id', $related_product->id)->first();            
        }

        $breadcrumbs['header'] = trans('lang.product_page.product_page');
        $breadcrumbs['items']['Home'] = Config::get('menu.notLoggedIn.Home');
        $breadcrumbs['items']['Categories'] = Config::get('menu.notLoggedIn.Categories');

        $data['breadcrumbs'] = $this->createBreadCrumbs($breadcrumbs);
        
        /* cart items */
        $data['cart'] = cartItems();
        
        return view('frontend.main')->with($data);        
    }
}
