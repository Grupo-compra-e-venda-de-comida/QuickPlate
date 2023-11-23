<?php

class PedidoItem implements JsonSerializable {
    private $idPedido;
    private $idProduto;
    private $valor;
    private $qtd;
    private $total;

    //Atributo para armazenar um objeto do tipo Produto
    private $produto;

    public function jsonSerialize(): array {
        return ['idPedido' => $this->idPedido,
                'idProduto' => $this->idProduto,
                'valorUnit' => $this->getValorFormatado(),
                'qtd' => $this->qtd,
                'valorTotal' => $this->getTotalFormatado(),
                'produto' => $this->produto];
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
     * Get the value of idProduto
     */ 
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Set the value of idProduto
     *
     * @return  self
     */ 
    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    public function getValorFormatado() {
        if($this->valor)
            return number_format($this->valor, 2, ',', '.');
        
        return "";
    }


    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of qtd
     */ 
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * Set the value of qtd
     *
     * @return  self
     */ 
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    public function getTotalFormatado() {
        if($this->total)
            return number_format($this->total, 2, ',', '.');
        
        return "";
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of produto
     */ 
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @return  self
     */ 
    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }   
}