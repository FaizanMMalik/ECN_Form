<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if(isset($_POST['send'])){
   $mail = new PHPMailer(true);

   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = ''; //your gmail 
   $mail->Password = '';  // your gmail app password
   $mail->SMTPSecure = 'ssl';
   $mail->Port = 465;

   $mail->setFrom('');  //your gmail
   
   $mail->addAddress(''); //Email of the reciever

   $mail->isHTML(true);

   $mail->Subject = 'ECN FORM';
   $mail->Body = 'Hi';
   
    $mail->send();

    echo
    "
    <script>
    alert('sent Succesfully !');
    document.location.href = 'Email.php'
    </script>
    ";
   
    }
?>
<!DOCTYPE html>
<head>
<title>Send Email</title>
</head>
<body>

<form action="" method="post">
 
<button type="submit" name="send">Send</button>

</form>

</body>
</html> 
