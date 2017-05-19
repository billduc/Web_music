<?php
	ob_start();
	@session_start();
	require_once('includes/config.php');
	require_once('includes/mysql.php');
	require_once('includes/functions.php');
	require_once('includes/class_pages.php');
	require_once('includes/HamKiemTraDuLieu.php');
	$DB = new DB;
	$DB->connect();
	$DB->query("SET NAMES 'utf8'");
	$p=new pager;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Web Nghe Nhạc Trực Tuyến - UIT</title>
<!--<link rel="shortcut icon" href="images/pic01.jpg"> -->
<link href="css/style_main.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/menu.js"></script>
<script language="javascript">

function cuon_menu()
{
	menu.style.top=document.body.scrollTop +100;
}
function khoi_dong()
{
	setInterval("cuon_menu()", 1);
}

</script>
</head>
<body>
<div align="center" style="float:inherit">

<table width="1000px" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000"> 
	<tr>
		<td width="100%" ><img src="images/header.png" width="100%" height="191" /></td>	
	</tr>
</table>

<table width="1000px" border="0" cellpadding="0" cellspacing="0" cell spacing="0">     
	<tr class="font_menu_TA">	
        <td width="142">
        	<div align="center"><?php echo date('l: d / m / Y')?></div></a></td>
        <td width="142">
        	<a href="index.php" class="subcat_menu"><div align="center">| Trang chủ |</div></a></td>
		<td width="142">
        <a href="dstintuc.php" class="subcat_menu"><div align="center">| Tin Tức |</div></a></td>
        <td width="142">
        	<a href="index.php?a=dangky" class="subcat_menu"><div align="center">| ĐĂNG KÝ |</div></a></td>
        <td width="142">
        	<a href="index.php?a=download" class="subcat_menu"><div align="center">| Download |</div></a></td>
        <td width="142">
        	<a href="index.php?a=upload" class="subcat_menu"><div align="center">| UPLOAD |</div></a></td>
        <td width="142">
        	<a href="index.php?a=lienhe" class="subcat_menu"><div align="center">| Liên hệ |</div></a></td>
	</tr>
</table>
<!-----------------main----------------------------------------->
<table width="1000px" align="center" border="0" cellspacing="1" cellpadding="1">
<tr>
<td width="200" valign="top">
<?php
	include "tintuc.php";
?>
</td>
<td valign="top">
<?php
	include "hienthitintuc.php";
?>
</td>
</tr>
</table>

<!-----------------footer----------------------------------------->	
<table width="1000px" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td width="822"><img src="images/footer.jpg" width="100%" height="110" /></td>
	<th width="178" align="left" scope="col">
	<div>			
	<div align="center">CopyRight@2011</div>
	<div align="center">by IS03</div>
  	<div align="center">Nguyễn Trung Vinh</div>
	<div align="center">08520468</div>
    <div align="center">Lương Văn Thắng</div>
	<div align="center">08520365</div>
	</div>
	</th>
</tr>
</table>
</div>
</body>
</html>
