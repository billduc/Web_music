<?php
function findstart($limit)
	{
		if (($_GET['page'] == "") || ($_GET['page'] == "1"))
		{
			$start = 0;
			$_GET['page'] = 1;
		}
		else
		{
			$start = ($_GET['page']-1) * $limit;
		}
		
		return $start;
	}
/***********************************************************************************/
	function findpages($count, $limit)
	{
		$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
		return $pages;
	}

/***********************************************************************************/
	function pageList($curpage, $pages, $url)
	{
		$page_list = "";
	
		/* In trang dau tien va nhung link toi trang truoc neu can */
		if (($curpage != 1) && ($curpage))
		{
			$page_list .= " <a href=\"".$url."&page=1\" title=\"Trang đầu\"><<</a> ";
		}
	
		if (($curpage-1) > 0)
		{
			$page_list .= "<a href=\"".$url."&page=".($curpage-1)."\" title=\"Về trang trước\"><</a> ";
		}
	
		/* In ra danh sach cac trang va lam cho trang hien tai dam hon va mat link o chan*/
		for ($i=1; $i<=$pages; $i++)
		{
			if ($i == $curpage)
			{
				$page_list .= "<b><font class='lightwords'>".$i."</font></b>";
			}
			else
			{
				$page_list .= "<a href=\"".$url."&page=".$i."\" title=\"Trang ".$i."\">".$i."</a>";
			}
			$page_list .= " ";
		}

		/* In link cua trang tiep theo va trang cuoi cung neu can*/
		if (($curpage+1) <= $pages)
		{
			$page_list .= "<a href=\"".$url."&page=".($curpage+1)."\" title=\" Đến trang sau\">></a> ";
		}
		
		if (($curpage != $pages) && ($pages != 0))
		{
			$page_list .= "<a  href=\"".$url."&page=".$pages."\" title=\"Trang cuối\">>></a> ";
		}
		$page_list .= "</td>\n";

	return $page_list;
	}	
/**********************************************************************************/

function id_replace($id)
{
	$id = trim($id);
	$id = str_replace("+","",$id);
	$id = str_replace("'","''",$id);
	$id = str_replace("union","",$id);
	$id = str_replace("select","",$id);
	$id = str_replace("\*","",$id);
	$id = str_replace("\%","",$id);
	$id = str_replace("%","",$id);
	$id = str_replace("2b","",$id);
	if (strlen($id) > 50)
	{
		$id="";
	}
return $id;
}
/***********************************************************************************/
function utf8_to_ascii($str) {
	$chars = array(
		'a'	=>	array('ấ','ầ','ẩ','ẫ','ậ','Ấ','Ầ','Ẩ','Ẫ','Ậ','ắ','ằ','ẳ','ẵ','ặ','Ắ','Ằ','Ẳ','Ẵ','Ặ','á','à','ả','ã','ạ','â','ă','Á','À','Ả','Ã','Ạ','Â','Ă'),
		'e' =>	array('ế','ề','ể','ễ','ệ','Ế','Ề','Ể','Ễ','Ệ','é','è','ẻ','ẽ','ẹ','ê','É','È','Ẻ','Ẽ','Ẹ','Ê'),
		'i'	=>	array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
		'o'	=>	array('ố','ồ','ổ','ỗ','ộ','Ố','Ồ','Ổ','Ô','Ộ','ớ','ờ','ở','ỡ','ợ','Ớ','Ờ','Ở','Ỡ','Ợ','ó','ò','ỏ','õ','ọ','ô','ơ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ơ'),
		'u'	=>	array('ứ','ừ','ử','ữ','ự','Ứ','Ừ','Ử','Ữ','Ự','ú','ù','ủ','ũ','ụ','ư','Ú','Ù','Ủ','Ũ','Ụ','Ư'),
		'y'	=>	array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
		'd'	=>	array('đ','Đ'),
	);
	foreach ($chars as $key => $arr) 
		foreach ($arr as $val)
			$str = str_replace($val,$key,$str);
	return $str;
}
/***********************************************************************************/
function upload($post)
	{
	$str_rand = rand(100000,999999);
	
		if(!empty($_FILES[$post]))	
		{	
			$filename_img = $_FILES[$post.$i]['name'];
			$filesize_img = $_FILES[$post.$i]['size'];
			$filetype_img = $_FILES[$post.$i]['type'];
			$filetemp_img = $_FILES[$post.$i]['tmp_name'];
			$filename_add=strtolower(utf8_to_ascii(id_replace($filename_img)));

			if(move_uploaded_file($filetemp_img,"upload_nhac/".$str_rand."_".$filename_add))
			$img =  $str_rand."_".$filename_add;
			else $img="";
			return $img;
		}
	}
/***********************************************************************************/
function uploadtest($post)
	{
	$str_rand = rand(100000,999999);
	
		if(!empty($_FILES[$post]))	
		{	
			$filename_img = $_FILES[$post.$i]['name'];
			$filesize_img = $_FILES[$post.$i]['size'];
			$filetype_img = $_FILES[$post.$i]['type'];
			$filetemp_img = $_FILES[$post.$i]['tmp_name'];
			$filename_add=strtolower(utf8_to_ascii(id_replace($filename_img)));

			if(move_uploaded_file($filetemp_img,"../upload_nhac/nghethu_nhac/".$str_rand."_".$filename_add))
			$img =  $str_rand."_".$filename_add;
			else $img="";
			return $img;
		}
	}
/***********************************************************************************/	
function uploada($post)
	{
	$str_rand = rand(100000,999999);
	
		if(!empty($_FILES[$post]))	
		{	
			$filename_img = $_FILES[$post.$i]['name'];
			$filesize_img = $_FILES[$post.$i]['size'];
			$filetype_img = $_FILES[$post.$i]['type'];
			$filetemp_img = $_FILES[$post.$i]['tmp_name'];
			$filename_add=strtolower(utf8_to_ascii(id_replace($filename_img)));
					
			if(move_uploaded_file($filetemp_img,"../upload_nhac/".$str_rand."_".$filename_add))
			$img =  $str_rand."_".$filename_add;
			else $img="";
			return $img;
		}
	}
/*************************************************************************************/	
function them_bai_hat($ma_ca_si, $ma_nhac_si, $ma_album, $ma_the_loai, $ma_quoc_gia, $ma_nguoi_dung, $ten_bai_hat, $bai_hat, $ngay_dang, $hien)
{
	$tenbh_khong_dau=strtolower(utf8_to_ascii(id_replace($ten_bai_hat)));
	$sql= "INSERT INTO bai_hat (ma_bai_hat, ma_ca_si, ma_nhac_si, ma_album, ma_the_loai, ma_quoc_gia, ma_nguoi_dung, ten_bai_hat, tenbh_khong_dau, bai_hat, ngay_dang, luot_xem, hien)
	 				VALUES ('', '$ma_ca_si', '$ma_nhac_si', '$ma_album', '$ma_the_loai', '$ma_quoc_gia', '$ma_nguoi_dung', '$ten_bai_hat', '$tenbh_khong_dau', '$bai_hat', '$ngay_dang', '0', $hien)";
	if(mysql_query($sql)) 
		echo "<div align=center><font color=blue size=+1>Upload thành công !!!</font></div> <META http-equiv=refresh content=\"1; URL=index.php\">";
	
	else 
		echo "Có một lỗi xảy ra!!";					

}


/***********************************************************************************/
function kt_username_cochua($username)
{
	$sql="select ten_dang_nhap from nguoi_dung where ten_dang_nhap='$username'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	return $num;
}

/***********************************************************************************/
function kt_email_cochua($email)
{
	$sql="select email from nguoi_dung where email='$email'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num>0)
	return TRUE;
	else
	return FALSE;
}
/***********************************************************************************/
function them_nguoi_dung($ten_nguoi_dung, $ten_dang_nhap, $mat_khau, $email, $ngay_tham_gia)
{
	$sql="insert into nguoi_dung (ma_nguoi_dung, ten_nguoi_dung, ten_dang_nhap, mat_khau, email, ngay_tham_gia, quyen_admin,  cam_su_dung)
		values ('', '$ten_nguoi_dung', '$ten_dang_nhap', '$mat_khau', '$email', '$ngay_tham_gia', 0, 0)";
		if(mysql_query($sql))
		{
			echo "<div align=center><font color=blue size=+1>Thêm thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=index.php\">";
			$sql2="select * from nguoi_dung where ten_dang_nhap='$ten_dang_nhap'";
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			$_SESSION['log']['ok']=TRUE;
			$_SESSION['log']['ma_nguoi_dung']=$row2[ma_nguoi_dung];
			$_SESSION['log']['ten_nguoi_dung']=$row2[ten_nguoi_dung];
			$_SESSION['log']['ten_dang_nhap']=$row2[ten_dang_nhap];
			$_SESSION['log']['email']=$row2[email];
			$_SESSION['log']['mat_khau']=$row2[mat_khau];
			$_SESSION['log']['ngay_tham_gia']=$row2[ngay_tham_gia];
		}	
		else
			echo "Có lỗi rồi";
}
/***********************************************************************************/
function sua_tt_nguoi_dung($ma_nguoi_dung, $ten_nguoi_dung, $ten_dang_nhap, $mat_khau_moi, $email)
{
	$sql="update nguoi_dung set ten_nguoi_dung='$ten_nguoi_dung', ten_dang_nhap='$ten_dang_nhap', mat_khau='$mat_khau_moi', email='$email' where ma_nguoi_dung='$ma_nguoi_dung'";
	if(mysql_query($sql))
	{
		echo "<div align=center><font color=blue size=+1>Sửa thành công !!!</font></div> <META http-equiv=refresh content=\"2; URL=index.php\">";
			$_SESSION['log']['ten_nguoi_dung']=$ten_nguoi_dung;
			$_SESSION['log']['ten_dang_nhap']=$ten_dang_nhap;
			$_SESSION['log']['email']=$email;
			$_SESSION['log']['mat_khau']=$mat_khau_moi;
	}
	else echo "Có lỗi rồi";
}

/***********************************************************************************/
function kt_dang_nhap($username, $password)
{
	$sql="select * from nguoi_dung where ten_dang_nhap='$username' AND mat_khau='$password'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num<>0)
	{
		$row=mysql_fetch_assoc($result);
		if($row[cam_su_dung]==1)
		echo "<font color=red>Tài khoản của bạn hiện đang bị cấm sử dụng do phạm quy!</font>";
		else
		{
			$_SESSION['log']['ok']=TRUE;
			$_SESSION['log']['ma_nguoi_dung']=$row[ma_nguoi_dung];
			$_SESSION['log']['ten_dang_nhap']=$row[ten_dang_nhap];
			$_SESSION['log']['email']=$row[email];
			$_SESSION['log']['ten_nguoi_dung']=$row[ten_nguoi_dung];
			$_SESSION['log']['mat_khau']=$row[mat_khau];
			$_SESSION['log']['ngay_tham_gia']=$row[ngay_tham_gia];
		}
	}
	else
	echo "<font color=red>Tên đăng nhập hoặc mật khẩu không đúng!</font>";	
}
/***********************************************************************************/
function tim_kiem_bai_hat($tu_khoa1, $kieu_tim)
{
	$tu_khoa=strtolower(utf8_to_ascii(id_replace($tu_khoa1)));
	$arrkey = explode(" ",$tu_khoa);
	if($kieu_tim=="casi")
	{
		$sql="select * from ca_si, bai_hat, nhac_si where ca_si.ma_ca_si=bai_hat.ma_ca_si and nhac_si.ma_nhac_si=bai_hat.ma_nhac_si  and hien = 1 and tencs_khong_dau like '%".$arrkey[0]."%'";
		for($i=1;$i<count($arrkey);$i++) 
		{
		$sql.= "AND tencs_khong_dau LIKE '%".$arrkey[$i]."%' ";
		}		
		$c="ten_ca_si";
		$d="ten_nhac_si";
	}
	
	if($kieu_tim=="nhacsi")
	{
		$sql="select * from nhac_si, bai_hat, ca_si where nhac_si.ma_nhac_si=bai_hat.ma_nhac_si and ca_si.ma_ca_si=bai_hat.ma_ca_si  and hien = 1 AND tenns_khong_dau  like '%";
		$sql.=$arrkey[0];
		$sql.="%'";
		for($i=1;$i<count($arrkey);$i++) 
		{
		$sql.= "AND tenns_khong_dau LIKE '%".$arrkey[$i]."%' ";
		}		
		$c="ten_ca_si";
		$d="ten_nhac_si";
	}
	
	if($kieu_tim=="album")
	{
		$sql="select * from album, bai_hat, ca_si where album.ma_album=bai_hat.ma_album and ca_si.ma_ca_si=bai_hat.ma_ca_si  and hien = 1 AND tenab_khong_dau  like '%".$arrkey[0]."%'";
		for($i=1;$i<count($arrkey);$i++) 
		{
		$sql.= "AND tenab_khong_dau LIKE '%".$arrkey[$i]."%' ";
		}
		$c="ten_ca_si";		
		$d="ten_album";
	}
	if($kieu_tim=="tenbai")
	{
		$sql="select * from ca_si, bai_hat, nhac_si where ca_si.ma_ca_si=bai_hat.ma_ca_si AND nhac_si.ma_nhac_si=bai_hat.ma_nhac_si  and hien = 1 AND tenbh_khong_dau  like '%".$arrkey[0]."%'";
		for($i=1;$i<count($arrkey);$i++) 
		{
		$sql.= "AND tenbh_khong_dau LIKE '%".$arrkey[$i]."%' ";
		}		
		$c="ten_ca_si";
		$d="ten_nhac_si";
	}
	
	if($kieu_tim=="video")
	{
		$sql="select * from ca_si, bai_hat, nhac_si where ca_si.ma_ca_si=bai_hat.ma_ca_si AND nhac_si.ma_nhac_si=bai_hat.ma_nhac_si  and hien = 1  AND tenbh_khong_dau  like '%".$arrkey[0]."%'";
		for($i=1;$i<count($arrkey);$i++) 
		{
		$sql.= "AND tenbh_khong_dau LIKE '%".$arrkey[$i]."%' ";
		}
		$sql.= "AND (bai_hat like '%.mp4%' OR bai_hat like '%.flv%')";
		#echo $sql;		
		$c="ten_ca_si";
		$d="ten_nhac_si";
	}
	
	if($kieu_tim=="nguoidang")
	{
		$sql="select * from nguoi_dung, bai_hat, ca_si where nguoi_dung.ma_nguoi_dung=bai_hat.ma_nguoi_dung AND ca_si.ma_ca_si=bai_hat.ma_ca_si  and hien = 1 AND ten_dang_nhap like '%".$arrkey[0]."%'";
		for($i=1;$i<count($arrkey);$i++) 
		{
		$sql.= "AND ten_dang_nhap LIKE '%".$arrkey[$i]."%' ";
		}
		$c="ten_ca_si";
		$d="ten_dang_nhap";
	}
	
	//$tu_khoa2='<font class="lightwords">'.ucwords(strtolower($tu_khoa))."</font>";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	if($count==0)
	echo "Không tìm thấy bài hát nào!";
	else
	{
		$limit=15;
		$start=findstart($limit);
		$pages=findpages($count, $limit);
		$list=pageList($_REQUEST['page'], $pages, "?a=tim&tukhoa=$tu_khoa1&luachon=$kieu_tim&mabh=".$row[ma_bai_hat]);
		$sql2=$sql." limit $start, $limit";
		$result2=mysql_query($sql2);
		echo "<font color=blue >Tìm thấy $count kết quả: <b style='color:red'> $tu_khoa1</b></font<br><br>";
		
		while($row=mysql_fetch_assoc($result2))
		{
			//$a=str_replace(ucwords(strtolower($tu_khoa)), $tu_khoa2, ucwords(strtolower($row[ten_bai_hat])));
			//$b=str_replace(ucwords(strtolower($tu_khoa)), $tu_khoa2, ucwords(strtolower($row[$c])));
			if($_REQUEST["page"]=="")
			$page=1;
			else
			$page=$_REQUEST["page"];
			echo "<div align='left'><img src='images/music.gif'> <a href='?a=tim&tukhoa=$tu_khoa1&luachon=$kieu_tim&mabh=".$row[ma_bai_hat]."&page=".$page."'>".$row[ten_bai_hat]."</a> <b class='casi'> (View:".$row[luot_xem].")</b></div>";
			echo "<div class='casi' align='left'>".$row[$c]." | ".$row[$d]."</div>";
			
		}
		if($pages>1)
		echo "<div align=center>$list</div>";
	}
}
/***********************************************************************************/
?>
