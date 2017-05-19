<?php
if($_REQUEST["do"]=="del" && $_REQUEST["mabh"]<>"")
{
	$ma_bai_hat=$_REQUEST["mabh"];
	$page=$_REQUEST["page"];
	
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=baihat&mabh=<?php echo $ma_bai_hat;?>&page=<?php echo $page;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=baihat" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_bai_hat($ma_bai_hat, $page);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=baihat\">";	
	}	
}

if($_REQUEST["tim"]<>"" && trim($_POST["tenbh"])<>"")
{
	$ten_bai_hat=strtolower(utf8_to_ascii(id_replace($_POST["tenbh"])));
	$sql1="select ma_bai_hat from bai_hat where tenbh_khong_dau like '%".$ten_bai_hat."%'";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from bai_hat, nguoi_dung where bai_hat.ma_nguoi_dung=nguoi_dung.ma_nguoi_dung AND tenbh_khong_dau like '%".$ten_bai_hat."%' order by ngay_dang DESC limit $start, $limit";
}
else
{
	$sql1="select ma_bai_hat from bai_hat";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from bai_hat, nguoi_dung where bai_hat.ma_nguoi_dung=nguoi_dung.ma_nguoi_dung order by ngay_dang DESC, ma_bai_hat DESC limit $start, $limit";
}
#echo $sql;		
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có bài hát nào!<br>";
else
{
?>
<form action="?a=baihat" method="post">
Tìm tên bài hát: 
  <input name="tenbh" type="text" id="tenbh" value="<?php if (isset($_POST["tenbh"])) echo $_POST["tenbh"];?>" />
  <input name="tim" type="submit" id="tim" value="Tìm" />
</form>
<?php echo "Có $count bài hát: <font color=red>".trim($_POST["tenbh"])."</font>";?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse;">
  <tr>
    <td colspan="8" align="center">QUẢN LÝ BÀI HÁT(<a href="?a=thembh">Thêm bài hát</a>)</td>
  </tr>
  <tr>
    <td width="5%" align="center">Mã bài hát </td>
    <td width="30%" align="center">Tên bài hát </td>
    <td width="22%" align="center">Tên người đăng </td>
    <td width="19%" align="center">Ngày đăng </td>
    <td width="6%" align="center">Lượt nghe </td>
    <td width="6" align="center">Hiện</td>
    <td width="6%" align="center">sửa</td>
    <td width="6%" align="center">xóa</td>
  </tr>
  <?php
	if($_REQUEST["page"]=="")
		$page=1;
	else
		$page=$_REQUEST["page"];
		
  while($row=$DB->fetch_row($result))
  {
  	
	?>
	<tr>
	<td align="center"><?php echo $row[ma_bai_hat];?></td>
	<td align="left" style="padding-left:5px"><?php echo $row[ten_bai_hat];?></td>
	<td align="left" style="padding-left:5px"><?php echo $row[ten_nguoi_dung];?> </td>    
	<td align="center"><?php echo $row[ngay_dang];?></td>
	<td align="center"><?php echo $row[luot_xem];?></td>
    <td align="center"><?php echo $row[hien]?></td>
	<td align="center"><a href="?a=suabh&mabh=<?php echo $row[ma_bai_hat];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=baihat&mabh=<?php echo $row[ma_bai_hat];?>&page=<?php echo $page;?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=thembh" title="thêm bài hát">Thêm bài hát</a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=baihat");
if($pages>1) echo $list;
?>
</p>