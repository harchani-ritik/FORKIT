<?php
    session_start();
    include 'signup/db_connect.php';
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forkit</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" >
    <link rel="stylesheet" href="assets/fonts/forkit/post-no-bills-jaffna-cufonfonts-webfont/style.css">

    

</head>
<body>
    <!-- landing page -->
    <div class="container-fluid landing">
        <div class="container land">
            <!-- header -->
            <header class="header">
                
                <!-- live location -->
                <div class="location">
                    <i class="fa fa-map-marker"></i>&nbsp;&nbsp; 
                    <span id="city"> </span>, 
                    <span id="country"></span>
                </div>
                
                <!-- login signup button for customer -->
                <div class="login">

                    <span id="in" >
                        <?php
                            if(!isset($_SESSION['u_name']))
                                echo "<a href='login/display.php' color='white'>SIGN IN</a>";
                            else
                                echo "<a href='logout/logout.php'>LOG OUT</a>";
                        ?>
                    </span>

                    <span id="out">
                        <?php
                            if(!isset($_SESSION["u_name"]))
                                echo "<a href='signup/display.php'>SIGN UP</a>";
                            else
                                echo $_SESSION['u_name'];
                        ?>                        
                            
                    </span>
                </div>

            </header>

            <!-- middle -->
            <div class="content">
                <div class="line"><span>FIND THE DISHES YOU LOVE AND KEEP</span> THE HUNGER AWAY</div>
                <form action="" method="POST">
                    <input class="search" type="search" name="search"><br>
                    <button class="search_button" type="submit" name="search">SEARCH</button>
                </form>
                <div class="logoName"><img src="assets/images/unnamed.png" alt="logo" class="logo"><span>FORKIT</span></div>
            </div>

        </div>
    </div>

    <!-- diplay of top hotels -->
    <div class="container-fluid here">
        <div class="container">
            <?php
                if(!isset($_POST['search'])){
                    $city = "Allahabad";
                    $sql= "SELECT * FROM hotel WHERE city = '$city' ORDER BY rating DESC";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck < 1){
                        echo "<div class='sorry'>Sorry no data found</div>";
                    }
                    else{
                        echo "<div class='head'>TOP HOTELS</div><hr><div class='holder'>";
                        $x = 0;
                        while ($row = mysqli_fetch_array($result)){
                            if($x == 6){
                                break;
                            }
                            $x += 1;
                            // card design
                            echo "
                                <div class='card'>
                                    <div class='pic'>
                                        
                                    </div>
                                    <div class='data'>
                                        <div class='actual'>
                                            <img src='assets/images/order.png' width='60px' height='60px' alt='kjhg'>
                                            <div class='hotelname'>$row[hotelname]</div>
                                            <div class='cost2'><u>Rs. $row[cost] for Two</u></div><hr>
                                            <div class='rate'>
                                            <span><span style='font-size:120%;color:yellow;'>&starf;</span>$row[rating]</span><span><i class='fa fa-map-marker'></i>  $row[city]</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            ";
                        }
                        echo "</div>";
                    }
                }
                else{
                    $city = mysqli_real_escape_string($conn, $_POST['search']);;
                    $sql= "SELECT * FROM hotel WHERE city = '$city' ORDER BY rating DESC";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck < 1){
                        echo "<div class='sorry'>Sorry no data found</div>";
                    }
                    else{
                        while ($row = mysqli_fetch_array($result)){
                            // card design
                            echo "
                                <div class='card'>
                                    <div class='pic'>
                                        
                                    </div>
                                    <div class='data'>
                                        <div class='actual'>
                                            <img src='assets/images/order.png' width='60px' height='60px' alt='kjhg'>
                                            <div class='hotelname'>$row[hotelname]</div>
                                            <div class='cost2'>Rs. $row[cost] for Two</div>
                                            <div class='rate'>
                                            <span>$row[rating]</span><span>$row[city]</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            ";
                        }
                    }
                }
            ?>

            <a class="view" href="listOfHotels/list.php">->VEIW ALL<-</a>

        </div>

    </div>
    
    <div class="container-fluid herealso here">
        <div class="container contaier">
                <div class="head">
                    Own a Restaurant...?? Register it Here!!
                </div>
                <div class="extra">
                    <div class="what"><span>What We Offer...??</span>
                        <ul>
                            <li>A Simple way to connect your Restaurant online</li>
                            <li>An eazy way to add or remove the items in your menu</li>
                            <li>On time pickup by our Experienced Valets</li>
                            <li>Can get Ratings for your Restaurant</li>
                        </ul>
                    </div>
                    <div class="press"><div>Register your Restaurent Here</div><button><a href="signup-hotel/display.php">Sign Up</a></button><div>Alregy registered...? Then Login Here</div><button><a href="loginhotel/display.php">Log In</a></button></div>
                </div>

        </div>
    </div>
    <br>


  

    <!-- <button><a href="listOfHotels/list.php">order here</a></button> -->
    
    





<!-- scripts using  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $.ajax({
            url: "https://geoip-db.com/jsonp",
            jsonpCallback: "callback",
            dataType: "jsonp",
            success: function( location ) {
                $('#country').html(location.country_name);
                //$('#state').html(location.state);
                $('#city').html(location.city);
                // var x = location.city;
                // var y = document.getElementById("loc").value = x;
                //$('#latitude').html(location.latitude);
                //$('#longitude').html(location.longitude);
                //$('#ip').html(location.IPv4);  
            }
        });
    </script>
        
       
    

</body>
</html>