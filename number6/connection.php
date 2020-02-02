<?php
$host       = "localhost";
$username   = "root";
$password   = "";
$db_name    = "db_06";

$connect = new mysqli($host, $username, $password, $db_name);

if ($connect->connect_errno) {
    echo "Koneksi Gagal" . $connect->connect_error;
}