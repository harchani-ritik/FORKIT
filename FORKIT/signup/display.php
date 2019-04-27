<?php
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" >
    <link rel="stylesheet" href="assets/fonts/forkit/post-no-bills-jaffna-cufonfonts-webfont/style.css">

</head>
<body>
    <?php
        // If alredy logged in then redirect
        if(isset($_SESSION['u_id'])){
            header("Location: ../index.php?loggedin=1");
        }// else display login page
        else{
    ?>


            <div class="container-fluid">
                <div class="container">
                    <div class="card">
                        <div class="logo"><img src="../assets/images/green.png" alt=""><div>FORKIT</div></div>

                         <!-- login for customer -->
                        <div class="loginForm" id="logIN" >
                                <form action="signup.php" method="POST">
                                    <div class="greet">Hello there,<br>Register Now!<div>
                                    <input class="username input" type="text" name="su" placeholder="Username..." required>
                                    <input class="email input" type="email" name="se" placeholder="Email..." required>
                                    <input class="phoneNumber input" type="text" name="spn" placeholder="Conatct Number..." required>
                                    <input class="password input" type="password" name="sp" placeholder="Password..." required>
                                    
                                    <div class="submit">
                                        <span>Already have an Account?<br> Login Here</span>
                                        <span class="button"><button type="submit" name="signup">Log in</button></span>
                                    </div>

                                    
                                </form>
                        </div>
                    </div>
                </div>
            </div>

    <?php
        }
    ?>
</body>
</html>