<?php
require_once "../../config.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
}
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $admin=$_POST['admin'];
        $sql = "INSERT INTO users (admin, username, password) VALUES ('".$admin."',?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
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

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <title>Admin Section - Add User</title>
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
                        <li><a href="../topics/index.php">Manage Topics</a></li>
                        <li><a href="index.php">Manage Users</a></li>
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
                <li><a href="../topics/index.php">Manage Topics</a></li>
                <li><a href="index.php">Manage Users</a></li>
            </ul>
        </div>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn-big">Add User</a>
                <a href="index.php" class="btn-big">Manage Users</a>
            </div>
            <div class="about-content">
                <h2 class="page-tilte">Add user</h2>
                <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="sign-container">
                        <div class=" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label style="font-weight: bold;">Username</label>
                            <input type="text" placeholder="Enter Username" name="username" class="text-input" value="<?php echo $username; ?>">
                            <span style="color:#ea5f87;"><?php echo $username_err; ?></span>
                        </div>    
                        <div class=" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label style="font-weight: bold;">Password</label>
                            <input type="password" placeholder="Enter Password" name="password" class="pass-input" value="<?php echo $password; ?>">
                            <span style="color:#ea5f87;"><?php echo $password_err; ?></span>
                        </div>
                        <div class=" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label style="font-weight: bold;">Confirm Password</label>
                                <input type="password" placeholder="Confirm Password" name="confirm_password" class="confirm" value="<?php echo $confirm_password; ?>">
                                <span style="color:#ea5f87;"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div>
                        <label style="font-weight: bold;">Level</label>
                            <select name = "admin" class="text-input">
                                <option value=1>Member</option>
                                <option value=2>Admin</option>
                            </select><br />
                        </div>
                        <div>
                            <input type="submit" class="btn-big" value="Submit" style="  font-family: 'Noto Serif SC', serif; font-size: 16px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- CKEditor 5-->
    <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>

    <!-- Custom Script -->
    <script src="../../assets/js/scripts.js"></script>
</body>
</html>
