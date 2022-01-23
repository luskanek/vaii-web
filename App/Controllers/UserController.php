<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Request;
use App\Core\Responses\ViewResponse;
use App\Models\Users;
use App\Models\Items;
use App\Models\Reviews;

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

        $user = Users::getOne("id", $_SESSION["user"]);
        return new ViewResponse("User/account", $user);
    }

    public function profile()
    {
        $reqv = new Request();
        $id = $reqv->getValue("p");
        if (empty($id)) 
        {
            return new ViewResponse("Home/index", NULL);
        }
        else
        {
            $user = Users::getOne("id", $id);
            return new ViewResponse("User/profile", $user);
        }
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();

        $username = $reqv->getValue("input-login-mail");
        $user = Users::getOne("username", $username);
        if ($user)
        {
            $pass = $reqv->getValue("input-login-pass");
            if (password_verify($pass, $user->password)) 
            {
                $_SESSION["user"] = $user->id;
                return new ViewResponse("User/account", $user);
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
        return new ViewResponse("Home/index", NULL);
    }

    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();

        $username = $reqv->getValue("input-register-mail");
        if (!filter_var($username, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION["error-message"] = "Zadaný email je v neplatnom formáte!";
            return new ViewResponse("User/registration", NULL);
        }

        if (Users::getOne("username", $username))
        {
            $_SESSION["error-message"] = "Zadaný email je už zaregistrovaný!";
            return new ViewResponse("User/registration", NULL);
        }

        $pass = $reqv->getValue("input-register-pass");
        $conf = $reqv->getValue("input-register-conf");
        if (strlen($pass) < 8)
        {
            $_SESSION["error-message"] = "Zadané heslo musí mať minimálne 8 znakov!";
            return new ViewResponse("User/registration", NULL);
        }

        if ($pass != $conf)
        {
            $_SESSION["error-message"] = "Zadané heslá sa nezhodujú!";
            return new ViewResponse("User/registration", NULL);
        }

        $name = $reqv->getValue("input-register-fname") . " " . $reqv->getValue("input-register-lname");

        $user = new Users();
        $user->username = $username;
        $user->password = password_hash($pass, PASSWORD_DEFAULT);
        $user->name = $name;
        $user->phone = $reqv->getValue("input-register-phone");
        $user->save();

        $_SESSION["user"] = $user->id;

        return new ViewResponse("User/account", $user);
    }
    

    public function getUserDetails()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();
        $user = Users::getOne("id", $reqv->getValue("p"));
        return $this->json($user);
    }

    public function getUserItems()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();
        $user = Users::getOne("id", $reqv->getValue("p"));
        $items = Items::getAll("author=?", array($user->id));
        return $this->json($items);
    }

    public function getUserReviews()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();
        $user = Users::getOne("id", $reqv->getValue("p"));
        $items = Reviews::getAll("target=?", array($user->id));
        return $this->json($items);
    }

    public function updatePhone()
    {
        $reqv = new Request();
        $user = Users::getOne("id", $reqv->getValue("u"));
        $user->phone = $reqv->getValue("p");
        $user->save();
    }

    public function submit()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();

        $author = $_SESSION["user"];
        $target = $reqv->getValue("review-id");

        if ($author == $target)
        {
            $_SESSION["error-message"] = "Zadané heslá sa nezhodujú!";
            return new ViewResponse("User/profile", Users::getOne("id", $target));
        }

        $content = $reqv->getValue("review-content");

        $review = new Reviews();
        $review->author = $author;
        $review->target = $target;
        $review->content = $content;
        $review->save();

        return new ViewResponse("User/profile", Users::getOne("id", $target));
    }
}