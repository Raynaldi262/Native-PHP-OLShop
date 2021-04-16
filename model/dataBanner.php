<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "Select * from tbl_banner";
$getBanner = mysqli_query($conn, $sql);


if (isset($_POST['upload'])) {
    insertBanner($conn);
}

if (isset($_POST['get_banner'])) {
    getBannerWhere($conn);
}

if (isset($_POST['delete'])) {
    deleteBanner($conn);
}


function insertBanner($conn)
{
    $img = $_FILES['img']['name'];

    if ($img) {  // kalau upload gambar
        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $nama = $_FILES['img']['name'];    //nama filenya apa
        $x = explode('.', $nama);   // dpt nama tanpa ekstensi file
        $ekstensi = strtolower(end($x));    // jdiin hruf kecil ekstensinya
        $ukuran    = $_FILES['img']['size'];   //ukuran brp
        $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
            if ($ukuran < 4044070) {        // max 4 mb
                move_uploaded_file($file_tmp, '../dist/img/banner/' . $nama);

                $sql = "insert into tbl_banner (banner_img) values ('" . $nama . "')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    msg('Data berhasil ditambahkan!!', '../admin/banner.php');
                } else {
                    msg('Gagal Mengubah ditambahkan!!', '../admin/banner.php');
                }
            } else {
                msg('Ukuran file max 4mb!!', '../admin/banner.php');
            }
        } else {
            msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/banner.php');
        }
    } else {
        msg('Upload file gagal!!', '../admin/banner.php');
    }
}

function getBannerWhere($conn)
{
    $id = $_POST['bannerID'];

    $sql = "Select * from tbl_banner where banner_id = " . $id . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function deleteBanner($conn)
{
    $id = $_POST['id_hapus'];

    $sql = "delete from tbl_banner where banner_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Banner Berhasil dihapus!!', '../admin/banner.php');
    } else {
        msg('Banner gagal dihapus!!', '../admin/banner.php');
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
