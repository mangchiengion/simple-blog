<?php
require_once "config.php";
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
$username = $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["admin"] = $admin;
                            $_SESSION["username"] = $username;
                            if ($_SESSION['admin']) {
                                header("location: /admin/dashboard.php");
                            } else{
                            header("location: index.php");
                            }
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/login.css" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">

    <title>My Blog</title>
</head>

<body>
    <div class="top-container" style="width: 100%; height: 100%; background-image:linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.35)), url(assets/images/a00.jpg); position:fixed;">
        <img src="assets/images/logo.jpg" style="max-width:150px;border-radius:50%;box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);">
        
        <!-- Modal Content -->
        <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="sign-container">
            <div class=" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label style="font-weight: bold;">Username</label>
                <input type="text" placeholder="Enter Username" name="username" class="name-input" value="<?php echo $username; ?>">
                <span style="color:#ea5f87;"><?php echo $username_err; ?></span>
            </div>    
            <div class=" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label style="font-weight: bold;">Password</label>
                <input type="password" placeholder="Enter Password" name="password" class="pass-input">
                <span style="color:#ea5f87;"><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" class="login-btn" value="Login" style="font-family: 'Noto Serif SC', serif; font-size: 15px;">
            </div>
            <p>Don't have an account? <a href="register.php" style="color:#ea5f87" >Sign up now</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>
