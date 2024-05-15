
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Cart </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/Cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .btn4 {
    display: inline-block;
    padding: 5px 15px;
    background: silver;
    color: black;
    border: 3px double black;
    font-size: 15px;
    font-weight: 400;
    border-radius: 10px;
    
    }

    .btn4:hover {
    transform: translateY(-5px);
    background: transparent var(--clr-dark);
    color: white;
    transform: scale(1.05);
    }

</style>
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
                <a href="../../admin/ProductMana/AdminProdMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3> Product Catalog Management </h3>
                </a>
                <a href="../../admin/CustomerMana/AdmCustomerMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="AdminTransaction.php" class="active sidebar-link">
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
                    </label> Cart Products
                </h1>

                <div class="user-wrapper">
                    <!--  -->
                </div>

            </header>
            <main class="scrollable-content">
                <div class="right-aligned card-single2 cart-header">
                    <span> Customer Payment </span>
                </div>
                <div class="right-aligned4 card-single3 cart-icon">
                    <div class="avatar1">
                        <button><img src="../../images/cart_icon.png"></button>
                    </div>
                </div>
                <div class="recent-grid ">
                    <div class="customers right-aligned2">
                        <div class="card scrollable-content1" id="productList">
                            <div class="card-header1">
                                <h3 class="danger"> List of products </h3>
                            </div>
                            <?php
                                function updateSessionTotal($totalPrice, $totalQuantity, $totalorderValue) {
                                    $_SESSION['cart_total_price'] = $totalPrice;
                                    $_SESSION['cart_total_quantity'] = $totalQuantity;
                                    $_SESSION['cart_total_order'] = $totalorderValue;
                                };
                                $numProducts = 0;
                                // Kiểm tra xem có dữ liệu được gửi qua phương thức POST không
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // Kiểm tra xem có dữ liệu productId được gửi không
                                    if (isset($_POST['productId'])) {
                                        // Lấy số lượng sản phẩm
                                        $numProducts = count($_POST['productId']);
                                        $totalPrice = 0;
                                        $totalQuantity = 0;
                                        $totalorderValue = 0;

                                        // Lặp qua từng sản phẩm để hiển thị thông tin và tính toán tổng
                                        for ($i = 0; $i < $numProducts; $i++) {
                                            $productId = $_POST['productId'][$i];
                                            $productName = $_POST['productName'][$i];
                                            $productPrice = $_POST['productPrice'][$i];
                                            $productImage = $_POST['productImage'][$i]; // Lấy giá trị của trường ẩn images

                                            // Hiển thị thông tin của từng sản phẩm
                                            echo '<div class="card-body">';
                                            echo '<div class="customer">';
                                            echo '<input type="checkbox" onchange="updateTotal()">';
                                            echo '<div class="info">';
                                            echo '<img src="' . $productImage . '" width="40px" height="40px" alt="">';
                                            echo '<div class="operation_actived">';
                                            echo '<h4 class="text-hover" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">'.$productName.'</h4>';
                                            echo '<h5>Amount:<span>1</span> </h5>';
                                            echo '<h5 data-price="'.$productPrice.'">' . $productPrice . '$</h5>';
                                            echo '<input type="hidden" class="product-price" value="' . $productPrice . '">';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';

                                            // Tính toán tổng số tiền và số lượng sản phẩm
                                            $totalPrice += $productPrice;
                                            $totalQuantity++;
                                            $totalorderValue += $productPrice;

                                        }

                                        // Cập nhật session với tổng số tiền và số lượng sản phẩm
                                        updateSessionTotal($totalPrice, $totalQuantity, $totalorderValue);
                                    }
                                }
                                ?>
                        </div>
                    </div>
                    <div class="customers right-aligned3">
                        <div class="card">
                            <div class="card-header1">
                                <h4 class="danger"> Total
                                    <h5><span id="totalQuantity"><?php echo $totalQuantity; ?>$ </span> products</h5>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <div class="operation_actived2">
                                            <h6>$<span id="totalPrice"><?php echo $totalPrice; ?>$ </span></h6>
                                        </div>
                                    </div>
                                    <div class="operation_actived2">
                                        <input type="button" class="btn4" value="Select all" id="selectAllCheckbox" onclick="toggleSelectAll()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="home">
                    <div class="home-text">
                        <form id="invoiceForm" method="post" action="ReceiptDetails_Admin.php?username=<?php echo urlencode($_GET['username']); ?>">
                            <input type="hidden" name="selectedProducts" id="selectedProductsInput">
                            <table>
                                <tr>
                                    <td>
                                        <p>Mobile:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="text" name="phone" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Full Name:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="text" name="name" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Address:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="text" name="address" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Total Order Value:</p>
                                    </td>
                                    <td>
                                        <p>  
                                        <a><input id="totalorderValue" type="text" name="total" placeholder="-"></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Money Customer Give</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="text" name="moneygive" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Money Back</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="text" name="moneyback" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Creation Date:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="date" name="date" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                
                            </table>
                            <div class="main-btn">
                                <input id="invoiceButton" class="btn2" type="submit" value="Invoice">
                                <input class="btn3" type="button" value="Cancel" onclick="window.history.back()">
                            </div>
                        </form>
                    </div>

                </div>

            </main>

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
<script>

    function updateTotal() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var totalPrice = 0;
        var totalQuantity = 0;
        var totalOrderValue = 0;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                var productPrice = parseInt(checkbox.parentElement.querySelector('.product-price').value);
                totalPrice += productPrice;
                totalQuantity++;
            }
        });

        // Tính toán lại totalOrderValue
        totalOrderValue = totalPrice;

        totalOrderValue = totalOrderValue === 0 ? "" : totalOrderValue;

        // Cập nhật hiển thị tổng giá trị và số lượng sản phẩm
        document.getElementById('totalPrice').innerText = totalPrice;
        document.getElementById('totalQuantity').innerText = totalQuantity;
        document.getElementById('totalorderValue').value = totalOrderValue; // Cập nhật giá trị vào input hidden
    }


    document.addEventListener("DOMContentLoaded", function () {
        // Lấy tất cả các checkbox
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Thêm sự kiện change cho mỗi checkbox
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    var productContainer = checkbox.closest('.customer');
                    var productName = productContainer.querySelector('.text-hover').innerText;
                    var productPrice = productContainer.querySelector('.product-price').value;
                    var productImage = productContainer.querySelector('img').getAttribute('src');

                    // In ra thông tin của sản phẩm vào console
                    console.log("Product Name: " + productName);
                    console.log("Product Price: " + productPrice);
                    console.log("Product Image: " + productImage);
                }
            });
        });

        // Update tổng tiền khi checkbox thay đổi
        updateTotal();

        // Thêm sự kiện cho nút Invoice
        document.getElementById('invoiceButton').onclick = function (event) {
            var form = document.getElementById('invoiceForm');
            var inputs = form.querySelectorAll('input[type="text"], input[type="date"]');
            var isEmpty = false;

            inputs.forEach(function(input) {
                if (input.value.trim() === '') { // Kiểm tra giá trị của trường nhập và loại bỏ khoảng trắng ở đầu và cuối chuỗi
                    isEmpty = true;
                }
            });

            if (isEmpty) {
                alert('Vui lòng điền đầy đủ thông tin!');
                event.preventDefault(); // Ngăn chặn hành vi mặc định của nút submit
                return; // Dừng việc thực hiện submit form nếu có trường dữ liệu trống
            }

            var selectedProducts = [];

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    var product = {};
                    var productContainer = checkbox.closest('.customer');
                    product.name = productContainer.querySelector('.text-hover').innerText;
                    product.price = productContainer.querySelector('.product-price').value;
                    product.image = productContainer.querySelector('img').getAttribute('src');
                    selectedProducts.push(product);
                }
            });

            var selectedProductsJSON = JSON.stringify(selectedProducts);
            form.querySelector('input[name="selectedProducts"]').value = selectedProductsJSON;

            if (selectedProducts.length === 0) {
                alert('Chưa có sản phẩm được chọn!');
                event.preventDefault(); // Ngăn chặn hành vi mặc định của nút submit
            }

            
        };

        // Lấy các phần tử HTML tương ứng
        var moneyCustomerGiveInput = document.querySelector('input[name="moneygive"]');
        var totalOrderValueInput = document.getElementById('totalorderValue');
        var moneyBackInput = document.querySelector('input[name="moneyback"]');

        // Thêm sự kiện xử lý khi giá trị "Money Customer Give" thay đổi
        moneyCustomerGiveInput.addEventListener('input', function () {
            var moneyCustomerGive = parseFloat(this.value);
            var totalOrderValue = parseFloat(totalOrderValueInput.value);

            if (moneyCustomerGive >= totalOrderValue) {
                
                var moneyBack = moneyCustomerGive - totalOrderValue;
                
                moneyBackInput.value = moneyBack; 
            } else {
                // Nếu giá trị "Money Customer Give" nhỏ hơn "Total Order Value", không hiển thị gì ở trường "Money Back"
                moneyBackInput.value = "";
            }
        });

    });

    function toggleSelectAll() {
        var checkboxes = document.querySelectorAll('#productList input[type="checkbox"]');
        var firstCheckbox = checkboxes[0]; // Lấy checkbox đầu tiên trong danh sách
        var areAllChecked = true; // Biến để kiểm tra xem tất cả các checkbox đã được chọn hay không

        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) { // Nếu có ít nhất một checkbox chưa được chọn
                areAllChecked = false;
            }
        });

        checkboxes.forEach(function(checkbox) {
            if (areAllChecked) {
                checkbox.checked = false; // Hủy chọn tất cả các checkbox
            } else {
                checkbox.checked = true; // Chọn tất cả các checkbox
            }
        });

        updateTotal();
    }
</script>
</html>