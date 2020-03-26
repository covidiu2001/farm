<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * Return the menu for logged or nor logged users
     */
    public function getMenu()
    {
        $data['menu'] = Config::get('menu.notLoggedIn');
        if(Auth::check()) {
            if( Auth::user()->user_role == Config::get('constants.USER_ROLE.ADMIN') ){
                $data['menu'] = array_merge($data['menu'], Config::get('menu.admin'));
            }
        }
        
        $categories = Category::get()->where('status', true);
        foreach($categories as $category) {

            $data['menu']['Categories']['items'][$category->id] = array(
                'text' => $category->name,
                'a_class' => '',
                'href' => '/displayCategory/' . $category->id,
            );
        }

        return $data['menu'];
    }
}
