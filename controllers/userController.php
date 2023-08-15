<?php
require_once "includes/globais.php";
class userController extends globais{
	
	//View Action
	public function index(){
		$userModel = new userModel();
		$conteudo = $userModel->listarUsuarios();
		$tabela = "<th>id</th><th>Nome</th><th>email</th><th>Ação</th><tr>";
		$caminho = "controller=user";
		$href = "index.php?{$caminho}&action=atribuir&id="; 
		$colunaActs = true;
		$link = true;
		$excluir = '';

		require_once('views/listar.php');
	}

	public function view($id){
		$userModel = new userModel();
		$user = $userModel->user($id);

		include_once ('views/editar.php');
	}
	public function atribuidas(){
		$userModel = new userModel();
		$link = false;
		$colunaActs = false;
		$conteudo = $userModel->allColorsList();
		$tabela = '<th>id</th><th>Usuário</th><th>Cor</th><tr>';
		require ('views/listar.php');
	}

	public function editar($userId){
		$userModel = new userModel();
		$user = $userModel->usuario_existe($userId) ? $userModel->user($userId) : header("Location: index.php"); ;

		$content = sprintf("
			<center><strong>Editar Usuário</strong></center>
			<form class = 'space-y-4 mt-4' method = 'POST' action = 'index.php?controller=user&action=update&id=%s'>
				Nome : <input class = 'input_text' name = 'name' type = 'text'><br>
				E-mail : <input class = 'input_text' name = 'email' type = 'email'><br>
				<button class = 'w-1/4 bg-green-300 shadow rounded-xl' type = 'submit'>
					Enviar!
				</button>

			</form>", $userId);
		include_once("views/editar.php");
	}

	public function cadastro(){
		$action = 'index.php?controller=user&action=postAction';
		$campos = sprintf("
			Nome : <input class = 'input_text' name = 'name' type = 'text' required><br>

			E-mail : <input class = 'input_text' name = 'email' type = 'email' required><br>");
		include_once('views/cadastro.php');
	}

	public function atribuir($userId){
		$userModel = new userModel();
		$user = $userModel->usuario_existe($userId) ? $userModel->user($userId) : header("Location: index.php");
		$cores = $userModel->allColors();
		$check = is_array($userModel->selectUserColor($userId)) ? $userModel->selectUserColor($userId):
			[];
		$action = "index.php?controller=user&action=action_Atribuir&id={$userId}";

		require_once("views/atribuir.php");			
	}

	// Form Actions
	public function action_Atribuir(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$userModel = new userModel();
			//echo var_dump($_POST["cores"][$item]); $_GET['id'];
			$userModel->deleteUserColor($_GET['id']);

			foreach($_POST["cores"] as $item => $cor){
				$userModel->saveUserColor($_GET['id'], $item);
			}		
			
			echo sprintf("
				<script>
				window.location = 'index.php?controller=user&action=index'
				setTimeout(alert('Dados atualizados com sucesso!'), 1000);
				</script>");
		}
	}
	public function postAction(){

		if($_SERVER['REQUEST_METHOD'] == "POST" && parent::is_valid($_POST) == true){
			$data = $_POST;
			$userModel = new userModel();
			$userModel->criarUsuario($data); // Por enquanto a global passa direto
			echo sprintf("
				<script>
				window.location = 'index.php?controller=user&action=index';
				setTimeout(alert('Usuário criado com sucesso!'), 1000);
				</script>");
		}else{
				echo sprintf("
					<script>
					window.location = 'index.php'
					setTimeout(alert('Dados inválidos!'), 1000);
					</script>");
		}
	}

	public function update($userId){
		$userModel = new userModel();
		$user = $userModel->usuario_existe($userId);
		
		echo "Redirecionando ...";

		if($_SERVER['REQUEST_METHOD'] == 'POST' && parent::is_valid($_POST) && $user){
			
			$keys = array(':id' => $userId, ':name' => '', ':email' => '');
			$keys[':name'] = isset($_POST['name']) ? $keys[':name'] = $_POST['name']: '';
			$keys[':email'] = isset($_POST['email']) ? $keys[':email'] = $_POST['email']: '';
			$userModel->updateUser($keys);
			echo sprintf("
					<script>
					window.location = 'index.php?controller=user&action=index'
					setTimeout(alert('Usuário alterado com sucesso'), 1000);
					</script>");
		}else{
				echo sprintf("
					<script>
					window.location = 'index.php'
					setTimeout(alert('Dados inválidos!'), 1000);
					</script>");
		}
	
	}
	
	public function excluir($userId)
	{	
		$userModel = new userModel();
		$user = $userModel->usuario_existe($userId);
		
		echo "Redirecionando ...";
		
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $user)
		{
			$userModel->user_color_existe($userId) ? $userModel->deleteUserColor($userId) : null;
			$userModel->deleteUser($userId);
			
				echo sprintf("
					<script>
					//window.location = 'index.php?controller=user&action=index'
					setTimeout(alert('O usuário foi excluído com sucesso!'), 1000);
					</script>");
		
		}else{
			echo "<script> alert(houve algum erro na sua solicitação.);</script>";
		}

	}
}

?>