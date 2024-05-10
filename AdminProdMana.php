<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Product Catalog Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/Product.css">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="images/logoteam.png" width="20px" height="20px" alt="">
                    <h2 class="success text-hover1">Point<span class="yellow"> Of</span> Sale</h2>
                </div>
                <div class="close">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="AccountManagement.php" >
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>
                <a href="AdminProdMana.php" class="active">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3> Product Catalog Management </h3>
                </a>
                <a href="AdmCustomerMana.php">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="AdminReport.php">
                    <span class="material-symbols-sharp">summarize</span>
                    <h3> Reporting and Analytics </h3>
                </a>
                <a href="#">
                    <span class="material-symbols-sharp">logout</span>
                    <h3> Logout </h3>
                </a>
            </div>
        </aside>
        <div class="main-content">
            <header>
                <h1 class="yellow text-hover1">
                    <label for="nav-toggle">
                        <span class = "material-symbols-sharp" id="setting">receipt_long</span>
                    </label> Product Catalog Management
                </h1>
                <div class="search-wrapper">
                    <span class="las la-search white"></span>
                    <input type="search" placeholder="Search here" />
                </div>
                <div class="user-wrapper">
                    <img src="images/quynh.png" width="40px" height="40px" alt="">
                    <div>
                        <h4 class="yellow text-hover1"> Nguyen Dang Nhu Quynh </h4>
                        <small> Admin</small>
                    </div>
                </div>
            </header>
            <main class="scrollable-content">
                <div class="cards">
                    <?php 
                        $conn = mysqli_connect("localhost", "root", "", "finalweb");

                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql="select * from products";
                        
                        $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {

                    ?>
                       <div class="card-single">
                            <div class="delete-product">
                                <form action="api/Product/delete-product.php" method="post">
                                    <input type="hidden" name="ProductID" value="<?php echo $row['ProductID']; ?>">
                                    <button id="button_delete1"><span class="material-symbols-sharp" id="delete1">close</span></button>
                                    
                                </form>    
                            </div>
                            <div>
                                <img src="<?php echo $row['Images']; ?>" width="150" height="150" alt="">
                            </div>
                            <div class="product-name ">
                                <?php echo $row['ProductName'] ;?>
                            </div>
                            <div class="product-cost card-header">
                                $<?php echo $row['RetailPrice']; ?>
                                <a href="AdminProdDetails.php?ProductID=<?= $row['ProductID'] ?>"><button>More <label class="las la-arrow-right"></label></button></a>
                            </div>
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </main>
            <div class="right-aligned4 card-single3 cart-icon">
                <div class="avatar1">
                    <button><img src="images/cart_icon.png"></button>
                </div>
            </div>
            <div class="right-aligned card-single2">
                <button id="add" class="material-symbols-sharp"><span> <a href="AddProduct.php"> Add Product</a></span> add_shopping_cart</button>
            </div>
            <div class="recent-grid ">
                <div class="customers right-aligned2">
                    <div class="card scrollable-content1">
                        <div class="card-header1">
                            <h3 class="danger"> Activities Recent</h3>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <?php

                                    ?>
                                <div class="info">
                                    
                                    <img src="images/product3.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Samsung Galaxy </h4>
                                        <h5> 28/04/2024 </h5>
                                    </div>
                                </div>
                                <?php

                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="images/product4.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Iphone 14 </h4>
                                        <h5> 26/04/2024 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="images/product5.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Xiaomi </h4>
                                        <h5> 25/04/2024 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="images/product6.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Camera </h4>
                                        <h5> 22/04/2024 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="images/product6.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Camera </h4>
                                        <h5> 22/04/2024 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="images/product6.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Camera </h4>
                                        <h5> 22/04/2024 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="images/product6.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Camera </h4>
                                        <h5> 22/04/2024 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="images/product6.png" width="40px" height="40px" alt="">
                                    <div>
                                        <h4 class="text-hover"> Camera </h4>
                                        <h5> 22/04/2024 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>