<?php

namespace App\Models;

class Users extends \App\Core\Model
{
    public $id;
    public $username;
    public $password;
    public $name;
    public $phone;

    static public function setDbColumns()
    {
        return [ 'id', 'username', 'password', 'name', 'phone'];
    }

    static public function setTableName()
    {
        return "users";
    }
}

?>