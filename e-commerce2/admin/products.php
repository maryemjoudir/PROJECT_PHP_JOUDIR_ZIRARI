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
        $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
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
        $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
        $stmt2->execute();
        $products = $stmt2->get_result();




?>




    <div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
        <!-- MENU SIDEBAR-->
        <style>

            .padd{
                padding-top: 15px;
            }
        </style>
        <aside class="menu-sidebar d-none d-lg-block padd">
         
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li >
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="index.php">
                                <i class="fas fa-chart-bar"></i>Orders</a>
                        </li>
                        <li class="has-sub active">
                            <a href="products.php">
                                <i class="fas fa-table"></i>Products</a>
                        </li>
                        
                        <li>
                            <a href="add_product.php">
                                <i class="far fa-check-square"></i>Add New Product</a>
                        </li>
                        <li>
                            <a href="account.php">
                                <i class="fas fa-copy"></i>Account</a>
                        </li>
                        <li>
                            <a href="help.php">
                                <i class="fas fa-chart-bar"></i>Help</a>
                        </li>

                       
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
            <section class="au-breadcrumb ">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span" ><h2 style="color :rgb(173, 2, 2)">Products</h2></span>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <h3 style="padding-bottom:10px ;padding-top:30px">Products</h3>
                        <?php if(isset($_GET['edit_success_message'])){?>
                            <p class="text-center" style="color:green;"><?php echo $_GET['edit_success_message'];?></p>
                        <?php }?>

                        <?php if(isset($_GET['edit_failure_message'])){?>
                            <p class="text-center" style="color:red;"><?php echo $_GET['edit_failure_message'];?></p>
                        <?php }?>
                        
                        <?php if(isset($_GET['deleted_failure'])){?>
                            <p class="text-center" style="color:red;"><?php echo $_GET['deleted_failure'];?></p>
                        <?php }?>

                        <?php if(isset($_GET['product_failed'])){?>
                            <p class="text-center" style="color:red;"><?php echo $_GET['product_failed'];?></p>
                        <?php }?>
                        
                        <?php if(isset($_GET['product_created'])){?>
                            <p class="text-center" style="color:green;"><?php echo $_GET['product_created'];?></p>
                        <?php }?>

                        <?php if(isset($_GET['deleted_successfully'])){?>
                            <p class="text-center" style="color:green;"><?php echo $_GET['deleted_successfully'];?></p>
                        <?php }?>

                        <?php if(isset($_GET['images_failed'])){?>
                            <p class="text-center" style="color:red;"><?php echo $_GET['images_failed'];?></p>
                        <?php }?>
                        
                        <?php if(isset($_GET['images_updated'])){?>
                            <p class="text-center" style="color:green;"><?php echo $_GET['images_updated'];?></p>
                        <?php }?>
                        
                        <div class="row">
                       
                            <div class="col-lg-12">
                                
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Products Id</th>
                                                <th scope="col">Products Image</th>
                                                <th scope="col">Products Name</th>
                                                <th scope="col">Product Price</th>
                                                <th scope="col">Product Offer</th>
                                                <th scope="col">Product Category</th>
                                                <th scope="col">Product Color</th>
                                                <th scope="col">Edit Images</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($products as $product){?>
                                            <tr>
                                                <td><?php echo $product['product_id'];?></td>
                                                <td><img src="<?php echo "../assets/imgs/". $product['product_image'];?>" style="width: 70px; height:70px"/></td>
                                                <td><?php echo $product['product_name'];?></td>
                                                <td><?php echo "$".$product['product_price'];?></td>
                                                <td><?php echo $product['product_special_offer'] . "%";?></td>
                                                <td><?php echo $product['product_category'];?></td>
                                                <td><?php echo $product['product_color'];?></td>
                                                <td><a class="btn " href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name'];?>" style="color: white; border-radius:10px ;background-color:green">Edit Images</a></td>
                                                <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>" style="color: white; border-radius:10px">Edit</a></td>
                                                <td><a class="btn" href="delete_product.php?product_id=<?php echo $product['product_id'];?>" style="color: white; background-color:rgb(173, 2, 2) ;border-radius:10px">Delete</a></td>
                                                 
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
