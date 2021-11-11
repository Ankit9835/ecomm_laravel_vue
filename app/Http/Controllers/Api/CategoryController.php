<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        //$category = Category::all();
        // $category = Category::query()
        //     ->with(array('category' => function($query) {
        //         $query->select('category_name');
        //     }))
        //     ->get();
    //    $category =  Category::with('category')->where('category_name', '!=', 'root')->get();

        $category = Category::latest()->get();

    //    $message = collect(Category::with('category')->get());

    //    $category = $message->unique('category_name');
   
    //    $category->values()->all();
        return response()->json($category);
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
            'category_name' => 'required|unique:categories',
        ]);

        // Category::create([
        //     'category_name' => $request->category_name,
        //     'category_link' => $request->category_link,
        //     'parent_id' => $request->parent_id,
        // ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_link = $request->category_link;
       
        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function fetchData($id){
        $category = Category::findOrFail($id);
        $parent_id = $category->category_id;
       
        return response()->json($parent_id);
      
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
        Category::where('id', $id)->update([
            'category_name' => $request->category_name,
            'category_link' => $request->category_link,
        ]);
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
        Category::where('id', $id)->delete();
    }
}
