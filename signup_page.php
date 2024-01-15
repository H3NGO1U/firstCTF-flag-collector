
	
<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	<link rel="stylesheet" href="error.css">
	<!-- Bootstrap CSS --> 
	<link rel="stylesheet" href= 
"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		integrity= 
"sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
		crossorigin="anonymous"> 
		<title>Sign up</title>

</head> 
	
<body> 
	

	
<div class="container my-4 "> 
	
	<h1 class="text-center">Signup Here</h1> 
	<br>
	<?php if (isset($_GET['error'])) { ?>
	<p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
	<?php } ?>
	<form action="signup.php" method="post"> 
	
		<div class="form-group"> 
			<label for="username">Username</label> 
		<input type="text" class="form-control" id="username"
			name="username">	 
		</div> 
	
		<div class="form-group"> 
			<label for="password">Password</label> 
			<input type="password" class="form-control"
			id="password" name="password"> 
		</div>  
		<div class="form-group"> 
			<label for="password">Confirm password</label> 
			<input type="password" class="form-control"
			id="cpassword" name="cpassword"> 
		</div>  
		<button type="submit" class="btn btn-primary"> 
		SignUp 
		</button> 
		<small>
			<a href="login_page.php">already have an account?</a>
	</small>
	</form> 
	<br>
        <br>
        <a href="index.html"> back to main</a>
</div> 
	
</body> 
</html> 
