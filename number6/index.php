<?php
include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD | Pemesanan</title>

    <!-- bootstrap 4 css cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- font awesome css cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jquery js cdn -->
    <script rel="preload" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</head>
<body>

    <!-- begin:: navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container">
            <form style="width: 100%; font-family: Raleway" method="post">
                <input type="text" name="q" class="form-control" placeholder="Search ...">
            </form>
            &nbsp;
            <button type="button" class="btn btn-warning" style="color: white;" data-toggle="modal" data-target="#add">ADD</button>
        </div>
    </nav>
    <!-- end:: navbar -->

    <!-- begin:: body -->
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead style="background-color: #ffd800; color: white; font-family: Raleway">
                                <tr>
                                    <th>No</th>
                                    <th>Cashier</th>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no  = 1;
                                if (isset($_POST['q']))
                                {
                                    $q = $_POST['q'];
                                    $sql = "SELECT tb_product.id, tb_product.`name` AS produk, tb_product.price, tb_category.`name` AS kategori, tb_cashier.`name` AS kasir FROM tb_product INNER JOIN tb_category ON tb_product.id_category = tb_category.id INNER JOIN tb_cashier ON tb_product.id_cashier = tb_cashier.id WHERE tb_product.`name` LIKE '%$q%' OR tb_product.price LIKE '%$q%' OR tb_category.`name` LIKE '%$q%' OR tb_cashier.`name` LIKE '%$q%' ORDER BY tb_product.id";
                                } else
                                {
                                    $sql = "SELECT tb_product.id, tb_product.`name` AS produk, tb_product.price, tb_category.`name` AS kategori, tb_cashier.`name` AS kasir FROM tb_product INNER JOIN tb_category ON tb_product.id_category = tb_category.id INNER JOIN tb_cashier ON tb_product.id_cashier = tb_cashier.id ORDER BY tb_product.id";
                                }
                                $qry = $connect->query($sql);
                                while ($row = $qry->fetch_array(MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td align="center"> <b><?= $no++ ?></b> </td>
                                        <td> <?= $row['kasir'] ?> </td>
                                        <td> <?= $row['produk'] ?> </td>
                                        <td> <?= $row['kategori'] ?> </td>
                                        <td> Rp. <?= number_format($row['price']) ?> </td>
                                        <td align="center">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?= $row['id'] ?>" data-target="#upd"><i class="fa fa-edit"></i></button>&nbsp;
                                            <button class="btn btn-danger btn-sm" id="del" data-id="<?= $row['id'] ?>" data-nm="<?= $row['kasir'] ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end:: body -->    

    <!-- begin:: modal add -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="add_process.php" id="formAdd">
                        <div class="form-group">
                            <select name="inpnmkasir" class="form-control">
                                <option value="">Pilih nama kasir</option>
                                <?php
                                $sql = "SELECT * FROM tb_cashier";
                                $qry = $connect->query($sql);
                                while ($row = $qry->fetch_array(MYSQLI_ASSOC)) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="inpkategori" class="form-control">
                                <option value="">Pilih kategori</option>
                                <?php
                                $sql = "SELECT * FROM tb_category";
                                $qry = $connect->query($sql);
                                while ($row = $qry->fetch_array(MYSQLI_ASSOC)) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="inpnmproduk" class="form-control" placeholder="Masukkan nama produk" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="inphg" class="form-control" placeholder="Masukkan harga" />
                        </div>
                        <div class="text-right">
                            <input type="submit" name="add" value="ADD" class="btn btn-warning btn-sm" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: modal add -->

    <!-- begin:: modal upd -->
    <div class="modal fade" id="upd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UPD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="form-ubah">
                        <!-- isi form ubah -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: modal upd -->
    
    <!-- poper js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- bootstrap 4 js cdn -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- sweetalert js cdn -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            // untuk proses tambah
            $('#formAdd').submit(function () {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data) {
                        swal({
                            title: data.title,
                            text: data.text,
                            icon: data.icon,
                            button: data.button,
                        }).then(function () {
                            $('#add .close').click();
                            document.location = "index.php";
                        });
                    }
                })
                return false;
            });

            // untuk proses ubah
            $('#upd').on('submit', '#formUpd', function (e) {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data) {
                        swal({
                            title: data.title,
                            text: data.text,
                            icon: data.icon,
                            button: data.button,
                        }).then(function () {
                            $('#upd .close').click();
                            document.location = "index.php";
                        });
                    }
                })
                return false;
            });

            // untuk form ubah
            $('#upd').on('show.bs.modal', function (e) {
                let id = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'post',
                    url: 'upd.php',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('#form-ubah').html(data);
                    }
                });
            });

            // untuk proses hapus
            $('table').on('click', '#del', function () {
                var id = $(this).data('id');
                var nm = $(this).data('nm');

                swal({
                    title: "Apakah Anda yakin?",
                    text: "Data yang telah dihapus tidak dapat kambali lagi!",
                    icon: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false
                }).then(function (result) {
                    if (result == true) {
                        $.ajax({
                            type: "post",
                            url: "del_process.php",
                            dataType: 'json',
                            data: {
                                id: id,
                                nm: nm
                            },
                            success: function (data) {
                                if (data.icon == 'success') {
                                    swal({
                                        title: data.title,
                                        text: data.text,
                                        icon: data.icon,
                                        button: false,
                                    }).then(function () {
                                        document.location = "index.php";
                                    });
                                } else {
                                    swal({
                                        title: data.title,
                                        text: data.text,
                                        icon: data.icon,
                                        button: false,
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>

