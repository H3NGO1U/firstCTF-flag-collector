<?php
include 'db_conn.php';
	
	if(isset($_POST["username"]) && isset($_POST["password"])){
	$username = trim($_POST["username"]); 
	$password = trim($_POST["password"]); 
	if($username==""){
		header("Location: login_page.php?error=User name is required");
		exit();
	}
	else if($password==""){
		header("Location: login_page.php?error=password is required");
		exit();
	}
	else{
		$password = hash('sha256',$password);
		$stmt = $conn->prepare("SELECT username, flags, points FROM users WHERE username=:username AND password=:pass");
		$stmt->bindparam('username', $username);
		$stmt->bindparam('pass', $password);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result){
			session_start();
			$_SESSION['username'] = $result['username'];
			$_SESSION['flags']=json_decode($result['flags']); 
			$_SESSION['points']=$result['points'];
			header("Location: home.php");
			exit();
		}
			
		else{
			header("Location: login_page.php?error=incorrect username or password");
			exit();
		}	
	}
}	