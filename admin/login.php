<?php
@session_start();
require_once('../includes/config.php');
require_once('../includes/mysql.php');
$DB = new DB;
$DB->connect();
if($_REQUEST["Submit"]<>"")
{
	$ten_dang_nhap=trim($_POST["username"]);
	$mat_khau=trim($_POST["pass"]);
	$sql="select * from admin, nguoi_dung where admin.ma_nguoi_dung=nguoi_dung.ma_nguoi_dung AND ten_dang_nhap='$ten_dang_nhap' and mat_khau='".md5($mat_khau)."'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	echo "<div align=center><font color=red>Tên đăng nhập hoặc mật khẩu không đúng</font></div>";
	else
	{
		$row=$DB->fetch_row($result); 
		$_SESSION['adminlog']['ok']=TRUE;
		$_SESSION['log']['ok']=TRUE;
		$_SESSION['log']['ma_nguoi_dung']=$row[ma_nguoi_dung];
		$_SESSION['log']['ten_nguoi_dung']=$row[ten_nguoi_dung];
		$_SESSION['log']['ten_dang_nhap']=$row[ten_dang_nhap];
		$_SESSION['log']['email']=$row[email];
		$_SESSION['log']['mat_khau']=$row[mat_khau];
		echo "<div align=center><font color=blue size=+1>Đang đăng nhập vào hệ thống</font></div>";
		echo "<META http-equiv=refresh content=\"3; URL=index.php\">";
	}
}

?>
<title>Đăng nhập</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form name="form1" method="post" action="">
  <table width="37%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2" align="center">Admin Đăng nhập </td>
    </tr>
    <tr>
      <td width="34%">Tên đăng nhập: </td>
      <td width="66%"><input name="username" type="text" id="username" size="25"></td>
    </tr>
    <tr>
      <td>Mật khẩu: </td>
      <td><input name="pass" type="password" id="pass" size="25"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Đăng Nhập"></td>
    </tr>
  </table>
</form>
</body>
