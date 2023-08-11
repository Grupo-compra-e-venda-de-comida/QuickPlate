<?php
include_once(__DIR__ . "/../connection/connection.php");
include_once(__DIR__ . "/../model/vendedor.php");

class VendedorDAO {

//Método para inserir um Cliente
    public function insertVend(Vendedor $vendedor) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO vendedor (tipo_pessoa, cpf_cnpj, id_usuario)" .
               " VALUES (:tipo_pessoa, :cpf_cnpj, :id_usuario)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("tipo_pessoa", $vendedor->getTipoPessoa());
        $stm->bindValue("cpf_cnpj", $vendedor->getDocumento());
        $stm->bindValue("id_usuario", $vendedor->getIdUsuario());
        $stm->execute();
    }

    public function findVendedorByIdUsuario($idUsuario) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM vendedor WHERE id_usuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idUsuario);
        $stm->execute();

        $result = $stm->fetchAll();
        $vendedores = $this->mapVendedores($result);

        if(count($vendedores) == 1)
            return $vendedores[0];
        else if(count($vendedores) == 0)
            return null;
        else
            die("Mais de um vendedor encontrado para o usuário " . $idUsuario);
    }

    private function mapVendedores($result) {
        $vendedores = array();
        foreach($result as $reg) {
            $vend = new Vendedor();
            $vend->setIdVendedor($reg['id_vendedor']);
            $vend->setTipoPessoa($reg['tipo_pessoa']);
            $vend->setDocumento($reg['cpf_cnpj']);
            $vend->setIdUsuario($reg['id_usuario']);
            array_push($vendedores, $vend);
        }

        return $vendedores;
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM vendedor WHERE id_usuario = :id_usuario";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_usuario", $id);
        $stm->execute();
    }

}