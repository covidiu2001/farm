<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class Product extends Model
{
    protected $table = 'products';
    
    static function getAllProductsWithCategoriesName() 
    {
        return DB::table('products')
            ->selectRaw('products.*, categories.name as category_name, product_images.image as image')
            ->join('categories','products.category_id','=','categories.id')
            ->leftJoin('product_images','products.id','=','product_images.product_id')
            ->groupBy('products.id')
            ->orderBy('products.id', 'asc')
            //->get()        
            //->all();
            //->toArray();
            ->paginate(Config::get('constants.BACK_PAGE_PAGINATION'));
    }
    
    static function getFrontPageProducts()
    {
        return DB::table('products')
            ->selectRaw('products.*, categories.name as category_name, SUM(stocs.in) as intrari, SUM(stocs.out) as iesiri, product_images.image as image')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->leftJoin('stocs','products.id','=','stocs.product_id')
            ->join('product_images','products.id','=','product_images.product_id')
            ->where('categories.status',1)
            ->orderBy('products.id', 'asc')
            ->groupBy('products.id')
            ->get();     
            //->all();
    }
  
}
