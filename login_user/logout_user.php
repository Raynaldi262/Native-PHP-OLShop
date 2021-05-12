<?php

session_start();

// 2. Unset all the session variables
unset($_SESSION['cust_id']);

?>
<script type="text/javascript">
    alert("Anda Berhasil Keluar!!");
    window.location = "../monkers/login.php";
</script>