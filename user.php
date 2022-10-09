<?php

class user
{
    private $fullname, $email, $password, $image, $id;
    function __construct($f = null, $e = null, $p = null, $i = null, $id = null)
    {
        $this->id = $id;
        $this->image = $i;
        $this->fullname = $f;
        $this->email = $e;
        $this->password = $p;
    }
    function getFullname()
    {
        return $this->fullname;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getPassword()
    {
        return $this->password;
    }
    function setFullname($newf)
    {
        $this->fullname = $newf;
    }
    function setEmail($newe)
    {
        $this->email = $newe;
    }
    function setPassword($newp)
    {
        $this->password = $newp;
    }
    function getImage()
    {
        return $this->image;
    }
    function setImage($newi)
    {
        $this->image = $newi;
    }
    function setId($newid)
    {
        $this->id = $newid;
    }
    function getId()
    {
        return $this->id;
    }
}
