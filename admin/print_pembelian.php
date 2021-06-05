<?php
require('../model/dataCust.php');
$id = getDataOrder($conn, $_GET['id']);
$dataCust = getCust($conn, $_GET['id']);

$sql = "select * from tbl_admin where admin_id = " . $_GET['adminid'] . "";
$name = mysqli_query($conn, $sql);
$name = mysqli_fetch_assoc($name);

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
    <h2>Data Pembelian Pelanggan</h2>
    <p><?php echo $dataCust['cust_name'] . ', ' . $dataCust['cust_address'] . ', ' . $dataCust['cust_city'] . ', ' . $dataCust['cust_province'] . ', ' . $dataCust['cust_phone'] ?></p>
    <table id="example1" class="table table-bordered table-striped" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>invoice</th>
                <th>Detail Barang</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($id as $data) { ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data['order_invoice'] ?></td>
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
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>
    <br>
    <?php
    echo '*Dicetak oleh ' .  $name['admin_name'];
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
$html2pdf->output('Data_Pembelian_Pelanggan.pdf', 'D');

?>