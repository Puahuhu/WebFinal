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
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">
                                    <div class="info">
                                        <img src="images/product3.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Samsung Galaxy</h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>
                                            <h5> 200$ </h5>
                                            <span><button>Delete</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">
                                    <div class="info">
                                        <input type="checkbox">
                                        <img src="images/product4.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Iphone 14</h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>
                                            <h5> 200$ </h5>
                                            <span><button>Delete</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">

                                    <div class="info">
                                        <img src="images/product5.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Xiaomi </h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>

                                            <h5> 200$ </h5>
                                            <span><button>Delete</button></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">
                                    <div class="info">
                                        <img src="images/product6.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Camera </h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>
                                            <h5> 200$ </h5>
                                            <span><button>Delete</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">

                                    <div class="info">
                                        <img src="images/product6.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Camera </h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>
                                            <h5> 200$</h5>
                                            <span><button>Delete</button></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">

                                    <div class="info">
                                        <img src="images/product6.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Camera </h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>
                                            <h5> 200$ </h5>
                                            <span><button>Delete</button></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">

                                    <div class="info">
                                        <img src="images/product6.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Camera </h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>

                                            <h5> 200$ </h5>
                                            <span><button>Delete</button></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <input type="checkbox">

                                    <div class="info">
                                        <img src="images/product6.png" width="40px" height="40px" alt="">
                                        <div class="operation_actived">
                                            <h4 class="text-hover"> Camera </h4>
                                            <h5>Amount:<span>1 <button> < </button><button>></button></span> </h5>
                                            <h5> 200$</h5>
                                            <span><button>Delete</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customers right-aligned3">
                        <div class="card">
                            <div class="card-header1    ">
                                <h4 class="danger"> Total
                                    <h5> 5 products</h5>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <div class="operation_actived2">
                                            <h6>1000$ </h6>
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
    <script src="js/click.js"></script>
</body>
</html>