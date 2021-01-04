<?php
    include_once 'assets/template/header.php';

    if (!isset($_SESSION['user'])) {
        message('Mohon login terlebih dahulu');
        redirect('index.php');
    }

    if (isset($_GET['jenis'])) {
      $jenis = $_GET['jenis'];
      $query = "SELECT * FROM voucher WHERE id_voucher = $jenis";
      $result = mysqli_query(connection(),$query);
      $voucher = mysqli_fetch_array($result);
    }
    elseif (isset($_POST['id_user'])) {
      $tgl = date("d/m/Y");
      $id_voucher = $voucher['id_voucher'];
      $id_user = $_POST['id_user'];
      $id_pelanggan = $_SESSION['user']['id'];

      if ($_POST['nominal'] == 1) {
        $nominal = 50000;
        $tambahan = $nominal * 5 / 100;
        $harga = $nominal + $tambahan;
      }
      elseif ($_POST['nominal'] == 2) {
        $nominal = 100000;
        $tambahan = $nominal * 5 / 100;
        $harga = $nominal + $tambahan;
      }
      elseif ($_POST['nominal'] == 3) {
        $nominal = 150000;
        $tambahan = $nominal * 5 / 100;
        $harga = $nominal + $tambahan;
      }
      elseif ($_POST['nominal'] == 4) {
        $nominal = 200000;
        $tambahan = $nominal * 5 / 100;
        $harga = $nominal + $tambahan;
      }
      elseif ($_POST['nominal'] == 5) {
        $nominal = 300000;
        $tambahan = $nominal * 5 / 100;
        $harga = $nominal + $tambahan;
      }
      elseif ($_POST['nominal'] == 6) {
        $nominal = 500000;
        $tambahan = $nominal * 5 / 100;
        $harga = $nominal + $tambahan;
      }

      if ($_POST['metode'] == 1) {
        $metode = 'Wallet';
      }
      elseif ($_POST['metode'] == 2) {
        $metode = 'Merchant (Indomart / Alfamart)';
      }
      elseif ($_POST['metode'] == 3) {
        $metode = 'CC';
      }

      $query = "INSERT INTO order_detailv VALUES (null, $id_voucher, $id_user, $id_pelanggan, $nominal, $harga, '$metode', '$tanggal', 'Menunggu Pembayaran')";
      // $result = mysqli_query(connection(),$query);
      message('Pembelian akan diproses, mohon cek akun My Shop Anda');
      redirect('dashboard.php');
    }
    else {
      message('Ada Kesalahan, Mohon Coba Lagi');
      redirect('index.php');
    }
?>

<div class="container mt-5">
  <form method="post" action="voucher.php">
    <div class="form-group mb-3">
      <label for="id_voucher" class="form-label">Masukkan ID <?php echo $voucher['jenis_voucher'] ?> Anda</label>
      <input type="text" class="form-control" name="id_user" id="id_voucher" required>
    </div>
    <div class="form-group mb-3">
      <label for="nominal" class="form-label">Nominal Top-Up</label>
      <select class="custom-select" aria-label="Default select example" name="nominal" id="nominal" aria-describedby="hargaHelp" required>
        <option selected>Pilih Nominal</option>
        <option value="1">Rp. 50.000,00</option>
        <option value="2">Rp. 100.000,00</option>
        <option value="3">Rp. 150.000,00</option>
        <option value="4">Rp. 200.000,00</option>
        <option value="5">Rp. 300.000,00</option>
        <option value="6">Rp. 500.000,00</option>
      </select>
      <small id="hargaHelp" class="form-text text-muted">Harga yang dibayarkan belum termasuk biaya admin.</small>
    </div>
    <div class="form-group mb-3">
      <label for="metode" class="form-label">Metode Pembayaran</label>
      <select class="custom-select" aria-label="Default select example" name="metode" id="metode" required>
        <option selected>Pilih Metode Pembayaran</option>
        <option value="1">Wallet</option>
        <option value="2">Merchant (Indomart / Alfamart)</option>
        <option value="3">CC</option>
      </select>
    </div>
    <button type="submit" class="btn btn-dark">Beli</button>
  </form>
</div>
