<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use File;
use App\Product;
use App\Category;
use App\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class ProductsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'products' => Product::getAllProductsWithCategoriesName(),
            'subview' => 'products',
            'menuSelected' => 'products',
        );

        //echo '<pre>' . print_r($data, TRUE) . '</pre>';
        //exit;

        return view('backend.main')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Category();
        $product->status = 1;
        
        $data = array(
            'product' => $product,
            'formTitle' => 'Adauga un produs',
            'subview' => 'editProduct',
            'product_id' => null,
            'product_images' => array(),
            'categories' => Category::all(),        
            'product_activity' => array(),
            'controllerAction' => 'store',
            'action' => 'POST',
            'menuSelected' => 'products',
        );
        return view('backend.main')->with($data); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ]);
        
        // Create product
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->long_description = !empty($request->input('long_description')) ? $request->input('long_description') : NULL;
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->status = $request->input('status');
        
        $product->save();

        return redirect('products');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'product' => Product::find($id),
            'categories' => Category::all(),
            'product_id' => $id,
            'product_images' => ProductImage::where('product_id', $id)->get(),
            'formTitle' => 'Editare produs',
            'controllerAction' => 'update',
            'action' => 'PUT',
            'subview' => 'editProduct',
            'menuSelected' => 'products',
        );
        
        $data['product_activity'] = DB::table('stocs')->where('product_id', $id)->get();
        
        return view('backend.main')->with($data);         
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ]);
        
        // Update product
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->long_description = !empty($request->input('long_description')) ? $request->input('long_description') : NULL;
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->status = $request->input('status');

        $product->save();

        $data = array(
            'success' => 'Modificariile produsului salvate cu succes',
            'id' => $id,
        );
        
        return redirect('products/' . $id . '/edit')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
