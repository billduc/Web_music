<?php
	if($_REQUEST["nghethu"]<>"")
	{
		$loi="";
		if($_POST["urlselect"]==0)
		{
			if(isset($_POST["urlcu"])) $linktest=$_POST["urlcu"]; else $linktest=$row0[bai_hat];
		}
		else if($_POST["urlselect"]==1)
		{
			if($_FILES["file"]["name"]=="")
			{
				$loi.="Bạn chưa chọn file nhạc mới";
			}
			else if(strtolower($_FILES["file"]["type"])<>"audio/mp3"&&strtolower($_FILES["file"]["type"])<>"video/mp4"&&strtolower($_FILES["file"]["type"])<>"video/x-flv")
				$loi.="Chỉ được upload file mp3, mp4, flv";
			else
			{
				$linktest=uploadtest("file");
				$linktest="upload_nhac/nghethu_nhac/".$linktest;
				#echo $_FILES["file"]["name"];
			}
		}
		else if($_POST["urlselect"]==2)
		{
			if($_POST["urlmoi"]<>"")
				$linktest=$_POST["urlmoi"];
			else $loi.="Bạn chưa nhập url mới";
		}
		if($loi<>"")
		{
			echo "<div class='error_text' align=center>".$loi."</div>";
		}
		else
		{
			echo "<div align=\"center\">Bạn đang nghe thử bài ".$_FILES["file"]["name"]."</div>";
?>		
        <div align="center">
        <div id="mediaplayer">Trình player nhạc</div>
        <script type="text/javascript" src="../jw/jwplayer.js"></script>
        <script type="text/javascript">
            jwplayer("mediaplayer").setup({
                flashplayer: "../jw/player.swf",
                file: "../<?php echo $linktest ?>",
                width: 300,
                height: 25,
                controlbar: { position:'bottom'},
                start: true,
                autostart: true,
                skin: "../jw/skins/lionslight.zip",
                repeat: 'always'
            });
        </script>
        </div>
        <div><br /></div>
<?php
		}
	}
	if($_REQUEST["sua"]<>"")
	{
		$error="";
		if(trim($_POST["ten_bai_hat"])=="")
		$error.="Ban chưa nhập tên bài hát<br>";
		#if(trim($_POST["url"])=="")
		#$error.="Bạn chưa chọn link đến bài hát<br>";
		
		if($_POST["urlselect"]==0)
		{
			if(isset($_POST["urlcu"])) $link=$_POST["urlcu"]; else $link=$row0[bai_hat];
		}
		else if($_POST["urlselect"]==1)
		{
				if($_FILES["file"]["name"]=="")
				{
					$error.="Bạn chưa chọn file nhạc mới<br>";
				}
				else if(strtolower($_FILES["file"]["type"])<>"audio/mp3"&&strtolower($_FILES["file"]["type"])<>"video/mp4"&&strtolower($_FILES["file"]["type"])<>"video/x-flv")
					$error.="Chỉ được upload file mp3, mp4, flv<br>";
				else
				{
						$link=uploada("file");
						$link="upload_nhac/".$link;
						unlink("../".$_POST["urlcu"]);
						#echo $_FILES["file"]["name"];
				}
		}
		else if($_POST["urlselect"]==2)
		{
			if($_POST["urlmoi"]<>"")
				$link=$_POST["urlmoi"];
			else $error.="Bạn chưa nhập url mới";
		}
		#echo $link;
		
		if($error=="")
		{
			if($_SESSION['log']['ma_nguoi_dung']==18)
			{
				$ma_bai_hat=$_POST["ma_bh"];
				$ten_bai_hat=trim($_POST["ten_bai_hat"]);
				$ma_ca_si=$_POST["ca_si"];
				$ma_nhac_si=$_POST["nhac_si"];
				$ma_the_loai=$_POST["the_loai"];
				$ma_quoc_gia=$_POST["quoc_gia"];
				$ma_album=$_POST["album"];
				$hien=$_POST["display"];
				#$bai_hat=trim($_POST["url"]);
				$bai_hat=$link;
				$loi_bai_hat=trim($_POST["loi_bai_hat"]);
				sua_bai_hat($ma_bai_hat, $ma_ca_si, $ma_nhac_si, $ma_album, $ma_the_loai, $ma_quoc_gia, $ten_bai_hat, $bai_hat, $loi_bai_hat,$hien);
			}	
			else
				echo "<div align=center><font color=blue size=+1>Đã hết thời hạn login,mời đăng nhập lại để chỉnh sửa.</font></div> <META http-equiv=refresh content=\"5; URL=?a=baihat\">";	
			
		}
		else echo "<div class='error_text' align=center>".$error."</div>";
	}
	
if($_REQUEST["mabh"]<>"")
{
	$ma_bai_hat=$_REQUEST["mabh"];
	$sql0="select * from bai_hat where ma_bai_hat='$ma_bai_hat'";
	$result0=$DB->query($sql0);
	$num0=$DB->num_rows($result0);
	if($num0==0)
	{
		header("Location: ?a=baihat");
		exit();
	}
	else
	{
		$row0=$DB->fetch_row($result0);
		
?>

<form action="" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2" align="center">SỬA BÀI HÁT </td>
    </tr>
    <tr>
      <td width="34%" align="right">Tên bài : </td>
      <td width="66%"><input name="ten_bai_hat" type="text" id="ten_bai_hat" size="42" value="<?php if(isset($_POST[ten_bai_hat])) echo $_POST["ten_bai_hat"]; else echo $row0[ten_bai_hat];?>">
        <input name="ma_bh" type="hidden" id="ma_bh" value="<?php echo  $row0[ma_bai_hat];?>" /></td>
    </tr>
    <tr>
      <td align="right">Ca sĩ thể hiện : </td>
      <td><select name="ca_si" >
	  
	  <?php
	  $sql1="select * from ca_si order by cs_order";
	  $result1=$DB->query($sql1);
	  while($row1=$DB->fetch_row($result1))
	  {
	  ?>
	  <option value="<?php echo $row1[ma_ca_si];?>" <?php if($row1[ma_ca_si]==$row0[ma_ca_si]) echo "selected='selected'";?>><?php echo $row1[ten_ca_si];?></option>
	  <?php
	  }
	  ?>
      </select>      </td>
    </tr>
    <tr>
      <td align="right">Nhạc sĩ : </td>
      <td><select name="nhac_si" id="nhac_si" >
	   
	  <?php
	  $sql2="select * from nhac_si order by ns_order";
	  $result2=$DB->query($sql2);
	  while($row2=$DB->fetch_row($result2))
	  {
	  ?>
	  <option value="<?php echo $row2[ma_nhac_si];?>" <?php if($row2[ma_nhac_si]==$row0[ma_nhac_si]) echo "selected='selected'";?>><?php echo $row2[ten_nhac_si];?></option>
	  <?php
	  }
	  ?>
      </select>      </td>
    </tr>
    <tr>
      <td align="right">Thể loại : </td>
      <td><select name="the_loai" id="the_loai" >
	  
	  <?php
	  $sql3="select * from the_loai order by tl_order";
	  $result3=$DB->query($sql3);
	  while($row3=$DB->fetch_row($result3))
	  {
	  ?>
	  <option value="<?php echo $row3[ma_the_loai];?>" <?php if($row3[ma_the_loai]==$row0[ma_the_loai]) echo "selected='selected'";?>><?php echo $row3[ten_the_loai];?></option>
	  <?php
	  }
	  ?>
      </select>      </td>
    </tr>
    <tr>
      <td align="right">Quốc gia : </td>
      <td><select name="quoc_gia" id="quoc_gia" >
	  
	  <?php
	  $sql4="select * from quoc_gia order by qg_order";
	  $result4=$DB->query($sql4);
	  while($row4=$DB->fetch_row($result4))
	  {
	  ?>
	  <option value="<?php echo $row4[ma_quoc_gia];?>" <?php if($row4[ma_quoc_gia]==$row0[ma_quoc_gia]) echo "selected='selected'";?>><?php echo $row4[ten_quoc_gia];?></option>
	  <?php
	  }
	  ?>
      </select>      </td>
    </tr>
    <tr>
      <td align="right">Album :</td>
      <td><select name="album" id="album" >
	  
	  <?php
	  $sql5="select * from album order by ab_order";
	  $result5=$DB->query($sql5);
	  while($row5=$DB->fetch_row($result5))
	  {
	  ?>
	  <option value="<?php echo $row5[ma_album];?>" <?php if($row5[ma_album]==$row0[ma_album]) echo "selected='selected'";?>><?php echo $row5[ten_album];?></option>
	  <?php
	  }
	  ?>
      </select>      </td>
    </tr>
    
    
   <tr>
      <td width="34%" align="right">Hiện : </td>
      <td>
      <select name="display" id="display">
        <option value="1" <?php if($row0[hien]==1) echo "selected='selected'";?>>-Hiện-</option>
        <option value="0" <?php if($row0[hien]==0) echo "selected='selected'";?>>-Ẩn-</option>		
      </select>      
      </td>
    </tr>   

    <form action="" method="post" enctype="multipart/form-data">
    	<tr>
            <td>
            </td>
            <td>
                <select name="urlselect" id="urlselect">
                    <option value="0" <?php if($_POST["urlselect"]==""||$_POST["urlselect"]=="0") echo "selected='selected'"?>>Sử dụng link bài hát cũ</option>
                    <option value="1" <?php if($_POST["urlselect"]=="1") echo "selected='selected'"?>>Upload bài hát khác</option>		
                    <option value="2" <?php if($_POST["urlselect"]=="2") echo "selected='selected'"?>>Đổi URL khác</option>
                </select>   
            </td>
        </tr>
    	<tr>
      		<td align="right">URL cũ : </td>
      		<td><textarea name="urlcu" cols="40" id="urlcu" readonly="readonly"><?php if(isset($_POST["url"])) echo $_POST["url"]; else echo $row0[bai_hat];?></textarea></td>
    	</tr>
        <tr>
      		<td align="right">Upload bài mới : </td>
      		<td><input name="file" type="file"  id="file" size="15" value="<?php if($_POST["urlselect"]==1) echo $link; ?>" title="<?php echo $_FILES["file"]["name"]; ?>" ></td>
    	</tr>
        <tr>
      		<td align="right">URL mới : </td>
      		<td><textarea name="urlmoi" cols="40" id="urlmoi" ><?php if(isset($_POST["urlmoi"])) echo $_POST["urlmoi"]; else echo "";?></textarea></td>
    	</tr>
    	<tr>
    		<td colspan="2" align="center"><input name="nghethu" type="submit" id="nghethu" value="Nghe thử"></td>
        </tr>
    </form>

    
	<tr>
      <td align="right">Lời bài hát : </td>
      <td><textarea name="loi_bai_hat" cols="40" rows="5" id="loi_bai_hat"><?php if(isset($_POST["loi_bai_hat"])) echo $_POST["loi_bai_hat"]; else echo $row0[loi_bai_hat];?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="sua" type="submit" id="sua" value="Xác nhận"></td>
    </tr>
  </table>
</form>
<?php
}}
?>
