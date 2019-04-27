<?php
    session_start();
    include 'db_connect.php';
    if(isset($_POST['login']))
    {
        
        $uid = mysqli_real_escape_string($conn, $_POST['lu']);
        $pwd = mysqli_real_escape_string($conn, $_POST['lp']);

        
            $sql= "SELECT * FROM users WHERE email='$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck < 1){
                header("Location: ../index.php?login=error");
                exit();
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
                        $_SESSION['u_id'] = $row['id'];
                        $_SESSION['u_name'] = $row['username'];
                        $_SESSION['u_email'] = $row['email'];
                        $_SESSION['u_verified'] = $row['verified'];
                        $_SESSION['u_number'] = $row['number'];
                        header("Location: ../index.php?login=sucess?$_SESSION[u_name]");
                    }
                }
            }

        }