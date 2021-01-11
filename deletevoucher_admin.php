<?php
include('conn.php');

if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $id_voucher = $_GET['id'];
        $sql_get = "DELETE FROM voucher WHERE id_voucher = '$id_voucher'";
        $res_get = mysqli_query(connection(),$sql_get);

        header("Location: http://localhost/benaya/FP-PemrogramanWeb-master/FP-PemrogramanWeb-master/admin.php");    
}