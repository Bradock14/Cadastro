<?php
// Classe de conexão ao banco de dados
class Database {
    private $host = 'localhost';
    private $db_name = 'nome_do_banco';
    private $username = 'usuario';
    private $password = 'senha';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
        }
        return $this->conn;
    }
}

// Classe de cadastro
class Cadastro {
    private $name;
    private $email;
    private $password;
    private $conn;

    public function __construct($name, $email, $password, $conn) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->conn = $conn;
    }

    public function cadastrar() {
        $query = 'INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->email);
        $stmt->bindParam(3, $this->password);

        if ($stmt->execute()) {
            echo 'Cadastro realizado com sucesso!';
        } else {
            echo 'Erro ao cadastrar.';
        }
    }
}

// Verifica se os dados foram
