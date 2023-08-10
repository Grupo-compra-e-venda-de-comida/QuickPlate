<?php
require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/vendedorDAO.php");
require_once(__DIR__ . "/../dao/produtoDAO.php");
require_once(__DIR__ . "/../service/produtoService.php");
require_once(__DIR__ . "/../model/produto.php");
require_once(__DIR__ . "/../model/vendedor.php");
require_once(__DIR__ . "/../model/enum/tipoProduto.php");

class ProdutoController extends Controller {

    private ProdutoService $produtoService;
    private ProdutoDAO $produtoDAO;
    private VendedorDAO $vendedorDAO;

    public function __construct() {

        //Verificar se o usuário está logado
        if(! $this->usuarioLogado()) {
            echo "Usuário não está logado!";
            exit;
        }

        //Verificar o tipo de acesso - apenas VENDEDOR
        $tipoUsuario = $this->getTipoUsuarioLogado();
        if($tipoUsuario != TipoUsuario::VENDEDOR) {
            echo "O usuário deve ser um vendedor!";
            exit;
        }

        $this->produtoService = new ProdutoService();

        $this->produtoDAO = new ProdutoDAO();
        $this->vendedorDAO = new VendedorDAO();

        //Seta uma action padrão caso a mesmo não tenha sido enviada por parâmetro
        $this->setActionDefault("formProd");

        $this->handleAction();
    }

    public function formProd() {
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];
        $vendedor = $this->vendedorDAO->findVendedorByIdUsuario($idUsuario);
        if(! $vendedor) {
            echo "Vendedor não encontrado!";
            exit;
        }
        
        $dados['idVendedor'] = $vendedor->getIdVendedor();
        
        $this->loadView("produto/formProduto.php", $dados);
    }

    protected function createProd() {
        
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nomeProd = isset($_POST['nomeProd']) ? trim($_POST['nomeProd']) : '';
        $catProd = isset($_POST['catProd']) ? trim($_POST['catProd']) : '';
        $detalhes = isset($_POST['detalhes']) ? trim($_POST['detalhes']) : NULL;
        $idVendedor = isset($_POST['idVendedor']) ? trim($_POST['idVendedor']) : NULL;

        //Cria objeto Produto
        $produto = new Produto();
        $produto->setNomeProduto($nomeProd);
        $produto->setCategoriaProduto($catProd);
        $produto->setDetalhes($detalhes);
        $produto->setIdVendedor($idVendedor);

        //TODO Validação na camada de serviços

        //Validar os dados
        $erros = $this->produtoService->validarDadosProd($produto);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id"] == 0){
                    
                    //Inserindo
                    $this->produtoDAO->insertProd($produto);

                }

                $this->loadView("produto/formProduto.php", [], "", "Produto salvo com sucesso.");
                exit;
            } catch (PDOException $e) {
                $erros = ["Erro ao salvar o usuário na base de dados." . $e];                
            }
        }
        
        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["produto"] = $produto;
        $dados["nome"] = $nomeProd;
        $dados["detalhes"] = $detalhes;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("produto/formProduto.php", $dados, $msgsErro);

    }

    protected function listProd(string $msgErro = "", string $msgSucesso = "") {
        $produtos = $this->produtoDAO->listProd();
        //print_r($usuarios);
        $dados["listaProd"] = $produtos;

        $this->loadView("produto/listProd.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function updateProd() {

        //Captura os dados do formulário
        $dados["idProd"] = isset($_POST['id']) ? trim($_POST['id']) : NULL;
        $nomeProd = isset($_POST['nomeProd']) ? trim($_POST['nomeProd']) : '';
        $catProd = isset($_POST['catProd']) ? trim($_POST['catProd']) : '';
        $detalhes = isset($_POST['detalhes']) ? trim($_POST['detalhes']) : NULL;

        //Cria objeto Produto
        $produto = new Produto();
        $produto->setIdProduto($dados["idProd"]);
        $produto->setNomeProduto($nomeProd);
        $produto->setCategoriaProduto($catProd);
        $produto->setDetalhes($detalhes);

        var_dump($produto);
        
        //Validar os dados
        $erros = $this->produtoService->validarDadosProd($produto);
        if(empty($erros)) {
            //Persiste o objeto
            try {
              
                //Atualizar
                $this->produtoDAO->updateProd($produto);

                $this->loadView("home/indexVendedor.php", [], "", "Produto salvo com sucesso.");
                exit;
            } catch (PDOException $e) {
                $erros = ["Erro ao salvar o produto na base de dados." . $e];                
            }
        }

        $msgsErro = implode("<br>", $erros);
        $this->loadView("produto/editProduto.php", $dados, $msgsErro);
        
    }

    protected function editProd() {
        $produto = $this->findProdutoById();
        if($produto) {
            $dados["id"] = $produto->getIdProduto();
            $dados["produto"] = $produto;

            $this->loadView("produto/editProduto.php", $dados);
        } else
            $this->listProd("Usuário não encontrado.");
    }

    private function findProdutoById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $produto = $this->produtoDAO->findById($id);
        return $produto;
    }

    protected function deleteProd() {
        $produto = $this->findProdutoById();
        if($produto) {
            $this->produtoDAO->deleteProdById($produto->getIdProduto());
            $this->listProd("", "Produto excluído com sucesso!");
        } else
            $this->listProd("Produto não econtrado!");
    }

   
}

$produtoController = new ProdutoController();