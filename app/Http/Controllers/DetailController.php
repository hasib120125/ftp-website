<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\File;
use App\Model\Category;
use Illuminate\Support\Facades\Input;

class DetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function movie_details($id)
    {
        $file = File::where('id',$id)->first();
        if(!$file){
            return redirect('/');
        }
        File::find($file->id)->update(['total_view'=>$file->total_view+1]);
        return view('movie',compact('file'));
    }

    public function category($id){
        $category = Category::where('parent_id',$id)->get();
        if(!$category){
            return redirect('/');
        }
        return view('category',compact('category'));
    }

    public function category_details($id){
        $category = Category::where('id',$id)->first();
        if($category){
            $category_files = File::where('category_id',$id)->orderBy('name','asc')->paginate(30);
            $category_slide = File::where('category_id',$id)->latest()->take(5)->get();
            return view('category_details',compact('category_files','category','category_slide'));
        }else{
            return redirect('/');
        }
    }

    public function tv(){
        return view('tv');
    }

    public function search(Request $request){
        $key = $request->key;
        $current_page = 1;
        $category = Category::with('getParent')->where('name','LIKE','%'.$key.'%')->get();
        $files = File::with(['category','parent'])->where('name','LIKE','%'.$key.'%')->paginate(30);
        $current_page = $files->currentPage();
        if($current_page>1){
            $category = [];
        }
        $files->appends(Input::except('page'));
        // dd($files);
        return view('search',compact('key','category','files'))->with('i', (request()->input('page', 1) - 1) * 30);
    }
}
