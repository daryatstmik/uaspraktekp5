<?php
include('conn.php');

if(isset($_POST['update'])){
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $genre = $_POST['genre'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $kewarganegaraan = $_POST['kewarganegaraan'];
    $tahun_debut = $_POST['tahun_debut'];
    $tag = array_map('trim', explode(',', $_POST['tag']));
    $instagram = $_POST['instagram'];
    $youtube = $_POST['youtube'];
    $jumlah_event = $_POST['jumlah_event'];

    $updateData = [
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

    $reference = $database->getReference('artis/' . $id);
    $reference->update($updateData);

    // Redirect ke index.php setelah edit
    header("Location: index.php");
    exit();
}
?>
