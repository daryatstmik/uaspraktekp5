<?php
include('conn.php');

$id = $_GET['id'];

// Hapus data artis berdasarkan ID
$ref = $database->getReference('artis/'.$id)->remove();

// Setelah hapus, kembali ke index dengan alert
if($ref){
    echo "<script>
            alert('Artis berhasil dihapus!');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus artis!');
            window.location.href = 'index.php';
          </script>";
}
?>
