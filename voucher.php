<?php
    include_once 'assets/template/header.php';

    if (!isset($_SESSION['user'])) {
        message('Mohon login terlebih dahulu');
        redirect('index.php');
    }

    if (isset($_GET['jenis'])) {
      $jenis = $_GET['jenis'];
    }
    else {
      message('Ada Kesalahan, Mohon Coba Lagi');
      redirect('index.php');
    }
?>

<div class="container mt-5">
  <form>
    <div class="form-group mb-3">
      <label for="id_voucher" class="form-label">Masukkan ID <?php echo $jenis ?> Anda</label>
      <input type="text" class="form-control" name="id" id="id_voucher">
    </div>
    <div class="form-group mb-3">
      <label for="nominal" class="form-label">Nominal Top-Up</label>
      <select class="custom-select" aria-label="Default select example" name="nominal" id="nominal">
        <option selected>Pilih Nominal</option>
        <option value="1">Rp. 50.000,00</option>
        <option value="2">Rp. 100.000,00</option>
        <option value="3">Rp. 150.000,00</option>
        <option value="4">Rp. 200.000,00</option>
        <option value="5">Rp. 300.000,00</option>
        <option value="6">Rp. 500.000,00</option>
      </select>
    </div>
    <div class="form-group mb-3">
      <label for="metode" class="form-label">Metode Pembayaran</label>
      <select class="custom-select" aria-label="Default select example" name="metode" id="metode">
        <option selected>Pilih Metode Pembayaran</option>
        <option value="1">Wallet</option>
        <option value="2">Merchant (Indomart / Alfamart)</option>
        <option value="3">CC</option>
      </select>
    </div>
    <div class="form-group mb-3">
      <label for="email" class="form-label">Masukkan E-mail Anda</label>
      <input type="email" class="form-control" name="email" id="email">
    </div>
    <button type="submit" class="btn btn-dark">Beli</button>
  </form>
</div>
