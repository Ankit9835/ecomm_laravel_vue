<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\SubCategory;
use Image;
use DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::latest()->get();
        return response()->json($brand);
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
            'name' => 'required|unique:brands'
        ]);
       // dd($request->file('image'));
       



        $image = $request->image;
        //dd($image);

        if ($request->image) {
         $position = strpos($request->image, ';');
         $sub = substr($request->image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->image)->resize(240,200);
         $upload_path = 'backend/brand/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         $brand = new Brand;
         $brand->name = $request->name;
         $brand->image = $image_url;
         $brand->save(); 
     } else{
            $brand = new Brand;
            $brand->name = $request->name;
    		$brand->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
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
        $data = array();
        $data['name'] = $request->name;
        $image = $request->newimage;

        if ($image) {
         $position = strpos($image, ';');
         $sub = substr($image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/brand/';
         $image_url = $upload_path.$name;
         $success = $img->save($image_url);
         
         if ($success) {
            $data['image'] = $image_url;
            $img = DB::table('brands')->where('id',$id)->first();
            $image_path = $img->image;
           // $done = unlink($image_path);
            $user  = DB::table('brands')->where('id',$id)->update($data);
         }
          
        }else{
            $oldphoto = $request->image;
            $data['image'] = $oldphoto;
            $user = DB::table('brands')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $image = $brand->image;
        if($image){
            unlink($image);
            Brand::where('id',$id)->delete();
        }
        Brand::where('id',$id)->delete();
    }

   
}
