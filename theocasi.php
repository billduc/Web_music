<?php
if($_REQUEST["macs"]<>"")
{
	$ma_ca_si=$_REQUEST["macs"];
	
	$sqltt="select * from ca_si where ma_ca_si=$ma_ca_si";
	$rowtt=$DB->fetch_row($DB->query($sqltt));
	echo"Ca sĩ : <font size=\"+1\">$rowtt[ten_ca_si]<br/></font>";
	echo"Thông tin ca sĩ : $rowtt[tt_ca_si]<br/>";
	echo"Hình ca sĩ : <img src='upload_hinh/hinh_nho/".$rowtt[hinh]."'><br><br>";
	
	$sql1="select ma_bai_hat from bai_hat where ma_ca_si=$ma_ca_si ";
	$result1=$DB->query($sql1);
	$count=$DB->num_rows($result1);
	$limit=15;
	$pages=$p->findpages($count, $limit);
	$start=$p->findstart($limit);
	
	$sql="select * from bai_hat, ca_si where bai_hat.ma_ca_si=$ma_ca_si and bai_hat.ma_ca_si=ca_si.ma_ca_si and hien = 1 limit $start, $limit";
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
		
		$sql_cs="select ten_ca_si, hinh from ca_si where ma_ca_si=$ma_ca_si";
		$row2=$DB->fetch_row($DB->query($sql_cs));
		
		?>
		
		<div class="tieude" align="center">Có <?php echo $count;?> ca khúc của ca sĩ <b> <a href="#" title="Xem hình ca sĩ"><?php echo ucfirst($row2[ten_ca_si]);?></a></b> </div>
		      
        <div align="center"><a href="index.php?pl=t&a=theocasi&macs=<?php echo $ma_ca_si; ?>&page=<?php if(isset($_REQUEST["page"])) echo $_REQUEST["page"]; else echo "1" ?>">Nghe toàn bộ danh sách</a></div>	
        	
		<?php
		while($row=$DB->fetch_row($result))
		{
		?>
		<a href="?a=theocasi&macs=<?php echo $row[ma_ca_si];?>
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
		$doc->save("playlist/plcs.xml");
		#-----
		?>
		<p align="center">
			<?php 
			$list=$p->pageList($_REQUEST["page"], $pages, "?a=theocasi&macs=$ma_ca_si"); 
			if($pages>1) echo $list;
			?>
		</p>
	<?php
	}	
}
?>