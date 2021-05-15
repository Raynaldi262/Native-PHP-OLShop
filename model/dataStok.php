<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "Select * from tbl_item a join tbl_item_type b on a.type_id = b.type_id join tbl_color c on a.color_id = c.color_id
         WHERE item_status = 'ACTIVE'";
$getItem = mysqli_query($conn, $sql);

$sql = "Select * from tbl_color";
$getColor = mysqli_query($conn, $sql);

$sql = "Select * from tbl_item_type";
$getTipe = mysqli_query($conn, $sql);


if (isset($_POST['add_color'])) {
    addColor($conn);
}


if (isset($_POST['deleteColor'])) {
    deleteColor($conn);
}

if (isset($_POST['deleteImg'])) {
    deleteImg($conn);
}

if (isset($_POST['add_item'])) { // tambah data
    addItem($conn);
}

if (isset($_POST['getItemWhere'])) {    // isi data sblm edit
    getItemWhere($conn);
}

if (isset($_POST['edit_item'])) {   //e dit beneran
    editItem($conn);
}

if (isset($_POST['get_item'])) {    // dpt data sblm dihapus
    getItem($conn);
}

if (isset($_POST['delete_item'])) { // hapus beneran
    deleteItem($conn);
}

if (isset($_POST['loadImg'])) { // namilin gambar di edit
    getImage($conn);
}

function getImage($conn)    // ini buat di edit
{
    $id = $_POST['itemId'];
    $sql = "Select * from tbl_img where item_id = " . $id . "";
    $getImg = mysqli_query($conn, $sql);
    while ($datas = mysqli_fetch_assoc($getImg)) {
        $img[] = $datas; //assign whole values to array
    }

    echo json_encode($img);
}

function getImage1($conn, $id)  //ini di dpan pas load page
{
    $sql = "Select * from tbl_img where item_id = " . $id . " limit 1";
    $getImg1 = mysqli_query($conn, $sql);
    $img = mysqli_fetch_assoc($getImg1);
    return $img;
}

function deleteColor($conn)
{
    $id = $_POST['id'];

    $sql = "delete from tbl_color where color_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Warna Berhasil dihapus!!', '../admin/stok.php');
    } else {
        msg('Warna gagal dihapus!!', '../admin/stok.php');
    }
}

function deleteImg($conn)
{
    $id = $_POST['img_id'];

    $sql = "delete from tbl_img where img_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Gambar Berhasil dihapus!!', '../admin/stok.php');
    } else {
        msg('Gambar gagal dihapus!!', '../admin/stok.php');
    }
}


function addColor($conn)
{
    $warna = $_POST['warna'];

    $sql = "insert into tbl_color(color_name) values('" . $warna . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Warna Berhasil ditambahkan!!', '../admin/stok.php');
    } else {
        msg('Warna gagal ditambahkan!!', '../admin/stok.php');
    }
}


function addItem($conn)
{
    $img = $_FILES['img']['name'];
    $name = $_POST['item_name'];
    $tipe = $_POST['item_type'];
    $color = $_POST['item_color'];
    $berat = $_POST['item_weight'];
    $desc = $_POST['item_desc'];
    $price = $_POST['item_price'];

    $ekstensi_diperbolehkan    = array('png', 'jpg');
    $x = explode('.', $img);   // dpt nama tanpa ekstensi file
    $ekstensi = strtolower(end($x));    // jdiin huruf kecil ekstensinya
    $ukuran    = $_FILES['img']['size'];   //ukuran brp 
    $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
        if ($ukuran < 4044070) {

            date_default_timezone_set("Asia/Bangkok");
            $date_id = date("his") . date("Ymd");

            move_uploaded_file($file_tmp, '../dist/img/item/' . $date_id . $img);

            $sql = "insert into tbl_item(item_name, type_id, color_id,  item_weight, item_desc, create_date, item_price, item_status) 
            values('" . $name . "', " . $tipe . ", " . $color . ", " . $berat . ", '" . $desc . "', now(), " . $price . ", 'ACTIVE')";
            $result = mysqli_query($conn, $sql);

            $sql2 = "SELECT LAST_INSERT_ID()";
            $hasil = mysqli_query($conn, $sql2);
            $item_id = mysqli_fetch_row($hasil);

            // $sql3 = "insert into tbl_stockinout (item_id, item_name, stok_qty , create_date, stok_desc, total_qty) 
            //         values(" . $item_id[0] . ", '" . $name . "', 0, now() , 'STOCK IN', " . $qty . ")";
            // $result2 = mysqli_query($conn, $sql3);

            $sql4 = "insert into tbl_img (img_name, item_id) 
                    values('" . $date_id . $img . "' ," . $item_id[0] . ")";
            $result2 = mysqli_query($conn, $sql4);


            if ($result2 == 1 && $result == 1) {
                msg('Data berhasil ditambahkan!!', '../admin/stok.php');
            } else msg('Gagal menambahkan data!!', '../admin/stok.php');
        } else {
            msg('Ukuran file max 4mb!!', '../admin/stok.php');
        }
    } else {
        msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/stok.php');
    }
}


function getItemWhere($conn)    // isi data sblm edit
{
    $id = $_POST['item_id'];

    $sql = "Select * from tbl_item a join tbl_item_type b on a.type_id = b.type_id join tbl_color c on a.color_id = c.color_id
            where item_id = " . $id . "";

    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function editItem($conn)
{
    $id = $_POST['edit_id'];
    $img = $_FILES['img']['name'];
    $name = $_POST['edit_name'];
    $tipe = $_POST['edit_type'];
    $color = $_POST['edit_color'];
    $berat = $_POST['edit_weight'];
    $desc = $_POST['edit_desc'];
    $price = $_POST['edit_price'];

    if ($img) {
        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $x = explode('.', $img);   // dpt nama tanpa ekstensi file
        $ekstensi = strtolower(end($x));    // jdiin huruf kecil ekstensinya
        $ukuran    = $_FILES['img']['size'];   //ukuran brp 
        $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
            if ($ukuran < 4044070) {

                date_default_timezone_set("Asia/Bangkok");
                $date_id = date("his") . date("Ymd");

                move_uploaded_file($file_tmp, '../dist/img/item/' . $date_id . $img);

                $sql = "insert into tbl_img (img_name, item_id, create_date)  values('" . $date_id . $img . "' ," . $id . ", now())";
                $result = mysqli_query($conn, $sql);
            } else {
                msg('Ukuran file max 4mb!!', '../admin/stok.php');
            }
        } else {
            msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/stok.php');
        }
    }

    $sql = "update tbl_item
            set item_name = '" . $name . "', type_id = " . $tipe . ", color_id = " . $color . ",
            item_desc = '" . $desc . "', item_price = " . $price . ", item_weight = " . $berat . "
            where item_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result == 1) {
        msg('Data berhasil diubah!!', '../admin/stok.php');
    } else msg('Gagal mengubah data!!', '../admin/stok.php');
}

function getItem($conn)
{
    $sql = "select * from tbl_item where item_id = " . $_POST['itemId'] . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function deleteItem($conn)
{
    $id = $_POST['id_hapus'];

    // $sql = "delete from tbl_item where item_id = " . $id . "";
    $sql = "Update tbl_item set item_status = 'IN-ACTIVE' where item_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil dihapus!!', '../admin/stok.php');
    } else {
        msg('Data gagal dihapus!!', '../admin/stok.php');
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
