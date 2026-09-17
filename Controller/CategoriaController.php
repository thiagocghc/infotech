<?php

namespace InfoTech\Controller; //local onde se encontra a classe Categoria
use InfoTech\Model\Categoria; // irei utilizar a model de categoria

//Esta CLASSE só responde em JSON 

class CategoriaController extends Controller
{

        public static function listar()
        {
            try
            {
                $model = new Categoria();
                $categorias =  $model->getAllRows();

                //SELECT * FROM CATEGORIA  8 CAMPOS
                // monta só os campos que o select precisa
                $categorias = array_map(fn($categoria) => [
                    'id_categoria' => $categoria->id_categoria,
                    'nome'         => $categoria->nome,
                ], $model->rows);

                $result = ['status' => 200, 'data' => $categorias];

            }
            catch(\Throwable  $e)
            {
                $result = ['status' => 400, 'msg' => 'erro ao tentar consultar a categoria'];
            }

            parent::jsonResponse($result);

        }

        public static function cadastro()
        {
            $model = new Categoria();
            $model->id_categoria = null;
            $model->nome = $_POST['nome'];
            $model->descricao = $_POST['descricao'];

            if($model->nome === '')
            {
                $array = [ 'status' => 400, 'msg' => 'Informe o nome da categoria' ];
                parent::jsonResponse($array);
            }

            try
            {
                $model->save();
                $result = [
                    'status' => 200,
                    'msg' => 'Cadastrado com sucesso',
                    'id_categoria' => $model->id_categoria
                ];
            }
            catch(\PDOException $e)
            {
                $result =  [
                    'status' => 500,
                    'msg' => 'Erro ao cadastrar ao '
                ];
            }

            parent::jsonResponse($result);
        }

}
