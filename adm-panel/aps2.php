<?php error_reporting(0);?>
<?php
require_once('../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); 
echo 'NoRedirect won\'t work anymore. Try something different you can do.';}else{


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

    <title>New page - <?php echo $ptitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <link href="styles/custom.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="styles/mdb.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don\'t actually copy these 2 lines! -->
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
      content_css: 'styles/bootstrap.min.css'
       });
    </script>
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <form action="" method="post">
          <ul class="nav nav-pills pull-right">
            <input class="btn btn-primary" type='submit' name='submit' value='Done'>         
          </ul>
        </nav>
          <a class="btn btn-default" href="index.php">Cancel</a>
          

      </div>
     <hr/>
      <div>

      <?php

          

          //if form has been submitted process it
          if(isset($_POST['submit'])){

            $_POST = array_map( 'stripslashes', $_POST );

            //collect form data
            extract($_POST);

            //very basic validation
            if($title ==''){
              $error[] = 'Please enter the title.';
            }

            if($content ==''){
              $error[] = 'Please enter the content.';
            }

            if(!isset($error)){

              try {

                //insert into database
                $stmt = $db->prepare('INSERT INTO pages (title,content) VALUES (:title, :content)') ;
                $stmt->execute(array(
                  ':title' => $title,
                  ':content' => $content,
                ));

                //redirect to index page
                header('Location: view-pages.php?action=added');
                exit;

              } catch(PDOException $e) {
                  echo $e->getMessage();
              }

            }

          }

          //check for any errors
          if(isset($error)){
            foreach($error as $error){
              echo '<p class="error">'.$error.'</p>';
            }
          }
?>        <h3><?php echo $ptitle;?></h3>
          <textarea id="" name='content' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['content'];}?>
            start writing here
          </textarea></p>
        </form>
        
      </div>

<br/>
<br/>
<br/>
<hr/>


    </div> <!-- /container -->


    <script src="ckeditor/ckeditor.js"></script>
    <script>
    CKEDITOR.inline('editor_content');
    </script>
  </body>
</html>
<?php } ?>