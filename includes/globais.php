<?php

class globais{
	
	public function __construct()
	{
		$this->item = '';
	
	}

	public function is_valid($variavel)
	{
		if(is_array($variavel))
		{
			foreach($variavel as $key=>$item){
				if($this->filtro($variavel[$key]) == false){
					$this->item = false;
					return $this->item;
					break;
				}else{
					return $this->item = true;

				}	
			}
		}else{
				$this->item = $this->filtro($variavel);
		}
	}

	public function filtro($variavel)
	{
		 //$_POST['INPUT_VALUE']
		$pattern = '/[?$+=#%¨&*():;]/';

		if(!preg_match_all($pattern, $variavel))
		{
			return true;
		}else{
			return false;
		}
	}
}

?>