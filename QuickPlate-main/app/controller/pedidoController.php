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

class PedidoController extends Controller
{

    private ProdutoDAO $produtoDAO;
    private ClienteDAO $clienteDAO;
    private VendedorDAO $vendedorDAO;
    private PedidoDAO $pedidoDAO;


    public function __construct()
    {

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

    public function openPage()
    {
        $idVendedor = $_GET['idVendedor'];
        $this->loadView("pedido/pagPedido.php", []);
    }



    public function addPed()
    {
        $produto = $this->findProdutoById();
        if ($produto) {
            echo json_encode($produto);
        } else {
            echo "Falha ao adicionar o Produto";
        }
    }

    private function findProdutoById()
    {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $produto = $this->produtoDAO->findById($id);
        return $produto;
    }

    private function findVendedorById()
    {
        $id = 0;
        if (isset($_GET['idVendedor']))
            $id = $_GET['idVendedor'];

        $vend = $this->vendedorDAO->findVendedorById($id);
        return $vend;
    }

    public function finishPed()
    {
        //print_r ($_SESSION); die;

        $itensPedidoJson = file_get_contents("php://input");
        $itensPedido = json_decode($itensPedidoJson, true); //Converte um JSON para um array

        //Captura os dados do pedido
        $idVendedor = $_GET['idVendedor'];
        $idCliente = $this->clienteDAO->findClientId();
        $status = 'P';

        //Cria objeto Pedido
        $pedido = new Pedido;
        $pedido->setIdVendedor($idVendedor);
        $pedido->setIdCliente($idCliente);
        $pedido->setStatus($status);

        //Insere na tabela pedido
        $idPedido = $this->pedidoDAO->insertPed($pedido);


        //Captura os dados dos itens
        foreach ($itensPedido as $item => $campo) {
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

    //Atualiza o status do pedido
    public function updateStatus(){
        $status = $_GET["status"];
        $idPedido = $_GET["idPedido"];
        
        $this->pedidoDAO->updateStats($status, $idPedido);

    }

    //Faz a listagem dos produtos do vendedor
    protected function listProdVend(string $msgErro = "", string $msgSucesso = "")
    {

        $vendedor = $this->findVendedorById();
        if (!$vendedor) {
            echo "falha ao encontrar vendedor";
            exit;
        }

        $dados["idVendedor"] = $vendedor->getIdVendedor();

        $produtos = $this->produtoDAO->listProdByIdVendedor($vendedor->getIdVendedor());
        $dados["listProd"] = $produtos;

        $this->loadView("pedido/listProd.php", $dados,  $msgErro, $msgSucesso);
    }


    //Faz a listagem dos pedidos do vendedor
    protected function listPedVendedor()
    {

        //Carrega a lista de Pedidos do cliente (usuário logado)
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];
        $pedidos = $this->pedidoDAO->listPedidosVend($idUsuario);

        //Carregando os itens de cada pedido
        foreach ($pedidos as $ped) {
            $ped->setItensPedido($this->pedidoDAO->listPedidoItens($ped->getIdPedido()));
        }

        $dados["listPed"] = $pedidos;

        $this->loadView("pedido/listPed.php", $dados);
    }

    public function listPedCliente()
    {

        //Carrega a lista de Pedidos do cliente (usuário logado)
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];
        $pedidos = $this->pedidoDAO->listPedidosCliente($idUsuario);

        //Carregando os itens de cada pedido
        foreach ($pedidos as $ped) {
            $ped->setItensPedido($this->pedidoDAO->listPedidoItens($ped->getIdPedido()));

            //TODO - Verificar se o pedido foi avaliado
            $ped->setReview(null);
        }

        $dados["listPed"] = $pedidos;

        $this->loadView("review/listPed.php", $dados);
    }

    public function statusFilter() {
        //Carrega a lista de Pedidos do cliente (usuário logado)
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];
        $tipoUsuario = $_SESSION[SESSAO_USUARIO_TIPO];
        $option = $_GET["option"];

        if($tipoUsuario == "C"){
            //$pedidos = $this->pedidoDAO->listPedidosClienteByOption($idUsuario, $option);
            echo "cliente detectado no statusFilter";
        } else if ($tipoUsuario == "V"){
            $pedidos = $this->pedidoDAO->listPedidosVendByOption($idUsuario, $option);
        }
        

        //Carregando os itens de cada pedido
        foreach ($pedidos as $ped) {
            $ped->setItensPedido($this->pedidoDAO->listPedidoItens($ped->getIdPedido()));

            //TODO - Verificar se o pedido foi avaliado
            $ped->setReview(null);
        }

        $dados["listPed"] = $pedidos;

        if($tipoUsuario == "C"){
            //$this->loadView("review/listPed.php", $dados);
        } else if ($tipoUsuario == "V"){
           // $this->loadView("pedido/listPed.php", $dados);
        }

    }

}

$pedidoController = new PedidoController();
