<?php

require_once(__DIR__ . "/../model/produto.php");

class ProdutoService
{

    /* Método para validar os dados do usuário que vem do formulário */

    public function validarDadosProd(Produto $produto)
    {
        $erros = array();

        //Validar campos vazios
        if (!$produto->getNomeProduto())
            array_push($erros, "O campo [Titulo] é obrigatório.");
            
        if (!$produto->getPrecoProduto())
            array_push($erros, "O campo [Preço] é obrigatório.");

        if (!$produto->getDetalhes())
            array_push($erros, "O campo [Detalhes] é obrigatório.");

        return $erros;
    }
}
