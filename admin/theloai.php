<?php
if($_REQUEST["do"]=="del" && $_REQUEST["matl"]<>"")
{
	$ma_the_loai=$_REQUEST["matl"];
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=theloai&matl=<?php echo $ma_the_loai;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=theloai" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_the_loai($ma_the_loai);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=theloai\">";	
	}	
}

if($_REQUEST["tim"]<>"" && trim($_POST["tentl"])<>"")
{
	$ten_the_loai=strtolower(utf8_to_ascii(id_replace($_POST["tentl"])));
	$sql1="select * from the_loai where tentl_khong_dau like '%".$ten_the_loai."%'";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from the_loai where tentl_khong_dau like '%".$ten_the_loai."%' order by tl_order limit $start, $limit";
}
else
{
	$sql1="select ma_the_loai from the_loai";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from the_loai order by tl_order limit $start, $limit";
}
		
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có thể loại nào!<br>";
else
{
?>
<form action="?a=theloai" method="post">
Tìm tên thể loại: 
  <input name="tentl" type="text" id="tentl" value="<?php if (isset($_POST["tentl"])) echo $_POST["tentl"];?>" />
  <input name="tim" type="submit" id="tim" value="Tìm" />
</form>
<?php echo "Có $count thể loại: <font color=red>".trim($_POST["tentl"])."</font>";?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse">
  <tr>
    <td colspan="7" align="center">QUẢN LÝ THỂ LOẠI NHẠC (<a href="?a=themtl">Thêm thể loại</a>)</td>
  </tr>
  <tr>
    <td width="11%" align="center">Mã thể loại </td>
    <td width="11%" align="center">Vị trí </td>
    <td width="12%" align="center">Hiện/Ẩn</td>
    <td width="36%" align="center">Tên thể loại </td>
    <td width="7%" align="center">sửa</td>
    <td width="7%" align="center">xóa</td>
  </tr>
  <?php
  while($row=$DB->fetch_row($result))
  {
  
	?>
	<tr>
	<td align="center"><?php echo $row[ma_the_loai];?></td>
	<td align="center"><?php echo $row[tl_order];?></td>
	<td align="center"><?php echo $row[display];?> </td>    
	<td style="padding-left:5px"><?php echo $row[ten_the_loai];?></td>
	<td align="center"><a href="?a=suatl&matl=<?php echo $row[ma_the_loai];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=theloai&matl=<?php echo $row[ma_the_loai];?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=themtl" title="thêm thể loại">Thêm thể loại</a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=theloai");
if($pages>1) echo $list;
?>
</p>