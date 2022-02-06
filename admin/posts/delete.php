<?php
require_once "../../config.php";
    $post_id=$_REQUEST['post_id'];
    $query = "DELETE FROM posts WHERE post_id=$post_id";
    $result = mysqli_query($link,$query) or die ( mysqli_error());
    header('location: index.php');
?>