<?php

class Review implements JsonSerializable {
    public $idReview;
    public $idPedido;
    public $avaliacao;
    public $comentario;

    public function jsonSerialize(): array {
        return ['idReview' => $this->idReview,
                'idPedido' => $this->idPedido,
                'avaliacao' => $this->avaliacao,
                'comentario' => $this->comentario];
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
}

?>