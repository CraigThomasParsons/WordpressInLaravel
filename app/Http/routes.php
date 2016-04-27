<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', array(
//     'as' => 'home',
//     'uses' => 'HomeController@getIndex',
// ));


Route::get('/construct', function () {
    return View::make('hello');
});

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@getIndex',
));

Route::get('/home', array(
    'as' => 'home',
    'uses' => 'HomeController@getIndex',
));

Route::get('/about', array(
    'as' => 'about',
    'uses' => 'AboutController@getIndex',
));

Route::get('/contact', array(
    'as' => 'contact',
    'uses' => 'ContactController@getIndex',
));

Route::get('/portfolio', array(
    'as' => 'portfolio',
    'uses' => 'PortfolioController@getAllGalleries',
));

Route::get('/portfolio/{gallery}', array(
    'as' => 'portfolio-gallery',
    'uses' => 'PortfolioController@getIndex',
));

Route::get('/testimonials', array(
    'as' => 'testimonials',
    'uses' => 'TestimonialsController@getIndex',
));

Route::post('/contact/send', array(
    'as' => 'contact.email',
    'uses' => 'MailController@sendContactEmail',
));
