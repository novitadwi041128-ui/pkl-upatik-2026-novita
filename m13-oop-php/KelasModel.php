<?php
class KelasModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Mengambil semua data kelas
    public function ambilSemua() {
        $stmt = $this->db->query("SELECT * FROM kelas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil satu data kelas berdasarkan ID
    public function ambilSatu($id) {
        $stmt = $this->db->prepare("SELECT * FROM kelas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>