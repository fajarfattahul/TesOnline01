<?php
include_once 'connection.php';

$id = $_POST['id'];
$nm = $_POST['nm'];

$sql = "DELETE FROM tb_product WHERE id = '$id'";
$qry = $connect->query($sql);

if ($qry == true) 
{
    exit(json_encode(array('title' => 'Data '.$nm.' ID #'.$id, 'text' => 'Berhasil dihapus', 'icon' => 'success')));
} else
{
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dihapus', 'icon' => 'error')));
}