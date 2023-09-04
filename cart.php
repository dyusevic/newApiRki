<?php

        session_start();

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
                $sesionid = session_id();
                $cleartag = str_replace("'"," ", $data['keterangan']);
                mysqli_query($koneksi,"insert into cart(kode_barang,nama_barang,stok,harga,photo, keterangan, id_kategori, id_koperasi, session_id)values('".$data['kode_barang']."','".$data['nama_barang']."','".$data['stok']."','".$data['harga']."','".$data['photo']."','".$cleartag."','".$data['id_kategori']."','".$data['id_koperasi']."','".$sesionid."')");
                $ids = mysqli_insert_id($koneksi);
                $sql2 = mysqli_query($koneksi,"select * from cart where session_id = '".$sesionid."'");
                if($sql2){
                    $rr = mysqli_fetch_assoc($sql2);
                    echo json_encode(
                        array(
                            'response_code' => 200,
                            'message' => 'Success',
                            'data' => "insert into cart(kode_barang,nama_barang,stok,harga,photo, keterangan, id_kategori, id_koperasi, session_id)values('".$data['kode_barang']."','".$data['nama_barang']."','".$data['stok']."','".$data['harga']."','".$data['photo']."','".$cleartag."','".$data['id_kategori']."','".$data['id_koperasi']."','".$sesionid."')"
                        )
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