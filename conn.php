<?php

date_default_timezone_set("Asia/Jakarta");

function connection() {
   // membuat konekesi ke database system
   $dbServer = 'localhost';
   $dbUser = 'root';
   // $dbPass = 'bengkulu10';
   $dbPass = '';
   $dbName = "online_shop";

   $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

   if(!$conn) {
	die('Koneksi gagal: ' . mysqli_error());
   }
   //memilih database yang akan dipakai
   mysqli_select_db($conn, $dbName);

   return $conn;
}

function message($msg){
    echo "<script>alert('$msg');</script>";
}

function redirect($link){
    echo "<script>window.location = '$link';</script>";
}

if (isset($_POST['act'])) {
    if ($_POST['act'] == "cekEmail" && isset($_POST['data'])) {
        $email = $_POST['data'];

        $query = "SELECT * FROM user WHERE email_user = '$email'";
        $result = mysqli_query(connection(), $query);

        echo mysqli_num_rows($result);
    } elseif ($_POST['act'] == "regis") {
        $email = $_POST['email'];
        $nama = strtolower(explode("@", $email)[0]);
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

        $query = "INSERT INTO user VALUES (null, '$nama', '$email', '$pass', null, null, null, 0)";

        if (mysqli_query(connection(), $query)) {
            echo "Silahkan Login";
        } else {
            echo "Register Gagal";
        }
    } elseif ($_POST['act'] == "login") {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $query = "SELECT * FROM user WHERE email_user = '$email'";
        $result = mysqli_query(connection(), $query);

        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_array($result);
            if (password_verify($pass, $data['pass_user'])) {
                session_start();

                echo "Login berhasil";
                $_SESSION['user'] = array(
                    'id' => $data['id_user'],
                    'nama' => $data['nama_user'],
                    'gambar' => $data['foto_user']
                );
            } else {
                echo "Email atau Password Salah";
            }
        } else {
            echo "Email atau Password Salah";
        }
    } elseif ($_POST['act'] == "logout") {
        unset($_SESSION['cart']);
        unset($_SESSION['user']);
        redirect("dashboard.php");
    } elseif ($_POST['act'] == "updOrder") {
        $id = $_POST['id'];
        $status = $_POST['status'];

        if ($status == "Pesanan Dibatalkan" && isset($jenis) && $jenis == 'voucher') {
            $query = "UPDATE daftar_orderv SET status = '$status' WHERE id = $id";
            $result = mysqli_query(connection(), $query);
            if ($result) {
              echo "Pembatalan Berhasil";
            }
            else {
              echo "Pembatalan Gagal";
            }

        } elseif ($status == "Proses Pengiriman") {
            $resi = $_POST['resi'];

            $sql = "UPDATE daftar_order SET status = '$status', resi = '$resi' WHERE id = $id";
            if (mysqli_query(connection(), $sql)) {
                echo "Pengiriman Dilakukan";
            } else {
                echo "Pengiriman Gagal";
            }
        } elseif ($status == "Pesanan Dibatalkan") {
            $query = "SELECT * FROM daftar_order WHERE id = $id";
            $result = mysqli_query(connection(), $query);
            $data = mysqli_fetch_array($result);
            $error = 0;

            if (!empty($data['bukti'])) {
                $myquery = "SELECT * FROM user WHERE id_user = ".$data['id_user'];
                $hasilpro = mysqli_query(connection(), $myquery);
                $user = mysqli_fetch_array($hasilpro);

                $wallet = $user['wallet'] + $data['total'];
                $sql = "UPDATE user SET wallet = '$wallet' WHERE id_user = ".$data['id_user'];
                if (!mysqli_query(connection(), $sql)) {
                    $error ++;
                }
            }

            if ($error == 0) {
                $sql = "UPDATE daftar_order SET status = '$status' WHERE id = $id";
                if (mysqli_query(connection(), $sql)) {
                    $sqli = "SELECT * FROM order_detail WHERE id_daftar = ".$data['id'];
                    $hasil = mysqli_query(connection(), $sqli);

                    while ($detail = mysqli_fetch_array($hasil)){
                        $myquery = "SELECT * FROM produk WHERE id_produk = ".$detail['id_barang'];
                        $hasilpro = mysqli_query(connection(), $myquery);
                        $produk = mysqli_fetch_array($hasilpro);

                        $stok = $produk['stok'] + $detail['jumlah'];
                        mysqli_query(connection(), "UPDATE produk SET stok = $stok WHERE id_produk = ".$detail['id_barang']);
                    }
                    echo "Pembatalan Berhasil";
                } else {
                    echo "Pembatalan Gagal";
                }
            } else {
                echo "Pembatalan Gagal";
            }
        }
        elseif ($status == "Pesanan Selesai") {
          $query = "UPDATE daftar_order SET status = '$status' WHERE id = $id";
          $result = mysqli_query(connection(), $query);
          $querySelect = "SELECT * FROM daftar_order WHERE id = $id";
          $resultSelect = mysqli_query(connection(), $querySelect);
          $daftar = mysqli_fetch_array($resultSelect);
          $queryPenjual = "SELECT * FROM user WHERE id_user = ". $daftar['id_penjual'];
          $resultPenjual = mysqli_query(connection(), $queryPenjual);
          $penjual = mysqli_fetch_array($resultPenjual);

          if ($result) {
            $wallet = $penjual['wallet'] + $daftar['total'];
            $queryWallet = "UPDATE user SET wallet = $wallet WHERE id_user = ".$penjual['id_user'];
            $resultWallet = mysqli_query(connection(), $queryWallet);
            echo "Penyelesaian Berhasil";
          }
          else {
            echo "Penyelesaian Gagal";
          }
        }
    // } elseif ($_POST['act'] == "read") {
    //     $table = $_POST['table'];
    //
    //     $query = "SELECT * FROM $table";
    //     $result = mysqli_query(connection(), $query);
    //
    //     $order = array();
    //     if (isset($_POST['id'])) {
    //         $id = $_POST['id'];
    //         while ($data = mysqli_fetch_array($result)) {
    //             if ($data[0] == $id) {
    //                 $order = $data;
    //                 break;
    //             }
    //         }
    //     } else {
    //         while ($data = mysqli_fetch_array($result)) {
    //             array_push($order, $data);
    //         }
    //     }
    //
    //     echo json_encode($order);
    }
}
