<?php
include('conn.php');

if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $id_produk = $_GET['id'];
        $sql_get = "DELETE FROM produk WHERE id_user = '$id_user'";
        $res_get = mysqli_query(connection(),$sql_get);

        header("Location: http://localhost/benaya/FP-PemrogramanWeb-master/FP-PemrogramanWeb-master/admin.php");    
}