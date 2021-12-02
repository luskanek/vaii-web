<?php
    include("config.php");

    session_start();

    $_SESSION["user_active"] = false;
    $_SESSION["user_mail"] = NULL;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($connection, $_POST["input-login-mail"]);
        $password = mysqli_real_escape_string($connection, $_POST["input-login-pass"]);

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM users WHERE username = '$username'";
                    
            $result = mysqli_query($connection, $query); 
                    
            if (mysqli_num_rows($result) == 1) {  
                $row = mysqli_fetch_assoc($result);

                if (password_verify($password, $row["password"])) {
                    $_SESSION["user_active"] = true;
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["user_mail"] = $username;
                    $_SESSION["user_first_name"] = $row["first_name"];
                    $_SESSION["user_last_name"] = $row["last_name"];

                    header("location: /account.php");
                }
                else {     
                    $_SESSION["error-message"] = "Zadali ste nesprávny email alebo heslo!";
                    header("location: /login.php");
                }
            }
        }
        else {
            $_SESSION["error-message"] = "Zadali ste email v neplatnom formáte!";
            header("location: /login.php");
        }
    }
?>