<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
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
       
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required|unique:products',
            'category_id' => 'required',
            'brand_id' => 'required',
            'quantity' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
        ]);

        $product = new Product;
       // dd($product);
        $product->product_name = $request->product_name;
        //dd($product->product_name);
       // dd($product);
        $product->product_code = $request->product_code;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product-> quantity = $request->quantity;
        $product->sub_sub_category_id = $request->sub_sub_category_id;
        $product->product_size = $request->product_size;
        $product->product_color = $request->product_color;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->video_link = $request->video_link;
        $product->main_slider = $request->main_slider;
        $product->hot_deal = $request->hot_deal;
        $product->best_rated = $request->best_rated;
        $product->trend = $request->trend;
        $product->hot_new = $request->hot_new;
        $product->buy_one_get_one = $request->buy_one_get_one;
       
        $product->save();

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
    public function destroy($id)
    {
        //
    }

    public function fetchData($sub_id,$cat_id){
       $subcat =  SubSubCategory::where('sub_category_id', $sub_id)->where('category_id', $cat_id)->get();
       //dd($subcat);
        return json_encode($subcat);
    }
}
