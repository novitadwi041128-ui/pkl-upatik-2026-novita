<?php
// Mendefinisikan Class Siswa
class Siswa {
    public $nama;
    private $email; // Visibility private untuk keamanan data internal

    // Constructor untuk inisialisasi data saat object dibuat
    public function __construct($namaBaru, $emailBaru) {
        $this->nama = $namaBaru;
        $this->email = $emailBaru;
    }

    // Method untuk menampilkan kartu nama siswa
    public function tampilkanKartu() {
        return "<div style='border: 1px solid #333; padding: 10px; margin: 5px; width: 250px; border-radius: 5px;'>
                    <h3>Kartu Siswa</h3>
                    <p><b>Nama:</b> {$this->nama}</p>
                    <p><b>Email:</b> {$this->email}</p>
                </div>";
    }
}

// Pengujian membuat Object dari Class Siswa
$siswa1 = new Siswa("Dwi Novita", "dwi@upatik.com");
$siswa2 = new Siswa("Budi Santoso", "budi@upatik.com");

// Menampilkan hasil method
echo $siswa1->tampilkanKartu();
echo $siswa2->tampilkanKartu();
?>