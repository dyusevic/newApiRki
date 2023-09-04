<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8");
    
    include "config.php";

    $sql = mysqli_query($koneksi,"select * from pengguna where token = '".$_GET['token']."'");
    $check = mysqli_num_rows($sql);
    
    if($check > 0){
            
    $data = json_decode(file_get_contents("php://input"),true);
    
    $id=$data['id'];
    $jumlah=$data['jumlah'];
    
    $q=mysqli_query($koneksi,"update cart set jumlah = '".$jumlah."' where id = '".$id."'");
    
    if($q){

        echo json_encode(
            array(
                'response_code' => 200,
                'message' => 'Berhasil Update Data!'
            )
            );
    }

    }else{
        echo json_encode(
            array(
                'response_code' => 401,
                'message' => 'Gagal Update Data!'
            )
            );
    }


    ?>
