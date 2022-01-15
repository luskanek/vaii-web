<?php

namespace App\Controllers;

use App\Core\AControllerBase;

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
}