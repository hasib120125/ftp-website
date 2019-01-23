<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\File;
use App\Model\Category;
use URL;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::latest()->paginate(15);
        return view('admin.upload.index',compact('files'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function create()
    {
        $category = Category::where('parent_id', 0)->get();
        return view('admin.upload.create',compact('category'));
    }

    public function store(Request $request)
    {
        // Validate the request...
    	// dd($request->all());
        request()->validate([
            'name' => 'required',
            'category_id' => 'required|not_in:0',
            'parent_id' => 'required|not_in:0',
            'thumbnail' => 'required',
            'type' => 'required|not_in:0',
            'file' => 'required',
        ]);
    	$file_slug = str_slug($request->name);
    	$file_name = '';
    	$thumbnail_name = '';
        $category_name = Category::where('id', $request->category_id)->first();
        $parent_name = Category::where('id', $request->parent_id)->first();

    	$thumbnail_file = $request->file('thumbnail');
    	$file = $request->file('file');
    	if ($thumbnail_file){
	        
	        $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
	        $cover_ext = $thumbnail_file->getClientOriginalExtension();

	        // Get Videos Path 
            if($parent_name && $category_name){
                $th_file_path   = public_path().'/uploads/thumbnail/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug);
                $th_name = $file_slug.$random.'.'.$cover_ext;
                $thumbnail_name = 'public/uploads/thumbnail/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug).'/'.$th_name;
            }else{
                $th_file_path   = public_path().'/uploads/thumbnail';
                $th_name = $file_slug.$random.'.'.$cover_ext;
                $thumbnail_name = 'public/uploads/thumbnail/'.$th_name;
            }
    			

			// Create Folder to save video
			$new_folder = @mkdir($th_file_path, 0777);

			// Move Uploaded File
			$move_th   = $thumbnail_file->move($th_file_path, $th_name);
	    }

	    if ($file){
	        
	        $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
	        $file_ext = $file->getClientOriginalExtension();

	        // Get Videos Path 
            if($parent_name && $category_name){
                $th_file_path   = public_path().'/uploads/videos/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug);
                $fi_name = $file_slug.$random.'.'.$file_ext;
                $file_name = 'public/uploads/videos/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug).'/'.$fi_name;
            }else{
                $th_file_path   = public_path().'/uploads/videos';
                $fi_name = $file_slug.$random.'.'.$file_ext;
                $file_name = 'public/uploads/videos/'.$fi_name;
            }

			// Create Folder to save video
			$new_folder = @mkdir($th_file_path, 0777);

			// Move Uploaded File
			$move_vid   = $file->move($th_file_path, $fi_name);
	    }

        $file = new File;

        $file->name = $request->name;
        $file->slug = $file_slug;
        $file->category_id = $request->category_id;
        $file->parent_id = $request->parent_id;
        $file->tags = $request->tags;
        $file->language = $request->language;
        $file->origin = $request->origin;
        $file->type = $request->type;
        $file->thumbnail = $thumbnail_name;
        $file->file = $file_name;

        $file->save();

        return redirect()->route('upload.index')
                        ->with('success','File created successfully');
    }

    public function get_subcategory($id){
        $sub_category = Category::where('parent_id',$id)->get();
        $option = '<option value="0">Select Sub Category</option>';
        if($id == 0){
            return $option;
        }
        if($sub_category){
            if(count($sub_category)>0){
                foreach ($sub_category as $sub_category_value) {
                    $option .= '<option value="'.$sub_category_value->id.'">'.$sub_category_value->name.'</option>';
                }
                return $option;
            }else{
                return $option;
            }
        }else{
            return $option;
        }
    }

    public function show($id)
    {
        $category = File::find($id);
        return view('admin.upload.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $target_file = File::find($id);
        $category = Category::where('parent_id', 0)->get();
        return view('admin.upload.edit',compact('category','target_file'));
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
            'category_id' => 'required|not_in:0',
            'parent_id' => 'required|not_in:0',
            'type' => 'required|not_in:0'
        ]);
        $file_slug = str_slug($request->name);
        $file_name = '';
        $thumbnail_name = '';
        $old_file = File::find($id);
        if($old_file){
            $file_name = $old_file->file;
            $thumbnail_name = $old_file->thumbnail;
        }else{
            return redirect()->route('upload.index')
                        ->with('error','File not found');
        }

        $category_name = Category::where('id', $request->category_id)->first();
        $parent_name = Category::where('id', $request->parent_id)->first();

        $thumbnail_file = $request->file('thumbnail');
        $file = $request->file('file');
        if ($thumbnail_file){
            
            $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
            $cover_ext = $thumbnail_file->getClientOriginalExtension();

            // Get Videos Path 
            if($parent_name && $category_name){
                $th_file_path   = public_path().'/uploads/thumbnail/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug);
                $th_name = $file_slug.$random.'.'.$cover_ext;
                $thumbnail_name = 'public/uploads/thumbnail/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug).'/'.$th_name;
            }else{
                $th_file_path   = public_path().'/uploads/thumbnail';
                $th_name = $file_slug.$random.'.'.$cover_ext;
                $thumbnail_name = 'public/uploads/thumbnail/'.$th_name;
            }

            // Create Folder to save video
            $new_folder = @mkdir($th_file_path, 0777);

            // Move Uploaded File
            $move_th   = $thumbnail_file->move($th_file_path, $th_name);
            @unlink($old_file->thumbnail);
        }

        if ($file){
            
            $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
            $file_ext = $file->getClientOriginalExtension();

            // Get Videos Path 
            if($parent_name && $category_name){
                $th_file_path   = public_path().'/uploads/videos/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug);
                $fi_name = $file_slug.$random.'.'.$file_ext;
                $file_name = 'public/uploads/videos/'.str_slug($parent_name->slug).'/'.str_slug($category_name->slug).'/'.$fi_name;
            }else{
                $th_file_path   = public_path().'/uploads/videos';
                $fi_name = $file_slug.$random.'.'.$file_ext;
                $file_name = 'public/uploads/videos/'.$fi_name;
            }

            // Create Folder to save video
            $new_folder = @mkdir($th_file_path, 0777);

            // Move Uploaded File
            $move_vid   = $file->move($th_file_path, $fi_name);
            @unlink($old_file->file);
        }

        $file = File::find($id);

        $file->name = $request->name;
        $file->slug = $file_slug;
        $file->category_id = $request->category_id;
        $file->parent_id = $request->parent_id;
        $file->tags = $request->tags;
        $file->language = $request->language;
        $file->origin = $request->origin;
        $file->type = $request->type;
        $file->thumbnail = $thumbnail_name;
        $file->file = $file_name;

        $file->save();

        return redirect()->route('upload.index')
                        ->with('success','File updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        if($file){
            @unlink($file->thumbnail);
            @unlink($file->file);
        }
        File::find($id)->delete();
        return redirect()->route('upload.index')
                        ->with('success','Category deleted successfully');
    }
    
}
