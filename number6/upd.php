<?php
include_once 'connection.php';
$id   = $_POST['id'];
$sql  = "SELECT * FROM tb_product WHERE id = '$id'";
$qry  = $connect->query($sql);
$rows = $qry->fetch_array(MYSQLI_ASSOC);
?>

<form method="post" action="upd_process.php" id="formUpd">

    <!-- begin:: id -->
    <input type="hidden" name="inpid" value="<?= $id ?>">
    <!-- end:: id -->

    <div class="form-group">
        <select name="inpnmkasir" class="form-control">
            <?php
            $sql = "SELECT * FROM tb_cashier";
            $qry = $connect->query($sql);
            while ($row = $qry->fetch_array(MYSQLI_ASSOC)) { ?>
                <option value="<?= $row['id'] ?>" <?= ($rows['id_cashier'] == $row['id']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <select name="inpkategori" class="form-control">
            <option value="">Pilih kategori..</option>
            <?php
            $sql = "SELECT * FROM tb_category";
            $qry = $connect->query($sql);
            while ($row = $qry->fetch_array(MYSQLI_ASSOC)) { ?>
                <option value="<?= $row['id'] ?>" <?= ($rows['id_category'] == $row['id']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <input type="text" name="inpnmproduk" class="form-control" value="<?= $rows['name'] ?>" />
    </div>
    <div class="form-group">
        <input type="text" name="inphg" class="form-control" value="<?= $rows['price'] ?>" />
    </div>
    <div class="text-right">
        <input type="submit" name="upd" value="UPD" class="btn btn-warning btn-sm" />
    </div>
</form>