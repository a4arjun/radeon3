<?php include 'includes/config.php';?>
<?php include 'includes/post.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
		<title><?php echo $blog_title;?> | <?php echo $site_title;?></title>
    <!-- Bootstrap core CSS -->
    <link href="adm-panel/styles/bootstrap.min.css" rel="stylesheet">
  </head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="index.php"><?php echo $site_title; ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
			<?php include 'includes/nav.php' ?>
    </div>
  </div>
</nav>
<div class="container">
<div style="padding-top:60px; padding-bottom:100px; border-bottom: 1px solid #aaa;">  
<h2><?php echo $blog_title;?></h2><hr/>
<h4><?php echo $blog_description;?></h4>
<br/>
<p><?php echo $blog_content; ?></p>
</div>
</div>
<div class="footer">
<center><br/>
<?php echo $footer;?>
</center>
</div>
</body>
</html>