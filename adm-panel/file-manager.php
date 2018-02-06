<?php //error_reporting(0);?>
<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php');
echo 'NoRedirect won\'t work anymore. Try something different you can do.'; } else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin Panel</title>
  	<link href="styles/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="styles/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <!-- Just for debugging purposes. Dont actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

  </head>
<body>
  <nav class="nav purple-nav" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo white-text waves-effect waves-light">OpenBox</a>
      <ul class="right hide-on-med-and-down">            
        <li><a style="position: relative;" class="dropdown-button white-text waves-effect waves-light" href="#!" data-hover="false" data-activates="1" id="button11">NEW</a></li>
        <li><a style="position: relative;" class="dropdown-button white-text waves-effect waves-light" href="#!" data-hover="false" data-activates="2" id="button11">VIEW</a></li>

        <li><a class="white-text waves-effect waves-light" href="logout.php">LOGOUT</a></li>
         </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect" href="dashboard.php">DASHBOARD</a></li>
        <li><a class="waves-effect" href="add-page.php">ADD PAGE</a></li>
        <li><a class="waves-effect" href="view-pages.php">VIEW PAGES</a></li>
        <li><a class="waves-effect" href="add-post.php">ADD POST</a></li>
        <li><a class="waves-effect" href="views-posts.php">VIEW POSTS</a></li>
        <li><a class="waves-effect" href="logout.php">LOGOUT</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons white-text">menu</i></a>
    </div>
  </nav>
		  <ul id="1" class="dropdown-content">
		    <li>
		        <a  class="waves-effect" href="add-post.php">POST</a>
		    </li>
		    <li>
		        <a href="add-page.php">PAGE</a>
		    </li>
		</ul>
		  <ul id="2" class="dropdown-content">
		    <li>
		        <a  class="waves-effect" href="view-posts.php">POSTS</a>
		    </li>
		    <li>
		        <a href="view-pages">PAGES</a>
		    </li>
		</ul>
				  <div class="container" style="padding-top:70px;">
				      <div class="row">
				        <div class="col sq12 m12">
				            <h2>Choose a file to upload</h2>
				                <form actiom="" method="post" enctype="multipart/form-data">
				                    <input type="file" class="btn purple" style="width:80%; margin-bottom:5px;" name="file">
				                    <input type="submit" class="btn btn-success" value="UPLOAD" name="submit">
				                </form>
				                <p>(Supported formats are, jpeg, jpg, png, gif, zip, rar, pdf, doc, pptx, ppsx, odt, odp, txt)</p>
				                <p>Max upload size is 3MB</p>
				                <br>
				                <hr>
				        </div>
				      </div>
				      <h2>Files</h2>
				  </div>
					<div id="wrapper">

					<div class="container">	
					<div id="masonry-grid" class="row">

					<?php

						if(isset($_FILES['file'])){
						    $errors = array();
						    $file_name = $_FILES['file']['name'];
						    $file_size = $_FILES['file']['size'];
						    $file_upl = $_FILES['file']['tmp_name'];
						    $file_type = $_FILES['file']['type'];
						    $file_name_rand = time()+rand(0,100000);

						    $file_ext = strtolower(end(explode('.',$_FILES['file']['name'])));
						    $extensions = array("jpeg","jpg","png","gif");
						    if(in_array($file_ext, $extensions)===false){
						        $errors = "unsupported file";
						    }
						    if ($file_size>3000000) {
						        $errors = "file size exceeds the limit";
						    }
						    if (empty($errors)==true) {
						        move_uploaded_file($file_upl, "cgi/".$file_name_rand.".".$file_ext);
						        echo '
						        <script>
						        alert("File uploaded");
						        </script>
						        ';

						    }else{
						        print_r($errors);
						    }
						}
						?>
						<?php

						if(isset($_POST['delete_file']))
						{
						 $filename = $_POST['file_name'];
						 unlink('cgi/'.$filename);
						 echo '<script>alert("Deleted successfully")</script>';
						}

						$folder = 'cgi';
						$scan = opendir($folder);

						if ($dir = opendir($folder))
						{
						 while (($res = readdir($dir)) !== false)
						 {
						 	$file = str_replace('..', 'Directory', $res);
						 	if($file == 'Directory'){

						 	}
						 	elseif($file == '.'){

						 	}
						 	elseif($file == 'index.php'){

						 	}
						 	else{
						 		echo '<div class="col s6">';
						 		echo '<div class="card">
						         	<div class="card-image">';
							  echo "<p>".$file."</p>";
							  echo "<form method='post' action=''>";
							  echo '<img src="'.$folder.'/'.$file.'" width="260vh" height="auto"><br/>';
							  echo '</div>';
							  echo "<input type='hidden' name='file_name' value='".$file."'>";
							  echo '<a href="'.$folder.'/'.$file.'" target="_blank" class="btn green">Download</a>&nbsp;';
							  echo '<button name="delete_file" class="btn red" value="delete">Delete</button>';
							  echo "</form>";
							  
							  echo "</div>
							  			</div>";
						}
						 }
						 closedir($dir);
						}
						?>
						<?php

						?>
</div>
</div>
</div>
	  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	  <script src="js/materialize.js"></script>
	  <script src="js/init.js"></script>
	  <script src="js/material-kit.js"></script>  
	  <script src="js/masonry.pkgd.min.js"></script>
</body>
</html>

<?php } ?>
