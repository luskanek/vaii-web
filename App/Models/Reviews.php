<?php

namespace App\Models;

class Reviews extends \App\Core\Model
{
    public $id;
    public $author;
    public $target;
    public $content;

    static public function setDbColumns()
    {
        return [ 'id', 'author', 'target', 'content' ];
    }

    static public function setTableName()
    {
        return "reviews";
    }
}

?>