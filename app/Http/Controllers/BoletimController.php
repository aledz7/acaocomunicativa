<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boletim;
use Illuminate\Support\Str;

class BoletimController extends Controller
{
    public function index()
    {
        $boletims = Boletim::all();
        return view('admin.boletims',['boletims'=>$boletims]);
    }

    public function create()
    {
        //
        return view('admin.boletim-create');
    }

    public function store(Boletim $boletim)
    {
        //

        $boletim->user_id = auth()->user()->id;
        $boletim->title = request('title');
        $boletim->short_text = request('short_text');
        $boletim->date = request('date');
        $boletim->save();

        if( request('file') )
        {
            $fileExtension = request('file')->getClientOriginalExtension();
            $fileName = Str::slug($boletim->title,'-');
            $boletim->file = request('file')->storeAs('boletim',$fileName.'.'.$fileExtension,'public');
            $boletim->save();
        }
        if( request('cover') )
        {
            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($boletim->title, '-');
            $boletim->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $boletim->save();
        }
        $boletim->file = request('file');

        return redirect()->route('admin.boletims');
    }

    public function edit(Boletim $boletim)
    {
        return view('admin.boletim-edit',['boletim'=>$boletim]);
    }

    public function update(Boletim $boletim)
    {
        //

        $boletim->title = request('title');
        $boletim->short_text = request('short_text');
        $boletim->date = request('date');
        $boletim->save();

        if( request('file') )
        {
            $fileExtension = request('file')->getClientOriginalExtension();
            $fileName = Str::slug($boletim->title,'-');
            $boletim->file = request('file')->storeAs('boletim',$fileName.'.'.$fileExtension,'public');
            $boletim->save();
        }

        if( request('cover') )
        {
            $fileExt = request('cover')->getClientOriginalExtension();
            $fileName = Str::slug($boletim->title, '-');
            $boletim->cover = request('cover')->storeAs('covers',$fileName.'.'.$fileExt,'public');
            $boletim->save();
        }

        $boletim->file = request('file');

        return redirect()->route('admin.boletims');
    }

    public function destroy(Boletim $boletim)
    {
        //
        $boletim->delete();

        return redirect()->route('admin.boletims');

    }
}
