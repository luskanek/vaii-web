<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Request;
use App\Models\Categories;
use App\Models\Items;
use App\Models\Users;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    public function index()
    {
        return $this->html();
    }

    public function getAllCategories()
    {
        $categories = Categories::getAll();
        return $this->json($categories);
    }

    public function getItemsInCategory()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $reqv = new Request();
        $items = Items::getAll("category=?", array($reqv->getValue("p")));
        
        return $this->json($items);
    }
}