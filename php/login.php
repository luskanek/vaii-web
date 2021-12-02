<?php
    include("config.php");
            
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = mysqli_real_escape_string($connection, $_POST["input-login-mail"]);
        $password = mysqli_real_escape_string($connection, $_POST["input-login-pass"]);
                
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                
        $result = mysqli_query($connection, $query); 
                
        if (mysqli_num_rows($result) == 1)
        {  
            $row = mysqli_fetch_assoc($result);

            session_start();

            $_SESSION["user_active"] = true;
            $_SESSION["user_mail"] = $username;
            $_SESSION["user_first_name"] = $row["first_name"];
            $_SESSION["user_last_name"] = $row["last_name"];

            header("location: /account.php");
        }
        else
        {
            header("location: /login.php");
        }
    }
?>