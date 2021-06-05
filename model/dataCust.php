<?php
require('../connect/conn.php');
require('../session/session.php');

function getDataOrder($conn, $id)
{
    // $sql = "SELECT * from tbl_order where cust_id = " .  $_SESSION['cust_id'] . " AND date_id = " . $date_id . " ";
    $sql = "select a.date_id, order_invoice from tbl_detailorder a 
            join (select status, date_id from tbl_proses where status <> 'Menunggu Konfrimasi') b
            on a.date_id = b.date_id join tbl_order c
            on a.date_id = c.date_id
            where a.cust_id = " . $id . " group by date_id";
    $result = mysqli_query($conn, $sql);

    $results = [];

    while ($datas = mysqli_fetch_assoc($result)) {
        $results[] = $datas; //assign whole values to array
    }

    return $results;
}

function getCust($conn, $id)
{
    // $sql = "SELECT * from tbl_order where cust_id = " .  $_SESSION['cust_id'] . " AND date_id = " . $date_id . " ";
    $sql = "select * from tbl_customer
            where cust_id = " . $id . "";
    $item = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($item);
    return $data;
}

function getItem($conn, $id)
{
    $sql = "select * from 
        (Select proses_id, a.date_id id, a.cust_id as cust_id, price, kurir, a.status as status, img_bayar,b.item_id,qty,
        item_name, type_name, size_name, color_name, item_weight, detail_qty as stock, item_price, ongkir
        from tbl_proses a 
        join tbl_detailorder b on a.date_id = b.date_id
        join (select a.item_id, item_name, type_name, color_name, item_weight, item_price,
            size_name,  detail_qty 
            from tbl_item a 
            join tbl_color b on a.color_id = b.color_id 
            join tbl_item_type c on a.type_id = c.type_id
            join (select item_id, detail_id, size_name, detail_qty
            from tbl_item_detail a join tbl_size b
            on a.size_id = b.size_id
            where status = 'ACTIVE') d
            on a.item_id = d.item_id) as c
        on b.item_id = c.item_id and b.size = c.size_name ) as a
        where id = '" . $id . "' ";

    $result = mysqli_query($conn, $sql);
    $results = [];

    while ($datas = mysqli_fetch_assoc($result)) {
        $results[] = $datas; //assign whole values to array
    }

    return $results;
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
