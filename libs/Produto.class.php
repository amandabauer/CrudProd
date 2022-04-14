<?php

class Produto {
    private $id;
    private $nome;
    private $email;

    public function __construct($id = null, $nome = null, $email = null)
    {
        $this->id            = $id;
        $this->nome          = $nome;
        $this->email         = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

   
    public function setId($id)
    {
        $this->id = $id;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function buscar () {
        $conn = new Conexao();
        return $conn->getSelect("SELECT * FROM pessoas");
    }


        $sSqlInsercaoPessoa = `INSERT INTO pessoas (nome, email) VALUES ($nome, $email);`;
        if ($conn->query($sql) === TRUE) {
            return "Pessoa criada com sucesso!";
        } else {
            return "Erro: $sSqlInsercaoPessoa <br> $conn->error";
        }

    }
}


