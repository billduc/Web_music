<?php
if($_SESSION['log']['ok'])
{
	if($_REQUEST["thaydoi"]<>"")
	{
		$baoloi="";
		$ma_nguoi_dung=$_POST["manguoidung"];
		$ten_dang_nhap=trim($_POST["username"]);
		$mat_khau_cu=trim($_POST["passcu"]);
		$mat_khau_moi=trim($_POST["passmoi"]);
		$ten_nguoi_dung=trim($_POST["hoten"]);
		$email=trim($_POST["email"]);
		if($_SESSION['log']['mat_khau']<>md5($mat_khau_cu))
		$baoloi.="Bạn phải nhập chính xác mật khẩu cũ!";
		if($ten_dang_nhap=="" || !isValidUsername($ten_dang_nhap))
		$baoloi.="- Hãy nhập tên đăng nhập (không chứa các ký tự đặc biệt)<br>";
		if(strlen($mat_khau_moi)<6 || !isValidUsername($mat_khau_moi))
		$baoloi.="- Mật khẩu phải từ 6 ký tự trở lên và không chứa ký tự đặc biệt<br>";
		if($ten_nguoi_dung=="")
		$baoloi.="- Hãy nhập tên của bạn<br>";
		if(!isValidEmail($email))
		$baoloi.="- Email chưa đúng định dạng<br>";
		
		if($baoloi=="")
		{
			
			sua_tt_nguoi_dung($ma_nguoi_dung, $ten_nguoi_dung, $ten_dang_nhap, md5($mat_khau_moi), $email);
			
		}
		else echo $baoloi;
	}
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2" align="center">THAY ĐỔI THÔNG TIN CÁ NHÂN </td>
    </tr>
    <tr>
      <td width="30%" >Tên đăng nhập:</td>
      <td width="70%" ><input name="username" type="text" id="username" value="<?php if(isset($_POST["username"])) echo $_POST["username"]; else echo $_SESSION['log']['ten_dang_nhap'];?>" size="30">
      <input name="manguoidung" type="hidden" id="manguoidung" value="<?php echo $_SESSION['log']['ma_nguoi_dung'];?>"></td>
    </tr>
    <tr>
      <td>Mật khẩu cũ: </td>
      <td><input name="passcu" type="password" id="passcu" size="30"></td>
    </tr>
    <tr>
      <td>Mật khẩu mới: </td>
      <td><input name="passmoi" type="password" id="passmoi" size="30" ></td>
    </tr>
    <tr>
      <td>Họ tên: </td>
      <td><input name="hoten" type="text" id="hoten" value="<?php if(isset($_POST["hoten"])) echo $_POST["hoten"]; else echo $_SESSION['log']['ten_nguoi_dung'];?>" size="30" ></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input name="email" type="text" id="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"]; else echo $_SESSION['log']['email'];?>" size="30" ></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="thaydoi" type="submit" id="thaydoi" value="Hoàn thành">
      <input type="reset" name="Submit2" value=" Hủy "></td>
    </tr>
  </table>
</form>
<?php
}
?>