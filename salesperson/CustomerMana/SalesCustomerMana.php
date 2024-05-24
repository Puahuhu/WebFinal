<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Customer Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../../css/CustomerManagement.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    .suggestions {
        position: absolute;
        top: calc(55px); /* Hiển thị khung gợi ý ngay dưới thanh tìm kiếm */
        right: 20%;
        border-radius: 30px;
        width: 40%;
        display: flex;
        align-items: center;
        overflow: hidden;
        max-height: 300px; /* Đặt chiều cao tối đa cho khung gợi ý */
        overflow-y: auto; 
        background-color: #404040; 
        display: none; /* Ẩn khung gợi ý ban đầu */
        z-index: 999; /* Đảm bảo khung gợi ý nằm trên các phần tử khác */
    }

    #suggestions::-webkit-scrollbar {
        width: 6px;
        background-color: silver;
        border-radius: 30px;
    } 

    #suggestions::-webkit-scrollbar-thumb {
        background-color: #242526;
        border-radius: 30px;
    }
</style>
</head>
<script>
    var username = "<?php echo htmlspecialchars($_GET['username']); ?>"; 
    $(document).ready(function () {
        var salespersonid;
        $.get("../../api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("../../api/Salesperson/get-saleperson.php", function (data, status) {
                            if (status === "success" && data.status === true) {
                                var employs = data.data;
                                employs.forEach(function (employ) {
                                    if (employ.UserID === userId) {
                                        $(".home-img").append("<img src='" + employ.Avatar + "'>");
                                        $(".user-wrapper").append(
                                            "<img src='" + employ.Avatar + "' width='40px' height='40px' alt=''>" +
                                            "<div><h4 class='yellow text-hover1'>" + employ.FullName + "</h4><small> Salesperson</small></div>"
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
    function handleSearchInput(query) {
            var suggestions = document.getElementById('suggestions');
            if (query.length >= 2) {
                $.ajax({
                    url: '../../api/Customer/search-name.php',
                    method: 'POST',
                    data: { q: query },
                    success: function (data) {
                        var customerList = '';
                        var customers = JSON.parse(data);
                        if (customers.length > 0) {
                            customers.forEach(function (Customer) {
                                customerList += `
                                <div class="customer sidebar-link" onclick="redirectToCustomerDetails(${Customer.CustomerID})">
                                        <div class="info">
                                            <div class="operation_actived ">
                                                <h4 class="text-hover sidebar-link">${Customer.FullName}</h4>
                                                <h5>${Customer.Phone}</h5>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                            suggestions.innerHTML = customerList;
                            suggestions.style.display = 'block';
                        } else {
                            suggestions.style.display = 'none';
                        }
                    }
                });
            } else {
                suggestions.innerHTML = '';
                suggestions.style.display = 'none';
            }
        }
        var username = "<?php echo htmlspecialchars($_GET['username']); ?>";
        localStorage.setItem('username', username);

        var storedUsername = localStorage.getItem('username');

        function redirectToCustomerDetails(CustomerID) {
            var username = localStorage.getItem('username');
            window.location.href = 'SalesCustomerDetails.php?username=' + encodeURIComponent(username) + '&CustomerID=' + CustomerID;
        }
</script>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../../images/logoteam.png" width="20px" height="20px" alt="">
                    <h2 class="success text-hover1">Point<span class="yellow"> Of</span> Sale</h2>
                </div>
                <div class="close">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>v
            <div class="sidebar">
                <a href="../../salesperson/AccMana/SalesAccMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>

                <a href="SalesCustomerMana.php" class="active sidebar-link">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="../../salesperson/Transaction/SalesTransaction.php" class="sidebar-link">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="../../salesperson/Report/SalesReport.php" class="sidebar-link">
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
                        <span class = "material-symbols-sharp" id="setting">person</span>
                    </label> Customer Management
                </h1>
                <div class="search-wrapper">
                    <span class="las la-search white"></span>
                    <input type="search" placeholder="Search by customer name" oninput="handleSearchInput(this.value)" />
                    <div id="suggestions" class="suggestions sidebar-link"></div>
                </div>
                
                <div class="user-wrapper">
                    <!--  -->
                </div>
            </header>
            <div class="main-content">
            
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
                                    <tbody class="info1">
                                    <thead>
                                        <tr>
                                            <td class="danger adjust-size">Fullname</td>
                                            <td class="danger adjust-size">Mobile</td>
                                            <td class="danger adjust-size ">Address</td>
                                            <td class="danger adjust-size"> Details </td>
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
                                    
                                        <tr>
                                            <td class="adjust-size1"><?= $row['FullName']?></td>
                                            <td class="adjust-size1">
                                                <span class=""></span><?= $row['Phone']?>
                                            </td>
                                            <td class="adjust-size1">
                                                <address> <?= $row['CustomerAddress']?></address>
                                            </td>
                                            <td class="operation_actived">
                                                <a class="sidebar-link" href="SalesCustomerDetails.php?CustomerID=<?= $row['CustomerID'] ?>"> <span class="material-symbol"><button>More</button></span></a>
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
                            <?php
                                        $conn = mysqli_connect("localhost", "root", "", "finalweb");

                                        if (!$conn) {
                                            die("Kết nối không thành công: " . mysqli_connect_error());
                                        }
                                        $today = date('Y-m-d');
                                        $sql = "SELECT * FROM customers WHERE date(CreatedDate) = '$today'";

                                        
                                        $result = mysqli_query($conn, $sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                


                                    ?>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <div>
                                            <h4> <?= $row['FullName'] ?> </h4>
                                            <span class="dateadd"><?= $today ?></span>
                                            <a class="sidebar-link" href="SalesCustomerDetails.php?CustomerID=<?= $row['CustomerID'] ?>">
                                                <span class="material-symbol card-header1"><button>More</button></span>
                                            </a>
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
            <!-- <div class="right-aligned4 card-single3 cart-icon">
                <div class="avatar1">
                    <button><img src="../../images/cart_icon.png"></button>
                </div>
            </div> -->
        </div>
    </div>
    <script>
    function redirectToLogout() {
        if (confirm("Do you want to log out?")) {
            window.location.href = "../../layout/AdminLogin.php";
        }
    }
</script>
</body>
</html>