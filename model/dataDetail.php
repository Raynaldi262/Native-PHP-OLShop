<?php
require('../connect/conn.php');
require('../session/session.php');

function getItem($conn, $id)
{
    $sql = "Select * from tbl_item a join tbl_item_type b on a.type_id = b.type_id join tbl_color c on a.color_id = c.color_id
             WHERE item_status = 'ACTIVE' and item_id = " . $id . "";
    $getItem = mysqli_query($conn, $sql);
    return $getItem;
}

function getItems($conn, $id)
{
    $sql = "Select * from tbl_item_detail a join tbl_size b
    on a.size_id = b.size_id
    where item_id = " . $id . " and status = 'ACTIVE'";
    $getItems = mysqli_query($conn, $sql);
    return $getItems;
}

$sql = "Select * from tbl_size";
$getSize = mysqli_query($conn, $sql);

if (isset($_GET['add_size'])) {
    addSize($conn);
}

if (isset($_GET['deleteSize'])) {
    deleteSize($conn);
}

if (isset($_GET['add_item'])) {
    addItem($conn);
}

if (isset($_GET['delete_item'])) {
    deleteItem($conn);
}

if (isset($_POST['add_stok'])) {
    updateincStok($conn);
}

if (isset($_POST['dec_stok'])) {
    updateDecStok($conn);
}

if (isset($_POST['stok_item'])) {
    getStok($conn);
}

if (isset($_GET['add_stok'])) {
    updateincStok($conn);
}

if (isset($_GET['dec_stok'])) {
    updateDecStok($conn);
}

function addSize($conn)
{
    $size = $_GET['ukuran'];
    $itemid = $_GET['itemid'];

    $sql = "insert into tbl_size(size_name) values('" . $size . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Ukuran Berhasil ditambahkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
    } else {
        msg('Ukuran gagal ditambahkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
    }
}

function deleteSize($conn)
{
    $id = $_GET['id'];
    $itemid = $_GET['itemid'];

    $sql = "delete from tbl_size where size_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Ukuran Berhasil dihapus!!', '../admin/stok_detail.php?itemid=' . $itemid);
    } else {
        msg('Ukuran gagal dihapus!!', '../admin/stok_detail.php?itemid=' . $itemid);
    }
}

function addItem($conn)
{
    $itemid = $_GET['itemid'];
    $size = $_GET['size'];
    $qty = $_GET['item_qty'];

    $sql = "insert into tbl_item_detail (size_id, detail_qty, item_id, status) 
            values(" . $size . "," . $qty . "," . $itemid . ",'ACTIVE')";
    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT LAST_INSERT_ID()";
    $hasil = mysqli_query($conn, $sql2);
    $item_id = mysqli_fetch_row($hasil);

    $sql3 = "insert into tbl_stockinout (detail_id, stok_qty , create_date, stok_desc, total_qty) 
                    values(" . $item_id[0] . ",0, now() , 'STOCK IN', " . $qty . ")";
    $result2 = mysqli_query($conn, $sql3);


    if ($result) {
        msg('Data Berhasil ditambahkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
    } else {
        msg('Data gagal ditambahkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
    }
}


function deleteItem($conn)
{
    $id = $_GET['id_hapus'];
    $itemid = $_GET['itemid'];

    $sql = "update tbl_item_detail 
            set status = 'IN-ACTIVE'
            where detail_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil dihapus!!', '../admin/stok_detail.php?itemid=' . $itemid);
    } else {
        msg('Data gagal dihapus!!', '../admin/stok_detail.php?itemid=' . $itemid);
    }
}

function getStok($conn)
{
    $id = $_POST['id'];

    $sql = "select detail_id, detail_qty from tbl_item_detail where detail_id = " . $id . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function updateincStok($conn)
{
    $itemid = $_GET['stok_itemid'];
    $id = $_GET['stok_id'];
    $stokOld = $_GET['stok_old'];
    $stok = $_GET['stok'];
    $total = $stokOld + $stok;

    $sql = "update tbl_item_detail set detail_qty = " . $total . " where detail_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    $sql2 = "insert into tbl_stockinout (detail_id, stok_qty ,stok_desc, create_date, total_qty) 
                values(" . $id . ", " . $stok . ",'STOCK IN', now(), " . $total . " )";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2 == 1 && $result == 1) {
        msg('Stok Berhasil ditambahkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
    } else {
        msg('Stok gagal ditambahkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
    }
}

function updateDecStok($conn)
{
    $itemid = $_GET['stok_itemid'];
    $id = $_GET['stok_id'];
    $stokOld = $_GET['stok_old'];
    $stok = $_GET['stok'];
    $total = $stokOld - $stok;

    if ($stok > $stokOld) {
        msg('Stok gagal dikurangkan, jumlah stok tidak mencukupi!!', '../admin/stok_detail.php?itemid=' . $itemid);
    } else {
        $sql = "update tbl_item_detail set detail_qty = " . $total . " where detail_id = " . $id . "";
        $result = mysqli_query($conn, $sql);

        $sql2 = "insert into tbl_stockinout (detail_id, stok_qty ,stok_desc, create_date, total_qty) 
                values(" . $id . ", " . $stok . ",'STOCK OUT', now(), " . $total . " )";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2 == 1 && $result == 1) {
            msg('Stok Berhasil dikurangkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
        } else {
            msg('Stok gagal dikurangkan!!', '../admin/stok_detail.php?itemid=' . $itemid);
        }
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
