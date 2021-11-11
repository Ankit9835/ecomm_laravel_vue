<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use DB;
use Image;
use Illuminate\Support\Facades\Validator;
	

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category','product_images')->get();
        return response()->json($products);
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
        


              
        // dd($request->product_name);
      

        //dd($test);
        // $data=$request->all();
        // dd($data['images']);

        
            //dd('test');




            $data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_code'] = $request->product_code;
    	$data['category_id'] = $request->category_id;
    	$data['brand_id'] = $request->brand_id;
    	$data['sub_category_id'] = $request->sub_category_id;
    	$data['product_size'] = $request->product_size;
    	$data['product_color'] = $request->product_color;
    	$data['sub_sub_category_id'] = $request->sub_sub_category_id;
    	$data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['video_link'] = $request->video_link;
       
    	$order_id = DB::table('products')->insertGetId($data);


        $images = $request->image;
       // dd($images);
            //dd($images);

            $odata = array();



           


          foreach($images as $image){
             //dd($image);
            //return $image;
            //dd(count($image));


           // $name=$image->getClientOriginalName();
           $folderPath = "backend/products/";

           $image_parts = explode(";base64,", $image);
           $image_type_aux = explode("/", $image_parts[0]);
           $image_type = $image_type_aux[1];
           $image_base64 = base64_decode($image_parts[1]);
           $file = $folderPath . uniqid() . '. '.$image_type;
   
           file_put_contents($file, $image_base64);

        //    $position = strpos($image, ';');
        //        $sub = substr($image, 0, $position);
            
        //            $ext = explode('/', $sub)[1];
               
        //        $name = time().".".$ext;
        //        $img = Image::make($image)->resize(500,500);
        //        $upload_path = 'backend/products/';
        //        $image_url = $upload_path.$image_base64;
        //        $img->save($image_url);
         
            $odata['image'] = $file;
         $odata['product_id'] = $order_id;
         DB::table('product_images')->insert($odata); 

        //     $image = str_replace('data:image/png;base64,', '', $image);
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = str_random(10).'.'.'png';

        //     $position = strpos($image, ';');
        //     $sub = substr($image, 0, $position);
         
        //         $ext = explode('/', $sub)[1];
            
        //     $name = time().".".$ext;
        //     $img = Image::make($image)->resize(500,500);
        //     $upload_path = 'backend/products/';
        //     $image_url = $upload_path.$name;
        //     $img->save($image_url);
           
        //     $odata['image'] = $image_url;
        // $odata['product_id'] = $order_id;
        // DB::table('product_images')->insert($odata); 
            
        }

        
        


        //return response('Done');

        //   $product =   Product::create([

                
        //         'product_name' => $request->product_name,
        //         'product_code' => $request->product_code,
        //         'category_id'=> $request->category_id,
        //         'sub_category_id' => $request->sub_category_id,
        //         'brand_id' => $request->brand_id,
                
        //         'quantity' => $request->quantity,
                
        //         'sub_sub_category_id' => $request->sub_sub_category_id,
        //         'product_size' => $request->product_size,
        //         'product_color' => $request->product_color,
               
        //         'selling_price' => $request->selling_price,
        //         'discount_price' => $request->discount_price,
        //         'video_link' => $request->video_link,
        //         'main_slider' => $request->main_slider,
        //         'hot_deal' => $request->hot_deal,
        //         'best_rated' => $request->best_rated,
        //         'trend' => $request->trend,
        //         'hot_new' => $request->hot_new,
        //         'buy_one_get_one' => $request->buy_one_get_one,

        //     ]);
          
            //    $images = $request->images;
            //    dd($images);
         
          
         // $images = array();
         
          
           
       


        
       
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
}
