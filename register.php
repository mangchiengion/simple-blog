<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
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
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
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

    <title>Sign Up</title>
</head>
<body>
    <div class="top-container" style="width: 100%; height: 100%; background-image:linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.35)), url(assets/images/a00.jpg); position:fixed;">
        
        <!-- Modal Content -->
        <h2>Sign Up</h2>
        <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="sign-container">
                <div class=" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label style="font-weight: bold;">Username</label>
                    <input type="text" placeholder="Enter Username" name="username" class="name-input" value="<?php echo $username; ?>">
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
                    <input type="submit" class="login-btn" value="Submit" style="  font-family: 'Noto Serif SC', serif; font-size: 15px;">
                </div>
                    <p>Already have an account? <a href="login.php" style="color:#ea5f87">Login here</a>.</p>
            </div>
        </form>
        
    </div>    
</body>
</html>