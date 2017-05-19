<?php
if($_REQUEST["sua"]<>"")
{
	$baoloi="";
	if(trim($_POST["tenab"])=="")
	$baoloi.="Hãy nhập vào tên của Album<br>";
	if($_POST["hinhcu"]=="" && $_FILES["hinhmoi"]["name"]=="")
	$baoloi.="Hãy chọn hình Album<br>";
	if(!is_numeric($_POST["ab_order"]))
	$baoloi.="Vị trí trên menu phải là số!<br>";
	if($_POST["hinhcu"]<>"" && $_FILES["hinhmoi"]["name"]<>"")
	$baoloi.="Chỉ được check dấu chọn hình cũ hoặc thêm hình mới<br>";
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
			$ma_album=$_POST["ma_ab"];
			$ten_album=trim($_POST["tenab"]);
			$ab_order=$_POST["ab_order"]; 
			$display=$_POST["display"];
			
			sua_album($ma_album, $ten_album, $hinh, $ab_order, $display);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=album\">";		
	}
	else
	echo "<div align=center><font color=red>".$baoloi."</font></div>";

}

if($_REQUEST["maab"]<>"")
{
	$ma_album=$_REQUEST["maab"];
	$sql="select * from album where ma_album='$ma_album'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	{
		header("Location: ?a=album");
		exit();
	}
	else
		$row=$DB->fetch_row($result);
	{
	?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="66%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="3" align="center">SỬA THÔNG TIN ALBUM </td>
    </tr>
    <tr>
      <td width="42%" align="right">Tên Album : </td>
      <td colspan="2"><input name="tenab" type="text" id="tenab" value="<?php if(isset($_POST["tenab"])) echo $_POST["tenab"]; else echo $row[ten_album];?>" size="30" maxlength="30">
      <input name="ma_ab" type="hidden" id="ma_ab" value="<?php echo $row[ma_album];?>"></td>
    </tr>
    <tr>
      <td align="right">Vị trí trên menu : </td>
      <td colspan="2"><input name="ab_order" type="text" size="3" maxlength="3" value="<?php if(isset($_POST["ab_order"])) echo $_POST["ab_order"]; else echo $row[ab_order]; ?>"></td>
    </tr>
    <tr>
      <td align="right">Hiển thị trên menu : </td>
      <td colspan="2"><select name="display" id="display">
        <option value="1" <?php if($row[display]==1) echo "selected='selected'";?>>-Hiện-</option>
        <option value="0" <?php if($row[display]==0) echo "selected='selected'";?>>-Ẩn-</option>
      </select>      </td>
    </tr>
    <tr>
      <td align="right">Hình Album : </td>
      <td width="12%"><img src="<?php echo "../upload_hinh/hinh_nho/".$row[hinh]; ?>"></td>
      <td width="46%"><input name="hinhcu" type="checkbox" id="hinhcu" value="<?php echo $row[hinh];?>" checked="checked">
      Dùng hình này </td>
    </tr>
    <tr>
      <td align="right">Chọn hình khác : </td>
      <td colspan="2"><input name="hinhmoi" type="file" id="hinhmoi"></td>
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