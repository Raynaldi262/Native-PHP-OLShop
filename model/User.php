<?php
require('../connect/conn.php');
require('../session/session.php');

if (isset($_POST['bayar'])) {
   ProsesBayar($conn);
}
if (isset($_POST['tipe_item'])) {
    FilterItem($conn);
   
}
if (isset($_POST['batalcheck'])) {
   BatalCheck($conn);
}

if (isset($_POST['ongkir'])) {
   HargaOngkir($conn);
}
if (isset($_POST['alamat'])) {
   DataAlamat($conn);
}

if (isset($_POST['UbahPassword'])) {
   UbahPassword($conn);
}

if (isset($_POST['updateprofile'])) {
   UpdateProfile($conn);
}
if (isset($_POST['singup'])) {
   insertUser($conn);
}

if (isset($_POST['addchart'])) {
   AddChart($conn);
}

if (isset($_POST['deletecart'])) {
   deleteCart($conn);
}
if (isset($_POST['checkout'])) {
   AddCheckout($conn);
}
if (isset($_POST['tambahalamat'])) {
   AddAddress($conn);
}

function getDataArea($conn)
{
   $sql = "SELECT * from tbl_area";
   $item = mysqli_query($conn, $sql);
   return $item;
}

function getDataKurir($kotauser){
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_area Where area_name = '".$kotauser."'";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   $sql = "SELECT * from tbl_ongkir Where area_id = '".$data['area_id']."' ";
   $item = mysqli_query($conn, $sql);
   return $item;


}
function KiloBarang($berat, $harga)
{

   $berat = ceil($berat);
   if (substr($berat, -3) > 499) {
      $total_gram = round($berat, -3);
   } else {
      $total_gram = round($berat, -3) + 1000;
   }
   return ($total_gram / 1000) * $harga;
}
function getDataOngkir($ongkir_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_ongkir WHERE ongkir_id = '" . $ongkir_id . "'";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getDataUser($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_customer where cust_id = '" . $cust_id . "' ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;

}

function getDataAlamat2($alamat_id){
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_address where address_id = '" . $alamat_id . "' ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getDataProses($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_proses where cust_id = " . $cust_id . " ";
   $item = mysqli_query($conn, $sql);
   return $item;
}
function getDataAlamat($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_address where cust_id = " . $cust_id . " ";
   $item = mysqli_query($conn, $sql);
   return $item;
}
function getProsesDataDetail($date_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_proses where cust_id = " .  $_SESSION['cust_id'] . " AND date_id = ".$date_id." ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getProsesCount($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT count(proses_id) as juml from tbl_proses where cust_id = " . $cust_id . " AND status != 'Selesai' ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getcartCount($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT count(cart_id) as juml from tbl_cart where cust_id = " . $cust_id . " ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getcheckCount($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT count(check_id) as juml from tbl_checkout where cust_id = " . $cust_id . " ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getUkuranItem($id)
{
   require('../connect/conn.php');
   $sql = "SELECT tbl_size.size_name as size_name, tbl_item.item_id as item_id FROM tbl_item_detail INNER JOIN tbl_size on tbl_item_detail.size_id = tbl_size.size_id INNER JOIN tbl_item ON tbl_item_detail.item_id = tbl_item.item_id WHERE tbl_item_detail.status = 'ACTIVE' && tbl_item.item_id = '".$id."'";
   $item = mysqli_query($conn, $sql);
   return $item;
}
function getDetailitem($id_item)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_item where item_id = " . $id_item . " ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getTypeitem($id_type)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_item_type where type_id = " . $id_type . " ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getColoritem($id_color)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_color where color_id = " . $id_color . " ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getDataBanner($conn)
{
   $sql = "SELECT * from tbl_banner ";
   $item = mysqli_query($conn, $sql);
   return $item;
}
function getDataAlltype($conn)
{
   $sql = "SELECT * from tbl_item_type ";
   $item = mysqli_query($conn, $sql);
   return $item;
}
function getItemcart($id_item)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_item where item_id = " . $id_item . " ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}
function getImgItem($id_item)
{
   require('../connect/conn.php');
   $sql = "SELECT tbl_img.img_name as img_name, tbl_item.item_id as item_id,tbl_item.create_date as create_date FROM tbl_item INNER JOIN tbl_img on tbl_item.item_id = tbl_img.item_id where tbl_item.item_id = '".$id_item."' && tbl_item.item_status = 'ACTIVE' ORDER BY create_date LIMIT 1";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}

function getImgItem2($id_item)
{
   require('../connect/conn.php');
   $sql = "SELECT * FROM `tbl_img` WHERE item_id = '".$id_item."' ";
   $item = mysqli_query($conn, $sql);
   return $item;
}

function getDataCart($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_cart where cust_id = " . $cust_id . " ";
   $item = mysqli_query($conn, $sql);
   return $item;
}
function getDataCheck($cust_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_checkout where cust_id = " . $cust_id . " ";
   $item = mysqli_query($conn, $sql);
   return $item;
}
function getDataOrder($date_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_order where cust_id = " .  $_SESSION['cust_id']. " AND item_id = ".$date_id." ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   return $data;
}

function getDetailProses($date_id)
{
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_detailorder where cust_id = " . $_SESSION['cust_id'] . " AND date_id = " . $date_id . " ";
   $item = mysqli_query($conn, $sql);
   return $item;
}

function FilterItem($conn){
   if($_POST['tipe_item'] == 'Allitem'){
   header("location: ../monkers/index.php");
   }else{
   $sql = "SELECT type_id from tbl_item_type Where type_name = '".$_POST['tipe_item']."'"  ;
   $item_data = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item_data);
   header("location: ../monkers/index.php?id=". $data['type_id']);
   }
}
function HargaOngkir($conn){
   if(isset($_POST['ida'])){
   $url = '../monkers/checkout.php?id='.$_POST['ongkir'].'&ida='.$_POST['ida'];
   }else{
   $url = '../monkers/checkout.php?id='.$_POST['ongkir'];
   }
    header("location:". $url);
  // msg('Alamat berhasil diubah!!', $url);
}

function DataAlamat($conn){
   if(isset($_POST['id'])){
      $url = '../monkers/checkout.php?id='.$_POST['id'].'&ida='.$_POST['alamat'];
   }else{
     $url = '../monkers/checkout.php?ida='.$_POST['alamat']; 
   }
   msg('Alamat berhasil diubah!!', $url);
}


function AddCheckout($conn)
{  
   
   $sql = "SELECT * from tbl_checkout where cust_id = " . $_SESSION['cust_id'] . " ";
   $check = mysqli_query($conn, $sql);
   $check2 = mysqli_query($conn, $sql);
   $result = mysqli_fetch_assoc($check2);

   $sql = "SELECT * from tbl_cart where cust_id = " . $_SESSION['cust_id'] . " ";
   $item = mysqli_query($conn, $sql);
   if($result){
      echo "->masuk checkout ada isi ->";
      while ($data_cart = mysqli_fetch_assoc($item)) {
         $sql = "SELECT * from tbl_checkout where cust_id = " . $_SESSION['cust_id'] . " ";
         $check = mysqli_query($conn, $sql);
         while ($data_check = mysqli_fetch_assoc($check)) {
            echo "checkout ",$data_check['item_id'];
            echo "chart",$data_cart['item_id'];
            if($data_check['item_id'] == $data_cart['item_id'] && $data_check['size'] == $data_cart['size'] ){
               echo "->masuk id item sama->";
               $qty = $data_check['qty'] + $data_cart['qty'];
               $sql = "UPDATE tbl_checkout SET qty = ".$qty." WHERE cust_id = " . $_SESSION['cust_id'] . " AND item_id = ".$data_check['item_id']."";
               mysqli_query($conn, $sql);
               $sql = "DELETE FROM tbl_cart WHERE tbl_cart . cust_id = " . $_SESSION['cust_id'] . " AND item_id = ".$data_cart['item_id']."";
               mysqli_query($conn, $sql);
               
            }
         }
         
      }

         $sql = "SELECT * from tbl_cart where cust_id = " . $_SESSION['cust_id'] . " ";
         $item = mysqli_query($conn, $sql);
         while ($data = mysqli_fetch_assoc($item)) {
         $sql = "INSERT INTO tbl_checkout ( cust_id, item_id,size ,qty, date) 
         VALUES ( '" . $data['cust_id'] . "','" . $data['item_id'] . "','" . $data['size'] . "', '" . $data['qty'] . "', now())";
         $result = mysqli_query($conn, $sql);
         $sql = "DELETE FROM tbl_cart WHERE tbl_cart . cust_id = " . $_POST['cust_id'] . "";
         mysqli_query($conn, $sql);
         }
      
      header("location: ../monkers/checkout.php");

   }else{
      echo"->masuk else->";
   while ($data = mysqli_fetch_assoc($item)) {
      $sql = "INSERT INTO tbl_checkout ( cust_id, item_id, size, qty, date) 
          VALUES ( '" . $data['cust_id'] . "','" . $data['item_id'] . "','" . $data['size'] . "', '" . $data['qty'] . "', now())";
      $result = mysqli_query($conn, $sql);
      $sql = "DELETE FROM tbl_cart WHERE tbl_cart . cart_id = " .$data['cart_id'] . "";
      mysqli_query($conn, $sql);
      }

   }  
   header("location: ../monkers/checkout.php");
   //return $data;
}

function UbahPassword($conn)
{
   if ($_POST['pass1'] == $_POST['pass2']) {
      $sql = "UPDATE tbl_customer SET cust_pass = password('" . $_POST['pass1'] . "') WHERE cust_id = " . $_SESSION['cust_id'] . " ";
      $result = mysqli_query($conn, $sql);
      msg('Password berhasil diubah!!', '../monkers/profile.php');
   } else {
      msg('Password tidak sama!!', '../monkers/profile.php');
   }
}

function ProsesBayar($conn)
{  
   if($_POST['hargaongkir'] == 0){
      msg('Pilih Ongkir Terlebih Dahulu', '../monkers/checkout.php');
   }else{
   date_default_timezone_set("Asia/Bangkok");
   $date_id = date("his") . date("Ymd");
   $nama = $_FILES['img']['name'];
   $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
   $x = explode('.', $nama);   // dpt nama tanpa ekstensi file
   $ekstensi = strtolower(end($x));    // jdiin hruf kecil ekstensinya
   $ukuran    = $_FILES['img']['size'];   //ukuran brp
   $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa
   if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
      if ($ukuran < 4044070) {        // max 4 mb
         move_uploaded_file($file_tmp, '../monkers/images/bayar/' . $date_id . $nama);
         $sql = "INSERT INTO tbl_proses (date_id,cust_id, price, ongkir, kurir, status, create_date,img_bayar) VALUES ('" . $date_id . "'," . $_SESSION['cust_id'] . " , '" . $_POST['totalharga'] . "','" . $_POST['hargaongkir'] . "', '" . $_POST['kurir'] . "', 'Menunggu Konfrimasi', now(),'" . $date_id . $nama . "') ";
         $result = mysqli_query($conn, $sql);
         $sql = "SELECT * from tbl_checkout where cust_id = " . $_SESSION['cust_id'] . " ";
         $item = mysqli_query($conn, $sql);
         while ($data = mysqli_fetch_assoc($item)) {
            $sql = "INSERT INTO tbl_detailorder ( date_id, item_id,cust_id,qty, create_date) 
                 VALUES ( '" . $date_id . "','" . $data['item_id'] . "','" . $data['cust_id'] . "', '" . $data['qty'] . "', now())";
            $result = mysqli_query($conn, $sql);
            $sql = "DELETE FROM tbl_checkout WHERE tbl_checkout . cust_id = " . $_SESSION['cust_id'] . "";
            mysqli_query($conn, $sql);
         }
         if ($result) {
            header("location: ../monkers/profile.php");
         } else {
            msg('Gagal Upload data!!', '../monkers/checkout.php');
         }
      } else {
         msg('Ukuran file max 4mb!!', '../monkers/checkout.php');
      }
   } else {
      msg('Ekstensi File yang diupload hanya diperbolehkan png, jpg, Jpeg!!', '../monkers/checkout.php');
   }
   }
}

function deleteCart($conn)
{
   $sql = "DELETE FROM tbl_cart WHERE tbl_cart . cart_id = " . $_POST['cart_id'] . "";
   mysqli_query($conn, $sql);
   header("location: ../monkers/cart.php");
}

function BatalCheck($conn){
   $sql = "DELETE FROM tbl_checkout WHERE tbl_checkout . cust_id = " . $_SESSION['cust_id'] . "";
   mysqli_query($conn, $sql);
   header("location: ../monkers/checkout.php");
}

function UpdateProfile($conn)
{
   $img = $_FILES['img']['name'];
   if ($img) {  // kalau upload gambar
      $nama = $_FILES['img']['name'];
      $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
      $x = explode('.', $nama);   // dpt nama tanpa ekstensi file
      $ekstensi = strtolower(end($x));    // jdiin hruf kecil ekstensinya
      $ukuran    = $_FILES['img']['size'];   //ukuran brp
      $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa
      if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
         if ($ukuran < 4044070) {        // max 4 mb
            move_uploaded_file($file_tmp, '../monkers/images/Profile/' . $nama);

            $sql = "UPDATE tbl_customer SET cust_name = '" . $_POST['nama'] . "'  , cust_birth = '" . $_POST['ultah'] . "' , cust_address = '" . $_POST['address'] . "', cust_province = '" . $_POST['provinsi'] . "' , cust_city = '" . $_POST['kota'] . "' , cust_email = '" . $_POST['email'] . "', cust_phone = '" . $_POST['nohp'] . "', cust_img = '" . $img . "' WHERE cust_id = " . $_SESSION['cust_id'] . " ";
            $result = mysqli_query($conn, $sql);

            if ($result) {
               msg('Data berhasil diubah!!', '../monkers/profile.php');
            } else {
               msg('Gagal Mengubah data!!', '../monkers/profile.php');
            }
         } else {
            msg('Ukuran file max 4mb!!', '../monkers/profile.php');
         }
      } else {
         msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../monkers/profile.php');
      }
   } else {
      $sql = "UPDATE tbl_customer SET cust_name = '" . $_POST['nama'] . "'  , cust_birth = '" . $_POST['ultah'] . "' , cust_address = '" . $_POST['address'] . "', cust_province = '" . $_POST['provinsi'] . "' , cust_city = '" . $_POST['kota'] . "' , cust_email = '" . $_POST['email'] . "', cust_phone = '" . $_POST['nohp'] . "' WHERE cust_id = " . $_SESSION['cust_id'] . " ";
      $result = mysqli_query($conn, $sql);

      if ($result) {
         msg('Data berhasil diubah!!', '../monkers/profile.php');
      } else {
         msg('Gagal Mengubah data!!', '../monkers/profile.php');
      }
   }
}


function addChart($conn)
{

   if (!isset($_SESSION['cust_id'])) {
      msg('Silakan Login dahulu', '/../SkripsiRuby/monkers/login.php');
   } else {
         $qty = $_POST['qty'];
         CheckStock($_POST['item_id'], $_POST['qty'], $_POST['ukuran']); // untuk check stock habis/tidak
   }
}

function CheckStock($item_id, $qty,$ukuran)
{
   require('../connect/conn.php');
   $sql = "SELECT item_qty from tbl_item where item_id = " . $item_id . " ";
   $item = mysqli_query($conn, $sql);
   $data = mysqli_fetch_assoc($item);
   // if ($data['item_qty'] < $qty) {
   //    //echo '<script>alert("Stock barang kurang")</script>';
   //    //header("location: ../../product_details.php/?id= $item_id"); 
   //    msg('Stock Barang Kurang', '../../index.php');
   // } else {
      $sqlc = "SELECT * from tbl_cart where item_id = " . $item_id . " AND cust_id = " . $_SESSION['cust_id'] . " AND size = '".$ukuran."'"; //check di cart ada item sama / tidak
      $check = mysqli_query($conn, $sqlc);
      $data_check = mysqli_fetch_assoc($check);
      if ($data_check) {
         $jml = $data_check['qty'] + $qty;
         $sql = "UPDATE tbl_cart SET qty = " . $jml . " WHERE item_id = " . $item_id . " AND cust_id = " . $_SESSION['cust_id'] . " ";
         $result = mysqli_query($conn, $sql);
      } else {
         $sql = "INSERT INTO tbl_cart ( item_id,cust_id,size, qty, create_date) 
                VALUES ( '" . $item_id . "','" . $_SESSION['cust_id'] . "','" . $ukuran . "', '" . $qty . "', now())";
         $result = mysqli_query($conn, $sql);
      }
      if ($result) {
         header("location: ../../cart.php");
      } else {
         msg('Item Gagal Ditambah', '../../cart.php');
      }
   //}
}


function insertUser($conn)
{
   $sql = "SELECT * from tbl_customer where cust_email = '" . $_POST['email'] . "' ";
   $check = mysqli_query($conn, $sql); // untuk check email agar tidak bisa register dengan email yang sama
   $check_data = mysqli_fetch_assoc($check); 
   if ($check_data) { // untuk check email agar tidak bisa register dengan email yang sama
      msg('Email Sudah Pernah Dipakai', '../monkers/login.php');
   } else {
      $sql = "INSERT INTO tbl_customer (cust_name, cust_birth, cust_address, cust_province, cust_city, cust_email, cust_pass, cust_phone, cust_total_order, cust_total_price, cust_img, create_date) 
         VALUES ('" . $_POST['nama'] . "', '" . $_POST['ultah'] . "', '" . $_POST['address'] . "', '" . $_POST['provinsi'] . "', '" . $_POST['kota'] . "', '" . $_POST['email'] . "',  password('" . $_POST['password'] . "'), '" . $_POST['nohp'] . "', '0', '0', 'default.jpeg', now()) ";
      $result = mysqli_query($conn, $sql);

      if ($result) {
         msg('Register Telah Berhasil Silakan Login!!', '../monkers/login.php');
      } else {
         msg('Register Gagal', '../monkers/login.php');
      }
   }
}

function AddAddress($conn)
{
      $sql = "INSERT INTO tbl_address (cust_id,cust_name, cust_address, cust_province, cust_city, cust_email, cust_phone, create_date) 
         VALUES ('" . $_SESSION['cust_id'] . "','" . $_POST['nama'] . "', '" . $_POST['address'] . "', '" . $_POST['provinsi'] . "', '" . $_POST['kota'] . "', '" . $_POST['email'] . "', '" . $_POST['nohp'] . "', now()) ";
      $result = mysqli_query($conn, $sql);

      if ($result) {
         msg('Alamat Telah Berhasil Ditambah!!', '../monkers/checkout.php');
      } else {
         msg('Alamat Gagal', '../monkers/checkout.php');
      }
}


function custLogin($id_user)
{ // UNTUK DATA LOGIN
   require('../connect/conn.php');
   $sql = "SELECT * from tbl_customer where cust_id = '" . $id_user . "' ";
   $result = mysqli_query($conn, $sql); // untuk check email agar tidak bisa register dengan email yang sama
   $data = mysqli_fetch_assoc($result);
   //echo $data['cust_name'];
   return $data;
}
function url()
{
   return sprintf(
      "%s://%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME'],
      $_SERVER['REQUEST_URI']
   );
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
