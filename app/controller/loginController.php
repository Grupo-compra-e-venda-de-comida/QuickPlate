<?php 
#Classe controller para a Logar do sistema
require_once(__DIR__ . "/controller.php");
require_once(__DIR__ . "/../dao/usuarioDAO.php");
require_once(__DIR__ . "/../service/loginService.php");
require_once(__DIR__ . "/../model/usuario.php");

class LoginController extends Controller {

    private LoginService $loginService;
    private UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->loginService = new LoginService();
        $this->usuarioDao = new UsuarioDAO();
        
        //Seta uma action padrão caso a mesmo não tenha sido enviada por parâmetro
        $this->setActionDefault("login");
        
        $this->handleAction();
    }

    protected function login() {
        $this->loadView("login/login.php", []);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logon() {
        //Habilitar o recurso de sessão no PHP nesta página
        //session_start();

        $email_usuario = trim($_POST['email']);
        $senha_usuario = trim($_POST['senha']);

        //Validações
        if(empty($email_usuario)) {
            echo "Informe o email do usuário.";
            exit;
        }

        if(empty($senha_usuario)) {
            echo "Informe a senha do usuário.";
            exit;
        }

        //Validar o login e senha
        //$usuarioCont = new UsuarioController();
        //$usuario = $usuarioCont->buscarPorLoginSenha($email_usuario, $senha_usuario);
        $usuario = $this->usuarioDao->findByLoginSenha(
            $email_usuario, $senha_usuario);

        //Se o usuário for NULL, indica que o login ou a senha estão errados
        if($usuario == null) {
            echo "Email ou Senha inválidos.";
            exit;
        }

        if($usuario->getAtivo() == 'I') {
            echo "O usuário está inativo.";
            exit; 
        }

        $this->salvarUsuarioSessao($usuario);
        //###### Login ocorreu com sucesso ########
        //Setar usuário na sessão do PHP
        //$_SESSION['usuarioLogadoId']   = $usuario->getIdUsuario();
        //$_SESSION['usuarioLogadoEmail'] = $usuario->getEmail();
        //$_SESSION['usuarioLogadoTipo'] = $usuario->getTipo();

        //Se logado com sucesso, retornar o objeto Usuario em forma JSON
        //echo "";

        echo json_encode($usuario);

        /*
        $login = isset($_POST['login']) ? trim($_POST['login']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        //Validar os campos
        $erros = $this->loginService->validarCampos($login, $senha);
        if(empty($erros)) {
            //Valida o login a partir do banco de dados
            $usuario = $this->usuarioDao->findByLoginSenha($login, $senha);
            if($usuario) {
                //Se encontrou o usuário, salva a sessão e redireciona para a HOME do sistema
                $this->salvarUsuarioSessao($usuario);

                header("location: " . HOME_PAGE);
                exit;
            } else {
                $erros = ["Login ou senha informados são inválidos!"];
            }
        }

        //Se há erros, volta para o formulário            
        $msg = implode("<br>", $erros);
        $dados["login"] = $login;
        $dados["senha"] = $senha;

        $this->loadView("login/login.php", $dados, $msg);
        */
    }

    /* Método para deslogar um usuário */
    protected function logout() {
        $this->removerUsuarioSessao();

        $this->loadView("login/login.php", [], "", "Usuário deslogado com suscesso!");
    }

    private function salvarUsuarioSessao(Usuario $usuario) {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Setar usuário na sessão do PHP
        $_SESSION[SESSAO_USUARIO_ID]   = $usuario->getIdUsuario();
        $_SESSION[SESSAO_USUARIO_NOME] = $usuario->getNome();
        $_SESSION[SESSAO_USUARIO_TIPO] = $usuario->getTipoUsuario();
    }

    private function removerUsuarioSessao() {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Destroi a sessão 
        session_destroy();
    }
}


#Criar objeto da classe
$loginCont = new LoginController();
