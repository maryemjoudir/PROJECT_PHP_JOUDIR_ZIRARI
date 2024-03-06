<?php include('header.php');?>


<?php
if (isset($_GET['order_id'])) {
    $product_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order = $stmt->get_result(); //[]
}else if(isset($_POST['edit_order'])){

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);
    if($stmt->execute()){
        header('location: index.php?order_updated=Order has been updated successfully');
    }else{
        header('location: index.php?order_failed=Error occured, try again');
    }
}else{
    header('location: index.php');
    exit;
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
                        <li class="has-sub active">
                            <a href="index.php">
                                <i class="fas fa-chart-bar"></i>Orders</a>
                        </li>
                        <li >
                            <a href="products.php">
                                <i class="fas fa-table"></i>Products</a>
                        </li>
                        <li>
                            <a href="account.php">
                                <i class="fas fa-copy"></i>Account</a>
                        </li>
                        <li>
                            <a href="add_new_product.php">
                                <i class="far fa-check-square"></i>Add New Product</a>
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
                                        <span class="au-breadcrumb-span" ><h2 style="color :rgb(173, 2, 2)">Orders</h2></span>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                    <h3 style="padding-bottom:10px ;padding-top:30px ;">Edit Orders</h3>
                        <div class="row">
                       
                            <div class="col-lg-12">
                                
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <!-- <div class="card-header">Credit Card</div> -->
                                    <div class="card-body">
                                      
                                        <form action="edit_order.php"  method="POST" >

                                            <?php foreach($order as $r) {?>
                                            <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                                            
                                            <div class="form-group">
                                                    
                                                    <label>OrderId</label>
                                                    <p><?php echo $r['order_id'];?></p>
                                            </div>

                                            <div class="form-group">
                                                <label >OrderPrice</label>
                                                <p ><?php echo $r['order_cost'];?></p>
                                            </div>

                                            <input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>"/>
                                            
                                            <div class="form-group">  
                                                    <label >Order Status</label>  
                                                <select class=" form-control control-label mb-1" required name="order_status">
                                                
                                                    <option selected value="not paid"  <?php if($r['order_status']=='not paid'){ echo "selected"; }?>>Not Paid</option>
                                                    <option value="paid" <?php if($r['order_status']=='paid'){ echo "selected"; }?>>Paid</option>
                                                    <option value="shipped" <?php if($r['order_status']=='shipped'){ echo "selected"; }?>>Shipped</option>
                                                    <option value="delivered" <?php if($r['order_status']=='delivered'){ echo "selected"; }?>>Delivered</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label >OrderDate</label>
                                               <p class="my-4"><?php echo $r['order_date'];?></p>
                                            </div>
                                            
                                            

                                            <div>
                                                <button type="submit" class="btn btn-lg" name="edit_order" style="color:white;background-color: rgb(173, 2, 2);">
                                                   
                                                    <span id="btn ">Edit</span>
                                                    
                                                </button>
                                            </div>
                                            <?php }?>
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
