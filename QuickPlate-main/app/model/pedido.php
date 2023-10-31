<?php

require_once(__DIR__ . "/enum/statusPedido.php");

class Pedido implements JsonSerializable
{
    //Status
    public static $PROCESSANDO = "P";
    public static $PREPARANDO = "PP";
    public static $CONCLUIDO = "C";

    //Pedido
    private $idPedido;
    private $idVendedor;
    private $idCliente;
    private $status;

    //Pedido-Item
    private $nomeVendedor;
    private $nomeCliente;
    
    //Lista carrega com os itens do pedido
    private $itensPedido;
    
    //Atributo que armazena o review do pedido feito pelo cliente
    private $review = null;

    public function jsonSerialize(): array {
        return ['id' => $this->idPedido,
                'nomeVendedor' => $this->nomeVendedor,
                'nomeCliente' => $this->nomeCliente,
                'status' => $this->status,
                'statusDesc' => $this->getStatusDesc(),
                'itensPedido' => $this->itensPedido];
    }

    public function getStatusDesc()
    {
        $statusDesc = "";

        switch ($this->status) {
            case 'P':
                $statusDesc = "Processando";
                break;

            case 'PP':
                $statusDesc = "Preparando";
                break;

            case 'C':
                $statusDesc = "Concluído";
                break;

            case 'E':
                $statusDesc = "Entregue";
                break;
        };


        return $statusDesc;
    }

    /**
     * Get the value of idPedido
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set the value of idPedido
     *
     * @return  self
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    /**
     * Get the value of idVendedor
     */
    public function getIdVendedor()
    {
        return $this->idVendedor;
    }

    /**
     * Set the value of idVendedor
     *
     * @return  self
     */
    public function setIdVendedor($idVendedor)
    {
        $this->idVendedor = $idVendedor;

        return $this;
    }

    /**
     * Get the value of idCliente
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     *
     * @return  self
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of itensPedido
     */ 
    public function getItensPedido()
    {
        return $this->itensPedido;
    }

    /**
     * Set the value of itensPedido
     *
     * @return  self
     */ 
    public function setItensPedido($itensPedido)
    {
        $this->itensPedido = $itensPedido;

        return $this;
    }

    /**
     * Get the value of nomeVendedor
     */ 
    public function getNomeVendedor()
    {
        return $this->nomeVendedor;
    }

    /**
     * Set the value of nomeVendedor
     *
     * @return  self
     */ 
    public function setNomeVendedor($nomeVendedor)
    {
        $this->nomeVendedor = $nomeVendedor;

        return $this;
    }

    /**
     * Get the value of nomeCliente
     */ 
    public function getNomeCliente()
    {
        return $this->nomeCliente;
    }

    /**
     * Set the value of nomeCliente
     *
     * @return  self
     */ 
    public function setNomeCliente($nomeCliente)
    {
        $this->nomeCliente = $nomeCliente;

        return $this;
    }

    /**
     * Get the value of precoPedido
     */
    public function getPrecoPedido() {
        $precoPedido = 0.0;
        
        if($this->itensPedido) {
            foreach($this->itensPedido as $item) {
                $precoPedido += $item->getTotal();
            }
        }
        
        return $precoPedido;
    }

    public function getPrecoPedidoFormatado() {
        $precoPedido = $this->getPrecoPedido();

        return number_format($precoPedido, 2, ',', '.');
    }


    

    /**
     * Get the value of review
     */ 
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set the value of review
     *
     * @return  self
     */ 
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }
}
