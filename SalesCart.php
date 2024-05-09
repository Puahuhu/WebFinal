<?php
    session_start(); // Bắt đầu session
?>
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
    <link rel="stylesheet" href="css/Cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
    function updateTotal() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var totalPrice = 0;
        var totalQuantity = 0;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                var productPrice = parseInt(checkbox.parentElement.querySelector('.product-price').value);
                totalPrice += productPrice;
                totalQuantity++;
            }
        });

        // Cập nhật hiển thị tổng giá trị và số lượng sản phẩm
        document.getElementById('totalPrice').innerText = totalPrice;
        document.getElementById('totalQuantity').innerText = totalQuantity;

    }
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
                <a href="SalesAccMana.php">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>

                <a href="SalesCustomerMana.php">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="SalesTransaction.php">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="SalesReport.php" class="active">
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
                    <img src="images/hong.png" width="40px" height="40px" alt="">
                    <div>
                        <h4 class="yellow text-hover1"> Dang Thi Kim Hong </h4>
                        <small> Salesperson</small>
                    </div>
                </div>

            </header>
            <main class="scrollable-content">
                <div class="right-aligned card-single2 cart-header">
                    <span> Customer Payment </span>
                </div>
                <div class="right-aligned4 card-single3 cart-icon">
                    <div class="avatar1">
                        <button><img src="images/cart_icon.png"></button>
                    </div>
                </div>
                <div class="recent-grid ">
                    <div class="customers right-aligned2">
                        <div class="card scrollable-content1">
                            <div class="card-header1">
                                <h3 class="danger"> List of products </h3>
                            </div>
                            <?php
                                function updateSessionTotal($totalPrice, $totalQuantity) {
                                    $_SESSION['cart_total_price'] = $totalPrice;
                                    $_SESSION['cart_total_quantity'] = $totalQuantity;
                                }

                                // Kiểm tra xem có dữ liệu được gửi qua phương thức POST không
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // Kiểm tra xem có dữ liệu productId được gửi không
                                    if (isset($_POST['productId'])) {
                                        // Lấy số lượng sản phẩm
                                        $numProducts = count($_POST['productId']);
                                        $totalPrice = 0;
                                        $totalQuantity = 0;

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
                                            echo '<span><button>Delete</button></span>';
                                            echo '<input type="hidden" class="product-price" value="' . $productPrice . '">';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';

                                            // Tính toán tổng số tiền và số lượng sản phẩm
                                            $totalPrice += $productPrice;
                                            $totalQuantity++;
                                        }

                                        // Cập nhật session với tổng số tiền và số lượng sản phẩm
                                        updateSessionTotal($totalPrice, $totalQuantity);
                                    }
                                }
                                ?>
                        </div>
                    </div>
                    <div class="customers right-aligned3">
                        <div class="card">
                            <div class="card-header1">
                                <h4 class="danger"> Total
                                    <h5><span id="totalQuantity">0</span> products</h5>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <div class="operation_actived2">
                                            <h6>$<span id="totalPrice">0</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="home">
                    <div class="home-text">
                        <table>
                            <tr>
                                <td>
                                    <p>Mobile:</p>
                                </td>
                                <td>
                                    <p>
                                        <a><input type="text" id="" placeholder="-" required></a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Full Name:</p>
                                </td>
                                <td>
                                    <p>
                                        <a><input type="text" placeholder="-" required></a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Address:</p>
                                </td>
                                <td>
                                    <p>
                                        <a><input type="text" placeholder="-" required></a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Total Order Value:</p>
                                </td>
                                <td>
                                    <p>
                                        <a><input type="text" placeholder="-" required></a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Money Customer Give</p>
                                </td>
                                <td>
                                    <p>
                                        <a><input type="text" placeholder="-" required></a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Money Back</p>
                                </td>
                                <td>
                                    <p>
                                        <a><input type="text" placeholder="-" required></a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Creation Date:</p>
                                </td>
                                <td>
                                    <p>
                                        <a><input type="date" placeholder="-" required></a>
                                    </p>
                                </td>
                            </tr>

                        </table>
                        <div class="main-btn">
                            <a href="#" class="btn2"><input type="submit" value="Invoice"></a>
                            <a href="#" class="btn3"><input type="submit" value="Cancel"></a>
                        </div>
                    </div>

                </div>

            </main>

        </div>
    </div>
</body>

</html>