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
<script>
    function addToCart(ProductId, ProductName, RetailPrice, Images) {
    // AJAX request to add product to cart
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'api/Product/add-to-card.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Success, log product information to console
                console.log('Product added to cart:');
                console.log('Product ID:', ProductId);
                console.log('Product Name:', ProductName);
                console.log('Retail Price:', RetailPrice);
                console.log('Images:', Images);

                // Update cart in UI
                updateCartUI(ProductId, ProductName, RetailPrice, Images);
            }
        };
        xhr.send('action=addToCart&productId=' + encodeURIComponent(ProductId) +
            '&ProductName=' + encodeURIComponent(ProductName) +
            '&ProductPrice=' + encodeURIComponent(RetailPrice)+
            '&Images=' + encodeURIComponent(Images));
    }

    function updateCartUI(ProductId, ProductName, RetailPrice, Images) {
        // Create HTML elements for the new product
        var productContainer = document.createElement('div');
        productContainer.classList.add('card-body');
        productContainer.innerHTML = `
            <div class="customer">
                <div class="info">
                    <img src="${Images}" width="40px" height="40px" alt="">
                    <div class="operation_actived">
                        <h4 class="text-hover">${ProductName}</h4>
                        <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>
                        <h5>${RetailPrice}$</h5>
                        <span><button>Delete</button></span>
                    </div>
                </div>
            </div>
        `;

        // Append the new product to the cart
        var cartContainer = document.querySelector('.scrollable-content1');
        cartContainer.appendChild(productContainer);

        // Calculate total price
        var totalPrice = calculateTotalPrice();

        // Update total price in the UI
        var totalPriceElement = document.querySelector('.operation_actived2 h6');
        totalPriceElement.textContent = totalPrice + '$';
    }

    // Function to calculate total price of all products in the cart
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
                <a href="SalesTransaction.php" class="active">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="SalesReport.php">
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
                    <input type="search" placeholder="Search here" />
                </div>
                <div class="user-wrapper">
                    <img src="images/hong.png" width="40px" height="40px" alt="">
                    <div>
                        <h4 class="yellow text-hover1"> Dang Thi Kim Hong </h4>
                        <small> Salesperson</small>
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
            <div class="recent-grid ">
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
                                        <h6></h6>
                                        <span><button>Checkout</button></span>
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