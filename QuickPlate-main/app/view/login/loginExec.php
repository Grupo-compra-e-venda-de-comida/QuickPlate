<?php
#Arquivo para processar a requisição POST do login

include_once("controller/usuarioController.php");

//Habilitar o recurso de sessão no PHP nesta página
session_start();

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
$usuarioCont = new UsuarioController();
/*
$usuario = $usuarioCont->buscarPorTipo($email_usuario, $senha_usuario, $tipo_usuario);
*/
$usuario = $usuarioCont->buscarPorLoginSenha($email_usuario, $senha_usuario);

//Se o usuário for NULL, indica que o login ou a senha estão errados
if($usuario == null) {
    echo "Email ou Senha inválidos.";
    exit;
}

echo $usuario->getAtivo();
exit;

if($usuario->getAtivo() == 'I') {
    echo "O usuário está inativo.";
    exit; 
}

//###### Login ocorreu com sucesso ########
//Setar usuário na sessão do PHP
$_SESSION['usuarioLogadoId']   = $usuario->getIdUsuario();
$_SESSION['usuarioLogadoEmail'] = $usuario->getEmail();
//$_SESSION['usuarioLogadoTipo'] = $usuario->getTipo();

//Se logado com sucesso, retornar o objeto Usuario em forma JSON
//echo "";
echo json_encode($usuario);

?>