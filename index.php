<?php
	ob_start();
	@session_start();
	require_once('includes/config.php');
	require_once('includes/mysql.php');
	require_once('includes/functions.php');
	require_once('includes/class_pages.php');
	require_once('includes/HamKiemTraDuLieu.php');
	$DB = new DB;
	$DB->connect();
	$DB->query("SET NAMES 'utf8'");
	$p=new pager;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Web Nghe Nhạc Trực Tuyến - UIT</title>
<!--<link rel="shortcut icon" href="images/pic01.jpg"> -->
<link href="css/style_main.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/menu.js"></script>
<script language="javascript">

function cuon_menu()
{
	menu.style.top=document.body.scrollTop +100;
}
function khoi_dong()
{
	setInterval("cuon_menu()", 1);
}

</script>
</head>
<body>
<div align="center" style="float:inherit">

<table width="1000px" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000"> 
	<tr>
		<td width="100%" ><img src="images/header.png" width="100%" height="191" /></td>	
	</tr>
</table>

<table width="1000px" border="0" cellpadding="0" cellspacing="0" cell spacing="0">     
	<tr class="font_menu_TA">	
        <td width="142">
        	<div align="center"><?php echo date('l: d / m / Y')?></div></a></td>
        <td width="142">
        	<a href="index.php" class="subcat_menu"><div align="center">| Trang chủ |</div></a></td>
		<td width="142">
        <a href="dstintuc.php" class="subcat_menu"><div align="center">| Tin Tức |</div></a></td>
        <td width="142">
        	<a href="?a=dangky" class="subcat_menu"><div align="center">| ĐĂNG KÝ |</div></a></td>
        <td width="142">
        	<a href="?a=download" class="subcat_menu"><div align="center">| Download |</div></a></td>
        <td width="142">
        	<a href="?a=upload" class="subcat_menu"><div align="center">| UPLOAD |</div></a></td>
        <td width="142">
        	<a href="?a=lienhe" class="subcat_menu"><div align="center">| Liên hệ |</div></a></td>
	</tr>
</table>
<!-----------------main----------------------------------------->
<table width="1000px" align="center" border="0" cellspacing="1" cellpadding="1">
	<!-- bắt đầu dòng 1 -->
  	<tr align="center">
  
  	<!-- cột trái -->
        <td width="170px" rowspan="3" valign="top">
            <!--khung chứa menu-->
            <div class="spbc" align="left">
            <?php require_once("menu.php");?>
            </div>
            
            <div class="space"></div>
            
            <!--khung chứa phần tìm kiếm-->
        </td>
        <!-- hết cột trái -->
        
        <!--gom 2 cột giữa, tránh vỡ -->
        <td colspan="2" valign="top" width="660px">
        	<div class="spbc">
             <?php include('form_timkiem.php')	;?>	
            </div>
        </td>
        <!--hết phần gom 2 cột -->
        
        <!-- cột phải -->
        <td width="170px" rowspan="3" valign="top">	
            
            <!-- khung chứa login -->
            <div class="spbc">
            <?php include('dangnhap.php');?>
            </div>
            <div class="space"></div>
            
            <!-- khung chứa nội dung shoutbox 
            <div>
            <iframe style="border:1px solid #607697; padding:2px" marginheight="0" marginwidth="0" width="170"  height="300" src="vshoutbox/xuatnoidung.php" name="1" scrolling="no">
            </iframe>	
            </div>
            
            <!-- khung chứa phần shoutbox 
            <div>
            <iframe style="border:1px solid #607697; padding:2px" marginheight="0" marginwidth="0" width="170"  height="70" src="vshoutbox/vshoutbox.php" name="1" scrolling="no">
            </iframe>	
            </div>	
        </td>
   		<!--hết cột phải -->
 		       
  	</tr>
  	<!-- hết dòng 1 -->
  
  
  
  <!-- bắt đầu dòng 2 -->
  <tr align="center">
  
  	<!-- cột giữa trái -->
   	<td width="326px" valign="top">
        <div class="spbc" align="left">
          <?php include("main.php");?>
        </div>   
	</td>
    <!-- hết cột giữa trái -->
    
   	<!-- cột giữa phải -->
    <td width="326px" valign="top">
        <div class="spbc">
          <?php include("play.php");?>
        </div>
		<?php
        	include ("loibaihat.php");
        ?>
	</td>
    <!-- hết cột giữa phải-->
    
  </tr>
  <!-- kết thúc dòng 2 -->
  
  <!-- bắt đầu dòng 3-->
  <tr>
  	<td width="1000" colspan="2">
    	<div class="spbc">
        	<?php include("slidetintuc.php") ?>
        </div>
    </td>
  </tr>
  <!-- kết thúc dòng 3 -->
</table>

<!-----------------footer----------------------------------------->	
<table width="1000px" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td width="822"><img src="images/footer.jpg" width="100%" height="110" /></td>
	<th width="178" align="left" scope="col">
	<div>			
	<div align="center">CopyRight@2011</div>
	<div align="center">by CE03</div>
  	<div align="center">Võ Ngọc Hải Đăng</div>
	<div align="center">08520087</div>
    <div align="center">Trần Ngọc Thành</div>
	<div align="center">08520352</div>
	</div>
	</th>
</tr>
</table>
</div>
</body>
</html>
