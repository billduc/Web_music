<?php
$a=$_REQUEST["a"];
switch($a)
{
	case 'casi'				:			include("casi.php");
		break;
		
	case 'themcs'			:			include("themcasi.php");
		break;	
		
	case 'dangxuat'			:			include("dangxuat.php");
		break;	
		
	case 'suacs'			:			include("suacasi.php");
		break;	
		
	case 'nhacsi'			:			include("nhacsi.php");
		break;	
	
	case 'themns'			:			include("themnhacsi.php");
		break;	
		
	case 'suans'			:			include("suanhacsi.php");
		break;			
	
	case 'theloai'			:			include("theloai.php");
		break;						
		
	case 'themtl'			:			include("themtheloai.php");
		break;			
		
	case 'suatl'			:			include("suatheloai.php");
		break;	
		
	case 'quocgia'			:			include("quocgia.php");
		break;						
		
	case 'themqg'			:			include("themquocgia.php");
		break;			
		
	case 'suaqg'			:			include("suaquocgia.php");
		break;	
		
	case 'album'			:			include("album.php");
		break;						
		
	case 'themab'			:			include("themalbum.php");
		break;			
		
	case 'suaab'			:			include("suaalbum.php");
		break;	
		
	case 'baihat'			:			include("baihat.php");
		break;						
		
	case 'thembh'			:			include("upload.php");
		break;			
		
	case 'suabh'			:			include("suabaihat.php");
		break;	
		
	case 'nguoidung'		:			include("nguoidung.php");
		break;						
		
	case 'themnd'			:			include("themnguoidung.php");
		break;			
		
	case 'suand'			:			include("suanguoidung.php");
		break;		
		
	case 'tintuc'			:			include("tintuc.php");
		break;	
		
	case 'themtt'			:			include("themtintuc.php");
		break;		
		
	case 'suatt'			:			include("suatintuc.php");
		break;			
		
	default					:			include("baihat.php");
		break;						
}
?>