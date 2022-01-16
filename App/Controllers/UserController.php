<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Request;
use App\Core\Responses\ViewResponse;
use App\Models\Users;
use App\Models\Items;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends AControllerBase
{
    public function index()
    {
        return $this->html();
    }

    public function registration()
    {
        return $this->html();
    }

    public function account()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION["user"])) {
            return new ViewResponse("User/index", NULL);
        } 
        else 
        {
            $user = Users::getOne("username", $_SESSION["user"]);
            return $this->html($user);
        }
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();

        $username = $reqv->getValue("input-login-mail");
        if (Users::getOne("username", $username))
        {
            $pass = $reqv->getValue("input-login-pass");
            $conf = Users::getOne("username", $username);
            
            if (password_verify($pass, $conf->password)) 
            {
                $_SESSION["user"] = $username;
 
                return new ViewResponse("User/account", NULL);
            }
            else 
            {
                $_SESSION["error-message"] = "Nesprávny účet alebo heslo!";
                return new ViewResponse("User/index", NULL);
            }
        }
        else 
        {
            $_SESSION["error-message"] = "Nesprávny účet alebo heslo!";
            return new ViewResponse("User/index", NULL);
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();

        return new ViewResponse("User/index", NULL);
    }

    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();

        $username = $reqv->getValue("input-register-mail");
        if (!filter_var($username, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION["error-message"] = "Neplatný email!";
            return new ViewResponse("User/registration", NULL);
        }

        if (Users::getOne("username", $username))
        {
            $_SESSION["error-message"] = "Účet už existuje!";
            return new ViewResponse("User/registration", NULL);
        }

        $pass = $reqv->getValue("input-register-pass");
        $conf = $reqv->getValue("input-register-conf");
        if (strlen($pass) < 8)
        {
            return new ViewResponse("User/registration", NULL);
        }

        if ($pass != $conf)
        {
            return new ViewResponse("User/registration", NULL);
        }

        $name = $reqv->getValue("input-register-fname") . " " . $reqv->getValue("input-register-lname");

        $user = new Users();
        $user->username = $username;
        $user->password = password_hash($pass, PASSWORD_DEFAULT);
        $user->name = $name;
        $user->save();

        $_SESSION["user"] = $username;
 
        return new ViewResponse("User/account", NULL);
    }
    
    public function getUserItems()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $user = Users::getOne("username", $_SESSION["user"]);
        
        $items = Items::getAll("author=?", array($user->id));
        return $this->json($items);
    }
}