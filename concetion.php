<?php

use function PHPSTORM_META\type;

require 'user.php';
require 'filter_info.php';
class conect
{
    private $con;
    function __construct()
    {
    }
    function Connection()
    {
        $this->con = new mysqli("127.0.0.1", "root", "", "login");
    }
    function getConnection(): mysqli
    {
        return $this->con;
    }
    function insert(user $o)
    {
        $inser = "insert into loginin(email,password,Nom,Image) values('" . $o->getEmail() . "','" . $o->getPassword() . "','" . $o->getFullname() . "','" . $o->getImage() . "')";
        $this->con->query($inser);
    }
    function select()
    {
        $select = "select * from loginin";
        return $this->con->query($select);
    }
    function update(user $o)
    {
        $update = "update loginin set Image='" . $o->getImage() . "' where id='" . $o->getId() . "'";
        $this->con->query($update);
    }
}
