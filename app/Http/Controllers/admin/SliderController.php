<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use File;
use App\Slider;

class SliderController extends BaseController
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
            'sliders' => Slider::all(),
            'subview' => 'slider',
            'menuSelected' => 'slider',
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
        $slider = new Slider();
        $slider->status = 1;
        
        $data = array(
            'slider' => $slider,
            'formTitle' => 'Adauga un slider nou',
            'subview' => 'editSlider',
            'controllerAction' => 'store',
            'action' => 'POST',
            'menuSelected' => 'slider',
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
            'title' => 'required',
            'description' => 'required',
            'button_text' => 'required'
        ]);
  
        // Create slider
        $slider = new Slider();
        
        $this->saveSlider($slider, $request);
        return redirect('slider');
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
            'slider' => Slider::find($id),
            'formTitle' => 'Editare slider',
            'subview' => 'editSlider',
            'controllerAction' => 'update',
            'action' => 'PUT',
            'menuSelected' => 'slider',
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
            'title' => 'required',
            'description' => 'required',
            'button_text' => 'required'
        ]);
  
        // Update slider
        $slider = Slider::find($id);
        
        $this->saveSlider($slider, $request);
     
        $data = array(
            'success' => 'Modificariile slider-ului salvate cu succes',
            'id' => $id,
        );
        
        return redirect('slider/' . $id . '/edit')->with($data);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $imageFile = storage_path('app/public/frontend/images/' . $slider->image);
        
        if(File::exists($imageFile)) {
            unlink($imageFile);
        }
        $slider->delete();
        return redirect('slider')->with('success', 'Slider Sters');
    }
    
    private function saveSlider($slider, $request) 
    {
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
        $slider->button_text = $request->input('button_text');
        $slider->status = $request->input('status');
        
        
        if($request->hasFile('slider_image')) {
            //get file name with extension
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();

            // get only the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // get only the extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . '.' . $extension;
            //upload image
            $path = $request->file('slider_image')->storeAs('public/frontend/images', $fileNameToStore);
            
            $slider->image = $fileNameToStore;
        }

        $slider->save();
    }
}
