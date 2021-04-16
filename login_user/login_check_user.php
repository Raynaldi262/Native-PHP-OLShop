<?php 
require('../connect/conn.php');
require('../session/session.php');
if (isset($_POST['login'])) {

    $email = strtoupper($_POST['email']);
    $password = trim($_POST['password']);

    //create some sql statement             
    $sql = "SELECT * FROM  tbl_customer WHERE  upper(cust_email) =  '" . $email . "' AND  cust_pass =  password('" . $password . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // get nmbr of result
        $numrows = mysqli_num_rows($result);
        if ($numrows == 1) {   // kalau hasilnya ktmu dan 1
            $user = mysqli_fetch_array($result);
                // msukin data yg login ke session
                $_SESSION['cust_id'] = $user['cust_id'];
            ?>
                <!-- login berhasil  -->
                <script type="text/javascript">
                    var status = "<?php echo $user['cust_name']; ?>";
                    alert("Selamat datang " + status);
                    window.location = "../Eshopper/";
                </script>
            <?php
    
        } else {
            echo "false";
            ?>
            <script type="text/javascript">
                alert("Maaf, username / password yang dimasukan salah, silahkan coba kembali.");
                window.location = "../Eshopper/login.php";
            </script>
        <?php
        }
    } else {
        echo "false";
        ?>
        <script type="text/javascript">
            alert("Maaf, username / password yang dimasukan salah, silahkan coba kembali.");
            window.location = "../Eshopper/login.php";
        </script>
<?php
    }
}
?>