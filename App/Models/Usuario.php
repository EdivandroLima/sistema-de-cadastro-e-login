<?php

namespace App\Models;

use Core\Connection;

class Usuario extends Connection
{

    public function novoRegistro(String $nome, String $email, String $senha)
    {
        $query = 'insert into tb_usuarios(nome, email, senha)values(:nome, :email, :senha)';
        $stmt = static::conexao()->prepare($query);
        $stmt->bindValue(':nome', htmlentities($nome));
        $stmt->bindValue(':email', htmlentities($email));
        $stmt->bindValue(':senha', password_hash($senha, PASSWORD_BCRYPT));

        return $stmt->execute();
    }

    public function verificarSeEmailExist(String $email): bool
    {
        $email = htmlentities($email);
        $query = 'select email from tb_usuarios where email = :email';
        $stmt = static::conexao()->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->fetch(\PDO::FETCH_OBJ)) {
            return true;
        } else {
            return false;
        }
    }

    public function autenticarUsuario(String $email, String $senha): bool
    {
        $query = 'select nome, email, senha from tb_usuarios where email = :email';
        $stmt = static::conexao()->prepare($query);
        $stmt->bindValue(':email', htmlentities($email));
        $stmt->execute();
        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!empty($usuario) && password_verify($senha, $usuario['senha'])) {
            session_cache_limiter('private');
            /* define o prazo do cache em minutos */
            session_cache_expire(43200);  // 30 dias
            session_start();
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['autenticado'] = true;
            return true;
        }
        return false;
    }
    
    /**
     * Retorna dados de todos os usuários
     *
     * @return void
     */
    public static function usuarios()
    {
        $query = 'select id, nome, email from tb_usuarios';
        $stmt = static::conexao()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
