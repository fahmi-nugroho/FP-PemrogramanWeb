<?php
  require 'conn.php';
  session_start();

  if (!isset($_SESSION['user'])) {
      message('Mohon login terlebih dahulu');
      redirect('index.php');
  }

  $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
  $result = mysqli_query(connection(), $query);
  $data = mysqli_fetch_array($result);

  if (isset($_POST['password'])) {
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = "UPDATE user SET pass_user='$pass' WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(), $query);
    if ($result) {
      message('Password Berhasil Diubah');
    }
    else {
      message('Password Gagal Diubah');
    }
    redirect('dashboard.php');
    echo $pass;
  }

  if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $nomor = $_POST['kontak'];
    $alamat = $_POST['alamat'];

    $error = $_FILES['gambar']['error'];

    if ($error == 4) {
      if (isset($data['foto_user'])) {
        $gambar = $data['foto_user'];
      }
      else {
        $gambar = null;
      }
    }
    else {
      unlink("./assets/img/profil/".$data['foto_user']);
      $nama_file = $_FILES['gambar']['name'];
      $tmpName = $_FILES['gambar']['tmp_name'];

      $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
      $ekstensiGambar = explode('.', $nama_file);
      $ekstensiGambar = strtolower(end($ekstensiGambar));

      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        message('Yang Anda Upload Bukan Gambar!');
        redirect('dashboard.php');
      }
      else {
        $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
        $tujuan = 'assets/img/profil/'.$namaFileBaru;

        move_uploaded_file($tmpName, $tujuan);
        $gambar = $namaFileBaru;
      }
    }
    $query = "UPDATE user SET nama_user='$nama', telepon_user='$nomor', alamat_user='$alamat', foto_user='$gambar' WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(), $query);
    if ($result) {
      message('Profil Berhasil Diubah');
    }
    else {
      message('Profil Gagal Diubah');
    }
    redirect('dashboard.php');
    // message($nama.$nomor.$gambar);
  }

  if (isset($_POST['rating'])) {
    $rating = $_POST['rating'];

    $sql = "INSERT INTO rating VALUES (null, ".$_POST['id_order'].", ".$_POST['id_user'].", ".$_POST['id_barang'].", $rating)";
    $result = mysqli_query(connection(), $sql);
    if ($result) {
      message("Pemberian Rating Berhasil");
    }
    else {
      message("Pemberian Rating Gagal");
    }
    redirect('dashboard.php');
  }

  if (isset($_POST['id_order'])) {
    $nama_file = $_FILES['nota']['name'];
    $tmpName = $_FILES['nota']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nama_file);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      message('Yang Anda Upload Bukan Gambar!');
      redirect('dashboard.php');
    }
    else {
      $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
      $tujuan = 'assets/img/bukti/'.$namaFileBaru;

      move_uploaded_file($tmpName, $tujuan);
      $gambar = $namaFileBaru;
      $query = "UPDATE daftar_order SET status = 'Menunggu Pengiriman', bukti = '$gambar' WHERE id = ".$_POST['id_order'];
      $result = mysqli_query(connection(), $query);
    }
    if ($result) {
      message('Pembayaran Berhasil Dilakukan');
    }
    else {
      message('Pembayaran Gagal Dilakukan');
    }
    redirect('dashboard.php');
  }
  // message('kah');
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

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
      <a class="navbar-brand" href="index.php">My Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <h5 class="pt-2 mr-2 ml-auto"><?php echo $data['nama_user'] ?></h5>
        <?php
        if (strlen($data['foto_user']) === 0) {
          echo "<img src='assets/img/profil/playstation1.png' style='width: 40px; height: 40px; border: 1px solid black; border-radius: 50%;'>";
        }
        else {
          echo "<img src='assets/img/profil/".$data['foto_user']."' style='width: 40px; height: 40px; border: 1px solid black; border-radius: 50%;'>";
        }
        ?>
        <h5><a href="logout.php" class="" data-toggle="tooltip" title="Keluar"><i class="fas fa-sign-out-alt mt-2 ml-2 text-dark"></i></a></h5>
      </div>
    </nav>

    <div class="row no-gutters mt-5">
      <div class="col-md-2 bg-light mt-2 pr-3 pt-3">
        <ul class="nav flex-column ml-3 mb-3">
          <li class="nav-item">
            <a class="nav-link active text-dark" href="dashboard.php"><i class="fas fa-user mr-2"></i> Profil</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-dark" href="dvoucher.php"><i class="fas fa-ticket-alt"></i> Voucher</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="toko.php"><i class="fas fa-store mr-2"></i> Toko</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="penjualan.php"><i class="fas fa-store mr-2"></i> Penjualan</a>
          </li>
        </ul>
      </div>
      <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-user mr-2"></i> Profil</h3>
        <hr>
        <div class="row align-items-center">
          <div class="col-4">
            <div class="card bg-dark ml-auto mr-auto text-white" style="width: 20rem;">
              <?php
              if (strlen($data['foto_user']) === 0) {
                echo "<img src='assets/img/profil/playstation1.png' style='width: 100px; height: 100px; border: 1px solid white; border-radius: 50%;' class='card-img-top mr-auto ml-auto mt-2'>";
              }
              else {
                echo "<img src='assets/img/profil/".$data['foto_user']."' style='width: 100px; height: 100px; border: 1px solid white; border-radius: 50%;' class='card-img-top mr-auto ml-auto mt-2'>";
              }
              ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['nama_user'] ?></h5>
                <p class="card-text"><?php echo $data['email_user'] ?></p>
                <div class="row mt-3">
                  <a href="#" class="btn btn-light mr-auto ml-auto" data-toggle="modal" data-target="#gantiSandi">Ganti Sandi</a>
                  <a href="#" class="btn btn-light mr-auto ml-auto" data-toggle="modal" data-target="#gantiProfil">Ganti Profil</a>
                </div>
              </div>
            </div>
            <div class="modal fade" id="gantiSandi" tabindex="-1" aria-labelledby="gantiSandiLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="gantiSandiLabel">Ganti Sandi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="dashboard.php">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                      </div>
                      <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnPassword" class="btn btn-primary">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="gantiProfil" tabindex="-1" aria-labelledby="gantiProfilLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="gantiProfilLabel">Ganti Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_user'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $data['alamat_user'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="nomorKontak">Nomor Kontak</label>
                        <input type="text" class="form-control" name="kontak" id="nomorKontak" value="<?php echo $data['telepon_user'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="inputGambar<?= $_SESSION['user']['id'] ?>">Gambar</label>
                        <div class="mb-3">
                          <div class="input-group mb-3">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputGambar<?= $_SESSION['user']['id'] ?>" name="gambar" aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="inputGambar<?= $_SESSION['user']['id'] ?>">Foto Profil</label>
                              <script>
                                $('#inputGambar<?= $_SESSION['user']['id'] ?>').on('change',function(){
                                  var upload = document.getElementById('inputGambar<?= $_SESSION['user']['id'] ?>').files;
                                  if (upload[0].size > 2000000) {
                                    alert('File Melebihi 2MB');
                                  }
                                  else {
                                    //get the file name
                                    var fileName = $(this).val();
                                    var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                                    //replace the "Choose a file" label
                                    $(this).next('.custom-file-label').html(cleanFileName);
                                  }
                                })
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-5">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col">Saldo My Shop</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo "Rp. ".number_format($data['wallet'], 2, ',', '.') ?></td>
                  <td><a href="voucher.php?jenis=5"><button type="button" class="btn btn-dark">Isi Saldo +</button></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row mt-2 mb-2">
          <h4 class="mr-auto ml-auto"><i class="fas fa-history"></i> Riwayat</h4>
        </div>
        <div class="row">
          <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">ID Order</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            	<?php
                $query = "SELECT * FROM daftar_order WHERE id_user = ".$_SESSION['user']['id']." ORDER BY id_order DESC";
                $result = mysqli_query(connection(), $query);

                $no = 1;

                while ($data = mysqli_fetch_array($result)):
                    if ($data['status'] == "Menunggu Pengiriman") {
                        echo "<tr class='table-primary'>";
                    } elseif ($data['status'] == "Proses Pengiriman") {
                        echo "<tr class='table-warning'>";
                    } elseif ($data['status'] == "Pesanan Selesai") {
                        echo "<tr class='table-success'>";
                    } elseif ($data['status'] == "Pesanan Dibatalkan") {
                        echo "<tr class='table-danger'>";
                    } else {
                        echo "<tr>";
                    }

                    ?>
                        <td><?= $no++;?></td>
                        <td><?= $data['id_order']?></td>
                        <td><?= $data['tanggal']?></td>
                        <td>Rp. <?= number_format($data['total']) ?>,00</td>
                        <td class="text-center">
                            <button id="detail" type="button" class="btn btn-sm btn-info" name="button" data-toggle="modal" data-target="#detailOrder-<?= $data['id'] ?>">
                                Detail
                            </button>
                            <?php if ($data['status'] == "Menunggu Pembayaran"): ?>
                                <button id="bayar" type="button" class="btn btn-sm btn-warning" name="button" data-toggle="modal" data-target="#bayarBarang-<?= $data['id']?>">
                                  Bayar
                                </button>
                                <button id="cancel" type="button" class="btn btn-sm btn-danger" name="button" data-toggle="modal" data-target="#cancelBarang-<?= $data['id']?>">
                                    Cancel
                                </button>
                            <?php elseif ($data['status'] == "Menunggu Pengiriman"): ?>
                                <button id="cancel" type="button" class="btn btn-sm btn-danger" name="button" data-toggle="modal" data-target="#cancelBarang-<?= $data['id']?>">
                                    Cancel
                                </button>
                            <?php elseif ($data['status'] == "Proses Pengiriman"): ?>
                              <button id="selesai" type="button" class="btn btn-sm btn-success" name="button" data-toggle="modal" data-target="#selesaiBarang-<?= $data['id']?>">
                                  Selesai
                              </button>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <div class="modal fade" id="detailOrder-<?= $data['id'] ?>" tabindex="-1" aria-labelledby="detailOrderLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="detailOrderLabel">Detail Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <dl class="row mb-0">
                                  <dt class="col-sm-3">ID Order</dt>
                                  <dd class="col-sm-9"><?= $data['id_order']?></dd>

                                  <dt class="col-sm-3">Status</dt>
                                  <dd class="col-sm-9"><?= $data['status']?></dd>

                                  <dt class="col-sm-3">Toko</dt>
                                  <dd class="col-sm-9"><?= mysqli_fetch_array(mysqli_query(connection(), "SELECT nama_user FROM user WHERE id_user = ".$data['id_penjual']))[0] ?></dd>

                                  <dt class="col-sm-3">Tanggal Pembelian</dt>
                                  <dd class="col-sm-9"><?= date("j M Y\, H:i", $data['id_order']) ?></dd>
                              </dl>

                              <div class="row mt-1">
                                  <?php if (!empty($data['bukti'])): ?>
                                    <button class="btn btn-sm btn-success mx-3 col-3" type="button" data-toggle="collapse" data-target="#bukti-<?= $data['id'] ?>" aria-expanded="false" aria-controls="bukti-<?= $data['id'] ?>">
                                        Bukti Pembayaran
                                    </button>
                                  <?php endif; ?>
                              </div>
                              <div class="collapse bukti" id="bukti-<?= $data['id'] ?>">
                                  <div class="card card-body mt-3 border border-success">
                                    <form action="dashboard.php" method="post">
                                      <img class="mx-auto" src="assets/img/bukti/<?= $data['bukti'] ?>" alt="">
                                    </form>
                                  </div>
                              </div>
                              <hr>
                              <h5 class="pb-2">Daftar Produk</h5>
                              <?php
                              $query2 = "SELECT * FROM order_detail WHERE id_daftar = ".$data['id'];
                              $result2 = mysqli_query(connection(), $query2);
                              $total = $totalb = 0;

                              while ($detail = mysqli_fetch_array($result2)){
                                  $sql = "SELECT * FROM produk WHERE id_produk = ".$detail['id_barang'];
                                  $que = mysqli_query(connection(), $sql);
                                  $produk = mysqli_fetch_array($que); ?>

                                  <div class="media mt-3">
                                      <img src="assets/img/produk/<?= $produk['gambar'] ?>" class="mr-3" style="width:64px; height:64px">
                                      <div class="media-body">
                                          <h6 class="mt-0"><?= $produk['nama_produk'] ?></h6>
                                          <div class="text-danger">Rp <?= number_format($produk['harga'], 2, ',', '.') ?></div>
                                          <div class="text-muted my-1"><?= $detail['jumlah'] ?> barang</div>
                                          <?php
                                            $viewCek = "SELECT * FROM rating WHERE id_order = " . $data['id_order'] . " AND id_barang = " . $detail['id_barang'];
                                            $resultView = mysqli_query(connection(), $viewCek);
                                            // print_r($resultView);
                                            $dataRating = mysqli_fetch_array($resultView);
                                          ?>
                                          <?php if ($data['status'] == "Pesanan Selesai") : ?>
                                            <?php if (mysqli_num_rows($resultView) == 0): ?>
                                              <button id="rating" type="button" class="btn btn-sm btn-dark" name="button" data-toggle="collapse" data-target="#rating-<?= $detail['id_barang']?>">
                                                Beri Rating
                                              </button>
                                            <?php else: ?>
                                              <?php
                                              $twos = floor($dataRating['rating'] / 2);
                                              $ones = $dataRating['rating'] - ($twos * 2);
                                              $zeros = 5 - ($twos + $ones);
                                              ?>

                                              <?php for ($x = 0; $x < $twos; $x++): ?>
                                                <i class="fas fa-star"></i>
                                              <?php endfor; ?>

                                              <?php for ($x = 0; $x < $ones; $x++): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                              <?php endfor; ?>

                                              <?php for ($x = 0; $x < $zeros; $x++): ?>
                                                <i class="far fa-star"></i>
                                              <?php endfor; ?>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                          <div class="collapse" id="rating-<?= $detail['id_barang'] ?>">
                                            <form action="dashboard.php" method="post">
                                              <div class="card card-body mt-3 border border-dark">
                                                <input type="hidden" class="form-control" name="id_order" value="<?php echo $data['id_order'] ?>">
                                                <input type="hidden" class="form-control" name="id_user" value="<?php echo $data['id_user'] ?>">
                                                <input type="hidden" class="form-control" name="id_barang" value="<?php echo $detail['id_barang'] ?>">
                                                <div class="form-group">
                                                  <div class="text-center mb-1" id="bintang-<?= $detail['id_barang'] ?>">
                                                    <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                                  </div>
                                                  <input type="range" name="rating" class="form-control-range" min="0" max="10" value="0" id="ratingf-<?= $detail['id_detail'] ?>">
                                                </div>
                                                <script type="text/javascript">
                                                $('#ratingf-<?= $detail['id_detail'] ?>').on('change',function(){
                                                  var bintang = $('#ratingf-<?= $detail['id_detail'] ?>').val();
                                                  var bintangi = "";
                                                  var two = Math.floor(bintang / 2);
                                                  var one = bintang - (two * 2);
                                                  var zero = 5 - (two + one);

                                                  for (var x = 0; x < two; x++) {
                                                    bintangi += '<i class="fas fa-star"></i>';
                                                  }

                                                  for (var x = 0; x < one; x++) {
                                                    bintangi += '<i class="fas fa-star-half-alt"></i>';
                                                  }

                                                  for (var x = 0; x < zero; x++) {
                                                    bintangi += '<i class="far fa-star"></i>';
                                                  }
                                                  $(this).prev('#bintang-<?= $detail['id_barang'] ?>').html(bintangi);
                                                });
                                                </script>
                                                <button type="submit" class="btn btn-sm btn-dark" name="button">
                                                  Beri Rating
                                                </button>
                                              </div>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                  <?php $total += $produk['harga'] * $detail['jumlah'];
                                  $totalb += $detail['jumlah'];
                              } ?>
                              <hr>
                              <h5 class="pb-2">Pengiriman</h5>
                              <dl class="row">
                                  <?php if (!empty($data['resi'])): ?>
                                      <dt class="col-sm-2">No Resi</dt>
                                      <dd class="col-sm-10"><?= $data['resi'] ?></dd>
                                  <?php endif; ?>

                                  <dt class="col-sm-2">Kurir</dt>
                                  <dd class="col-sm-10"><?= $data['kurir'] ?></dd>

                                  <dt class="col-sm-2">Penerima</dt>
                                  <dd class="col-sm-10"><?= $data['nama'] ?></dd>

                                  <dt class="col-sm-2">Alamat</dt>
                                  <dd class="col-sm-10"><?= $data['alamat'] ?></dd>

                                  <dt class="col-sm-2">No Telepon</dt>
                                  <dd class="col-sm-10"><?= $data['no_telp'] ?></dd>
                              </dl>
                              <hr>
                              <h5 class="pb-2">Pembayaran</h5>
                              <dl class="row">
                                  <dt class="col-sm-3">Jumlah Barang</dt>
                                  <dd class="col-sm-9"><?= $totalb ?> Barang</dd>

                                  <dt class="col-sm-3">Total Harga</dt>
                                  <dd class="col-sm-9">Rp <?= number_format($total, 2, ',', '.') ?></dd>

                                  <dt class="col-sm-3">Ongkir</dt>
                                  <dd class="col-sm-9">Rp <?= number_format($data['total'] - $total, 2, ',', '.') ?></dd>

                                  <dt class="col-sm-3">Total</dt>
                                  <dd class="col-sm-9">Rp <?= number_format($data['total'], 2, ',', '.') ?></dd>

                                  <dt class="col-sm-3">Metode Pembayaran</dt>
                                  <dd class="col-sm-9"><?= $data['pembayaran'] ?></dd>
                              </dl>
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="modal fade" id="bayarBarang-<?= $data['id'] ?>" tabindex="-1" aria-labelledby="bayarBarangLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bayarBarangLabel">Pembayaran Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div class="alert alert-info" role="alert">
                            <p>Pastikan bukti pembayaran <b>sudah benar</b></p>
                          </div>
                          <form method="post" action="dashboard.php" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="inputNota">Bukti Pembayaran</label>
                              <input type="hidden" class="form-control" name="id_order" value="<?php echo $data['id'] ?>">
                              <div class="mb-3">
                                <div class="input-group mb-3">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/jpeg,image/x-png" id="inputNota<?= $data['id'] ?>" name="nota" aria-describedby="inputGroupFileAddon01" required>
                                    <label class="custom-file-label" for="inputNota">Nota</label>
                                    <script>
                                      $('#inputNota<?= $data['id'] ?>').on('change',function(){
                                        var upload = document.getElementById('inputNota<?= $data['id'] ?>').files;
                                        if (upload[0].size > 2000000) {
                                          alert('File Melebihi 2MB');
                                        }
                                        else {
                                          //get the file name
                                          var fileName = $(this).val();
                                          var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                                          //replace the "Choose a file" label
                                          $(this).next('.custom-file-label').html(cleanFileName);
                                        }
                                      })
                                    </script>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-warning">Bayar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="cancelBarang-<?= $data['id'] ?>" tabindex="-1" aria-labelledby="cancelBarangLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelBarangLabel">Pembatalan Pesanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><b>Apakah anda yakin ?</b></p>
                            <p class="mb-0">Pembatalan pesanan <b class="text-danger">#<?= $data['id_order'] ?></b> tidak bisa diurungkan.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" onclick="cancel(<?= $data['id'] ?>)">Ya</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="selesaiBarang-<?= $data['id'] ?>" tabindex="-1" aria-labelledby="selesaiBarangLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="selesaiBarangLabel">Selesaikan Pesanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><b>Apakah anda yakin ?</b></p>
                            <p class="mb-0">Pastikan pesanan <b class="text-success">#<?= $data['id_order'] ?></b> sudah anda terima dengan baik.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="selesai(<?= $data['id'] ?>)">Ya</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript">
  $(function () {
    $("#btnPassword").click(function () {
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        if (password != confirmPassword) {
            alert("Password Tidak Sama");
            return false;
        }
        return true;
    });
  });

  function cancel(id) {
      $.ajax({
          type: "POST",
          url: "conn.php",
          data: "act=updOrder&status=Pesanan Dibatalkan&id=" + id,
          success: function(data){
              alert(data);
              window.location = window.location.href;
          }
      })
  }

  function selesai(id) {
      $.ajax({
          type: "POST",
          url: "conn.php",
          data: "act=updOrder&status=Pesanan Selesai&id=" + id,
          success: function(data){
              alert(data);
              window.location = window.location.href;
          }
      })
  }
</script>
