<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $webinars = $request->user()->webinars()->paginate(10);
        return view('webinars.index',compact('webinars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('webinars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:5|max:50',
            'description'=>'required|min:10|max:1000',
            'price'=>'required|numeric|min:0|max:10000000',
            'img'=>'required|mimes:jpg,png',
            'video'=>'required|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4'
        ]);

        $image_name=Str::uuid().'.'.$request->file('img')->getClientOriginalExtension();
        $video_name=Str::uuid().'.'.$request->file('video')->getClientOriginalExtension();

        $request->user()->webinars()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'img'=>$image_name,
            'video'=> $video_name,
        ]);

        Storage::disk('public')->putFileAs('images',$request->file('img'),$image_name);
        Storage::putFileAs('videos',$request->file('video'),$video_name);

        return redirect(route('webinars.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function show(Webinar $webinar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function edit(Webinar $webinar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Webinar $webinar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Webinar $webinar)
    {
        //
    }
}
