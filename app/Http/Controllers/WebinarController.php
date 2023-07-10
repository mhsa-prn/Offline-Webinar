<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
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
        $wallet=$request->user()->wallet;
        return view('webinars.index', compact('webinars','wallet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories=Category::all();
        return view('webinars.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:50',
            'description' => 'required|min:10|max:1000',
            'price' => 'required|numeric|min:0|max:10000000',
            'img' => 'required|mimes:jpg,png',
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            'category_id'=>'required|exists:categories,id'
        ]);

        $image_name = Str::uuid() . '.' . $request->file('img')->getClientOriginalExtension();
        $video_name = Str::uuid() . '.' . $request->file('video')->getClientOriginalExtension();

        if($request->price == 0){
            $confirmed=1;
        }
        else{
            $confirmed=0;
        }

        $request->user()->webinars()->create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'img' => $image_name,
            'video' => $video_name,
            'category_id' => $request->category_id,
            'confirmed'=>$confirmed
        ]);

        Storage::disk('public')->putFileAs('images', $request->file('img'), $image_name);
        Storage::putFileAs('videos', $request->file('video'), $video_name);

        return redirect(route('webinars.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Webinar $webinar
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Webinar $webinar)
    {
        return view('webinars.show', compact('webinar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Webinar $webinar
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Webinar $webinar)
    {
        return view('webinars.update',compact('webinar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Webinar $webinar
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Webinar $webinar)
    {

        $request->validate([
            'title'=>'required|min:5|max:50',
            'description'=>'required|min:10|max:1000',
            'category_id' => 'required'
        ]);

        $new_webinar=Webinar::find($webinar->id);

        $new_webinar->title = $request->title;
        $new_webinar->description = $request->description;
        $new_webinar->category_id = $request->category_id;
        $new_webinar->save();

        return redirect(route('webinars.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Webinar $webinar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Webinar $webinar)
    {
        $webinar->delete();
        return back();
    }

    public function download(Request $request)
    {
        if ($request->user == auth()->id()) {
            return Storage::download($request->path);
        }
    }

    public function freeRegister(Webinar $webinar, Request $request)
    {
        $webinar->members()->sync($request->user()->id);
        return back();
    }
}
