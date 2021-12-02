<?php
    include("config.php");

    session_start();

    $_SESSION["user_active"] = false;
    $_SESSION["user_mail"] = NULL;

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $first_name = mysqli_real_escape_string($connection, $_POST["input-register-fname"]);
        $last_name = mysqli_real_escape_string($connection, $_POST["input-register-lname"]);
        $username = mysqli_real_escape_string($connection, $_POST["input-register-mail"]);
        $password = mysqli_real_escape_string($connection, $_POST["input-register-pass"]);
        $confirm = mysqli_real_escape_string($connection, $_POST["input-register-confirm"]);

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            if (strlen($password) > 8) { 
                if ($password == $confirm) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (username, password, first_name, last_name) VALUES ('$username', '$hash', '$first_name', '$last_name')";

                    if (mysqli_query($connection, $query)) {
                        $_SESSION["user_active"] = true;
                        $_SESSION["user_id"] = $row["id"];
                        $_SESSION["user_mail"] = $username;
                        $_SESSION["user_first_name"] = $first_name;
                        $_SESSION["user_last_name"] = $last_name;

                        header("location: /account.php");
                    }
                }
                else {
                    $_SESSION["error-message"] = "Zadané heslá sa nezhodujú!";
                    header("location: /login.php?new_user");
                }
            }
            else {
                $_SESSION["error-message"] = "Zadané heslo musí mať viac ako 8 znakov!";
                header("location: /login.php?new_user");
            }
        }
        else {
            $_SESSION["error-message"] = "Zadali ste email v neplatnom formáte!";
            header("location: /login.php?new_user");
        }
    }
?>