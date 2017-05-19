<?php
if($_REQUEST["sua"]<>"")
{
	$baoloi="";
	if(trim($_POST["tentl"])=="")
	$baoloi.="Hãy nhập vào tên của thể loại<br>";
	if(!is_numeric($_POST["tl_order"]))
	$baoloi.="Vị trí trên menu phải là số!<br>";
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			$ma_the_loai=$_POST["ma_tl"];
			$ten_the_loai=trim($_POST["tentl"]);
			$tl_order=$_POST["tl_order"]; 
			$display=$_POST["display"];
			sua_the_loai($ma_the_loai, $ten_the_loai, $tl_order, $display);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=theloai\">";	
	}
	else
	echo "<div align=center><font color=red>".$baoloi."</font></div>";

}

if($_REQUEST["matl"]<>"")
{
	$ma_the_loai=$_REQUEST["matl"];
	$sql="select * from the_loai where ma_the_loai='$ma_the_loai'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	{
		header("Location: ?a=theloai");
		exit();
	}
	else
		$row=$DB->fetch_row($result);
	{
	?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="61%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="3" align="center">SỬA THỂ LOẠI </td>
    </tr>
    <tr>
      <td width="42%" align="right">Tên thể loại : </td>
      <td colspan="2"><input name="tentl" type="text" id="tentl" value="<?php if(isset($_POST["tentl"])) echo $_POST["tentl"]; else echo $row[ten_the_loai];?>" size="30" maxlength="30">
      <input name="ma_tl" type="hidden" id="ma_tl" value="<?php echo $row[ma_the_loai];?>"></td>
    </tr>
    <tr>
      <td align="right">Vị trí trên menu : </td>
      <td colspan="2"><input name="tl_order" type="text" size="3" maxlength="3" value="<?php if(isset($_POST["tl_order"])) echo $_POST["tl_order"]; else echo $row[tl_order]; ?>"></td>
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