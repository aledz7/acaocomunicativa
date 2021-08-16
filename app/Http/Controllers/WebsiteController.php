<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Video;
use App\Models\Boletim;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Configuration;
use PDF;

class WebsiteController extends Controller
{
    //
    public function index()
    {
        $config = Configuration::pluck('value','field');
        if( $config['maintenance'] == 1  && auth()->guest() ) return view('maintenance');


        $news       = \DB::table('news')->orderBy('created_at','desc')->get();
        $videos     = \DB::table('videos')->orderBy('created_at','desc')->get();
        $boletims   = \DB::table('boletims')->orderBy('created_at','desc')->get();
    	
        return view('index',[
            'news'=>$news,
            'videos'=>$videos,
            'boletims'=>$boletims
        ]);
    }

    public function newsCategory($slug = null)
    {

        $news = []; 
        if( $slug == null )
        {
            $news = News::orderBy('date','DESC')->get();
            $category = null;
        }
        else
        {
            $category = Category::where('slug',$slug)->first();
            if( $category != null ) $news = $category->news;
        }

        return view('news',['news'=>$news,'category'=>$category]);
    }

    public function news(News $news, $slug = null)
    {

        $category = Category::where('slug',$slug)->first();
        if( $category != null ) 
        {
            $news = @$category->news;
        }
        else
        {
            $news = News::all();
        }


    	return view('news',['news'=>$news,'category'=>$category]);
    }

    public function videosCategory($slug = null)
    {

        $videos = []; 
        if( $slug == null )
        {
            $videos = Video::orderBy('date','DESC')->get();
            $category = null;
        }
        else
        {
            $category = Category::where('type','video')->where('slug',$slug)->first();
            if( $category != null ) $videos = $category->videos;
        }

        return view('videos',['videos'=>$videos,'category'=>$category]);
    }

    public function videos( $slug = null)
    {

        $category = Category::where('type','video')->where('slug',$slug)->first();
        if( $category != null ) 
        {
            $videos = @$category->videos;
        }
        else
        {
            $videos = Video::all();
        }


        return view('videos',['videos'=>$videos,'category'=>$category]);
    }


    public function boletims()
    {
        $boletims = Boletim::orderBy('date','desc')->get();
    	$last = Boletim::orderBy('created_at','desc')->first();
        return view('boletims',['last'=>$last,'boletims'=>$boletims]);
    }

     public function boletim( Boletim $boletim)
    {
        $boletims = Boletim::orderBy('date','desc')->get();
        return view('boletim',['boletim'=>$boletim,'boletims'=>$boletims]);
    }

    public function register()
    {
        return view('register');
    }

    public function newsletter()
    {
    	return view('newsletter');
    }

    public function registerStore()
    {
        $newsletter = Newsletter::updateOrCreate(
            ['email'=>request('email')],
            request()->all()
        );

        return redirect()->route('newsletter')->with('success',['Pronto!','Cadastro realizado com sucesso']);
    }

    public function aboutUs()
    {
    	return view('about-us');
    }

    public function readingNew(News $news)
    {
    	return view('news',['news'=>$news]);
    }

   

    public function reading($slug)
    {

        $reading = News::where('slug',$slug)->first();

        if( $reading != null )
        {
            $type = 'news';
        }
        else
        {
            $reading = Video::where('slug',$slug)->first();
            $type = 'videos';
        }

        return view('reading',['reading'=>$reading,'type'=>$type]);
    }

    public function newsPrint($slug)
    {
        $news = News::where('slug',$slug)->first();

        $data = ['news'=>$news];

        // return view('print',['news'=>$news]);
        $pdf = PDF::loadView('print', $data);
        return $pdf->stream();
    }
}


























































