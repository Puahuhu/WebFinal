<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@lastest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/CreateAccount.css">
</head>
<script>
    function redirectPage() {
        window.location.href = "AdminProdMana.php";
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
                <a href="AccountManagement.php">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>
                <a href="AdminProdMana.php">
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
                <a onclick="redirectToLogout()">
                    <span class="material-symbols-sharp">logout</span>
                    <h3> Logout </h3>
                </a>
            </div>
        </aside>
        <div class="main-content">
            <header>
                <div>
                    <h1 class="yellow text-hover1">
                        <label for="nav-toggle">
                            <span class = "material-symbols-sharp" id="setting">add_shopping_cart</span>
                        </label> Add Product
                    </h1>
                </div>
                <div>
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
                <div class="home">
                    <div class="home-text">
                        <form action="api/Product/add-product.php" method="POST">
                            <table>
                                <tr>
                                    <td>
                                        <p>Product ID:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input name="ProductID" type="text" id="" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Barcode:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input name="Barcode" type="text" id="" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Product Name:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input name="ProductName" type="text" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Import Price:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input name="ImportPrice" type="text" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Retail Price: </p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input name="RetailPrice" type="text" required placeholder="-"></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Category:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input name="CategoryID" type="text" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Creation Date:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input name="CreatedDate" type="date" id="dateproduct" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        <p>Image Import:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><button id="choose_avatar">Import</button></a>
                                        </p>
                                    </td>
                                </tr> -->
                            </table>
                        
                        <div class="main-btn">
                            <input type="submit" class="btn2" value="Add"></input>
                        </form>
                            <a href="AdminProdMana.php" class="btn3"><input type="submit" value="Cancel"></a>
                        </div>
                        
                    </div>
                    <div class="home-img">
                        <img src="images/logoteam.png">
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