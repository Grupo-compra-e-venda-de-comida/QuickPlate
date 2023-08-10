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
            $produto->setIdProduto($reg['id_produto']);
            $produto->setNomeProduto($reg['nome_produto']);
            $produto->setCategoriaProduto($reg['categoria_produto']);
            $produto->setDetalhes($reg['detalhes']);
            $produto->setIdVendedor($reg['id_vendedor']);
            array_push($produtos, $produto);
        }

        return $produtos;
    } 

            //Método para buscar um usuário por seu ID
            public function findById(int $id) {
                $conn = Connection::getConn();
        
                $sql = "SELECT * FROM produto p" .
                       " WHERE p.id_produto = ?";
                $stm = $conn->prepare($sql);    
                $stm->execute([$id]);
                $result = $stm->fetchAll();
        
                $produtos = $this->mapProdutos($result);
        
                if(count($produtos) == 1)
                    return $produtos[0];
                elseif(count($produtos) == 0)
                    return null;
        
                die("produtoDAO.findById()" . 
                    " - Erro: mais de um produto encontrado.");
            }

            public function findProdutoByIdUsuario($idProduto) {
                $conn = Connection::getConn();
        
                $sql = "SELECT * FROM produto WHERE id_produto = :id";
                
                $stm = $conn->prepare($sql);
                $stm->bindValue("id", $idProduto);
                $stm->execute();
        
                $result = $stm->fetchAll();
                $produtos = $this->mapProdutos($result);
        
                if(count($produtos) == 1)
                    return $produtos[0];
                else if(count($produtos) == 0)
                    return null;
                else
                    die("Mais de um produto encontrado para o id " . $idProduto);
            }

            public function updateProd(Produto $produto) {
                $conn = Connection::getConn();
        
                $sql = "UPDATE produto SET nome_produto = :nomeProd, categoria_produto = :catProd," .  
                       " detalhes = :detalhes" .  
                       " WHERE id_produto = :idProduto";
                
                $stm = $conn->prepare($sql);
                $stm->bindValue("nomeProd", $produto->getNomeProduto());
                $stm->bindValue("catProd", $produto->getCategoriaProduto());
                $stm->bindValue("detalhes", $produto->getDetalhes());
                $stm->bindValue("idProduto", $produto->getIdVendedor());
                $stm->execute();
            }

}