<?php
if($_REQUEST["sua"]<>"")
{
	$baoloi="";
	if(trim($_POST["tenqg"])=="")
	$baoloi.="Hãy nhập vào tên của quốc gia<br>";
	if(!is_numeric($_POST["qg_order"]))
	$baoloi.="Vị trí trên menu phải là số!<br>";
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			$ma_quoc_gia=$_POST["ma_qg"];
			$ten_quoc_gia=trim($_POST["tenqg"]);
			$qg_order=$_POST["qg_order"]; 
			$display=$_POST["display"];
			sua_quoc_gia($ma_quoc_gia, $ten_quoc_gia, $qg_order, $display);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=quocgia\">";		
	}
	else
	echo "<div align=center><font color=red>".$baoloi."</font></div>";

}

if($_REQUEST["maqg"]<>"")
{
	$ma_quoc_gia=$_REQUEST["maqg"];
	$sql="select * from quoc_gia where ma_quoc_gia='$ma_quoc_gia'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	{
		header("Location: ?a=quocgia");
		exit();
	}
	else
		$row=$DB->fetch_row($result);
	{
	?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="61%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="3" align="center">SỬA QUỐC GIA </td>
    </tr>
    <tr>
      <td width="42%" align="right">Tên quốc gia : </td>
      <td colspan="2"><input name="tenqg" type="text" id="tenqg" value="<?php if(isset($_POST["tenqg"])) echo $_POST["tenqg"]; else echo $row[ten_quoc_gia];?>" size="30" maxlength="30">
      <input name="ma_qg" type="hidden" id="ma_qg" value="<?php echo $row[ma_quoc_gia];?>"></td>
    </tr>
    <tr>
      <td align="right">Vị trí trên menu : </td>
      <td colspan="2"><input name="qg_order" type="text" size="3" maxlength="3" value="<?php if(isset($_POST["qg_order"])) echo $_POST["qg_order"]; else echo $row[qg_order]; ?>"></td>
    </tr>
    <tr>
      <td align="right">Hiển thị trên menu : </td>
      <td colspan="2"><select name="display" id="display">
        <option value="1" <?php if($row[display]==1) echo "selected='selected'";?>>-Hiện-</option>
        <option value="0" <?php if($row[display]==0) echo "selected='selected'";?>>-Ẩn-</option>
      </select>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><input name="sua" type="submit" id="sua" value="Xác nhận"></td>
    </tr>
  </table>
</form>
<?php
}}
?>