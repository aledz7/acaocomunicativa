<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Health;
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
        $healths   = \DB::table('healths')->orderBy('created_at','desc')->get();
    	
        return view('index',[
            'news'=>$news,
            'videos'=>$videos,
            'healths'=>$healths
        ]);
    }

    public function newsCategory($slug = null)
    {

        $categories = \DB::table('categories')
                        ->selectRaw('categories.name, count(category_id) as total, categories.slug, categories.type')
                        ->join('category_news','categories.id','category_news.category_id')
                        ->where('categories.type','news')
                        ->groupBy('category_id')
                        ->orderBy('name')
                        ->get();

        $news = []; 
        if( $slug == null )
        {
            $news = News::with('categories')->orderBy('date','DESC')->get();
            $category = null;
        }
        else
        {
            $category = Category::where('slug',$slug)->first();
            if( $category != null ) $news = $category->news;
        }

        return view('news',['news'=>$news,'category'=>$category,'categories'=>$categories]);
    }

    public function healthsCategory($slug = null)
    {

        $categories = \DB::table('categories')
                        ->selectRaw('categories.name, count(category_id) as total, categories.slug, categories.type')
                        ->join('category_news','categories.id','category_news.category_id')
                        ->where('categories.type','news')
                        ->groupBy('category_id')
                        ->orderBy('name')
                        ->get();

        $news = []; 
        if( $slug == null )
        {
            $news = Health::with('categories')->orderBy('date','DESC')->get();
            $category = null;
        }
        else
        {
            $category = Category::where('slug',$slug)->first();
            if( $category != null ) $news = $category->news;
        }

        return view('healths',['news'=>$news,'category'=>$category,'categories'=>$categories]);
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
            $news = News::with('categories')->all();
        }


    	return view('news',['news'=>$news,'category'=>$category]);
    }

    public function videosCategory($slug = null)
    {

        $videos = []; 

        if( $slug == null )
        {
            $videos = \DB::table('videos')->orderBy('date','DESC')->get();
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
            $videos = \DB::table('videos')->orderBy('date','DESC')->get();
        }

        return view('videos',['videos'=>$videos,'category'=>$category]);
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

        
        if( request('g-recaptcha-response') )
        {

            $playload = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".config('captcha.secret')."&response=".request('g-recaptcha-response'));

            $result = json_decode($playload);

            if( $result->success == true )
            {
                $newsletter = Newsletter::updateOrCreate(
                    ['email'=>request('email')],
                    request()->all()
                );
            }
            return redirect()->route('newsletter')->with('success',['Pronto!','Cadastro realizado com sucesso']);
        }

        return redirect()->route('newsletter')->with('warning',['Hmmm, algo deu errado!','Verificou se o reCaptcha estava marcado?']);



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
            return view('reading',['reading'=>$reading,'type'=>$type]);
        }


        $reading = Video::where('slug',$slug)->first();
        if( $reading != null )
        {
            $type = 'videos';
            return view('reading',['reading'=>$reading,'type'=>$type]);
        }

        $reading = Health::where('slug',$slug)->first();
        if( $reading != null )
        {
            $type = 'healths';
            return view('reading',['reading'=>$reading,'type'=>$type]);
        }


        return redirect('home');


    }

    public function newsPrint($slug)
    {
        $news = News::where('slug',$slug)->first();
        if( $news == null ) $news = Health::where('slug',$slug)->first();
        if( $news == null ) $news = Video::where('slug',$slug)->first();
        if( $news == null ) abort( 404 );

        $data = ['news'=>$news];

        // return view('print',['news'=>$news]);
        $pdf = PDF::loadView('print', $data);
        return $pdf->stream();
    }
}


























































