<?php
if($_REQUEST["mand"]<>"")
{
	$ma_nguoi_dung=$_REQUEST["mand"];
	$sql="select * from nguoi_dung where ma_nguoi_dung='$ma_nguoi_dung'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	{
		header("Location: ?a=nguoidung");
		exit();
	}
	else
	{	$row=$DB->fetch_row($result);
		if($_REQUEST["thaydoi"]<>"")
		{
			$baoloi="";
			$ma_nguoi_dung=$_POST["ma_nd"];
			$ten_dang_nhap=trim($_POST["username"]);
			$ten_nguoi_dung=trim($_POST["hoten"]);
			$email=trim($_POST["email"]);
			$cam_su_dung=$_POST["tinh_trang"];
			$quyen_admin=$_POST["quyenadmin"];
			if($ten_dang_nhap=="" || !isValidUsername($ten_dang_nhap))
			$baoloi.="- Hãy nhập tên đăng nhập (không chứa các ký tự đặc biệt)<br>";
			if($ten_nguoi_dung=="")
			$baoloi.="- Hãy nhập tên của bạn<br>";
			if(!isValidEmail($email))
			$baoloi.="- Email chưa đúng định dạng<br>";
			
			if($baoloi=="")
			{
				if($_SESSION['log']['ma_nguoi_dung']==18)
				{
					sua_nguoi_dung($ma_nguoi_dung, $ten_nguoi_dung, $ten_dang_nhap, $email, $cam_su_dung, $quyen_admin);
				}
				else
					echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=nguoidung\">";	
				
			}
			else echo $baoloi;
		}
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2" align="center">THAY ĐỔI TT NGƯỜI DÙNG </td>
    </tr>
    <tr>
      <td width="30%" align="right" >Tên đăng nhập :</td>
      <td width="70%" ><input name="username" type="text" id="username" value="<?php if(isset($_POST["username"])) echo $_POST["username"]; else echo $row[ten_dang_nhap];?>" size="30">
      <input name="ma_nd" type="hidden" id="ma_nd" value="<?php echo $row[ma_nguoi_dung];?>"></td>
    </tr>
    <tr>
      <td align="right">Họ tên : </td>
      <td><input name="hoten" type="text" id="hoten" value="<?php if(isset($_POST["hoten"])) echo $_POST["hoten"]; else echo $row[ten_nguoi_dung];?>" size="30" ></td>
    </tr>
    <tr>
      <td align="right">Email :</td>
      <td><input name="email" type="text" id="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"]; else echo $row[email];?>" size="30" ></td>
    </tr>
    <tr>
      <td align="right">Tình trạng cấm : </td>
      <td><select name="tinh_trang" id="tinh_trang">
        <option value="1" <?php if($row[cam_su_dung]==1) echo "selected='selected'";?>>-Cấm-</option>
        <option value="0" <?php if($row[cam_su_dung]==0) echo "selected='selected'";?>>-Không Cấm-</option>
      </select>
</td>
    </tr>
    <!--
    <tr>
      <td align="right">Quyền Admin : </td>
      <td><select name="quyenadmin" id="quyenadmin">
        <option value="1" <?php #if($row[quyen_admin]==1) echo "selected='selected'";?>>-Cho Phép-</option>
        <option value="0" <?php #if($row[quyen_admin]==0) echo "selected='selected'";?>>-Không Cho Phép-</option>
      </select></td>
    </tr>
    
    
    -->
    <tr>
      <td>&nbsp;</td>
      <td><input name="thaydoi" type="submit" id="thaydoi" value="Xác nhận">
      <input type="reset" name="Submit2" value="Hủy"></td>
    </tr>
  </table>
</form>
<?php
}}
?>