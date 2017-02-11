<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function more($maxDecisionPostId)
    {
        $dPosts = get_decision_posts($maxDecisionPostId);

        if (!$dPosts) {
            return;
        }

        return view('decision-posts', ['dPosts' => $dPosts]);
    }
}
