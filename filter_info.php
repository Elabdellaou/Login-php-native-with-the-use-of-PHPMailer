<?php
class filter_info
{
    function __construct()
    {
    }
    function filter_information(...$inf)
    {
        foreach ($inf as $value) {
            $value = trim($value);
            $value = strip_tags($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
        }
    }
}
