<?php
#Classe Controller para a Avaliação

require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/reviewDAO.php");
require_once(__DIR__ . "/../dao/pedidoDAO.php");
require_once(__DIR__ . "/../service/reviewService.php");
require_once(__DIR__ . "/../model/review.php");

class ReviewController extends Controller{
    
    private ReviewService $reviewService;
    private ReviewDAO $reviewDAO;
    //private PedidoDAO $pedidoDAO;

    public function __construct()
    {
        //Seta uma action padrão caso a mesmo não tenha sido enviada por parâmetro
        $this->setActionDefault("formReview");

        $this->handleAction();
    }

    public function formReview()
    {
        /*
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];
        $pedido = $this->pedidoDAO->findPedidoByIdVendedor($idVendedor);
        if (!$pedido) {
            echo "Pedido não encontrado!";
            exit;
        }

        $dados['idPedido'] = $pedido->getIdPedido();

        $this->loadView("produto/formProduto.php", $dados);
        */

        $this->loadView("review/review.php", []);
    }

    protected function createReview()
    {

        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $avaliacao = isset($_POST['avaliacao']) ? trim($_POST['avaliacao']) : '';
        $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
        $idPedido = isset($_POST['idPedido']) ? trim($_POST['idPedido']) : NULL;

        $dados['idPedido'] = $idPedido;

        //Cria objeto Produto
        $review = new Review();
        $review->setAvaliacao($avaliacao);
        $review->setComentario($comentario);
        $review->setIdPedido($idPedido);

        //Validar os dados
        $erros = $this->reviewService->validarDadosReview($review);
        if (empty($erros)) {
            //Persiste o objeto
            try {

                if ($dados["id"] == 0) {

                    //Inserindo
                    $this->reviewDAO->insertReview($review);
                }

                $this->loadView("pedido/listProd.php", $dados, "", "Avaliação salva com sucesso.");
                exit;
            } catch (PDOException $e) {
                $erros = ["Erro ao salvar a avaliação na base de dados." . $e];
            }
        }

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["review"] = $review;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("pedido/listProd.php", $dados, $msgsErro);
    }

}

$reviewController = new ReviewController();

?>