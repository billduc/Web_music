<?php
ob_start();
@session_start();
require_once('../includes/config.php');
require_once('../includes/mysql.php');
require_once('../includes/functions.php');
require_once('../includes/class_pages.php');
require_once('../includes/HamKiemTraDuLieu.php');
require_once('ckeditor/ckeditor.php');
require_once('adminfunction.php');
$DB = new DB;
$DB->connect();
$DB->query("SET NAMES 'utf8'");
$p=new pager;
if ($_SESSION['adminlog']['ok']!=TRUE) require_once('login.php');
else {
?>
<head>
<link href="../css/style_main.css" rel="stylesheet" type="text/css" />
<title>Admin</title>
<script language="JavaScript" src=""></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
<table width="80%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th scope="col" width="150 px" >Chào mừng <?php echo $_SESSION['log']['ten_dang_nhap'];?> <a href="?a=dangxuat">(logout)</a> </th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr valign="top">
    <td width="150 px"><?php require_once('menu.php');?></td>
    <td ><?php require_once('main.php');?></td>
  </tr>
</table>
</body>
<?php }?>

