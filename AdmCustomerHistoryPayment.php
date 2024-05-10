<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Customer History Payment</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/CustomerHistoryPayment.css">
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
                <a href="AccountManagement.php">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>
                <a href="AdminProdMana.php">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3> Product Catalog Management </h3>
                </a>
                <a href="AdmCustomerMana.php" class="active">
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
                        <span class = "material-symbols-sharp" id="setting">deployed_code_history</span>
                    </label> History Customer Transaction
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

            <head>

            <?php
                if(isset($_GET['CustomerID'])) {
                    $CustomerID = $_GET['CustomerID'];
                    
                    $conn = mysqli_connect("localhost", "root", "", "finalweb");
                    if (!$conn) {
                        die("Kết nối không thành công: " . mysqli_connect_error());
                    }
                    
                    $sql = "SELECT * FROM customers WHERE CustomerID = $CustomerID";
                    $result = mysqli_query($conn, $sql);
        
                    
                    if($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                ?>
                <div class="head-display">
                    <h5 class="material-symbols-sharp" id="icon_arrow">arrow_right</h5>
                    <label class="adjust-size3"><?= $row['FullName'] ?></label>
                </div>
                <?php
                    }
                }
                ?>
            </head>
            <main>
                <?php
                if(isset($_GET['CustomerID'])) {
                    $CustomerID = $_GET['CustomerID'];
                    
                    $conn = mysqli_connect("localhost", "root", "", "finalweb");
                    if (!$conn) {
                        die("Kết nối không thành công: " . mysqli_connect_error());
                    }
                    
                    $sql = "SELECT * FROM orders WHERE orders.CustomerID = $CustomerID";
                    $result = mysqli_query($conn, $sql);
                    $sql1 = "SELECT SUM(TotalAmount * Quantity) as TotalAmount FROM orders , orderdetails
                            WHERE orders.OrderID =orderdetails.OrderID and CustomerID = $CustomerID" ;
                    $result1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $totalAmount = $row1['TotalAmount'];

                    $sql2 = "SELECT SUM(Quantity) as Quantity FROM orderdetails
                    INNER JOIN orders ON orders.OrderID = orderdetails.OrderID
                    WHERE orders.CustomerID = $CustomerID";
                    $sql3 = "SELECT * from customers where customers.CustomerID = $CustomerID";
                    $result2 = mysqli_query($conn, $sql2);
                    $result3 = mysqli_query($conn, $sql3);


                    $totalPayment=0;
                    $totalNumberofProduct =0;
                    

                    
                    if($result2 && mysqli_num_rows($result2) > 0) {
                        $row2 = mysqli_fetch_assoc($result2);
                        $totalPayment = $row2['Quantity'];

                    }
                    if($result3 && mysqli_num_rows($result3) > 0) {
                        $row3 = mysqli_fetch_assoc($result3);

                  

            ?>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1 class="white quantity">$<?= $totalAmount ?></h1>
                        <span>Total Payment</span>
                    </div>
                    <div>
                        <span class="material-symbols-sharp">paid</span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1 class="white quantity"><?=$totalPayment?></h1>
                        <span>Total Numbers Of Transaction</span>
                    </div>
                    <div>
                        <span class="material-symbols-sharp">contract</span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <small class="success quantity">Customer</small>
                        <h6><?= $row3['FullName'] ?></h6>
                    </div>
                    <div class="avatar">
                        <img src="images/phuong.png">
                    </div>
                </div>
            </div>
            <?php
                  }
                }
            ?>
            <div class="recent-grid ">
                <div class="projects scrollable-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="yellow"> List of Receipts </h3>
                        </div>
                        <div class="card-body">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td class="danger adjust-size center-aligned">Total Amount:</td>
                                        <td class="danger adjust-size center-aligned">Money Given</td>
                                        <td class="danger adjust-size center-aligned">Money Back</td>
                                        <td class="danger adjust-size center-aligned">Creation Date</td>
                                        <td class="danger adjust-size center-aligned">Product Quantity</td>
                                        <td class="danger adjust-size center-aligned">Details</td>
                                    </tr>
                                </thead>
                                <tbody class="info1">
                                    <?php 
                                    if(isset($_GET['CustomerID'])) {
                                        $CustomerID = $_GET['CustomerID'];
                                        
                                        $conn = mysqli_connect("localhost", "root", "", "finalweb");
                                        if (!$conn) {
                                            die("Kết nối không thành công: " . mysqli_connect_error());
                                        }
                                        
                                        $sql = "SELECT * FROM orders ,orderdetails,customers WHERE orders.OrderID =orderdetails.OrderID and orders.CustomerID = customers.CustomerID and orders.CustomerID = $CustomerID";
                                        $result = mysqli_query($conn, $sql);
                            
                                        
                                        if($result && mysqli_num_rows($result) > 0) {
                                            $row2 = mysqli_fetch_assoc($result);
                
                                    ?>
                                    <tr>
                                        <td class="adjust-size1 center-aligned">$<?= $row2['TotalAmount'] ?></td>
                                        <td class="adjust-size1 center-aligned">
                                            <span class="adjust-size center-aligned"></span> $ <?= $row2['MoneyGiven'] ?>
                                        </td>
                                        <td class="adjust-size1 center-aligned">
                                            <span class="adjust-size"></span> $ <?= $row2['MoneyBack'] ?>
                                        </td>
                                        <td class="adjust-size1 center-aligned"><?= $row2['OrderDate'] ?></td>
                                        <td class="adjust-size1 center-aligned">
                                            <span class="adjust-size"></span> <?= $row2['Quantity'] ?>
                                        </td>
                                        <td class="operation_actived center-aligned">
                                        <a href="AdminCustomerInfoDetails.php?CustomerID=<?= $CustomerID ?>">
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="customers scrollable-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="yellow"> New Receipt</h3>
                        </div>
                        <?php
                        if(isset($_GET['CustomerID'])) {
                             $conn = mysqli_connect("localhost", "root", "", "finalweb");
                             $CustomerID = $_GET['CustomerID'];

                             if (!$conn) {
                                 die("Kết nối không thành công: " . mysqli_connect_error());
                             }
                             $today = date('Y-m-d');
                             $sql = "SELECT * FROM customers ,orders WHERE customers.CustomerID = orders.CustomerID and orders.CustomerID = $CustomerID and date(CreatedDate) = '$today'";

                             
                             $result = mysqli_query($conn, $sql);
                             // var_dump($result);
                         if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);
                        ?>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">

                                    <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                    <div>
                                        <h4> $<?= $row['TotalAmount'] ?> </h4>
                                        <span class="dateadd"><?=$today?></span>
                                        <a href="AdminCustomerInfoDetails.php?CustomerID=<?= $row['CustomerID'] ?>"><span class="material-symbol card-header1"><button>More</button></span></a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                             }
                            }
                        
                        ?>
                        
                        


                    </div>
                </div>
            </div>
        </main>
        <div class="right-aligned4 card-single3 cart-icon">
            <div class="avatar1">
                <button><img src="images/cart_icon.png"></button>
            </div>
        </div>
    </div>
</div>
</body>

</html>