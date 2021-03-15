<?php

	namespace App\Models;

	require "../App/Conection.php";

	use App\Conection;

	class Usuarios extends Conection {

		public $nome;
		public $email;
		public $senha;

		public function __set($atr, $val) {
			$this->$atr=$val;
		}
		public function __get($atr) {
			return $this->$atr;
		}
		
		// validar registro
		public function validarRegistro() {

			$form= true;

			if (strlen($this->__get('nome')) < 3) {
				$form= false;
			}
			if (strlen($this->__get('email')) < 3) {
				$form= false;
			}
			if (strlen($_POST['senha']) < 6) {
				
				header('Location: /registro?erro=senha_min&'.strlen($_POST['senha']));
				exit();	
			}

			// query para ver se o email já está no banco de dados
			$query= 'select email from tb_usuarios where email = :email';
			$stmt= $this->db->prepare($query);
			$stmt->bindValue(':email', $this->email);
			$stmt->execute();



			if (!$form) {
				header('Location: /registro?erro=form');
				exit();				
			}

			// se o email já foi cadastrado, volta para a página com um erro
			if ($stmt->fetch(\PDO::FETCH_OBJ)) {
				header('Location: /registro?erro=usuario');
				exit();	
			}

			return true;
			
		}

		// add registro ao banco de dados
		public function setRegistro() {

			$query= 'insert into tb_usuarios(nome, email, senha)values(:nome, :email, :senha)';
			$stmt= $this->db->prepare($query);
			$stmt->bindValue(':nome', $this->nome);
			$stmt->bindValue(':email', $this->email);
			$stmt->bindValue(':senha', $this->senha);

			return $stmt->execute();
			
		}

		// Autenticação de usuário
		public function autenticarUsuario() {

			$query= 'select nome, email, senha from tb_usuarios where email = :email && senha = :senha';
			$stmt= $this->db->prepare($query);
			$stmt->bindValue(':email', $this->email);
			$stmt->bindValue(':senha', $this->senha);

			$stmt->execute();

			$autenticar= true;

			return $stmt->fetch(\PDO::FETCH_ASSOC);

			
		}

		// retorna lista de todos os Usuários
		public function todosUsuarios() {
			$query= 'select id, nome, email from tb_usuarios';
			$stmt= $this->db->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}


	}

?>