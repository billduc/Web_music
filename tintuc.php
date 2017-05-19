<?php
	$sql1="select ma_tin_tuc from tin_tuc order by ma_tin_tuc DESC ";
	$result1=$DB->query($sql1);
	$count=$DB->num_rows($result1);
	$limit=15;
	$pages=$p->findpages($count, $limit);
	$start=$p->findstart($limit);
	
	
	$sql="select * from tin_tuc order by ma_tin_tuc DESC limit $start, $limit";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
		echo "Chưa có tin tức nào";
	else
	{
		?>
        <div class="spbc">
		<div align="center"><font size="4" color="#CCFF00">Danh sách tin tức</font></div>		
		<?php
		while($row=$DB->fetch_row($result))
		{
		?>
		<a href="dstintuc.php?matt=<?php echo $row[ma_tin_tuc];?>
		"><br/><img src="images/new.gif" /><font size="2" color= color="#33FF00">
		<?php echo ucfirst($row[tieu_de]);?> </font><img title="Play" src="images/ten.gif" />			
		</a><br />
		<?php
		}
		?>
		<p align="center">
			<?php 
			$list=$p->pageList($_REQUEST["page"], $pages, "?a=topview"); 
			if($pages>1) echo $list;
			?>
		</p>
        </div>
	<?php
	}	
?>