<?php
    session_start();
    include 'db_connects.php';
    include 'db2_connects.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup-Hotel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" >
    <link rel="stylesheet" href="assets/fonts/forkit/post-no-bills-jaffna-cufonfonts-webfont/style.css">

</head>
<body>
    <div class="container-fluid">
        <div class="container">

            <div class="hotelsignup">
                <form action="signup.php" method="POST">
                    <div class="greet">OWN A RESTAURENT?  REGISTER IT HERE</div><hr>
                    <input class="input" type="text" name="hname" placeholder="Hotel Name..." required>
                    <input class="input" type="text" name="oname" placeholder="Owner Name..." required><br>
                    <input class="input" type="email" name="email" placeholder="Email..." required>
                    <input class="input" type="password" name="pwd" placeholder="Password..." required><br>
                    <input class="input" type="text" name="onumber" placeholder="Contact Number..." required>
                    <input class="input" type="text" name="address" placeholder="Address..." required>
                    <input class="input" type="text" name="city" placeholder="City..." required><br>
                    <input class="input" type="text" name="cost" placeholder="Approx cost for two...?" required>
                    <input class="input" type="text" name="start" placeholder="Opening time..." required>
                    <input class="input" type="text" name="end" placeholder="Closing Time..." required><br>
                    
                    <div class="buttons"><button class="button" type="submit" name="hotel">Sign Up</button></div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>