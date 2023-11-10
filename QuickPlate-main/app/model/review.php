<?php

class Review implements JsonSerializable {
    public $idReview;
    public $idPedido;
    public $idVendedor;
    public $avaliacao;
    public $comentario;

    //Cliente
    public $nomeCliente;

    public function jsonSerialize(): array {
        return ['idReview' => $this->idReview,
                'idPedido' => $this->idPedido,
                'idVendedor' => $this->idVendedor,
                'avaliacao' => $this->avaliacao,
                'comentario' => $this->comentario,
                'nomeCliente' => $this->nomeCliente];
    }

    /**
     * Get the value of idReview
     */
    public function getIdReview()
    {
        return $this->idReview;
    }

    /**
     * Set the value of idReview
     */
    public function setIdReview($idReview): self
    {
        $this->idReview = $idReview;

        return $this;
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
     */
    public function setIdPedido($idPedido): self
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    /**
     * Get the value of avaliacao
     */
    public function getAvaliacao()
    {
        return $this->avaliacao;
    }

    /**
     * Set the value of avaliacao
     */
    public function setAvaliacao($avaliacao): self
    {
        $this->avaliacao = $avaliacao;

        return $this;
    }

    /**
     * Get the value of comentario
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     */
    public function setComentario($comentario): self
    {
        $this->comentario = $comentario;

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
    public function setIdVendedor($idVendedor) : self
    {
        $this->idVendedor = $idVendedor;

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
    public function setNomeCliente($nomeCliente) : self
    {
        $this->nomeCliente = $nomeCliente;

        return $this;
    }
}

?>