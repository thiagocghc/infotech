<?php

namespace InfoTech\Controller;

class InicioController extends Controller
{
    public static function index()
    {
        include VIEW . '/inicial/index.php';
    }

    public static function notFound()
    {
        parent::redirect('/notfound/notfound.php');
    }
}