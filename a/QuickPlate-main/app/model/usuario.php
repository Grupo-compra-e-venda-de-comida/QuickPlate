<?php
#Arquivo com a declaração da classe Usuario

require_once(__DIR__ . "/enum/tipoUsuario.php");

#[AllowDynamicProperties] class Usuario implements JsonSerializable {

    public static $ATIVO = "A";
    public static $INATIVO = "I";

    private $idUsuario;
    private $emailUsuario;
    private $senhaUsuario;
    private $tipoUsuario;
    private $documento;
    private $nome;
    private $ativo;

    //Método requerido quando a classe implementa JsonSerializable
    //Precisa ter exatamente o nome de jsonSerialize() e retornar um array
    public function jsonSerialize() : array {
        return 
        [
            'idUsuario' => $this->idUsuario,
            'emailUsuario' => $this->emailUsuario,
            'tipoUsuario' => $this->tipoUsuario
        ];
    }

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of nomeUsuario
     */ 
    public function getEmail()
    {
        return $this->emailUsuario;
    }

    /**
     * Set the value of nomeUsuario
     *
     * @return  self
     */ 
    public function setEmail($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;

        return $this;
    }


    /**
     * Get the value of login
     */ 
    public function getTipo()
    {
        return $this->tipoUsuario;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setTipo($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }

    /**
     * Get the value of senhaUsuario
     */ 
    public function getSenha()
    {
        return $this->senhaUsuario;
    }

    /**
     * Set the value of senhaUsuario
     *
     * @return  self
     */ 
    public function setSenha($senhaUsuario)
    {
        $this->senhaUsuario = $senhaUsuario;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getAtivoDesc() {
        $ativoDesc = "";

        switch($this->ativo) {
            case 'A':
                $ativoDesc = "Ativo";
                break;

            case 'I':
                $ativoDesc = "Inativo";
                break;
        };


        return $ativoDesc;
        
    }

    /**
     * Get the value of ativo
     */ 
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set the value of ativo
     *
     * @return  self
     */ 
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function getTipoUsuarioDesc() {
        $tipoDesc = "";

        switch($this->tipoUsuario) {
            case 'A':
                $tipoDesc = "Administrador";
                break;

            case 'C':
                $tipoDesc = "Cliente";
                break;

            case 'V':
                $tipoDesc = "Vendedor";
                break;

        };


        return $tipoDesc;
        
    }

    /**
     * Get the value of tipoUsuario
     */ 
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    /**
     * Set the value of tipoUsuario
     *
     * @return  self
     */ 
    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;

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
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }
}

?>