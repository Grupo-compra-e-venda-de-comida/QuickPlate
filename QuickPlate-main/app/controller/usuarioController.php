<?php
#Classe de controller para Usuario

require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/usuarioDAO.php");
require_once(__DIR__ . "/../dao/clienteDAO.php");
require_once(__DIR__ . "/../dao/vendedorDAO.php");
require_once(__DIR__ . "/../service/usuarioService.php");
require_once(__DIR__ . "/../model/usuario.php");
require_once(__DIR__ . "/../model/enum/tipoUsuario.php");

class UsuarioController extends Controller
{

    private UsuarioService $usuarioService;
    private UsuarioDAO $usuarioDAO;
    private ClienteDAO $clienteDAO;
    private VendedorDAO $vendedorDAO;

    public function __construct()
    {

        $this->usuarioService = new UsuarioService();
        $this->usuarioDAO = new UsuarioDAO();
        $this->clienteDAO = new ClienteDAO();
        $this->vendedorDAO = new VendedorDAO();

        //$this->setActionDefault("list");

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {
        $usuarios = $this->usuarioDAO->list();
        $dados["listaUsuarios"] = $usuarios;

        $this->loadView("home/index.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function reg()
    {
        $this->loadView("usuario/autoRegistro.php", []);
    }

    //Atualiza o perfil do usuario
    protected function update()
    {
        //Inicia o session
        $this->usuarioLogado();

        //Captura os dados do formulário
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $documento = isset($_POST['documento']) ? trim($_POST['documento']) : '';
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $confSenha = isset($_POST['confSenha']) ? trim($_POST['confSenha']) : '';
        $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : NULL;
        $tipoPessoa = isset($_POST['tipoPessoa']) ? trim($_POST['tipoPessoa']) : NULL;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setTipo($tipo);
        $usuario->setDocumento($documento);
        $usuario->setIdUsuario($idUsuario);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha, $documento, $tipoPessoa);

        if (empty($erros))
        $this->usuarioDAO->update($usuario);

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["confSenha"] = $confSenha;
        $dados["documento"] = $documento;
        $dados["tipoPessoa"] = $tipoPessoa;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/perfilEdit.php", $dados, $msgsErro);
    }

    //Carrega a página de edição de usuarios
    protected function pagEdit()
    {
        $usuario = $this->findUsuarioById();

        if ($usuario) {
            $idUsuario = $usuario->getIdUsuario();
            $dados["usuario"] = $usuario;

            if ($dados['usuario']->getTipo() == "V") {
                $vendedor = $this->vendedorDAO->findVendedorByIdUsuario($idUsuario);
                $dados['documento'] = $vendedor->getDocumento();

                $this->loadView("usuario/perfilEdit.php", $dados);
            } else if ($dados['usuario']->getTipo() == "C") {
                $cliente = $this->clienteDAO->findClienteByIdUsuario($idUsuario);
                $dados['documento'] = $cliente->getDocumento();

                $this->loadView("usuario/perfilEdit.php", $dados);
            } else {
                $this->list("Usuário não encontrado.");
            }
        }
    }

    protected function save()
    {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $documento = isset($_POST['documento']) ? trim($_POST['documento']) : '';
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $confSenha = isset($_POST['confSenha']) ? trim($_POST['confSenha']) : '';
        $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : NULL;
        $tipoPessoa = isset($_POST['tipoPessoa']) ? trim($_POST['tipoPessoa']) : NULL;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setTipo($tipo);
        $usuario->setDocumento(($documento));

        $ativo = "I";
        $usuario->setAtivo($ativo);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha, $documento, $tipoPessoa);
        if (empty($erros)) {
            //Persiste o objeto
            try {

                if ($dados["id"] == 0) {

                    //Inserindo
                    $idUsuario = $this->usuarioDAO->insert($usuario);

                    //Inserindo nas tabelas Cliente/Vendedor
                    if ($usuario->getTipo() == 'C') {
                        $this->saveClient($idUsuario, $documento);
                    } else if ($usuario->getTipo() == 'V') {
                        $this->saveVend($idUsuario, $documento, $tipoPessoa);
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
        $dados["tipoPessoa"] = $tipoPessoa;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/autoRegistro.php", $dados, $msgsErro);
    }

    //Inativa o usuario
    protected function inativar()
    {
        $usuario = $this->findUsuarioById();
        if ($usuario) {
            $this->usuarioDAO->inativar($usuario->getIdUsuario());
            $this->list("", "Usuário inativado com sucesso!");
        } else {
            $this->list("Usuario não encontrado!");
        }
    }

    //Deleta o usuario
    protected function delete()
    {
        $usuario = $this->findUsuarioById();
        if ($usuario) {
            if ($usuario->getTipoUsuario() == 'V') {
                $this->vendedorDAO->deleteById($usuario->getIdUsuario());
            } else if ($usuario->getTipoUsuario() == 'C') {
                $this->clienteDAO->deleteById($usuario->getIdUsuario());
            }
            $this->usuarioDAO->deleteById($usuario->getIdUsuario());
            $this->list("", "Usuário excluído com sucesso!");
        } else
            $this->list("Usuario não encontrado!");
    }

    private function findUsuarioById()
    {
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $usuario = $this->usuarioDAO->findById($id);
        return $usuario;
    }

    //Carrega a página para regristro de novos usuários
    protected function autoReg()
    {
        $this->loadView("usuario/autoRegistro.php", []);
    }

    //Salva o cliente
    private function saveClient($idUsuario, $documento)
    {
        $cliente = new Cliente();
        $cliente->setIdUsuario($idUsuario);
        $cliente->setDocumento($documento);

        $this->clienteDAO->insertClient($cliente);
    }

    //Salva o Vendedor
    private function saveVend($idUsuario, $documento, $tipoPessoa)
    {
        $vendedor = new Vendedor();
        $vendedor->setIdUsuario($idUsuario);
        $vendedor->setDocumento($documento);
        $vendedor->setTipoPessoa($tipoPessoa);

        $this->vendedorDAO->insertVend($vendedor);
    }
}

#Criar objeto da classe
$usuCont = new UsuarioController();
