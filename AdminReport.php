<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report And Analytics</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/Report.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
    var username = "<?php echo htmlspecialchars($_GET['username']); ?>"; 
    $(document).ready(function () {
        $.get("api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("api/Admin/get-admin.php", function (data, status) {
                            if (status === "success" && data.status === true) {
                                var adms = data.data;
                                adms.forEach(function (adm) {
                                    if (adm.UserID === userId) {
                                        $(".user-wrapper").append(
                                            "<img src='" + adm.Avatar + "' width='40px' height='40px' alt=''>" +
                                            "<div><h4 class='yellow text-hover1'>" + adm.FullName + "</h4><small> Admin </small></div>"
                                        );
                                    }
                                });
                            } else {
                                alert("Không thể tải dữ liệu từ server");
                            }
                        }, "json");
                    }
                });
            } else {
                alert("Không thể tải dữ liệu từ server");
            }
        }, "json");

        $(".sidebar-link").each(function() {
            // Lấy href của liên kết
            var href = $(this).attr("href");
            // Kiểm tra nếu href đã có tham số
            if (href.indexOf('?') !== -1) {
                // Nếu đã có tham số, thêm username vào cuối URL
                $(this).attr("href", href + "&username=" + encodeURIComponent(username));
            } else {
                // Nếu chưa có tham số, thêm username vào URL
                $(this).attr("href", href + "?username=" + encodeURIComponent(username));
            }
        });
    });
</script>
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
                <a href="AccountManagement.php" class="sidebar-link">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>
                <a href="AdminProdMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3> Product Catalog Management </h3>
                </a>
                <a href="AdmCustomerMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a>
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="AdminReport.php" class="active sidebar-link">
                    <span class="material-symbols-sharp">summarize</span>
                    <h3> Reporting and Analytics </h3>
                </a>
                <a onclick="redirectToLogout()">
                    <span class="material-symbols-sharp">logout</span>
                    <h3> Logout </h3>
                </a>
            </div>
        </aside>
        <div class="main-content">
            <header>
                <h1 class="yellow text-hover1">
                    <label for="nav-toggle">
                        <span class = "material-symbols-sharp" id="setting">settings</span>
                    </label> Report and Analytics
                </h1>
                <div class="search-wrapper">
                    <span class="las la-search white"></span>
                    <input type="search" placeholder="Search here" />
                </div>
                <div class="user-wrapper">
                    <!--  -->
                </div>
            </header>
            <main>
                <div class="cards1">
                    <div class="card-single5 active-button">
                        <button>Today</button>
                    </div>
                    <div class="card-single5 hover-button">
                        <a href="yesterday.php"> <button>Yesterday</button></a>
                    </div>
                    <div class="card-single5 hover-button">
                        <a href="TheLastSevenDays.php"> <button>The last 7 days</button></a>
                    </div>
                    <div class="card-single5 hover-button">
                        <a href="ThisMonth.php"> <button>This month</button></a>
                    </div>
                    <div class="card-single5 hover-button">
                        <a href="Fromto.php"> <button>From-To</button></a>
                    </div>
                </div>
                <div class="cards">
                    <div class="card-single">
                    <?php 
                        $conn = mysqli_connect("localhost", "root", "", "finalweb");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $today = date("Y-m-d");
                        $sql = "SELECT * FROM orders WHERE DATE(orders.OrderDate) = '$today'";
                        $sql1 = "SELECT count(*) as OrderID FROM orders WHERE DATE(orders.OrderDate) = '$today'";
                        $sql2 = "SELECT orders.*, orderDetails.*
                        FROM orders
                        INNER JOIN orderDetails ON orders.OrderID = orderDetails.OrderID WHERE DATE(orders.OrderDate) = '$today'";
                        $result = mysqli_query($conn, $sql);
                        $result1 = mysqli_query($conn, $sql1);
                        $result2 = mysqli_query($conn, $sql2);
                    
                        $totalAmountReceived = 0;
                        $NumberOfOrder = 0;
                        $NumberOfProduct = 0;
                    
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $totalAmountReceived += $row['TotalAmount'];
                            }
                        }
                        if (mysqli_num_rows($result1) > 0) {
                            $row1 = mysqli_fetch_assoc($result1);
                            $NumberOfOrder = $row1['OrderID'];
                        }
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $NumberOfProduct += $row2['Quantity'];
                            }
                        }
                    
                    ?>
                
                        <div>
                            <h1 class="white"><?= $totalAmountReceived ?>$</h1>
                            <span>Total Amount Received</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">payments</span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 class="white"><?= $NumberOfOrder ?></h1>
                            <span> Number Of Order </span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">receipt_long</span>
                        </div>
                    </div>
                    <div>
                        <div class="card-single">
                            <div>
                                <h1 class="white"><?=$NumberOfProduct ?></h1>
                                <span>Number Of Products</span>
                            </div>
                            <div>
                                <span class="material-symbols-sharp">inventory_2</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-single">

                        <div>
                            <h1 class="white">999999$</h1>
                            <span> Total Profit</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">paid</span>
                        </div>
                    </div>
                
                
                </div>
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
                                            $conn = mysqli_connect("localhost", "root", "", "finalweb");
                                            if (!$conn) {
                                                die("Connection failed: " . mysqli_connect_error());
                                            }
                                            $today = date("Y-m-d");
                                            $sql = "SELECT orders.*, orderDetails.*
                                                FROM orders
                                                INNER JOIN orderDetails ON orders.OrderID = orderDetails.OrderID WHERE DATE(orders.OrderDate) = '$today'" ;
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {

                                        ?>
                                        <tr>
                                            <td class="adjust-size1 center-aligned"><?= $row['TotalAmount'] ?></td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> <?= $row['MoneyGiven'] ?>
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> <?= $row['MoneyBack'] ?>
                                            </td>
                                            <td class="adjust-size1 center-aligned"><?= $row['OrderDate'] ?></td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> <?= $row['Quantity'] ?>
                                            </td>
                                            <td class="operation_actived center-aligned">
                                                <span class="material-symbol"><button>More</button></span>
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
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>



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
    <script src="js/click.js"></script>
</body>

</html>