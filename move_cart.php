<?php

        session_start();

        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        header("Content-Type: application/json; charset=utf-8");
        
        include "config.php";

        $sql = mysqli_query($koneksi,"select * from pengguna where token = '".$_GET['token']."'");
        $dd = mysqli_fetch_assoc($sql);
        $check = mysqli_num_rows($sql);
            
            if($check > 0){
                
               
                    $cartContent = array();
                    $sid = session_id();
                    $sql2 = mysqli_query($koneksi,"select * from cart where session_id='".$sid."'");
                    
                    while ($data2 = mysqli_fetch_array($sql2)) {
                        $cartContent[] = $data2;
                    }
                  
                    $jml     = count($cartContent);
                
                  for ($i = 0; $i < $jml; $i++) {
                    mysqli_query($koneksi,"insert into pemesanan(kode_barang,nama_barang,stok,harga,photo, keterangan, id_kategori, jumlah, id_koperasi, id_user, session_id)values('".$cartContent[$i]['kode_barang']."','".$cartContent[$i]['nama_barang']."','".$cartContent[$i]['stok']."','".$cartContent[$i]['harga']."','".$cartContent[$i]['photo']."','".$cartContent[$i]['keterangan']."','".$cartContent[$i]['id_kategori']."','".$cartContent[$i]['jumlah']."','".$cartContent[$i]['id_koperasi']."','".$dd['id']."','".$sid."')");
                  }

                  echo json_encode(
                    array(
                        'response_code' => 200,
                        'message' => 'Berhasil Move Data!'
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
                
            

?>