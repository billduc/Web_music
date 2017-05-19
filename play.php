<?php
if($_SESSION['log']['ok'])
{
	if($_REQUEST["themvao"]<>"")
	{
		$xml = simplexml_load_file("playlist/user/".$_SESSION['log']['ma_nguoi_dung'].".xml");
		$sxe = new SimpleXMLElement($xml->asXML());
		$tracklist=$sxe->addChild("tracklist");
		$track = $tracklist->addChild("track");	 
		$track->addChild("ma", $_REQUEST["ma_bai_hat"]); 
		$track->addChild("title", $_REQUEST["ten_bai_hat"]); 
		$track->addChild("location", $_REQUEST["bai_hat"]); 
		
		$sxe->asXML("playlist/user/".$_SESSION['log']['ma_nguoi_dung'].".xml"); 
	
	}
}
if($_REQUEST["mabh"]<>"")
{
	$ma_bai_hat=$_REQUEST["mabh"];
	$sql="select bai_hat.ma_bai_hat as ma_bai_hat,bai_hat.ma_ca_si as ma_ca_si, bai_hat.ma_nhac_si as ma_nhac_si, bai_hat.ma_album as ma_album, bai_hat.ma_the_loai as ma_the_loai, bai_hat.ma_quoc_gia as ma_quoc_gia, bai_hat.ma_nguoi_dung as ma_nguoi_dung, ten_bai_hat as ten_bai_hat, tenbh_khong_dau as tenbh_khong_dau, bai_hat as bai_hat, loi_bai_hat as loi_bai_hat, luot_xem as luot_xem, ca_si.ten_ca_si as ten_ca_si, ca_si.hinh as hinhcs, nhac_si.ten_nhac_si as ten_nhac_si, nhac_si.hinh as hinhns, album.ten_album as ten_album, album.hinh as hinhab, the_loai.ten_the_loai as ten_the_loai, quoc_gia.ten_quoc_gia as ten_quoc_gia, nguoi_dung.ten_dang_nhap as ten_dang_nhap
			from bai_hat, ca_si, nhac_si, album, the_loai, quoc_gia, nguoi_dung 
			where ma_bai_hat=$ma_bai_hat
			AND bai_hat.ma_ca_si=ca_si.ma_ca_si 
			AND nhac_si.ma_nhac_si=bai_hat.ma_nhac_si 
			AND album.ma_album=bai_hat.ma_album 
			AND the_loai.ma_the_loai=bai_hat.ma_the_loai 
			AND quoc_gia.ma_quoc_gia=bai_hat.ma_quoc_gia 
			AND nguoi_dung.ma_nguoi_dung=bai_hat.ma_nguoi_dung";
	$result=$DB->query($sql);
	$row=$DB->fetch_row($result);	
?>
	<div id="mediaplayer">Trình player nhạc</div>
	<script type="text/javascript" src="jw/jwplayer.js"></script>
	<script type="text/javascript">
		jwplayer("mediaplayer").setup({
			flashplayer: "jw/player.swf",
			file: "<?php echo $row[bai_hat] ?>",
			image: "images/imgdefault.jpg",
			width: 300,
			height: 300,
			controlbar: { position:'bottom'},
			start: true,
			autostart: true,
			skin: "jw/skins/lionslight.zip",
			repeat: 'always'

		});
	</script>
<?php			
	echo "<p align=center>Ca khúc: <b>".$row[ten_bai_hat]."</b>";
	echo"<br>Thể hiện:<a href=\"index.php?a=theocasi&macs=$row[ma_ca_si]\"><b>".$row[ten_ca_si]."</b></a><img src='upload_hinh/hinh_nho/".$row[hinhcs]."'>";
	echo"<br>Sáng tác:<a href=\"index.php?a=theonhacsi&mans=$row[ma_nhac_si]\"><b>".$row[ten_nhac_si]."</b></a><img src='upload_hinh/hinh_nho/".$row[hinhns]."'>";
	echo"<br>Album:<a href=\"index.php?a=theoalbum&maab=$row[ma_album]\"><b>".$row[ten_album]."</b></a><img src='upload_hinh/hinh_nho/".$row[hinhab]."'>";
	echo"<br>Thể loại:<a href=\"index.php?a=theotheloai&matl=$row[ma_the_loai]\"><b>".$row[ten_the_loai]."</b></a>";
	echo"<br>Quốc gia:<a href=\"index.php?a=theoquocgia&maqg=$row[ma_quoc_gia]\"><b>".$row[ten_quoc_gia]."</b></a>";
	echo"<br>Người upload:<b>".$row[ten_dang_nhap]."</b>";
	echo"<br>Lượt nghe:<b>".$row[luot_xem]."</b>";
	echo"<br><br><a href=\"".$row[bai_hat]."\">Download</a></p>";
	$count=$row[luot_xem];
	$count++;
	$sql_update="update bai_hat set luot_xem=$count where ma_bai_hat=$ma_bai_hat";
	$DB->query($sql_update);
	#---------------
	if($_SESSION['log']['ok'])
	{
?>		
		<form action="" method="post">
        	<input type="submit" value="Thêm vào playlist ưa thích" name="themvao" />
            <input type="hidden" name="ma_bai_hat" value="<?php echo $row[ma_bai_hat] ?>" />
			<input type="hidden" name="ten_bai_hat" value="<?php echo $row[ten_bai_hat] ?>" />
            <input type="hidden" name="bai_hat" value="<?php echo $row[bai_hat] ?>" />
        </form>
<?php
	}
	#---------------		
}
else if($_REQUEST["pl"]=="t" && $_REQUEST["a"]<>"playlist")
{
?>
	<div id="mediaplayer">Trình player nhạc</div>
	<script type="text/javascript" src="jw/jwplayer.js"></script>
	<script type="text/javascript">
		jwplayer("mediaplayer").setup({
			flashplayer: "jw/player.swf",
			
<?php
	if($_REQUEST["a"]=="theotheloai")
	{
		echo"playlistfile: \"playlist/pltl.xml\",";
	}
	else if($_REQUEST["a"]=="topview")
	{
		echo"playlistfile: \"playlist/pltv.xml\",";
	}
	else if($_REQUEST["a"]=="theoquocgia")
	{
		echo"playlistfile: \"playlist/plqg.xml\",";
	}
	else if($_REQUEST["a"]=="theonhacsi")
	{
		echo"playlistfile: \"playlist/plns.xml\",";
	}
	else if($_REQUEST["a"]=="theocasi")
	{
		echo"playlistfile: \"playlist/plcs.xml\",";
	}
	else if($_REQUEST["a"]=="theoalbum")
	{
		echo"playlistfile: \"playlist/plab.xml\",";
	}
	else
	{
		echo"playlistfile: \"playlist/pltv.xml\",";
	}			
?>
			"playlist.position": "bottom", 
 	        "playlist.size": 200, 
			image: "images/imgdefault.jpg",
			width: 300,
			height: 463,
			controlbar: { position:'bottom'},
			start: true,
			autostart: true,
			skin: "jw/skins/lionslight.zip",
			repeat: 'always'

		});
	</script>
<?php    
}
else if($_REQUEST["pl"]=="t" && $_REQUEST["a"]=="playlist")
{
	if($_REQUEST["mand"]<>"")
	{
		$ma_nguoi_dung=$_REQUEST["mand"];
		$sqlnd="select * from playlist where ma_nguoi_dung=$ma_nguoi_dung";
		$rownd=$DB->fetch_row($DB->query($sqlnd));
	}
	else
		echo"Không lấy được mand";	
	#echo $rownd[link]; 
?>
	<div id="mediaplayer">Trình player nhạc</div>
	<script type="text/javascript" src="jw/jwplayer.js"></script>
	<script type="text/javascript">
		jwplayer("mediaplayer").setup({
			flashplayer: "jw/player.swf",
			playlistfile: "<?php echo $rownd[link]; ?>",
			"playlist.position": "bottom", 
 	        "playlist.size": 200, 
			image: "images/imgdefault.jpg",
			width: 300,
			height: 463,
			controlbar: { position:'bottom'},
			start: true,
			autostart: true,
			skin: "jw/skins/lionslight.zip",
			repeat: 'always'

		});
	</script>
<?php    
}
else
{
?>
	<div id="mediaplayer">Trình player nhạc</div>
	<script type="text/javascript" src="jw/jwplayer.js"></script>
	<script type="text/javascript">
		jwplayer("mediaplayer").setup({
			flashplayer: "jw/player.swf",
			image: "images/imgdefault.jpg",
			width: 300,
			height: 300,
			controlbar: { position:'bottom'},
			start: true,
			autostart: true,
			skin: "jw/skins/lionslight.zip",
			repeat: 'always'
		});
	</script>
<?php
}
?>


