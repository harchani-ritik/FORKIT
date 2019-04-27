<?php
    session_start();
    include 'db_connects.php';
    include 'db2_connects.php';

    if(isset($_POST['add'])){
        $category = mysqli_real_escape_string($conn2, $_POST['category']);
        $veg = mysqli_real_escape_string($conn2, $_POST['type']);
        $food = mysqli_real_escape_string($conn2, $_POST['food']);
        $price = mysqli_real_escape_string($conn2, $_POST['price']);

        $sql = "SELECT * FROM $_SESSION[h_hotelid] WHERE category = '$category' and veg = '$veg' and food = '$food' and price = '$price' ";
        $results = mysqli_query($conn2, $sql);
        $resultsCheck = mysqli_num_rows($results);

        if($resultsCheck > 0){
            header("Location: hotel.php?foodexsit");
        }
        else{
            
            $sql = "INSERT INTO $_SESSION[h_hotelid] (category, veg, food, price) 
                    VALUES ('$category', '$veg', '$food', '$price');";
            mysqli_query($conn2, $sql);
            header("Location: hotel.php?$food=addedSuccessfully");
            
        }
    }