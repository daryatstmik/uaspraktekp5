<?php
include('conn.php');
$reference = $database->getReference('artis');
$snapshot = $reference->getValue();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Artis</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #eef2f7;
    font-family: 'Poppins', sans-serif;
}
.header-title {
    background: linear-gradient(135deg, #0061ff, #60efff);
    padding: 25px 20px;
    font-size: 28px;
    color: white;
    font-weight: 600;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.table thead th {
    background: #003b82 !important;
    color: white;
}
.badge-tag {
    background: #007bff;
    padding: 5px 8px;
    border-radius: 6px;
    font-size: 12px;
}
.btn-action {
    border-radius: 8px;
    padding: 5px 10px;
}
.desc-text {
    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

</head>
<body>

<div class="container mt-5">

    <div class="header-title mb-4 d-flex justify-content-between align-items-center">
        <span>🎤 Data Artis Lokal</span>
        <button class="btn btn-light text-primary fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
            ➕ Tambah Artis
        </button>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body">

            <?php if($snapshot) { ?>

            <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Genre</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Kewarganegaraan</th>
                        <th>Debut</th>
                        <th>Tag</th>
                        <th>Instagram</th>
                        <th>Youtube</th>
                        <th>Event</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1;
                foreach($snapshot as $id => $row) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="fw-bold"><?= $row['nama']; ?></td>
                        <td><span class="badge bg-primary"><?= $row['genre']; ?></span></td>
                        <td><span class="badge bg-info text-dark"><?= $row['kategori']; ?></span></td>
                        <td class="desc-text" title="<?= $row['deskripsi']; ?>"><?= $row['deskripsi']; ?></td>
                        <td><?= $row['kewarganegaraan']; ?></td>
                        <td><span class="badge bg-secondary"><?= $row['tahun_debut']; ?></span></td>
                        <td>
                            <?php 
                            if(is_array($row['tag'])) {
                                foreach($row['tag'] as $tg) {
                                    echo "<span class='badge bg-warning text-dark me-1'>$tg</span>";
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php if(!empty($row['sosial']['instagram'])) { ?>
                                <a href="<?= $row['sosial']['instagram']; ?>" class="badge bg-danger" target="_blank">IG</a>
                            <?php } else { echo "-"; } ?>
                        </td>
                        <td>
                            <?php if(!empty($row['sosial']['youtube'])) { ?>
                                <a href="<?= $row['sosial']['youtube']; ?>" class="badge bg-dark" target="_blank">YT</a>
                            <?php } else { echo "-"; } ?>
                        </td>
                        <td><span class="badge bg-success"><?= $row['jumlah_event']; ?></span></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm btn-action" 
                                    data-bs-toggle="modal" data-bs-target="#modalEdit<?= $id; ?>">
                                ✏ Edit
                            </button>
                            <a href="delete.php?id=<?= $id; ?>" class="btn btn-danger btn-sm btn-action" 
                               onclick="return confirm('Hapus artis ini?')">🗑 Hapus</a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $id; ?>" tabindex="-1">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          
                          <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title">✏ Edit Artis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <form action="edit.php?id=<?= $id; ?>" method="POST">
                            <div class="modal-body">

                              <div class="mb-3">
                                  <label class="form-label">Nama Artis</label>
                                  <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Genre</label>
                                  <input type="text" name="genre" class="form-control" value="<?= $row['genre']; ?>" required>
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Kategori</label>
                                  <input type="text" name="kategori" class="form-control" value="<?= $row['kategori']; ?>" required>
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Deskripsi</label>
                                  <textarea name="deskripsi" class="form-control" rows="3"><?= $row['deskripsi']; ?></textarea>
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Kewarganegaraan</label>
                                  <input type="text" name="kewarganegaraan" class="form-control" value="<?= $row['kewarganegaraan']; ?>">
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Tahun Debut</label>
                                  <input type="number" name="tahun_debut" class="form-control" value="<?= $row['tahun_debut']; ?>">
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Tag (pisahkan dengan koma)</label>
                                  <input type="text" name="tag" class="form-control" value="<?= is_array($row['tag']) ? implode(',', $row['tag']) : ''; ?>">
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Instagram</label>
                                  <input type="text" name="instagram" class="form-control" value="<?= $row['sosial']['instagram'] ?? ''; ?>">
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">YouTube</label>
                                  <input type="text" name="youtube" class="form-control" value="<?= $row['sosial']['youtube'] ?? ''; ?>">
                              </div>

                              <div class="mb-3">
                                  <label class="form-label">Jumlah Event</label>
                                  <input type="number" name="jumlah_event" class="form-control" value="<?= $row['jumlah_event']; ?>">
                              </div>

                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="submit" name="update" class="btn btn-success">💾 Update</button>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>

                <?php } ?>
                </tbody>

            </table>
            </div>

            <?php } else { ?>

            <div class="alert alert-info text-center">Belum ada data artis.</div>

            <?php } ?>

        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalAdd" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">➕ Tambah Artis</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="add.php" method="POST">
        <div class="modal-body">

          <div class="mb-3">
              <label class="form-label">Nama Artis</label>
              <input type="text" name="nama" class="form-control" required>
          </div>

          <div class="mb-3">
              <label class="form-label">Genre</label>
              <input type="text" name="genre" class="form-control" required>
          </div>

          <div class="mb-3">
              <label class="form-label">Kategori</label>
              <input type="text" name="kategori" class="form-control" required>
          </div>

          <div class="mb-3">
              <label class="form-label">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="3"></textarea>
          </div>

          <div class="mb-3">
              <label class="form-label">Kewarganegaraan</label>
              <input type="text" name="kewarganegaraan" class="form-control">
          </div>

          <div class="mb-3">
              <label class="form-label">Tahun Debut</label>
              <input type="number" name="tahun_debut" class="form-control">
          </div>

          <div class="mb-3">
              <label class="form-label">Tag (pisahkan dengan koma)</label>
              <input type="text" name="tag" class="form-control">
          </div>

          <div class="mb-3">
              <label class="form-label">Instagram</label>
              <input type="text" name="instagram" class="form-control">
          </div>

          <div class="mb-3">
              <label class="form-label">YouTube</label>
              <input type="text" name="youtube" class="form-control">
          </div>

          <div class="mb-3">
              <label class="form-label">Jumlah Event</label>
              <input type="number" name="jumlah_event" class="form-control" value="0">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" name="submit" class="btn btn-success">💾 Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
