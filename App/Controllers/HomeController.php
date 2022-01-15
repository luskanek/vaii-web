<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Models\Categories;

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
}