<?php

namespace App\Models;

require "../App/Connection.php";

use App\Connection;

class Usuarios extends Connection
{
    public $nome;
    public $email;
    public $senha;

    public function __set($atr, $val)
    {
        $this->$atr = $val;
    }
    public function __get($atr)
    {
        return $this->$atr;
    }

    // validar registro
    public function validarRegistro()
    {

        if (strlen($this->__get('nome')) < 3) {
            header('Location: /registro?erro_user_min');
            exit();
        }

        if (!preg_match('/[A-Za-z]/', $_POST['senha']) || !preg_match('/[0-9]/', $_POST['senha'])) {
            header('Location: /registro?erro=senha_invalida'); // 'Senha tem que ter caracteres e números';
            exit();
        }
        if (!preg_match('/^[\w$@]{6,}$/', $_POST['senha'])) {
            header('Location: /registro?erro=senha_min'); // 'Senha tem que tem 6 ou mais caracteres';
            exit();
        }

        if ($_POST['r-senha'] != $_POST['senha']) {
            header('Location: /registro?erro=form_senha');
            exit();
        }

        // query para ver se o email já está no banco de dados
        $query = 'select email from tb_usuarios where email = :email';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->email);
        $stmt->execute();

        // se o email já foi cadastrado, volta para a página com um erro
        if ($stmt->fetch(\PDO::FETCH_OBJ)) {
            header('Location: /registro?erro=email');
            exit();
        }

        return true;
    }

    // add registro ao banco de dados
    public function setRegistro()
    {

        $query = 'insert into tb_usuarios(nome, email, senha)values(:nome, :email, :senha)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);

        return $stmt->execute();
    }

    // Autenticação de usuário
    public function autenticarUsuario()
    {

        $query = 'select nome, email, senha from tb_usuarios where email = :email';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->email);

        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // retorna lista de todos os Usuários
    public function todosUsuarios()
    {
        $query = 'select id, nome, email from tb_usuarios';
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
