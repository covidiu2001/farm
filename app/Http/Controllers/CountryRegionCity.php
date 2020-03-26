<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Form;
use App\AjaxResponse;
use App\City;
use App\Region;

class CountryRegionCity extends Controller
{
    public function getCity(Request $request)
    {
        $response = new AjaxResponse();
        
        $data['cities'] = City::where('region_id', $request->region_id)->get();

        $response->setStatusOK();
        $response->setMessage(view('frontend.city_dropdown')->with($data)->render());

        return response()->json($response);            
    }
    
    public function getRegion(Request $request)
    {
        $response = new AjaxResponse();
    
        $data['regions'] = Region::where('country_id', $request->country_id)->get();
        $region = Region::where('country_id', $request->country_id)->orderBy('name', 'asc')->first();
        
        if(!empty($region->id)) {
            $data['cities'] = City::where('region_id', $region->id)->get();
        } else {
            $data['cities'] = City::where('region_id', NULL)->get();   
        }

        $html['html1'] = view('frontend.region_dropdown')->with($data)->render();
        $html['html2'] = view('frontend.city_dropdown')->with($data)->render();
        
        $response->setStatusOK();
        $response->setMessage($html);

        return response()->json($response);            
    }    
}
