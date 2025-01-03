<?php
include "koneksi.php"; // Pastikan koneksi database sudah benar

// Ambil data artikel dari database
$sql = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil = $conn->query($sql);
?>

<table class="table table-hover">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th class="w-25">Judul</th>
      <th class="w-75">Isi</th>
      <th class="w-25">Gambar</th>
      <th class="w-25">Aksi</th>
    </tr>
  </thead>
  <tbody>

    <?php

    include "koneksi.php";
    $no = 1;

    $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 3;
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);


    while ($row = $hasil->fetch_assoc()) {
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td>
        <strong><?= $row["judul"] ?></strong>
        <br>pada : <?= $row["tanggal"] ?>
        <br>oleh : <?= $row["username"] ?>
      </td>
      <td><?= $row["isi"] ?></td>
      <td>
        <?php
        if ($row["gambar"] != '' && file_exists('gambar/' . $row["gambar"])) {
        ?>
        <img src="gambar/<?= $row["gambar"] ?>" width="100" alt="Gambar Artikel">
        <?php
        }
        ?>
      </td>
      <td>
        <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal"
          data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
        <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal"
          data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>

        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit<?= $row["id"] ?>" tabindex="-1" aria-labelledby="modalEditLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditLabel">Edit Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="proses_edit.php" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel"
                      value="<?= $row["judul"] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea class="form-control" name="isi" placeholder="Tuliskan Isi Artikel"
                      required><?= $row["isi"] ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="gambar" class="form-label">Ganti Gambar</label>
                    <input type="file" class="form-control" name="gambar">
                  </div>
                  <div class="mb-3">
                    <label for="gambar_lama" class="form-label">Gambar Lama</label>
                    <?php
                    if ($row["gambar"] != '' && file_exists('gambar/' . $row["gambar"])) {
                    ?>
                    <br><img src="gambar/<?= $row["gambar"] ?>" width="100" alt="Gambar Lama">
                    <?php
                    }
                    ?>
                    <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Akhir Modal Edit -->

        <!-- Modal Hapus -->
        <div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1" aria-labelledby="modalHapusLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalHapusLabel">Konfirmasi Hapus Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="proses_hapus.php">
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="konfirmasiHapus" class="form-label">Yakin akan menghapus artikel
                      "<strong><?= $row["judul"] ?></strong>"?</label>
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <input type="submit" value="Hapus" name="hapus" class="btn btn-danger">
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Akhir Modal Hapus -->
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<?php 
$sql1 = "SELECT * FROM article";
$hasil1 = $conn->query($sql1); 
$total_records = $hasil1->num_rows;
?>
<p>Total article : <?php echo $total_records; ?></p>
<nav class="mb-2">
  <ul class="pagination justify-content-end">
    <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
        $end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;

        if($hlm == 1){
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($hlm > 1)? $hlm - 1 : 1;
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for($i = $start_number; $i <= $end_number; $i++){
            $link_active = ($hlm == $i)? ' active' : '';
            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }

        if($hlm == $jumlah_page){
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
        $link_next = ($hlm < $jumlah_page)? $hlm + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
        }
    ?>
  </ul>
</nav>



<?php
$conn->close(); // Menutup koneksi database setelah selesai
?>