<?php error_reporting(0);?>
<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){
  header('Location: login.php');
  echo 'No redirect won\'t work anymore. Try something else that you can do';

}else{

//show message from add / edit page
if(isset($_GET['delpost'])){ 

  $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
  $stmt->execute(array(':postID' => $_GET['delpost']));

  header('Location: index.php?action=deleted');
  exit;
} 
?><!DOCTYPE html>
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

    <!-- Custom styles for this template -->
    <link href="styles/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <?php include 'navbar.php'; ?>
    <div class="container-fluid">
      <div class="row">
      <?php include 'sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
          <table class="table">
          <tr>
          <td>Software name</td><td>Radeon</td>
          </tr>
          <tr>
          <td>Software version</td><td> Version 3.0</td>
          </tr>
          </table>
          <br/>
          <b>Change log</b><br/><br/>
          <b>Version 3.0</b><br/
          <i>
          --Updated security issues<br/>
          --Optimized UI and UX<br/>
          --Reduced size to 2MB from 30MB.<br/>
          --New material UI
          </i><br/>
          <b>Version 2.0 (S)</b><br/>
          <i>
          --Bugs fixed<br/>
          --Fixed few security issues<br/>
          </i>
          <b>Version 2.0</b><br/>
          <i>
          --Bug fixed<br/>
          --CKeditor used as default text editor<br/>
          --Inline post/page editing option is added<br/>
          </i>

          <b>Version 1.01</b><br/>
          <i>
          --Minor bug fixes<br/>
          --CORE updated<br/>
          </i>
          <b>Version 1.0</b><br/>
          <i>
          --Initial release of Radeon<br/>
          --TinyMCE is used as default text editor<br/>
          </i>
          
        </div>
        </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script language="JavaScript" type="text/javascript">
        function delpost(id, title)
            {
              if (confirm("Are you sure you want to delete '" + title + "'"))
              {
                window.location.href = 'view-pages.php?delpost=' + id;
              }
            }
    </script>
  </body>
</html>';
<?php } ?>