<?php
require_once "../../config.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
}
$record_count = $link->query("SELECT * FROM posts");
$per_page = 7;
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
    <link rel="stylesheet" href="../../assets/css/dashboard.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <title>Dashboard Admin - Manage Posts</title>
</head>

<body>
    <div class="header-top" id="myHeader">
        <div class="header-bar">
            <div class="logo">Love <span class="design-logo"> Meow </span></div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul class="nav">
            <?php if (isset($_SESSION['id'])): ?>
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <?php echo htmlspecialchars($_SESSION["username"]); ?>
                        <i class="fa fa-chevron-down icon-down"></i>
                    </a>
                    <ul class="down-table">
                        <li><a href="../../index.php">View Home Blog</a></li>
                        <li><a href="index.php">Manage Posts</a></li>
                        <li><a href="../topics/index.php">Manage Topics</a></li>
                        <li><a href="../users/index.php">Manage Users</a></li>
                        <li><a href="../../logout.php" class="logout">Logout</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="left-sidebar">
            <ul>
                <li><a href="../../index.php">View Home Blog</a></li>
                <li><a href="index.php">Manage Posts</a></li>
                <li><a href="../topics/index.php">Manage Topics</a></li>
                <li><a href="../users/index.php">Manage Users</a></li>
            </ul>
        </div>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn-big">Add Post</a>
                <a href="index.php" class="btn-big">Manage Posts</a>
            </div>
            <div class="about-content">
                <h2 class="page-tilte">Manage Posts</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Topic</th>
                            <th colspan="2" style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($result))
                    { 
                    echo "<tr>";
                        echo "<td>$row[title]</td>";
                        echo "<td>$row[toname]</td>";
                        echo "<td><a href='edit.php?post_id=$row[post_id]' class='edit'>edit</a></td>";
                        echo "<td><a href='delete.php?post_id=$row[post_id]' class='delete'>delete</a></td>";
                    echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                if($prev > 0) {
                 echo "<a class='pre-link' href='index.php?p=$prev'>« Previous</a>";
                }
                if($page < $pages) {
                    echo "<a class='next-link' href='index.php?p=$next'>Next »</a>";
                }
            ?>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script src="../../assets/js/scripts.js"></script>
</body>
</html>
