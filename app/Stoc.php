<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stoc extends Model
{
    protected $table = 'stocs'; 
    
    static function getProductData($id) 
    {
        return DB::table('stocs as s')
            ->selectRaw('s.product_id, SUM(s.in) as intrari, SUM(s.out) as iesiri')
            ->where('product_id', $id)
            ->get()
            ->toArray();
    }
}
