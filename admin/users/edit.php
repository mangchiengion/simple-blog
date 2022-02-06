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
    <title>Admin Section - Edit User</title>
</head>

<body>
    <div class="header-top">
        <div class="header-bar">
            <div class="logo">Love <span class="design-logo"> Meow </span></div>
            <i class="fa fa-bars menu-toggle"></i>
            <ul class="nav">
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i>
                        Admin
                        <i class="fa fa-chevron-down icon-down"></i>
                    </a>
                    <ul class="down-table">
                    <li><a href="../../index.php">View Home Blog</a></li>
                    <li><a href="../posts/index.php">Manage Posts</a></li>
                    <li><a href="../topics/index.php">Manage Topics</a></li>
                    <li><a href="index.php">Manage Users</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="left-sidebar">
            <ul>
                <li><a href="../../index.php">View Home Blog</a></li>
                <li><a href="../posts/index.php">Manage Posts</a></li>
                <li><a href="index.php">Manage Users</a></li>
                <li><a href="../topics/index.php">Manage Topics</a></li>
            </ul>
        </div>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn-big">Add User</a>
                <a href="index.php" class="btn-big">Manage Users</a>
            </div>
            <div class="about-content">
                <h2 class="page-tilte">Edit user</h2>
                <form action="create.html" method="post">
                    <div>
                    <label>Name</label>
                    <input title="text" name="tilte" class="text-input" />
                    </div>
                    <label>Password</label>
                    <input title="text" name="tilte" class="text-input" />
                    <br />
                    <div>
                        <label>About</label>
                        <select name="topic" class="text-input">
                            <option value="Admin">Admin</option>
                            <option value="Author">Author</option>
                            <option value="Viewer">Viewer</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn-big">Update User</button>
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
