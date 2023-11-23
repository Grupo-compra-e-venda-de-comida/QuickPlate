<?php

require_once(__DIR__ . "/enum/tipoProduto.php");

class Produto implements JsonSerializable
{
    private $idProduto;
    private $nomeProduto;
    private $precoProduto;
    private $categoriaProduto;
    private $detalhes;
    private $idVendedor;
    private $ativoProduto;


    public function jsonSerialize(): array {
        return ['id' => $this->idProduto,
                'nomeProduto' => $this->nomeProduto,
                'precoProduto' => $this->precoProduto,
                'categoriaProduto' => $this->categoriaProduto,
                'categoriaDesc' => $this->getCategoriaDesc(),
                'detalhes' => $this->detalhes,
                'idVendedor' => $this->idVendedor,
                'ativoProduto' => $this->ativoProduto];
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
     * Get the value of nomeProduto
     */
    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    /**
     * Set the value of nomeProduto
     *
     * @return  self
     */
    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;

        return $this;
    }



    /**
     * Get the value of categoriaProduto
     */
    public function getCategoriaProduto()
    {
        return $this->categoriaProduto;
    }

    /**
     * Set the value of categoriaProduto
     *
     * @return  self
     */
    public function setCategoriaProduto($categoriaProduto)
    {
        $this->categoriaProduto = $categoriaProduto;

        return $this;
    }

    public function getCategoriaDesc()
    {
        $tipoDesc = "";

        switch ($this->categoriaProduto) {
            case 'S':
                $tipoDesc = "Salgado";
                break;

            case 'D':
                $tipoDesc = "Doce";
                break;

            case 'B':
                $tipoDesc = "Bebida";
                break;
        };


        return $tipoDesc;
    }

    /**
     * Get the value of detalhes
     */
    public function getDetalhes()
    {
        return $this->detalhes;
    }

    /**
     * Set the value of detalhes
     *
     * @return  self
     */
    public function setDetalhes($detalhes)
    {
        $this->detalhes = $detalhes;

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

    public function getPrecoProdutoFormatado() {
        $precoProduto = $this->getPrecoProduto();

        return number_format($precoProduto, 2, ',', '.');
    }

    /**
     * Get the value of precoProduto
     */ 
    public function getPrecoProduto()
    {
        return $this->precoProduto;
    }

    /**
     * Set the value of precoProduto
     *
     * @return  self
     */ 
    public function setPrecoProduto($precoProduto)
    {
        $this->precoProduto = $precoProduto;

        return $this;
    }

    /**
     * Get the value of ativoProduto
     */ 
    public function getAtivoProduto()
    {
        return $this->ativoProduto;
    }

    /**
     * Set the value of ativoProduto
     *
     * @return  self
     */ 
    public function setAtivoProduto($ativoProduto)
    {
        $this->ativoProduto = $ativoProduto;

        return $this;
    }
}
