<?php
require_once "../../config.php";
    $topic_id=$_REQUEST['topic_id'];
    $query = "DELETE FROM topics WHERE topic_id=$topic_id";
    $result = mysqli_query($link,$query) or die ( mysqli_error());
    header('location: index.php');
?>
