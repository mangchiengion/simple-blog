<?php
require_once "config.php";
session_start();
$post_id=$_GET['post_id'];
$query = "SELECT * FROM posts WHERE post_id='".$post_id."'";
$result = mysqli_query($link, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--fontawesome.com-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Custom Styling-->
    <link rel="stylesheet" href="assets/css/style.css" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">

    <title>Love Moews - Single Post</title>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <div class="row">
        <div class="leftcolumn">
            <!-- Recent post -->
            <?php
                echo "<div class='post-preview'>";
                echo "<img src='assets/images/$row[image]' style='width:100%'>";
                echo "<div class='post-container'>";
                echo "<h2><b>$row[title]</b></h2>";
                echo "<h6>Created at <span class='gray'>$row[posted]</span></h6>";
                echo "<p>$row[body]</p>";
                echo "</div></div><hr>";
                
            ?>

        </div>

        <!-- Introduction menu -->
        <div class="rightcolumn">
            <!-- About Card -->
            <div class="card">
                <img src="assets/images/a01.jpg" style="width:100%">
                <div class="post-container">
                    <h4><b>About my blog</b></h4>
                    <p>This blog was created in the hope of sharing useful information with the cat lovers community. 
                    <br />Thank you for stopping by here for a moment, hopefully you will soon be a familiar guest of my home. Love all.</p>
                </div>
            </div><hr>

            <!-- Topic -->
            <div class="card">
                <div class="post-container">
                    <h4>Topics</h4>
                </div>
                <ul class="popular-post">
                <?php
                $query = $link->query("SELECT * FROM topics");
                while($row = $query->fetch_object()) {
                    echo "<li><a href='topic.php?topic_id=".$row->topic_id."'><span>".$row->toname."</span></a></li>";
                }
                ?>
                </ul>
            </div>
            <hr>

            <!-- Some pictures -->
            <div class="card">
                <div class="img-tag">
                    <a href="#">
                        <img src="assets/images/q5.jfif" alt="Ghibli" style="width:100%;" />
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="img-tag">
                    <a href="#">
                        <img src="assets/images/q7.jfif" alt="Ghibli" style="width:100%;" />
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="img-tag">
                    <a href="#">
                        <img src="assets/images/q8.jfif" alt="Ghibli" style="width:100%;" />
                    </a>
                </div>
            </div>
        </div>
    </div><br>

    <!-- Footer -->
    <?php include("includes/footer.php"); ?>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script src="assets/js/scripts.js"></script>
</body>
</html>
