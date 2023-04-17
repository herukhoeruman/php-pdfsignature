<?php
require('mailer/phpmailer/class.phpmailer.php');

$mailer = new PHPMailer();
$mailer->IsSMTP();
     	$mailer->IsHTML(true);
     	$mailer->SMTPAuth = true;
     	$mailer->SMTPSecure = "tls";
     	$mailer->Host = "smtp.gmail.com";
     	$mailer->Port = 587;
     	//$mailer->Username = "sysadmin@gsp.co.id";
     	//$mailer->Password = "Nimda1234";
		$mailer->Username = "lalan@gsp.co.id";
     	$mailer->Password = "10908131";
     	$mailer->From = "sysadmin@gsp.co.id";
     	$mailer->FromName = "PT. Gerbang Sinergi Prima";
     	$mailer->AddAddress("lalan@gsp.co.id");
     	$mailer->Subject = "isi subject dari lalan";
     	$mailer->Body = "isi adalah content email phpmailer";
     	if($mailer->Send()) 
     	{
          	echo "Message sent successfully!";
			//$this->redirect(array('dashboard'));
     	}
     	else 
     	{
			echo "Fail to send your message errrorrrr!";
     	}    
?>
