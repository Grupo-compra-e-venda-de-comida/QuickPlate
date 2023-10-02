<?php
require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/vendedorDAO.php");
require_once(__DIR__ . "/../dao/produtoDAO.php");
require_once(__DIR__ . "/../dao/clienteDAO.php");
require_once(__DIR__ . "/../dao/pedidoDAO.php");
require_once(__DIR__ . "/../model/produto.php");
require_once(__DIR__ . "/../model/vendedor.php");
require_once(__DIR__ . "/../model/pedido.php");
require_once(__DIR__ . "/../model/pedidoItem.php");
require_once(__DIR__ . "/../model/enum/tipoProduto.php");

class PedidoController extends Controller {

    private ProdutoDAO $produtoDAO;
    private ClienteDAO $clienteDAO;
    private VendedorDAO $vendedorDAO;
    private PedidoDAO $pedidoDAO;


    public function __construct() {

        $this->produtoDAO = new ProdutoDAO();
        $this->clienteDAO = new ClienteDAO();
        $this->vendedorDAO = new VendedorDAO();
        $this->pedidoDAO = new PedidoDAO();

        //Verificar se o usuário está logado
        if (!$this->usuarioLogado()) {
            echo "Usuário não está logado!";
            exit;
        }

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

        $dados["idVendedor"] = $vendedor->getIdVendedor();
        
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
        $itensPedidoJson = file_get_contents("php://input");
        $itensPedido = json_decode($itensPedidoJson, true); //Converte um JSON para um array

        //Captura os dados do pedido
        //$dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $idVendedor = $_GET['idVendedor'];
        $idCliente = $this->clienteDAO->findClientId(); 
        $status = 'processando pedido';
        
        //Cria objeto Pedido
        $pedido = new Pedido;
        $pedido->setIdVendedor($idVendedor);
        $pedido->setIdCliente($idCliente);
        $pedido->setStatus($status);

        //Insere na tabela pedido
        $idPedido = $this->pedidoDAO->insertPed($pedido);


        //Captura os dados dos itens
        foreach($itensPedido as $item => $campo){
        $idProduto = $campo['idProduto'];
        $valor = $campo['valor'];
        $qtd = $campo['qtd'];
        $total = $campo['total'];

        //Cria objeto PedidoItem
        $pedidoItem = new PedidoItem;
        $pedidoItem->setIdPedido($idPedido);
        $pedidoItem->setIdProduto($idProduto);
        $pedidoItem->setValor($valor);
        $pedidoItem->setQtd($qtd);
        $pedidoItem->setTotal($total);

        //Insere na tabela pedido_item
        $this->pedidoDAO->insertPedItem($pedidoItem);
        }
    }

    protected function listPed(string $msgErro = "", string $msgSucesso = "") {

        $idVendedor = $this->vendedorDAO->findVendId();
        $vendedor = $this->vendedorDAO->findVendedorById($idVendedor);

        if(! $vendedor) {
            echo "falha ao encontrar vendedor";
            exit;
        }

        $dados["idVendedor"] = $vendedor->getIdVendedor();
        
        $pedidos = $this->pedidoDAO->listPedByIdVendedor($vendedor->getIdVendedor());
        $dados["listPed"] = $pedidos;

        $this->loadView("pedido/listPed.php", $dados,  $msgErro, $msgSucesso);
    }

    public function joinTables(){
        $pedido = $this->pedidoDAO->joinPedidoItem();
        $dados["listPed"] = $pedido;
    }

}

$pedidoController = new PedidoController();