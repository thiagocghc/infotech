<?php

namespace InfoTech\Controller;

class InicioController
{
    public static function index()
    {
        include VIEW . '/inicial/index.php';
    }

    public static function notFound()
    {
        include VIEW . '/notfound/notfound.php';
    }
}