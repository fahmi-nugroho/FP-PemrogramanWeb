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

                if ($_SESSION['user']['id'] == $data['penjual']) {
                    echo "sama";
                } else {
                    if (isset($_SESSION['cart']['cart_'.$id]) && $_SESSION['cart']['cart_'.$id] < $data['stok']) {
                        $_SESSION['cart']['cart_'.$id] ++;
                    } else {
                        $_SESSION['cart']['total'] += 1;
                        $_SESSION['cart']['cart_'.$id] = 1;
                    }
                }

            } elseif ($action == "kurang") {
                if ($_SESSION['cart']['cart_'.$id] > 1) {
                    $_SESSION['cart']['cart_'.$id] --;
                } else {
                    unset($_SESSION['cart']['cart_'.$id]);
                    $_SESSION['cart']['total'] --;
                }
            }
        } elseif ($action == "total") {
            $price = 0;

            if (isset($_SESSION['cart']) && $_SESSION['cart']['total'] > 0) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if (substr($key, 0, 5) == "cart_") {
                        $id = substr($key, 5, strlen($key));
                        $query = "SELECT * FROM produk WHERE id_produk = $id";
                        $produk = mysqli_query(connection(), $query);
                        $data = mysqli_fetch_array($produk);

                        $price += $value * $data['harga'];
                    }
                }
            }

            echo json_encode(array(
                'harga' => "Rp ".number_format($price, 2, ',', '.'),
                'total' =>  (isset($_SESSION['cart'])) ? $_SESSION['cart']['total'] : "0"
            ));
        } elseif ($action == "view") {
            $no = 0;
            if (isset($_SESSION['cart']) && $_SESSION['cart']['total'] > 0) { ?>
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Toko</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga (Rp)</th>
                        <th scope="col" class="text-center">Kuantitas</th>
                    </tr>
                </thead>
                <tbody> <?php
                    foreach ($_SESSION['cart'] as $key => $value) {
                        if (substr($key, 0, 5) == "cart_") {
                            $id = substr($key, 5);
                            $query = "SELECT * FROM produk WHERE id_produk = $id";
                            $produk = mysqli_query(connection(), $query);
                            $data = mysqli_fetch_array($produk); ?>
                            <tr>
                                <th scope="row" class="align-middle"><?= ++$no ?></th>
                                <td class="align-middle"><?= mysqli_fetch_array(mysqli_query(connection(), "SELECT nama_user FROM user WHERE id_user =".$data['penjual']))[0] ?></td>
                                <td><img src="assets/img/<?= $data['gambar'] ?>" style="width:60px; height:60px" alt=""></td>
                                <td class="align-middle"><?= wordwrap($data['nama_produk'], 25, "<br>") ?></td>
                                <td class="align-middle"><?= number_format($data['harga'], 2, ',', '.') ?></td>
                                <td class="align-middle text-center" colspan="2">
                                    <ul class="list-inline">
                                      <li class="list-inline-item"><button type="button" class="btn btn-dark btn-sm" name="button" onclick="addCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">+</button></li>
                                      <li class="list-inline-item"><?= $value ?></li>
                                      <li class="list-inline-item"><button type="button" class="btn btn-dark btn-sm" name="button" onclick="minCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">-</button></li>
                                    </ul>
                                </td>
                            </tr> <?php
                        }
                    } ?>
                </tbody> <?php
            } else { ?>
                <h1 class="display-4 text-center">Cart Kosong</h1> <?php
            }
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

                <h5 class="my-3"><?= mysqli_fetch_array(mysqli_query(connection(), "SELECT nama_user FROM user WHERE id_user =".$toko[$i]))[0] ?></h5> <?php

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

            $idorder = time();
            $tgl = date("d/m/Y");

            $cart = $toko = array();
            $totalpt = 0;

            foreach ($_SESSION['cart'] as $key => $value) {
                if (substr($key,0,5) == "cart_") {
                    $id = substr($key, 5);

                    $query = "SELECT * FROM produk WHERE id_produk = $id";
                    $sql = mysqli_query(connection(), $query);
                    $produk = mysqli_fetch_array($sql);

                    if ($produk[6] < $value) {
                        unset($_SESSION['cart'][$key]);
                        $_SESSION['cart']['total']--;
                        echo "Terdapat barang yang melebihi stok, silahkan input barang ulang";
                        die();
                    }

                    array_push($cart, array('id' => $id, 'penjual' => $produk[2], 'nama' => $produk[3], 'harga' => $produk[5], 'stok' => $produk[6]));
                    array_push($toko, $produk['penjual']);
                }
            }

            $toko = array_unique($toko);
            for ($i = 0; $i < count($toko); $i ++) {
                $totalpt = 0;

                foreach ($cart as $key => $value) {
                    if ($value['penjual'] == $toko[$i]){
                        $totalpt += $value['harga'] * $_SESSION['cart']['cart_'.$value['id']];
                    }
                }
                //
                $totalpt += $totalpt + $ongkir;

                $query = "INSERT INTO daftar_order VALUES (NULL,
                            $idorder,
                            ".$data['id_user'].",
                            ".$toko[$i].",
                            '".$data['nama_user']."',
                            '$tgl',
                            '".$data['alamat_user']."',
                            '".$data['telepon_user']."',
                            '$totalpt', '$kurir', '$bayar',
                            'Menunggu Pembayaran')";

                if (mysqli_query(connection(), $query)) {
                    foreach ($cart as $key => $value) {
                        if ($value['penjual'] == $toko[$i]){
                            $jml = $_SESSION['cart']['cart_'.$value['id']];
                            $stok = $value['stok'] - $jml;

                            if (mysqli_query(connection(), "UPDATE produk SET stok = $stok WHERE id_produk = ".$value['id'])) {
                                $query = "SELECT * FROM daftar_order WHERE id_order = $idorder AND id_penjual = ".$value['penjual'];
                                $sql = mysqli_query(connection(), $query);
                                $do = mysqli_fetch_array($sql);

                                if (mysqli_query(connection(), "INSERT INTO order_detail VALUES (NULL, $do[0], $idorder, ".$value['id'].", $jml, ".$value['harga'].")")) {
                                    unset($cart[$key]);
                                } else message($sql);
                            } else message($sql);
                        }
                    }
                } else message($sql);
            }

            unset($_SESSION['cart']);
            echo "Silahkan Melakukan Pembayaran";
        }
}
?>
