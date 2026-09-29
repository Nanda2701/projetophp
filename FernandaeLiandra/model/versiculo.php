<?php

class versiculo {
    private $conn;
    private $table = "versiculo";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar todos os versículos com nome do autor
    public function getAll() {
        $query = "SELECT n.*, u.nome AS autor 
                  FROM " . $this->table . " n 
                  JOIN usuarios u ON n.usuario_id = u.id 
                  ORDER BY n.criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Buscar versiculo por ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Inserir nova notícia
    public function create($usuario_id, $titulo, $conteudo) {
        $query = "INSERT INTO " . $this->table . " (usuario_id, titulo, conteudo) VALUES (:usuario_id, :capitulo, :conteudo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':conteudo', $conteudo);
        return $stmt->execute();
    }

    // Atualizar notícia
    public function update($id, $titulo, $conteudo) {
        $query = "UPDATE " . $this->table . " SET titulo = :titulo, conteudo = :conteudo WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':conteudo', $conteudo);
        return $stmt->execute();
    }

    // Apagar notícia
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}