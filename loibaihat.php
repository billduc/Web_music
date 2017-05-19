<?php
if($_REQUEST["mabh"]<>"")
{
?>
<div class="space"></div>
<div class="spbc">
<table>
<tr>
<td>
<?php
	$sql="select * from bai_hat where ma_bai_hat=".$_REQUEST["mabh"];
	$result=$DB->query($sql);
	$row=$DB->fetch_row($result);
	if($row[loi_bai_hat] == "")
	{
		echo "Chưa có lời nhạc"; 
	}
	else
	{
?>
	<label>Lời bài hát</label>
	<textarea rows="20" name="loinhac" id="loinhac" cols="50" readonly="readonly"><?php echo $row[loi_bai_hat]; ?></textarea>
<?php
	}
?>
</td>
</tr>
</table>
</div>
<!--
<div class="space"></div>
<div class="spbc">
<table>
        <form method="post" action="" onsubmit="" name="frm_loibaihat" id="frm_loibaihat">
        <tr>
        	<td>
            	Gửi lời nhạc mới
            </td>
        </tr>
        <tr>
            <td align="center"><textarea rows="8" name="txtloi" id="txtloi" cols="45"></textarea></td>
        </tr>
        <tr>
            <td align="center"><input type="submit" value="Gửi lời nhạc" name="submit"/></td>
        </tr>
        </form>
</table>
</div>
-->
<?php
}
?>