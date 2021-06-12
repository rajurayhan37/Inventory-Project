<?php
	//Start the session.
	session_start();
    $error_message = '';

    if($_POST)
    {
		include('database/connection.php');

		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query ='SELECT * FROM users WHERE users.email="'.$username.'" AND users.password="'. $password.'"';
		
		$stmt=$conn->prepare($query);
		//$stmt->execute();
		$stmt ->execute();
		
		if($stmt->rowCount()>0)
		{
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetchAll()[0];
			$_SESSION['user'] = $user;

			header('Location:Dashboard.php');

		}
		else $error_message = 'Please make sure that username and password are correct.';
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>MS NEW MAA DYING</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php if(!empty($error_message)) { ?>
		<div id ="errorMessage">
			<strong>ERROR:<br></strong> <?= $error_message ?>
		</div>
	<?php } ?>	
	    
	<img class="wave" src="Picture/wave.png">
	<div class = "loginHeader">
		<h1>Welcome  </h1>
		<h2>to</h2>
		<h3>MS NEW MAA DYING</h3>
	</div>
	<div class="container">		
		<div class="img">
			<img src="Picture/bg.svg">
		</div>

		<!-- Login - Form - action -->

		<div class="login-content">
			<form action="index.php" method="POST">
				<img src="Picture/admin.png">
				<h4 class="title">Admin</h4>
           		<div class="input-div user">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="username" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
