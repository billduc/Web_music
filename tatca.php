<?php
	
	$sql1="select ma_bai_hat from bai_hat";
	$result1=$DB->query($sql1);
	$count=$DB->num_rows($result1);
	$limit=20;
	$pages=$p->findpages($count, $limit);
	$start=$p->findstart($limit);
	
	
	$sql="select * from bai_hat, ca_si where bai_hat.ma_ca_si=ca_si.ma_ca_si order by luot_xem desc limit $start, $limit";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
	echo "Đang Cập Nhật";
	else
	{
	?>
		<div class="tieude" align="center">Có <?php echo $count;?> ca khúc trong CSDL  </div>
		<?php
		while($row=$DB->fetch_row($result))
		{
		?>
		<a href="?a=tatca<?php if(isset($_REQUEST['page'])) echo "&page=".$_REQUEST['page'];?>
		&mabh=<?php echo $row[ma_bai_hat];?>"><img src="images/music.gif" /><?php echo ucfirst($row[ten_bai_hat]);?> <img title="Play" src="images/ten.gif" />			
		</a><br />
		<div class="casi"><?php echo ucfirst($row[ten_ca_si])." (View:".$row[luot_xem].")"?></div>
		<?php
		}
		?>
		<p align="center">
		<?php $list=$p->pageList($_REQUEST["page"], $pages, "?a=tatca");if($pages>1) echo $list;?>
		</p>
	<?php
	}	
?>