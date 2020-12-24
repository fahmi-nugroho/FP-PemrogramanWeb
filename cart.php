<?php
    include_once 'assets/template/header.php';
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-9">
      <table class="table" id="dataCart">

      </table>
    </div>
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Ringkasan Belanja</h5>
          <hr style="width: 90%">
          <div class="row mb-3">
            <p class="ml-1 mr-auto">Total Harga</p>
            <p class="mr-1 ml-auto TotalHarga">Rp 0,00</p>
          </div>
          <a href="#" class="btn btn-dark" style="width:100%" data-toggle="modal" data-target="#checkout">Checkout</a>
        </div>
      </div>
    </div>
  </div>
</div>
