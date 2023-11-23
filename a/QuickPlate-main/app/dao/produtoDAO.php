<?php

require_once("../model/produto.php");

class ProdutoDAO
{

    public function insertProd(Produto $produto)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO produto (nome_produto, preco_produto, categoria_produto, detalhes, id_vendedor, ativo_produto)" .
            " VALUES (:nomeProd, :precoProd , :catProd, :detalhes, :idVendedor, :ativo_produto)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeProd", $produto->getNomeProduto());
        $stm->bindValue("precoProd", $produto->getPrecoProduto());
        $stm->bindValue("catProd", $produto->getCategoriaProduto());
        $stm->bindValue("detalhes", $produto->getDetalhes());
        $stm->bindValue("idVendedor", $produto->getIdVendedor());
        $stm->bindValue("ativo_produto", $produto->getAtivoProduto());
        $stm->execute();
    }

    public function listProd()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produto WHERE ativo_produto = 'A' ORDER BY produto.id_produto";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapProdutos($result);
    }

    public function listProdByIdVendedor(int $idVendedor)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produto p WHERE id_vendedor = :id AND ativo_produto = 'A' ORDER BY p.id_produto";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idVendedor);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapProdutos($result);
    }

    public function listProdByIdVendedorIna(int $idVendedor)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produto p WHERE id_vendedor = :id AND ativo_produto = 'I' ORDER BY p.id_produto";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idVendedor);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapProdutos($result);
    }

    private function mapProdutos($result)
    {
        $produtos = array();
        foreach ($result as $reg) {
            $produto = new Produto();
            $produto->setIdProduto($reg['id_produto']);
            $produto->setNomeProduto($reg['nome_produto']);
            $produto->setPrecoProduto($reg['preco_produto']);
            $produto->setCategoriaProduto($reg['categoria_produto']);
            $produto->setDetalhes($reg['detalhes']);
            $produto->setIdVendedor($reg['id_vendedor']);
            array_push($produtos, $produto);
        }

        return $produtos;
    }

    //Método para buscar um usuário por seu ID
    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM produto p" .
            " WHERE p.id_produto = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $produtos = $this->mapProdutos($result);

        if (count($produtos) == 1)
            return $produtos[0];
        elseif (count($produtos) == 0)
            return null;

        die("produtoDAO.findById()" .
            " - Erro: mais de um produto encontrado.");
    }

    public function updateProd(Produto $produto)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE produto SET nome_produto = :nome_produto, categoria_produto = :categoria_produto,
                         preco_produto = :preco_produto, detalhes = :detalhes" .  
                       " WHERE id_produto = :id_produto";
                
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome_produto", $produto->getNomeProduto());
        $stm->bindValue("categoria_produto", $produto->getCategoriaProduto());
        $stm->bindValue("preco_produto", $produto->getPrecoProduto());
        $stm->bindValue("detalhes", $produto->getDetalhes());
        $stm->bindValue("id_produto", $produto->getIdProduto());
        $stm->execute();
    }

    //Método para inativar um Produto pelo seu ID
    public function inativarProdById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE produto SET ativo_produto = 'I' WHERE id_produto = :id_produto";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_produto", $id);
        $stm->execute();
    }

    //Método para ativar um Produto pelo seu ID
    public function ativarProdById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE produto SET ativo_produto = 'A' WHERE id_produto = :id_produto";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_produto", $id);
        $stm->execute();
    }
}

