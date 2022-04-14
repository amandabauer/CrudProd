<?php

class Conexao{

    private $username = 'root';
    private $password = '';
    private $banco    = 'aulawebll';
    private $host     = 'localhost';
    private $conn;

    public function __construct(){
        try{
            $conn = new PDO("mysql:dbname={$this->banco};host={$this->host}", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET CHARACTER SET utf8");
            
            return $this->conn = $conn;
        }catch(PDOException $erro){
            echo  'Erro :' . $erro->getMessage();
        }

    }

    public function getConn(){
        return $this->conn;
    }

    public function getSelect($sql){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_NUM);
    }

    public function delete($sSql) {
        $stmt = $this->conn->prepare($sSql);        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_NUM);
    }

}
