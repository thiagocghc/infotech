<?php

namespace InfoTech\Controller;

use InfoTech\Model\Funcionario;

class LoginController extends Controller
{

    public static function index()
    {
        $model = new Funcionario();
        if(parent::isPost())
        {
            $model->email = $_POST['email'];
            $model->senha = $_POST['senha'];
            $usuario_logado = $model->logar();
            // var_dump($model->logar());
            // exit;
            if($usuario_logado === false){
                parent::redirect('/infotech/login');
            }
            else{
                $_SESSION['usuario_logado'] = $usuario_logado;
                parent::redirect('/infotech/cliente/listar'); ## REDIRECIONAR DASHBOARD
            }
        
        }
        parent::render('/Login/form_login.php', $model);
    }

    public static function logout()
    {
        session_destroy();
        parent::redirect('/infotech/login');
    }
}