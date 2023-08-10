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

}