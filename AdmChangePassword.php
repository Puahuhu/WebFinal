<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@lastest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/CreateAccount.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
    var username = "<?php echo htmlspecialchars($_GET['username']); ?>"; 
    $(document).ready(function () {
        $.get("api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("api/Admin/get-admin.php", function (data, status) {
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
        
        $(document).on("click", "#submit", function () {
            event.preventDefault();
            var newPassword = $("#newpass").val().trim();
            var confirmPassword = $("#confirmpass").val().trim();

            if (newPassword === "" || confirmPassword === "") {
                alert("Please fill in all fields.");
                return;
            }

            if (newPassword !== confirmPassword) {
                alert("New password and confirm password do not match.");
                return;
            }


            $.post("api/Account/update-accountpwd.php", {
                Username: username,
                pwd: newPassword
            }, function (data, status) {
                if (status === "success") {
                    alert("Password changed successfully.");
                    window.location.href = "AdminInformationMana.php?username=" + username;
                } else {
                    alert("An error occurred while processing your request.");
                }
            }, "json");
        });

        $(document).on("click", "#cancel", function () {
            window.location.href = "SalesAccMana.php?username=" + username;
        });

        
    });
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
                <a href="AdmAccMana.php" class="active">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>

                <a href="AdmCustomerMana.php">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="AdminTransaction.php">
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
                            <span class = "material-symbols-sharp" id="setting">key</span>
                        </label> Change Password
                    </h1>
                </div>
                <div>
                </div>
                <div class="user-wrapper">
                    <!--  -->
                </div>
            </header>
            <main>
                <div class="home">
                    <div class="home-text">
                        <table>
                            <form id="changePasswordForm" action="changePasswordProcess.php" method="POST">
                                <tr>
                                    <td>
                                        <p>New Password:</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="text" id="newpass" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Confirm Password</p>
                                    </td>
                                    <td>
                                        <p>
                                            <a><input type="text" id="confirmpass" placeholder="-" required></a>
                                        </p>
                                    </td>
                                </tr>
                            </form>
                        </table>
                        <div class="main-btn">
                            <a href= # class="btn2" id="submit">Confirm</a>
                            <a href= # class="btn3" id="cancel">Cancel</a>
                        </div>
                    </div>
                    <div class="home-img">
                        <!--  -->
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
<script src="js/click.js"></script>
</html>