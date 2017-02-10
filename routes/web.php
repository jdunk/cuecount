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

Route::post('/', includeAndReturnOutputFn('index.php'));

$mainPages = [
    'about',
    'feed',
    'fpass',
    'home',
    'logout',
    'signup',
    'verify',
    'voting',
];

$postsAllowed = [
    'home',
];

foreach ($mainPages as $mainPage) {
    Route::get("/$mainPage", includeAndReturnOutputFn("$mainPage.php"));
}

foreach ($postsAllowed as $page) {
    Route::post("/$page", includeAndReturnOutputFn("$page.php"));
}

Route::post("/decision-posts/{decisionPostId}/vote", 'VoteController@store');
Route::get("/feed/more/{maxDecisionPostId}", 'FeedController@more');

function includeAndReturnOutputFn($filename) {
    return function() use ($filename) {
        ob_start();
        $ret = include (__DIR__ . '/../public/' . $filename);
        $output = ob_get_clean();

        if ($ret !== 1) {
            return $ret;
        }

        return $output;
    };
}