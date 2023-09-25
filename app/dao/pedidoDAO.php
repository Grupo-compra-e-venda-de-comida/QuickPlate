<?php

require_once("../model/pedido.php");


class PedidoDAO {

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

    public function insertPed(Pedido $pedido){
        $conn = Connection::getConn();

        $sql = "INSERT INTO pedido (id_pedido, id_vendedor, id_cliente, status, descricao)" .
            " VALUES (:idPedido, :idVendedor , :idCliente, :status, :descricao)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("idPedido", $pedido->getIdPedido());
        $stm->bindValue("idVendedor", $pedido->getIdVendedor());
        $stm->bindValue("idCliente", $pedido->getIdCliente());
        $stm->bindValue("status", $pedido->getStatus());
        $stm->bindValue("descricao", $pedido->getDescricao());
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

}