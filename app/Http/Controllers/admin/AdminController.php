<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    
    public function index()
    {
        $data = array(
            'title' => 'test',
            'subview' => 'dashboard',
            'menuSelected' => 'dashboard',
        );
        return view('backend.main')->with($data);
    }
}
