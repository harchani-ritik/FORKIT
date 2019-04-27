<?php
    session_start();
    include 'db_connects.php';
    include 'db2_connects.php';
    include 'db3_connects.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
            $sql = "SELECT * FROM hotel WHERE hotelID = '$_GET[id]'";
            $row = array();
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            echo $row['hotelname'];
        ?>
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" >
    <link rel="stylesheet" href="assets/fonts/forkit/post-no-bills-jaffna-cufonfonts-webfont/style.css">

</head>
<body>

    <?php
        if( isset($_SESSION['u_id']) ){
    ?>

    <header>
            <div class="contain">
                <div class="logo"><img src="../assets/images/unnamed.png" alt="logo" width="60px" height="60px"> <span>FORKIT</span></div>
                <div class="signout">
                    <span class="logout" id="in"><a href="../logout/logout.php">Log Out</a></span> <span class="profile" id="out">
                        <?php echo "$_SESSION[u_name]"; ?>
                    </span>
                </div>
            </div>
        
    </header>
            <form method="POST">
            <div class="contain">
                <div class="details">
                    
                    <div class="address">
                        <?php
                            echo "<div class='hname'>$row[hotelname]</div>";
                            echo "<div class='loc'>$row[addres], $row[city]</div>";
                            echo "<div class='cost'>Cost for Two : $row[cost]</div><hr>";
                            echo "
                                <div class='buttons'>
                                    <button>CALL</button>
                                    <button type='submit' name='submit'>PLACE ORDER</button>
                                </div>
                            ";
                        ?>
                    </div>
                    <div class="list">
                        <?php
                            $type = array('bestseller', 'Thali', 'Starter', 'Main Course', 'Breads', 'Rice And Biriyani');

                            for($i=0; $i<count($type); $i += 1){
                                $sql1= "SELECT * FROM $_GET[id] WHERE category='$type[$i]' and veg='veg'";
                                $result1 = mysqli_query($conn2, $sql1);
                                $resultCheck1 = mysqli_num_rows($result1);
                                if($resultCheck1 < 1){
                                    
                                }
                                else{
                                    echo "<div class='category'>$type[$i]</div><div class='type'>Veg</div>";
                                    while($row1 = mysqli_fetch_array($result1)){
                                        echo "

                                            <div class='food'><img src='../assets/images/veg.svg' width='20px' height='20px'>&nbsp&nbsp&nbsp$row1[food]
                                            <span class='quantity'><input class='add' type='number' name='$row1[food]' value='0' min='0'></span></div>
                                            <div class='price'>Rs $row1[price]</div>
                                          
                                        ";
                                    }
                                }
                                $sql1= "SELECT * FROM $_GET[id] WHERE category='$type[$i]' and veg='nonveg'";
                                $result1 = mysqli_query($conn2, $sql1);
                                $resultCheck1 = mysqli_num_rows($result1);
                                if($resultCheck1 < 1){
                                    
                                }
                                else{
                                    echo "<div class='type'>Non-Veg</div>";
                                    while($row1 = mysqli_fetch_array($result1)){
                                        echo "
                                            <div class='food'><img src='../assets/images/images.png' width='20px' height='20px'>&nbsp&nbsp&nbsp$row1[food] 
                                            <span class='quantity'><input class='add' type='number' name='$row1[food]' value='0' min='0'></span></div>
                                            <div class='price'>Rs $row1[price]</div>
                                            
                                        ";
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
                        </form>
            
                <div class="order">
                <form method="POST">
                        <div class="gyan">
                            Press the Place Order button to see or update your order...<hr>
                        </div>
                            <?php
                                
                                if(isset($_POST['submit'])){
                                    $sql1= "SELECT * FROM $_GET[id]";
                                    $result1 = mysqli_query($conn2, $sql1);
                                    $resultCheck1 = mysqli_num_rows($result1);
                                    if($resultCheck1 < 1){
                                    
                                    }
                                    else{
                                        $foodname = array();
                                        $costarray = array();
                                        $Amount = array();
                                        while($row1 = mysqli_fetch_array($result1)){
                                            $food = $_POST[$row1['food']];
                                            if($food == 0){

                                            }
                                            else{
                                                $cost = $food * $row1['price'];
                                                echo "<div class='det'><span text-align='left'>$row1[food]</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <span text-align='right'>$food x Rs $row1[price]</span></div>";
                                                array_push($foodname, $row1['food']);
                                                array_push($costarray, $cost);
                                                array_push($Amount, $food);
                                                
                                            }
                                        }
                                        $total = 0;
                                        for($j=0; $j<count($costarray); $j+=1){
                                            $total = $total + $costarray[$j];
                                        }
                                        echo "<hr><div class='total'>TOTAL : $total</div>";
                                        
                                        echo "<form method='POST' action='place.php'><button class='confirm' type='submit' name='confirm'>Confirm Order</button></form>";
                                        
                                    }
                                    
                                }    


                            ?>
                            </form>
                        </div>

                </div>
            </div>


    <?php
        }
        else{
            header("Location: ../login/display.php");
        }
    ?>

</body>
</html>