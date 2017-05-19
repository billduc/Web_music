<?php
if($_REQUEST["do"]=="del" && $_REQUEST["mans"]<>"")
{
	$ma_nhac_si=$_REQUEST["mans"];
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=nhacsi&mans=<?php echo $ma_nhac_si;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=nhacsi" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_nhac_si($ma_nhac_si);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=nhacsi\">";	
	}	
}

if($_REQUEST["tim"]<>"" && trim($_POST["tenns"])<>"")
{
	$ten_nhac_si=strtolower(utf8_to_ascii(id_replace($_POST["tenns"])));
	$sql1="select * from nhac_si where tenns_khong_dau like '%".$ten_nhac_si."%'";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from nhac_si where tenns_khong_dau like '%".$ten_nhac_si."%' order by ns_order limit $start, $limit";
}
else
{
	$sql1="select ma_nhac_si from nhac_si";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from nhac_si order by ns_order limit $start, $limit";
}
		
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có nhạc sĩ nào!<br>";
else
{
?>
<form action="?a=nhacsi" method="post">
Tìm tên nhạc sĩ: 
  <input name="tenns" type="text" id="tenns" value="<?php if (isset($_POST["tenns"])) echo $_POST["tenns"];?>" />
  <input name="tim" type="submit" id="tim" value="Tìm" />
</form>
<?php echo "Có $count nhạc sĩ: <font color=red>".trim($_POST["tenns"])."</font>";?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse">
  <tr>
    <td colspan="7" align="center">QUẢN LÝ NHẠC SĨ (<a href="?a=themns">Thêm nhạc sĩ</a>)</td>
  </tr>
  <tr>
    <td width="11%" align="center">Mã nhạc sĩ </td>
    <td width="11%" align="center">Vị trí </td>
    <td width="12%" align="center">Hiện/Ẩn</td>
    <td width="16%" align="center">Hình nhạc sĩ </td>
    <td width="36%" align="center">Tên nhạc sĩ </td>
    <td width="7%" align="center">sửa</td>
    <td width="7%" align="center">xóa</td>
  </tr>
  <?php
  while($row=$DB->fetch_row($result))
  {
  	$hinh="<img src='../upload_hinh/hinh_nho/".$row[hinh]."'>";
	?>
	<tr>
	<td align="center"><?php echo $row[ma_nhac_si];?></td>
	<td align="center"><?php echo $row[ns_order];?></td>
	<td align="center"><?php echo $row[display];?> </td>    
	<td align="center"><?php echo $hinh;?></td>
	<td style="padding-left:5px"><?php echo $row[ten_nhac_si];?></td>
	<td align="center"><a href="?a=suans&mans=<?php echo $row[ma_nhac_si];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=nhacsi&mans=<?php echo $row[ma_nhac_si];?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=themns" title="thêm nhạc sĩ">Thêm nhạc sĩ</a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=nhacsi");
if($pages>1) echo $list;
?>
</p>