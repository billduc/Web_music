<?php
$a = $_REQUEST['a'];
switch ($a)
{
	case 'theocasi' 	     : include('theocasi.php');
		break;
		
	case 'theonhacsi' 	     : include('theonhacsi.php');
		break;
		
	case 'theotheloai' 	     : include('theotheloai.php');
		break;	
		
	case 'theoalbum' 	     : include('theoalbum.php');
		break;	
		
	case 'theoquocgia' 	     : include('theoquocgia.php');
		break;	
		
	case 'upload' 	     : include('upload.php');
		break;
		
		
	case 'dangky' 	     : include('dangky.php');
		break;	
		
		
	case 'dangxuat' 	     : include('dangxuat.php');
		break;		
		
	case 'tim' 	     : include('timkiem.php');
		break;	
		
	case 'thaydoitt' 	     : include('tt_nguoidung.php');
		break;	
		
	case 'quenmk' 	     : include('quenmatkhau.php');
		break;		
			
	case 'download' 	     : include('download.php');
		break;		
		
	case 'lienhe' 	     : include('lienhe.php');
		break;					
	
	case 'playlist' 	     : include('xemplaylist.php');
		break;		
	
	default   			: include('topview.php');
		break;
}
?>
