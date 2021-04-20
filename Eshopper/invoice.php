<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Rendering engine</th>
            <th>Browser</th>
            <th>Platform(s)</th>
            <th>Engine version</th>
            <th>CSS grade</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>Tasman</td>
            <td>Internet Explorer 5.1</td>
            <td>Mac OS 7.6-9</td>
            <td>1</td>
            <td>C</td>
        </tr>
        <tr>
            <td>Tasman</td>
            <td>Internet Explorer 5.2</td>
            <td>Mac OS 8-X</td>
            <td>1</td>
            <td>C</td>
        </tr>
        <tr>
            <td>Misc</td>
            <td>NetFront 3.1</td>
            <td>Embedded devices</td>
            <td>-</td>
            <td>C</td>
        </tr>
        <tr>
            <td>Misc</td>
            <td>NetFront 3.4</td>
            <td>Embedded devices</td>
            <td>-</td>
            <td>A</td>
        </tr>
        <tr>
            <td>Misc</td>
            <td>Dillo 0.8</td>
            <td>Embedded devices</td>
            <td>-</td>
            <td>X</td>
        </tr>
        <tr>
            <td>Misc</td>
            <td>Links</td>
            <td>Text only</td>
            <td>-</td>
            <td>X</td>
        </tr>
        <tr>
            <td>Misc</td>
            <td>Lynx</td>
            <td>Text only</td>
            <td>-</td>
            <td>X</td>
        </tr>
        <tr>
            <td>Misc</td>
            <td>IE Mobile</td>
            <td>Windows Mobile 6</td>
            <td>-</td>
            <td>C</td>
        </tr>
        <tr>
            <td>Misc</td>
            <td>PSP browser</td>
            <td>PSP</td>
            <td>-</td>
            <td>C</td>
        </tr>
        <tr>
            <td>Other browsers</td>
            <td>All others</td>
            <td>-</td>
            <td>-</td>
            <td>U</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Rendering engine</th>
            <th>Browser</th>
            <th>Platform(s)</th>
            <th>Engine version</th>
            <th>CSS grade</th>
        </tr>
    </tfoot>
</table>
<?php
$html = ob_get_contents();
ob_end_clean();

require __DIR__ . '../../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML($html);
$html2pdf->output('Invoice_Pemesanan.pdf', 'D');

?>