<?php
require_once "../../config.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
}
$result = mysqli_query($link,"SELECT * FROM topics");
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

    <title>Dashbroad Admin - Manage Topics</title>
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
                <a href="create.php" class="btn-big">Add Topic</a>
                <a href="index.php" class="btn-big">Manage Topics</a>
            </div>
            <div class="about-content">
                <h2 class="page-tilte">Manage Topics</h2>
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    while($row = mysqli_fetch_array($result))
                    { 
                    echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>$row[toname]</td>";
                        echo "<td><a href='edit.php?topic_id=$row[topic_id]' class='edit'>edit</a></td>";
                        
                        echo "<td><a href='delete.php?topic_id=$row[topic_id]' class='delete'>delete</a></td>";
                    echo "</tr>";
                    $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script src="../../assets/js/scripts.js"></script>
</body>
</html>
