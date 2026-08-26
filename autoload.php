<?php

spl_autoload_register( function($nome_da_classe){
    
    $file = BASE_DIR . "/" . $nome_da_classe . ".php";

    if(file_exists($file)){
        include $file;
    }else{
        throw new Exception("Arquivo não encontrado!");
    }
} );