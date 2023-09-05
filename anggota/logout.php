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
                $d = mysqli_fetch_assoc($sql);
                $update = mysqli_query($koneksi,"update pengguna set token = '' where username = '".$d['username']."'");
                        if($update){
                        $r = array(
                            "status"=>"success",
                            "data"=> null
                            );
                        }else{
                        $r = array(
                            "status"=>"failed",
                            "data"=>array('status'=>'token tidak ditemukan')
                            );
                        }
            }else{
                echo json_encode(
                    array(
                        'response_code' => 401,
                        'message' => 'Gagal Mengambil Data!'
                    )
                    );
                }
?>