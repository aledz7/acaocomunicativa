<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    //
    public function index()
    {
    	$news = News::all();
    	return view('admin.news',['news'=>$news]);
    }

    public function edit($id)
    {

        $new = News::withoutGlobalScope('published')->find($id);

    	return view('admin.news-edit',['new'=>$new]);
    }

    public function create(News $new)
    {
        return view('admin.news-create');
    }

    public function store(News $news)
    {

        request()->validate([
            'title'=>'required',
            'short_text'=>'required',
            'date'=>'required'
        ]);

        $news->user_id      = auth()->user()->id;
        $news->title        = request('title');
        $news->short_text   = request('short_text');
        $news->text         = request('text');
        $news->date         = request('date');
        $news->slug         = Str::slug($news->title, '-');
        $news->save();

        if( request('cover') )
        {
            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($news->title, '-');
            $news->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $news->save();
        }

        $news->categories()->sync(request('categories'));

        return redirect()->route('admin.news');
    }

    public function update(News $new)
    {
        $new->categories()->sync(request('categories'));

        $new->update(request()->except(['_token','categories']),['user_id'=>auth()->user()->id]);

        if( request('cover') )
        {

            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($new->title, '-');
            $new->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $new->save();
        }

        return redirect()->route('admin.news');
    }

    public function destroy(News $new)
    {
        $new->delete();

        return redirect()->route('admin.news')->with('success',['Pronto','Removido com sucesso'] );
    }
}
