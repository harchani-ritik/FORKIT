<?php
session_start();
include 'db_connects.php';
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FORKIT HOTELS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="assets/fonts/forkit/post-no-bills-jaffna-cufonfonts-webfont/style.css">

</head>

<body>

    <div class="container-fluid">
        <header class="header">
            <!-- live location -->
            <div class="location">
                <i class="fa fa-map-marker"></i>&nbsp;&nbsp;
                <span id="city"> </span>,
                <span id="country"></span>
            </div>
            <input class="search" type="search" name="search"><br>
            <button class="search_button">SEARCH</button>
            <!-- login signup button for customer -->
            <div class="login">

<span id="in" >
    <?php
        if(!isset($_SESSION['u_name']))
            echo "<a href='../login/display.php' color='white'>SIGN IN</a>";
        else
            echo "<a href='../logout/logout.php'>LOG OUT</a>";
    ?>
</span>

<span id="out">
    <?php
        if(!isset($_SESSION["u_name"]))
            echo "<a href='../signup/display.php'>SIGN UP</a>";
        else
            echo $_SESSION['u_name'];
    ?>                        
        
</span>
</div>
        </header>

        <div class="display">
            <div class="filter">
                <div> </div>
            </div>
            <div class="hotels container">
                <?php
                $sql = "SELECT * FROM hotel WHERE approved = 1 and claimed = 1";
                $result = mysqli_query($conn, $sql);
                $resultsCheck = mysqli_num_rows($result);
                $row = array();
                if ($resultsCheck == 0) {
                    echo "<h1 class='sry'>Oh! All restaurants are currently unserviceable</h1>";
                } else {
                    // $results = mysqli_query($conn, $sql);
                    $x = 1;
                    echo "<div class='row'>";
                    while ($row = mysqli_fetch_array($result)) {
                            
                            if($x % 2 == 1){
                                echo "<br>";
                            }
                            echo "
                                <div class='card col-xs-6 col-sm-6 col-md-6 col-lg-6'> 
                                    <div class='upper'>
                                        <div class='image'>
                                            
                                        </div>
                                        <div class='content'>
                                            <div class='name'>$row[hotelname]</div>
                                            <div class='address'>$row[addres], $row[city]</div><br>
                                            <div class='cost'><span class='left'>COST FOR TWO:</span> <span class='right'> $$row[cost]</span></div>
                                            <div class='hour'><span class='left'>HOURS:</span> <span class='right'>$row[hourstart]-$row[hourend]</span></div>
                                        </div>
                                    </div>
                                    <div class='lower'>
                                        <button class='call'>Call</button>
                                        <button class='order'> <a href='../order/order.php?id=$row[hotelID]'>Order Now </a> </button>
                                    </div>
                                </div> ";

                                // if ($x % 2 == 1){
                                //     echo "</div>";
                                // }
                                $x = $x + 1; 
                            
                        }
                   
                }
                ?>
            </div>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $.ajax({
            url: "https://geoip-db.com/jsonp",
            jsonpCallback: "callback",
            dataType: "jsonp",
            success: function(location) {
                $('#country').html(location.country_name);
                //$('#state').html(location.state);
                $('#city').html(location.city);
                //$('#latitude').html(location.latitude);
                //$('#longitude').html(location.longitude);
                //$('#ip').html(location.IPv4);  
            }
        });
    </script>
</body>

</html>