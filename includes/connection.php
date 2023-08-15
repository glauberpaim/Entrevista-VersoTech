<?php

class Connection {

    private $databaseFile;
    private $connection;
    protected $estadoAtual;
    public function __construct()
    {
        $this->databaseFile = realpath("./database/db.sqlite");
        $this->connect();
        $this->estadoAtual = null;
    }

    private function connect()
    {
        return $this->connection = new PDO("sqlite:{$this->databaseFile}");
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }
    
    # Cria a query e espera os valores de dentro da Array
    public function tratamento($query, $arr) 
    {
        $connect = $this->getConnection();
        $state = $connect->prepare($query);    

        if(is_array($arr)){
            foreach($arr as $key => $item){
                $state->bindParam($key, $arr[$key], PDO::PARAM_STR);
                }
            }        
        $state->execute();
        $this->estadoAtual = $state;

    }

    # Retorna o resultado a partir do estado atual do tratamento
    public function result(){
        
        $this->estadoAtual->setFetchMode(PDO::FETCH_INTO, new stdClass);
        return $this->estadoAtual;
    
    }
}