<?php error_reporting(0);?>
<?php //include config
require_once('../includes/config.php');
error_reporting(0);

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
	<h2>Edit User</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$passwordConfirm = strip_tags($_POST['passwordConfirm']);
		$email = strip_tags($_POST['email']);
		//very basic validation
		if($username ==''){
			$error[] = '<div class="alert alert-danger">Please enter the username.</div>';
		}

		if( strlen($password) > 0){

			if($password ==''){
				$error[] = '<div class="alert alert-danger">Please enter the password.</div>';
			}

			if($passwordConfirm ==''){
				$error[] = '<div class="alert alert-danger">Please confirm the password.</div>';
			}

			if($password != $passwordConfirm){
				$error[] = '<div class="alert alert-danger">Passwords do not match.</div>';
			}

		}
		

		if($email ==''){
			$error[] = 'Please enter the email address.';
		}

		if(!isset($error)){

			try {

				if(isset($password)){

					$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

					//update into database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, password = :password, email = :email WHERE memberID = :memberID') ;
					$stmt->execute(array(
						':username' => $username,
						':password' => $hashedpassword,
						':email' => $email,
						':memberID' => $memberID
					));


				} else {

					//update database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, email = :email WHERE memberID = :memberID') ;
					$stmt->execute(array(
						':username' => $username,
						':email' => $email,
						':memberID' => $memberID
					));

				}
				

				//redirect to index page
				header('Location: users.php?action=updated');
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

			$stmt = $db->prepare('SELECT memberID, username, email FROM blog_members WHERE memberID = :memberID') ;
			$stmt->execute(array(':memberID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='memberID' value='<?php echo $row['memberID'];?>'>

		<p><label>Username</label><br />
		<input class="form-control" type='text' name='username' value='<?php echo $row['username'];?>'></p>

		<p><label>Password (only to change)</label><br />
		<input class="form-control" type='password' name='password' value=''></p>

		<p><label>Confirm Password</label><br />
		<input class="form-control" type='password' name='passwordConfirm' value=''></p>

		<p><label>Email</label><br />
		<input class="form-control" type='text' name='email' value='<?php echo $row['email'];?>'></p>

		<p><input class="btn btn-primary" type='submit' name='submit' value='Update User'></p>

	</form>

</div>

</body>
</html>	
<?php } ?>