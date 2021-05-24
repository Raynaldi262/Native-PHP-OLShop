<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "select * from tbl_proses a
        join tbl_customer b on a.cust_id = b.cust_id
        where status != 'Pesanan dibatalkan' and status != 'Pesanan dikirim'
        order by a.create_date desc";
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

if (isset($_POST['getAlamat1'])) {
    getAlamat1($conn);
}

if (isset($_POST['getAlamat2'])) {
    getAlamat2($conn);
}

if (isset($_POST['kirim_pesanan'])) {
    updatePesanan($conn);
}

function getPesanan($conn)
{
    $id = $_POST['pesananID'];

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

    echo json_encode($results);
}


function getAlamat1($conn)
{
    $id = $_POST['alamatID'];

    $sql = "select * from tbl_customer where cust_id = " . $id . "";

    $result = mysqli_query($conn, $sql);
    $results = mysqli_fetch_assoc($result);

    echo json_encode($results);
}

function getAlamat2($conn)
{
    $id = $_POST['alamatID'];

    $sql = "select * from tbl_address where address_id = " . $id . "";

    $result = mysqli_query($conn, $sql);
    $results = mysqli_fetch_assoc($result);

    echo json_encode($results);
}

function terimaPesanan($conn)
{
    $id = $_POST['date_id'];
    $cust_id = $_POST['cust_id'];
    $price = $_POST['price'];

    $c = checkStok($conn, $id);

    if ($c == 0) {  // kalau tidak ada stok yg kurang 
        $custData = getCustdata($conn, $cust_id);   //cari data order dan price dri user
        $custOrder = $custData['cust_total_order'] + 1;
        $custPrice = $custData['cust_total_price'] + $price;

        $itemData = getitemData($conn, $id);

        // update tbl proses
        $sql = "update tbl_proses
            set status = 'Proses Pengemasan'
            where date_id = '" . $id . "'";
        $result = mysqli_query($conn, $sql);

        //update tbl customer
        $sql1 = "update tbl_customer
        set cust_total_order = " . $custOrder . " , cust_total_price = " . $custPrice . "
        where cust_id = '" . $cust_id . "'";

        $result1 = mysqli_query($conn, $sql1);

        foreach ($itemData as $data) {
            $stok = $data['detail_qty'] - $data['qty'];
            $item_price = $data['qty'] * $data['item_price'];
            // update stok item
            $sql2 = "update tbl_item_detail   
            set detail_qty = " . $stok . "
            where detail_id = '" . $data['detail_id'] . "'";

            $result2 = mysqli_query($conn, $sql2);

            //update history stok
            $sql3 = "insert into tbl_stockinout(detail_id, stok_qty, stok_desc, stok_price, total_qty)
                    values(" . $data['detail_id'] . ", " . $data['qty'] . ", 'STOCK OUT'
                    ," . $item_price . ", " . $stok . " )";

            $result3 = mysqli_query($conn, $sql3);
        }

        $inv = generateInvoice($conn);  // nmr invoice
        $dataOrder = getOrder($conn, $id);

        //insert tbl order
        $sql4 = "insert into tbl_order (order_invoice, order_total, order_shipping, order_shipping_price, order_totprice,
                order_transfer, order_status, cust_id, date_id, address_id) 
                values('" . $inv . "', " . $dataOrder['order_total'] . ", '" . $dataOrder['kurir'] . "', " . $dataOrder['ongkir'] . "
                ," . $dataOrder['price'] . ", '" . $dataOrder['img_bayar'] . "', '" . $dataOrder['status'] . "', " . $dataOrder['cust_id'] . ", '" . $id . "'
                ," . $dataOrder['address_id'] . ")";

        $result4 = mysqli_query($conn, $sql4);

        if ($result == 1 && $result1 == 1 && $result2 == 1 && $result3 == 1 && $result4 == 1) {
            msg('Pesanan berhasil dikonfirmasi!!', '../admin/pesanan.php');
        } else {
            msg('Ada kesalahan pada update !!', '../admin/pesanan.php');
        }
    } else {
        msg('Tidak bisa diterima stok tidak mencukupi!!', '../admin/pesanan.php');
    }
}


function deletePesanan($conn)
{
    $id = $_POST['date_id'];

    $sql = "update tbl_proses
            set status = 'Pesanan dibatalkan'
            where date_id = '" . $id . "'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        msg('Pesanan berhasil dibatalkan!!', '../admin/pesanan.php');
    }
}

function getCustdata($conn, $cust_id)
{
    $sql = "select cust_total_order, cust_total_price from tbl_customer
            where cust_id = " . $cust_id . "";

    $result = mysqli_query($conn, $sql);
    $results = mysqli_fetch_assoc($result);

    return $results;
}

function getitemData($conn, $id)
{
    $sql = "select a.item_id, qty, b.detail_id, detail_qty, item_price, item_name, price from tbl_detailorder a
            join (select a.item_id, item_name, detail_id, size_name, size_id, detail_qty, item_price
                from tbl_item a join (
                select item_id, detail_id, a.size_id, size_name, detail_qty
                from tbl_item_detail a join tbl_size b
                on a.size_id = b.size_id
                where status = 'ACTIVE') b on a.item_id = b.item_id) b 
            on a.item_id = b.item_id  and a.size = b.size_name
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


function checkStok($conn, $id)
{
    $sql = "select item_id, size, qty from tbl_detailorder where date_id = " . $id . "";
    $result = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($result)) {  //dpt data sql
        $results[] = $data; //assign whole values to array 
    }

    foreach ($results as $data) {
        $sql = "select 1 from 
                (select item_id, detail_id, size_name, detail_qty
                from tbl_item_detail a join tbl_size b
                on a.size_id = b.size_id
                where status = 'ACTIVE') a 
                where item_id = " . $data['item_id'] . " and size_name = '" . $data['size'] . "'
                and detail_qty < " . $data['qty'] . "";

        $result = mysqli_query($conn, $sql);
        $result = mysqli_num_rows($result);

        if ($result) {
            return 1;
        }
    }
    return 0;
}

function getOrder($conn, $id)
{
    $sql = "select sum(qty) as order_total, kurir, ongkir, price, img_bayar, status, cust_id, id, address_id
            from 
            (Select proses_id, a.date_id id, a.cust_id as cust_id, price, kurir, a.status as status, img_bayar,
               ongkir, qty , address_id
            from tbl_proses a 
            join tbl_detailorder b on a.date_id = b.date_id) a
            where id = '" . $id . "' group by id";

    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);

    return $result;
}

function updatePesanan($conn)
{
    $id = $_POST['id_pesanan'];
    $resi = $_POST['resi'];

    $sql = "update tbl_order 
            set order_resi = '" . $resi . "', order_status = 'Pesanan dikirim'
            where date_id = '" . $id . "'";

    $result = mysqli_query($conn, $sql);

    $sql = "update tbl_proses 
    set status = 'Pesanan dikirim'
    where date_id = '" . $id . "'";

    $result = mysqli_query($conn, $sql);


    if ($result) {
        msg('Pesanan berhasil dikirim!!', '../admin/pesanan.php');
    } else {
        msg('Pesanan gagal dikirim!!', '../admin/pesanan.php');
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
