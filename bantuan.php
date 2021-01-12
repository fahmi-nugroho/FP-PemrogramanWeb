<?php
    session_start();
    require 'conn.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

    <link rel="icon" type="image/png" href="assets/img/voucher/wallet.png">

    <title>My Shop</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
      <a class="navbar-brand" href="index.php">My Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <h5 class="ml-auto mr-auto">Layanan Pelanggan</h5>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="dashboard.php" class="btn btn-outline-dark"><?= $_SESSION['user']['nama'] ?></a>
        <?php else: ?>
            <button class="btn btn-outline-dark mr-3" type="button" data-toggle="modal" data-target="#login">Masuk</button>
            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#register">Daftar</button>
        <?php endif; ?>
      </div>
    </nav>
    <div class="container">
      <?php if ($_GET['jenis'] == 1): ?>
        <div class="mt-3 alert alert-dark" role="alert">
          Cara Pembelian
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Tahapan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Login dan lengkapi data diri terlebih dahulu.</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Pilih Barang yang ingin dibeli, lalu masukkan ke keranjang.</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Lakukan checkout pada halaman cart.</td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>Lakukan pembayaran pada halaman dashboard.</td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Tunggu proses pengiriman yang akan dilakukan penjual.</td>
            </tr>
            <tr>
              <th scope="row">6</th>
              <td>Selesaikan pesanan jika dirasa barang yang diterima sudah benar.</td>
            </tr>
          </tbody>
        </table>
      <?php elseif ($_GET['jenis'] == 2): ?>
        <div class="mt-3 alert alert-dark" role="alert">
          Pengiriman
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Kurir</th>
              <th scope="col">Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>JNE</td>
              <td>Didirikan tahun 1990, PT Tiki Jalur Nugraha Ekakurir (JNE) melayani masyarakat dalam urusan jasa kepabeanan terutama import atas kiriman peka waktu melalui gudang 'Rush Handling'.</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>POS</td>
              <td>Pos Indonesia merupakan sebuah Badan Usaha Milik Negara (BUMN) Indonesia yang bergerak di bidang layanan pos. Saat ini, bentuk badan usaha Pos Indonesia merupakan Perseroan Terbatas dan sering disebut dengan PT. Pos Indonesia. Bentuk usaha Pos Indonesia ini berdasarkan Peraturan Pemerintah Republik Indonesia Nomor 5 Tahun 1995. Peraturan Pemerintah tersebut berisi tentang pengalihan bentuk awal Pos Indonesia yang berupa perusahaan umum (perum) menjadi sebuah perusahaan persero.</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>TIKI</td>
              <td>TIKI adalah perusahaan jasa pengiriman terkemuka di Indonesia, berdiri pertama kali di Jakarta pada tahun 1970. Hingga saat ini, TIKI memiliki jaringan operasional yang meliputi 65 kota besar di Indonesia, didukung oleh lebih dari 500 kantor perwakilan, lebih dari 3700 gerai dan lebih dari 6.000 karyawan di seluruh Indonesia.</td>
            </tr>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
