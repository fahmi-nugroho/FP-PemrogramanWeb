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

    <title>Keranjang | My Shop</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
      <a class="navbar-brand" href="index.php">My Shop</a>
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

    <div class="container mt-5">
      <div class="row">
        <div class="col-9">
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
        </div>
        <div class="col-3">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Ringkasan Belanja</h5>
              <hr style="width: 90%">
              <div class="row mb-3">
                <p class="ml-1 mr-auto">Total Harga</p>
                <p class="mr-1 ml-auto">Rp 4.000.000,00</p>
              </div>
              <a href="#" class="btn btn-dark" style="width:100%" data-toggle="modal" data-target="#checkout">Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

  </body>
</html>
