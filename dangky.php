<?php
if($_SESSION['log']['ok'])
{
	echo "<META http-equiv=refresh content=\"0; URL=index.php\">";
}
else
{
	if($_REQUEST["Submit"]<>"")
	{
		$baoloi="";
		$ten_dang_nhap=trim($_POST["username"]);
		$mat_khau=trim($_POST["pass"]);
		$ten_nguoi_dung=trim($_POST["hoten"]);
		$email=trim($_POST["email"]);
		$ngay_tham_gia=date("Y/m/d");
		if($ten_dang_nhap=="" || !isValidUsername($ten_dang_nhap))
		$baoloi.="- Hãy nhập tên đăng nhập (không chứa các ký tự đặc biệt)<br>";
		if(strlen($mat_khau)<6 || !isValidUsername($mat_khau))
		$baoloi.="- Mật khẩu phải từ 6 ký tự trở lên và không chứa ký tự đặc biệt<br>";
		if($ten_nguoi_dung=="")
		$baoloi.="- Hãy nhập tên của bạn<br>";
		if(!isValidEmail($email))
		$baoloi.="- Email chưa đúng định dạng<br>";
		if($_POST[txtcapcha]=="")
		{
			$baoloi.="- Bạn chưa nhập mã bảo mật<br>";
		}
		else
		{
			if($_POST[txtcapcha]<>$_SESSION["security_code"])
			{
				$baoloi.="- Bạn nhập sai mã bảo mật<br>";
			}
		}
		if($baoloi=="")
		{
			
			if(kt_username_cochua($ten_dang_nhap))
			echo "Đã có người dùng tên đăng nhập này, hãy chọn tên khác!";
			else if(kt_email_cochua($email))
			echo "Đã có người sử dụng email này, hãy chọn email khác!";
			else
			them_nguoi_dung($ten_nguoi_dung, $ten_dang_nhap, md5($mat_khau), $email, $ngay_tham_gia);
		}
		else echo "<font color=red>".$baoloi."</font>";
	}
	?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td align="center">&nbsp;</td>
      <td align="left">Đăng Ký Thành Viên </td>
    </tr>
    <tr>
      <td width="34%" align="left" >Tên đăng nhập :</td>
      <td width="66%" ><input name="username" type="text" id="username" value="<?php if(isset($_POST["username"])) echo $_POST["username"];?>" size="30"></td>
    </tr>
    <tr>
      <td align="left">Mật khẩu :</td>
      <td><input name="pass" type="password" id="pass" size="30" ></td>
    </tr>
    <tr>
      <td align="left">Họ tên : </td>
      <td><input name="hoten" type="text" id="hoten" value="<?php if(isset($_POST["hoten"])) echo $_POST["hoten"];?>" size="30" ></td>
    </tr>
    <tr>
      <td align="left">Email :</td>
      <td><input name="email" type="text" id="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"];?>" size="30" ></td>
    </tr>
    <tr>
    	<td align="left">Mã bảo mật :</td>
    	<td><input name="txtcapcha" id="txtcapcha"  />
        </td>
    </tr>
    <tr>
    	<td></td>
        <td><img src="captcha.php" alt="captcha" align="absmiddle" style="padding-bottom:2px" />
            </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Xác nhận"></td>
    </tr>
  </table>
</form>
<?php
}
?>
