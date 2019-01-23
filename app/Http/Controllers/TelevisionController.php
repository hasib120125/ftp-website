<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Channel;

class TelevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channel = Channel::latest()->paginate(15);
        return view('admin.channel.index',compact('channel'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.channel.create');
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
            'thumbnail' => 'required|image',
            'url' => 'required',
        ]);

        $thumbnail_name = '';
        $thumbnail_file = $request->file('thumbnail');

        if ($thumbnail_file){
            
            $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
            $cover_ext = $thumbnail_file->getClientOriginalExtension();

            // Get Videos Path 
            $th_file_path   = public_path().'/uploads/tv/thumbnail';
            $th_name = str_slug($request->name).'-'.$random.'.'.$cover_ext;
            $thumbnail_name = 'public/uploads/tv/thumbnail/'.$th_name;

            // Create Folder to save video
            $new_folder = @mkdir($th_file_path, 0777);

            // Move Uploaded File
            $move_th   = $thumbnail_file->move($th_file_path, $th_name);
        }
        
        $channel = new Channel;

        $channel->name = $request->name;
        $channel->thumbnail = $thumbnail_name;
        $channel->url = $request->url;
        $channel->sort = $request->sort;

        $channel->save();

        return redirect()->route('tv.index')
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
        $channel = Channel::find($id);
        return view('admin.channel.show',compact('channel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $target_channel = Channel::find($id);
        return view('admin.channel.edit',compact('target_channel'));
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
            'url' => 'required',
        ]);

        $thumbnail_name = '';
        $old_file = Channel::find($id);
        if($old_file){
            $thumbnail_name = $old_file->thumbnail;
        }else{
            return redirect()->route('tv.index')
                        ->with('error','File not found');
        }

        $thumbnail_file = $request->file('thumbnail');
        if ($thumbnail_file){
            
            $random = substr(strtoupper(md5(uniqid().rand().microtime())), 0, 10);
            $cover_ext = $thumbnail_file->getClientOriginalExtension();

            // Get Videos Path 
            $th_file_path   = public_path().'/uploads/tv/thumbnail';
            $th_name = str_slug($request->name).'-'.$random.'.'.$cover_ext;
            $thumbnail_name = 'public/uploads/tv/thumbnail/'.$th_name;

            // Create Folder to save video
            $new_folder = @mkdir($th_file_path, 0777);

            // Move Uploaded File
            $move_th = $thumbnail_file->move($th_file_path, $th_name);
            @unlink($old_file->thumbnail);
        }

        $channel = Channel::find($id);
        $channel->name = $request->name;
        $channel->thumbnail = $thumbnail_name;
        $channel->url = $request->url;
        $channel->sort = $request->sort;

        $channel->save();
        
        return redirect()->route('tv.index')
                        ->with('success','Channel updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = Channel::find($id);
        if($file){
            @unlink($file->thumbnail);
        }
        Channel::find($id)->delete();
        return redirect()->route('tv.index')
                        ->with('success','Channel deleted successfully');
    }
}
