<?php
#Classe controller para a Home do sistema
require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../model/enum/tipoUsuario.php");
require_once(__DIR__ . "/../dao/vendedorDAO.php");
require_once(__DIR__ . "/../dao/produtoDAO.php");
require_once(__DIR__ . "/../dao/usuarioDAO.php");
require_once(__DIR__ . "/../dao/reviewDAO.php");

class HomeController extends Controller
{

    private VendedorDAO $vendedorDAO;
    private ProdutoDAO $produtoDAO;
    private UsuarioDAO $usuarioDAO;
    private ReviewDAO $reviewDAO;

    public function __construct()
    {
        //Verificar se o usuário está logado
        if(! $this->usuarioLogado()) {
            echo "Usuário não está logado.";
            exit;
        }

        //Seta uma action padrão caso a mesmo não tenha sido enviada por parâmetro
        $tipoUsuarioLogado = $_SESSION[SESSAO_USUARIO_TIPO];

        if ($tipoUsuarioLogado == TipoUsuario::CLIENTE) {
            $this->setActionDefault("homeCliente");
        } else if ($tipoUsuarioLogado == TipoUsuario::VENDEDOR) {
            $this->setActionDefault("homeVendedor");
        } else if ($tipoUsuarioLogado == TipoUsuario::ADMINISTRADOR) {
            $this->setActionDefault("home");
        }

        $this->vendedorDAO = new VendedorDAO();
        $this->produtoDAO = new ProdutoDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->reviewDAO = new ReviewDAO();

        $this->handleAction();
    }

    protected function home()
    {
        if (!$this->usuarioPossuiTipo([TipoUsuario::ADMINISTRADOR])) {
            echo "Acesso negado";
            exit;
        }

        //Carrega a lista de usuarios
        $usuarios = $this->usuarioDAO->list();
        $dados['listaUsuarios'] = $usuarios;

        $this->loadView("home/index.php", $dados);
    }
    protected function homeCliente()
    {
        if (!$this->usuarioPossuiTipo([TipoUsuario::CLIENTE])) {
            echo "Acesso negado";
            exit;
        }

        //Carrega a lista de vendedores
        $vendedores = $this->vendedorDAO->list();
        $dados['listaVendedores'] = $vendedores;

        //Calcula a nota do vendedor
        foreach ($dados['listaVendedores'] as $vend) {
            $contador = 0;
            $nota = 0;
            $notaMedia = 0;

            $reviews = $this->reviewDAO->listReview($vend->getIdVendedor());

            foreach ($reviews as $rev) {
                $contador++;
                $nota += $rev->getAvaliacao();
    
                $notaMedia = round($nota / $contador);
            }
            $dados["nota" . $vend->getIdVendedor()] = $notaMedia;
        }

        //Carrega a página
        $this->loadView("home/indexCliente.php", $dados);
    }
    protected function homeVendedor()
    {
        if (!$this->usuarioPossuiTipo([TipoUsuario::VENDEDOR])) {
            echo "Acesso negado";
            exit;
        }
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];
        $vendedor = $this->vendedorDAO->findVendedorByIdUsuario($idUsuario);

        //$produtos = $this->produtoDAO->listProd();
        $produtos = $this->produtoDAO->listProdByIdVendedor($vendedor->getIdVendedor());
        $dados['listProd'] = $produtos;

        $this->loadView("home/indexVendedor.php", $dados);
    }
}


#Criar objeto da classe
$homeCont = new HomeController();
