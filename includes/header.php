<div class="top-container" style="background-image:linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.35)), url(assets/images/a00.jpg)">
        <img src="assets/images/logo.jpg" style="max-width:150px;border-radius:50%;box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);">
        <h1>Love Meow</h1>
        <p>Life is better with a cat.</p>
    </div>

    <div class="header-top" id="myHeader">
        <div class="header-bar">
            <input type="text" autocomplete="off" id="mySearch" placeholder="Search..">
            <i class="fa fa-bars menu-toggle"></i>
            <ul class="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <?php if (isset($_SESSION['id'])): ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <?php echo htmlspecialchars($_SESSION["username"]); ?>
                            <i class="fa fa-chevron-down icon-down"></i>
                        </a>
                        <ul class="down-table">
                            <li><a href="admin/posts/index.php">Dashboard</a></li>
                            <li><a href="logout.php" class="logout">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="register.php">Sign Up</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
