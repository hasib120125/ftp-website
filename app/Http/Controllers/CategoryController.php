<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->paginate(15);
        return view('admin.category.index',compact('category'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('parent_id', 0)->get();
        return view('admin.category.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);
        
        $insert_data = [
          "name" => $request->name,
          "slug" => (trim($request->slug) == '')?(str_slug($request->name)):(str_slug($request->slug)),
          "type" => $request->type,
          "icon" => $request->icon,
          "parent_id" => $request->parent_id,
          "sort" => $request->sort,
        ];

        Category::create($insert_data);
        return redirect()->route('category.index')
                        ->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $target_category = Category::find($id);
        $category = Category::where('parent_id', 0)->get();
        return view('admin.category.edit',compact('category','target_category'));
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
        request()->validate([
            'name' => 'required',
        ]);

        $update_data = [
          "name" => $request->name,
          "slug" => (trim($request->slug) == '')?(str_slug($request->name)):(str_slug($request->slug)),
          "type" => $request->type,
          "icon" => $request->icon,
          "parent_id" => $request->parent_id,
          "sort" => $request->sort,
        ];

        Category::find($id)->update($update_data);
        return redirect()->route('category.index')
                        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('category.index')
                        ->with('success','Category deleted successfully');
    }
}
