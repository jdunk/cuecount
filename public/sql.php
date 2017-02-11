<?php

function get_decision_posts($max_id = null, $selected_post_id = null, $userId = null)
{
    require 'db_conn3.php';

    if (!$userId && $max_id === null) {
        $max_id = get_max_decision_posts_id();
    }

    $dPosts = [];

    if ($selected_post_id) {
        $query = "SELECT * FROM decision_post WHERE id = $selected_post_id";
        $result = mysqli_query($conn3, $query);

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            $dPosts[$row['id']] = $row;
        }
    }

    $where = '';
    $limit = '';
    $join = '';

    if ($userId) {
        $join = 'JOIN users u on dp.post_email = u.userEmail';
        $where = 'WHERE u.userID = ' . $userId;
    }
    else {
        $where = "WHERE id <= $max_id AND post_endpost=''";
        $limit = "LIMIT 5";
    }

    $query = "SELECT dp.* FROM decision_post dp $join $where ORDER BY dp.id DESC $limit";

    $result = mysqli_query($conn3, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $dPosts[$row['id']] = $row;
    }

    // $dPosts elements are all loaded. Now add extra info to each.

    $prev_id = null;

    foreach ($dPosts as $id => &$dPost) {
        if (!$userId) {
            $dPost['has_voted_already'] = isset($_COOKIE['dp' . $id]);
        }

        $dPost['total_votes'] = $dPost['post_answer1'] + $dPost['post_answer3'];
        $dPost['vote_1_percent'] = $dPost['post_answer1'] * 100 / $dPost['total_votes'];
        $dPost['vote_3_percent'] = $dPost['post_answer3'] * 100 / $dPost['total_votes'];

        if ($prev_id) {
            $dPosts[$prev_id]['next_id'] = $id;
        }
    }

    return $dPosts;
}

function get_max_decision_posts_id()
{
    require 'db_conn3.php';
    $result = mysqli_query($conn3, 'SELECT MAX(id) FROM decision_post');

    return mysqli_fetch_row($result)[0];
}

