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

        if($result)
            return $result[0]['id_cliente'];

        return 0; //Retorna 0, pois nao ha cliente com este ID
    }

    public function findClienteByIdUsuario($idUsuario) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM cliente WHERE id_usuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idUsuario);
        $stm->execute();

        $result = $stm->fetchAll();
        $vendedores = $this->mapClientes($result);

        if(count($vendedores) == 1)
            return $vendedores[0];
        else if(count($vendedores) == 0)
            return null;
        else
            die("Mais de um vendedor encontrado para o usuário " . $idUsuario);
    }

    private function mapClientes($result) {
        $clientes = array();
        foreach($result as $reg) {
            $cli = new Cliente();
            $cli->setIdCliente($reg['id_cliente']);
            $cli->setDocumento($reg['cpf']);
            $cli->setIdUsuario($reg['id_usuario']);

            array_push($clientes, $cli);
        }

        return $clientes;
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