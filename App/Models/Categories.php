<?php

namespace App\Models;

class Categories extends \App\Core\Model
{
    public $id;
    public $name;
    public $description;
    public $icon;

    static public function setDbColumns()
    {
        return [ 'id', 'name', 'description', 'icon' ];
    }

    static public function setTableName()
    {
        return "categories";
    }
}

?>