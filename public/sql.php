<?php

function get_up_to_5_decision_posts($max_id = null, $selected_post_id = null)
{
    require 'db_conn3.php';

    if ($max_id === null) {
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

    $query = "SELECT * FROM decision_post WHERE id <= $max_id AND post_endpost='' ORDER BY id DESC LIMIT 5";
    $result = mysqli_query($conn3, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $dPosts[$row['id']] = $row;
    }

    // $dPosts elements are all loaded. Now add extra info to each.

    $prev_id = null;

    foreach ($dPosts as $id => &$dPost) {
        $dPost['has_voted_already'] = isset($_COOKIE['dp' . $id]);
        $dPost['total_votes'] = $dPost['post_answer1'] + $dPost['post_answer3'];

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

