<?php
    include_once 'assets/template/header.php';

    if (!isset($_SESSION['user'])) {
        message('Mohon login terlebih dahulu');
        redirect('index.php');
    }
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-12 col-xl-9 mb-3">
        <div class="table-responsive-md">
          <table class="table dataCart">

          </table>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3 d-inline-block">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Ringkasan Belanja</h5>
          <hr style="width: 90%">
          <div class="row mb-3">
            <p class="ml-1 mr-auto font-weight-bold">Total Harga</p>
            <p class="mr-1 ml-auto TotalHarga">Rp 0,00</p>
          </div>
          <button id="btnCO" class="btn btn-dark btn-block">Checkout (0)</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="checkout" aria-hidden="true">
    <div class="modal-dialog modal-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="checkout">Checkout</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="dataCheckout">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" onclick="bayarck()">Bayar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("#btnCO").on("click", function () {
        <?php
            $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
            $result = mysqli_query(connection(), $query);
            $data = mysqli_fetch_array($result);

            if (($data[4] == null || strlen($data[4]) == 0)
            || ($data[5] == null || strlen($data[5]) == 0)) {
                $oke = 0;
            } else {
                $oke = 1;
            }

            if (isset($_SESSION['cart']) && $_SESSION['cart']['total'] > 0) {
                $buka = 1;
            } else {
                $buka = 0;
            }
        ?>

        if (<?= $oke ?> == 0) {
            alert("Mohon lengkapi data diri");
        } else if (<?= $buka ?> == 0) {
            alert("Cart Kosong");
        } else {
            $.ajax({
                type: "POST",
                url: "dataCart.php",
                data: "action=viewCheckout",
                success: function(data){
                    $("#dataCheckout").html(data);
                }
            })
            $("#checkout").modal("show");
        }
    })

    function ongkir(valuee, jml, total){
        $("#Kurir").html("Kurir (" + valuee + ")");
        var ongkir = 0;

        if (valuee == "JNE") {
            ongkir = 25000 * jml;
        } else if (valuee == "POS") {
            ongkir = 30000 * jml;
        } else if (valuee == "TIKI") {
            ongkir = 35000 * jml;
        }

        var hargaOngkir = new Intl.NumberFormat('id-ID').format(ongkir);
        $("#Kurir").next().html("Rp " + hargaOngkir + ",00");

        hargaOngkir = new Intl.NumberFormat('id-ID').format(ongkir + total);
        $("#Kurir").next().next().next().html("Rp " + hargaOngkir + ",00");
    }

    function bayarck() {
        <?php
            $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
            $result = mysqli_query(connection(), $query);
            $data = mysqli_fetch_array($result);

            $wallet = (empty($data['wallet'])) ? 0 : $data['wallet'] ;
        ?>
        var kurir = $("#ongkir");
        var bayar = $("#bayar");

        var ongkir = 0;
        if (kurir.val() == "JNE") {
            ongkir = 25000;
        } else if (kurir.val() == "POS") {
            ongkir = 30000;
        } else if (kurir.val() == "TIKI") {
            ongkir = 35000;
        }

        var str = $(".TotalHarga").html().trim();
        var arr = str.split(",")[0].split(".");
        var trx = "";
        for(var x = 0; x < arr.length; x ++){
            trx += arr[x];
        }

        if (kurir.val() == 0 || bayar.val() == 0) {
            alert("Mohon pilih ongkir dan metode pembayaran");
        } else if (bayar.val() == "Wallet" && (<?= $wallet ?> < trx.substr(2))) {
            alert("Saldo wallet tidak mencukupi, silahkan top-up terlebih dahulu.");
        } else {
            $.ajax({
                type: "POST",
                url: "dataCart.php",
                data: "action=checkout&kurir=" + kurir.val() + "&bayar=" + bayar.val() + "&ongkir=" + ongkir,
                success: function(data){
                    alert(data);
                    window.location = window.location.href;
                }
            })
        }
    }
</script>
