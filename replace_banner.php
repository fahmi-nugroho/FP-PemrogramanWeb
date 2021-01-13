<?php
$target_dir = "assets/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File bukan gambar.";
    $uploadOk = 0;
  }
}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" ) {
  echo "Pastikan file berformat JPG, JPEG dan PNG .";
  $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo '<div class="alert alert-success" role="alert">
    Data Berhasil Ditambahkan <a href="admin.php" class="alert-link">Admin </a>.Click Admin untuk kembali ke admin page.
  </div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">
    Data Gagal Ditambahkan<a href="admin.php" class="alert-link">Admin</a>.Click Admin untuk kembali ke admin page.
  </div>';
  }
}


?>