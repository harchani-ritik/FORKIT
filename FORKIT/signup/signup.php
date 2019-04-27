<?php
    session_start();
    include 'db_connect.php';
    
    if(isset($_POST['signup'])){

    

    $uname = mysqli_real_escape_string($conn, $_POST['su']);
    $email = mysqli_real_escape_string($conn, $_POST['se']);
    $number = mysqli_real_escape_string($conn, $_POST['spn']);
    //$uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['sp']);
    $token = bin2hex(openssl_random_pseudo_bytes(16));

    // if(empty($uname)||empty($email)||empty($uid)||empty($pwd)){
    //     header("Location: ../index.php?signup=empty");
    //     exit();
    // }
    // else{
        $sql = "SELECT * FROM users WHERE email = '$email' ";
        $results = mysqli_query($conn, $sql);
        $resultsCheck = mysqli_num_rows($results);
        if($resultsCheck > 0)
        {
            header("Location: ../index.php?signup=uidexist");
        }
        else{
            //hashing the password

            $hashedpwd = md5($pwd);
            $sql = "INSERT INTO users (username, email, verified, token, pwd, phone) 
                    VALUES ('$uname', '$email', 0, '$token', '$hashedpwd', '$number');";
            mysqli_query($conn, $sql);
            header("Location: ../index.php?signup=success");
            

            // require('textlocal.class.php');
            // require('credentials.php');

            // $textlocal = new Textlocal(false, false, API_KEY);

            // $numbers = array($number);
            // $sender = 'TXTLCL';
            // $otp = mt_rand(1000,9999);
            // $message = 'Hello '.$uname. ' Bitch Ass Nigga. Your OTP is '. $otp .'.';

            // try {
            //     $result = $textlocal->sendSms($numbers, $message, $sender);
            //     setcookie('otp', $otp);
            //     header("Location: display.php?otp=sent");
            // } catch (Exception $e) {
            //     header("Location: display.php?otp=failed");
            // }
        }
    }

else{
    header("Location: ../index.php?signup=error");
}
?>