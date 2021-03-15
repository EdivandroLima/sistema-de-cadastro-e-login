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

		public function sobre() {

			$this->render('sobre', 'layout');
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
			$usuario->__set('senha', md5($_POST['senha']));

			// se a senha e repetir senha forem diferentes
			if (md5($_POST['r-senha']) != $usuario->__get('senha')) {
				header('Location: /registro?erro=form_senha');
				exit();	
			}

			// se 'validarRegistro()' for true, seta o registro
			if ($usuario->validarRegistro()) {
				$usuario->setRegistro();
				header('Location: /registro?info=success');
			}
			
			
		}


		public function autenticar() {
			$usuario= new Usuarios();

			$usuario->__set('email', htmlentities($_POST['email']));
			$usuario->__set('senha', md5($_POST['senha']));

			$dados= $usuario->autenticarUsuario();

			// se usuário não for encontrado
			if (empty($dados)) {
				header('Location: /login?login=erro');
			}

			else {
				// se login for sucesso vai criar as sessions
				session_start();
				$_SESSION['nome']= $dados['nome'];
				$_SESSION['email']= $dados['email'];
				$_SESSION['autenticado']= true;

				header('Location: /dashboard');
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
			header('Location: /');
		}
		
	}
	
?>