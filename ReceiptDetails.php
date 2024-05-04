<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Receipt Details </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/Receipt.css">
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
                <a href="AccountManagement.php" class="active">
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
                        <span class = "material-symbols-sharp" id="setting">receipt_long</span>
                    </label> Receipt Details
                </h1>

                <div class="user-wrapper">
                    <img src="images/hong.png" width="40px" height="40px" alt="">
                    <div>
                        <h4 class="yellow text-hover1"> Dang Thi Kim Hong </h4>
                        <small> Salesperson</small>
                    </div>
                </div>

            </header>
            <main>

                <div class="right-aligned4 card-single3 cart-icon">
                    <div class="avatar1">
                        <button><img src="images/cart_icon.png"></button>
                    </div>
                </div>
                <div class="recent-grid ">
                    <div class="projects scrollable-content">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="yellow"> List of Products </h6>
                            </div>
                            <div class="card-body aligned">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td class="danger"></td>
                                            <td class="danger">Product</td>
                                            <td class="danger">Unit Price</td>
                                            <td class="danger">Amount</td>
                                            <td class="danger">Total Price </td>
                                        </tr>
                                    </thead>
                                    <tbody class="info1">
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/product1.png" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover">Iphone 15 Promax</td>
                                            <td>
                                                1200$
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>2400$</td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="customers right-aligned3">
                        <div class="card">
                            <div class="card-header1">
                                <h6 class="danger"> Total
                                    <h5 class="silver"> 5 products</h5>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <div>
                                            <h6 class="silver2">21600$ </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-single2 align3">
                        <button>Cancel</button>
                    </div>
            </main>
            </div>
</body>

</html>