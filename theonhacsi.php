<?php
if($_REQUEST["mans"]<>"")
{
	$ma_nhac_si=$_REQUEST["mans"];
	
	$sqltt="select * from nhac_si where ma_nhac_si=$ma_nhac_si";
	$rowtt=$DB->fetch_row($DB->query($sqltt));
	echo"Nhạc sĩ : <font size=\"+1\">$rowtt[ten_nhac_si]<br/></font>";
	echo"Thông tin nhạc sĩ : $rowtt[tt_nhac_si]<br/>";
	echo"Hình nhạc sĩ : <img src='upload_hinh/hinh_nho/".$rowtt[hinh]."'><br><br>";
	
	$sql1="select ma_bai_hat from bai_hat where ma_nhac_si=$ma_nhac_si ";
	$result1=$DB->query($sql1);
	$count=$DB->num_rows($result1);
	$limit=15;
	$pages=$p->findpages($count, $limit);
	$start=$p->findstart($limit);
	
	$sql="select * from bai_hat, ca_si, nhac_si where bai_hat.ma_nhac_si=$ma_nhac_si and bai_hat.ma_ca_si=ca_si.ma_ca_si and bai_hat.ma_nhac_si=nhac_si.ma_nhac_si and hien = 1 limit $start, $limit";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	echo "Đang Cập Nhật";
	else
	{
		#------
		$doc = new DOMDocument("1.0", "UTF-8");
		$doc->formatOutput = true;
		$pl = $doc->createElement( "playlist" );
		$tl = $doc->createElement( "tracklist" );
		$doc->appendChild($pl);
		$pl->appendChild($tl);
		#---------
		
		$sql_ns="select ten_nhac_si from nhac_si where ma_nhac_si=$ma_nhac_si";
		$row2=$DB->fetch_row($DB->query($sql_ns));
	?>
		
		<div class="tieude" align="center">Có <?php echo $count;?> ca khúc của nhạc sĩ <b><?php echo ucfirst($row2[ten_nhac_si]);?></b> </div>
              
        <div align="center"><a href="index.php?pl=t&a=theonhacsi&mans=<?php echo $ma_nhac_si; ?>&page=<?php if(isset($_REQUEST["page"])) echo $_REQUEST["page"]; else echo "1" ?>">Nghe toàn bộ danh sách</a></div>	
        	
		<?php
		while($row=$DB->fetch_row($result))
		{
		?>
		<a href="?a=theonhacsi&mans=<?php echo $row[ma_nhac_si];?>
		<?php
		 if(isset($_REQUEST["page"])) echo "&page=".$_REQUEST["page"];
		?>
		&mabh=<?php echo $row[ma_bai_hat];?>
		"><img src="images/music.gif" />
		<?php echo ucfirst($row[ten_bai_hat]);?> <img title="Play" src="images/ten.gif" />
		</a><br />
		<div class="casi"><?php echo ucfirst($row[ten_ca_si])." (View:".$row[luot_xem].")"?></div>
		<?php
		#------------
			$t = $doc->createElement( "track" );
			$tl->appendChild($t);
			$title = $doc->createElement('title',"$row[ten_bai_hat]");
			$t->appendChild($title);
			$location = $doc->createElement('location',"$row[bai_hat]");
			$t->appendChild($location);
		#-------------
		}
		#-----
		$doc->save("playlist/plns.xml");
		#-----
		?>
		
		<p align="center">
			<?php 
			$list=$p->pageList($_REQUEST["page"], $pages, "?a=theonhacsi&mans=$ma_nhac_si"); 
			if($pages>1) echo $list;
			?>
		</p>
		
	<?php
	}	
}
?>