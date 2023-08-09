<?php

class ProdutoDAO {

    public function insertProd(Produto $produto) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO produto (nome_produto, qnt_produto, categoria_produto, detalhes, id_vendedor)" .
               " VALUES (:nomeProd, :catProd, :detalhes, :idVendedor)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeProd", $produto->getNomeProduto());
        $stm->bindValue("catProd", $produto->getCategoriaProduto());
        $stm->bindValue("detalhes", $produto->getDetalhes());
        $stm->bindValue("idVendedor", $produto->getIdVendedor());
        $stm->execute();

        //return $conn->lastInsertId();
    }

    public function listProd() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produto ORDER BY produto.id_produto";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapProdutos($result);
    }

    private function mapProdutos($result) {
        $produtos = array();
        foreach ($result as $reg) {
            $produto = new Produto();
            $produto->setIdProduto($reg['id_produto']);
            $produto->setNome($reg['nome']);
            $produto->setEmail($reg['email_usuario']);
            $produto->setSenha($reg['senha_usuario']);
            $produto->setTipo($reg['tipo_usuario']);
            $produto->setAtivo($reg['ativo']);
            array_push($produtos, $produto);
        }

        return $produtos;
    } 

}