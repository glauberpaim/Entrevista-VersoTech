<?php
require "includes/connection.php";

class userModel{
	
	public function __construct(){
		$this->database = (new Connection);
	}

	public function listarUsuarios(){
		$this->database->tratamento("SELECT * FROM 'users'", null);
		$users = $this->database->result(); 
		return $users;
	}

	public function user($id){
		$binder = array(':id' => $id);
		$this->database->tratamento("SELECT * FROM 'users' WHERE id = :id", $binder);
		$result = $this->database->result();
		return $result; 
	
	}
	public function usuario_existe($userId){
		$data = $this->user($userId);
		$arr = array();
		foreach($data as $key=>$items){
			$data = get_object_vars($items);
			list("id" => $id, "name" => $name, "email" => $email) = $data;
			$arr[] = [$id, $name, $email];
		}
		return !empty($arr) ? true : false;
	}
	public function updateUser($keys)
	{
		// Construir a consulta SQL base
			$query = "UPDATE users SET";

			// Verificar se o nome foi preenchido
			if (!empty($keys[':name'])) {
			    $query .= " name = :name,";
			}

			// Verificar se o e-mail foi preenchido
			if (!empty($keys[':email'])) {
			    $query .= " email = :email,";
			}

			// Remover a vírgula final, se houver
			$query = rtrim($query, ',');

			// Adicionar a cláusula WHERE
			$query .= " WHERE id = :id";

		$this->database->tratamento($query, $keys);

	}
	
	public function user_color_existe($id){
		$binder = array(':id' => $id);
		$data = $this->database->tratamento("SELECT users.name AS uName, user_colors.user_id AS ucUid, colors.name AS cName FROM users INNER JOIN user_colors ON user_colors.user_id = users.id  INNER JOIN colors ON user_colors.color_id = colors.id WHERE users.id = :id", $binder);
		$result = $this->database->result();
		
		$arr = array();
		
		foreach($result as $key=>$items){
			$data = get_object_vars($items);
			list("ucUid" => $id, "uName" => $name, "cName" => $colorName) = $data;
			$arr[$id] = [$name, $colorName];
		}
		return !empty($arr) ? true : false;
	}		
	
	public function deleteUser($id){
		$arr = array(':id' => $id);
		$this->database->tratamento("DELETE FROM users where id = :id", $arr);
	}

	public function criarUsuario($arr){
		$arr = array(":nome" => $arr['name'], ':email' => $arr['email']);
		$this->database->tratamento("INSERT INTO 'users' (name, email) values (:nome, :email)", $arr);
	}
	
	public function allColors(){
		$this->database->tratamento("SELECT * FROM colors", null);
		return $this->database->result();
	}

	public function deleteUserColor($userId){
		$binder = array(':id' => $userId );
		$this->database->tratamento("DELETE FROM user_colors where user_id = :id", $binder);

	}

	public function saveUserColor($userId, $cor){
		$binder = array(':userId'=> $userId, ':cor' => $cor);
		$this->database->tratamento("INSERT INTO user_colors (user_id, color_id) VALUES (:userId, :cor)",$binder);
	
	}
	public function allColorsList(){
		$this->database->tratamento("SELECT users.id AS usId, users.name AS usName, colors.name AS colName FROM users INNER JOIN user_colors ON user_colors.user_id = users.id  INNER JOIN colors ON user_colors.color_id = colors.id", null);
		$result = $this->database->result();
		return $result;
	}
	public function selectUserColor($userId){
		$binder = array(":id" => $userId);
		$this->database->tratamento("SELECT colors.id, colors.name FROM users INNER JOIN user_colors ON user_colors.user_id = users.id  INNER JOIN colors ON user_colors.color_id = colors.id WHERE users.id = :id", $binder);

		$state = $this->database->result();
		
		foreach($state as $key => $row){
			$arr[$row->id] = $row->name;
		}

		return isset($arr) ? $arr : '';
		}
	}


?>