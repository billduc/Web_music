<?php
function upload_hinh_cs($post)
	{
	$str_rand = rand(100000,999999);
	
		if(!empty($_FILES[$post]))	{	
			$filename_img = $_FILES[$post.$i]['name'];
			$filesize_img = $_FILES[$post.$i]['size'];
			$filetype_img = $_FILES[$post.$i]['type'];
			$filetemp_img = $_FILES[$post.$i]['tmp_name'];
					
		if(move_uploaded_file($filetemp_img,"../upload_hinh/".$str_rand."_".$filename_img)) $img =  $str_rand."_".$filename_img; else $img="";
		return $img;
		}
	}
/*************************************************************/
function upload_hinh_tt($post)
	{
	$str_rand = rand(100000,999999);
	
		if(!empty($_FILES[$post]))	{	
			$filename_img = $_FILES[$post.$i]['name'];
			$filesize_img = $_FILES[$post.$i]['size'];
			$filetype_img = $_FILES[$post.$i]['type'];
			$filetemp_img = $_FILES[$post.$i]['tmp_name'];
					
		if(move_uploaded_file($filetemp_img,"../upload_anhtt/".$str_rand."_".$filename_img)) $img =  $str_rand."_".$filename_img; else $img="";
		return $img;
		}
	}
/************************************************/
function Save($imgfile="",$path,$ato) {
              $gd_version = 2;
              $img['format']=ereg_replace(".*\.(.*)$","\\1",$path);
              $img['format']=strtoupper($img['format']);
              if ($img['format']=="JPG" || $img['format']=="JPEG") {
                  $img['src'] = imagecreatefromjpeg($imgfile);
              }
              if ($img['format']=="GIF") {
                  $img['src'] = imagecreatefromgif($imgfile);
              }
              $img['old_w'] = imagesx($img['src']);
              $img['old_h'] = imagesy($img['src']);
              $old_h = $img['old_h'];
              $old_w = $img['old_w'];
			 	if($img['old_w']>$img['old_h'])
				{
				  if ($img['old_w'] > $ato){
					  $old_w  = $ato;
					  $old_h  = ($ato/$img['old_w'])*$img['old_h'];
				  }
				}
				 else
				 {
				 	if ($img['old_h'] > $ato)
					{
						$old_h=$ato;
						$old_w=($ato/$img['old_h'])*$img['old_w'];
					}
				 } 
              if ($gd_version==2) {
                  $img['des'] = imagecreatetruecolor($old_w,$old_h);
                  $balck = imagecolorallocate($img['des'],000,000,000);
                  imagefill($img['des'],1,1,$balck);
                  imagecopyresampled($img['des'],$img['src'], 0, 0, 0, 0, $old_w,$old_h,$img['old_w'],$img['old_h']);
              }
              if ($gd_version==1) {
                  $img['des'] = imagecreatetruecolor($old_w,$old_h);
                  $white = imagecolorallocate($img['des'],255,255,255);
                  imagefill($img['des'],1,1,$white);
                  imagecopyresized($img['des'],$img['src'], 0, 0, 0, 0, $old_w,$old_h,$img['old_w'],$img['old_h']);
              }
              if ($img['format']=="JPG" || $img['format']=="JPEG") {
                    imagejpeg($img['des'],$path,100);
              }
              if ($img['format']=="GIF") {
                    imagegif($img['des'],$path,100);
              }
     }
	 
/*************************************************************/
function kt_co_ca_si_chua($ten_ca_si)
{
	$ten_ca_si=strtolower(utf8_to_ascii(id_replace($ten_ca_si)));
	$sql="select * from ca_si where tencs_khong_dau='$ten_ca_si'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num<>0)
	return TRUE;
	else
	return FALSE;
}
/*************************************************************/
function them_ca_si($ten_ca_si, $hinh, $display, $ttcasi)
{
	$tencs_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_ca_si)));
	$sql="insert into ca_si (ma_ca_si, ten_ca_si, tencs_khong_dau, hinh, cs_order, display, tt_ca_si)
						values ('', '$ten_ca_si', '$tencs_khong_dau', '$hinh', 1, $display, '$ttcasi')";
	#echo $sql;
	if(mysql_query($sql))
	{
		echo "<div align=center><font color=blue size=+1>Thêm thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=casi\">";
	}
	else echo "Có một lỗi xảy ra nè!!";					
} 
/*************************************************************/
function sua_tt_ca_si($ma_ca_si, $ten_ca_si, $hinh, $cs_order, $display, $ttcasi)
{
	$tencs_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_ca_si)));
	$sql="update ca_si set ten_ca_si='$ten_ca_si', tencs_khong_dau='$tencs_khong_dau', hinh='$hinh', cs_order='$cs_order', display='$display', tt_ca_si='$ttcasi' where ma_ca_si='$ma_ca_si'";
	if(mysql_query($sql))
	echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=casi\">";
	else echo "Có lỗi rồi!";
}
/*************************************************************/
function xoa_ca_si($ma_ca_si)
{
	$DBx = new DB;
	$DBx->connect();
	$DBx->query("SET NAMES 'utf8'");
	$sqllink="SELECT * FROM bai_hat WHERE ma_ca_si='$ma_ca_si'";
	$resultlink=$DBx->query($sqllink);
	$num=$DBx->num_rows($resultlink);
	if($num<>0)
	{
		while($row=$DBx->fetch_row($resultlink))
		{
			unlink("../".$row[bai_hat]);
		}
	}
	$sql_str1 = "DELETE FROM ca_si WHERE ma_ca_si= '$ma_ca_si'";
	$sql_str2 = "DELETE FROM bai_hat WHERE ma_ca_si='$ma_ca_si'";
	if(	mysql_query($sql_str1) && mysql_query($sql_str2)) 
	{
		echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=casi\">";
	}
	else "Có lỗi rồi";	
}

/*************************************************************/
function kt_co_nhac_si_chua($ten_nhac_si)
{
	$ten_nhac_si=strtolower(utf8_to_ascii(id_replace($ten_nhac_si)));
	$sql="select * from nhac_si where tenns_khong_dau='$ten_nhac_si'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num<>0)
	return TRUE;
	else
	return FALSE;
}
/*************************************************************/
function them_nhac_si($ten_nhac_si, $hinh, $display, $ttnhacsi)
{
	$tenns_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_nhac_si)));
	$sql="insert into nhac_si (ma_nhac_si, ten_nhac_si, tenns_khong_dau, hinh, ns_order, display, tt_nhac_si)
						values ('', '$ten_nhac_si', '$tenns_khong_dau', '$hinh', 1, $display, '$ttnhacsi')";
	if(mysql_query($sql))
	{
		echo "<div align=center><font color=blue size=+1>Thêm thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=nhacsi\">";
	}
	else echo "Có một lỗi xảy ra!!";					
} 

/*************************************************************/
function sua_tt_nhac_si($ma_nhac_si, $ten_nhac_si, $hinh, $ns_order, $display, $ttnhacsi)
{
	$tenns_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_nhac_si)));
	$sql="update nhac_si set ten_nhac_si='$ten_nhac_si', tenns_khong_dau='$tenns_khong_dau', hinh='$hinh', ns_order='$ns_order', display='$display', tt_nhac_si='$ttnhacsi' where ma_nhac_si='$ma_nhac_si'";
	if(mysql_query($sql))
	echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=nhacsi\">";
	else echo "Có lỗi rồi!";
}
/*************************************************************/
function xoa_nhac_si($ma_nhac_si)
{
	$DBx = new DB;
	$DBx->connect();
	$DBx->query("SET NAMES 'utf8'");
	$sqllink="SELECT * FROM bai_hat WHERE ma_nhac_si='$ma_nhac_si'";
	$resultlink=$DBx->query($sqllink);
	$num=$DBx->num_rows($resultlink);
	if($num<>0)
	{
		while($row=$DBx->fetch_row($resultlink))
		{
			unlink("../".$row[bai_hat]);
		}
	}
	$sql_str1 = "DELETE FROM nhac_si WHERE ma_nhac_si= '$ma_nhac_si'";
	$sql_str2 = "DELETE FROM bai_hat WHERE ma_nhac_si='$ma_nhac_si'";
		if(	mysql_query($sql_str1) && mysql_query($sql_str2)) 
		echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=nhacsi\">";
		else "Có lỗi rồi";	
}
/*************************************************************/
function kt_co_the_loai_chua($ten_the_loai)
{
	$ten_the_loai=strtolower(utf8_to_ascii(id_replace($ten_the_loai)));
	$sql="select * from the_loai where tentl_khong_dau ='$ten_the_loai'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num<>0)
	return TRUE;
	else
	return FALSE;
}
/*************************************************************/
function them_the_loai($ten_the_loai, $display)
{
	$tentl_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_the_loai)));
	$sql="insert into the_loai (ma_the_loai, ten_the_loai, tentl_khong_dau, tl_order, display)
						values ('', '$ten_the_loai', '$tentl_khong_dau', 1, $display)";
	if(mysql_query($sql))
	{
		echo "<div align=center><font color=blue size=+1>Thêm thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=theloai\">";
	}
	else echo "Có một lỗi xảy ra!!";					
} 

/*************************************************************/
function sua_the_loai($ma_the_loai, $ten_the_loai, $tl_order, $display)
{
	$tentl_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_the_loai)));
	$sql="update the_loai set ten_the_loai='$ten_the_loai', tentl_khong_dau='$tentl_khong_dau', tl_order='$tl_order', display='$display' where ma_the_loai='$ma_the_loai'";
	if(mysql_query($sql))
	echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=theloai\">";
	else echo "Có lỗi rồi!";
}
/*************************************************************/
function xoa_the_loai($ma_the_loai)
{
	$DBx = new DB;
	$DBx->connect();
	$DBx->query("SET NAMES 'utf8'");
	$sqllink="SELECT * FROM bai_hat WHERE ma_the_loai='$ma_the_loai'";
	$resultlink=$DBx->query($sqllink);
	$num=$DBx->num_rows($resultlink);
	if($num<>0)
	{
		while($row=$DBx->fetch_row($resultlink))
		{
			unlink("../".$row[bai_hat]);
		}
	}
	$sql_str1 = "DELETE FROM the_loai WHERE ma_the_loai= '$ma_the_loai'";
	$sql_str2 = "DELETE FROM bai_hat WHERE ma_the_loai='$ma_the_loai'";
		if(	mysql_query($sql_str1) && mysql_query($sql_str2)) 
		echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=theloai\">";
		else "Có lỗi rồi";	
}

/*************************************************************/
function kt_co_quoc_gia_chua($ten_quoc_gia)
{
	$ten_quoc_gia=strtolower(utf8_to_ascii(id_replace($ten_quoc_gia)));
	$sql="select * from quoc_gia where tenqg_khong_dau ='$ten_quoc_gia'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num<>0)
	return TRUE;
	else
	return FALSE;
}
/*************************************************************/
function them_quoc_gia($ten_quoc_gia, $display)
{
	$tenqg_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_quoc_gia)));
	$sql="insert into quoc_gia (ma_quoc_gia, ten_quoc_gia, tenqg_khong_dau, qg_order, display)
						values ('', '$ten_quoc_gia', '$tenqg_khong_dau', 1, $display)";
	if(mysql_query($sql))
	{
		echo "<div align=center><font color=blue size=+1>Thêm thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=quocgia\">";
	}
	else echo "Có một lỗi xảy ra!!";					
} 

/*************************************************************/
function sua_quoc_gia($ma_quoc_gia, $ten_quoc_gia, $qg_order, $display)
{
	$tenqg_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_quoc_gia)));
	$sql="update quoc_gia set ten_quoc_gia='$ten_quoc_gia', tenqg_khong_dau='$tenqg_khong_dau', qg_order='$qg_order', display='$display' where ma_quoc_gia='$ma_quoc_gia'";
	if(mysql_query($sql))
	echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=quocgia\">";
	else echo "Có lỗi rồi!";
}
/*************************************************************/
function xoa_quoc_gia($ma_quoc_gia)
{
	$DBx = new DB;
	$DBx->connect();
	$DBx->query("SET NAMES 'utf8'");
	$sqllink="SELECT * FROM bai_hat WHERE ma_quoc_gia='$ma_quoc_gia'";
	$resultlink=$DBx->query($sqllink);
	$num=$DBx->num_rows($resultlink);
	if($num<>0)
	{
		while($row=$DBx->fetch_row($resultlink))
		{
			unlink("../".$row[bai_hat]);
		}
	}
	$sql_str1 = "DELETE FROM quoc_gia WHERE ma_quoc_gia= '$ma_quoc_gia'";
	$sql_str2 = "DELETE FROM bai_hat WHERE ma_quoc_gia='$ma_quoc_gia'";
		if(	mysql_query($sql_str1) && mysql_query($sql_str2)) 
		echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=quocgia\">";
		else "Có lỗi rồi";	
}
/*************************************************************/
function kt_co_album_chua($ten_album)
{
	$ten_album=strtolower(utf8_to_ascii(id_replace($ten_album)));
	$sql="select * from album where tenab_khong_dau='$ten_album'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num<>0)
	return TRUE;
	else
	return FALSE;
}
/*************************************************************/
function them_album($ten_album, $hinh, $display)
{
	$tenab_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_album)));
	$sql="insert into album (ma_album, ten_album, tenab_khong_dau, hinh, ab_order, display)
						values ('', '$ten_album', '$tenab_khong_dau', '$hinh', 1, $display)";
	if(mysql_query($sql))
	{
		echo "<div align=center><font color=blue size=+1>Thêm thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=album\">";
	}
	else echo "Có một lỗi xảy ra!!";					
} 
/*************************************************************/
function sua_album($ma_album, $ten_album, $hinh, $ab_order, $display)
{
	$tenab_khong_dau = strtolower(utf8_to_ascii(id_replace($ten_album)));
	$sql="update album set ten_album='$ten_album', tenab_khong_dau='$tenab_khong_dau', hinh='$hinh', ab_order='$ab_order', display='$display' where ma_album='$ma_album'";
	if(mysql_query($sql))
	echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=album\">";
	else echo "Có lỗi rồi!";
}
/*************************************************************/
function xoa_album($ma_album)
{
	$DBx = new DB;
	$DBx->connect();
	$DBx->query("SET NAMES 'utf8'");
	$sqllink="SELECT * FROM bai_hat WHERE ma_album='$ma_album'";
	$resultlink=$DBx->query($sqllink);
	$num=$DBx->num_rows($resultlink);
	if($num<>0)
	{
		while($row=$DBx->fetch_row($resultlink))
		{
			unlink("../".$row[bai_hat]);
		}
	}
	$sql_str1 = "DELETE FROM album WHERE ma_album= '$ma_album'";
	$sql_str2 = "DELETE FROM bai_hat WHERE ma_album='$ma_album'";
		if(	mysql_query($sql_str1) && mysql_query($sql_str2)) 
		echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=album\">";
		else "Có lỗi rồi";	
}
/*************************************************************/
function sua_bai_hat($ma_bai_hat, $ma_ca_si, $ma_nhac_si, $ma_album, $ma_the_loai, $ma_quoc_gia, $ten_bai_hat, $bai_hat, $loi_bai_hat,$hien)
{
	$tenbh_khong_dau= strtolower(utf8_to_ascii(id_replace($ten_bai_hat)));
	$sql="update bai_hat set ma_ca_si='$ma_ca_si', ma_nhac_si='$ma_nhac_si', ma_album='$ma_album', ma_the_loai='$ma_the_loai', ma_quoc_gia='$ma_quoc_gia', ten_bai_hat='$ten_bai_hat', tenbh_khong_dau='$tenbh_khong_dau', bai_hat='$bai_hat', loi_bai_hat='$loi_bai_hat', hien='$hien' where ma_bai_hat='$ma_bai_hat'"; 
	
	if(mysql_query($sql))
	echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=baihat\">";
	else echo "Có lỗi rồi!";
}

/*************************************************************/
function xoa_bai_hat($ma_bai_hat, $page)
{
	$DBx = new DB;
	$DBx->connect();
	$DBx->query("SET NAMES 'utf8'");
	$sqllink="SELECT * FROM bai_hat WHERE ma_bai_hat= '$ma_bai_hat'";
	$resultlink=$DBx->query($sqllink);
	$num=$DBx->num_rows($resultlink);
	if($num==0)
	{
		echo "Không tồn tại bài hát này";
	}
	else
	{
		$row=$DBx->fetch_row($resultlink);
		$sql= "DELETE FROM bai_hat WHERE ma_bai_hat= '$ma_bai_hat'";
		if(	mysql_query($sql))
		{
			#echo("$link"."");
			unlink("../".$row[bai_hat]);
			echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=baihat&page=$page\">";
		}
			else "Có lỗi rồi";	
	}
}
/*************************************************************/
function sua_nguoi_dung($ma_nguoi_dung, $ten_nguoi_dung, $ten_dang_nhap, $email, $cam_su_dung, $quyen_admin)
{
	if($quyen_admin==0)
	{
		$sql="update nguoi_dung set ten_nguoi_dung='$ten_nguoi_dung', ten_dang_nhap='$ten_dang_nhap', email='$email', cam_su_dung='$cam_su_dung', quyen_admin='$quyen_admin' where ma_nguoi_dung='$ma_nguoi_dung'";
		if(mysql_query($sql))
			echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=nguoidung\">";
		else 
			echo "Có lỗi rồi";
	}
	else
	{
		$sql1="update nguoi_dung set ten_nguoi_dung='$ten_nguoi_dung', ten_dang_nhap='$ten_dang_nhap', email='$email', cam_su_dung='$cam_su_dung', quyen_admin='$quyen_admin' where ma_nguoi_dung='$ma_nguoi_dung'";
		$sql2="insert into admin (ma_admin, ma_nguoi_dung) values ('', '$ma_nguoi_dung')";
		if(mysql_query($sql1) && mysql_query($sql2))
			echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=nguoidung\">";
		else 
			echo "Có lỗi rồi";
	}
}
/*************************************************************/
function xoa_nguoi_dung($ma_nguoi_dung)
{
	$DBx = new DB;
	$DBx->connect();
	$DBx->query("SET NAMES 'utf8'");
	$sqllink="SELECT * FROM bai_hat WHERE ma_nguoi_dung='$ma_nguoi_dung'";
	$resultlink=$DBx->query($sqllink);
	$num=$DBx->num_rows($resultlink);
	if($num<>0)
	{
		while($row=$DBx->fetch_row($resultlink))
		{
			unlink("../".$row[bai_hat]);
		}
	}
	$sql_str1 = "DELETE FROM nguoi_dung WHERE ma_nguoi_dung= '$ma_nguoi_dung'";
	$sql_str2 = "DELETE FROM bai_hat WHERE ma_nguoi_dung='$ma_nguoi_dung'";
	$sql_str3 = "DELETE FROM admin WHERE ma_nguoi_dung='$ma_nguoi_dung'";
		if(	mysql_query($sql_str1) && mysql_query($sql_str2) && mysql_query($sql_str3)) 
		echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=nguoidung\">";
		else "Có lỗi rồi";	
}
/************************************************************/
function xoa_tin_tuc($ma_tin_tuc)
{
	$sql_str1 = "DELETE FROM tin_tuc WHERE ma_tin_tuc= '$ma_tin_tuc'";
		if(	mysql_query($sql_str1)) 
		echo "<div align=center><font color=blue size=+1> Xóa thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=tintuc\">";
		else "Có lỗi rồi";	
}
/**********************************************************/
function them_tin_tuc($tieu_de, $noi_dung, $hinh_anh)
{
	$sql="insert into tin_tuc (ma_tin_tuc, tieu_de, noi_dung, hinh_anh)
						values ('', '$tieu_de', '$noi_dung', '$hinh_anh')";
	#echo $sql;
	if(mysql_query($sql))
	{
		echo "<div align=center><font color=blue size=+1>Thêm thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=?a=tintuc\">";
	}
	else echo "Có một lỗi xảy ra!!1213";					
} 
/*************************************************************/
function sua_tin_tuc($ma_tin_tuc, $tieu_de, $noi_dung, $hinh_anh)
{
	$sql="update tin_tuc set ma_tin_tuc='$ma_tin_tuc', tieu_de='$tieu_de', noi_dung='$noi_dung', hinh_anh='$hinh_anh' where ma_tin_tuc='$ma_tin_tuc'";
	if(mysql_query($sql))
	echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=?a=tintuc\">";
	else echo "Có lỗi rồi!";
}
/*************************************************************/
?>