<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Health;
use Illuminate\Support\Str;

class HealthController extends Controller
{
    //
    public function index()
    {
        $health = Health::all();
        return view('admin.healths',['healths'=>$health]);
    }

    public function edit($id)
    {
        $health = Health::withoutGlobalScope('published')->find($id);
        return view('admin.healths-edit',['health'=>$health]);
    }

    public function create(Health $health)
    {
        return view('admin.healths-create');
    }

    public function store(Health $health)
    {

        request()->validate([
            'title'=>'required',
            'short_text'=>'required',
            'date'=>'required'
        ]);

        $health->user_id      = auth()->user()->id;
        $health->title        = request('title');
        $health->short_text   = request('short_text');
        $health->text         = request('text');
        $health->date         = request('date');
        $health->slug         = Str::slug($health->title, '-');
        $health->save();

        if( request('cover') )
        {
            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($health->title, '-');
            $health->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $health->save();
        }

        $health->categories()->sync(request('categories'));

        return redirect()->route('admin.healths');
    }

    public function update(Health $health)
    {
        $health->categories()->sync(request('categories'));

        $health->update(request()->except(['_token','categories']),['user_id'=>auth()->user()->id]);

        if( request('cover') )
        {

            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($health->title, '-');
            $health->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $health->save();
        }

        return redirect()->route('admin.healths');
    }

    public function destroy(Health $health)
    {
        $health->delete();

        return redirect()->route('admin.healths')->with('success',['Pronto','Removido com sucesso'] );
    }
}