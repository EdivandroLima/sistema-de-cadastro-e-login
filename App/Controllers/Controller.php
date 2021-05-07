<?php
	namespace App\Controllers;
	
	require_once "../App/Controllers/Action.php";
	require_once "../App/Models/Usuarios.php";

	use App\Action\Action;
	use App\Models\Usuarios;

	class Controllers extends Action  {
		
		public function index() {
			// 'index' vai ser para selecionar o arquivo 'index.phtml' e layout para selecionar o arquivo 'layout.phtml'
			$this->render('index', 'layout');
		}

		public function login() {

			$this->render('login', 'layout');
		}

		public function registro() {

			$this->render('registro', 'layout');
		}

		public function registroSalvar() {

			$usuario= new Usuarios();

			$usuario->__set('nome', htmlentities($_POST['nome']));
			$usuario->__set('email', htmlentities($_POST['email']));
			$usuario->__set('senha', password_hash($_POST['senha'], PASSWORD_BCRYPT));

			// se 'validarRegistro()' for true, seta o registro
			if ($usuario->validarRegistro()) {
				$usuario->setRegistro();
				header('Location: /registro?info=success');
			}
		}


		public function autenticar() {

			$usuario= new Usuarios();
			$usuario->__set('email', htmlentities($_POST['email']));

			$dados= $usuario->autenticarUsuario();

			if (!empty($dados) && password_verify($_POST['senha'], $dados['senha'])) {
				// se login for sucesso vai criar as sessions
				session_start();
				$_SESSION['nome']= $dados['nome'];
				$_SESSION['email']= $dados['email'];
				$_SESSION['autenticado']= true;

				if (isset($_POST['lembrar_me'])) {
					$this->lembrarMe($dados['email']);
				}
				header('Location: /dashboard');
			}
			else {
				header('Location: /login?login=erro');
			}
		}

		public function dashboard() {
			// validar acesso
			$this->validaAutenticacao();
			$this->render('dashboard', 'layoutDashboard');
		}

		// vai listar todos os usuários
		public function usuarios() {
			$this->validaAutenticacao();
			$usuarios= new Usuarios();
			$this->todosUsuarios= $usuarios->todosUsuarios();
			$this->render('usuarios', 'layoutDashboard');
		}

		// se não tiver autenticado pelo login vai ser redirecionado para '/?auth=not'
		public function validaAutenticacao() {
			session_start();

			if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
				header('Location: /?auth=not');
			}
		}

		// deslogar, destruindo a sesssion
		public function logout() {
			session_start();
			session_destroy();
			$validade= time() - 3600;
			$cookie= setcookie('sisgen_user', '', $validade, "/", "", false, true);
			header('Location: /');
		}

		public function lembrarMe($user) {
			$validade= strtotime('+1 month');
			$cookie= setcookie('sisgen_user', $user, $validade, "/", "", false, true);
		}
	}
	
?>