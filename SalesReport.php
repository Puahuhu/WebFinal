<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report And Analytics</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/SalesReport.css">
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
                        <span class = "material-symbols-sharp" id="setting">settings</span>
                    </label> Report and Analytics
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
            <main>
                <div class="right-aligned7">
                    <span class="silver">Start date</span>
                </div>
                <div class="right-aligned8">
                    <span class="silver">End date</span>
                </div>
                <div class="right-aligned">
                    <input type="date">
                </div>
                <div class="right-aligned5">
                    <input type="date">
                </div>
                <div class="right-aligned6">
                    <input type="submit">
                </div>
                <div class="cards1">
                    <div class="card-single5 active-button">
                        <button>Today</button>
                    </div>
                    <div class="card-single5 hover-button">
                        <button>Yesterday</button>
                    </div>
                    <div class="card-single5 hover-button">
                        <button>The last 7 days</button>
                    </div>
                    <div class="card-single5 hover-button">
                        <button>This month</button>
                    </div>
                </div>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1 class="white">1000000$</h1>
                            <span>Total Amount Received</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">payments</span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 class="white">15</h1>
                            <span> Number Of Order </span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">receipt_long</span>
                        </div>
                    </div>
                    <div>
                        <div class="card-single">
                            <div>
                                <h1 class="white">29</h1>
                                <span>Number Of Products</span>
                            </div>
                            <div>
                                <span class="material-symbols-sharp">inventory_2</span>
                            </div>
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
                                            <td class="danger adjust-size">Barcode</td>
                                            <td class="danger adjust-size">Product Name</td>
                                            <td class="danger adjust-size center-aligned">Cost</td>
                                            <td class="danger adjust-size">Date</td>
                                            <td class="danger adjust-size">Recepit Details</td>
                                        </tr>
                                    </thead>
                                    <tbody class="info1">
                                        <tr>
                                            <td class="adjust-size1">3824826434</td>
                                            <td class="adjust-size1">
                                                <span class="adjust-size"></span> Iphone 14 promax
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 20$
                                            </td>
                                            <td class="adjust-size1">04/04/2024</td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1">3824826434</td>
                                            <td class="adjust-size1">
                                                <span class="adjust-size"></span> Iphone 14 promax
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 20$
                                            </td>
                                            <td class="adjust-size1">04/04/2024</td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1">3824826434</td>
                                            <td class="adjust-size1">
                                                <span class="adjust-size"></span> Iphone 14 promax
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 20$
                                            </td>
                                            <td class="adjust-size1">04/04/2024</td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1">3824826434</td>
                                            <td class="adjust-size1">
                                                <span class="adjust-size"></span> Iphone 14 promax
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 20$
                                            </td>
                                            <td class="adjust-size1">04/04/2024</td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1">3824826434</td>
                                            <td class="adjust-size1">
                                                <span class="adjust-size"></span> Iphone 14 promax
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 20$
                                            </td>
                                            <td class="adjust-size1">04/04/2024</td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1">3824826434</td>
                                            <td class="adjust-size1">
                                                <span class="adjust-size"></span> Iphone 14 promax
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 20$
                                            </td>
                                            <td class="adjust-size1">04/04/2024</td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1">3824826434</td>
                                            <td class="adjust-size1">
                                                <span class="adjust-size"></span> Iphone 14 promax
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 20$
                                            </td>
                                            <td class="adjust-size1">04/04/2024</td>
                                            <td class="operation_actived">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>




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
                                        <img src="images/product4.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Iphone 14 </h4>
                                            <span class="dateadd">22/22/22</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/product1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Iphone 15 Promax </h4>
                                            <span class="dateadd">22/22/22</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/product2.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Iphone15 Promax </h4>
                                            <span class="dateadd">22/22/22</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/product3.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> Apple Watch SE </h4>
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