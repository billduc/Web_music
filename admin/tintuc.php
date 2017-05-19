<?php
if($_REQUEST["do"]=="del" && $_REQUEST["matt"]<>"")
{
	$ma_tin_tuc=$_REQUEST["matt"];
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=tintuc&matt=<?php echo $ma_tin_tuc;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=tintuc" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_tin_tuc($ma_tin_tuc);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=tintuc\">";	
	}	
}



$sql1="select ma_tin_tuc from tin_tuc";
$count=$DB->num_rows($DB->query($sql1));
$limit=5;
$start=$p->findstart($limit);
$pages=$p->findpages($count, $limit);
$sql="select * from tin_tuc order by ma_tin_tuc DESC limit $start, $limit";	
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có tin tức nào!<br>";
else
{
?>
<?php echo "Có $num tin tức."?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse">
  <tr>
    <td colspan="4" align="center">QUẢN LÝ TIN TỨC (<a href="?a=themtt">Thêm tin tức</a>)</td>
  </tr>
  <tr>
    <td width="11%" align="center">Mã tin tức </td>
    <td width="75%" align="center">Tiêu đề </td>
    <td width="7%" align="center">sửa</td>
    <td width="7%" align="center">xóa</td>
  </tr>
  <?php
  while($row=$DB->fetch_row($result))
  {
	?>
	<tr>
	<td align="center"><?php echo $row[ma_tin_tuc];?></td>
	<td align="center"><?php echo $row[tieu_de];?></td>
	<td align="center"><a href="?a=suatt&matt=<?php echo $row[ma_tin_tuc];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=tintuc&matt=<?php echo $row[ma_tin_tuc];?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=themtt" title="thêm tin tức">Thêm tin tức</a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=tintuc");
if($pages>1) echo $list;
?>
</p>