<?php
if($_REQUEST["themns"]<>"")
{
	$baoloi="";
	$ten_nhac_si=trim($_POST["tenns"]);
	if($ten_nhac_si=="")
	$baoloi.="Hãy nhập vào tên nhạc sĩ<br>";
	if($_FILES["hinhns"]["name"]=="")
	$baoloi.="Hãy chọn hình của nhạc sĩ<br>";
	if(kt_co_nhac_si_chua($ten_nhac_si))
	$baoloi.="Đã có nhạc sĩ này trong CSDL";
	$display=$_POST["display"];
	if($_POST["ttnhacsi"]=="")
	$baoloi.="Bạn chưa điền thông tin nhạc sĩ<br>";
	if($_FILES["hinhns"]["name"]<>"")
		{
			if(strtolower($_FILES["hinhns"]["type"])<>"image/jpeg"&&strtolower($_FILES["hinhns"]["type"])<>"image/gif"&&strtolower($_FILES["hinhns"]["type"])<>"image/png")
				$baoloi.="Chỉ được upload file jpg, gif, png";
		}
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			$ttnhacsi=$_POST["ttnhacsi"];
			$hinh=upload_hinh_cs("hinhns");
			Save("../upload_hinh/".$hinh, "../upload_hinh/hinh_nho/".$hinh, 70);
			them_nhac_si($ten_nhac_si, $hinh, $display, $ttnhacsi);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=nhacsi\">";		
	}
	else echo "<div class='error_text' align=center>".$baoloi."</div>";	
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="48%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2" align="center">THÊM NHẠC SĨ </td>
    </tr>
    <tr>
      <td width="45%" align="right">Tên nhạc sĩ : </td>
      <td width="55%"><input name="tenns" type="text" id="tenns" size="30" maxlength="30"></td>
    </tr>
    <tr>
      <td align="right">Hình nhạc sĩ : </td>
      <td><input name="hinhns" type="file" id="hinhns"></td>
    </tr>
    <tr>
    <td width="34%" align="right">Hiển thị trên menu </td>
    <td>
      <select name="display" id="display">
        <option value="1" selected='selected'>-Hiện-</option>
        <option value="0" >-Ẩn-</option>		
      </select>      
      </td>
     </tr>
     <tr>
      <td width="25%" align="right">Thông tin nhạc sĩ </td>
      <td width="75%" colspan="2"><textarea rows="10" name="ttnhacsi" id="ttnhacsi" cols="50"><?php if(isset($_POST["ttnhacsi"])) echo $_POST["ttnhacsi"]; else echo $row[tt_nhac_si]; ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="themns" type="submit" id="themns" value="Xác nhận"></td>
    </tr>
  </table>
</form>
