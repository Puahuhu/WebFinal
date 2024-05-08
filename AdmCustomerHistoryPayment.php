<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Customer History Payment</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/CustomerHistoryPayment.css">
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
                        <span class = "material-symbols-sharp" id="setting">deployed_code_history</span>
                    </label> History Customer Transaction
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

            <head>
                <div class="head-display">
                    <h5 class="material-symbols-sharp" id="icon_arrow">arrow_right</h5>
                    <label class="adjust-size3">Nguyen Le Tuan Phuong</label>
                </div>
            </head>
            <main>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1 class="white quantity">9999999$</h1>
                            <span>Total Payment</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">paid</span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 class="white quantity">99</h1>
                            <span>Total Numbers Of Transaction</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">contract</span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <small class="success quantity">Customer</small>
                            <h6>Nguyen Le Tuan Phuong</h6>
                        </div>
                        <div class="avatar">
                            <img src="images/phuong.png">
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
                                            <td class="danger adjust-size center-aligned">Total Amount:</td>
                                            <td class="danger adjust-size center-aligned">Money Given</td>
                                            <td class="danger adjust-size center-aligned">Money Back</td>
                                            <td class="danger adjust-size center-aligned">Creation Date</td>
                                            <td class="danger adjust-size center-aligned">Product Quantity</td>
                                            <td class="danger adjust-size center-aligned">Details</td>
                                        </tr>
                                    </thead>
                                    <tbody class="info1">
                                        <tr>
                                            <td class="adjust-size1 center-aligned">10000$</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> 20000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 10000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">04/04/2024</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 5
                                            </td>
                                            <td class="operation_actived center-aligned">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1 center-aligned">10000$</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> 20000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 10000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">04/04/2024</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 5
                                            </td>
                                            <td class="operation_actived center-aligned">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="adjust-size1 center-aligned">10000$</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> 20000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 10000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">04/04/2024</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 5
                                            </td>
                                            <td class="operation_actived center-aligned">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1 center-aligned">10000$</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> 20000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 10000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">04/04/2024</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 5
                                            </td>
                                            <td class="operation_actived center-aligned">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1 center-aligned">10000$</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> 20000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 10000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">04/04/2024</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 5
                                            </td>
                                            <td class="operation_actived center-aligned">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1 center-aligned">10000$</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> 20000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 10000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">04/04/2024</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 5
                                            </td>
                                            <td class="operation_actived center-aligned">
                                                <span class="material-symbol"><button>More</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adjust-size1 center-aligned">10000$</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size center-aligned"></span> 20000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 10000$
                                            </td>
                                            <td class="adjust-size1 center-aligned">04/04/2024</td>
                                            <td class="adjust-size1 center-aligned">
                                                <span class="adjust-size"></span> 5
                                            </td>
                                            <td class="operation_actived center-aligned">
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
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
                                            <span class="material-symbol card-header1"><button>More</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/receipt1.png" width="50px" height="50px" alt="">
                                        <div>
                                            <h4> 10000$ </h4>
                                            <span class="dateadd">11/10/2023</span>
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