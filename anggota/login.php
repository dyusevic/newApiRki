<?php
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        
        include "config.php";

       $data = json_decode(file_get_contents("php://input"),true);
        if (!empty($data)) {
            $user = mysqli_query($koneksi,"select * from pengguna where username = '".$data['username']."' and password = '".md5($data['password'])."'");
            if(mysqli_num_rows($user) > 0 ){
                $rows = mysqli_fetch_assoc($user);
                $bytes = random_bytes(60);
                $session = bin2hex($bytes);
                $update = mysqli_query($koneksi,"update pengguna set token = '".$session."' where username = '".$rows['username']."'");
                if($update){
                    $user_update = mysqli_fetch_assoc(mysqli_query($koneksi,"select * from pengguna where username = '".$data['username']."' and password = '".md5($data['password'])."'"));
                    echo json_encode(
                        array(
                            'response_code' => 200,
                            'message' => 'Login Berhasil',
                            'data' => $user_update
                        )
                    );
                }else{
                    echo json_encode(
                        array(
                            'response_code' => 200,
                            'message' => 'Gagal Generate Token'
                        )
                    ); 
                }
            }else{
                echo json_encode(
                    array(
                        'response_code' => 404,
                        'message' => 'Username atau Password Tidak Ditemukan!'
                    )
                    );
            }
        } else {
            echo json_encode(
                array(
                    'response_code' => 404,
                    'message' => 'Gagal Mengambil Data!'
                )
            );
        }
?>