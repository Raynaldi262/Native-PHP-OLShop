<?php
require('../model/User.php');
$data_order = getDataOrder($_GET['id']);

if ($_GET['ida'] != 0) {
  $datauser = getDataAlamat2($_GET['ida']);
} else {
  $datauser = getDataUser($_GET['idu']);
}

if ($_GET['custid'] == null) {
  $sql = "select * from tbl_admin where admin_id = " . $_GET['adminid'] . "";

  $name = mysqli_query($conn, $sql);
  $name = mysqli_fetch_assoc($name);
} else {
  $sql = "select * from tbl_customer where cust_id = " . $_GET['custid'] . "";

  $name = mysqli_query($conn, $sql);
  $name = mysqli_fetch_assoc($name);
}
/////////////////////////////////////////////////////////////////

// if (isset($_SESSION['cust_id'])) {
// 	$data_cart = getcartCount($_GET['idu']);
// 	$data_check = getcheckCount($_GET['idu']);
// 	$proses_count = getProsesCount($_GET['idu']);
// } else {
// 	$data_cart['juml'] = 0;
// 	$data_check['juml'] = 0;
// 	$proses_count['juml'] = 0;
// }
$totalharga = 0;
$totalberat = 0;

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
    display: block;
    margin: 0 auto;
  }


  * {
    box-sizing: border-box;
  }

  /* Create two equal columns that floats next to each other */
  .column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 300px;
    /* Should be removed. Only for demonstration */
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
</style>
<div style="text-align:center">
  <img width="100" src="images/home/logo.png" />
  <h1><?php echo $data_order['order_invoice'] ?></h1>
  <h2>Resi : <?php echo $data_order['order_resi'] ?></h2>
  <p><?php echo $datauser['cust_name'] . ', ' . $datauser['cust_address'] . ', ' . $datauser['cust_city'] . ', ' . $datauser['cust_province'] . ', ' . $datauser['cust_phone'] ?></p>
  <table id="example1" class="table table-bordered table-striped" align="center">
    <thead>
      <tr>
        <th>Nama Product</th>
        <th>Tipe Barang</th>
        <th>Ukuran</th>
        <th>Warna</th>
        <th>Jumlah</th>
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
          <td><?php echo $data_check1['size'] ?></td>
          <td><?php echo $data_check1['color_name'] ?></td>
          <td><?php echo $data_check1['qty'] ?></td>
          <td>Rp. <?php echo number_format($item_cart1['item_price']) ?></td>
        </tr>
      <?php } ?>
      <tr>
        <td style="background-color: gray; text-align: left;">Kurir</td>
        <td><?php echo $data_order['order_shipping'] ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Rp. <?php echo number_format($data_order['order_shipping_price']) ?></td>
      </tr>
      <tr>
        <td style="background-color: gray; text-align: left;">Subtotal</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Rp. <?php echo number_format($data_order['order_totprice'] + $data_order['order_shipping_price']) ?></td>
      </tr>
    </tbody>
  </table>
  <?php
  if ($_GET['custid'] == null) {
    echo '*Dicektak oleh ' . $name['admin_name'];
  } else {
    echo '*Dicektak oleh ' . $name['cust_name'];
  }

  ?>
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