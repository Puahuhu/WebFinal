<?php
    $username = $_GET['username'];
?>

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
    <link rel="stylesheet" href="../../css/Product.css">
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
        $.get("../../api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("../../api/Admin/get-admin.php", function (data, status) {
                            if (status === "success" && data.status === true) {
                                var adms = data.data;
                                adms.forEach(function (adm) {
                                    if (adm.UserID === userId) {
                                        $(".user-wrapper").append(
                                            "<img src='" + adm.Avatar + "' width='40px' height='40px' alt=''>" +
                                            "<a href='../../admin/AccMana/AdminInformationMana.php?username=" + encodeURIComponent(username) + "&fullname=" + encodeURIComponent(adm.FullName) + "'><div><h4 class='yellow text-hover1'>" + adm.FullName + "</h4><small> Admin </small></div></a>"
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
            var nameResponseReceived = false;
            $.ajax({
                url: '../../api/Product/search-name.php',
                method: 'POST',
                data: { q: query },
                success: function (data) {
                    var productList = '';
                    var products = JSON.parse(data);
                    if (products.length > 0) {
                        nameResponseReceived = true;
                        products.forEach(function (product) {
                            productList += `
                                <div class="customer" onclick="redirectToCustomerDetails('${encodeURIComponent(product.ProductID)}')">
                                    <div class="info">
                                        <img src="${product.Images}" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover">${product.ProductName}</h4>
                                            <h5>${product.RetailPrice}$</h5>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        suggestions.innerHTML = productList;
                        suggestions.style.display = 'block';
                    } else {

                        searchByBarcode();
                    }
                }
            });

            function searchByBarcode() {
                if (!nameResponseReceived) {
                    $.ajax({
                        url: '../../api/Product/search-barcode.php',
                        method: 'POST',
                        data: { q: query },
                        success: function (data) {
                            var productList = '';
                            var products = JSON.parse(data);
                            products.forEach(function (product) {
                                productList += `
                                    <div class="customer" onclick="redirectToCustomerDetails('${encodeURIComponent(product.ProductID)}')">
                                        <div class="info">
                                            <img src="${product.Images}" width="40px" height="40px" alt="">
                                            <div class="operation_actived">
                                                <h4 class="text-hover">${product.ProductName}</h4>
                                                <h5>${product.RetailPrice}$</h5>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                            suggestions.innerHTML = productList;
                            suggestions.style.display = 'block';
                        }
                    });
                }
            }
        } else {
            suggestions.innerHTML = '';
            suggestions.style.display = 'none';
        }
    }
    var username = "<?php echo htmlspecialchars($_GET['username']); ?>";
    localStorage.setItem('username', username);

    var storedUsername = localStorage.getItem('username');

    function redirectToCustomerDetails(ProductID) {
        var username = localStorage.getItem('username');
        window.location.href = 'AdminProdDetails.php?ProductID=' + ProductID + '&username=' +encodeURIComponent(username) ;
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
            </div>
            <div class="sidebar">
                <a href="../../admin/AccMana/AccountManagement.php" class="sidebar-link">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>
                <a href="AdminProdMana.php" class="active sidebar-link">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3> Product Catalog Management </h3>
                </a>
                <a href="../../admin/CustomerMana/AdmCustomerMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="../../admin/Transaction/AdminTransaction.php" class="sidebar-link">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="../../admin/Report/AdminReport.php" class="sidebar-link">
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
                        <span class = "material-symbols-sharp" id="setting">receipt_long</span>
                    </label> Product Catalog Management
                </h1>
                <div class="search-wrapper">
                    <span class="las la-search white"></span>
                    <input type="search" placeholder="Search by product name or barcode" oninput="handleSearchInput(this.value)" />
                    <div id="suggestions" class="suggestions sidebar-link"></div>
                </div>
                <div class="user-wrapper">
                    <!--  -->
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
                                <form action="../../api/Product/delete-product.php" method="post">
                                    <input type="hidden" name="username" value="<?php echo $username; ?>">
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
                                <a class="sidebar-link" href="AdminProdDetails.php?ProductID=<?= $row['ProductID'] ?>"><button>More <label class="las la-arrow-right"></label></button></a>
                            </div>
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </main>
            <!-- <div class="right-aligned4 card-single3 cart-icon">
                <div class="avatar1">
                    <button><img src="../../images/cart_icon.png"></button>
                </div>
            </div> -->
            <div class="right-aligned card-single2">
                <button id="add" class="material-symbols-sharp"><span> <a href="AddProduct.php" class="sidebar-link"> Add Product</a></span> add_shopping_cart</button>
            </div>
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