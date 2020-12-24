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
                <input type="email" class="form-control" id="emailLogin" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="current-password" class="form-control" id="passwordLogin">
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
                <input type="email" class="form-control" id="emailRegist" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="new-password" class="form-control" id="passwordRegist">
              </div>
              <div class="form-group">
                <label for="konfirmasiPassword">Konfirmasi Password</label>
                <input type="new-password" class="form-control" id="konfirmasiPassword">
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
            <table class="table" id="dataCartH">
            </table>
            <hr style="width: 50%">
            <div class="row">
              <p class="ml-auto mr-5">Total Harga</p>
              <p class="ml-5 mr-auto TotalHarga">Rp 0,00</p>
            </div>
          </div>
          <div class="modal-footer">
            <a href="cart.php" type="button" class="btn btn-dark">Lihat Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            viewCart();
        })

        <?php
            $ext = explode("/" , $_SERVER["REQUEST_URI"]);
            $ext = strtolower(end($ext));
        ?>
        var page = "<?= $ext ?>";

        function viewCart() {
            $.ajax({
                type: "POST",
                url: "dataCart.php",
                data: "action=view",
                success: function(data){
                    $("#dataCartH").html(data);
                    if (page == "cart.php") {
                        $("#dataCart").html(data);
                    }
                    totalCart();
                }
            })
        }

        function totalCart() {
            $.ajax({
                type: "POST",
                url: "dataCart.php",
                data: "action=total",
                success: function(data){
                    $(".TotalHarga").html(data);
                }
            })
        }

        function addCart(cart, stok, id){
            if (cart < stok) {
                $.ajax({
                    type: "POST",
                    url: "dataCart.php",
                    data: "action=tambah&id=" + id,
                    success: function(data){
                        viewCart();
                        if (page != "cart.php") {
                            $("#AC-"+id).attr('onclick', "addCarts(" + (++cart) + ", " + stok + ", " + id + ")");
                            if (cart == stok-1) {
                                $("#AC-"+id).prop('disabled', true);
                            }
                        }
                    }
                })
            } else {
                alert("Maaf, stok tidak ada lagi");
            }
        }

        function minCart(cart, stok, id){
            $.ajax({
                type: "POST",
                url: "dataCart.php",
                data: "action=kurang&id=" + id,
                success: function(data){
                    if (cart == 1) {
                        alert("Barang dihapus dari keranjang");
                    }
                    viewCart();
                    if (page != "cart.php") {
                        $("#AC-"+id).attr('onclick', "addCarts(" + (--cart) + ", " + stok + ", " + id + ")");
                        if ($("#AC-"+id).prop("disabled") == true) {
                            $("#AC-"+id).prop('disabled', false);
                        }
                    }
                }
            })
        }
    </script>
