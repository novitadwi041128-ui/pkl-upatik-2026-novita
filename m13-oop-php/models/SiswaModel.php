<?php
class SiswaModel {
    private $db;

    // Constructor untuk menerima koneksi PDO dari luar
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // 1. Mengambil seluruh data siswa
    public function ambilSemua() {
    $query = "SELECT siswa.*, kelas.nama_kelas, jurusan.nama_jurusan 
              FROM siswa 
              JOIN kelas ON siswa.id_kelas = kelas.id 
              JOIN jurusan ON kelas.id_jurusan = jurusan.id";
    $stmt = $this->db->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // 2. Mengambil satu data siswa berdasarkan ID (Prepared Statement)
    public function ambilSatu($id) {
        $stmt = $this->db->prepare("SELECT * FROM siswa WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3. Menambah data siswa baru (Prepared Statement)
   public function tambah($data) {
    $query = "INSERT INTO siswa (nama, email, id_kelas, tanggal_daftar) VALUES (:nama, :email, :id_kelas, :tanggal_daftar)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
        'nama' => $data['nama'],
        'email' => $data['email'],
        'id_kelas' => $data['id_kelas'],
        'tanggal_daftar' => $data['tanggal_daftar']
    ]);
}

    // 4. Mengubah data siswa berdasarkan ID (Prepared Statement)
    public function ubah($id, $data) {
        $stmt = $this->db->prepare("UPDATE siswa SET nama = ?, email = ? WHERE id = ?");
        return $stmt->execute([$data['nama'], $data['email'], $id]);
    }

    // 5. Menghapus data siswa berdasarkan ID (Prepared Statement)
    public function hapus($id) {
        $stmt = $this->db->prepare("DELETE FROM siswa WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>