<?php

namespace App\Models;

class Items extends \App\Core\Model
{
    public $id;
    public $author;
    public $title;
    public $category;
    public $description;
    public $price;
    public $files;

    static public function setDbColumns()
    {
        return [ 'id', 'author', 'title', 'category', 'description', 'price', 'files' ];
    }

    static public function setTableName()
    {
        return "items";
    }
}

?>