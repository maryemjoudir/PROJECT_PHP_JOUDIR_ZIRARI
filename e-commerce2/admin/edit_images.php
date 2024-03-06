<?php include('header.php');?>


<?php
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
}else{
    header('location: products.php');
}
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
                        <li >
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
                                        <span class="au-breadcrumb-span" ><h2 style="color :rgb(173, 2, 2)">Edit Images</h2></span>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                    <h3 style="padding-bottom:10px ;padding-top:30px ;">Update Product Images</h3>
                        <div class="row">
                       
                            <div class="col-lg-12">
                                
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <!-- <div class="card-header">Credit Card</div> -->
                                    <div class="card-body">
                                      
                                        <form action="update_images.php" enctype="multipart/form-data"  method="POST" >    
                                            <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>

                                            <input type="hidden" name="product_id" value="<?php echo $product_id;?>"/>
                                            <input type="hidden" name="product_name" value="<?php echo $product_name;?>"/>
                                            
                                            <div class="form-group">    
                                                    <label>Image 1</label>
                                                    <input class="form-control" type="file" id="image1" name="image1" placeholder="Image 1" required/>       
                                            </div>

                                            <div class="form-group">
                                                <label >Image 2</label>
                                                <input class="form-control" type="file" id="image2" name="image2" placeholder="Image 2" required/>
                                            </div>

                                            
                                            

                                            <div class="form-group">
                                                <label >Image 3</label>
                                                <input class="form-control" type="file" id="image3" name="image3" placeholder="Image 3" required/>
                                            </div>
                                            <div class="form-group">
                                                <label >Image 4</label>
                                                <input class="form-control" type="file" id="image4" name="image4" placeholder="Image 4" required/>
                                            </div>
                                            
                                            

                                            <div>
                                                <button type="submit" class="btn btn-lg" name="update_images" style="color:white;background-color: rgb(173, 2, 2);">                                             
                                                    <span id="btn ">Update</span>   
                                                </button>
                                            </div>
                                           
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
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
