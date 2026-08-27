<?php

namespace InfoTech\DAO;

use InfoTech\Model\Cliente;

class ClienteDAO extends DAO 
{
    public function __construct(){
        
        parent::__construct();
    }

    public function save(Cliente $model)
    {
        return ($model->id_cliente == null) ? $this->insert($model) : $this->update($model);
    }

    public static function select()
    {
        $sql = "SELECT * FROM cliente";
        $stmt = parent::$connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "InfoTech\Model\Cliente");
    }

    public static function selectById(int $id)
    {
        $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject(Cliente::class);
    }

    public function insert(Cliente $model)
    {
        $sql = "INSERT INTO cliente (nome,status_cliente,telefone,email) VALUES (?,?,?,?)";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->status_cliente);
        $stmt->bindValue(3, $model->telefone);
        $stmt->bindValue(4, $model->email);
        $stmt->execute();

        $model->id_cliente = parent::$connection->lastInsertId();
        return $model;
    }

    public function update(Cliente $model)
    {
        $sql = "UPDATE cliente SET nome=?, status_cliente=?, telefone=?, email=? 
                WHERE id_cliente =?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->status_cliente);
        $stmt->bindValue(3, $model->telefone);
        $stmt->bindValue(4, $model->email);
        $stmt->bindValue(5, $model->id_cliente);
        
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM cliente WHERE id_cliente =?";
        $stmt = parent::$connection->prepare($sql);
        $stmt->bindValue(1, $id);
        
        return $stmt->execute();
    }



}

