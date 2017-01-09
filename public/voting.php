<?php

if(isset($_POST['post_answer1']) && isset($_POST['input_id'])){
    mysqli_query($conn3,"UPDATE decision_post set post_answer1=post_answer1+1 WHERE id = '".$_POST['input_id']."' ");
}
if(isset($_POST['post_answer2']) && isset($_POST['input_id'])){
    mysqli_query($conn3,"UPDATE decision_post set post_answer2=post_answer2+1 WHERE id = '".$_POST['input_id']."' ");
}
if(isset($_POST['post_answer3']) && isset($_POST['input_id'])){
    mysqli_query($conn3,"UPDATE decision_post set post_answer3=post_answer3+1 WHERE id = '".$_POST['input_id']."' ");
}
