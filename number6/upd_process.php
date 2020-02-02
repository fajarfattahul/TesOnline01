<?php
include_once 'connection.php';

$id       = $_POST['inpid'];
$nmkasir  = $_POST['inpnmkasir'];
$kategori = $_POST['inpkategori'];
$nmproduk = $_POST['inpnmproduk'];
$hgproduk = $_POST['inphg'];

$sql = "UPDATE tb_product SET name = '$nmproduk', price = '$hgproduk', id_category = '$kategori', id_cashier = '$nmkasir' WHERE id = '$id'";
$qry = $connect->query($sql);

if ($qry == true) 
{
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah', 'icon' => 'success', 'button' => 'OK!')));
} else
{
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah', 'icon' => 'error', 'button' => 'OK!')));
}