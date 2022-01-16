<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Request;
use App\Core\Responses\ViewResponse;
use App\Models\Items;
use App\Models\Users;

/**
 * Class EditorController
 * @package App\Controllers
 */
class EditorController extends AControllerBase
{
    public function index()
    {
        return $this->html();
    }

    public function submit()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();

        $author = Users::getOne("username", $_SESSION["user"]);
        $title = $reqv->getValue("input-new-title");
        $category = $reqv->getValue("select-new-category");
        $description = $reqv->getValue("input-new-desc");
        $price = $reqv->getValue("input-new-price");
        
        if (!isset($title) || empty($title))
        {
            $_SESSION["error-message"] = "Názov inzerátu musí byť vyplnený!";
            return new ViewResponse("Editor/index", NULL);
        }

        if (!isset($description) || empty($description))
        {
            $_SESSION["error-message"] = "Popis inzerátu musí byť vyplnený!";
            return new ViewResponse("Editor/index", NULL);
        }

        if (!isset($price) || empty($price))
        {
            $_SESSION["error-message"] = "Cena inzerátu musí byť vyplnená!";
            return new ViewResponse("Editor/index", NULL);
        }


        $files = "";

        foreach($_FILES["files"]["name"] as $key=>$val) 
        {
            $file_name = basename($_FILES["files"]["name"][$key]);
            $file_path = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file_name;

            if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $file_path)) 
            {
                $files .= $file_name . ";";
            }
        }
        
        $item = new Items();
        $item->author = $author->id;
        $item->title = $title;
        $item->category = $category;
        $item->description = $description;
        $item->price = $price;
        $item->files = $files;
        $item->save();

        return new ViewResponse("User/account", NULL);
    }   

    public function delete()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();
        Items::getOne("id", $reqv->getValue("p"))->delete();

        return new ViewResponse("User/account", NULL);
    }
}