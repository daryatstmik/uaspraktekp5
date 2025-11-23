<?php
include('conn.php');

if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $genre = $_POST['genre'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $kewarganegaraan = $_POST['kewarganegaraan'];
    $tahun_debut = intval($_POST['tahun_debut']);
    $tag = array_map('trim', explode(',', $_POST['tag'])); // pisah tag
    $instagram = $_POST['instagram'];
    $youtube = $_POST['youtube'];
    $jumlah_event = intval($_POST['jumlah_event']);

    // Siapkan data untuk Firebase
    $data = [
        'nama' => $nama,
        'genre' => $genre,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
        'kewarganegaraan' => $kewarganegaraan,
        'tahun_debut' => $tahun_debut,
        'tag' => $tag,
        'sosial' => [
            'instagram' => $instagram,
            'youtube' => $youtube
        ],
        'jumlah_event' => $jumlah_event
    ];

    // Simpan ke Firebase
    $reference = $database->getReference('artis');
    $newRef = $reference->push($data);

    // Redirect ke index.php
    header('Location: index.php');
    exit;
}
?>
