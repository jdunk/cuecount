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
    'signup',
];

foreach ($mainPages as $mainPage) {
    Route::get("/$mainPage", includeAndReturnOutputFn("$mainPage.php"));
}

foreach ($postsAllowed as $page) {
    Route::post("/$page", includeAndReturnOutputFn("$page.php"));
}

Route::post("/decision-posts/{decisionPostId}/vote", 'VoteController@store');
Route::get("/feed/more/{maxDecisionPostId}", 'FeedController@more');
