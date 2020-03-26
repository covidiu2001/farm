<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use File;
use App\Category;

class CategoryController extends BaseController
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
            'categories' => Category::all(),
            'subview' => 'categories',
            'menuSelected' => 'category',
        );
        return view('backend.main')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $category->status = 1;
        
        $data = array(
            'category' => $category,
            'formTitle' => 'Adauga o categorie noua',
            'subview' => 'editCategory',
            'controllerAction' => 'store',
            'action' => 'POST',
            'menuSelected' => 'category',
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
            'description' => 'required'
        ]);
  
        // Create category
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status');
        
        
        if($request->hasFile('category_image')) {
            //get file name with extension
            $fileNameWithExt = $request->file('category_image')->getClientOriginalName();

            // get only the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // get only the extension
            $extension = $request->file('category_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . '.' . $extension;
            //upload image
            $path = $request->file('category_image')->storeAs('public/frontend/images', $fileNameToStore);
            
            $category->image = $fileNameToStore;
        }

        $category->save();

        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
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
            'category' => Category::find($id),
            'formTitle' => 'Editare categorie',
            'subview' => 'editCategory',
            'controllerAction' => 'update',
            'action' => 'PUT',
            'menuSelected' => 'category',
        );
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
            'menuSelected' => 'category',
        ]);
        
        // Update category
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status');
              
        
        if($request->hasFile('category_image')) {
            //get file name with extension
            $fileNameWithExt = $request->file('category_image')->getClientOriginalName();

            // get only the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // get only the extension
            $extension = $request->file('category_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . '.' . $extension;
            //upload image
            $path = $request->file('category_image')->storeAs('public/frontend/images', $fileNameToStore);
             
            $category->image = $fileNameToStore; 
            
        }
        
        $category->save();

        $data = array(
            'success' => 'Modificariile categoriei salvate cu succes',
            'id' => $id,
        );
        
        return redirect('category/' . $id . '/edit')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $imageFile = storage_path('app/public/frontend/images/' . $category->image);
        
        if(File::exists($imageFile)) {
            unlink($imageFile);
        }
        $category->delete();
        return redirect('category')->with('success', 'Categoria a fost stearsa');
    }
}
