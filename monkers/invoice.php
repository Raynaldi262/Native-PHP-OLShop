<?php
require('../model/User.php');
$item = getDetailProses($_GET['id']);
$datauser = getDataUser($_GET['idu']);
$data_onkir = getDataOngkir($datauser['cust_city']);
$data_order = getDataOrder($_GET['id']);
$dataproses = getProsesDataDetail($_GET['id']);

if (isset($_SESSION['cust_id'])) {
	$data_cart = getcartCount($_GET['idu']);
	$data_check = getcheckCount($_GET['idu']);
	$proses_count = getProsesCount($_GET['idu']);
} else {
	$data_cart['juml'] = 0;
	$data_check['juml'] = 0;
	$proses_count['juml'] = 0;
}
$totalharga = 0;
$totalberat = 0;

?>
<style>
table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  border: 1px solid #ddd;
  padding: 20px;
}

 th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: gray;
  color: white;
}

.harga th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: Orange;
  color: white;
}
img {
  position: absolute;
  left: 0px;
  top: 0px;
  z-index: -1;
}
</style>
<div style="text-align:center">
<img width="100" src="images/home/logo.png"/>
<h1>Invoice <?php echo $data_order['order_invoice'] ?></h1>
<h2>Resi : <?php echo $data_order['order_resi'] ?></h2>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
        <th>Nama Product</th>
		<th>Tipe Barang</th>
		<th>Jumlah</th>
		<th>Berat Barang</th>
		<th>Harga Barang</th>
        </tr>
    </thead>
    <tbody>
    <?php
		$item1 = getDetailProses($_GET['id']);
		while ($data_check1 = mysqli_fetch_assoc($item1)) {
			$item_cart1 = getItemcart($data_check1['item_id']);
			$data_type1 = getTypeitem($item_cart1['type_id']);
            $totalberat += $item_cart1['item_weight'] * $data_check1['qty'];
		?>
			<tr>
				<td><?php echo $item_cart1['item_name'] ?></td>
				<td><?php echo $data_type1['type_name'] ?></td>
				<td><?php echo $data_check1['qty'] ?></td>
				<td><?php echo $item_cart1['item_weight'] ?> Grm</td>
				<td>Rp. <?php echo number_format($item_cart1['item_price']) ?></td>
			</tr>
		<?php } ?>
    </tbody>
</table>
<table id="example1" class="table table-bordered table-striped">

    <!-- <thead>
        <tr>
        <th>Harga</th>
        </tr>
    </thead> -->
    <tbody>
			<tr>
				<td style="background-color: gray; text-align: left;">Kurir</td>
				<td><?php echo $data_order['order_shipping'] ?></td>
			</tr>
            <tr>
				<td style="background-color: gray; text-align: left;">Harga Ongkir</td>
				<td>Rp. <?php echo number_format($data_order['order_shipping_price']) ?></td>
			</tr>
            <tr>
				<td style="background-color: gray; text-align: left;">Total Berat</td>
				<td><?php echo $totalberat ?> Gram</td>
			</tr>
            <tr>
				<td style="background-color: gray; text-align: left;">Subtotal</td>
				<td>Rp. <?php echo number_format($data_order['order_totprice']+$data_order['order_shipping_price']) ?></td>
			</tr>
    </tbody>
</table>
<br>
</div>
<?php
$html = ob_get_contents();
ob_end_clean();

require __DIR__ . '../../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML($html);
$html2pdf->output('Invoice_Pemesanan.pdf', 'D');

?>