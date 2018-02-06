<?php error_reporting(0);?>
<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php');
echo 'NoRedirect won\'t work anymore. Try something different you can do.'; } else{

//show message from add / edit page
if(isset($_GET['deluser'])){ 

	//if user id is 1 ignore
	if($_GET['deluser'] !='1'){

		$stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
		$stmt->execute(array(':memberID' => $_GET['deluser']));

		header('Location: users.php?action=deleted');
		exit;

	}
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
      <h2>All users</h2>
			<?php 
			//show message from add / edit page
			if(isset($_GET['action'])){ 
				echo '<div class="alert alert-success">User '.$_GET['action'].'.</div>'; 
			} 
			?>
  <div class="table-responsive">
  <table class="table table-striped">
	<tr>
		<th>Username</th>
		<th>Email</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['username'].'</td>';
				echo '<td>'.$row['email'].'</td>';
				?>

				<td>
				<form action=''>
					<a class="btn btn-primary" href="edit-user.php?id=<?php echo $row['memberID'];?>">Edit</a> 
					<?php if($row['memberID'] != 1){?>
						<button class="btn btn-danger" name="deluser" value="<?php echo $row['memberID'];?>">Delete</button>
					<?php } ?>
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
	<p><a href='add-user.php'>Add User</a></p>

</div>

</body>
</html>
<?php } ?>