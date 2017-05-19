<?php
if($_REQUEST["themab"]<>"")
{
	$baoloi="";
	$ten_album=trim($_POST["tenab"]);
	if($ten_album=="")
	$baoloi.="Hãy nhập vào tên album<br>";
	if($_FILES["hinhab"]["name"]=="")
	$baoloi.="Hãy chọn hình của album<br>";
	if(kt_co_album_chua($ten_album))
	$baoloi.="Đã có album này trong CSDL";
	$display= $_POST["display"];
	if($_FILES["hinhab"]["name"]<>"")
		{
			if(strtolower($_FILES["hinhab"]["type"])<>"image/jpeg"&&strtolower($_FILES["hinhab"]["type"])<>"image/gif"&&strtolower($_FILES["hinhab"]["type"])<>"image/png")
				$baoloi.="Chỉ được upload file jpg, gif, png";
		}
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			$hinh=upload_hinh_cs("hinhab");
			Save("../upload_hinh/".$hinh, "../upload_hinh/hinh_nho/".$hinh, 70);
			them_album($ten_album, $hinh, $display);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=album\">";		
	}
	else echo "<div class='error_text' align=center>".$baoloi."</div>";	
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="46%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2" align="center">THÊM ALBUM </td>
    </tr>
    <tr>
      <td width="34%" align="right">Tên Album : </td>
      <td width="66%"><input name="tenab" type="text" id="tenab" size="30" maxlength="30"></td>
    </tr>
    <tr>
      <td align="right">Hình Album : </td>
      <td><input name="hinhab" type="file" id="hinhab"></td>
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
      <td>&nbsp;</td>
      <td><input name="themab" type="submit" id="themab" value="Xác nhận"></td>
    </tr>
  </table>
</form>
