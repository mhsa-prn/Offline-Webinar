<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $webinars = auth()->user()->webinarsMember;
        return view('home',compact('webinars'));
    }

    public function firstPage()
    {
        $key= request()->search;
        if($key){

            $webinars = Webinar::where('confirmed',1)
                ->where(function ($query) use ($key){
                    $query->where('title','like',"%{$key}%");
                })->latest()->paginate(10);
        }
        else{
            $webinars= Webinar::where('confirmed',1)->latest()->paginate(10);
        }

        return view('welcome',compact('webinars'));
    }
}
