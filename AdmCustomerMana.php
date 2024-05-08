


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Customer Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/CustomerManagement.css">
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
                        <span class = "material-symbols-sharp" id="setting">person</span>
                    </label> Customer Management
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
            <main>
                <div class="cards">

                    <div class="card-single">
                        <?php 
                            $conn = mysqli_connect("localhost", "root", "", "finalweb");

                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
                            $countQuery = "SELECT COUNT(*) AS totalCustomers FROM customers";
                            $countResult = mysqli_query($conn, $countQuery);

                            if ($countResult && mysqli_num_rows($countResult) > 0) {
                                $row = mysqli_fetch_assoc($countResult);
                                $totalCustomers = $row['totalCustomers'];
                        ?>
                        <div>
                            <h1 class="white quantity"><?= $totalCustomers ?></h1>
                            <span>Total Customer</span>
                        </div>
                        <?php
                            }
                        ?>
                        <div>
                            <span class="material-symbols-sharp">person</span>
                        </div>
                    </div>
                </div>
                <div class="recent-grid ">
                    <div class="projects scrollable-content">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="yellow"> List of Customer </h3>
                            </div>
                            <div class="card-body">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td class="danger adjust-size">Fullname</td>
                                            <td class="danger adjust-size">Mobile</td>
                                            <td class="danger adjust-size ">Address</td>
                                            <td class="danger adjust-size"> History Transaction </td>
                                        </tr>
                                    </thead>
                                    <?php
                                        $conn = mysqli_connect("localhost", "root", "", "finalweb");

                                        if (!$conn) {
                                            die("Kết nối không thành công: " . mysqli_connect_error());
                                        }
                                        $sql="select * from customers";
                                        
                                        $result = mysqli_query($conn, $sql);
                
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                


                                    ?>
                                    <tbody class="info1">
                                        <tr>
                                            <td class="adjust-size1"><?= $row['FullName']?></td>
                                            <td class="adjust-size1">
                                                <span class=""></span><?= $row['Phone']?>
                                            </td>
                                            <td class="adjust-size1">
                                                <address> <?= $row['CustomerAddress']?></address>
                                            </td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
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
                                <h3 class="yellow"> New Customer</h3>
                            </div>

                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/user_icon.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Nguyen Le Tuan Phuong </h4>
                                            <span class="dateadd">22/22/22</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/user_icon.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Dang Thi Kim Hong </h4>
                                            <span class="dateadd">22/22/22</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/user_icon.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Chau Thi Tram </h4>
                                            <span class="dateadd">22/22/22</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/user_icon.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Nguyen Tuan </h4>
                                            <span class="dateadd">22/22/22</span>

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
</body>

</html>