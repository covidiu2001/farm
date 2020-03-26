<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Redirect;


class BaseController extends Controller
{
    protected $user;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            if($this->user == NULL) {
                return Redirect::to('/')->send();
            } else {
                if ($this->user->user_role != Config::get('constants.USER_ROLE.ADMIN')) {
                    return Redirect::to('/')->send();
                } else {
                    return $next($request);
                }
            }
        });
    }
}
