<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $categories = Category::all();
     $parent_categories = Category::where('parent_id',null)->get();
     return view('backend.pages.categories.index',compact('categories','parent_categories'));
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
        'name' => 'required',
        'slug' => 'nullable',
        
        'description' => 'nullable',
    ]);
      $category = new Category();
      $category->name = $request->name;
     
      if(empty($request->slug)){
         $category->slug = Str::slug($request->name);
      }
      else{
         $category->slug = $request->slug;
      }
     $category->parent_id = $request->parent_id ;
      $category->description = $request->description ;
      $category->save();
      session()->flash('success','Category has been created !!');
      return  back();
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
       $request->validate([
        'name' => 'required',
        'slug' => 'nullable',
        
        'description' => 'nullable',
    ]);
      $category = Category::find($id);
      $category->name = $request->name;
     
      if(empty($request->slug)){
         $category->slug = Str::slug($request->name);
      }
      else{
         $category->slug = $request->slug;
      }
     $category->parent_id = $request->parent_id ;
      $category->description = $request->description ;
      $category->save();
      session()->flash('success','Category has been Updated !!');
      return  back();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $child_categories = Category::where('parent_id',$id)->get();
        
        foreach ($child_categories as $child) {
            $child->delete();
        }
        $category =Category::find($id);

        $category->delete();
        session()->flash('success','Category has been deleted !!');
        return  back();
    }
}
