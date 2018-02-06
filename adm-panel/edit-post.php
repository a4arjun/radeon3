<?php error_reporting(0);?>
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

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
      tinymce.init({ selector:'textarea',
      height: 400,
      menubar: false,
      plugins: ['advlist autolink lists link image charmap print preview anchor textcolor table fullscreen'],
      toolbar: ['insert | undo redo | bold italic underline | backcolor forecolor table | alignleft aligncenter alignright alignjustify | '],
      content_css: ['styles/bootstrap.min.css', 'ctyles/custom.css']
       });
    </script>
  </head>

  <body>

    <?php include 'navbar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
            <?php

            //if form has been submitted process it
            if(isset($_POST['submit'])){

              $_POST = array_map( 'stripslashes', $_POST );

              //collect form data
              extract($_POST);
              $postTitle = strip_tags($_POST['postTitle']);
              $postCover = strip_tags($_POST['postCover']);
              $postDesc = strip_tags($_POST['postDesc']);
              $postCont = strip_tags($_POST['postCont'], '<a><b><i><u><h1><h2><h3><h4><h5><h6><strong><br><hr><p><span><table><tr><th><td><img>');
              //very basic validation
              if($postID ==''){
                $error[] = '<div class="alert alert-danger">This post is missing a valid id!.</div>';
              }

              if($postTitle ==''){
                $error[] = '<div class="alert alert-danger">Please enter the title.</div>';
              }

              if($postDesc ==''){
                $error[] = '<div class="alert alert-danger">Please enter the description.</div>';
              }

              if($postCont ==''){
                $error[] = '<div class="alert alert-danger">Please enter the content.</div>';
              }

              if($postCover ==''){
                $postCover = 'http://localhost/openbox/uploads/test/1515343871.jpg';
              }


              if(!isset($error)){

                try {

                  //insert into database
                  $stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postCover = :postCover, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
                  $stmt->execute(array(
                    ':postTitle' => $postTitle,
                    ':postCover' => $postCover,
                    ':postDesc' => $postDesc,
                    ':postCont' => $postCont,
                    ':postID' => $postID
                  ));

                  //redirect to index page
                  header('Location: view-posts.php?action=updated');
                  exit;

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }

              }

            }

            ?>


            <?php
              //check for any errors
            
              if(isset($error)){
                foreach($error as $error){
                  echo $error.'<br />';
                }
              }

                try {

                  $stmt = $db->prepare('SELECT postID, postTitle, postCover, postDesc, postCont FROM blog_posts WHERE postID = :postID') ;
                  $stmt->execute(array(':postID' => $_GET['id']));
                  $row = $stmt->fetch(); 

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }

            ?>

  <form action='' method='post'>
    <input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

    <p><label>Title</label><br />
    <input class="form-control" type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

    <p><label>Cover</label><i>(Cover image)</i><br />
    <input class="form-control" type='text' name='postCover' value='<?php echo $row['postCover'];?>'></p>    


    <p><label>Description</label><br />
    <input class="form-control" name='postDesc' value='<?php echo $row['postDesc'];?>'></p>

    <p><label>Content</label><br />
    <textarea class="text" name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>
    <?php echo $postCont; ?>
    <p><input class="btn btn-primary" type='submit' name='submit' value='Update'></p>

  </form>

 
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
  </body>
</html>
<?php } ?>