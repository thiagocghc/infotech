<?php

namespace InfoTech\DAO;

use InfoTech\Model\Funcionario;

class LoginDAO extends DAO 
{
    public function __construct(){
        
        parent::__construct();
    }

    public function auth(Funcionario $model)
    {
        $sql = "SELECT * FROM funcionario WHERE email=? AND senha=?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $model->email);
        $stmt->bindValue(2, $model->senha);
        $stmt->execute();

        // print_r($stmt->fetchObject(Funcionario::class));
        // exit;
        return $stmt->fetchObject(Funcionario::class);
    }

}

