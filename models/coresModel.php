<?php

class coresModel{
	public function __construct(){
		$this->database = (new Connection);
	}

	public function listarCores(){
		$this->database->tratamento("SELECT * FROM 'colors'", null);
		$cores = $this->database->result();
		return $cores;
	}

	public function cor($id){
		$arr = array(':id' => $id);
		$this->database->tratamento("SELECT * FROM 'colors' where id = :id", $arr);
	
		return $this->database->result();
	}
	public function update($arr)
	{
		$binder = array(':id' => $arr['id'], ':name' => $arr['name']);
		$this->database->tratamento("UPDATE colors SET name = :name where id = :id ", $binder);

	}
	public function deletarCor($id)
	{
		$arr = array(':id'=> $id);
		$this->database->tratamento("DELETE FROM 'colors' where id = :id", $arr);
	}
	public function novaCor($data){
		$arr = array(':name' => $data['name']);
		$this->database->tratamento("INSERT INTO 'colors' (name) VALUES (:name)", $arr)
		;
	}
	
	public function cor_existe($corId){
		$data = $this->cor($corId);
		$arr = array();
		foreach($data as $key=>$items){
			$data = get_object_vars($items);
			list("id" => $id, "name" => $name) = $data;
			$arr[] = [$id, $name];
		}
		return !empty($arr) ? true : false;
	}
}


?>