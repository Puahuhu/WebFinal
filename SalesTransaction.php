<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Transaction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/Transaction.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .suggestions {
        position: absolute;
        top: calc(55px); /* Hiển thị khung gợi ý ngay dưới thanh tìm kiếm */
        left: 20%;
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
<script>
    var username = "<?php echo htmlspecialchars($_GET['username']); ?>"; 
    $(document).ready(function () {
        var salespersonid;
        $.get("api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("api/Salesperson/get-saleperson.php", function (data, status) {
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

    function addToCart(ProductId, ProductName, RetailPrice, Images) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'api/Product/add-to-card.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Product added to cart:');
                console.log('Product ID:', ProductId);
                console.log('Product Name:', ProductName);
                console.log('Retail Price:', RetailPrice);
                console.log('Images:', Images);

                updateCartUI(ProductId, ProductName, RetailPrice, Images);
            }
        };
        xhr.send('action=addToCart&productId=' + encodeURIComponent(ProductId) +
            '&ProductName=' + encodeURIComponent(ProductName) +
            '&ProductPrice=' + encodeURIComponent(RetailPrice)+
            '&Images=' + encodeURIComponent(Images));
    }
    var hiddenProductId;
    var hiddenProductName;
    var hiddenProductPrice;
    var hiddenProductImage;
    
    function updateCartUI(ProductId, ProductName, RetailPrice, Images) {
        var productContainer = document.createElement('div');
        productContainer.classList.add('card-body');
        productContainer.innerHTML = `
            <div class="customer">
                <div class="info">
                    <img src="${Images}" width="40px" height="40px" alt="">
                    <div class="operation_actived">
                        <h4 class="text-hover">${ProductName}</h4>
                        <h5>Amount:<span>1</span></h5>
                        <h5>${RetailPrice}$</h5>
                        <span><button onclick="deleteProduct(this)">Delete</button></span>
                    </div>
                </div>
            </div>
        `;

        hiddenProductId = createHiddenInput('productId[]', ProductId);
        hiddenProductName = createHiddenInput('productName[]', ProductName);
        hiddenProductPrice = createHiddenInput('productPrice[]', RetailPrice);
        hiddenProductImage = createHiddenInput('productImage[]', Images);
        
        document.getElementById('checkoutForm').appendChild(hiddenProductId);
        document.getElementById('checkoutForm').appendChild(hiddenProductName);
        document.getElementById('checkoutForm').appendChild(hiddenProductPrice);
        document.getElementById('checkoutForm').appendChild(hiddenProductImage);

        document.querySelector('.scrollable-content1').appendChild(productContainer);

        updateTotalPrice();
    }

    function createHiddenInput(name, value) {
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = name;
        hiddenInput.value = value;
        return hiddenInput;
    }


    function updateTotalPrice() {
        var totalPrice = calculateTotalPrice();
        var totalPriceElement = document.querySelector('.operation_actived2 h6');
        totalPriceElement.textContent = totalPrice + '$';
    }

    function calculateTotalPrice() {
        var totalPrice = 0;
        var cartItems = document.querySelectorAll('.scrollable-content1 .card-body');
        cartItems.forEach(function(item) {
            var priceString = item.querySelector('.operation_actived h5:nth-child(3)').textContent;
            var price = parseFloat(priceString.replace('$', ''));
            totalPrice += price;
        });
        return totalPrice;
    }

    function calculateTotalPrice() {
        var totalPrice = 0;
        var cartItems = document.querySelectorAll('.scrollable-content1 .card-body');
        cartItems.forEach(function(item) {
            var priceString = item.querySelector('.operation_actived h5:nth-child(3)').textContent;
            var price = parseFloat(priceString.replace('$', ''));
            totalPrice += price;
        });
        return totalPrice;
    }

    function deleteProduct(button) {
        var product = button.closest('.card-body');
        var productItem = document.getElementById('checkoutForm');

        var productIdInput = productItem.querySelector('input[name="productId[]"]');
        var productNameInput = productItem.querySelector('input[name="productName[]"]');
        var productPriceInput = productItem.querySelector('input[name="productPrice[]"]');
        var productImageInput = productItem.querySelector('input[name="productImage[]"]');
        productIdInput.remove();
        productNameInput.remove();
        productPriceInput.remove();
        productImageInput.remove();

        product.remove();

        var totalPrice = calculateTotalPrice();
        var totalPriceElement = document.querySelector('.operation_actived2 h6');
        totalPriceElement.textContent = totalPrice + '$';
    }


    function selectProductFromSuggestion(productID, productName, retailPrice, images) {
        addToCart(productID, productName, retailPrice, images);
        document.querySelector('.search-wrapper input').value = '';
        document.getElementById('suggestions').innerHTML = '';
        document.getElementById('suggestions').style.display = 'none';
    }

    function handleSearchInput(query) {
        var suggestions = document.getElementById('suggestions');
        if (query.length >= 2) {
            var nameResponseReceived = false;
            $.ajax({
                url: 'api/Product/search-name.php',
                method: 'POST',
                data: { q: query },
                success: function (data) {
                    var productList = '';
                    var products = JSON.parse(data);
                    if (products.length > 0) {
                        nameResponseReceived = true;
                        products.forEach(function (product) {
                            productList += `
                                <div class="customer" onclick="selectProductFromSuggestion('${product.ProductID}','${product.ProductName}', '${product.RetailPrice}', '${product.Images}')">
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
                        url: 'api/Product/search-barcode.php',
                        method: 'POST',
                        data: { q: query },
                        success: function (data) {
                            var productList = '';
                            var products = JSON.parse(data);
                            products.forEach(function (product) {
                                productList += `
                                    <div class="customer" onclick="selectProductFromSuggestion('${product.ProductID}','${product.ProductName}', '${product.RetailPrice}', '${product.Images}')">
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

    function sendCartData() {
        var form = document.getElementById('checkoutForm');
        form.submit();
    }

</script>
<body>
    <form id="checkoutForm" action="SalesCart.php" method="post">
        <!-- Các trường ẩn để lưu thông tin sản phẩm -->
    </form>
    <input type="hidden" id="cartData" name="cartData">
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
                <a href="SalesAccMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>
                <a href="SalesCustomerMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="SalesTransaction.php" class="active sidebar-link">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="SalesReport.php" class="sidebar-link">
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
                    </label> Transaction
                </h1>
                <div class="search-wrapper">
                    <span class="las la-search white"></span>
                    <input type="search" placeholder="Search here" oninput="handleSearchInput(this.value)" />
                    <div id="suggestions" class="suggestions"></div>
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
                        <button onclick="addToCart(<?= $row['ProductID'] ?>, '<?= $row['ProductName'] ?>', <?= $row['RetailPrice'] ?>, '<?= $row['Images'] ?>')">
                            <span class="material-symbols-sharp">add_shopping_cart</span>
                        </button>
                        </div>
                        <div>
                            <img src="<?= $row['Images'] ?>" width="150px" height="150px" alt="">
                        </div>
                        <div class="product-name ">
                            <?= $row['ProductName'] ?>
                        </div>
                        <div class="product-cost card-header">
                            <?= $row['RetailPrice'] ?>
                            <a href="SalesProductDetails.php?ProductID=<?= $row['ProductID'] ?>"><button> More <label class="las la-arrow-right"></label></button></a>
                        </div>
                     </div>   
                    <?php 
                            }
                        }
                    ?>
                    
                </div>
            </main>
            <div class="right-aligned card-single2 cart-icon">
                <div class="avatar">
                    <img src="images/cart_icon.png">
                </div>
            </div>
            <div class="right-aligned4 card-single3 cart-icon">
                <div class="avatar1">
                    <button><img src="images/cart_icon.png"></button>
                </div>
            </div>
            <div class="recent-grid">
                <div class="customers right-aligned2">
                    <div class="card scrollable-content1">
                        <div class="card-header1">
                            <h3 class="danger"> Cart Products </h3>
                        </div>
                    </div>
                </div>
                <div class="customers right-aligned3">
                    <div class="card">
                        <div class="card-header1">
                            <h4 class="danger"> Total </h4>

                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <div class="operation_actived2">
                                        <h6>0$</h6>
                                        <input type="hidden" id="cartData" name="cartData">
                                        <a><span><button onclick="sendCartData();">Checkout</button></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="js/click.js"></script>
</body>
</html>