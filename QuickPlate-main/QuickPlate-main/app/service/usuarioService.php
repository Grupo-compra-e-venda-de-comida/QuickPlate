<?php

require_once(__DIR__ . "/../model/usuario.php");

class UsuarioService
{


    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, string $confSenha, string $documento)
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
