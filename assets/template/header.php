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
        <?php if (isset($_SESSION['user'])): ?>
            <a href="dashboard.php" class="btn btn-outline-dark"><?= $_SESSION['user']['nama'] ?></a>
        <?php else: ?>
            <button class="btn btn-outline-dark mr-3" type="button" data-toggle="modal" data-target="#login">Masuk</button>
            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#register">Daftar</button>
        <?php endif; ?>
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
            <form>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="emailLogin">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="passwordLogin">
              </div>
              <button type="button" class="btn btn-dark" onclick="login()">Masuk</button>
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
            <form>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="emailRegis" aria-describedby="emailHelp">
                <div class="invalid-feedback" id="fbEmailRegis">
                    Mohon masukkan email dengan benar
                </div>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="passwordRegis">
                <div class="invalid-feedback">
                    Password minimal 8 karakter
                </div>
              </div>
              <div class="form-group">
                <label for="konfirmasiPassword">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirmPassword">
                <div class="invalid-feedback">
                    Password tidak sama
                </div>
              </div>
              <button type="button" class="btn btn-dark" onclick="daftar()">Daftar</button>
            </form>
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
                <div class="table-responsive-md">
                    <table class="table dataCart">

                    </table>
                </div>
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
    <?php
        // unset($_SESSION['cart']);
        // unset($_SESSION['user']);
        // echo print_r($_SESSION);
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            viewCart();
        })

        <?php
            $page = explode("/" , $_SERVER["REQUEST_URI"]);
            $page = strtolower(end($page));
        ?>
        var page = "<?= $page ?>";

        function daftar(){
            var pattern = /^[a-zA-Z0-9._]+@[a-zA-Z](?:[a-zA-Z]{0,8}[a-zA-Z])?(?:\.[a-zA-Z](?:[a-zA-Z]{0,8}[a-zA-Z])?)*$/;
            var email = $("#emailRegis");
            var pass = $("#passwordRegis");
            var newPass = $("#confirmPassword");

            if (pattern.test(email.val())) {
                email.addClass('is-valid').removeClass('is-invalid');
            } else {
                $("#fbEmailRegis").html("Mohon masukkan email dengan benar");
                email.addClass('is-invalid').removeClass('is-valid');
            }

            if (pass.val().length > 7) {
                pass.addClass('is-valid').removeClass('is-invalid');
                if (newPass.val() == pass.val()) {
                    newPass.addClass('is-valid').removeClass('is-invalid');
                } else {
                    newPass.addClass('is-invalid').removeClass('is-valid');
                }
            } else {
                pass.addClass('is-invalid').removeClass('is-valid');
            }

            if (email.hasClass("is-valid") &&
                pass.hasClass("is-valid") &&
                newPass.hasClass("is-valid")) {
                $.ajax({
                    type: "POST",
                    url: "conn.php",
                    data: "act=cekEmail&data=" + email.val(),
                    success: function(data){
                        if (data > 0) {
                            $("#fbEmailRegis").html("Email telah terdaftar");
                            email.addClass('is-invalid').removeClass('is-valid');
                        } else {
                            register(email.val(), pass.val());
                            $("#register").modal('hide');
                            $("#login").modal('show');
                            email.removeClass("is-valid").val("");
                            pass.removeClass("is-valid").val("");
                            newPass.removeClass("is-valid").val("");
                        }
                    }
                })
            }
        }

        function register(email, pass) {
            $.ajax({
                type: "POST",
                url: "conn.php",
                data: "act=regis&email=" + email + "&pass=" + pass,
                success: function(data){
                    alert(data);
                }
            })
        }

        function login() {
            var email = $("#emailLogin").val();
            var pass = $("#passwordLogin").val();

            $.ajax({
                type: "POST",
                url: "conn.php",
                data: "act=login&email=" + email + "&pass=" + pass,
                success: function(data){
                    alert(data);
                    window.location = window.location.href;
                }
            })
        }

        function viewCart() {
            $.ajax({
                type: "POST",
                url: "dataCart.php",
                data: "action=view",
                success: function(data){
                    $(".dataCart").html(data);
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
                    $(".TotalHarga").html(JSON.parse(data).harga);
                    $("#btnCO").html("Checkout (" + JSON.parse(data).total + ")");
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
                    viewCart();
                    if (cart == 1) {
                        alert("Barang dihapus dari keranjang");
                    }
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
