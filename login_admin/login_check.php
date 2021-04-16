<?php
require('../connect/conn.php');
require('../session/session.php');
if (isset($_POST['btnlogin'])) {

    $username = strtoupper($_POST['username']);
    $password = trim($_POST['password']);

    //create some sql statement             
    $sql = "SELECT admin_id, admin_status, admin_name, role_id FROM  tbl_admin WHERE  upper(username_adm) =  '" . $username . "' AND  password_adm =  password(" . $password . ")";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // get nmbr of result
        $numrows = mysqli_num_rows($result);
        if ($numrows == 1) {   // kalau hasilnya ktmu dan 1
            $user = mysqli_fetch_array($result);
            if ($user['admin_status'] == 'in-active') {
?>
                <script type="text/javascript">
                    alert("Maaf, Akun anda telah dinonaktifkan, silahkan hubungi Owner!");
                    window.location = "login_admin.php";
                </script>
            <?php
            } else {
                // msukin data yg login ke session
                $_SESSION['admin_id'] = $user['admin_id'];
                $_SESSION['role_id'] = $user['role_id'];
            ?>

                <!-- login berhasil  -->
                <script type="text/javascript">
                    var status = "<?php echo $user['admin_name']; ?>";
                    alert("Selamat datang " + status);
                    window.location = "../admin/index.php";
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Maaf, username / password yang dimasukan salah, silahkan coba kembali.");
                window.location = "login_admin.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Maaf, username / password yang dimasukan salah, silahkan coba kembali.");
            window.location = "login_admin.php";
        </script>
<?php
    }
}
?>