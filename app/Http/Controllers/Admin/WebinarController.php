<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebinarController extends Controller
{
    public function __construct()
    {
        //$this->middleware();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {


        $key = $request->search;
        if($key){
            $ids=User::where('name','like',"%{$key}%")->get('id');
            $webinars=Webinar::where('title','like',"%{$key}%")
                ->orWhereIn('creator_id',$ids)
                ->latest()->paginate(10);
        }
        else{
            $webinars=Webinar::latest()->paginate(10);
        }

        return view('admin.webinars.index',compact('webinars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.webinars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
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
            'confirmed' => 1
        ]);

        Storage::disk('public')->putFileAs('images',$request->file('img'),$image_name);
        Storage::putFileAs('videos',$request->file('video'),$video_name);

        return redirect(route('admin.webinars.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Webinar $webinar)
    {
        return view('admin.webinars.show',compact('webinar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Webinar $webinar)
    {
        return view('admin.webinars.update',compact('webinar'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Webinar $webinar)
    {
        $request->validate([
            'title'=>'required|min:5|max:50',
            'description'=>'required|min:10|max:1000',
            'price'=>'required|numeric|min:0|max:10000000',
        ]);

        $webinar->update($request->all());
        return redirect(route('admin.webinars.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Webinar $webinar)
    {
        $webinar->delete();
        return back();
    }

    public function download($file)
    {
        return Storage::download('/videos/'.$file);
    }
}
