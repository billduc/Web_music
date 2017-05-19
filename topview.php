<?php
	$sql1="select ma_bai_hat from bai_hat order by luot_xem DESC ";
	$result1=$DB->query($sql1);
	$count=$DB->num_rows($result1);
	$limit=20;
	$pages=$p->findpages($count, $limit);
	$start=$p->findstart($limit);
	
	
	$sql="select * from bai_hat, ca_si where bai_hat.ma_ca_si=ca_si.ma_ca_si and hien = 1 order by luot_xem DESC limit $start, $limit";
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
		?>
		<div class="tieude" align="center">Danh sách các bài hát được nghe nhiều nhất</div>
        
        <div align="center"><a href="index.php?pl=t&a=topview&page=<?php if(isset($_REQUEST["page"])) echo $_REQUEST["page"]; else echo "1" ?>">Nghe toàn bộ danh sách</a></div>		
        
		<?php
		while($row=$DB->fetch_row($result))
		{
		?>
		<a href="?a=topview&macs=<?php echo $row[ma_ca_si];?>
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
		$doc->save("playlist/pltv.xml");
		#-----
		?>
		<p align="center">
			<?php 
			$list=$p->pageList($_REQUEST["page"], $pages, "?a=topview"); 
			if($pages>1) echo $list;
			?>
		</p>
	<?php
	}	
?>