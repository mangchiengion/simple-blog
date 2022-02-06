<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "blog");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
	//Get title
	$title = mysqli_real_escape_string($db, $_POST['title']);
    $body = $_POST['body'];
  	// image file directory
  	$target = "../../assets/images/".basename($image);

  	$sql = "INSERT INTO posts (image, title, body) VALUES ('$image', '$title', '$body')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM posts");
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
    <title>Image Upload</title>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>
</head>
<body>
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
		  echo "<img src='../../assets/images/".$row['image']."' >";
		  echo "<p>".$row['title']."</p>";
      	echo "<p>".$row['body']."</p>";
      echo "</div>";
    }
  ?>
  
  <form method="POST" action="test.php" enctype="multipart/form-data">
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
                        
                    </div>
                    <div>
                        <button type="submit" name="upload" class="btn-big">Add Post</button>
                    </div>
                </form>

<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<!-- CKeditor -->
<script src="../ckeditor/ckeditor.js"></script>

<!-- Custom Script -->
<script src="../../assets/js/scripts.js"></script>
</body>
</html>
