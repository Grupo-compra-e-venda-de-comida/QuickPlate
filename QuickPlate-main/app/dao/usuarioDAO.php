<?php
#Classe DAO para o model de Usuario

include_once(__DIR__ . "/../connection/connection.php");
include_once(__DIR__ . "/../model/usuario.php");

class UsuarioDAO {

    //Método para buscar um usuario por seu login e senha
    public function findByLoginSenha($email_usuario, $senha_usuario) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u" .
               " WHERE u.email_usuario = ? AND u.senha_usuario = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$email_usuario, $senha_usuario]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByLoginSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u" . 
        " ORDER BY u.id_usuario";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUsuarios($result);
    }

    private function mapUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setIdUsuario($reg['id_usuario']);
            $usuario->setNome($reg['nome']);
            $usuario->setEmail($reg['email_usuario']);
            $usuario->setSenha($reg['senha_usuario']);
            $usuario->setTipo($reg['tipo_usuario']);
            $usuario->setAtivo($reg['ativo']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    } 

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO usuario (email_usuario, senha_usuario, tipo_usuario, nome, ativo)" .
               " VALUES (:email, :senha, :tipo, :nome, :ativo)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("senha", $usuario->getSenha());
        $stm->bindValue("tipo", $usuario->getTipo());
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("ativo", $usuario->getAtivo());
        $stm->execute();

        return $conn->lastInsertId();
    }

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuario u" .
               " WHERE u.id_usuario = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    public function findClientId(){
        $idUsuario = $_SESSION[SESSAO_USUARIO_ID];

        $conn = Connection::getConn();

        $sql = "SELECT id_cliente FROM cliente c" .
            " WHERE c.id_cliente = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario]);
        $result = $stm->fetchAll();

        $id = print_r($result[0]);

        return $id;
    }

    //Atualiza o perfil do usuario
    public function update(Usuario $usuario) {
        //echo($usuario->getIdUsuario());
        
        $conn = Connection::getConn();

        $sql = "UPDATE usuario SET nome = :nome, email_usuario = :email_usuario, senha_usuario = :senha_usuario" .   
               " WHERE id_usuario = :id_usuario";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("email_usuario", $usuario->getEmail());
        $stm->bindValue("senha_usuario", $usuario->getSenha());
        $stm->bindValue("id_usuario", $usuario->getIdUsuario());
        $stm->execute();
    }

    //Método para Inativar um Usuario pelo ID
    public function inativar(int $id) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuario SET ativo = 'I' WHERE id_usuario = :id_usuario";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id_usuario", $id);
        $stm->execute();

    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id_usuario", $id);
        $stm->execute();
    }

}

?>