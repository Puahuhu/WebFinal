<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Information Details</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@lastest/css/boxicons.min.css">
    <link rel="stylesheet" href="../../css/Information.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
    var fullName = "<?php echo htmlspecialchars($_GET['fullName']); ?>";
    $(document).ready(function () {
        $.get("../../api/Salesperson/get-saleperson.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var employs = data.data;
                employs.forEach(function (employ) {
                    if (employ.FullName === fullName) {
                        $(".home-text").append(
                            "<span>Salesperson</span>" +
                            "<h1 class='white'>" + employ.FullName + "</h1>" +
                            "<table>" +
                            "<tr><td><p>Email:</p></td><td><p>" + employ.Email + "</p></td></tr>" +
                            "<tr><td><p>Address:</p></td><td><p>" + employ.SalesAddress + "</p></td></tr>" +
                            "<tr><td><p>Phone:</p></td><td><p>" + employ.Phone + "</p></td></tr>" +
                            "</table>" +
                            "<div class='main-btn'>" +
                            "<a href='../../admin/Report/AdminSalesDetails.php' class='btn2 sidebar-link'> Sales Details</a>"
                        );

                        if(employ.IsNew === 1){
                            $(".home-text").append(
                                "<a href='#' class='btn2' id='sendMailButton'>Send Mail</a>"
                            );
                        }
                        $(".home-text").append(
                            "</div>"
                        );

                        $(".home-img").append("<img src='" + employ.Avatar + "'>");

                        $(".sidebar-link[href='../../admin/Report/AdminSalesDetails.php']").attr("href", "../../admin/Report/AdminSalesDetails.php?username=" + encodeURIComponent(username) + "&fullName=" + encodeURIComponent(fullName));
                    }
                });
            } else {
                alert("Không thể tải dữ liệu từ server");
            }
        }, "json");

        var username = "<?php echo htmlspecialchars($_GET['username']); ?>"; 
        $.get("../../api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("../../api/Admin/get-admin.php", function (data, status) {
                            if (status === "success" && data.status === true) {
                                var adms = data.data;
                                adms.forEach(function (adm) {
                                    if (adm.UserID === userId) {
                                        $(".user-wrapper").append(
                                            "<img src='" + adm.Avatar + "' width='40px' height='40px' alt=''>" +
                                            "<div><h4 class='yellow text-hover1'>" + adm.FullName + "</h4><small> Admin </small></div>"
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
</script>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../../images/logoteam.png" width="20px" height="20px" alt="">
                    <h2 class="success text-hover1">Point<span class="yellow"> Of</span> Sale</h2>
                </div>
                <div class="close">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="AccountManagement.php" class="active sidebar-link">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>
                <a href="../../admin/ProductMana/AdminProdMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">receipt_long</span>
                    <h3> Product Catalog Management </h3>
                </a>
                <a href="../../admin/CustomerMana/AdmCustomerMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="../../admin/Transaction/AdminTransaction.php" class="sidebar-link">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="../../admin/Report/AdminReport.php" class="sidebar-link">
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
                            <span class = "material-symbols-sharp" id="setting">contacts</span>
                        </label> Information Details
                    </h1>
                </div>
                <div>
                </div>
                <div class="user-wrapper">
                    <!--  -->
                </div>
            </header>

            <head>
                <div class="head-display" style="visibility: hidden;">
                    <h5 class="material-symbols-sharp" id="icon_arrow">arrow_right</h5>
                </div>
            </head>
            <main>
                <div class="home">
                    <div class="home-text">
                        <!--  -->
                    </div>
                    <div class="home-img">
                        <!--  -->
                    </div>
                </div>
            </main>
            <div class="right-aligned4 card-single3 cart-icon">
                <div class="avatar1">
                    <button><img src="../../images/cart_icon.png"></button>
                </div>
            </div>
        </div>
    </div>
    <script>
    function redirectToLogout() {
        if (confirm("Do you want to log out?")) {
            window.location.href = "../../layout/AdminLogin.php";
        }
    }
</script>
</body>
<script>
    $(document).ready(function () {
        $(document).on("click", "#sendMailButton", function () {
            var fullName = "<?php echo htmlspecialchars($_GET['fullName']); ?>";

            $.ajax({
                url: "../../reset_timeout.php",
                type: "GET",
                data: {
                    fullName: fullName
                },
                success: function (response) {
                    alert("Email sent successfully!");
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Error sending email. Please try again later.");
                }
            });
        });
    });
</script>
</html>