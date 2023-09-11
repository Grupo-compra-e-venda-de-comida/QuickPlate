<?php
require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/vendedorDAO.php");
require_once(__DIR__ . "/../dao/produtoDAO.php");
require_once(__DIR__ . "/../dao/clienteDAO.php");
require_once(__DIR__ . "/../model/produto.php");
require_once(__DIR__ . "/../model/vendedor.php");
require_once(__DIR__ . "/../model/enum/tipoProduto.php");

class PedidoController extends Controller {

    private ProdutoDAO $produtoDAO;
    private ClienteDAO $clienteDAO;
    private VendedorDAO $vendedorDAO;

    public function __construct() {
        //$itens = [];

        $this->produtoDAO = new ProdutoDAO();
        $this->clienteDAO = new ClienteDAO();
        $this->vendedorDAO = new VendedorDAO();

        //Seta uma action padrão caso a mesmo não tenha sido enviada por parâmetro
        //$this->setActionDefault("list");

        $this->handleAction();
    }

    protected function listProdVend(string $msgErro = "", string $msgSucesso = "") {

        $vendedor = $this->findVendedorById();
        if(! $vendedor) {
            echo "falha ao encontrar vendedor";
            exit;
        }
        
        $produtos = $this->produtoDAO->listProdByIdVendedor($vendedor->getIdVendedor());
        $dados["listProd"] = $produtos;
        //print_r($produtos);

        $this->loadView("pedido/listProd.php", $dados,  $msgErro, $msgSucesso);

    }

    public function addPed() {
        $produto = $this->findProdutoById();
        if ($produto) {
            echo json_encode($produto);
        } else {
            echo "Falha ao adicionar o Produto";
        }

    }

    private function findProdutoById() {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $produto = $this->produtoDAO->findById($id);
        return $produto;
    }

    private function findVendedorById() {
        $id = 0;
        if (isset($_GET['idVendedor']))
            $id = $_GET['idVendedor'];

        $vend = $this->vendedorDAO->findVendedorById($id);
        return $vend;
    }

    public function openPage() {
        $idVendedor = $_GET['idVendedor'];
        $this->loadView("pedido/pagPedido.php", []);
    }

    public function finishPed() {

    }

}

$pedidoController = new PedidoController();