<?php
session_start();
require 'conn.php';

if(!isset($_SESSION['user'])){
    message("Mohon login terlebih dahulu");
    redirect("index.php");
} else {
    $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(),$query);
    $data = mysqli_fetch_array($result);

    // if (!isset($data['telepon_user']) || !isset($data['alamat_user']) || !isset($data['foto_user'])) {
    //     message("Mohon lengkapi profil terlebih dahulu");
    //     redirect("dashboard.php");
    // }
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
    $gambar = $namaFileBaru;

    move_uploaded_file($tmpName, $tujuan);
    // message($_POST['id_order']);
    // message("hello");
    $query = "UPDATE daftar_orderv SET status = 'Pesanan Selesai', bukti = '$gambar' WHERE id = ".$_POST['id_order'];
    $result = mysqli_query(connection(), $query);
  }
  if ($result) {
    $queryDaftar = "SELECT * FROM daftar_orderv WHERE id = ".$_POST['id_order'];
    $resultDaftar = mysqli_query(connection(), $queryDaftar);
    $data = mysqli_fetch_array($resultDaftar);

    if ($data['jenis_voucher'] == 5) {
      $queryUser = "SELECT * FROM user WHERE email_user = '".$data['id_voucher']."'";
      $resultUser = mysqli_query(connection(), $queryUser);
      $user = mysqli_fetch_array($resultUser);
      // message($user['email_user']);
      $wallet = $user['wallet'] + $data['nominal'];
      $queryUser = "UPDATE user SET wallet = $wallet WHERE id_user = ". $user['id_user'];
      $resultUser = mysqli_query(connection(), $queryUser);
      if(!$resultUser){
        message('Ada Kesalahan, Mohon Coba Lagi');
        redirect('index.php');
      }
    }
    message('Pembayaran Berhasil Dilakukan');
  }
  else {
    message('Pembayaran Gagal Dilakukan');
  }
  redirect('dvoucher.php');
}
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

    <title> Penjualan </title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
      <a class="navbar-brand" href="index.php">My Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto mr-auto" method="POST">
          <input class="form-control mr-sm-2" type="search" placeholder="ID Order" aria-label="Search" name="cari">
          <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h5 class="pt-2 mr-2"><?php echo $_SESSION['user']['nama']?></h5>
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
        <h3><i class="fas fa-list-alt"></i> History Voucher</h3>
        <hr>
        <div class="row">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">ID Order</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            	<?php
               if ($_SERVER['REQUEST_METHOD']=== 'POST') {
                    // $search = $_POST['cari'];
                    // $query = "SELECT * FROM daftar_order WHERE id_order='$search'";
                    // $result = mysqli_query(connection(),$query);
                } else {
                    $query = "SELECT * FROM daftar_orderv WHERE id_user = ".$_SESSION['user']['id']." ORDER BY id_order DESC";
                    $result = mysqli_query(connection(), $query);
                }

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
                        <td><?= $data['nama']?></td>
                        <td><?= $data['alamat']?></td>
                        <td>Rp. <?= number_format($data['total']) ?>,00</td>
                        <td><?= $data['status']?></td>
                        <td class="text-center">
                            <button id="detail" type="button" class="btn btn-sm btn-info" name="button" data-toggle="modal" data-target="#detailOrder-<?= $data['id'] ?>">
                                Detail
                            </button>
                            <?php if ($data['status'] == "Menunggu Pembayaran"): ?>
                                <button id="bayar" type="button" class="btn btn-sm btn-warning" name="button" data-toggle="modal" data-target="#bayarBarang-<?= $data['id'] ?>">
                                    Bayar
                                </button>
                                <button id="cancel" type="button" class="btn btn-sm btn-danger" name="button" data-toggle="modal" data-target="#cancelBarang-<?= $data['id']?>">
                                    Cancel
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

                                    <dt class="col-sm-3">Jenis Voucher</dt>
                                    <dd class="col-sm-9"><?= mysqli_fetch_array(mysqli_query(connection(), "SELECT jenis_voucher FROM voucher WHERE id_voucher = ".$data['jenis_voucher']))[0] ?></dd>

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
                                      <img class="mx-auto" src="assets/img/bukti/<?= $data['bukti'] ?>" alt="">
                                    </div>
                                </div>
                                <hr>
                                <h5 class="pb-2">Pembayaran</h5>
                                <dl class="row">

                                    <dt class="col-sm-3">Jumlah Saldo</dt>
                                    <dd class="col-sm-9">Rp <?= number_format($data['nominal'], 2, ',', '.') ?></dd>

                                    <dt class="col-sm-3">Total Harga</dt>
                                    <dd class="col-sm-9">Rp <?= number_format($data['total'], 2, ',', '.') ?></dd>

                                    <dt class="col-sm-3">Metode Pembayaran</dt>
                                    <dd class="col-sm-9"><?= $data['pembayaran'] ?></dd>
                                </dl>
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
                                    <button type="button" class="btn btn-danger" onclick="cancel(<?= $data['id'] ?>,'voucher')">Ya</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="bayarBarang-<?= $data['id'] ?>" tabindex="-1" aria-labelledby="bayarBarangLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="bayarBarangLabel">Pengiriman Barang</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                            <div class="alert alert-info" role="alert">
                              <p>Pastikan bukti pembayaran <b>sudah benar</b></p>
                            </div>
                            <form method="post" action="dvoucher.php" enctype="multipart/form-data">
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
                                          console.log(upload[0]);
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

                <?php endwhile; ?>
            </tbody>
        </table>
      </div>
    </div>
    </div>

    <script type="text/javascript">
        function cancel(id,jenis) {
            $.ajax({
                type: "POST",
                url: "conn.php",
                data: "act=updOrder&status=Pesanan Dibatalkan&id=" + id + "&jenis=" + jenis,
                success: function(data){
                    alert(data);
                    window.location = window.location.href;
                }
            })
        }
    </script>
  </body>
</html>
