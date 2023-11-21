<?php

require_once("../model/review.php");

class ReviewDAO
{
    //Método para Inserir uma avaliação
    public function insertReview(Review $review)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO review (avaliacao, comentario, id_pedido, id_vendedor)" .
            " VALUES (:avaliacao, :comentario, :id_pedido, :id_vendedor)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("avaliacao", $review->getAvaliacao());
        $stm->bindValue("comentario", $review->getComentario());
        $stm->bindValue("id_pedido", $review->getIdPedido());
        $stm->bindValue("id_vendedor", $review->getIdVendedor());
        $stm->execute();
    }

    //Método para Listar as avaliações pelo ID do pedido
    public function findReviewByIdPedido(int $idPedido)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM review r WHERE id_pedido = :id ORDER BY r.id_review";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idPedido);
        $stm->execute();
        $result = $stm->fetchAll();

        $reviews = $this->mapReviews($result);

        if (count($reviews) == 1)
            return $reviews[0];
        elseif (count($reviews) == 0)
            return null;

        die("reviewDAO.findReviewByIdPedido()" .
            " - Erro: mais de uma avaliação encontrada.");
    }

    //Método para mapear as avaliações
    private function mapReviews($result)
    {
        $reviews = array();
        foreach ($result as $reg) {
            $review = new Review();
            $review->setIdReview($reg['id_review']);
            $review->setAvaliacao($reg['avaliacao']);
            $review->setComentario($reg['comentario']);
            $review->setIdPedido($reg['id_pedido']);
            array_push($reviews, $review);
        }

        return $reviews;
    }

    //Método para buscar uma avaliação por seu ID
    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM review r" .
            " WHERE r.id_review = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $reviews = $this->mapReviews($result);

        if (count($reviews) == 1)
            return $reviews[0];
        elseif (count($reviews) == 0)
            return null;

        die("reviewDAO.findById()" .
            " - Erro: mais de uma avaliação encontrada.");
    }

    //Método para atualizar uma avaliação
    public function updateReview(Review $review)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE review SET avaliacao = :avaliacao, comentario = :comentario" .
            " WHERE id_review = :id_review";

        $stm = $conn->prepare($sql);
        $stm->bindValue("avaliacao", $review->getAvaliacao());
        $stm->bindValue("comentario", $review->getComentario());
        $stm->bindValue("id_review", $review->getIdReview());
        $stm->execute();
    }

    //Método para excluir uma avaliação pelo seu ID
    public function deleteReviewById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM review WHERE id_review = :id_review";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_review", $id);
        $stm->execute();
    }

    //Listagem das reviews
    public function listReview($idVendedor)
    {
        $conn = Connection::getConn();

        $sql = "SELECT r.*, c.id_cliente, uc.nome
                FROM review r
                JOIN pedido p ON (p.id_pedido = r.id_pedido)
                JOIN cliente c ON (c.id_cliente = p.id_cliente)
                JOIN usuario uc ON (uc.id_usuario = c.id_usuario)
                WHERE p.id_vendedor = :id_vendedor
                ORDER BY r.id_review";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_vendedor", $idVendedor);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapReviews($result);
    }
}
