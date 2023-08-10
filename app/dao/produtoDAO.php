<?php

class ProdutoDAO {

    public function insertProd(Produto $produto) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO produto (nome_produto, categoria_produto, detalhes, id_vendedor)" .
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
            $produto->setIdProduto($reg['idProduto']);
            $produto->setNomeProduto($reg['nomeProd']);
            $produto->setCategoriaProduto($reg['catProd']);
            $produto->setDetalhes($reg['detalhes']);
            $produto->setIdVendedor($reg['idVendedor']);
            array_push($produtos, $produto);
        }

        return $produtos;
    } 

}