<?php
if($_SESSION['log']['ok'])
{
	if($_REQUEST["xoa"]<>"")
	{
		$tt = $_REQUEST["stt"];
		$doc = new DOMDocument;
		$doc->load("playlist/user/".$_SESSION['log']['ma_nguoi_dung'].".xml");
		$playlist = $doc->documentElement;
		$tracklist = $playlist->getElementsByTagName("tracklist")->item($tt);
		$oldtracklist = $playlist->removeChild($tracklist);
		$doc->save("playlist/user/".$_SESSION['log']['ma_nguoi_dung'].".xml");
	}
}
if($_SESSION['log']['ok'])
{
	#echo $_SESSION['log']['ma_nguoi_dung'];
	#echo $_REQUEST["mand"];
	if($_REQUEST["mand"]<>"")
{
	$ma_nguoi_dung=$_REQUEST["mand"];
?>
	<div align="center"><a href="index.php?pl=t&a=playlist&mand=<?php echo $ma_nguoi_dung; ?>">Nghe toàn bộ danh sách</a></div>	
<?php
	$stt=0;
	$sqlnd="select * from playlist where ma_nguoi_dung=$ma_nguoi_dung";
	$rownd=$DB->fetch_row($DB->query($sqlnd));
	$trackarr=array();
	$path=$rownd[link];
	$dom = new DOMDocument();
	$dom->load($path);
	$tracks = $dom->getElementsByTagName("track");
	foreach($tracks as $track)
	{
		if($track->childNodes->length)
		{
			foreach($track->childNodes as $i) 
			{
				if(is_numeric($i->nodeValue))
					{
						$stt++;
						#echo $stt;
						$ma_bai_hat=$i->nodeValue;
						$sql="select * from bai_hat, ca_si where bai_hat.ma_ca_si=ca_si.ma_ca_si and ma_bai_hat=$ma_bai_hat";
						$result=$DB->query($sql);
						$row=$DB->fetch_row($result);
						?>
						<a href="?a=playlist&mand=<?php echo $ma_nguoi_dung; ?>&mabh=<?php echo $row[ma_bai_hat];?>
						"><img src="images/music.gif" />
						<?php echo ucfirst($row[ten_bai_hat]);?> <img title="Play" src="images/ten.gif" />			
						</a><br />
						<div class="casi"><?php echo ucfirst($row[ten_ca_si])." (View:".$row[luot_xem].")"?></div>
                        <div align="right">
                        	<form action="" method="post">
                            	<input type="submit" name="xoa" value="Xóa khỏi playlist" />
                                <input type="hidden" name="stt" value="<?php echo $stt; ?>" />
                            </form>
                        </div>
                        <?php
					}
			}
		}
	}
?>	
<?php
}
}?>