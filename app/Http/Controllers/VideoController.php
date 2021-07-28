<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    
    public function index()
    {
    	$videos = Video::all();
    	return view('admin.videos',['videos'=>$videos]);
    }

    public function edit(Video $video)
    {
    	return view('admin.video-edit',['video'=>$video]);
    }

    public function create(Video $video)
    {
        return view('admin.video-create');
    }

    public function store(Video $video)
    {

        $video->user_id      = auth()->user()->id;
        $video->title        = request('title');
        $video->short_text   = substr(request('short_text'),0,100);
        $video->link          = request('link');
        $video->date          = request('date');
        $video->slug          = Str::slug($video->title,'-');
        $video->save();

        if( request('cover') )
        {
            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($video->title, '-');
            $video->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $video->save();
        }

        $video->categories()->sync(request('categories'));

        return redirect()->route('admin.videos');
    }

    public function update(Video $video)
    {

        $video->title        = request('title');
        $video->short_text   = request('short_text');
        $video->slug         = Str::slug($video->title,'-');
        $video->link         = request('link');
        $video->save();

        if( request('cover') )
        {
            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($video->title, '-');
            $video->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $video->save();
        }

        $video->categories()->sync(request('categories'));
        
        return redirect()->route('admin.videos');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos')->with('success',['Pronto','Removido com sucesso'] );
    }
}
