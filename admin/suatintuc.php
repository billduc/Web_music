<?php
if($_REQUEST["suatt"]<>"")
{
	$baoloi="";
	if(trim($_POST["tieude"])=="")
	$baoloi.="Hãy nhập vào tiêu đề tin tức<br>";
	if($_POST["hinhcu"]=="" && $_FILES["hinhmoi"]["name"]=="")
	$baoloi.="Hãy chọn hình tin tức<br>";
	if(trim($_POST["noidung"])=="")
	$baoloi.="Hãy nhập vào nội dung tin tức<br>";
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			if($_POST["hinhcu"]=="" && $_FILES["hinhmoi"]["name"]<>"")
			{
				$hinh_anh=upload_hinh_tt("hinhmoi");
				Save("../upload_anhtt/".$hinh_anh, "../upload_anhtt/anh_nho/".$hinh_anh, 70);
			}
			else
			{
				$hinh_anh=$_POST["hinhcu"];
			}
			$ma_tin_tuc=$_POST["ma_tin_tuc"];
			$tieu_de=trim($_POST["tieude"]);
			$noi_dung=trim($_POST["noidung"]);
			sua_tin_tuc($ma_tin_tuc, $tieu_de, $noi_dung, $hinh_anh);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=tintuc\">";		
	}
	else
	echo "<div align=center><font color=red>".$baoloi."</font></div>";

}

if($_REQUEST["matt"]<>"")
{
	$ma_tin_tuc=$_REQUEST["matt"];
	$sql="select * from tin_tuc where ma_tin_tuc='$ma_tin_tuc'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	{
		header("Location: ?a=tintuc");
		exit();
	}
	else
		$row=$DB->fetch_row($result);
	{
	?>

<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="3" align="center">SỬA THÔNG TIN TIN TỨC </td>
    </tr>
    <tr>
      <td width="25%" align="right">Tiêu đề </td>
      <td width="75%" colspan="2"><textarea rows="3" name="tieude" id="tieude" cols="100"><?php if(isset($_POST["tieude"])) echo $_POST["tieude"]; else echo $row[tieu_de];?></textarea><input name="ma_tin_tuc" type="hidden" id="ma_tin_tuc" value="<?php echo $row[ma_tin_tuc];?>"></td>
    </tr>
    <tr>
      <td align="right">Hình tin tức</td>
      <td width="12%" ><img src="<?php echo "../upload_anhtt/anh_nho/".$row[hinh_anh]; ?>"></td>
      <td width="46%"><input name="hinhcu" type="checkbox" id="hinhcu" value="<?php echo $row[hinh_anh];?>" checked="checked">
      Dùng hình này </td>
    </tr>
    <tr>
      <td align="right">Chọn hình khác : </td>
      <td colspan="2"><input name="hinhmoi" type="file" id="hinhmoi"></td>
    </tr>
    <tr>
		<td></td>
        <td colspan="2"><a href="uploadanh.php" onclick="window.open('uploadanh.php', '_blank'); return false;">Công cụ Upload</a>
        </td>
    </tr>
    <tr>
    	<td>Viết bài
    	</td>
        <td colspan="2">
        	<div class="spbc">
      			<textarea class="editor" id="editor" name="editor" rows="30" cols="118"></textarea>
       			<script type="text/javascript" language="javascript">
                                CKEDITOR.replace( 'editor',
									{
										uiColor: '#9F3',
										language: 'vi',
										skin : 'office2003'
									}
									);
                            </script>
    		</div>
        </td>
    </tr>
    <tr>
      <td width="19%" align="right">Copy nội dung bài viết vào </td>
      <td width="81%" colspan="2"><textarea rows="5" name="noidung" id="noidung" cols="120"><?php if(isset($_POST["noidung"])) echo $_POST["noidung"]; else echo $row[noi_dung];?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><input name="suatt" type="submit" id="suatt" value="Xác nhận"></td>
    </tr>
  </table>
</form>
<?php
}}
?>