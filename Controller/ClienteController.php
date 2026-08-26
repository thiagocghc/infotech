<?php

namespace InfoTech\Controller; //local onde se encontra a classe ClienteController

use InfoTech\Model\Cliente; // irei utilizar a model de cliente

class ClienteController
{

    public static function index() //TODOS OS CLIENTES
    {
        $dadosClientes = Cliente::getAllRows(); //pega os dados da model
        include VIEW . '/Cliente/listar_clientes.php';
    }

    public static function cadastro() //ENVIAR OS DADOS RECEBIDOS VIA POST
    {     
        $model = new Cliente();
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            $model->id_cliente = !empty($_POST['id_cliente']) ? $_POST['id_cliente'] : null;
            $model->nome = $_POST['nome'];
            $model->status_cliente = $_POST['status_cliente'];
            $model->telefone = $_POST['telefone'];
            $model->email = $_POST['email'];
            // print_r($model);
            // exit;
            $model = $model->save();
            if($model){
                header("Location: /infotech/cliente/listar");
            }
        }
        else{
            if(isset($_GET['id_cliente'])){

                 $id = $_GET['id_cliente']; //captura o id que veio via GET
                 $model = Cliente::getById($id); // solicita ao banco o cliente com esse id 
                //  print_r($model);
                //  exit;
            }
            include VIEW . '/Cliente/cadastrar_cliente.php';
        }

    }
}