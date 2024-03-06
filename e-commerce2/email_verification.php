<?php
session_start();
include('server/connection.php');


if(isset($_POST['verify_email'])){

    $email = $_POST['email'];
    $verification_code =$_POST['verification_code'];
    $email_verified_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("UPDATE users SET email_verified_at = ? WHERE user_email = ? AND verification_code = ? ");
    $stmt->bind_param('sss',$email_verified_at,$email,$verification_code);


    if($stmt->execute()){
       
        header('location: login.php?login_now=You Can Login Now');       
        
    }else{
        //error
        header('location: email_verification.php?error=Verification code failed.');
    }
}
?>


<?php include('layouts/header.php');?>
    <!--email verification-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Verify your email</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="email_verification.php" method="POST" id="login-form">
                <p style="color:red" class="text-center"><?php if (isset($_GET['error'])) {echo $_GET['error'];}?></p>
                
                <input type="hidden" name="email" value="<?php echo $_GET['email'] ;?>"/>
                <div class="form-group">
                     <label>Enter verification code </label>
                     <input type="text" class="form-control" id="code_verification" name="verification_code" placeholder="Enter verification code" required/>
                </div>
            
                <div class="form-group"> 
                    <input type="submit" class="btn" id="login-btn" name="verify_email" value="Verify Email"/>
                </div>
        
            </form>
        </div>
    </section>
    
<?php include('layouts/footer.php');?>