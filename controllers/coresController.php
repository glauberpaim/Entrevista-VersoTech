<?php
require_once "includes/globais.php";
require "models/coresModel.php";
	class coresController extends globais{
		public function __construct(){
			$this->caminho = 'cores';
		}
		public function index(){
			$colorModel = new coresModel();
			$conteudo = $colorModel->listarCores();
			$colunaActs = true;
			$link = false;
			$caminho = "controller={$this->caminho}";
			$tabela = "<th>id</th><th>Nome</th><th>Ação</th><tr>";
			$excluir = "Teste";
			require_once("views/listar.php");
		}

		public function cadastro(){
			$action = 'index.php?controller=cores&action=postAction';
			$campos = sprintf("

				Nome : <input class = 'input_text' name = 'name' class = 'shadow rounded-xl' type = 'text' required><br>
				");

			require_once("views/cadastro.php");
		}

		public function editar($id){
			$colorModel = new coresModel();
			$cor = $colorModel->cor($id);

			$content = sprintf("
				<center><strong>Editar Cor</strong></center>
				<form class = 'space-y-4 mt-4' method = 'POST' action = 'index.php?controller=cores&action=update&id=%s'>
					Nome : <input class = 'input_text' name = 'name' type = 'text'><br>
					<button class = 'w-1/4 bg-green-300 shadow rounded-xl' type = 'submit'>
						Enviar!
					</button>

				</form>", $id);
			include_once("views/editar.php");
		}
		public function postAction(){
			if($_SERVER['REQUEST_METHOD'] == "POST" && parent::is_valid($_POST)){
				$data = $_POST;
				$colorModel = new coresModel();
				$verifcar = ''; // TRATAMENTO DA GLOBAL!
				$colorModel->novaCor($data); // Por enquanto a global passa direto
				echo sprintf("
					<script>
					window.location = 'index.php?controller=cores&action=index'
					setTimeout(alert('Cor criada com sucesso!'), 1000);
					</script>");
			}else{
				echo sprintf("
					<script>
					window.location = 'index.php'
					setTimeout(alert('Dados inválidos!'), 1000);
					</script>");
		}
		}

		public function update($id){
			$colorModel = new coresModel();
			$cor = $colorModel->cor_existe($id);
			
			echo "Redirecionando";
			
			if($_SERVER['REQUEST_METHOD'] == "POST" && parent::is_valid($_POST) && $cor){
				$data = $_POST;
				$arr = array('id' => $id, 'name' => $data['name']);
				$colorModel->update($arr);
				sleep(1);
				header("location: index.php?controller=cores&action=index");
				exit;
			}else{
				sleep(1);
				header("location: index.php");
				exit;
			}
		}
		public function excluir($id)
		{	
			$colorModel = new coresModel();
			$cor = $colorModel->cor_existe($id);

			if($_SERVER['REQUEST_METHOD'] == 'POST' && $cor)
			{
				$colorModel->deletarCor($id);
					echo sprintf("
						<script>
						window.location = 'index.php?controller=cores&action=index'
						setTimeout(alert('A cor foi excluída com sucesso!'), 1000);
						</script>");
			}
		}
	}


?>