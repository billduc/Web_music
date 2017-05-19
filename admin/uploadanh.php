<?php
ob_start();
require_once('../includes/config.php');
require_once('../includes/mysql.php');
require_once('../includes/functions.php');
require_once('../includes/class_pages.php');
require_once('../includes/HamKiemTraDuLieu.php');
require_once('adminfunction.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload ảnh</title>
</head>
<?php
if($_REQUEST["themtt"]<>"")
{
	$baoloi="";
	if($_FILES["hinhtt"]["name"]=="")
		$baoloi.="Hãy chọn hình của tin tức<br>";
	else if($_FILES["hinhtt"]["name"]<>"")
		{
			if(strtolower($_FILES["hinhtt"]["type"])<>"image/jpeg"&&strtolower($_FILES["hinhtt"]["type"])<>"image/gif"&&strtolower($_FILES["hinhtt"]["type"])<>"image/png")
				$baoloi.="Chỉ được upload file jpg, gif, png";
		}
	if($baoloi=="")
	{
		$hinh_anh=upload_hinh_tt("hinhtt");
		$hinh_anh="upload_anhtt/".$hinh_anh;
		echo "Copy nguồn này: <font color=\"#0000CC\">".$hinh_anh."</font><br/>";
	}
	else
	{
		echo "<font color=\"#990000\">".$baoloi."</font><br/>";
	}
	
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form">
<tr>
<td><br />
</td>
</tr>
<tr>
      <td align="right">Upload ảnh tin tức</td>
      <td><input name="hinhtt" type="file" id="hinhtt"></td>
      <td><input name="themtt" type="submit" id="themtt" value="Upload"></td>
</tr>
</form>
<body>
</body>
</html>
