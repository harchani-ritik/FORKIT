<?php
    session_start();
    include 'db_connects.php';
    if(isset($_POST['login']))
    {
        
        $uid = mysqli_real_escape_string($conn, $_POST['lu']);
        $pwd = mysqli_real_escape_string($conn, $_POST['lp']);

        
            $sql= "SELECT * FROM hotel WHERE email='$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck < 1){
                header("Location: ../index.php?login=error?$uid+$pwd");
            }
            else{
                if($row = mysqli_fetch_assoc($result)){
                    
                    $hashedpasscheck = md5($pwd);
                    if($hashedpasscheck != $row['pwd'])
                    {
                        header("Location: ../index.php?login=wrongpass");
                    }
                    elseif ($hashedpasscheck == true)
                    {
                        $_SESSION['h_id'] = $row['id'];
                        $_SESSION['h_name'] = $row['hotelname'];
                        $_SESSION['o_name'] = $row['ownername'];
                        $_SESSION['h_email'] = $row['email'];
                        $_SESSION['h_pwd'] = $row['pwd'];
                        $_SESSION['h_number'] = $row['contact'];
                        $_SESSION['h_address'] = $row['addres'];
                        $_SESSION['h_city'] = $row['city'];
                        $_SESSION['h_cost'] = $row['cost'];
                        $_SESSION['h_token'] = $row['token'];
                        $_SESSION['h_approved'] = $row['approved'];
                        $_SESSION['h_claimed'] = $row['claimed'];
                        $_SESSION['h_hourstart'] = $row['hourstart'];
                        $_SESSION['h_hourend'] = $row['hourend'];
                        $_SESSION['h_hotelid'] = $row['hotelID'];
                        header("Location: ../hotelLogged/hotel.php");
                    }
                }
            }

        }