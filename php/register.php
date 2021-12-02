<?php
    include("config.php");
            
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $first_name = mysqli_real_escape_string($connection, $_POST["input-register-fname"]);
        $last_name = mysqli_real_escape_string($connection, $_POST["input-register-lname"]);
        $username = mysqli_real_escape_string($connection, $_POST["input-register-mail"]);
        $password = mysqli_real_escape_string($connection, $_POST["input-register-pass"]);
        $confirm = mysqli_real_escape_string($connection, $_POST["input-register-confirm"]);
        
        if ($password == $confirm) {
            $query = "INSERT INTO users (username, password, first_name, last_name) VALUES ('$username', '$password', '$first_name', '$last_name')";

            if (mysqli_query($connection, $query)) {
                session_start();

                $_SESSION["user_active"] = true;
                $_SESSION["user_mail"] = $username;
                $_SESSION["user_first_name"] = $first_name;
                $_SESSION["user_last_name"] = $last_name;

            header("location: /account.php");
            }
        }
    }
?>