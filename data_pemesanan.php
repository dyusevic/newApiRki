
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

    $q=mysqli_query($con,"select * from pemesanan where session_id = '".$_GET['id']."'");
    while ($row=mysqli_fetch_object($q)){
        $data[] = $row;
    }
    echo json_encode($data);


    }else{

        echo json_encode(
            array(
                'response_code' => 401,
                'message' => 'Gagal Mengambil Data!'
            )
            );
    }
    ?>


