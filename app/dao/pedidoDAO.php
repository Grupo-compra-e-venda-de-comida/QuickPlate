<?php

require_once("../model/pedido.php");


class PedidoDAO {

    public function insertPed(Pedido $pedido){
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

    public function insertPedItem(PedidoItem $pedidoItem){
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

    public function listPedByIdVendedor($idVendedor)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM pedido p WHERE id_vendedor = :id ORDER BY p.id_pedido";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idVendedor);
        $stm->execute();
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
            
            array_push($pedidos, $pedido);
        }

        return $pedidos;
    }

}