<?php
require('../connect/conn.php');
require('../session/session.php');

$sql = "SELECT * FROM  tbl_admin a join role r on r.role_id = a.role_id  WHERE admin_id = " . $_SESSION['admin_id'] . "";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

$sql = "SELECT * from tbl_admin a join role r on r.role_id = a.role_id";
$admin_data = mysqli_query($conn, $sql);

if (isset($_POST['edit_profile'])) {
    updateProfile($conn);
}

if (isset($_POST['get_admin'])) {
    getAdmin($conn);
}

if (isset($_POST['save_admin'])) {
    updateAdmin($conn);
}

if (isset($_POST['insert_admin'])) {
    insertAdmin($conn);
}

if (isset($_POST['delete_admin'])) {
    deleteAdmin($conn);
}



function updateProfile($conn)
{
    $id = $_POST['admin_id'];
    $img = $_FILES['img']['name'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $pass_new = $_POST['pass_new'];
    $pass_confrim = $_POST['pass_confrim'];

    if ($img) {  // kalau upload gambar
        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $nama = $_FILES['img']['name'];    //nama filenya apa
        $x = explode('.', $nama);   // dpt nama tanpa ekstensi file
        $ekstensi = strtolower(end($x));    // jdiin hruf kecil ekstensinya
        $ukuran    = $_FILES['img']['size'];   //ukuran brp
        $file_tmp = $_FILES['img']['tmp_name'];    //temp filenya apa

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {    // kalau ekstensinya bener
            if ($ukuran < 4044070) {        // max 4 mb
                move_uploaded_file($file_tmp, '../dist/img/admin/' . $nama);

                // start kalau ganti password
                if ($pass != null && $pass_new != null && $pass_new == $pass_confrim) { //kalau pass ga null dan pas new dan konfirmasi sama
                    if (check_pass($id, $pass, $conn)) {
                        $sql = "update tbl_admin 
                                set admin_name =  '" . $name . "' ,admin_phone = '" . $phone . "', admin_img = '" . $img . "'
                                    ,username_adm = '" . $username . "', password_adm = password('" . $pass_new . "')
                                where admin_id = " . $id . "";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            msg('Data berhasil diubah!!', '../admin/profile.php');
                        } else msg('Gagal Mengubah data!!', '../admin/profile.php');
                    } else msg('Password yang dimasukkan salah, Silahkan coba kembali!!', '../admin/profile.php');
                } elseif ($pass != null && $pass_new != null && $pass_new != $pass_confrim) {   // kalau pass ga null tapi pas new & pas konf ga sama
                    msg('Password baru dan Password konfirmasi tidak sama, Silahkan coba kembali!!', '../admin/profile.php');
                } elseif ($pass != null && ($pass_new == null || $pass_confrim == null)) {    // kalau pass ga null tapi pas new & pas konf null
                    msg('Password baru / Password konfirmasi Masih kosong, Silahkan coba kembali!!', '../admin/profile.php');
                } else {

                    $sql = "update tbl_admin 
                            set admin_name =  '" . $name . "' ,admin_phone = '" . $phone . "', admin_img = '" . $img . "'
                                ,username_adm = '" . $username . "'
                            where admin_id = " . $id . "";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        msg('Data berhasil diubah!!', '../admin/profile.php');
                    } else {
                        msg('Gagal Mengubah data!!', '../admin/profile.php');
                    }
                }
            } else {
                msg('Ukuran file max 4mb!!', '../admin/profile.php');
            }
        } else {
            msg('Ekstensi File yang diupload hanya diperbolehkan png / jpg!!', '../admin/profile.php');
        }
    } else {  //kalau tidak upload gambar
        if ($pass != null && $pass_new != null && $pass_new == $pass_confrim) { //kalau pass ga null dan pas new dan konfirmasi sama
            if (check_pass($id, $pass, $conn)) {
                $sql = "update tbl_admin 
                        set admin_name =  '" . $name . "' ,admin_phone = '" . $phone . "'
                            ,username_adm = '" . $username . "', password_adm = password('" . $pass_new . "')
                        where admin_id = " . $id . "";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    msg('Data berhasil diubah!!', '../admin/profile.php');
                } else msg('Gagal Mengubah data!!', '../admin/profile.php');
            } else msg('Password yang dimasukkan salah, Silahkan coba kembali!!', '../admin/profile.php');
        } elseif ($pass != null && $pass_new != null && $pass_new != $pass_confrim) {   // kalau pass ga null tapi pas new & pas konf ga sama
            msg('Password baru dan Password konfirmasi tidak sama, Silahkan coba kembali!!', '../admin/profile.php');
        } elseif ($pass != null && ($pass_new == null || $pass_confrim == null)) {    // kalau pass ga null tapi pas new & pas konf null
            msg('Password baru / Password konfirmasi Masih kosong, Silahkan coba kembali!!', '../admin/profile.php');
        } else {
            $sql = "update tbl_admin 
            set admin_name =  '" . $name . "' ,admin_phone = '" . $phone . "' ,username_adm = '" . $username . "'
            where admin_id = " . $id . "";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                msg('Data berhasil diubah!!', '../admin/profile.php');
            } else msg('Gagal Mengubah data!!', '../admin/profile.php');
        }
    }
}


function check_pass($id, $pass, $conn)
{
    $sql = "select 1 from tbl_admin where admin_id = " . $id . " and password(password_adm) = '" . $pass . "' ";
    return $result = mysqli_query($conn, $sql);
}

function getAdmin($conn)
{
    $sql = "select * from tbl_admin where admin_id = " . $_POST['admin_id'] . "";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    echo json_encode($result);
}

function updateAdmin($conn)
{
    $id = $_POST['id'];
    $status = $_POST['status'];
    $wewenang = $_POST['wewenang'];

    $sql = "update tbl_admin 
            set admin_status = '" . $status . "' , role_id = " . $wewenang . "
            where admin_id = " . $id . "";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil diperbarui!!', '../admin/data_admin.php');
    } else {
        msg('Data gagal diperbarui!!', '../admin/data_admin.php');
    }
}

function insertAdmin($conn)
{
    $gmbr = 'default.jpg';
    $nama = $_POST['ins_nama'];
    $username = $_POST['ins_usname'];
    $tgl_lahir = $_POST['ins_lahir'];
    $phone = $_POST['ins_hp'];
    $status = $_POST['ins_status'];
    $role = $_POST['ins_wewenang'];

    $sql = "insert into tbl_admin (admin_name, username_adm, password_adm, admin_birth, admin_phone, admin_status, role_id, admin_img, create_date)
            values('" . $nama . "', '" . $username . "', password(123), '" . $tgl_lahir . "', '" . $phone . "', '" . $status . "', '" . $role . "', '" . $gmbr . "', now() )";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil diperbarui!!', '../admin/data_admin.php');
    } else {
        msg('Data gagal diperbarui!!', '../admin/data_admin.php');
    }
}

function deleteAdmin($conn)
{
    $id = $_POST['id_hapus'];

    $sql = "delete from tbl_admin where admin_id = " . $id . "";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        msg('Data Berhasil dihapus!!', '../admin/data_admin.php');
    } else {
        msg('Data gagal dihapus!!', '../admin/data_admin.php');
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
