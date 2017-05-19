<?php
if($_REQUEST["do"]=="del" && $_REQUEST["macs"]<>"")
{
	$ma_ca_si=$_REQUEST["macs"];
?>
<div align="center">Bạn thật sự muốn xóa không?</div>
<div align="center"><a href="?a=casi&macs=<?php echo $ma_ca_si;?>&do=del&del=ok" title="Xóa">Có</a> | <a href="?a=casi" title="Không xóa nữa">Không</a></div>

<?php	
	if($_REQUEST["del"]=="ok")
	{
		if($_SESSION['log']['ma_nguoi_dung']==18)
			xoa_ca_si($ma_ca_si);
		else
			echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=casi\">";	
	}	
}

if($_REQUEST["tim"]<>"" && trim($_POST["tencs"])<>"")
{
	$ten_ca_si=strtolower(utf8_to_ascii(id_replace($_POST["tencs"])));
	$sql1="select * from ca_si where tencs_khong_dau like '%".$ten_ca_si."%'";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from ca_si where tencs_khong_dau like '%".$ten_ca_si."%' order by cs_order limit $start, $limit";
}
else
{
	$sql1="select ma_ca_si from ca_si";
	$count=$DB->num_rows($DB->query($sql1));
	$limit=10;
	$start=$p->findstart($limit);
	$pages=$p->findpages($count, $limit);
	
	$sql="select * from ca_si order by cs_order limit $start, $limit";
}
		
$result=$DB->query($sql);
$num=$DB->num_rows($result);
if($num==0)
echo "Không có ca sĩ nào!<br>";
else
{
?>
<form action="?a=casi" method="post">
Tìm tên ca sĩ: 
  <input name="tencs" type="text" id="tencs" value="<?php if (isset($_POST["tencs"])) echo $_POST["tencs"];?>" />
  <input name="tim" type="submit" id="tim" value="Tìm" />
</form>
<?php echo "Có $count ca sĩ: <font color=red>".trim($_POST["tencs"])."</font>";?>
<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-style:solid; border-color:#607697; border-collapse:collapse">
  <tr>
    <td colspan="7" align="center">QUẢN LÝ CA SĨ (<a href="?a=themcs">Thêm ca sĩ</a>)</td>
  </tr>
  <tr>
    <td width="11%" align="center">Mã ca sĩ </td>
    <td width="11%" align="center">Vị trí </td>
    <td width="12%" align="center">Hiện/Ẩn</td>
    <td width="16%" align="center">Hình ca sĩ </td>
    <td width="36%" align="center">Tên ca sĩ </td>
    <td width="7%" align="center">sửa</td>
    <td width="7%" align="center">xóa</td>
  </tr>
  <?php
  while($row=$DB->fetch_row($result))
  {
  	$hinh="<img src='../upload_hinh/hinh_nho/".$row[hinh]."'>";
	?>
	<tr>
	<td align="center"><?php echo $row[ma_ca_si];?></td>
	<td align="center"><?php echo $row[cs_order];?></td>
	<td align="center"><?php echo $row[display];?> </td>    
	<td align="center"><?php echo $hinh;?></td>
	<td style="padding-left:5px"><?php echo $row[ten_ca_si];?></td>
	<td align="center"><a href="?a=suacs&macs=<?php echo $row[ma_ca_si];?>" title="edit">Sửa</a></td>
	<td align="center"><a href="?a=casi&macs=<?php echo $row[ma_ca_si];?>&do=del" title="delete">Xóa</a></td>
	</tr>
<?php	  
  }
  ?>
</table>
<?php
}
?>
<a href="?a=themcs" title="thêm ca sĩ">Thêm ca sĩ</a>
<p align="center">
<?php 
$list=$p->pageList($_REQUEST['page'], $pages, "?a=casi");
if($pages>1) echo $list;
?>
</p>