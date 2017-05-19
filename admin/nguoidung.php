<?php
if($_REQUEST["do"]=="del" && $_REQUEST["mand"]<>"")
{
	$ma_nguoi_dung=$_REQUEST["mand"];
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=nguoidung&mand=<?php echo $ma_nguoi_dung;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=nguoidung" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_nguoi_dung($ma_nguoi_dung);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=nguoidung\">";	
	}	
}

if($_REQUEST["tim"]<>"" && trim($_POST["tendn"])<>"")
{
	$ten_dang_nhap=$_POST["tendn"];
	$sql1="select ma_nguoi_dung from nguoi_dung where ten_dang_nhap like '%".$ten_dang_nhap."%'";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from nguoi_dung where ten_dang_nhap like '%".$ten_dang_nhap."%' order by ngay_tham_gia DESC limit $start, $limit";
}
else
{
	$sql1="select ma_nguoi_dung from nguoi_dung";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from nguoi_dung order by ngay_tham_gia DESC limit $start, $limit";
}
		
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có thành viên nào!<br>";
else
{
?>
<form action="?a=nguoidung" method="post">
Tìm theo tên đăng nhập: 
  <input name="tendn" type="text" id="tendn" value="<?php if (isset($_POST["tendn"])) echo $_POST["tendn"];?>" />
  <input name="tim" type="submit" id="tim" value="Tìm" />
</form>
<?php echo "Có $count thành viên: <font color=red>".trim($_POST["tendn"])."</font>";?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse">
  <tr>
    <td colspan="9" align="center">QUẢN LÝ THÀNH VIÊN </td>
  </tr>
  <tr>
    <td width="8%" align="center">Mã người dùng </td>
    <td width="19%" align="center">Tên đăng nhập </td>
	<td width="8%" align="center">Quyền Admin </td>
    <td width="29%" align="center">Email</td>
    <td width="15%" align="center">Ngày tham gia </td>
    <td width="7%" align="center">Cấm</td>
    <td width="7%" align="center">sửa</td>
    <td width="7%" align="center">xóa</td>
  </tr>
  <?php
  while($row=$DB->fetch_row($result))
  {
  
	?>
	<tr>
	<td align="center"><?php echo $row[ma_nguoi_dung];?></td>
	<td align="left" style="padding-left:5px"><?php echo $row[ten_dang_nhap];?> </td>
	<td align="center"><?php echo $row[quyen_admin];?></td>    
	<td style="padding-left:5px"><?php echo $row[email];?></td>
	<td align="center" style="padding-left:5px"><?php echo $row[ngay_tham_gia];?></td>
	<td align="center" style="padding-left:5px"><?php echo $row[cam_su_dung];?></td>
	<td align="center"><a href="?a=suand&mand=<?php echo $row[ma_nguoi_dung];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=nguoidung&mand=<?php echo $row[ma_nguoi_dung];?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=themnd" title="thêm thành viên"></a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=nguoidung");
if($pages>1) echo $list;
?>
</p>