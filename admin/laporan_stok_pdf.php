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

ob_start();
?>
<style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 70%;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    td {
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
    <h3>LAPORAN STOK</h3>
    <p><?php echo 'Periode ' . $getStart . ' s/d ' . $getEnd ?></p>
    <P>Dicetak Oleh (<?php echo $user['admin_name'] ?>)</P>
    <table id="example1" class="table table-bordered table-striped" align="center" style=" border-bottom-style: none; border-right-style: none; border-left-style: none;">
        <thead>
            <tr align="center">
                <th>No</th>
                <th>Nama</th>
                <th>Warna</th>
                <th>Ukuran</th>
                <th>Stok Awal</th>
                <th>Stok Akhir</th>
                <th>Keuntungan</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php $i = 1;
            if ($_GET['start'] != null) {
                $start = $_GET['start'];
                $end = $_GET['end'];

                // ini buat isi tabel stok
                $sql = "select a.item_name, color_name, size_name, (ifnull(detail_qty,0)+ifnull(stock_out,0)-ifnull(stock_in,0)) as stok  ,ifnull(stock_in,0) as stock_in, ifnull(stock_out,0) as stock_out, ifnull(detail_qty,0) as total_qty, ifnull(stok_price,0) as stok_price
                FROM (  
                select a.item_name, color_name, size_name, detail_qty, c.status, detail_id
                from tbl_item a 
                join tbl_color b on a.color_id = b.color_id
                join (select size_name, detail_qty, status, item_id, detail_id
                from tbl_item_detail a join tbl_size b on a.size_id = b.size_id) c
                on a.item_id = c.item_id
                where c.status = 'ACTIVE') a
                left join (select detail_id, sum(stok_qty) as stock_in, stok_desc 
                from tbl_stockinout where stok_desc = 'STOCK IN' and create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59' 
                GROUP by detail_id) b
                on b.detail_id = a.detail_id
                left join (select detail_id, sum(stok_qty) as stock_out, sum(stok_price) as stok_price, stok_desc 
                from tbl_stockinout where stok_desc = 'STOCK OUT' and create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59'
                GROUP by detail_id) c
                on c.detail_id = a.detail_id
                left join (select detail_id, total_qty from (select detail_id, total_qty, row_number() over (partition by detail_id order by create_date desc) as no_urut from tbl_stockinout
                where create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59') as abc where no_urut = 1) d
                on d.detail_id = a.detail_id
                where stock_in is not null or stock_out is not null";

                $getStok = mysqli_query($conn, $sql);

                // ini buat itung omset
                $sql2 = "Select sum(stok_price) total from tbl_stockinout
                         where create_date >= '" . $start . " 00:00:00' and create_date <= '" . $end . " 23:59:59'";
                $getTotal = mysqli_query($conn, $sql2);

                $total = mysqli_fetch_assoc($getTotal);
            } else {
                // ini buat isi tabel stok
                $sql = "select a.item_name, color_name, size_name, (ifnull(detail_qty,0)+ifnull(stock_out,0)-ifnull(stock_in,0)) as stok  ,ifnull(stock_in,0) as stock_in, ifnull(stock_out,0) as stock_out, ifnull(detail_qty,0) as total_qty, ifnull(stok_price,0) as stok_price
                FROM (
                select a.item_name, color_name, size_name, detail_qty, c.status, detail_id
                from tbl_item a 
                join tbl_color b on a.color_id = b.color_id
                join (select size_name, detail_qty, status, item_id, detail_id
                from tbl_item_detail a join tbl_size b on a.size_id = b.size_id) c
                on a.item_id = c.item_id
                where c.status = 'ACTIVE') a
                left join (select detail_id, sum(stok_qty) as stock_in, stok_desc 
                from tbl_stockinout where stok_desc = 'STOCK IN' GROUP by detail_id) b
                on b.detail_id = a.detail_id
                left join (select detail_id, sum(stok_qty) as stock_out, sum(stok_price) as stok_price, stok_desc 
                from tbl_stockinout where stok_desc = 'STOCK OUT' GROUP by detail_id) c
                on c.detail_id = a.detail_id
                left join (select detail_id, total_qty from (select detail_id, total_qty, row_number() over (partition by detail_id order by create_date desc) as no_urut from tbl_stockinout) as abc where no_urut = 1) d
                on d.detail_id = a.detail_id";

                $getStok = mysqli_query($conn, $sql);

                // ini buat itung omset
                $sql2 = "Select sum(stok_price) total from tbl_stockinout";
                $getTotal = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_assoc($getTotal);
            }
            while ($data = mysqli_fetch_array($getStok)) { ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['item_name']; ?></td>
                    <td><?php echo $data['color_name']; ?></td>
                    <td><?php echo $data['size_name']; ?></td>
                    <td><?php echo $data['stok']; ?></td>
                    <td><?php echo $data['total_qty']; ?></td>
                    <td><?php echo 'Rp ' . number_format($data['stok_price']); ?></td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>

        <tfoot>
            <tr align="center">
                <th></th>
                <th>Total :</th>
                <th></th>
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
$html = ob_get_clean();


require __DIR__ . '../../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML($html);
$html2pdf->output('laporan_stok.pdf', 'D');
?>