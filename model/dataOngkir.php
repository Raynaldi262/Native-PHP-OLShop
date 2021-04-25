<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "Select * from tbl_ongkir a join tbl_area b on a.area_id = b.area_id";
$getOngkir = mysqli_query($conn, $sql);

$sql1 = "Select * from tbl_area";
$getArea = mysqli_query($conn, $sql1);

$sql2 = "Select * from tbl_provinsi";
$getProv = mysqli_query($conn, $sql2);

if (isset($_POST['add_area'])) {
    addArea($conn);
}

if (isset($_POST['add_prov'])) {
    addProv($conn);
}

if (isset($_POST['add_ongkir'])) {
    addOngkir($conn);
}

if (isset($_POST['getOngkirWhere'])) {
    getOngkirWhere($conn);
}

if (isset($_POST['edit_item'])) {
    editOngkir($conn);
}

if (isset($_POST['get_ongkir'])) {
    getOngkirWhere($conn);
}

if (isset($_POST['delete_ongkir'])) {
    deleteOngkir($conn);
}

if (isset($_POST['deleteKota'])) {
    deleteArea($conn);
}

if (isset($_POST['deleteProv'])) {
    deleteProv($conn);
}

function addArea($conn)
{
    $area = $_POST['Area'];
    $prov = $_POST['provid'];

    $sql = "insert into tbl_area (area_name, prov_id) values ('" . $area . "', " . $prov . ")";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Area Berhasil ditambahkan!!', '../admin/ongkir.php');
    } else {
        msg('Area gagal ditambahkan!!', '../admin/ongkir.php');
    }
}

function addProv($conn)
{
    $prov = $_POST['prov'];

    $sql = "insert into tbl_provinsi (prov_name) values ('" . $prov . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Provinsi Berhasil ditambahkan!!', '../admin/ongkir.php');
    } else {
        msg('Provinsi gagal ditambahkan!!', '../admin/ongkir.php');
    }
}

function addOngkir($conn)
{
    $area = $_POST['area_id'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    $sql = "insert into tbl_ongkir (area_id, ongkir_type, ongkir_price, status) 
            values (" . $area . ",  '" . $tipe . "', " . $harga . ", '" . $status . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Ongkir Berhasil ditambahkan!!', '../admin/ongkir.php');
    } else {
        msg('Ongkir gagal ditambahkan!!', '../admin/ongkir.php');
    }
}

function getOngkirWhere($conn)
{
    $id = $_POST['ongkir_id'];

    $sql = "Select * from tbl_ongkir a join tbl_area b on a.area_id = b.area_id where ongkir_id = " . $id . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function editOngkir($conn)
{
    $id = $_POST['edit_id'];
    $area = $_POST['edit_area'];
    $tipe = $_POST['edit_tipe'];
    $harga = $_POST['edit_harga'];
    $status = $_POST['edit_status'];

    $sql = "update tbl_ongkir
            set area_id = " . $area . ", ongkir_type = '" . $tipe . "', ongkir_price = " . $harga . ", status = '" . $status . "'
            where ongkir_id = " . $id . " ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Ongkir Berhasil diubah!!', '../admin/ongkir.php');
    } else {
        msg('Ongkir gagal diubah!!', '../admin/ongkir.php');
    }
}

function deleteOngkir($conn)
{
    $id = $_POST['id_hapus'];

    $sql = "delete from tbl_ongkir where ongkir_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Ongkir Berhasil dihapus!!', '../admin/ongkir.php');
    } else {
        msg('Ongkir gagal dihapus!!', '../admin/ongkir.php');
    }
}

function deleteArea($conn)
{
    $id = $_POST['kota_id'];

    $sql = "delete from tbl_area where area_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Kota Berhasil dihapus!!', '../admin/ongkir.php');
    } else {
        msg('Kota gagal dihapus!!', '../admin/ongkir.php');
    }
}

function deleteProv($conn)
{
    $id = $_POST['prov_id'];

    $sql = "delete from tbl_provinsi where prov_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Provinsi Berhasil dihapus!!', '../admin/ongkir.php');
    } else {
        msg('Provinsi gagal dihapus!!', '../admin/ongkir.php');
    }
}


function msg($pesan, $url)
{
?>
    <script type="text/javascript">
        alert('<?php echo $pesan ?>');
        window.location = '<?php echo $url ?>';
    </script>
<?php
}
