<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //protected $fillable = ['product_name',' product_code','category_id','sub_category_id','brand_id','sub_sub_category_id','quantity','product_size','product_color','image','selling_price','discount_price','video_link','main_slider','hot_deal','best_rated','trend','hot_new','buy_one_get_one'];
    protected $guarded = [];

    public function product_images(){
        return $this->hasMany('App\Models\ProductImage');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
