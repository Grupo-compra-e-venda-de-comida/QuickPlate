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

    /*public function listPed(){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM pedido ORDER BY pedido.id_pedido";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapPedidos($result);
    }*/

    public function joinPedidoItem($idPedido){
        $conn = Connection::getConn();

        $sql = "SELECT P.id_pedido, P.id_vendedor, P.id_cliente, P.status, P.descricao, I.id_pedido, I.id_produto, I.quantidade, I.total as total 
        FROM pedido P INNER JOIN pedido_item I ON P.id_pedido = I.id_pedido WHERE P.id_pedido = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idPedido);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_OBJ); <-----------
/*echo "<pre>";
print_r($result);
echo "</pre>";*/

        return $result;
    }

}