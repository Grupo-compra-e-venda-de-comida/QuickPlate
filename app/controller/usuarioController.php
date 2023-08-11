<?php
#Classe de controller para Usuario

require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/usuarioDAO.php");
require_once(__DIR__ . "/../dao/clienteDAO.php");
require_once(__DIR__ . "/../dao/vendedorDAO.php");
require_once(__DIR__ . "/../service/usuarioService.php");
require_once(__DIR__ . "/../model/usuario.php");
require_once(__DIR__ . "/../model/enum/tipoUsuario.php");

class UsuarioController extends Controller{

    private UsuarioService $usuarioService;
    private UsuarioDAO $usuarioDAO;
    private ClienteDAO $clienteDAO;
    private VendedorDAO $vendedorDAO;

    public function __construct() {
        //if(! $this->usuarioLogado())
        //    exit;

        //if(! $this->tipoUsuario([TipoUsuario::ADMINISTRADOR])) {
        //    echo "Acesso negado";
        //    exit;
        //}

        $this->usuarioService = new UsuarioService();

        $this->usuarioDAO = new UsuarioDAO();
        $this->clienteDAO = new ClienteDAO();
        $this->vendedorDAO = new VendedorDAO();

        //Seta uma action padrão caso a mesmo não tenha sido enviada por parâmetro
        $this->setActionDefault("list");

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $usuarios = $this->usuarioDAO->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados,  $msgErro, $msgSucesso);
    }  

    protected function update() {

        //Captura os dados do form -- funciona
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $ativo = isset($_POST['ativo']) ? trim($_POST['ativo']) : NULL;

        //var_dump($dados);

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setIdUsuario($dados["id"]);
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setAtivo($ativo);

        //var_dump($usuario);
        
        //Validar os dados
        $erros = $this->usuarioService->validarDadosAdm($usuario);
        if(empty($erros)) {
            //Persiste o objeto
            try {
              
                //Atualizar
                $this->usuarioDAO->update($usuario);

                $this->loadView("home/index.php", [], "", "Usuário salvo com sucesso.");
                exit;
            } catch (PDOException $e) {
                $erros = ["Erro ao salvar o usuário na base de dados." . $e];                
            }
        }

        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/autoRegistro.php", $dados, $msgsErro);
        
    }

    protected function edit() {
        $usuario = $this->findUsuarioById();
        if($usuario) {
            $dados["id"] = $usuario->getIdUsuario();
            $dados["usuario"] = $usuario;

            $this->loadView("usuario/regAdm.php", $dados);
        } else
            $this->list("Usuário não encontrado.");
    }

    protected function save() {

        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $documento = isset($_POST['documento']) ? trim($_POST['documento']) : '';
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $confSenha = isset($_POST['confSenha']) ? trim($_POST['confSenha']) : '';
        $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : NULL;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setTipo($tipo);

        //TODO - Temporario
        $ativo = "I";
        $usuario->setAtivo($ativo);


        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha, $documento);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                
                if($dados["id"] == 0){
                    
                    //Inserindo
                    $idUsuario = $this->usuarioDAO->insert($usuario);

                    //Inserindo nas tabelas Cliente/Vendedor
                    if($usuario->getTipo() == 'C') {
                        $this->saveClient($idUsuario, $documento);
                    }
                    else if ($usuario->getTipo() == 'V'){
                        $this->saveVend($idUsuario, $documento);
                    }

                }

                $this->loadView("usuario/autoRegistro.php", [], "", "Usuário salvo com sucesso. Aguarde sua ativação.");
                exit;
            } catch (PDOException $e) {
                $erros = ["Erro ao salvar o usuário na base de dados." . $e];                
            }
        }

        //Adiciona o usuario nas tabelas Cliente/Vendedor

        
        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["confSenha"] = $confSenha;
        $dados["documento"] = $documento;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/autoRegistro.php", $dados, $msgsErro);
    }


    protected function delete() {
        $usuario = $this->findUsuarioById();
        if($usuario) {
            if($usuario->getTipoUsuario() == 'V') {
                $this->vendedorDAO->deleteById($usuario->getIdUsuario());
            }
            else if($usuario->getTipoUsuario() == 'C') {
                $this->clienteDAO->deleteById($usuario->getIdUsuario());
            }
            $this->usuarioDAO->deleteById($usuario->getIdUsuario());
            $this->list("", "Usuário excluído com sucesso!");
        } else
            $this->list("Usuario não econtrado!");
    }

    private function findUsuarioById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $usuario = $this->usuarioDAO->findById($id);
        return $usuario;
    }

    protected function autoReg() {
        //echo 'Teste';
        
        $this->loadView("usuario/autoRegistro.php", []);
    }

    private function saveClient($idUsuario, $documento){
        $cliente = new Cliente();
        $cliente->setIdUsuario($idUsuario);
        $cliente->setDocumento($documento);
        
        $this->clienteDAO->insertClient($cliente);
    }

    private function saveVend($idUsuario, $documento) {
        $vendedor = new Vendedor();
        $vendedor->setIdUsuario($idUsuario);
        $vendedor->setDocumento($documento);
        
        $this->vendedorDAO->insertVend($vendedor);
    }

}

#Criar objeto da classe
$usuCont = new UsuarioController();

?>