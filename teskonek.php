<?php
include("config.php");
$user = mysqli_query($koneksi,"select * from pengguna");
if($user){
    echo "berhasil";
    echo date("YmdHis");
}else{
    echo "tidak berhasil";
    echo date("YmdHis");
}
?>