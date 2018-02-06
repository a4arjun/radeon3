<?php error_reporting(0);?>
<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php');
echo 'NoRedirect won\'t work anymore. Try something different you can do.'; } else{

//show message from add / edit page
if(isset($_GET['delpost'])){ 

  $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
  $stmt->execute(array(':postID' => $_GET['delpost']));

  header('Location: view-posts.php?action=deleted');
  exit;
} 

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

  </head>

  <body>

    <?php include 'navbar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Manage Posts</h1>
            <?php 
            //show message from add / edit page
            if(isset($_GET['action'])){ 
              echo '<div class="alert alert-success">Post '.$_GET['action'].'.</div>'; 
            } 
            ?>
          <div class="table-responsive">
            <table class="table table-striped">
             

            <tr>
              <th>Title</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
              <?php
                try {

                      $stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
                      while($row = $stmt->fetch()){
                        
                        echo '<tr>';
                        echo '<td>'.$row['postTitle'].'</td>';
                        echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
                        ?>

                        <td>
                          <form action="">
                          <a class="btn btn-primary" href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a>
                          <button class="btn btn-danger" name="delpost" value="<?php echo $row['postID'];?>">Delete</button>
                          </form>
                        </td>
                        
                        <?php 
                        echo '</tr>';

                      }

                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }
              ?>

            </table>
          </div>


        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript">
        function delpost(id, title)
            {
              if (confirm("Are you sure you want to delete '" + title + "'"))
              {
                window.location.href = 'index.php?delpost=' + id;
              }
            }
    </script>
  </body>
</html>
<?php } ?>