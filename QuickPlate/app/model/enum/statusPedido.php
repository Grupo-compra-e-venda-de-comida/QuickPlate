<?php
#Nome do arquivo: tipoProduto.php
#Objetivo: classe Enum para as categorias dos produtos

class StatusPedido {

    const PROCESSANDO_PEDIDO = "P";
    const PREPARANDO_PEDIDO = "PP";
    const PEDIDO_CONCLUIDO = "C";
    const PEDIDO_CANCELADO = "CC";
    const PEDIDO_ENTREGUE = "E";
    
}