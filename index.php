<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Facebook Login
	</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-inner">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				    <a class="navbar-brand" href="#">Facebook Login</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">

					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<?php 
		if(!empty($_SESSION['FBID'])){
		?>
			<div class="col-md-5 col-md-offset-4">
				You are currently logged in <?php echo $_SESSION['USERNAME']; ?>
				<a href="logout.php">Logout</a>
			</div>
		<?php
		}
		else{	
		?>
		<div class="col-md-5 col-md-offset-4">
			<div id="login">
			<a href="fbconfig.php" class="btn btn-facebook btn-custom btn-block">Login with facebook</a>
			<div class="hr">
				<div class="inner">
					or
				</div>
			</div>
			<Form>
				<div class="form-group">
					<input type="text" class="form-control input-lg" name="username" placeholder="Enter username">
				</div>
				<div class="form-group">
					<input type="password" class="form-control input-lg" name="password" placeholder="Enter password">
				</div>
				<div class="form-group">
					<button class="btn btn-success btn-custom btn-block" type="submit">Login</button>
				</div>
			</Form>
		</div>
		</div>
		<?php
		}
		?>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>