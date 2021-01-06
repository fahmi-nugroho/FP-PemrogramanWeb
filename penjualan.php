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
        <img src="assets/img/playstation1.png" alt="" class="" style="width: 40px; height: 40px; border: 1px solid black; border-radius: 50%;">
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
            <a class="nav-link text-dark" href="toko.php"><i class="fas fa-store mr-2"></i> Toko</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="penjualan.php"><i class="fas fa-store mr-2"></i> Penjualan</a>
          </li>
        </ul>
      </div>
      <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-list-alt"></i> Daftar Penjualan</h3>
        <hr>
        <div class="row mt-2 mb-2">
          <h4 class="mr-auto ml-auto"><i class="fas fa-file-invoice"></i> Daftar Order</h4>
        </div>
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
                    $query = "SELECT * FROM daftar_order WHERE id_penjual = ".$_SESSION['user']['id']." ORDER BY id_order DESC";
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
                                <button id="kirim" type="button" class="btn btn-sm btn-warning" name="button" disabled style="cursor: not-allowed">
                                    Kirim
                                </button>
                                <button id="cancel" type="button" class="btn btn-sm btn-danger" name="button" data-toggle="modal" data-target="#cancelBarang-<?= $data['id']?>">
                                    Cancel
                                </button>
                            <?php elseif ($data['status'] == "Menunggu Pengiriman"): ?>
                                <button id="kirim" type="button" class="btn btn-sm btn-warning" name="button" data-toggle="modal" data-target="#kirimBarang-<?= $data['id'] ?>">
                                    Kirim
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
                                <div class="collapse" id="bukti-<?= $data['id'] ?>">
                                    <div class="card card-body mt-3 border border-success">
                                        <?php if ($data['pembayaran'] == "Wallet"): ?>
                                            Menggunakan Saldo Wallet
                                        <?php else: ?>
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                        <?php endif; ?>
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
                                        <img src="assets/img/<?= $produk['gambar'] ?>" class="mr-3" style="width:64px; height:64px">
                                        <div class="media-body">
                                            <h6 class="mt-0"><?= $produk['nama_produk'] ?></h6>
                                            <div class="text-danger">Rp <?= number_format($produk['harga'], 2, ',', '.') ?></div>
                                            <div class="text-muted my-1"><?= $detail['jumlah'] ?> barang</div>
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

                    <div class="modal fade" id="kirimBarang-<?= $data['id'] ?>" tabindex="-1" aria-labelledby="kirimBarangLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="kirimBarangLabel">Pengiriman Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info" role="alert">
                                        <p><b>Pastikan cek bukti pembayaran</b> sebelum mengirim barang!</p>
                                        <hr>
                                        <p class="mb-0">Bukti pembayaran terdapat <b>di bagian detail order.</b></p>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="resi">Nomor Resi</label>
                                            <input type="text" class="form-control" id="inputResi-<?= $data['id'] ?>" pattern="^[0-9]*$" aria-describedby="inputResi-<?= $data['id'] ?>">
                                            <div class="invalid-feedback" id="inputResi-<?= $data['id'] ?>">
                                                Mohon masukkan resi dengan benar
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-warning" onclick="addResi(<?= $data['id'] ?>)">Kirim</button>
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
                <?php endwhile; ?>
            </tbody>
        </table>
      </div>
    </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function addResi(id) {
            var pattern = /^[0-9]*$/;
            var resi = $("#inputResi-"+id);

            if (pattern.test(resi.val()) && resi.val() != "") {
                resi.addClass("is-valid").removeClass("is-invalid");
            } else {
                resi.addClass("is-invalid").removeClass("is-valid");
            }

            if (resi.hasClass("is-valid")) {
                $.ajax({
                    type: "POST",
                    url: "conn.php",
                    data: "act=updOrder&status=Proses Pengiriman&resi=" + resi.val() + "&id=" + id,
                    success: function(data){
                        alert(data);
                        window.location = window.location.href;
                    }
                })
            }
        }

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
    </script>
  </body>
</html>
