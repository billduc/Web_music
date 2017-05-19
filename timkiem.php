<?php
if(trim($_REQUEST["tukhoa"])<>"")
{
	$tu_khoa1=trim($_REQUEST["tukhoa"]);
	$kieu_tim=$_REQUEST["luachon"];
	tim_kiem_bai_hat($tu_khoa1, $kieu_tim);
	
}
?>