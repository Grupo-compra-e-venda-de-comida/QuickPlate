<?php
#Classe Controller para a Avaliação

require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/reviewDAO.php");
require_once(__DIR__ . "/../dao/pedidoDAO.php");
require_once(__DIR__ . "/../dao/vendedorDAO.php");
require_once(__DIR__ . "/../service/reviewService.php");
require_once(__DIR__ . "/../model/review.php");

class ReviewController extends Controller
{

    private ReviewService $reviewService;
    private ReviewDAO $reviewDAO;
    private VendedorDAO $vendedorDAO;
    private PedidoDAO $pedidoDAO;

    public function __construct()
    {
        //Seta uma action padrão caso a mesmo não tenha sido enviada por parâmetro
        $this->setActionDefault("formReview");

        $this->reviewDAO = new ReviewDAO();
        $this->vendedorDAO = new VendedorDAO();
        $this->pedidoDAO = new PedidoDAO();
        $this->reviewService = new ReviewService();

        $this->handleAction();
    }

    public function formReview()
    {
        $ped = $this->findPedidoById();
        if (!$ped) {
            echo "Pedido não encontrado!";
            exit;
        }

        $dados['idPedido'] = $ped->getIdPedido();
        $dados['idVendedor'] = $ped->getIdVendedor();
        $dados['pedido'] = $ped;

        $this->loadView("review/formReview.php", $dados);
    }

    private function findPedidoById()
    {
        $id = 0;
        if (isset($_GET['idPedido']))
            $id = $_GET['idPedido'];

        $ped = $this->pedidoDAO->findPedidoById($id);
        return $ped;
    }

    protected function createReview()
    {

        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $avaliacao = isset($_POST['avaliacao']) ? trim($_POST['avaliacao']) : '';
        $comentario = isset($_POST['comentario']) ? trim($_POST['comentario']) : '';
        $idPedido = isset($_POST['idPedido']) ? trim($_POST['idPedido']) : NULL;
        $idVendedor = isset($_POST['idVendedor']) ? trim($_POST['idVendedor']) : NULL;

        $dados['idPedido'] = $idPedido;
        $dados['idVendedor'] = $idVendedor;

        //Cria objeto Pedido
        $review = new Review();
        $review->setAvaliacao($avaliacao);
        $review->setComentario($comentario);
        $review->setIdPedido($idPedido);
        $review->setIdVendedor($idVendedor);
        $review->setIdVendedor($idVendedor);

        //Validar os dados
        $erros = $this->reviewService->validarDadosReview($review);
        if (empty($erros)) {
            //Persiste o objeto
            try {

                if ($dados["id"] == 0) {

                    //Inserindo
                    $this->reviewDAO->insertReview($review);
                }
                //Carrega a lista de vendedores
                $vendedores = $this->vendedorDAO->list();
                $dados['listaVendedores'] = $vendedores;

                $this->loadView("home/indexCliente.php", $dados, "", "Avaliação salva com sucesso.");
                exit;
            } catch (PDOException $e) {
                $erros = ["Erro ao salvar a avaliação na base de dados." . $e];
            }
        }

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["review"] = $review;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("review/formReview.php", $dados, $msgsErro);
    }

    public function listReview(){

        $idVendedor = $_GET["id"];
        //$avaliacao = 0;

        /*if(isset($_GET["aval"]))
            $avaliacao = $_GET["aval"];*/
        
        $reviews = [];

        //if($avaliacao)
        //$reviews = $this->reviewDAO->listReviewByAval($idVendedor, $avaliacao);
        //else
            $reviews = $this->reviewDAO->listReview($idVendedor);


        $dados["listRev"] = $reviews;
        //$dados["aval"] = $avaliacao;

        $this->loadView("review/listReview.php", $dados);
    }

    public function calcularNota($idVendedor){
        $reviews = $this->reviewDAO->listReview($idVendedor);
        $contador = 0;
        $nota = 0;
        $notaMedia = 0;

        foreach($reviews as $rev){
            $contador ++;
            $nota += $rev->getAvaliacao;

            $notaMedia = round($nota / $contador);
        }

        return $notaMedia;
    }
}

$reviewController = new ReviewController();
