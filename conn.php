<?php
function connection() {
   // membuat konekesi ke database system
   $dbServer = 'localhost';
   $dbUser = 'root';
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
    // echo "<script>alert('$msg');</script>";
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
    }
}
