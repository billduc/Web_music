<?php
if($_REQUEST["sua"]<>"")
{
	$baoloi="";
	if(trim($_POST["tenns"])=="")
	$baoloi.="Hãy nhập vào tên của nhạc sĩ<br>";
	if($_POST["hinhcu"]=="" && $_FILES["hinhmoi"]["name"]=="")
	$baoloi.="Hãy chọn hình nhạc sĩ<br>";
	if(!is_numeric($_POST["ns_order"]))
	$baoloi.="Vị trí trên menu phải là số!<br>";
	if($_POST["hinhcu"]<>"" && $_FILES["hinhmoi"]["name"]<>"")
	$baoloi.="Chỉ được check dấu chọn hình cũ hoặc thêm hình mới<br>";
	if($_POST["ttnhacsi"]=="")
	$baoloi.="Bạn chưa điền thông tin nhạc sĩ<br>";
	if($_FILES["hinhmoi"]["name"]<>"")
		{
			if(strtolower($_FILES["hinhmoi"]["type"])<>"image/jpeg"&&strtolower($_FILES["hinhmoi"]["type"])<>"image/gif"&&strtolower($_FILES["hinhmoi"]["type"])<>"image/png")
				$baoloi.="Chỉ được upload file jpg, gif, png";
		}
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			if($_POST["hinhcu"]=="" && $_FILES["hinhmoi"]["name"]<>"")
			{
				$hinh=upload_hinh_cs("hinhmoi");
				Save("../upload_hinh/".$hinh, "../upload_hinh/hinh_nho/".$hinh, 70);
			}
			else
			{
				$hinh=$_POST["hinhcu"];
			}
			$ma_nhac_si=$_POST["ma_ns"];
			$ten_nhac_si=trim($_POST["tenns"]);
			$ns_order=$_POST["ns_order"]; 
			$display=$_POST["display"];
			$ttnhacsi=$_POST["ttnhacsi"];
			sua_tt_nhac_si($ma_nhac_si, $ten_nhac_si, $hinh, $ns_order, $display, $ttnhacsi);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=nhacsi\">";		
	}
	else
	echo "<div align=center><font color=red>".$baoloi."</font></div>";

}

if($_REQUEST["mans"]<>"")
{
	$ma_nhac_si=$_REQUEST["mans"];
	$sql="select * from nhac_si where ma_nhac_si='$ma_nhac_si'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	{
		header("Location: ?a=nhacsi");
		exit();
	}
	else
		$row=$DB->fetch_row($result);
	{
	?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="64%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="3" align="center">SỬA THÔNG TIN NHẠC SĨ </td>
    </tr>
    <tr>
      <td width="42%" align="right">Tên nhạc sĩ : </td>
      <td colspan="2"><input name="tenns" type="text" id="tenns" value="<?php if(isset($_POST["tenns"])) echo $_POST["tenns"]; else echo $row[ten_nhac_si];?>" size="30" maxlength="30">
      <input name="ma_ns" type="hidden" id="ma_ns" value="<?php echo $row[ma_nhac_si];?>"></td>
    </tr>
    <tr>
      <td align="right">Vị trí trên menu : </td>
      <td colspan="2"><input name="ns_order" type="text" size="3" maxlength="3" value="<?php if(isset($_POST["ns_order"])) echo $_POST["ns_order"]; else echo $row[ns_order]; ?>"></td>
    </tr>
    <tr>
      <td align="right">Hiển thị trên menu : </td>
      <td colspan="2"><select name="display" id="display">
        <option value="1" <?php if($row[display]==1) echo "selected='selected'";?>>-Hiện-</option>
        <option value="0" <?php if($row[display]==0) echo "selected='selected'";?>>-Ẩn-</option>
      </select>      </td>
    </tr>
    <tr>
      <td align="right">Hình nhạc sĩ : </td>
      <td width="12%"><img src="<?php echo "../upload_hinh/hinh_nho/".$row[hinh]; ?>"></td>
      <td width="46%"><input name="hinhcu" type="checkbox" id="hinhcu" value="<?php echo $row[hinh];?>" checked="checked">
      Dùng hình này </td>
    </tr>
    <tr>
      <td align="right">Chọn hình khác : </td>
      <td colspan="2"><input name="hinhmoi" type="file" id="hinhmoi"></td>
    </tr>
    <tr>
      <td width="25%" align="right">Thông tin nhạc sĩ </td>
      <td width="75%" colspan="2"><textarea rows="10" name="ttnhacsi" id="ttnhacsi" cols="50"><?php if(isset($_POST["ttnhacsi"])) echo $_POST["ttnhacsi"]; else echo $row[tt_nhac_si]; ?></textarea></td>
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