<?php
if($_REQUEST["do"]=="del" && $_REQUEST["maab"]<>"")
{
	$ma_album=$_REQUEST["maab"];
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=album&maab=<?php echo $ma_album;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=album" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_album($ma_album);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=album\">";		
	}			
}

if($_REQUEST["tim"]<>"" && trim($_POST["tenab"])<>"")
{
	$ten_album=strtolower(utf8_to_ascii(id_replace($_POST["tenab"])));
	$sql1="select * from album where tenab_khong_dau like '%".$ten_album."%'";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from album where tenab_khong_dau like '%".$ten_album."%' order by ab_order limit $start, $limit";
}
else
{
	$sql1="select ma_album from album";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from album order by ab_order limit $start, $limit";
}
		
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có album nào!<br>";
else
{
?>
<form action="?a=album" method="post">
Tìm tên Album: 
  <input name="tenab" type="text" id="tenab" value="<?php if (isset($_POST["tenab"])) echo $_POST["tenab"];?>" />
  <input name="tim" type="submit" id="tim" value="Tìm" />
</form>
<?php echo "Có $count Album: <font color=red>".trim($_POST["tenab"])."</font>";?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse">
  <tr>
    <td colspan="7" align="center">QUẢN LÝ ALBUM (<a href="?a=themab">Thêm Album</a>)</td>
  </tr>
  <tr>
    <td width="11%" align="center">Mã Album </td>
    <td width="11%" align="center">Vị trí </td>
    <td width="12%" align="center">Hiện/Ẩn</td>
    <td width="16%" align="center">Hình Album </td>
    <td width="36%" align="center">Tên Album </td>
    <td width="7%" align="center">sửa</td>
    <td width="7%" align="center">xóa</td>
  </tr>
  <?php
  while($row=$DB->fetch_row($result))
  {
  	$hinh="<img src='../upload_hinh/hinh_nho/".$row[hinh]."'>";
	?>
	<tr>
	<td align="center"><?php echo $row[ma_album];?></td>
	<td align="center"><?php echo $row[ab_order];?></td>
	<td align="center"><?php echo $row[display];?> </td>    
	<td align="center"><?php echo $hinh;?></td>
	<td style="padding-left:5px"><?php echo $row[ten_album];?></td>
	<td align="center"><a href="?a=suaab&maab=<?php echo $row[ma_album];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=album&maab=<?php echo $row[ma_album];?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=themab" title="thêm album">Thêm Album</a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=album");
if($pages>1) echo $list;
?>
</p>