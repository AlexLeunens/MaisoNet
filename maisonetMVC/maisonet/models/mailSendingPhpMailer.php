<?php

require_once "PHPMailer.php";
require_once "SMTP.php";
require_once "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function sendConfimMailToAdmin($name,$prenom,$email,$datenaissance,$numtel,$try)
{


    $mail  = new PHPMailer();
    $mail->CharSet ="UTF-8";  // default: ISO-8859-1

    $mail->IsSMTP();                            // Use SMTP
    $mail->SMTPAuth = true;                     // Turn on authentication


    $mail->SMTPSecure = "tls";            // Or tls
    $mail->Host = "smtp.gmail.com";       // SMTP server
    $mail->Port = 587;                    // Port (tls：587)

    $mail->Username = 'ceshiyouxiang000001@gmail.com';  // username
    $mail->Password = "Testmail001";;            // password

    $mail->setFrom('ceshiyouxiang000001@gmail.com','MaisoNetDoNotReply');      // From
    $mail->addAddress('ceshiyouxiang000001@gmail.com','Admin MaisoNet');          // To
    //$mail->AddReplyTo("ceshiyouxiang000001@gmail.com","Ceshi Mail");    // Not necessary

    $mail->Subject = 'Nouvelle inscription sur MaisoNet';                                                                    // Subject
    $mail->Body = "Nouvelle insscription sur MaisoNet :\r\n"."Nom : ".$name."\r\n"."Prénom : ".$prenom."\r\n"."Add. Mail : ".$email."\r\n"."Date de naissance : ".$datenaissance."\r\nNuméro de tel : ".$numtel;                                            //  Mail content
    //$mail->addAttachment('C:\Users\chenw\Desktop\e\kao.jpg', 'kao.jpg');       // Attachment

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;

        if ($try > 0) {
            echo "try possible: ".$try;
            echo "Retry in 10s";
            sleep(10);
            $try--;
            sendConfimMailToAdmin($name, $prenom, $email, $datenaissance, $numtel, $try);
        }else{
            echo "Failed to send confirm mail to administrator. Please contat administrator.";
        }

    } else {
        echo "Mail sent.";
    }
}

function sendConfirmMail($name,$prenom,$email,$datenaissance,$numtel,$try)
{


    $mail  = new PHPMailer();
    $mail->CharSet ="UTF-8";  // default: ISO-8859-1

    $mail->IsSMTP();                            // Use SMTP
    $mail->SMTPAuth = true;                     // Turn on authentication


    $mail->SMTPSecure = "tls";            // ssl or tls
    $mail->Host = "smtp.gmail.com";       // SMTP server
    $mail->Port = 587;                    // Port (ssl:465 tls：587)

    $mail->Username = 'ceshiyouxiang000001@gmail.com';  // username
    $mail->Password = "Testmail001";                    // password

    $mail->setFrom('ceshiyouxiang000001@gmail.com','MaisoNetDoNotReply');      // From
    $mail->addAddress($email, $name." ".$prenom);          // To
    //$mail->AddReplyTo("ceshiyouxiang000001@gmail.com","Ceshi Mail");    // Not necessary

    $mail->Subject = 'Bienvennue sur MaisonNet !';                                                                    // Subject
    $mail->Body = "Merci d'avoir choisi MaisoNet, voici les informations saisi lors de l'inscription :\r\nInscription sur MaisoNet :\r\n"."Nom : ".$name."\r\n"."Prénom : ".$prenom."\r\n"."Add. Mail : ".$email."\r\n"."Date de naissance : ".$datenaissance."\r\nNuméro de tel : ".$numtel;                                            //  Mail content
    //$mail->addAttachment('C:\Users\chenw\Desktop\e\kao.jpg', 'kao.jpg');       // Attachment

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;

        if ($try > 0) {
            echo "try possible: ".$try;
            echo "Retry in 10s";
            sleep(10);
            $try--;
            sendConfirmMail($name, $prenom, $email, $datenaissance, $numtel, $try);
        }else{
            echo "Failed to send confirm mail. Please contat administrator.";
        }
    } else {
        echo "Mail sent.";
    }
}


function sendConfirmMailAfterResgist($name, $prenom, $email,$password, $datenaissance,$numtel, $try){
    $mail  = new PHPMailer();
    $mail->CharSet ="UTF-8";  // default: ISO-8859-1

    $mail->IsSMTP();                            // Use SMTP
    $mail->SMTPAuth = true;                     // Turn on authentication


    $mail->SMTPSecure = "tls";            // ssl or tls
    $mail->Host = "smtp.gmail.com";       // SMTP server
    $mail->Port = 587;                    // Port (ssl:465 tls：587)

    $mail->Username = 'ceshiyouxiang000001@gmail.com';  // username
    $mail->Password = "Testmail001";                    // password

    $mail->setFrom('ceshiyouxiang000001@gmail.com','MaisoNetDoNotReply');      // From
    $mail->addAddress($email, $name." ".$prenom);          // To
    //$mail->AddReplyTo("ceshiyouxiang000001@gmail.com","Ceshi Mail");    // Not necessary

    $mail->Subject = 'Information necésaire pour vous connecter sur le site';                                                                    // Subject
    $mail->Body = "Merci d'avoir choisi MaisoNet, votre demande a été confirmé.\r\nVoici vos informations :\r\n"."Nom : ".$name."\r\n"."Prénom : ".$prenom."\r\n"."Add. Mail : ".$email."\r\n"."Mot de passe : ".$password."\r\n"."Date de naissance : ".$datenaissance."\r\nNuméro de tel : ".$numtel."\r\n"."Vous pouvez maintenant vous connecter sur le site en utilisant votre adress mail et le mot de passe donné.";                                            //  Mail content
    //$mail->addAttachment('C:\Users\chenw\Desktop\e\kao.jpg', 'kao.jpg');       // Attachment

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;

        if ($try > 0) {
            echo "try possible: ".$try;
            echo "Retry in 10s";
            sleep(10);
            $try--;
            sendConfirmMailAfterResgist($name, $prenom, $email, $datenaissance, $numtel, $try);
        }else{
            echo "Failed to send confirm mail. Please contat administrator.";
        }
    } else {
        echo "Mail sent.";
    }
}


?>