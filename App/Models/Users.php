<?php

namespace App\Models;

class Users extends \App\Core\Model
{
    public $id;
    public $username;
    public $password;
    public $name;

    static public function setDbColumns()
    {
        return [ 'id', 'username', 'password', 'name' ];
    }

    static public function setTableName()
    {
        return "users";
    }

    public function getName()
    {
        return $this->name;
    }
}

?>