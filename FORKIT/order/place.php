<?php
    session_start();
    include 'db_connects.php';
    include 'db2_connects.php';
    include 'db3_connects.php';
    if(isset($_POST['confirm'])){
        $orderid = uniqueid();
        $sql3= "CREATE TABLE IF NOT EXISTS $uniqueid (
                food VARCHAR(255) NOT NULL,
                cost int(11) NOT NULL,
                userid VARCHAR(255) NOT NULL,
                hotelid VARCHAR(255) NOT NULL,
                accepted tinyint NOT NULL,
                dispatched tinyint NOT NULL,
                delivered tinyint NOT NULL
        )";
        mysqli_query($conn3, $sql3);
        
        for($j=0; $j<count($costarray); $j+=1){
            $sql3 = "INSERT INTO $orderid (food, cost, userid, hotelid, accepted, dispatched, delivered) 
            VALUES ('$foodname[$j]', '$costarray[$j]', '$_SESSION[u_id]', '$_GET[id]', 0, 0, 0);";
            mysqli_query($conn3, $sql3);
        }
        header("Location: ../orderplaced/placedorder.php");
    }
?>