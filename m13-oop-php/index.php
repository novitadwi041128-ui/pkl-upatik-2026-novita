<?php
require_once 'config/koneksi.php';
require_once 'controllers/SiswaController.php';

$controllerName = $_GET['controller'] ?? 'siswa';
$aksi = $_GET['aksi'] ?? 'index';

if ($controllerName == 'siswa') {
    $controller = new SiswaController($pdo);

    if ($aksi == 'index') {
        $controller->index();
    } elseif ($aksi == 'tambah') {
        $controller->tambah();
    } elseif ($aksi == 'simpan') {
        $controller->simpan();
    }
}