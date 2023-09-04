<?php
        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        
        include "config.php";

		$headers = getallheaders();
        if (!isset($headers['Authorization'])) {
          http_response_code(401);
          exit();
        }else{
            
            $tokens = explode(' ', $headers['Authorization']);
            $sql = mysqli_query($koneksi,"select * from pengguna where token = '".$tokens[1]."'");
            $check = mysqli_num_rows($sql);
            
            if($check > 0){
                
                $row = array();
                $sql2 = mysqli_query($koneksi,"select * from kategori order by id asc");
                while($data = mysqli_fetch_assoc($sql2)){
                    $row[] = $data;
                }

                echo json_encode(
                    array(
                        'response_code' => 200,
                        'message' => 'Data Berhasil Ditampilkan',
                        'data' => $row
                    )
                );
        	
            }else{
                echo json_encode(
                    array(
                        'response_code' => 401,
                        'message' => 'Gagal Mengambil Data!'
                    )
                    );
                }
        }        
            

?>