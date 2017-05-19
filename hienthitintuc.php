<?php
if($_REQUEST["matt"]<>"")
{
	$ma_tin_tuc=$_REQUEST["matt"];
	$sql="select * from tin_tuc where ma_tin_tuc=$ma_tin_tuc";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num<>0)
	{
		$row=$DB->fetch_row($result);			
?>
<div class="spbc">
<table>
<tr>
<td align="left" width="80%">
<font color="#00FFFF" size="+3">
<?php echo $row[tieu_de] ?>
</font>
</td>
<td align="right" width="20%">
<img src="upload_anhtt/<?php echo $row[hinh_anh] ?>" height="200">
</td>
</tr>

<tr>
<td align="left" colspan="2">
<div>
<?php echo $row[noi_dung] ?>
</div>
</td>
</tr>
</table>
</div>
<?php
	}
}
?>