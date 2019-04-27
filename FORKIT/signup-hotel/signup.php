<?php
    session_start();
    include 'db_connects.php';
    include 'db2_connects.php';
    
    if(isset($_POST['hotel'])){

        // storing the input data in local file 
        $hname = mysqli_real_escape_string($conn, $_POST['hname']);
        $oname = mysqli_real_escape_string($conn, $_POST['oname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        $number = mysqli_real_escape_string($conn, $_POST['onumber']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $cost = mysqli_real_escape_string($conn, $_POST['cost']);
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $uniqueid = uniqid();

        // checking if same email exist
        $sql = "SELECT * FROM hotel WHERE email = '$email' ";
        $results = mysqli_query($conn, $sql);
        $resultsCheck = mysqli_num_rows($results);

        if($resultsCheck > 0){
            header("Location: ../index.php?signup=uidexist");
        }

        else{
            // inserting the inputs in the data base
            $hashedpwd = md5($pwd);
            $sql = "INSERT INTO hotel (hotelname, ownername, email, pwd, contact, addres, city, cost, token, approved, claimed, hourstart, hourend, hotelID, rating) 
                    VALUES ('$hname', '$oname', '$email', '$hashedpwd', '$number', '$address', '$city', '$cost', '$token', 1, 1, '$_POST[start]', '$_POST[end]', '$uniqueid', 0);";
            mysqli_query($conn, $sql);

            $sql2 = "CREATE TABLE IF NOT EXISTS $uniqueid (
                        category VARCHAR(255) NOT NULL,
                        veg VARCHAR(255) NOT NULL,
                        food VARCHAR(255) NOT NULL,
                        price VARCHAR(255) NOT NULL
                    )";
            mysqli_query($conn2, $sql2);
            header("Location: ../index.php?$email?$uname?$token?$hashedpwd?$number");
            

            // $to      = $email; // Send email to our user
            // $subject = 'Signup | Verification'; // Give the email a subject 
            // $message = '
 
            //     Thanks for signing up!
            //     Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
            //     ------------------------
            //     Username: '.$uname.'
            //     Password: '.$pwd.'
            //     ------------------------
                
            //     Please click this link to activate your account:
            //     http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$token.'
                
            //     '; // Our message above including the link
                     
            //     $headers = 'From: ujjwal24batra@gmail.com' . "\r\n"; // Set from headers
            //     mail($to, $subject, $message, $headers); // Send our email

            //     header("Location: ../index.php?$email?$uname?$token?$hashedpwd?$number?emailSent");

        }
    }

else{
    header("Location: ../index.php?signup=error");
}
?>