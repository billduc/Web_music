<?php 
if($_REQUEST["themtt"]<>"")
{
	$baoloi="";
	$tieu_de=trim($_POST["tieude"]);
	$noi_dung=trim($_POST["noidung"]);
	if($tieu_de=="")
	$baoloi.="Hãy nhập vào tiêu đề tin tức<br>";
	if($_FILES["hinhtt"]["name"]=="")
	$baoloi.="Hãy chọn hình của tin tức<br>";
	if($noi_dung=="")
	$baoloi.="Hãy nhập vào nội dung tin tức<br>";
	if($baoloi=="")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
		{
			$hinh_anh=upload_hinh_tt("hinhtt");
			Save("../upload_anhtt/".$hinh_anh, "../upload_anhtt/anh_nho/".$hinh_anh, 70);
			them_tin_tuc($tieu_de, $noi_dung, $hinh_anh);
		}
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=album\">";		
	}
	else echo "<div class='error_text' align=center>".$baoloi."</div>";	
}
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2" align="center">THÊM TIN TỨC </td>
    </tr>
    <tr>
      <td width="25%" align="right">Tiêu đề </td>
      <td width="75%"><textarea rows="3" name="tieude" id="tieude" cols="100"></textarea></td>
    </tr>
    <tr>
      <td align="right">Hình tin tức </td>
      <td><input name="hinhtt" type="file" id="hinhtt"></td>
    </tr>
    <tr>
		<td></td>
        <td><a href="uploadanh.php" onclick="window.open('uploadanh.php', '_blank'); return false;">Công cụ Upload</a>
        </td>
    </tr>
    <tr>
    	<td>Viết bài
    	</td>
        <td>
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
      <td width="25%" align="right">Copy nội dung bài viết vào </td>
      <td width="75%"><textarea rows="5" name="noidung" id="noidung" cols="120"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="themtt" type="submit" id="themtt" value="Xác nhận"></td>
    </tr>
  </table>
</form>

