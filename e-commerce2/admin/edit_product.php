<?php include('header.php');?>

<?php

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param('i',$product_id);
    $stmt->execute();
    $products = $stmt->get_result(); //[]
}else if(isset($_POST['edit_btn'])){

    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $offer = $_POST['offer'];
    $color = $_POST['color'];
    $category = $_POST['category'];
    
    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_category=?, product_description=?, product_price=?,
                                product_special_offer=?, product_color=? WHERE product_id=?");
    $stmt->bind_param('ssssssi', $title, $category, $description, $price, $offer, $color, $product_id);
    if($stmt->execute()){
        header('location: products.php?edit_success_message=Product has been updated successfully');
    }else{
        header('location: products.php?edit_failure_message=Error occured, try again');
    }

    

}else{
    header('products.php');
    exit();
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
                        
                    <h3 style="padding-bottom:10px ;padding-top:30px ;">Edit Product</h3>
                        <div class="row">
                       
                            <div class="col-lg-12">
                                
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <!-- <div class="card-header">Credit Card</div> -->
                                    <div class="card-body">
                                      
                                        <form action="edit_product.php"  method="POST" >
                                            <p style="color:red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                                            <div class="form-group">
                                                <?php foreach ($products as $product) { ?>

                                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>"/>
                                                    <label>Title</label>
                                                    <input value="<?php echo $product['product_name'] ?>" name="title" type="text" class="form-control" placeholder="Title" required >
                                            </div>
                                            <div class="form-group">
                                                <label >Description</label>
                                                <input name="description" type="text"  value="<?php echo $product['product_description'] ?>" class="form-control" placeholder="Description" required >
                                            </div>
                                            <div class="form-group">
                                                <label >Price</label>
                                                <input  name="price" type="text" value="<?php echo $product['product_price'] ?>"  class="form-control" placeholder="Price" required >
                                            </div>

                                          
                                            <div class="form-group">  
                                            <label >Category</label>  
                                            <select class=" form-control control-label mb-1" required name="category">
                                                <option selected value="bags">Bags</option>
                                                <option value="shoes">Shoes</option>
                                                <option value="watches">Watches</option>
                                                <option value="clothes">Clothes</option>
                                            </select>
                                            </div>
                                            <div class="form-group">
                                                <label >Color</label>
                                                <input  name="color" type="text" value="<?php echo $product['product_color'] ?>"  class="form-control" placeholder="Color" varia-required="true" >
                                            </div>
                                            <div class="form-group">
                                                <label >Special Offer/Sale</label>
                                                <input name="offer" type="text" value="<?php echo $product['product_special_offer'] ?>"  class="form-control" placeholder="Sale %" varia-required="true" >
                                            </div>
                                            

                                            <div>
                                                <button type="submit" class="btn btn-lg" name="edit_btn" style="color:white;background-color: rgb(173, 2, 2);">
                                                   
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
