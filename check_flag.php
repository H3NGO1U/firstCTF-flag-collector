<?php
include 'db_conn.php';
session_start();

function check_if_won_all(){
    $user_flags = $_SESSION['flags'];
    foreach($user_flags as $value){
        if($value==0)
            return false;
    }
    return true;    
}
$flags = ["firstCTF{0_Gr3At_j0b3__aDfeT23V^4}",
"firstCTF{1_alWay5_ch3ck_tH3_a55eTs_29f%j3}",
"firstCTF{2_u_F0unD_tH3_R0b0T5!!}",
"firstCTF{3_qu3rY_p4r4meters_mast3r!!}",
"firstCTF{4_s3crET_dir3cT0ry!!}",
"firstCTF{5_heaDers_3v3rywhere}",
"firstCTF{6_sql_injection_quE3n!!}",
"firstCTF{7_y0u_h4v3_an_IDOR!!}",
"firstCTF{8_cO0kies_str1ke!!}",
"firstCTF{9_u_did_a_GREAT_job!!}"];
$points= [50,50,100,100,150,150,200,200,300,300];
$flag = trim($_POST['flag']);
if($flag==""){
    header("Location: home.php?error=You entered empty flag");
    exit();
}
else{
    $index = array_search($flag, $flags);
    if($index!==false){
        if($_SESSION['flags'][$index]==1){
            $_SESSION['flag_ok'] = 'claimed_before';
            header("Location: home.php");
            exit();
        }
        else{
            $_SESSION['flags'][$index]=1;
            $earned_points =$points[$index]; 
            $_SESSION['points']+=$earned_points;
            $flags = json_encode($_SESSION['flags']);
            $points=$_SESSION['points'];
            $username = $_SESSION['username'];

            //update database
            $stmt = $conn->prepare("UPDATE users SET flags='$flags', points='$points' WHERE username=:username");
            $stmt->bindparam('username', $username);
            $stmt->execute();

            if(check_if_won_all())
                $_SESSION['got_all'] = 1;
            $_SESSION['flag_ok'] = 'ok';
            header("Location: home.php?points=".$earned_points);
            exit();
        }
    }
        
    else{
        $_SESSION['flag_ok'] = 'incorrect';
        header("Location: home.php");
        exit();
    }

}

