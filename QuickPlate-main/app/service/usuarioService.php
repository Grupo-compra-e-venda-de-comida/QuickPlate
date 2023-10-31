<?php

require_once(__DIR__ . "/../model/usuario.php");
require_once(__DIR__ . "/../model/vendedor.php");

class UsuarioService
{


    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, string $confSenha, string $documento, string $tipoPessoa)
    {

        $erros = array();

        //Validar campos vazios
        if (!$usuario->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if (!$usuario->getEmail())
            array_push($erros, "O campo [Email] é obrigatório.");

        if (!$usuario->getSenha())
            array_push($erros, "O campo [Senha] é obrigatório.");

        if (!$documento)
            array_push($erros, "O campo [CPF ou CNPJ] é obrigatório.");

        if (!$confSenha)
            array_push($erros, "O campo [Confirmação da senha] é obrigatório.");

        if (!$usuario->getTipo())
            array_push($erros, "Selecion um tipo de usuario no campo [Tipos do usuário].");

        //Validar se a senha é igual a contra senha
        if ($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            array_push($erros, "O campo [Senha] deve ser igual ao [Confirmação da senha].");

        //Validar o cpf
        if ($usuario->getTipo() == "C" || $usuario->getTipo() == "V" && $tipoPessoa == "F")
            if(strlen($usuario->getDocumento()) < 11 || strlen($usuario->getDocumento()) > 11)
                array_push($erros, "Informe um [CPF] válido.");

        //Validar o cnpj
        if ($usuario->getTipo() == "V" && $tipoPessoa == "J")
            if(strlen($usuario->getDocumento()) < 14 || strlen($usuario->getDocumento()) > 14)
                array_push($erros, "Informe um [CNPJ] válido.");

        return $erros;
    }

    public function validarDadosAdm(Usuario $usuario)
    {
        $erros = array();

        //Validar campos vazios
        if (!$usuario->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if (!$usuario->getEmail())
            array_push($erros, "O campo [Email] é obrigatório.");

        return $erros;
    }
}
