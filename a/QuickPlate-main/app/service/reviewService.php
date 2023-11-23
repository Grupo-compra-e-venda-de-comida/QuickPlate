<?php

require_once(__DIR__ . "/../model/review.php");

class ReviewService
{

    /* Método para validar os dados do usuário que vem do formulário */

    public function validarDadosReview(Review $review)
    {
        $erros = array();

        //Validar campos vazios
        if (!$review->getAvaliacao())
            array_push($erros, "O campo [Avaliação] é obrigatório.");
        if (!$review->getComentario())
            array_push($erros, "O campo [Comentário] é obrigatório.");

        return $erros;
    }
}
