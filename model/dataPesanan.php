<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "select * from tbl_proses a
        join tbl_customer b on a.cust_id = b.cust_id
        where status != 'Pesanan dibatalkan'";
$getPesanan = mysqli_query($conn, $sql);

if (isset($_POST['get_pesanan'])) {
    getPesanan($conn);
}

if (isset($_POST['acc_item'])) {
    terimaPesanan($conn);
}

if (isset($_POST['dec_item'])) {
    deletePesanan($conn);
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
    $results = mysqli_fetch_assoc($result);

    // while ($datas = mysqli_fetch_assoc($result)) {
    //     $results = $datas; //assign whole values to array
    // }

    echo json_encode($results);
}

function terimaPesanan($conn)
{
    $id = $_POST['item_id'];
    $cust_id = $_POST['cust_id'];
    $price = $_POST['price'];

    $c = checkStok($conn, $id);
    if ($c == 0) {  // kalau tidak ada stok yg kurang 
        $custData = getCustdata($conn, $cust_id);   //cari data order dan price dri user
        $custOrder = $custData[0]['cust_total_order'] + 1;
        $custPrice = $custData[0]['cust_total_price'] + $price;

        $itemData = getitemData($conn, $id);

        // // update tbl proses
        // $sql = "update tbl_proses
        //     set status = 'Proses Pengemasan'
        //     where date_id = '" . $id . "'";
        // $result = mysqli_query($conn, $sql);

        // //update tbl customer
        // $sql1 = "update tbl_customer
        // set cust_total_order = " . $custOrder . " , cust_total_price = " . $custPrice . "
        // where cust_id = '" . $cust_id . "'";
        // $result1 = mysqli_query($conn, $sql1);

        // foreach ($itemData as $data) {
        //     $stok = $data['item_qty'] - $data['qty'];

        //     // update stok item
        //     $sql2 = "update tbl_item    
        //     set item_qty = " . $stok . "
        //     where item_id = '" . $data['item_id'] . "'";

        //     $result2 = mysqli_query($conn, $sql2);

        //     //update history stok
        //     $sql3 = "insert into tbl_stockinout(item_id, item_name, stok_qty, stok_desc, stok_price, total_qty)
        //             values(" . $data['item_id'] . ", '" . $data['item_name'] . "', " . $data['qty'] . ", 'STOCK OUT'
        //             ," . $data['price'] . ", " . $stok . " )";

        //     $result3 = mysqli_query($conn, $sql3);
        // }

        $inv = generateInvoice($conn);
        getOrder($conn, $id);

        $sql4 = "insert into tbl_order (order_invoice, order_total, order_shipping, order_shipping_price, order_totprice,
                order_transfer, order_status, cust_id, item_id) 
                values('" . $inv . "', )";

        $result4 = mysqli_query($conn, $sql4);

        // msg('Pesanan berhasil dikonfirmasi!!', '../admin/pesanan.php');
    } else {
        msg('Tidak bisa diterima stok tidak mencukupi!!', '../admin/stok.php');
    }
}

function getCustdata($conn, $cust_id)
{
    $sql = "select cust_total_order, cust_total_price from tbl_customer
            where cust_id = " . $cust_id . "";

    $result = mysqli_query($conn, $sql);
    $results = [];

    while ($datas = mysqli_fetch_assoc($result)) {
        $results[] = $datas; //assign whole values to array
    }

    return $results;
}

function getitemData($conn, $id)
{
    $sql = "select a.item_id, qty, item_qty, item_name, price from tbl_detailorder a
            join tbl_item b on a.item_id = b.item_id 
            join tbl_proses c on a.date_id = c.date_id
            where a.date_id = '" . $id . "'";
    $result = mysqli_query($conn, $sql);

    $results = [];

    while ($datas = mysqli_fetch_assoc($result)) {
        $results[] = $datas; //assign whole values to array
    }

    return $results;
}

function generateInvoice($conn)
{
    $thn = date('y');

    $tmp = 'MA/INV/' . date('d-m-y') . '/00001';
    $sql = "select order_invoice from tbl_order
            where substring(order_invoice,14,2) = '" . $thn . "' order by create_date desc limit 1";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count == 0) {  // kalau blm ada yg tahun ini
        return $tmp;
    } else {
        $sql1 = "select substring(order_invoice,17,5)+1 as invoice from tbl_order
            where substring(order_invoice,14,2) = '" . $thn . "' order by create_date desc limit 1";
        $result1 = mysqli_query($conn, $sql1);
        $result1 = mysqli_fetch_assoc($result1);

        $tmp = str_pad($result1['invoice'], 5, "0", STR_PAD_LEFT);
        $tmp = 'MA/INV/' . date('d-m-y') . '/' . $tmp;
        return $tmp;
    }

    // var_dump($sql);
}

function deletePesanan($conn)
{
    $id = $_POST['item_id'];

    $sql = "update tbl_proses
            set status = 'Pesanan dibatalkan'
            where date_id = '" . $id . "'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        msg('Pesanan berhasil dibatalkan!!', '../admin/pesanan.php');
    }
}

function checkStok($conn, $id)
{
    $sql = "select 1 from 
    (Select proses_id, a.date_id id, a.cust_id as cust_id, price, kurir, a.status as status, img_bayar,b.item_id,qty,
    item_name, item_size, item_weight, item_qty as stock, item_price
    from tbl_proses a 
    join tbl_detailorder b on a.date_id = b.date_id
    join (select item_id, item_name, item_size, item_weight, item_qty, item_price from tbl_item) as c
    on b.item_id = c.item_id ) as a
    where id = '" . $id . "' and qty > stock";

    $result = mysqli_query($conn, $sql);
    return $result = mysqli_num_rows($result);
}

function getOrder($conn, $id)
{
    $sql = "select sum(qty) as order_total, kurir, from 
        (Select proses_id, a.date_id id, a.cust_id as cust_id, price, kurir, a.status as status, img_bayar,b.item_id,qty,
        item_name, type_name, item_size, color_name, item_weight, item_qty as stock, item_price
        from tbl_proses a 
        join tbl_detailorder b on a.date_id = b.date_id
        join (select item_id, item_name, type_name, item_size, color_name, item_weight, item_qty, item_price from tbl_item a 
            join tbl_color b on a.color_id = b.color_id 
            join tbl_item_type c on a.type_id = c.type_id) as c
        on b.item_id = c.item_id ) as a
        where id = '" . $id . "' 
        group by date_id";

    $result = mysqli_query($conn, $sql);
    $results = mysqli_fetch_assoc($result);

    // while ($datas = mysqli_fetch_assoc($result)) {
    //     $results = $datas; //assign whole values to array
    // }

    echo json_encode($results);
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
