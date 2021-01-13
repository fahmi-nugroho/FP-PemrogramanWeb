<?php
include('conn.php');

if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $id_user = $_GET['id'];
        $sql_get = "DELETE FROM user WHERE id_user = '$id_user'";
        $res_get = mysqli_query(connection(),$sql_get);

        header("Location: http://localhost/benaya/FP-PemrogramanWeb-master/FP-PemrogramanWeb-master/admin.php");    
}