<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


Route::get('send-news/{id}',function($id){
    $news = App\Models\News::find($id);
    return new App\Mail\SendNews($news);
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('sitemap',function(){

    $sitemap = Sitemap::create('https://acaocomunicativa.com.br');

    foreach( \App\Models\News::get() as $new )
    {
        $sitemap->add(Url::create($new->slug)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1));
        $sitemap->add(Url::create('print-'.$new->slug)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1));


    }
    foreach( \App\Models\Video::get() as $new )
    {
        $sitemap->add(Url::create($new->slug)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1));

    }

    foreach( \App\Models\Category::where('type','news')->get() as $new )
    {
        $sitemap->add(Url::create('noticias-'.$new->slug)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1));

    }

    foreach( \App\Models\Category::where('type','video')->get() as $new )
    {
        $sitemap->add(Url::create('videos-'.$new->slug)
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1));

    }

    $sitemap->writeToFile('sitemap.xml');
});

Route::get('/',[App\Http\Controllers\WebsiteController::class,'index'])->name('home');
Route::get('/noticias',[App\Http\Controllers\WebsiteController::class,'newsCategory'])->name('noticias');
Route::get('/saude',[App\Http\Controllers\WebsiteController::class,'healthsCategory'])->name('saude');
Route::get('/videos',[App\Http\Controllers\WebsiteController::class,'videos'])->name('videos');
Route::get('/boletim-ac-saude',[App\Http\Controllers\WebsiteController::class,'boletims'])->name('boletims');
Route::get('/cadastre-se',[App\Http\Controllers\WebsiteController::class,'register'])->name('cadastre');
Route::post('/cadastre-se/salvar',[App\Http\Controllers\WebsiteController::class,'registerStore'])->name('cadastre.store');
Route::get('/quem-somos',[App\Http\Controllers\WebsiteController::class,'aboutUs'])->name('quemSomos');
Route::get('/newsletter',[App\Http\Controllers\WebsiteController::class,'newsletter'])->name('newsletter');
Route::get('/register',[App\Http\Controllers\WebsiteController::class,'register'])->name('register');

Route::get('/boletim-ac-saude-{boletim}',[App\Http\Controllers\WebsiteController::class,'boletim'])->middleware(['registered'])->name('boletim');

Route::redirect('/admin','/login');

Route::middleware(['auth:sanctum', 'verified'])->name('admin.')->prefix('admin/')->group(function(){


    Route::middleware(['admin'])->group(function(){
    	Route::get('/dashboard', function () {
        	return view('dashboard');
    	})->name('dashboard');

        // Call
        Route::get('call/',[App\Http\Controllers\CallController::class,'index'])->name('call');

    	// News 
        Route::get('healths/',[App\Http\Controllers\HealthController::class,'index'])->name('healths');
        Route::get('healths/create',[App\Http\Controllers\HealthController::class,'create'])->name('healths.create');
        Route::get('healths/edit/{health}',[App\Http\Controllers\HealthController::class,'edit'])->name('healths.edit');

        Route::get('news/',[App\Http\Controllers\NewsController::class,'index'])->name('news');
        Route::get('news/edit/{new}',[App\Http\Controllers\NewsController::class,'edit'])->name('news.edit');
        Route::get('news/create/',[App\Http\Controllers\NewsController::class,'create'])->name('news.create');
        Route::post('news/store',[App\Http\Controllers\NewsController::class,'store'])->name('news.store');
        Route::post('news/update/{new}',[App\Http\Controllers\NewsController::class,'update'])->name('news.update');
        Route::post('news/delete/{new}',[App\Http\Controllers\NewsController::class,'destroy'])->name('news.delete');

        // Videos
        Route::get('videos/',[App\Http\Controllers\VideoController::class,'index'])->name('videos');
        Route::get('videos/edit/{video}',[App\Http\Controllers\VideoController::class,'edit'])->name('videos.edit');
        Route::get('videos/create/',[App\Http\Controllers\VideoController::class,'create'])->name('videos.create');
        Route::post('videos/store',[App\Http\Controllers\VideoController::class,'store'])->name('videos.store');
        Route::post('videos/update/{video}',[App\Http\Controllers\VideoController::class,'update'])->name('videos.update');
        Route::post('videos/delete/{video}',[App\Http\Controllers\VideoController::class,'destroy'])->name('videos.delete');


        // Videos
        Route::get('boletims/',[App\Http\Controllers\BoletimController::class,'index'])->name('boletims');
        Route::get('boletims/edit/{boletim}',[App\Http\Controllers\BoletimController::class,'edit'])->name('boletims.edit');
        Route::get('boletims/create/',[App\Http\Controllers\BoletimController::class,'create'])->name('boletims.create');
        Route::post('boletims/store',[App\Http\Controllers\BoletimController::class,'store'])->name('boletims.store');
        Route::post('boletims/update/{boletim}',[App\Http\Controllers\BoletimController::class,'update'])->name('boletims.update');
        Route::post('boletims/delete/{boletim}',[App\Http\Controllers\BoletimController::class,'destroy'])->name('boletims.delete');

        // Reports
        Route::get('reports/',[App\Http\Controllers\ReportController::class,'index'])->name('reports');

        // Newsletter
        Route::get('newsletter/',[App\Http\Controllers\NewsletterController::class,'index'])->name('newsletter');

        // Newsletter
        Route::get('registereds/',[App\Http\Controllers\RegisteredController::class,'index'])->name('registereds');

        // Users
        Route::get('users',[App\Http\Controllers\UserController::class,'index'])->name('users');
    });



});

Route::get('/#saude-{slug?}',[App\Http\Controllers\WebsiteController::class,'healthsCategory'])->name('healths.category');
Route::get('/noticias-{slug?}',[App\Http\Controllers\WebsiteController::class,'newsCategory'])->name('news.category');
Route::get('/print-{slug?}',[App\Http\Controllers\WebsiteController::class,'newsPrint'])->name('news.print');
Route::get('/videos-{slug?}',[App\Http\Controllers\WebsiteController::class,'videosCategory'])->name('videos.category');
Route::get('/noticias/{slug}',[App\Http\Controllers\WebsiteController::class,'reading'])->name('reading');
Route::get('/case',[App\Http\Controllers\WebsiteController::class,'reports'])->name('reports');
Route::get('/informe/{slug}',[App\Http\Controllers\WebsiteController::class,'reportRead'])->name('report');
Route::get('/{slug}',[App\Http\Controllers\WebsiteController::class,'reading'])->name('reading');


