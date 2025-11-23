<?php
include 'conn.php';

// ======================
// Ambil data artis dari API
// ======================
$api_url = "https://restapiuaspraktek-artislokal-default-rtdb.firebaseio.com/artis.json?print=pretty";
$artis_json = file_get_contents($api_url);
$artis_data = json_decode($artis_json, true);

// ======================
// PROSES TAMBAH EVENT
// ======================
if(isset($_POST['tambah'])){
    $nama = $_POST['nama_event'];
    $lokasi = $_POST['lokasi'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $contact = $_POST['contact_panitia'];
    $id_artis = $_POST['id_artis'];

    $sql = "INSERT INTO eventmusik (nama_event, lokasi, waktu_mulai, waktu_selesai, contact_panitia, id_artis) 
            VALUES ('$nama', '$lokasi', '$waktu_mulai', '$waktu_selesai', '$contact', '$id_artis')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}

// ======================
// PROSES EDIT EVENT
// ======================
if(isset($_POST['edit'])){
    $id = $_POST['id_event'];
    $nama = $_POST['nama_event'];
    $lokasi = $_POST['lokasi'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $contact = $_POST['contact_panitia'];
    $id_artis = $_POST['id_artis'];

    $sql = "UPDATE eventmusik SET 
                nama_event='$nama',
                lokasi='$lokasi',
                waktu_mulai='$waktu_mulai',
                waktu_selesai='$waktu_selesai',
                contact_panitia='$contact',
                id_artis='$id_artis'
            WHERE id_event='$id'";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}

// ======================
// PROSES HAPUS EVENT
// ======================
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $sql = "DELETE FROM eventmusik WHERE id_event='$id'";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}

// Ambil data event
$query = "SELECT * FROM eventmusik ORDER BY waktu_mulai ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Event & Artis Musik</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Data Event & Artis Musik</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">+ Tambah Event</button>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Lokasi</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Kontak Panitia</th>
                        <th>Artis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_event'] ?></td>
                            <td><?= $row['lokasi'] ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['waktu_mulai'])) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['waktu_selesai'])) ?></td>
                            <td><?= $row['contact_panitia'] ?></td>
                            <td>
                                <?php
                                if($row['id_artis'] && isset($artis_data[$row['id_artis']])){
                                    $artis = $artis_data[$row['id_artis']];
                                    echo $artis['nama'] . " / " . $artis['kategori'] . " / " . $artis['genre'];
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm editBtn"
                                    data-id="<?= $row['id_event'] ?>"
                                    data-nama="<?= $row['nama_event'] ?>"
                                    data-lokasi="<?= $row['lokasi'] ?>"
                                    data-waktu_mulai="<?= $row['waktu_mulai'] ?>"
                                    data-waktu_selesai="<?= $row['waktu_selesai'] ?>"
                                    data-contact="<?= $row['contact_panitia'] ?>"
                                    data-id_artis="<?= $row['id_artis'] ?>"
                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                    Edit
                                </button>
                                <a href="?hapus=<?= $row['id_event'] ?>" 
                                   onclick="return confirm('Yakin ingin menghapus event ini?')" 
                                   class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if(mysqli_num_rows($result) == 0): ?>
                        <tr>
                            <td colspan="8">Belum ada data event musik.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Event Musik</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Event</label>
          <input type="text" name="nama_event" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Lokasi</label>
          <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Waktu Mulai</label>
          <input type="datetime-local" name="waktu_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Waktu Selesai</label>
          <input type="datetime-local" name="waktu_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Kontak Panitia</label>
          <input type="text" name="contact_panitia" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Artis</label>
          <select name="id_artis" class="form-control" required>
            <option value="">-- Pilih Artis --</option>
            <?php if($artis_data): ?>
                <?php foreach($artis_data as $id => $artis): ?>
                    <option value="<?= $id ?>"><?= $artis['nama'] ?> / <?= $artis['kategori'] ?> / <?= $artis['genre'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Event Musik</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_event" id="edit_id">
        <div class="mb-3">
          <label>Nama Event</label>
          <input type="text" name="nama_event" id="edit_nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Lokasi</label>
          <input type="text" name="lokasi" id="edit_lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Waktu Mulai</label>
          <input type="datetime-local" name="waktu_mulai" id="edit_waktu_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Waktu Selesai</label>
          <input type="datetime-local" name="waktu_selesai" id="edit_waktu_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Kontak Panitia</label>
          <input type="text" name="contact_panitia" id="edit_contact" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Artis</label>
          <select name="id_artis" id="edit_id_artis" class="form-control" required>
            <option value="">-- Pilih Artis --</option>
            <?php if($artis_data): ?>
                <?php foreach($artis_data as $id => $artis): ?>
                    <option value="<?= $id ?>"><?= $artis['nama'] ?> / <?= $artis['kategori'] ?> / <?= $artis['genre'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit" class="btn btn-warning">Update</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
    $('.editBtn').click(function(){
        $('#edit_id').val($(this).data('id'));
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_lokasi').val($(this).data('lokasi'));
        $('#edit_waktu_mulai').val($(this).data('waktu_mulai').replace(' ', 'T'));
        $('#edit_waktu_selesai').val($(this).data('waktu_selesai').replace(' ', 'T'));
        $('#edit_contact').val($(this).data('contact'));
        $('#edit_id_artis').val($(this).data('id_artis'));
    });
});
</script>

</body>
</html>
