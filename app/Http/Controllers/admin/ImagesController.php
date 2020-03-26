<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use App\ProductImage;
use App\Product;

class ImagesController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'id' => $request->input('product_id'),
        );
        
        if($request->hasFile('product_image')) {

            //get file name with extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();

            //check if image exist
            $existImage = ProductImage::where('product_id', $request->input('product_id'))->where('image', $fileNameWithExt)->first();
            
            if($existImage !== null) {
                $data['error'] = 'Imagine existenta !!!';
                return redirect('products/' . $request->input('product_id') . '/edit')->with($data);                
            }
            
            $image = new ProductImage();
            $image->product_id = $request->input('product_id');

            // get only the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // get only the extension
            $extension = $request->file('product_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . '.' . $extension;
            //upload image
            $path = $request->file('product_image')->storeAs('public/frontend/images', $fileNameToStore);
             
            $image->image = $fileNameToStore; 
        }
        $image->save();
        
        $data['success'] = 'Imagine adaugata';
        return redirect('products/' . $request->input('product_id') . '/edit')->with($data);
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
    public function destroy(Request $request)
    {
        $response = array(
            'status' => 'error',
            'message' => ''
        );
        
        $imageFile = storage_path('/app/public/frontend/images/' . $request->input('name'));
        
        if(File::exists($imageFile)) {
            unlink($imageFile);
        }

        $res = ProductImage::where(['product_id' => $request->input('product_id'), 'image' => $request->input('name')])->delete();
        
        if ($res) {
            $data['product_id'] = $request->input('product_id');
            $data['product_images'] = ProductImage::where('product_id', $request->input('product_id'))->get();
            $data['action'] = 'PUT';
            
            $response['status'] = 'success';
            $response['message'] = view('backend.productImages')->with($data)->render();
        }
       
        return response()->json($response);
    }
}

