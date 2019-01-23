<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Channel;
use App\Model\Background;
use App\Model\File;

class HomeController extends Controller
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
        $background = Background::count();
        $category = Category::count();
        $file = File::count();
        $channel = Channel::count();
        return view('admin.home',compact('background','category','file','channel'));
    }
    
}
