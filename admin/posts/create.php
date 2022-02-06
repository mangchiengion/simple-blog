<?php
session_start();
require_once "../../config.php";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
}
if (isset($_POST['upload'])) {
$image = $_FILES['image']['name'];
$body = mysqli_real_escape_string($link, $_POST['body']);
$title = mysqli_real_escape_string($link, $_POST['title']);
$descript = mysqli_real_escape_string($link, $_POST['descript']);
$topic_id = $_POST['topic_id'];
$target = "../../assets/images/".basename($image);

$sql = "INSERT INTO posts (image, title, descript, body, topic_id) VALUES ('$image', '$title', '$descript', '$body', '".$topic_id."')";
mysqli_query($link, $sql);
header('location: index.php');
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
    <title>Dashbroad Admin - Add Post</title>
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
                <h2 class="page-tilte">Add Post</h2>
                <form method="POST" action="create.php" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="10000000">
                    <div>
                    <input type="file" name="image">
                    </div>
                    <div>
                        <label>Tilte</label>
                        <input type="text" name="title" class="text-input" />
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea name="descript" class="input-body-text text-input" style="margin-bottom:16px"></textarea>
                    </div>
                    <div>
                        <label>Body</label>
                        <textarea name="body" id="body"  class=" input-body-text"></textarea>
                    </div>
                    <div>
                        <label>Topics</label>
                        <select name="topic_id" class="text-input">
                            <?php
                                $query = $link->query("SELECT * FROM topics");
                                while($row = $query->fetch_object()) {
                                    echo "<option value='".$row->topic_id."'>".$row->toname."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="upload" class="btn-big">Add Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    
    <!-- CKeditor -->
    <script src="../ckeditor/ckeditor.js"></script>

    <!-- Custom Script -->
    <script src="../../assets/js/scripts.js"></script>
</body>
</html>
