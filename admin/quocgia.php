<?php
if($_REQUEST["do"]=="del" && $_REQUEST["maqg"]<>"")
{
	$ma_quoc_gia=$_REQUEST["maqg"];
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=quocgia&maqg=<?php echo $ma_quoc_gia;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=quocgia" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_quoc_gia($ma_quoc_gia);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=quocgia\">";	
	}	
}

if($_REQUEST["tim"]<>"" && trim($_POST["tenqg"])<>"")
{
	$ten_quoc_gia=strtolower(utf8_to_ascii(id_replace($_POST["tenqg"])));
	$sql1="select * from quoc_gia where tenqg_khong_dau like '%".$ten_quoc_gia."%'";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from quoc_gia where tenqg_khong_dau like '%".$ten_quoc_gia."%' order by qg_order limit $start, $limit";
}
else
{
	$sql1="select ma_quoc_gia from quoc_gia";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from quoc_gia order by qg_order limit $start, $limit";
}
		
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có quốc gia nào!<br>";
else
{
?>
<form action="?a=quocgia" method="post">
Tìm tên quốc gia: 
  <input name="tenqg" type="text" id="tenqg" value="<?php if (isset($_POST["tenqg"])) echo $_POST["tenqg"];?>" />
  <input name="tim" type="submit" id="tim" value="Tìm" />
</form>
<?php echo "Có $count quốc gia: <font color=red>".trim($_POST["tenqg"])."</font>";?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse">
  <tr>
    <td colspan="7" align="center">QUẢN LÝ CÁC QUỐC GIA (<a href="?a=themqg">Thêm quốc gia</a>)</td>
  </tr>
  <tr>
    <td width="11%" align="center">Mã quốc gia </td>
    <td width="11%" align="center">Vị trí </td>
    <td width="12%" align="center">Hiện/Ẩn</td>
    <td width="36%" align="center">Tên quốc gia </td>
    <td width="7%" align="center">sửa</td>
    <td width="7%" align="center">xóa</td>
  </tr>
  <?php
  while($row=$DB->fetch_row($result))
  {
  
	?>
	<tr>
	<td align="center"><?php echo $row[ma_quoc_gia];?></td>
	<td align="center"><?php echo $row[qg_order];?></td>
	<td align="center"><?php echo $row[display];?> </td>    
	<td style="padding-left:5px"><?php echo $row[ten_quoc_gia];?></td>
	<td align="center"><a href="?a=suaqg&maqg=<?php echo $row[ma_quoc_gia];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=quocgia&maqg=<?php echo $row[ma_quoc_gia];?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=themqg" title="thêm quốc gia">Thêm quốc gia</a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=quocgia");
if($pages>1) echo $list;
?>
</p>