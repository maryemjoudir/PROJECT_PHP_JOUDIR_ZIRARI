<?php
//Import PHPMailler classes into the global namespace
//These must be at the top of script
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'autoload.php';

//Load Composer's autoloader



session_start();

include('server/connection.php');
    //if user has already registred, then take user to account page
if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}
if (isset($_POST['register'])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
        
        // if passwords dont match
        if ($password !== $confirmPassword) {
            header('location: register.php?error=passwords dont match');

            // if password is less than 6 char 
        } else if (strlen($password) < 6) {
            header('location: register.php?error=password must be at least 6 charachters');


            //if there is not error
        } else {
            //check whether there is a user with this email or not
            $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
            $stmt1->bind_param('s', $email);
            $stmt1->execute();
            $stmt1->bind_result($num_rows);
            $stmt1->store_result();
            $stmt1->fetch();
            //if there is a user already registred with this email 
            if ($num_rows != 0) {
                header('location: register.php?error=user with this email already exists');

                //if no user registed with this email before
            } else {
                 //Instantiation and passing 'true' enables exceptions
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
                    $verification_code = substr(number_format(time() * rand(),0,'',''),0,6);
                    $mail->Subject = 'Email verification';
                    $mail->Body ='<p> Your verification code is: <b style="font-size: 30px;">'.$verification_code .'</b></p>';
                    $mail->send();
                    // echo 'Message has been sent';

                    //create a new user
                    $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password, verification_code)
                                    VALUES (?,?,?,?)");
                    $stmt->bind_param('ssss', $name, $email, md5($password), $verification_code);

                    //if account was created successfully
                    if ($stmt->execute()) {
                        /* 
                        $user_id = $stmt->insert_id;
                        $_SESSION['user_id']=$user_id;
                        $_SESSION['user_email'] = $email;
                        $_SESSION['name'] = $name;
                        $_SESSION['logged_in'] = true;
                        header('location: account.php?register_success=You registered successfully');
                        */
                        header('location: email_verification.php?email='. $email);
                        //account could not be created
                    } else {
                        header('location: register.php?error=could not create an account at the moment');
                    }
                } catch(Exception $e){
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
                }
            }
        }
}

  


?>

<?php include('layouts/header.php');?>
    <!--register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="" id="register-form" method="POST" action="register.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
               </div>
                <div class="form-group">
                     <label>Email</label>
                     <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
               </div>
               <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
                </div>
                <div class="form-group"> 
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>
                <div class="form-group"> 
                    <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
                </div>
            </form>
        </div>
    </section>

<?php include('layouts/footer.php');?>