<?php
if($_REQUEST["sendmail"]<>"")
{
	$sql="select * from nguoi_dung where nguoi_dung.email='".$_POST['email']."'";
	$result=$DB->query($sql);
	$num=$DB->num_rows($result);
	if($num==0)
		echo "Email này chưa dùng để đăng ký tài khoản.";
	else
	{
		$str_rand = rand(100000,999999);
		$email = $_POST['email'] ; 		
		#-----------------------
		require_once('phpmailer/class.phpmailer.php');
		//Khởi tạo đối tượng
		$mail = new PHPMailer();		
		/*=====================================
		 * THIET LAP THONG TIN GUI MAIL
		 *=====================================*/
		
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom('is03@gmail.com','IS03');
		
		//Thiết lập thông tin người nhận
		$mail->AddAddress($email, "Nhận mật khẩu");
		
		//Thiết lập email nhận email hồi đáp
		//nếu người nhận nhấn nút Reply
		$mail->AddReplyTo("is03@gmail.com","IS03");
		
		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
		 *=====================================*/
		
		//Thiết lập tiêu đề
		$mail->Subject    = "Nhận lại mật khẩu";
		
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";
		
		//Thiết lập nội dung chính của email
		$body = "Mật khẩu mới là: ".$str_rand;
		$mail->Body = $body;
		
		if(!$mail->Send()) {
		  echo "Gửi mail bị lỗi: " . $mail->ErrorInfo;
		} else {
		  echo "Gửi thành công";
		}
		#-----------------------
		
		#$md5_mat_khau=md5(trim($str_rand));
		#$sql="update nguoi_dung set mat_khau='".$md5_mat_khau."' where nguoi_dung.email='".$email."'";
		#$result=$DB->query($sql);
		#$num=$DB->num_rows($result);
		#if($num==0)
		#	echo "Gửi thành công";
		#else
		#	echo "Gửi thất bại";
		
	}  
}

?>
<form method="post">
    Email: <input type="text" name="email" /><br />
    <input type="submit" name="sendmail" value="Lấy lại mật khẩu" />
</form>
