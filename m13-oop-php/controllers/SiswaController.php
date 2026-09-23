<?php
require_once __DIR__ . '/../models/SiswaModel.php';

class SiswaController {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function index() {
        $siswaModel = new SiswaModel($this->db);
        $dataSiswa = $siswaModel->ambilSemua();

        // Panggil file view dan kirim data $dataSiswa ke dalamnya
        require_once __DIR__ . '/../views/siswa-list.php';
    }

    public function tambah() {
    // Panggil form view tambah
    require_once __DIR__ . '/../views/siswa-form.php';
}

public function simpan() {
    if (isset($_POST['submit'])) {
        $siswaModel = new SiswaModel($this->db);
        $siswaModel->tambah($_POST);

        // Setelah simpan, arahkan kembali ke halaman daftar
        header('Location: index.php?controller=siswa&aksi=index');
        exit;
    }
}
}