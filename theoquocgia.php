<?php
if($_REQUEST["maqg"]<>"")
{
	$ma_quoc_gia=$_REQUEST["maqg"];
	
	$sql1="select ma_quoc_gia from bai_hat where ma_quoc_gia=$ma_quoc_gia ";
	$result1=$DB->query($sql1);
	$count=$DB->num_rows($result1);
	$limit=15;
	$pages=$p->findpages($count, $limit);
	$start=$p->findstart($limit);
	
	$sql="select * from bai_hat, ca_si, quoc_gia where bai_hat.ma_quoc_gia=$ma_quoc_gia and bai_hat.ma_ca_si=ca_si.ma_ca_si and bai_hat.ma_quoc_gia=quoc_gia.ma_quoc_gia and hien = 1 limit $start, $limit";
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
		
		$sql_ns="select ten_quoc_gia from quoc_gia where ma_quoc_gia=$ma_quoc_gia";
		$row2=$DB->fetch_row($DB->query($sql_ns));
	?>
		
		<div class="tieude" align="center">Có <?php echo $count;?> ca khúc thuộc <b><?php echo ucfirst($row2[ten_quoc_gia]);?></b> </div>
              
        <div align="center"><a href="index.php?pl=t&a=theoquocgia&maqg=<?php echo $ma_quoc_gia; ?>&page=<?php if(isset($_REQUEST["page"])) echo $_REQUEST["page"]; else echo "1" ?>">Nghe toàn bộ danh sách</a></div>	
        	
		<?php
		while($row=$DB->fetch_row($result))
		{
		?>
		<a href="?a=theoquocgia&maqg=<?php echo $row[ma_quoc_gia];?>
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
		$doc->save("playlist/plqg.xml");
		#-----
		?>
		
		<p align="center">
			<?php 
			$list=$p->pageList($_REQUEST["page"], $pages, "?a=theoquocgia&maqg=$ma_quoc_gia"); 
			if($pages>1) echo $list;
			?>
		</p>
		
	<?php
	}	
}
?>