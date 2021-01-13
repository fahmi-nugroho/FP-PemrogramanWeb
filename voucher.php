<?php
    include_once 'assets/template/header.php';

    if (!isset($_SESSION['user'])) {
        message('Mohon login terlebih dahulu');
        redirect('index.php');
    }

    $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(), $query);
    $data = mysqli_fetch_array($result);

    if (($data[4] == null || strlen($data[4]) == 0)
    || ($data[5] == null || strlen($data[5]) == 0)) {
        message('"Mohon lengkapi data diri"');
        redirect('index.php');
    }

    if (isset($_GET['jenis'])) {
      $jenis = $_GET['jenis'];
      $query = "SELECT * FROM voucher WHERE id_voucher = $jenis";
      $result = mysqli_query(connection(),$query);
      $voucher = mysqli_fetch_array($result);

    }
    elseif (isset($_POST['id_user'])) {

      $idorder = time();
      $tgl = date("d/m/Y");
      $id_voucher = $_POST['jenis'];
      $id_pelanggan = $_POST['id_user'];
      $id_user = $_SESSION['user']['id'];

      $jenis = $_GET['jenis'];
      $query = "SELECT * FROM user WHERE id_user = $id_user";
      $result = mysqli_query(connection(),$query);
      $user = mysqli_fetch_array($result);

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

      if ($metode == 'Wallet') {
        if ($data['wallet'] >= $harga) {
          $query = "INSERT INTO daftar_orderv VALUES (null, $idorder, $id_user, '$id_pelanggan', $id_voucher, '".$user['nama_user']."', '$tgl', '".$user['alamat_user']."', '".$user['telepon_user']."', $nominal, $harga, '$metode', 'Pesanan Selesai', 'wallet.png')";
          $wallet = $data['wallet'] - $harga;
          $queryUser = "UPDATE user SET wallet = $wallet WHERE id_user = ". $_SESSION['user']['id'];
          $resultUser = mysqli_query(connection(), $queryUser);
          if(!$resultUser){
            message('Ada Kesalahan, Mohon Coba Lagi');
            redirect('index.php');
          }
        }
        else {
          message("Saldo wallet tidak mencukupi, silahkan top-up terlebih dahulu.");
          redirect("dashboard.php");
        }
      }
      else {
        $query = "INSERT INTO daftar_orderv VALUES (null, $idorder, $id_user, '$id_pelanggan', $id_voucher, '".$user['nama_user']."', '$tgl', '".$user['alamat_user']."', '".$user['telepon_user']."', $nominal, $harga, '$metode', 'Menunggu Pembayaran', null)";
      }
      $result = mysqli_query(connection(),$query);
      if ($result) {
        if ($metode == 'Wallet') {
          message('Saldo Wallet Telah Dikurangi Sesuai Total Pembelian');
        }
        else {
          message('Pembelian akan diproses, mohon cek akun My Shop Anda');
        }
        redirect('dvoucher.php');
      }
      else {
        message('Ada Kesalahan, Mohon Coba Lagi');
        redirect('index.php');
      }
    }
    else {
      message('Ada Kesalahan, Mohon Coba Lagi');
      redirect('index.php');
    }

    $query = "SELECT email_user FROM user WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(),$query);
    $email = mysqli_fetch_array($result);
?>

<div class="container mt-5">
  <div class="row justify-content-center mx-auto">
    <div class="card mr-2 ml-2 mb-2" style="width: 16rem;">
      <img src="assets/img/voucher/<?php echo $voucher['gambar'] ?>" class="card-img-top" alt="<?php echo $data['jenis_voucher'] ?>">
    </div>
  </div>
  <form method="post" action="voucher.php?">
    <div class="form-group mb-3">
      <label for="id_voucher" class="form-label">Masukkan ID <?php echo $voucher['jenis_voucher'] ?> Anda</label>
      <?php if ($_GET['jenis'] == 5): ?>
        <input type="text" class="form-control" name="id_user" id="id_voucher" value="<?php echo $email['email_user'] ?>" required>
      <?php else: ?>
        <input type="text" class="form-control" name="id_user" id="id_voucher" required>
      <?php endif; ?>
    </div>
    <input type="hidden" class="form-control" name="jenis" id="id_voucher" value="<?php echo $_GET['jenis'] ?>">
    <div class="form-group mb-3">
      <label for="nominal" class="form-label">Nominal Top-Up</label>
      <select class="custom-select" aria-label="Default select example" name="nominal" id="nominal" aria-describedby="hargaHelp" required>
        <option value="" selected>Pilih Nominal</option>
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
        <option value="" selected>Pilih Metode Pembayaran</option>
        <?php if ($_GET['jenis'] == 5) : ?>
          <option value="2">Merchant (Indomart / Alfamart)</option>
          <option value="3">CC</option>
        <?php else: ?>
          <option value="1">Wallet</option>
          <option value="2">Merchant (Indomart / Alfamart)</option>
          <option value="3">CC</option>
        <?php endif; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-dark">Beli</button>
  </form>
</div>
