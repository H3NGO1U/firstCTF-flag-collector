<?php
session_start();
if (!isset($_SESSION['username'])){
    header("Location: index.html");
    exit();
}

if(isset($_SESSION['flag_ok'])){
    if($_SESSION['flag_ok']=='incorrect')
        echo "<script>
            alert('incorrect:(');
            </script>";

    else if($_SESSION['flag_ok']=='claimed_before')
        echo "<script>
            alert('This is a valid flag that has been claimed before');
            </script>";
    else if($_SESSION['flag_ok']=='ok'){
            $points = $_GET['points'];
            echo "<script>
            alert('Great job! you got $points points');
            </script>"; 
    }
    if(isset($_SESSION['got_all'])){
            echo "<script>
            alert('AWASOME! you got all the flags:))');
            </script>";
            unset($_SESSION['got_all']);    
    }
                
    unset($_SESSION['flag_ok']);    
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="error.css">
    	<!-- Bootstrap CSS --> 
	<link rel="stylesheet" href= 
"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		integrity= 
"sha386-9aIt2nRpC12Uk9gS9baDl611NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
		crossorigin="anonymous"> 
    <title>Home</title>
</head>
<body>
<div class="container my-4 "> 
<form action="logout.php" method="post">
    <button type="submit" class="btn btn-secondary">Log out</button>
</form>
<p>points: <?php echo $_SESSION['points']?></p>
    <h1 class="text-center"> Hello <?php echo htmlspecialchars($_SESSION['username'])?>!</h1>
    <br>
    <br>
    <h3> Submit flag!</h3>
  <br>
  <?php if (isset($_GET['error'])) { ?>
	<p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
	<?php } ?>
  <form action="check_flag.php" method="post"> 
    <div class="form-group"> 
        <label for="flag">Flag</label> 
    <input type="text" class="form-control" id="flag"
        name="flag" placeholder="firstCTF{EXAMPLE_FLAG}">	 
    </div> 
    <button type="submit" class="btn btn-primary"> 
		Submit 
		</button> 
	</form> 
</div>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p class="not_found" id=0>Flag 0</p>
        </div>
        <div class="col-md-6">
            <p class="not_found" id=1>Flag 1</p>
        </div>
        
    </div>
    <br>
    <div class="row">
    <div class="col-md-6">
            <p class="not_found" id=2>Flag 2</p>
        </div>
        <div class="col-md-6">
            <p class="not_found" id=3>Flag 3</p>
        </div>
    </div>
    <br>
    <div class="row">
            <div class="col-md-6">
                <p class="not_found" id=4>Flag 6</p>
            </div>
            <div class="col-md-6">
                <p class="not_found" id=5>Flag 5</p>
            </div>
  </div>
  <br>       
    <div class="row">
        <div class="col-md-6">
            <p class="not_found" id=6>Flag 6</p>
        </div>
        <div class="col-md-6">
            <p class="not_found" id='7'>Flag 7</p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <p class="not_found" id=8>Flag 8</p>
        </div>
        <div class="col-md-6">
            <p class="not_found" id=9>Flag 9</p>
        </div>
    </div>
</div>
<style>
    .not_found{
        color:gray;
    }
    .found{
        font-size:20px;
        width:60px;
        box-shadow: 0px 0px 40px 20px #effa8c;
        background-color:#effa8c;
    }
</style>
<?php
$user_flags = $_SESSION['flags'];
foreach($user_flags as $key=>$value){
    if($value==1)
        echo "<script>
                document.getElementById('$key').classList.remove('not_found');
                document.getElementById('$key').classList.add('found');
            </script>";
}
?>
</body>
</html>