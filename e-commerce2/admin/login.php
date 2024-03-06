<?php
include('header.php');
?>
<?php
include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit;
}
if(isset($_POST['login_btn'])){


    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    $stmt->bind_param('ss',$email,$password);
    if($stmt->execute()){
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();
        
        if($stmt->num_rows() == 1){
            $stmt->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?message=logged in successfully');

        }else{
            header('location: login.php?error=could not verify your account');

        }
    }else{
        //error
        header('location: login.php?error=something went wrong');
    }
}
?>


    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logoo.png" alt="shoop">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="login.php" method="POST">
                                <p style="color:red;"><?php if (isset($_GET['error'])) {
                                    echo $_GET['error']; }?></p>
                                <div class="form-group">
                                    <label class="text-center">Email Address</label>
                                    <input class="au-input au-input--full"  type="email" name="email"  placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label class="text-center">Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                              
                                <input type="submit" class="au-btn au-btn--block  m-b-12" name="login_btn" style="background-color: rgb(173, 2, 2); " value="Login"/>
                               
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->