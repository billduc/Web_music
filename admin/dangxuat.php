<?php
unset($_SESSION['adminlog']);
unset($_SESSION['log']);
header("Location: index.php");
ob_end_flush();
?>