<?php

require_once(__DIR__ . "/usuario.php");

class Vendedor extends Usuario {

    public static $PESSOA_FISICA = 'F';
    public static $PESSOA_JURIDICA = 'J';

    private $idVendedor;
    private $tipoPessoa;
    private $documento;


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
     * Get the value of tipoPessoa
     */ 
    public function getTipoPessoa()
    {
        return $this->tipoPessoa;
    }

    /**
     * Set the value of tipoPessoa
     *
     * @return  self
     */ 
    public function setTipoPessoa($tipoPessoa)
    {
        $this->tipoPessoa = $tipoPessoa;

        return $this;
    }


    /**
     * Get the value of documento
     */ 
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set the value of documento
     *
     * @return  self
     */ 
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }
}

