<?php
if($_REQUEST["dangnhap"]<>"")
{
	$ten_dang_nhap=trim($_POST["username"]);
	$mat_khau=md5(trim($_POST["pass"]));
	kt_dang_nhap($ten_dang_nhap, $mat_khau);
}
	
?>

<?php
if($_SESSION['log']['ok'])
{
?>
<div align="center">THÀNH VIÊN</div><br>
<div align="center">Xin chào thành viên:</div>
<div style="max-width:155px; overflow:hidden" align="center"><a href="?a=thaydoitt" title="Sửa thông tin cá nhân"><b><?php echo $_SESSION['log']['ten_nguoi_dung'];?></b></a></div>
<div style="max-width:155px; overflow:hidden" align="center"><a href="?a=thaydoitt" title="Sửa thông tin cá nhân"><b><?php echo $_SESSION['log']['email'];?></b></a></div>
<div align="center"><a title="Đăng xuất" onClick="confirm('Bạn thật sự muốn thoát?')" href="?a=dangxuat">Đăng xuất</a></div><br>
<?php
	$sql="select ma_nguoi_dung from playlist where ma_nguoi_dung=".$_SESSION['log']['ma_nguoi_dung'];
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	{
		
		$doc = new DOMDocument("1.0", "UTF-8");
		$doc->formatOutput = true;
		$pl = $doc->createElement( "playlist" );
		$tl = $doc->createElement( "tracklist" );
		$doc->appendChild($pl);
		$pl->appendChild($tl);		
		$t = $doc->createElement( "track" );
		$tl->appendChild($t);
		$ma = $doc->createElement('ma',"");
		$t->appendChild($ma);
		$title = $doc->createElement('title',"");
		$t->appendChild($title);
		$location = $doc->createElement('location',"");
		$t->appendChild($location);
		$doc->save("playlist/user/".$_SESSION['log']['ma_nguoi_dung'].".xml");
		$imnd=$_SESSION['log']['ma_nguoi_dung'];
		$ilink="playlist/user/".$_SESSION['log']['ma_nguoi_dung'].".xml";
		$sql="insert into playlist (ma_nguoi_dung, link) values ($imnd, '$ilink')";
		#echo $sql;
		mysql_query($sql);
		?>
		<META HTTP-EQUIV=Refresh CONTENT="1; URL=index.php">
        <?php
	}
	else
	{
		?>
		<div align="center"><a href="?a=playlist&mand=<?php echo $_SESSION['log']['ma_nguoi_dung'] ?>" title="Mở playlist cá nhân">Xem playlist ưa thích</a></div>
        <?php
	}
	
?>

<?php	
}
else
{
?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td align="center">ĐĂNG NHẬP</td>
    </tr>
    <tr>
      <td align="center">Tên đăng nhập: </td>
    </tr>
    <tr>
      <td align="center"><input name="username" type="text"  id="username" size="20"></td>
    </tr>
    <tr>
      <td align="center">Mật khẩu: </td>
    </tr>
    <tr>
      <td align="center"><input name="pass" type="password"  id="pass" size="20"></td>
    </tr>
    <tr>
      <td align="center"><input name="dangnhap" type="submit" id="dangnhap" value="Đăng Nhập"> <br>
      <a href="?a=quenmk">Quên mật khẩu?</a> </td>
    </tr>
  </table>
</form>

<?php
}
?>