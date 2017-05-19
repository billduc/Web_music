<?php
	if($POST["Submit"]<>"")
	{
		$error="";
		if(trim($_POST["ten_bai_hat"])=="")
		$error.="Ban chưa nhập tên bài hát<br>";
		if(trim($_POST["url"])=="" && $_FILES["file"]["name"]=="")
		$error.="Bạn chưa chọn file hoặc url<br>";
		if(trim($_POST["url"])<>"" && $_FILES["file"]["name"]<>"")
		$error.="Bạn chỉ được chọn 1 trong 2 kiểu upload file<br>";
		
		if($_FILES["file"]["name"]<>"")
		{
			
			if(strtolower($_FILES["file"]["type"])<>"audio/mp3"&&strtolower($_FILES["file"]["type"])<>"video/mp4"&&strtolower($_FILES["file"]["type"])<>"video/x-flv")
				$error.="Chỉ được upload file mp3, mp4, flv";
		}
		if($error=="")
		{
			if($_SESSION['log']['ma_nguoi_dung']==18)
			{
				$ten_bai_hat=trim($_POST["ten_bai_hat"]);
				$ma_ca_si=$_POST["ca_si"];
				$ma_nhac_si=$_POST["nhac_si"];
				$ma_the_loai=$_POST["the_loai"];
				$ma_quoc_gia=$_POST["quoc_gia"];
				$ma_album=$_POST["album"];
				$hien=$_POST["display"];
				$ma_nguoi_dung=$_SESSION['log']['ma_nguoi_dung'];
				if($_FILES["file"]["name"]<>"")
				{
					$bai_hat=uploada("file");
					$bai_hat="upload_nhac/".$bai_hat;
				}
				else
				{
					$bai_hat=trim($_POST["url"]);
				}
				$ngay_dang=date("Y/m/d");
				them_bai_hat($ma_ca_si, $ma_nhac_si, $ma_album, $ma_the_loai, $ma_quoc_gia, $ma_nguoi_dung, $ten_bai_hat, $bai_hat, $ngay_dang, $hien);
			}			
		}
		else echo "<div class='error_text' align=center>".$error."</div>";
	}
?>

<form action="" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td align="center">&nbsp;</td>
      <td align="left">THÊM BÀI HÁT </td>
    </tr>
    <tr>
      <td width="39%" align="right">Tên bài : </td>
      <td width="61%"><input name="ten_bai_hat" type="text" id="ten_bai_hat" size="25" ></td>
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
	  <option value="<?php echo $row1[ma_ca_si];?>" <?php if($row1[ma_ca_si]==29) echo "selected='selected'";?>><?php echo $row1[ten_ca_si];?></option>
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
	  <option value="<?php echo $row2[ma_nhac_si];?>" <?php if($row2[ma_nhac_si]==6) echo "selected='selected'";?>><?php echo $row2[ten_nhac_si];?></option>
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
	  <option value="<?php echo $row3[ma_the_loai];?>" <?php if($row3[ma_the_loai]==14) echo "selected='selected'";?>><?php echo $row3[ten_the_loai];?></option>
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
	  <option value="<?php echo $row4[ma_quoc_gia];?>" <?php if($row4[ma_quoc_gia]==8) echo "selected='selected'";?>><?php echo $row4[ten_quoc_gia];?></option>
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
	  <option value="<?php echo $row5[ma_album];?>" <?php if($row5[ma_album]==16) echo "selected='selected'";?>><?php echo $row5[ten_album];?></option>
	  <?php
	  }
	  ?>
      </select>      </td>
    </tr>
    <tr>
      <td width="34%" align="right">Hiện/Ẩn : </td>
	  <td>
      <select name="display" id="display">
        <option value="1" selected='selected'>-Hiện-</option>
        <option value="0" >-Ẩn-</option>		
      </select>      
      </td>
    </tr>   
    <tr>
      <td align="right">Chọn đường dẫn : </td>
      <td><input name="file" type="file"  id="file" size="15"></td>
    </tr>
    <tr>
      <td align="right">Hoặc add URL : </td>
      <td><input name="url" type="text" id="url" size="25" ></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Thêm vào"></td>
    </tr>
  </table>
</form>
<?php
?>