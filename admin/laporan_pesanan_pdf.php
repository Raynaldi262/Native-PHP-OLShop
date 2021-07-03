<?php
require('../connect/conn.php');

$sql = "SELECT admin_name from tbl_admin where admin_id = " . $_GET['user'] . "";
$user = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($user);

if ($_GET['start'] == null) {
    $sql = "SELECT min(create_date) as a, max(create_date) as b FROM tbl_order";
    $getdate = mysqli_query($conn, $sql);
    $date = mysqli_fetch_assoc($getdate);

    $getStart = date("d-m-Y", strtotime($date['a']));
    $getEnd = date("d-m-Y", strtotime($date['b']));
} else {
    $getStart = date("d-m-Y", strtotime($_GET['start']));
    $getEnd = date("d-m-Y", strtotime($_GET['end']));
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

function getAlamat2($conn, $id)
{
    $sql = "select * from tbl_address where address_id = " . $id . "";

    $result = mysqli_query($conn, $sql);
    $results = mysqli_fetch_assoc($result);

    return $results;
}

ob_start();
?>
<style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    td {
        word-wrap: break-word;
        font-size: 12px;
    }

    th {
        text-align: center;
        background-color: gray;
        padding: 4px;
        color: white;
        font-size: 12px;
    }
</style>
<div style="text-align:center">
    <img width="100" src="../dist/img/logo.png" />
    <h3>LAPORAN Pesanan</h3>
    <p><?php echo 'Periode ' . $getStart . ' s/d ' . $getEnd ?></p>
    <P>Dicetak Oleh (<?php echo $user['admin_name'] ?>)</P>
    <table id="example1" class="table table-bordered table-striped" align="center" style=" border-bottom-style: none; border-right-style: none; border-left-style: none;">

        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 15%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 40%;">
            <col span="1" style="width: 10%;">
        </colgroup>
        <thead>
            <tr align="center">
                <th>No</th>
                <th>invoice</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Pesanan</th>
                <th>Total harga</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php $i = 1;
            if ($_GET['start'] != null) {
                $start = $_GET['start'];
                $end = $_GET['end'];

                // ini buat isi tabel pesanan
                $sql = "select order_id, substring(order_invoice,1,10) as inv, substring(order_invoice,11,20) as oice, order_resi, b.cust_id, cust_name, cust_address, a.create_date as create_date, address_id,
                order_totprice, order_shipping, order_shipping_price, order_transfer, order_status, date_id, cust_province, cust_city
                from tbl_order a
                join (select cust_id, cust_name, cust_address, cust_phone, cust_province, cust_city from tbl_customer) as b
                on a.cust_id = b.cust_id
                where create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59'";

                $getOrder = mysqli_query($conn, $sql);

                // ini buat itung omset
                $sql2 = "Select sum(order_totprice) total from tbl_order
                         where create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59'";
                $getTotal = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_assoc($getTotal);

                // ini buat itung pesanan
                $sql3 = "Select count(order_id) total from tbl_order     
                         where create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59'";

                $getTotalpes = mysqli_query($conn, $sql3);
                $total_pes = mysqli_fetch_assoc($getTotalpes);
            } else {
                // ini buat isi tabel pesanan
                $sql = "select order_id, substring(order_invoice,1,10) as inv, substring(order_invoice,11,20) as oice , order_resi, b.cust_id, cust_name, cust_address, a.create_date as create_date, address_id,
                order_totprice, order_shipping, order_shipping_price, order_transfer, order_status, date_id, cust_province, cust_city
                from tbl_order a
                join (select cust_id, cust_name, cust_address, cust_phone, cust_province, cust_city from tbl_customer) as b
                on a.cust_id = b.cust_id";

                $getOrder = mysqli_query($conn, $sql);

                // ini buat itung omset
                $sql2 = "Select sum(order_totprice) total from tbl_order";
                $getTotal = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_assoc($getTotal);


                // ini buat itung pesanan
                $sql3 = "Select count(order_id) total from tbl_order";
                $getTotalpes = mysqli_query($conn, $sql3);
                $total_pes = mysqli_fetch_assoc($getTotalpes);
            }
            while ($data = mysqli_fetch_array($getOrder)) { ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['inv'] . ' ';
                        echo $data['oice']; ?></td>
                    <td><?php echo $data['cust_name']; ?></td>
                    <?php if ($data['address_id'] == 0) { ?>
                        <td><?php echo $data['cust_address'] . ', ' . $data['cust_city'] . ', ' . $data['cust_province'] ?></td>
                    <?php } else {
                        $alamat2 = getAlamat2($conn, $data['address_id']); ?>
                        <td><?php echo $alamat2['cust_address'] . ', ' . $alamat2['cust_city'] . ', ' . $alamat2['cust_province'] ?></td>
                    <?php } ?>
                    <td>

                        <?php
                        $result = getItem($conn, $data['date_id']);

                        foreach ($result as $datas) {
                            echo $datas['item_name'] . ', ' . $datas['type_name'] . ' (' . $datas['size_name'] . ', ' . $datas['color_name']
                                . ', ' . $datas['item_weight'] . 'gram/pcs ) ' . $datas['qty'] . ' x Rp ' . number_format($datas['item_price']);
                        ?>
                            <br><br>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?php echo 'Rp ' . number_format($data['order_totprice']); ?></td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>

        <tfoot>
            <tr align="center">
                <th></th>
                <th>Total Pesanan:</th>
                <th></th>
                <th></th>
                <th></th>
                <th align="center"><?php echo $total_pes['total']; ?></th>
            </tr>
            <tr align="center">
                <th></th>
                <th>Total Keuntungan:</th>
                <th></th>
                <th></th>
                <th></th>
                <th align="center"><?php echo 'Rp ' . number_format($total['total']); ?></th>
            </tr>
        </tfoot>
    </table>
    <br>
</div>
<?php
// $html = ob_get_clean();


// require __DIR__ . '../../vendor/autoload.php';

// use Spipu\Html2Pdf\Html2Pdf;

// $html2pdf = new Html2Pdf('P', 'A4', 'en');
// $html2pdf->writeHTML($html);
// $html2pdf->output('laporan_pesanan.pdf', 'D');
?>