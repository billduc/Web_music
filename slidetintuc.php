<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="js/jquery.galleryview-3.0.min.js"></script>
		<script type="text/javascript" src="js/jquery.timers-1.2.js"></script>
		<!-- Inline script -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#myGallery').galleryView({
					show_overlays : true,
					panel_width : 500,
					panel_height : 300,
					frame_height : 38,
					frame_width : 64,
					overlay_opacity : 0.75,
					transition_speed : 1000,
					transition_interval : 1000,
					nav_theme : 'light',
					pause_on_hover : true
				});
			});
		</script>
<?php

#	$sql1="select ma_tin_tuc from tin_tuc order by ma_tin_tuc DESC ";
#	$result1=$DB->query($sql1);
#	$count=$DB->num_rows($result1);
#	$limit=4;
#	$pages=$p->findpages($count, $limit);
#	$start=$p->findstart($limit);
	
	
	$sql="select * from tin_tuc order by ma_tin_tuc DESC limit 5";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
		{}
	else
	{
		?>
        <div id='feature' align="center">
                	<div class="block01">
						<ul id="myGallery">
        <?php
		while($row=$DB->fetch_row($result))
		{
?>
	
							<li>
								<img alt="image" src="upload_anhtt/<?php echo $row[hinh_anh] ?>" width="500" height="300" />
								<div class="gv-panel-overlay">
                                    <a href="dstintuc.php?matt=<?php echo $row[ma_tin_tuc] ?>"><h3><?php echo $row[tieu_de] ?></h3></a>
								</div>
							</li>
<?php 
}
?>
						</ul>
					</div>
		</div>
<?php
	}	
?>
    
    
    