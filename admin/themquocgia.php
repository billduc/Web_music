<?php
if($_REQUEST["themqg"]<>"")
{
	$baoloi="";
	$ten_quoc_gia=trim($_POST["tenqg"]);
	if($ten_quoc_gia=="")
	$baoloi.="Hãy nhập vào tên quốc gia<br>";
	if(kt_co_quoc_gia_chua($ten_quoc_gia))
	$baoloi.="Đã có quốc gia này trong CSDL";
	$display=$_POST["display"];
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			them_quoc_gia($ten_quoc_gia, $display);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=quocgia\">";		
	}
	else echo "<div class='error_text' align=center>".$baoloi."</div>";	
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="47%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2" align="center">THÊM QUỐC GIA </td>
    </tr>
    <tr>
      <td width="41%" align="right">Tên quốc gia : </td>
      <td width="59%"><input name="tenqg" type="text" id="tenqg" size="30" maxlength="30"></td>
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
      <td><input name="themqg" type="submit" id="themtl" value="Xác nhận"></td>
    </tr>
  </table>
</form>
