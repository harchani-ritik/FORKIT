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
    <title><?php echo $_SESSION['h_name']?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" >
    <link rel="stylesheet" href="assets/fonts/forkit/post-no-bills-jaffna-cufonfonts-webfont/style.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['h_name']))
            header("Location: ../index.php");
        else{
    ?>
            <div class="container-fluid heading">    
                
                <div class="container">
                        <header class="header">
                            <div class="website" font-family="Post No Bills Jaffna Regular"> <img src="../assets/images/unnamed.png" width="70px" height="70px" alt=""> FORKIT</div>
                            <div class="log"> 
                                <?php
                                    echo "<span id='in'><a id='in' href='../logout/logout.php'>Log Out</a></span>";
                                    echo "<span id='out'>$_SESSION[h_name]</span>"
                                ?>
                            </div>
                        </header>
            
                </div>
            </div>
            <div class="container-fluid">
                <div class="container">
                    <div class="content">
                        <div class="main">
                            <div class="address">
                                <div class="loc">ORDER FOOD ONLINE FROM</div>
                                <?php 
                                    echo "<div class='hname'>$_SESSION[h_name]</div>";
                                    echo "<div class='loc'>$_SESSION[h_address], $_SESSION[h_city]</div>";
                                    echo "<div class='cost'>COST FOR TWO : $_SESSION[h_cost]</div>";
                                ?>
                            </div>
                            <div class="list">
                            <?php
                            $type = array('bestseller', 'Thali', 'Starter', 'Main Course', 'Breads', 'Rice And Biriyani');

                            for($i=0; $i<count($type); $i += 1){
                                $sql1= "SELECT * FROM $_SESSION[h_hotelid] WHERE category='$type[$i]' and veg='veg'";
                                $result1 = mysqli_query($conn2, $sql1);
                                $resultCheck1 = mysqli_num_rows($result1);
                                if($resultCheck1 < 1){
                                    
                                }
                                else{
                                    echo "<div class='category'>$type[$i]</div><div class='type'>Veg</div>";
                                    while($row1 = mysqli_fetch_array($result1)){
                                        echo "

                                            <div class='food'><img src='../assets/images/veg.svg' width='20px' height='20px'>&nbsp&nbsp&nbsp$row1[food]
                                            </div>
                                            <div class='price'>Rs $row1[price]</div>
                                          
                                        ";
                                    }
                                }
                                $sql1= "SELECT * FROM $_SESSION[h_hotelid] WHERE category='$type[$i]' and veg='nonveg'";
                                $result1 = mysqli_query($conn2, $sql1);
                                $resultCheck1 = mysqli_num_rows($result1);
                                if($resultCheck1 < 1){
                                    
                                }
                                else{
                                    echo "<div class='type'>Non-Veg</div>";
                                    while($row1 = mysqli_fetch_array($result1)){
                                        echo "
                                            <div class='food'><img src='../assets/images/images.png' width='20px' height='20px'>&nbsp&nbsp&nbsp$row1[food] 
                                            </div>
                                            <div class='price'>Rs $row1[price]</div>
                                            
                                        ";
                                    }
                                }
                            }
                        ?>
                    </div>

                        </div>
                        <div class="add">
                            <div class="greet">Add More Food To The Menu</div>
                            <form action="submit.php" method="POST">
                                <select class="best input" name="category" required>
                                    <option value="bestseller">BestSeller</option>
                                    <option value="starter">Starter</option>
                                    <option value="main">Main-Course</option>
                                </select>
                                <select class="veg input" name="type" required>
                                    <option value="veg">Veg</option>
                                    <option value="nonveg">Non-Veg</option>
                                </select>
                                <input class="input" type="text" name="food" placeholder="Food Name..." required>
                                <input class="input" type="text" name="price" placeholder="Price of Food..." required>
                                <button class="itsbutton" type="submit" name="add">Add it on Menu</button>
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