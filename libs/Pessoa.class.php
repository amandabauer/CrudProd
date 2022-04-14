<?php

class Pessoa {
    private $id;
    private $nome;
    private $email;
    private $usu_id;
    private $datacadastro;
    private $dataalteracao;

    public function __construct($id = null, $nome = null, $email = null, $usu_id = null, $datacadastro = null, $dataalteracao = null)
    {
        $this->id            = $id;
        $this->nome          = $nome;
        $this->email         = $email;
        $this->usu_id        = $usu_id;
        $this->datacadastro  = $datacadastro;
        $this->dataalteracao = $dataalteracao;
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

    public function getUsu_id()
    {
        return $this->usu_id;
    }

    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    public function getDataalteracao()
    {
        return $this->dataalteracao;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUsu_id($usu_id)
    {
        $this->usu_id = $usu_id;
    }

    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
    }

    public function setDataalteracao($dataalteracao)
    {
        $this->dataalteracao = $dataalteracao;
    }

    public function buscar () {
        $conn = new Conexao();
        return $conn->getSelect("SELECT * FROM pessoa");
    }

    public function gravar($nome, $email, $senha) {

        $conn = new Conexao();

        $sSqlUsuario = `SELECT id FROM usuario WHERE email = $email;`;
        $iUsuarioID = $conn->getSelect($sSqlUsuario);
        if (!$iUsuarioID) {
            $sSqlInsercaoUsuario = `INSERT INTO usuario (nome, email, senha) VALUES ($nome, $email, $senha);`;
            if ($conn->query($sql) === TRUE) {
                $iUsuarioID = $conn->getSelect($sSqlUsuario);
            } else {
                return "Erro: $sSqlInsercaoUsuario <br> $conn->error";
            }

        }

        $sSqlInsercaoPessoa = `INSERT INTO pessoa (nome, email, usu_id) VALUES ($nome, $email, $iUsuarioID);`;
        if ($conn->query($sql) === TRUE) {
            return "Pessoa criada com sucesso!";
        } else {
            return "Erro: $sSqlInsercaoPessoa <br> $conn->error";
        }

    }

    public function excluir($id) {
        $conn = new Conexao();
        $sSql = "DELETE FROM usuario WHERE id = $id";     
        
        if ($conn->delete($sSql) == 1) {
            return "Pessoa excluida com sucesso!";
        } else {
            return "Erro: $sSql <br> $conn->error";
        }
    }

}

