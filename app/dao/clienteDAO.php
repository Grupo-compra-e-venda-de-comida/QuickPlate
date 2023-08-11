<?php
include_once(__DIR__ . "/../connection/connection.php");
include_once(__DIR__ . "/../model/cliente.php");

class ClienteDAO {

//Método para inserir um Cliente
    public function insertClient(Cliente $cliente) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO cliente (cpf, id_usuario)" .
               " VALUES (:documentos, :id)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("documentos", $cliente->getDocumento());
        $stm->bindValue("id", $cliente->getIdUsuario());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM cliente WHERE id_usuario = :id_usuario";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_usuario", $id);
        $stm->execute();
    }

}