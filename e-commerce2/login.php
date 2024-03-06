<?php
session_start();
include('server/connection.php');

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}
if(isset($_POST['login_btn'])){


    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password, email_verified_at FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
    $stmt->bind_param('ss',$email,$password);
    if($stmt->execute()){
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password, $email_verified_at);
        $stmt->store_result();
        
        if($stmt->num_rows() == 1){
            $stmt->fetch();
            if($email_verified_at == NULL){
                header('location: login.php?error_verified_email=Please verify your email ');
                $_SESSION['user_email'] = $user_email;
            }else{
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;
    
                header('location: account.php?login_success=logged in successfully');
            }

        }else{
            header('location: login.php?error=could not verify your account');

        }
    }else{
        //error
        header('location: login.php?error=something went wrong');
    }
}
?>


<?php include('layouts/header.php');?>
    <!--Login-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="login.php" method="POST" id="login-form">
                <p style="color:red" class="text-center"><?php if (isset($_GET['error'])) {echo $_GET['error'];}?></p>
                <p style="color:red" class="text-center"><?php if (isset($_GET['login_now'])) {echo $_GET['login_now'];}?></p>
                <p style="color:red" class="text-center">
                    <?php if (isset($_GET['error_verified_email'])) {echo $_GET['error_verified_email'];}?>
                    <?php if(isset($_GET['error_verified_email'])) {?>
                        <a href="email_verification.php?email=<?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'] ;}else{ echo "100";}?>" class="btn btn-primary">Verify Email</a>
                    <?php } ?>
                </p>
                
                <div class="form-group">
                     <label>Email</label>
                     <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
               </div>
                <div class="form-group"> 
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
                </div>
                <div class="form-group"> 
                    <a id="register-url" href="register.php" class="btn">Don't have account? Register</a>
                </div>
            </form>
        </div>
    </section>
    
<?php include('layouts/footer.php');?>