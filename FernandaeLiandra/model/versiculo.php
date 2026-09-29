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

    // Inserir novo versiculo
    public function create($usuario_id, $versiculo, $foto) {
        $query = "INSERT INTO " . $this->table . " (usuario_id, versiculo, foto) VALUES (:usuario_id, :versiculo, :foto)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':versiculo', $versiculo);
        $stmt->bindParam(':foto', $foto);
        return $stmt->execute();
    }

    // Atualizar versículo
    public function update($usuario_id, $versiculo, $foto) {
        $query = "UPDATE " . $this->table . " SET versiculo = :versiculo, foto = :foto WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':versiculo', $versiculo);
        $stmt->bindParam(':foto', $foto);
        return $stmt->execute();
    }

    // Apagar versículo
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}