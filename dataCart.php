<?php
session_start();
require 'conn.php';

if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            if ($action == "tambah") {
                $query = "SELECT * FROM produk WHERE id_produk = $id";
                $produk = mysqli_query(connection() ,$query);
                $data = mysqli_fetch_array($produk);

<<<<<<< HEAD
                if (isset($_SESSION['cart_'.$id]) && $_SESSION['cart_'.$id] < $data['stok']) {
                    $_SESSION['cart_'.$id] ++;
                } else {
                    $_SESSION['cart_'.$id] = 1;
                    $_SESSION['cart'] += 1;
                }
            } elseif ($action == "kurang") {
                if ($_SESSION['cart_'.$id] > 1) {
                    $_SESSION['cart_'.$id] --;
                } else {
                    unset($_SESSION['cart_'.$id]);
                    $_SESSION['cart'] --;
=======
                if (isset($_SESSION['cart']['cart_'.$id]) && $_SESSION['cart']['cart_'.$id] < $data['stok']) {
                    $_SESSION['cart']['cart_'.$id] ++;
                } else {
                    $_SESSION['cart']['total'] += 1;
                    $_SESSION['cart']['cart_'.$id] = 1;
                }
            } elseif ($action == "kurang") {
                if ($_SESSION['cart']['cart_'.$id] > 1) {
                    $_SESSION['cart']['cart_'.$id] --;
                } else {
                    unset($_SESSION['cart']['cart_'.$id]);
                    $_SESSION['cart']['total'] --;
>>>>>>> deeb6f912aab6de114034ae3fc85698724799708
                }
            }
        } elseif ($action == "total") {
            $price = 0;
<<<<<<< HEAD
            if (isset($_SESSION['cart']) && $_SESSION['cart'] > 0) {
                foreach ($_SESSION as $key => $value) {
=======

            if (isset($_SESSION['cart']) && $_SESSION['cart']['total'] > 0) {
                foreach ($_SESSION['cart'] as $key => $value) {
>>>>>>> deeb6f912aab6de114034ae3fc85698724799708
                    if (substr($key, 0, 5) == "cart_") {
                        $id = substr($key, 5, strlen($key));
                        $query = "SELECT * FROM produk WHERE id_produk = $id";
                        $produk = mysqli_query(connection(), $query);
                        $data = mysqli_fetch_array($produk);

                        $price += $value * $data['harga'];
                    }
                }
<<<<<<< HEAD
                echo "Rp. ".number_format($price).",00";
            } else {
                echo "Rp. ".number_format($price).",00";
            }
        } elseif ($action == "view") {
            $no = 0;
            if (isset($_SESSION['cart']) && $_SESSION['cart'] > 0) { ?>
=======
            }

            echo json_encode(array(
                'harga' => "Rp. ".number_format($price, 2, ',', '.'),
                'total' =>  (isset($_SESSION['cart'])) ? $_SESSION['cart']['total'] : "0"
            ));
        } elseif ($action == "view") {
            $no = 0;
            if (isset($_SESSION['cart']) && $_SESSION['cart']['total'] > 0) { ?>
>>>>>>> deeb6f912aab6de114034ae3fc85698724799708
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Toko</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Nama Produk</th>
<<<<<<< HEAD
                        <th scope="col">Harga</th>
                        <th scope="col">Kuantitas</th>
                    </tr>
                </thead>
                <tbody> <?php
                    foreach ($_SESSION as $key => $value) {
                        if (substr($key,0,5) == "cart_") {
                            $id = substr($key, 5, strlen($key) - 5);
=======
                        <th scope="col">Harga (Rp)</th>
                        <th scope="col" class="text-center">Kuantitas</th>
                    </tr>
                </thead>
                <tbody> <?php
                    foreach ($_SESSION['cart'] as $key => $value) {
                        if (substr($key, 0, 5) == "cart_") {
                            $id = substr($key, 5);
>>>>>>> deeb6f912aab6de114034ae3fc85698724799708
                            $query = "SELECT * FROM produk WHERE id_produk = $id";
                            $produk = mysqli_query(connection(), $query);
                            $data = mysqli_fetch_array($produk); ?>
                            <tr>
<<<<<<< HEAD
                                <th scope="row"><?= ++$no ?></th>
                                <td><?= $data['penjual'] ?></td>
                                <td><img src="assets/img/<?= $data['gambar'] ?>" style="width:60px; height:60px" alt=""></td>
                                <td><?= $data['nama_produk'] ?></td>
                                <td>Rp. <?= number_format($data['harga']) ?>,00</td>
                                <td>
                                    <button type="button" class="btn btn-dark mr-2" name="button" onclick="addCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">+</button>
                                    <?= $value ?>
                                    <button type="button" class="btn btn-dark ml-2" name="button" onclick="minCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">-</button>
=======
                                <th scope="row" class="align-middle"><?= ++$no ?></th>
                                <td class="align-middle"><?= $data['penjual'] ?></td>
                                <td><img src="assets/img/<?= $data['gambar'] ?>" style="width:60px; height:60px" alt=""></td>
                                <td class="align-middle"><?= wordwrap($data['nama_produk'], 25, "<br>") ?></td>
                                <td class="align-middle"><?= number_format($data['harga'], 2, ',', '.') ?></td>
                                <td class="align-middle text-center" colspan="2">
                                    <ul class="list-inline">
                                      <li class="list-inline-item"><button type="button" class="btn btn-dark btn-sm" name="button" onclick="addCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">+</button></li>
                                      <li class="list-inline-item"><?= $value ?></li>
                                      <li class="list-inline-item"><button type="button" class="btn btn-dark btn-sm" name="button" onclick="minCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">-</button></li>
                                    </ul>
>>>>>>> deeb6f912aab6de114034ae3fc85698724799708
                                </td>
                            </tr> <?php
                        }
                    } ?>
                </tbody> <?php
            } else { ?>
                <h1 class="display-4 text-center">Cart Kosong</h1> <?php
            }
<<<<<<< HEAD
=======
        } elseif ($action == "viewCheckout") {
            $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
            $result = mysqli_query(connection(), $query);
            $data = mysqli_fetch_array($result); ?>

            <h5 class="pb-2">Data Diri</h5>
            <dl class="row">
                <dt class="col-sm-1">Nama</dt>
                <dd class="col-sm-11"><?= $data[1] ?></dd>

                <dt class="col-sm-1">Phone</dt>
                <dd class="col-sm-11"><?= $data[4] ?></dd>

                <dt class="col-sm-1">Alamat</dt>
                <dd class="col-sm-11"><?= $data[5] ?></dd>
            </dl>
            <hr> <?php

            $cart = $toko = array();
            foreach ($_SESSION['cart'] as $key => $value) {
                if (substr($key,0,5) == "cart_") {
                    $id = substr($key, 5);
                    $query = "SELECT * FROM produk WHERE id_produk = $id";
                    $produk = mysqli_query(connection(), $query);
                    $data = mysqli_fetch_array($produk);

                    array_push($cart, array(0 => $id, 1 => $data[2], 2 => $data[3], 3 => $data[5], 4 => $data[8]));
                    array_push($toko, $data[2]);
                }
            }

            $toko = array_unique($toko);
            $total = $totalpt = $jmlbrg = 0;
            for ($i = 0; $i < count($toko); $i ++) {
                $totalpt = 0; ?>

                <h5 class="my-3"><?= $toko[$i] ?></h5> <?php

                foreach ($cart as $key => $value):
                    if ($value[1] == $toko[$i]): ?>
                        <div class="media mt-3">
                            <img src="assets/img/<?= $value[4] ?>" class="mr-3" style="width:64px; height:64px">
                            <div class="media-body">
                                <h6 class="mt-0"><?= $value[2] ?></h6>
                                <div class="text-danger">Rp <?= number_format($value[3], 2, ',', '.') ?></div>
                                <div class="text-muted my-1"><?= $_SESSION['cart']['cart_'.$value[0]] ?> barang</div>
                            </div>
                        </div> <?php

                        $totalpt += $value[3] * $_SESSION['cart']['cart_'.$value[0]];
                        $jmlbrg += $_SESSION['cart']['cart_'.$value[0]];

                        unset($cart[$key]);
                    endif;
                endforeach;

                $total += $totalpt; ?>

                <div class="row my-2 py-1 bg-light">
                    <div class="col text-secondary">Subtotal :</div>
                    <div class="col text-right">Rp <?= number_format($totalpt, 2, ',', '.') ?></div>
                </div> <?php
            } ?>

            <hr>
            <h5>Ringkasan</h5>
            <dl class="row">
                <dt class="col-lg-3">Jumlah Barang</dt>
                <dd class="col-lg-9"><?= $jmlbrg ?> barang</dd>

                <dt class="col-lg-3">Pilih Kurir</dt>
                <div class="col-lg-4">
                    <select class="custom-select custom-select-sm" id="ongkir" onchange="ongkir(this.value, <?= $jmlbrg ?>, <?= $total ?>)">
                        <option value="0" selected>- Pilih -</option>
                        <option value="JNE">JNE</option>
                        <option value="POS">POS</option>
                        <option value="TIKI">TIKI</option>
                    </select>
                </div>
                <div class="col-12 mb-2"></div>

                <dt class="col-lg-3" id="Kurir">Kurir (-)</dt>
                <dd class="col-lg-9">Rp 0,00</dd>

                <dt class="col-lg-3">Total Harga</dt>
                <dd class="col-lg-9">Rp <?= number_format($total, 2, ',', '.') ?></dd>

                <dt class="col-lg-3">Pilih Pembayaran</dt>
                <div class="col-lg-4">
                    <select class="custom-select custom-select-sm" id="bayar">
                        <option value="0" selected>- Pilih -</option>
                        <option value="Wallet">Wallet</option>
                        <option value="Merchant">Merchant (Indomart / Alfamart)</option>
                        <option value="Credit Card">CC</option>
                    </select>
                </div>
            </dl> <?php

        } elseif ($action == "checkout") {
            $kurir = $_POST['kurir'];
            $ongkir = $_POST['ongkir'];
            $bayar = $_POST['bayar'];

            $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
            $result = mysqli_query(connection(), $query);
            $data = mysqli_fetch_array($result);

            $total = $tbrg = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                if (substr($key,0,5) == "cart_") {
                    $id = substr($key, 5);

                    $query = "SELECT * FROM produk WHERE id_produk = $id";
                    $rs2 = mysqli_query(connection(), $query);
                    $produk = mysqli_fetch_array($rs2);

                    $total += $produk['harga'] * $value;
                    $tbrg += $value;
                }
            }

            $idorder = time();
            $tgl = date("d/m/Y");

            $total = $total + ($ongkir * $tbrg);

            $query = "INSERT INTO daftar_order VALUES ($idorder, $data[0], '$data[1]', '$tgl', '$data[5]', '$data[4]', '$total', '$kurir', '$bayar', 'Menunggu Pembayaran')";

            if (mysqli_query(connection(), $query)) {
                $error = 0;
                foreach ($_SESSION['cart'] as $key => $value) {
                    if (substr($key,0,5) == "cart_") {
                        $id = substr($key, 5);
                        $pro = mysqli_query(connection(), "SELECT * FROM produk WHERE id_produk = $id");
                        $duk = mysqli_fetch_array($pro);

                        if ($duk['stok'] >= $value) {
                            $stok = $duk['stok'] - $value;
                            if (mysqli_query(connection(), "UPDATE produk SET stok = $stok WHERE id_produk = $id")) {
                                if (!mysqli_query(connection(), "INSERT INTO order_detail VALUES (null, $idorder, $id, $value, $duk[5])")) {
                                    $error++;
                                }
                            } else {
                                $error++;
                            }
                        } else {
                            $error++;
                        }
                    }
                }

                if ($error == 0) {
                    echo "Silahkan Melakukan Pembayaran";
                } else {
                    echo "Checkout Error";
                }
                
                unset($_SESSION['cart']);
            } else {
                echo "Order Gagal, Coba Ulangi Kembali";
            }
>>>>>>> deeb6f912aab6de114034ae3fc85698724799708
        }
}
?>
