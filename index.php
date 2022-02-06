<?php
require_once "config.php";
session_start();
$record_count = $link->query("SELECT * FROM posts");
$per_page = 5;
$pages = ceil($record_count->num_rows/$per_page);
if(isset($_GET['p']) && is_numeric($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 1;
}
if($page<=0) {
    $start = 0;
} else {
    $start = $page * $per_page - $per_page;
}
$prev = $page - 1;
$next = $page + 1;

$result = mysqli_query($link,"SELECT posts.*, topics.toname FROM posts INNER JOIN topics ON posts.topic_id=topics.topic_id order by post_id desc limit $start, $per_page");
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

    <title>Love Moews - Home</title>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <div class="row">
        <div class="leftcolumn">
            <!-- Recent post -->
            <?php
                while ($row = mysqli_fetch_array($result)) {
            
                    echo "<div class='post-preview'>";
                        echo "<img src='assets/images/$row[image]' style='width:100%'>";
                        echo "<div class='post-container'>";
                        echo "<a href='single.php?post_id=$row[post_id]'><h2><b>$row[title]</b></h2></a>";
                        echo "<h6><a href='topic.php?topic_id=".$row['topic_id']."'>$row[toname]</a>, <span class='gray'>$row[posted]</span></h6>";
                        echo "<p>$row[descript]</p>";
                    echo "</div>";
                    echo "<div class='post-container'>";
                        echo "<p><a href='single.php?post_id=$row[post_id]' class='button-readmore'><b>READ MORE »</b></a></p>";
                    echo "</div></div><hr>";
                }
            ?>  
            <?php
             if($prev > 0) {
                 echo "<a class='pre-button' href='index.php?p=$prev'>« Previous</a>";
             }
             if($page < $pages) {
                echo "<a class='next-button' href='index.php?p=$next'>Next »</a>";
             }
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
