<?php
  include 'conn.php';
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

    <title>My Shop</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
      <a class="navbar-brand" href="index.html">My Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline ml-auto my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h5><a data-toggle="modal" data-target="#cart" style="cursor: pointer;"><i class="fas fa-shopping-cart mt-2 mr-4 ml-3 text-dark" data-toggle="tooltip" title="Keranjang Belanja"></i></a></h5>
        <h5><i class="fas fa-grip-lines-vertical mt-2 mr-4" style="opacity: 0.5"></i></h5>
        <button class="btn btn-outline-dark mr-3" type="button" data-toggle="modal" data-target="#login">Masuk</button>
        <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#register">Daftar</button>
      </div>
    </nav>
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginLabel">Masuk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="index.html" method="post">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password">
              </div>
              <button type="submit" class="btn btn-dark"><a href="dashboard.html" class="text-decoration-none text-white">Masuk</a></button>
            </form>
          </div>
          <div class="modal-footer">
            <p>Belum punya akun? <a href="#" data-toggle="modal" data-target="#register" data-dismiss="modal">Daftar</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registerLabel">Register</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="index.html" method="post">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password">
              </div>
              <div class="form-group">
                <label for="konfirmasiPassword">Konfirmasi Password</label>
                <input type="password" class="form-control" id="konfirmasiPassword">
              </div>
              <button type="submit" class="btn btn-dark">Daftar</button>
            </form>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cartLabel">Keranjang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Toko</th>
                  <th scope="col">Produk</th>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Kuantitas</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>G-Shop</td>
                  <td><img src="assets/img/produk1.png" style="width:60px; height:60px" alt=""></td>
                  <td>Playstation 4</td>
                  <td>Rp. 4.000.000,00</td>
                  <td><button type="button" class="btn btn-dark mr-2" name="button">+</button>1<button type="button" class="btn btn-dark ml-2" name="button">-</button></td>
                </tr>
              </tbody>
            </table>
            <hr style="width: 50%">
            <div class="row">
              <p class="ml-auto mr-5">Total Harga</p>
              <p class="ml-5 mr-auto">Rp 4.000.000,00</p>
            </div>
          </div>
          <div class="modal-footer">
            <a href="cart.php" type="button" class="btn btn-dark">Lihat Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>

    <div class="container-float">
      <div class="row no-gutters">
        <div class="col-md-2 bg-light">
          <ul class="list-group list-group-flush p-2 pt-4">
            <?php
              $query = "SELECT * FROM categories";
              $negara = mysqli_query(connection(),$query);
              while($data = mysqli_fetch_array($negara)):
            ?>
            <li class="list-group-item"><?php echo $data['nama'] ?></li>
            <?php endwhile; ?>
          </ul>
        </div>
        <div class="col-md-10">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/img/banner1.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="assets/img/banner2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="assets/img/banner3.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <h4 class="text-center font-weight-bold m-4">VOUCHER GAME</h4>
          <div class="row justify-content-center mx-auto">
            <?php
              $query = "SELECT * FROM voucher";
              $negara = mysqli_query(connection(),$query);
              while($data = mysqli_fetch_array($negara)):
            ?>
            <div class="card mr-2 ml-2 mb-2" style="width: 16rem;">
              <img src="assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="<?php echo $data['jenis_voucher'] ?>">
            </div>
            <?php endwhile; ?>
          </div>

          <h4 class="text-center font-weight-bold m-4">PRODUK TERBARU</h4>
          <div class="row justify-content-center mx-auto">
            <?php
              $query = "SELECT * FROM produk";
              $negara = mysqli_query(connection(),$query);
              while($data = mysqli_fetch_array($negara)):
            ?>
            <div class="card mr-2 ml-2 mb-2" style="width: 16rem;">
              <img src="assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="...">
              <div class="card-body bg-light">
                <h5 class="card-title"><?php echo $data['nama_produk'] ?></h5>
                <p class="card-text"><?php echo $data['deskripsi'] ?></p>
                <div class="stars mb-1">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <i class="far fa-star"></i>
                </div>
                <p class="font-weight-bold">Rp. <?php echo $data['harga'] ?>,00</p>
                <a href="#" class="btn btn-dark" data-target="#produk<?php echo $data['id_produk'] ?>" data-toggle="modal">Detail</a>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
          <?php
            $query = "SELECT * FROM produk";
            $negara = mysqli_query(connection(),$query);
            while($data = mysqli_fetch_array($negara)):
          ?>
          <div class="modal fade" id="produk<?php echo $data['id_produk'] ?>" tabindex="-1" aria-labelledby="produk<?php echo $data['id_produk'] ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="produk<?php echo $data['id_produk'] ?>Label">Detail Produk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="assets/img/<?php echo $data['gambar'] ?>" alt="">
                    </div>
                    <div class="col-md-6">
                      <table class="table table-borderless">
                        <tr>
                          <th>Nama Toko</th>
                          <td><?php echo $data['penjual'] ?></td>
                        </tr>
                        <tr>
                          <th>Nama Produk</th>
                          <td><?php echo $data['nama_produk'] ?></td>
                        </tr>
                        <tr>
                          <th>Biaya Ongkir</th>
                          <td>Standart</td>
                        </tr>
                        <tr>
                          <th>Rating Produk</th>
                          <td>
                            <div class="stars mb-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                          </div>
                        </td>
                        </tr>
                        <tr>
                          <th>Stock Produk</th>
                          <td><?php echo $data['stok'] ?>pc</td>
                        </tr>
                        <tr>
                          <th>Harga</th>
                          <td>Rp.<?php echo $data['harga'] ?>,00</td>
                        </tr>
                        <tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                  <button type="button" class="btn btn-success">+Keranjang</button>
                </div>
              </div>
            </div>
          </div>
          <?php endwhile; ?>

        </div>
      </div>
    </div>

    <footer class="bg-dark text-white p-5">
      <div class="row">
        <div class="col-md-3">
          <h5>Layanan Pelanggan</h5>
          <ul>
            <li>Pusat Bantuan</li>
            <li>Cara Pembelian</li>
            <li>Pengiriman</li>
            <li>Cara Pengembalian</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5>Tentang Kami</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="col-md-3">
          <h5>Mitra Kerjasama</h5>
          <ul>
            <li>Go-Jek</li>
            <li>Grab</li>
            <li>JNE</li>
            <li>PT. POS Indonesia</li>
            <li>Tiki</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5>Hubungi Kami</h5>
          <ul>
            <li>021-2367-5677</li>
            <li>customer@myshop.com</li>
          </ul>
        </div>
      </div>
    </footer>

    <div class="copyright text-center text-white font-weight-bold bg-dark p-2">
      <p>Developed by Mahasiswa Informatika UPN "veteran" Jawa Timur Copyright <i class="far fa-copyright"></i> 2020</p>
    </div>

    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

  </body>
</html>
