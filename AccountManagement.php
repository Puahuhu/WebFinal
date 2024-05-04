<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/AccountManagement.css">
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
                        <span class = "material-symbols-sharp" id="setting">settings</span>
                    </label> Account Management
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
            <main>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1 class="white">54</h1>
                            <span>Total Account</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">person</span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 class="white">15</h1>
                            <span> Active Account </span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">toggle_on</span>
                        </div>
                    </div>
                    <div>
                        <div class="card-single">
                            <div>
                                <h1 class="white">29</h1>
                                <span>Inactive Account</span>
                            </div>
                            <div>
                                <span class="material-symbols-sharp">toggle_off</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 class="white">10</h1>
                            <span> Locked Account</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">block</span>
                        </div>
                    </div>
                    <div class="card-single2">
                        <button class="material-symbols-sharp"><span>Create an account</span> person_add</button>
                    </div>
                </div>
                <div class="recent-grid ">
                    <div class="projects scrollable-content">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="yellow"> List of Account </h3>
                            </div>
                            <div class="card-body">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td class="danger">Avatar</td>
                                            <td class="danger">Fullname</td>
                                            <td class="danger">Account Status</td>
                                            <td class="danger"> Operation </td>
                                        </tr>
                                    </thead>
                                    <tbody class="info1">
                                        <tr>
                                            <td>
                                                <img src="images/phuong.png" width="25px" height="25px" alt="">
                                            </td>
                                            <td class="text-hover">Nguyen Le Tuan Phuong</td>
                                            <td>
                                                <span class="status green"></span> Active
                                            </td>
                                            <td class="operation_locked">
                                                <span><button>Locked</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/tram.png" width="25px" height="25px" alt="">
                                            </td>
                                            <td class="text-hover">Chau Thi Tram</td>
                                            <td>
                                                <span class="status gray"></span> Locked
                                            </td>
                                            <td class="operation_actived">
                                                <span><button>Actived</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/quynh.png" width="25px" height="25px" alt="">
                                            </td>
                                            <td class="text-hover">Nguyen Dang Nhu Quynh</td>
                                            <td>
                                                <span class="status red"></span> Inactive
                                            </td>
                                            <td class="operation_sendmail">
                                                <span><button>Send mail</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/hong.png" width="25px" height="25px" alt="">
                                            </td>
                                            <td class="text-hover">Dang Thi Kim Hong</td>
                                            <td>
                                                <span class="status green"></span> Active
                                            </td>
                                            <td class="operation_locked">
                                                <span><button>Locked</button></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="images/tuan.png" width="25px" height="25px" alt="">
                                            </td>
                                            <td class="text-hover"> Nguyen Tuan</td>
                                            <td>
                                                <span class="status red"></span> Inactive
                                            </td>
                                            <td class="operation_sendmail">
                                                <span><button>Send mail</button></span>
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
                                <h3 class="yellow"> New account</h3>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/phuong.png" width="40px" height="40px" alt="">
                                        <div>
                                            <h4 class="text-hover"> Nguyen Le Tuan Phuong </h4>
                                            <small> Employee</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/tram.png" width="40px" height="40px" alt="">
                                        <div>
                                            <h4 class="text-hover"> Chau Thi Tram </h4>
                                            <small> Employee </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/quynh.png" width="40px" height="40px" alt="">
                                        <div>
                                            <h4 class="text-hover"> Nguyen Dang Nhu Quynh </h4>
                                            <small> Admin </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="images/hong.png" width="40px" height="40px" alt="">
                                        <div>
                                            <h4 class="text-hover"> Dang Thi Kim Hong </h4>
                                            <small> Admin </small>
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
    <script src="js/click.js"></script>
</body>
</html>