<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request, $decisionPostId)
    {
        $voteValue = $request->input('value');
        $colPosition = $voteValue === 'l' ? 1 : 3;
        $colName = 'post_answer' . $colPosition;

        require base_path('public/db_conn3.php');

        $query = "UPDATE decision_post SET $colName=$colName+1 WHERE id = " . (int)$decisionPostId;
        mysqli_query($conn3, $query);
    }
}
