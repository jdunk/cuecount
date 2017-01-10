<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', includeAndReturnOutputFn('index.php'));
Route::get('/home', includeAndReturnOutputFn('home.php'));

function includeAndReturnOutputFn($filename) {
    return function() use ($filename) {
        ob_start();
        include (__DIR__ . '/../public/' . $filename);
        return ob_get_clean();
    };
}