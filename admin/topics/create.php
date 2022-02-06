<?php
session_start();
require_once "../../config.php";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
}
$toname = "";
$description = "";
$topic_id = 0;
$update = false;
$err = "";

if (isset($_POST['submit'])) {
    $toname = $_POST['toname'];
    $description = $_POST['description'];
    if(!empty($toname)) {
    mysqli_query($link, "INSERT INTO topics (toname, description) VALUES ('$toname', '$description')"); 
    header('location: index.php');
    } else {
        $err = "Please enter a topic!";
    }
}
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
    <link rel="stylesheet" href="../../assets/css/login.css" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

    <title>Dashbroad Admin - Add Topic</title>
</head>

<body>
    <div class="header-top">
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
                        <li><a href="../posts/index.php">Manage Posts</a></li>
                        <li><a href="index.php">Manage Topics</a></li>
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
                <li><a href="../posts/index.php">Manage Posts</a></li>
                <li><a href="index.php">Manage Topics</a></li>
                <li><a href="../users/index.php">Manage Users</a></li>
            </ul>
        </div>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Add Topic</a>
                <a href="index.php" class="btn btn-big">Manage Topics</a>
            </div>
            <div class="about-content">
                <h2 class="page-tilte">Add Topic</h2>
                <form action="create.php" method="POST">
                    <div>
                        <label>Name</label>
                        <input type="text" name="toname" class="text-input"/>
                        <span style="color:#ea5f87;"><?php echo $err; ?></span>
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea type="text" name="description" id="description" class="text-input i-big"></textarea>
                    </div>
                    <div>
                    <button type="submit" name="submit" class="btn-big">Add Topic</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script src="../../assets/js/scripts.js"></script>
</body>
</html>
