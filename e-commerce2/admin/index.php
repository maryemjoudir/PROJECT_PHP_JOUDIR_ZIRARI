<?php
include('header.php');
?>
<?php
if(!isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit();
}
?>

<?php

        //1. determine page no;
        if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
            //if user has already entered page then page number is the one that they selected
            $page_no = $_GET['page_no'];
        }else{
            //if user just entered the page then default pageis 1
            $page_no = 1;
        }


        //2. return number of products
        $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
        $stmt1->execute();
        $stmt1->bind_result($total_records);
        $stmt1->store_result();
        $stmt1->fetch();

        //3. products per page
        $total_records_per_page = 6;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";
        $total_no_of_page = ceil($total_records / $total_records_per_page);

        //4. get all products
        $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
        $stmt2->execute();
        $orders = $stmt2->get_result();




?>




    <div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php
                include('sidemenu.php');
            ?>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
            <section class="au-breadcrumb ">
                <div class="section_content section_content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span" ><h2 style="color :rgb(173, 2, 2)">Dashboard</h2></span>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <div class="section_content section_content--p30">
                    <div class="container-fluid">
                        
                    <h3 style="padding-bottom:10px ;padding-top:30px">Orders</h3>


                    <?php if(isset($_GET['order_updated'])){?>
                            <p class="text-center" style="color:green;"><?php echo $_GET['order_updated'];?></p>
                    <?php }?>

                    <?php if(isset($_GET['order_failed'])){?>
                            <p class="text-center" style="color:red;"><?php echo $_GET['order_failed'];?></p>
                    <?php }?>

                    <?php if(isset($_GET['deleted_successfully'])){?>
                            <p class="text-center" style="color:green;"><?php echo $_GET['deleted_successfully'];?></p>
                    <?php }?>

                    <?php if(isset($_GET['deleted_failure'])){?>
                            <p class="text-center" style="color:red;"><?php echo $_GET['deleted_failure'];?></p>
                    <?php }?>

                        <div class="row">
                       
                            <div class="col-lg-12">
                                
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order Id</th>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">User Id</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">User Phone</th>
                                                <th scope="col">User Address</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($orders as $order){?>
                                            <tr>
                                                <td><?php echo $order['order_id'];?></td>
                                                <td><?php echo $order['order_status'];?></td>
                                                <td><?php echo $order['user_id'];?></td>
                                                <td><?php echo $order['order_date'];?></td>
                                                <td><?php echo $order['user_phone'];?></td>
                                                <td><?php echo $order['user_address'];?></td>
                                                <td><a class="btn btn-primary" style="color: white; border-radius:10px" href="edit_order.php?order_id=<?php echo $order['order_id'];?>">Edit</a></td>
                                                <td><a class="btn " href="delete_order.php?order_id=<?php echo $order['order_id'];?>" style="color: white; background-color:rgb(173, 2, 2) ;border-radius:10px">Delete</a></td>
                                                
                                                 
                                                 
                                            </tr>
                                            <?php }?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation example" class="mx-auto">
                                    <ul class="pagination mt-5 mx-auto">
                                        <li class="page-item <?php if($page_no <= 1) {echo 'disabled';}?> ">
                                            <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{ echo "?page_no".$page_no-1;} ?>">Pervious</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                                         
                                        <?php if($page_no >= 3) {?>
                                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                                            <li class="page-item"><a class="page-link" href="<?php "?page_no=".$page_no;?>"><?php echo $page_no;?></a></li>
                                        <?php }?>

                                        <li class="page-item <?php if ($page_no >= $total_no_of_page) {echo 'disabled';}?>">
                                            <a class="page-link" href="<?php if($page_no >= $total_no_of_page){echo '#';} else{ echo "?page_no=".$page_no+1;}?>">Next</a>
                                        </li>

                                    </ul>

                                </nav> 
                            </div>
                            
                        </div>
                        

                            </div>
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