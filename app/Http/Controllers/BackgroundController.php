<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Background;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $background = Background::latest()->paginate(5);
        return view('admin.background.index',compact('background'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.background.create');
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
            'image' => 'required|image',
        ]);

        $image_name = '';
        $image_file = $request->file('image');

        if ($image_file){
            
            $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
            $cover_ext = $image_file->getClientOriginalExtension();

            // Get Videos Path 
            $th_file_path   = public_path().'/uploads/background/image';
            $th_name = 'background-image'.'-'.$random.'.'.$cover_ext;
            $image_name = 'public/uploads/background/image/'.$th_name;

            // Create Folder to save video
            $new_folder = @mkdir($th_file_path, 0777);

            // Move Uploaded File
            $move_th   = $image_file->move($th_file_path, $th_name);
        }
        
        $background = new Background;
        $background->image = $image_name;
        $background->sort = $request->sort;

        $background->save();

        return redirect()->route('background.index')
                        ->with('success','File created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $background = Background::find($id);
        return view('admin.background.show',compact('background'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $target_background = Background::find($id);
        return view('admin.background.edit',compact('target_background'));
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
            'image' => 'image',
        ]);

        $image_name = '';
        $old_file = Background::find($id);
        if($old_file){
            $image_name = $old_file->image;
        }else{
            return redirect()->route('background.index')
                        ->with('error','File not found');
        }

        $image_file = $request->file('image');
        if ($image_file){
            
            $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
            $cover_ext = $image_file->getClientOriginalExtension();

            // Get Videos Path 
            $th_file_path   = public_path().'/uploads/background/image';
            $th_name = 'background-image'.'-'.$random.'.'.$cover_ext;
            $image_name = 'public/uploads/background/image/'.$th_name;

            // Create Folder to save video
            $new_folder = @mkdir($th_file_path, 0777);

            // Move Uploaded File
            $move_th = $image_file->move($th_file_path, $th_name);
            @unlink($old_file->image);
        }

        $background = Background::find($id);
        $background->image = $image_name;
        $background->sort = $request->sort;

        $background->save();
        
        return redirect()->route('background.index')
                        ->with('success','Background updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = Background::find($id);
        if($file){
            @unlink($file->image);
        }
        Background::find($id)->delete();
        return redirect()->route('background.index')
                        ->with('success','Background deleted successfully');
    }
}
