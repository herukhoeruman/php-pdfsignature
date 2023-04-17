<?php
require('mailer/phpmailer/class.phpmailer.php');
include('user-teken.php');

$mailer = new PHPMailer();
$mailer->IsSMTP();
        $mailer->IsHTML(true);
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = "tls";
        $mailer->Host = "smtp.mailgun.org";
        $mailer->Port = 587;
        $mailer->Username = $username;
        $mailer->Password = $password;
        $mailer->From = "digitalsign@gsp.co.id";
        $mailer->FromName = "PT. Gerbang Sinergi Prima";
        $mailer->AddAddress("dadang.sutriaman@gsp.co.id");
        $mailer->Subject = "isi subject dari dadang";
        $mailer->Body = "isi adalah content email phpmailer ke dua";
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

