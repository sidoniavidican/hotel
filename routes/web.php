<?php
use Illuminate\Support\Facades\Request;
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
Route::get('/', function () {
    return view('welcome');
});
$allowed = array('ro', 'en', 'hu');
$lang = Request::segment(1);
if(in_array($lang, $allowed)) {
    App::setLocale($lang);

    Route::group(['prefix' => $lang], function(){
        Route::get('/', function () {
            return view('welcome');
        });
        
        Auth::routes();
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/about', 'HomeController@index')->name('about');
        Route::resource('translation', 'TranslationController');
    });
} 


