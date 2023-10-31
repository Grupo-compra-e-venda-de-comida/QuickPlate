<?php

require_once("../model/pedido.php");
require_once("../model/pedidoItem.php");


class PedidoDAO
{

    //Método para Inserir Pedido
    public function insertPed(Pedido $pedido)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO pedido (id_pedido, id_vendedor, id_cliente, status)" .
            " VALUES (:idPedido, :idVendedor , :idCliente, :status)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("idPedido", $pedido->getIdPedido());
        $stm->bindValue("idVendedor", $pedido->getIdVendedor());
        $stm->bindValue("idCliente", $pedido->getIdCliente());
        $stm->bindValue("status", $pedido->getStatus());
        $stm->execute();

        return $conn->lastInsertId();
    }

    public function findPedidoById(int $idPedido)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM pedido p WHERE id_pedido = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idPedido]);
        $result = $stm->fetchAll();

        $pedidos = $this->mapPedidos($result);

        if (count($pedidos) == 1)
            return $pedidos[0];
        elseif (count($pedidos) == 0)
            return null;

        die("pedidoDAO.findPedidoById()" .
            " - Erro: mais de um pedido encontrado.");
    }

    //Método para inserir o Item na tabela 'pedido_item'
    public function insertPedItem(PedidoItem $pedidoItem)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO pedido_item (id_pedido, id_produto, valor, quantidade, total)" .
            " VALUES (:idPedido, :idProduto , :valor, :qtd, :total)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("idPedido", $pedidoItem->getIdPedido());
        $stm->bindValue("idProduto", $pedidoItem->getIdProduto());
        $stm->bindValue("valor", $pedidoItem->getValor());
        $stm->bindValue("qtd", $pedidoItem->getQtd());
        $stm->bindValue("total", $pedidoItem->getTotal());
        $stm->execute();

        return $conn->lastInsertId();
    }

    //Atualiza o status do pedido
    public function updateStats($status, $idPedido) {
        $conn = Connection::getConn();

        $sql = "UPDATE pedido SET status = :status" .
        " WHERE id_pedido = :idPedido";

        $stm = $conn->prepare($sql);
        $stm->bindValue("status", $status);
        $stm->bindValue("idPedido", $idPedido);
        $stm->execute();

    }

    //Lista os pedidos de cada cliente
    public function listPedidosCliente($idUsuario)
    {
        $conn = Connection::getConn();

        $sql = "SELECT p.*, u_vend.nome AS nome_vend FROM pedido p " .
            " JOIN cliente c ON (c.id_cliente = p.id_cliente)" .
            " JOIN vendedor v ON (v.id_vendedor = p.id_vendedor)" .
            " JOIN usuario u_vend ON (u_vend.id_usuario = v.id_usuario)" .
            " WHERE c.id_usuario = ?" .
            " ORDER BY p.id_pedido DESC";
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario]);
        $result = $stm->fetchAll();

        return $this->mapPedidos($result);
    }

    //Lista os pedidos (filtrados) de cada cliente
    public function listPedidosClienteByStatus($idUsuario, $status)
    {
        $conn = Connection::getConn();

        $sql = "SELECT p.*, u_vend.nome AS nome_vend FROM pedido p " .
            " JOIN cliente c ON (c.id_cliente = p.id_cliente)" .
            " JOIN vendedor v ON (v.id_vendedor = p.id_vendedor)" .
            " JOIN usuario u_vend ON (u_vend.id_usuario = v.id_usuario)" .
            " WHERE c.id_usuario = ? AND p.status = ?" .
            " ORDER BY p.id_pedido DESC";
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario, $status]);
        $result = $stm->fetchAll();

        return $this->mapPedidos($result);
    }

    private function mapPedidos($result)
    {
        $pedidos = array();
        foreach ($result as $reg) {
            $pedido = new Pedido();
            $pedido->setIdPedido($reg['id_pedido']);
            $pedido->setIdVendedor($reg['id_vendedor']);
            $pedido->setIdCliente($reg['id_cliente']);
            $pedido->setStatus($reg['status']);

            if (isset($reg['nome_vend'])){
                $pedido->setNomeVendedor($reg['nome_vend']);
            }
            else if (isset($reg['nome_cli'])){
                $pedido->setNomeCliente($reg['nome_cli']);
            }

            array_push($pedidos, $pedido);
        }

        return $pedidos;
    }

    //Obtem os valores de cada item dentro do pedido
    public function listPedidoItens($idPedido)
    {
        $conn = Connection::getConn();

        $sql = "SELECT pi.*, p.id_vendedor, p.nome_produto, p.categoria_produto " .
            " FROM pedido_item pi " .
            " INNER JOIN produto p ON pi.id_produto = p.id_produto" .
            " WHERE pi.id_pedido = ?" .
            " ORDER BY pi.id_item";
        $stm = $conn->prepare($sql);
        $stm->execute([$idPedido]);
        $result = $stm->fetchAll();

        return $this->mapPedidosItem($result);
    }

    //Retornar função para Private após testes
    public function mapPedidosItem($result)
    {
        $itens = array();
        foreach ($result as $reg) {
            $item = new PedidoItem();

            $item->setIdPedido($reg['id_pedido']);
            $item->setIdProduto($reg['id_produto']);
            $item->setValor($reg['valor']);
            $item->setQtd($reg['quantidade']);
            $item->setTotal($reg['total']);

            $produto = new Produto();
            $produto->setIdProduto($reg['id_produto']);
            $produto->setIdVendedor($reg['id_vendedor']);
            $produto->setNomeProduto($reg['nome_produto']);
            $produto->setCategoriaProduto($reg['categoria_produto']);
            $item->setProduto($produto);

            array_push($itens, $item);
            
        }
        return $itens;
    }

    //Lista os pedidos de cada vendedor
    //Não funcionando!
    public function listPedidosVend($idUsuario)
    {
        $conn = Connection::getConn();

        $sql = "SELECT p.*, u_cli.nome AS nome_cli FROM pedido p" .
        " JOIN cliente c ON (c.id_cliente = p.id_cliente)" .
        " JOIN vendedor v ON (v.id_vendedor = p.id_vendedor)" .
        " JOIN usuario u_cli ON (u_cli.id_usuario = c.id_usuario)" .
        " WHERE v.id_usuario = ?" .
        " ORDER BY p.id_pedido DESC;";
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario]);
        $result = $stm->fetchAll();

        return $this->mapPedidos($result);
    }

    //TODO - terminar
    public function listPedidosVendByStatus($idUsuario, $status)
    {
        $conn = Connection::getConn();

        $sql = "SELECT p.*, u_cli.nome AS nome_cli FROM pedido p" .
        " JOIN cliente c ON (c.id_cliente = p.id_cliente)" .
        " JOIN vendedor v ON (v.id_vendedor = p.id_vendedor)" .
        " JOIN usuario u_cli ON (u_cli.id_usuario = c.id_usuario)" .
        " WHERE v.id_usuario = ? AND p.status = ?" .
        " ORDER BY p.id_pedido DESC;";
        
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario, $status]);
        $result = $stm->fetchAll();

        return $this->mapPedidos($result);
    }

    //Junta as tabelas pedido_item e produto
    //Objetivo --> obter os valores correspondentes de cada produto
    public function listItensProd($idPedido)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM pedido_item pi INNER JOIN produto p ON pi.id_produto = p.id_produto WHERE pi.id_pedido = ?;";
        $stm = $conn->prepare($sql);
        $stm->execute([$idPedido]);
        $result = $stm->fetchAll();

        return $this->mapProdutosItem($result);
    }

    //Seta os valores de cada produto do pedido
    //Objetivo --> aparecer o nome e categoria na tela do usuario
    private function mapProdutosItem($result)
    {
        $produtos = array();
        foreach ($result as $reg) {
            $produto = new Produto();
            $produto->setIdProduto($reg['id_produto']);
            $produto->setIdVendedor($reg['id_vendedor']);
            $produto->setNomeProduto($reg['nome_produto']);
            $produto->setCategoriaProduto($reg['categoria_produto']);

            array_push($produtos, $produto);
        }

        return $produto;
    }

}
