<?php
session_start();
// Include config file
require_once "../../config.php";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
}
$post_id=$_GET['post_id'];
if (isset($_POST['update'])) {
    $imag = $_FILES['image']['name'];
    $titl = $_POST['title'];
    $desc = $_POST['descript'];
    $bod = $_POST['body'];
    $topi_id = $_POST['topic_id'];
    $target = "../../assets/images/".basename($image);

	mysqli_query($link, "UPDATE posts SET image='$imag', title='$titl', description='$desc', body='$bod', topic_id='".$topi_id."' WHERE post_id='".$post_id."'");
    header('location: index.php');
    exit();
}
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
    <link rel="stylesheet" href="../../assets/css/dashboard.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <title>Dashbroad Admin - Edit Post</title>
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
                        <li class="admin-manage"><a href="index.php">Manage Posts</a></li>
                        <li class="admin-manage"><a href="../users/index.php">Manage Users</a></li>
                        <li class="admin-manage"><a href="../topics/index.php">Manage Topics</a></li>
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
                <li><a href="../../logout.php" class="logout">Logout</a></li>
            </ul>
        </div>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn-big">Add Post</a>
                <a href="index.php" class="btn-big">Manage Posts</a>
            </div>
            <div class="about-content">
                <h2 class="page-tilte">Edit Post</h2>
                
                <form method="POST" action="edit.php?post_id=<?=$post_id?>" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <div>
                    <input type="file" name="image" value="<?php echo $row['image'];?>">
                    </div>
                    <div>
                        <label>Tilte</label>
                        <input type="text" name="title" class="text-input" value="<?php echo $row['title'];?>" />
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea name="descript" class="input-body-text text-input" style="margin-bottom:16px"><?php echo $row['descript'];?></textarea>
                    </div>
                    <div>
                        <label>Body</label>
                        <textarea name="body" id="body"  class=" input-body-text"><?php echo $row['body'];?></textarea>
                    </div>
                    <div>
                        <label>Topics</label>
                        <select name="topic" class="text-input">
                            <?php
                                $query = $link->query("SELECT * FROM topics");
                                while($row = $query->fetch_object()) {
                                    echo "<option value='".$row->topic_id."'>".$row->toname."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="update" class="btn-big">Update</button>
                    </div>
                </form>
                <?php 
                 
                ?>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- CKEditor -->
    <script src="../ckeditor/ckeditor.js"></script>

    <!-- Custom Script -->
    <script src="../../assets/js/scripts.js"></script>
</body>
</html>
