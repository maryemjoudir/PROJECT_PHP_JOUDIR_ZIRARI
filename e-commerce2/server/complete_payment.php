<?php 
//Import PHPMailler classes into the global namespace
//These must be at the top of script
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'autoload.php';

session_start();
include('connection.php');

if(isset($_GET['transaction_id']) && isset($_GET['order_id'])){

        $order_id = $_GET['order_id'];
        $price =$_GET['price'];
        $order_status = "paid";
        $transaction_id = $_GET['transaction_id'];
        $user_id = $_SESSION['user_id'];
        $payment_date = date('Y-m-d H:i:s');
        $email = $_SESSION['user_email'];
        $name = $_SESSION['user_name'];

        //change order_status to paid
        $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
        $stmt->bind_param('si',$order_status,$order_id);
        $stmt->execute();

        //store payment info
        $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id,transaction_id,payment_date)
        VALUES (?,?,?,?); ");
        $stmt1->bind_param('iiss',$order_id,$user_id,$transaction_id, $payment_date);
        $stmt1->execute();

        //------------Send Email-----------

                $mail = new PHPMailer(true);
                try{
                    //enable verbose debug output
                    $mail->SMTPDebug = 0;
                    //Send using SMTP
                    $mail->isSMTP();   
                    //Set the SMTP server to send through
                    $mail->Host = 'smtp.gmail.com';
                    //Enable SMTP authentification
                    $mail->SMTPAuth = true;
                    //SMTP username
                    $mail->Username  = 'shoopphp@gmail.com';                     
                    //SMTP password
                    $mail->Password  = 'pqalbvqwerokpwrt';
                    //Enable TLS encryption
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    //TCP port to connect to, use 465 for
                    $mail->Port = 587;
                    //Recipients
                    $mail->setFrom('shoopphp@gmail.com','shop.com');
                    //Add a recipient
                    $mail->addAddress($email,$name);
                    //set email format to HTML
                    $mail->isHTML(true);
                    $mail->Subject = 'Email payment';
                    $mail->Body ='<p> We have received your payment in the amount of , : <b style="font-size: 16px;">'.$price.'$</b>  thanks for your shopping with us</p> ';
                    $mail->send();
                    // echo 'Message has been sent';
                  
                } catch(Exception $e){
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
                }
        //--------------Send Email-------------------

        //go to user account
        header("location: ../account.php?payment_message=paid successfuly, thanks for your shopping with us");
}else{
    header("location: ../index.php");
    exit;
}



?>