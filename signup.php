<?php
include 'db_conn.php';
	
	if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["cpassword"])){
        $username = trim($_POST["username"]); 
        $password = trim($_POST["password"]); 
        $cpassword = trim($_POST["cpassword"]); 
        if($username==""){
            header("Location: signup_page.php?error=User name is required");
            exit();
        }
        else if($password==""){
            header("Location: signup_page.php?error=password is required");
            exit();
        }
        else if($cpassword==""){
            header("Location: signup_page.php?error=Please confirm password");
            exit();
        }
        
        else if($cpassword!=$password){
            header("Location: signup_page.php?error=passwords should match");
            exit();
        }
        else{
            //check if username already exists
            $stmt = $conn->prepare("SELECT username FROM users WHERE username=:username");
            $stmt->bindparam('username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                header("Location: signup_page.php?error=username taken");
                exit();
            }
            else{
                $password = hash('sha256',$password);
                $flags = json_encode([0,0,0,0,0,0,0,0,0,0]);
                $stmt = $conn->prepare("INSERT INTO `users` (`id`, `username`, 
                `password`, `flags`, `points`) VALUES (NULL,:username, 
                :pass, '$flags', 0)");
                $stmt->bindparam('username', $username);
                $stmt->bindparam('pass', $password);
                $result = $stmt->execute();
                if ($result) { 
                    header("Location: home.php");
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['flags']=json_decode($flags);
                    $_SESSION['points']=0;
                    exit();
                }
                else{
                    header("Location: signup_page.php?error=something went wrong");
                    exit();
                } 
            } 
        }    
}	