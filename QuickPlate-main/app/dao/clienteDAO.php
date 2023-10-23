<?php
//session_start();

include_once(__DIR__ . "/../connection/connection.php");
include_once(__DIR__ . "/../model/cliente.php");
include_once(__DIR__ . "/../util/config.php");

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

    //Método para encontrar o Cliente pelo seu ID
    public function findClientId(){

        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];


        $conn = Connection::getConn();

        $sql = "SELECT id_cliente FROM cliente c" .
            " WHERE c.id_usuario = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario]);
        $result = $stm->fetchAll();

        $id = print_r($result[0]);

        return $id;
    }

    //Encontra o 'nome' do Cliente
    public function findClientName($idCliente){

        $conn = Connection::getConn();

        $sql = "SELECT nome FROM usuario u" .
            " WHERE u.id_usuario = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idCliente]);
        $result = $stm->fetchAll();

        $id = print_r($result[0]);

        return $id;
    }

}