<?php

session_start();

// 2. Unset all the session variables
// session_destroy();
unset($_SESSION['role_id']);
unset($_SESSION['admin_id']);

?>
<script type="text/javascript">
    alert("Anda Berhasil Keluar!!");
    window.location = "../login_admin/login_admin.php";
</script>