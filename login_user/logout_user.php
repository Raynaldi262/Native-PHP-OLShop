<?php

session_start();

// 2. Unset all the session variables
session_destroy();

?>
<script type="text/javascript">
    alert("Anda Berhasil Keluar!!");
    window.location = "../Eshopper/login.php";
</script>