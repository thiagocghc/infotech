<?php

spl_autoload_register( function($classe){
    
    $file = BASE_DIR . "/" . $classe . ".php";

    if(file_exists($file)){
        include $file;
    }else{
        throw new Exception("Arquivo não encontrado!");
    }
} );