<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "select * from tbl_proses a
        join tbl_customer b on a.cust_id = b.cust_id
        where status = 'Menunggu Konfrimasi'";
$getPesanan = mysqli_query($conn, $sql);

$sql = "select * from 
        (Select proses_id, a.date_id id, a.cust_id as cust_id, price, kurir, a.status as status, img_bayar,b.item_id,qty,
        item_name, type_name, item_size, color_name, item_weight, item_qty as stock, item_price , cust_name, cust_address
        from tbl_proses a 
        join tbl_detailorder b on a.date_id = b.date_id
        join (select item_id, item_name, type_name, item_size, color_name, item_weight, item_qty, item_price from tbl_item a 
            join tbl_color b on a.color_id = b.color_id 
            join tbl_item_type c on a.type_id = c.type_id) as c
        on b.item_id = c.item_id
        join tbl_customer d on a.cust_id = d.cust_id) as a";
$getItem = mysqli_query($conn, $sql);


if (isset($_POST['get_pesanan'])) {
    getPesanan($conn);
}

function getPesanan($conn)
{
    $id = $_POST['pesananID'];

    $sql = "select * from 
        (Select proses_id, a.date_id id, a.cust_id as cust_id, price, kurir, a.status as status, img_bayar,b.item_id,qty,
        item_name, type_name, item_size, color_name, item_weight, item_qty as stock, item_price
        from tbl_proses a 
        join tbl_detailorder b on a.date_id = b.date_id
        join (select item_id, item_name, type_name, item_size, color_name, item_weight, item_qty, item_price from tbl_item a 
            join tbl_color b on a.color_id = b.color_id 
            join tbl_item_type c on a.type_id = c.type_id) as c
        on b.item_id = c.item_id ) as a
        where id = '" . $id . "' ";

    $result = mysqli_query($conn, $sql);
    $results = [];

    while ($datas = mysqli_fetch_assoc($result)) {
        $results[] = $datas; //assign whole values to array
    }

    echo json_encode($results);
}

function deleteBanner($conn)
{
    $id = $_POST['id_hapus'];

    $sql = "delete from tbl_banner where banner_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Banner Berhasil dihapus!!', '../admin/banner.php');
    } else {
        msg('Banner gagal dihapus!!', '../admin/banner.php');
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
