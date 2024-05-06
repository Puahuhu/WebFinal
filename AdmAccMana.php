<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@lastest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/Information.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
    var fullName = "<?php echo htmlspecialchars($_GET['fullName']); ?>";
    $(document).ready(function () {
        $.get("http://localhost:8080/WebFinal/api/Salesperson/get-saleperson.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var employs = data.data;
                employs.forEach(function (employ) {
                    if (employ.FullName === fullName) {
                        $(".home-text").append(
                            "<span>Saleperson</span>" +
                            "<h1 class='white'>" + employ.FullName + "</h1>" +
                            "<table>" +
                            "<tr><td><p>Gmail:</p></td><td><p>" + employ.Email + "</p></td></tr>" +
                            // Thêm các trường thông tin khác nếu cần
                            "</table>" +
                            "<div class='main-btn'>" +
                            "<a href='#' class='btn two'>Change Avatar</a>" +
                            "<a href='#' class='btn two'>Change Password</a>" +
                            "</div>" +
                            "<div class='main-btn'>" +
                            "<a href='#' class='btn2'> Sales Details</a>" +
                            "</div>"
                        );

                        $(".home-img").append("<img src='" + employ.Avatar + "'>");
                    }
                });
                
            } else {
                alert("Không thể tải dữ liệu từ server");
            }
        }, "json");
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
                    <img src="images/quynh.png" width="40px" height="40px" alt="">
                    <div>
                        <h4 class="yellow text-hover1"> Nguyễn Đặng Như Quỳnh </h4>
                        <small> Admin</small>
                    </div>
                </div>
            </header>

            <head>
                <div class="head-display">
                    <h5 class="material-symbols-sharp" id="icon_arrow">arrow_right</h5>
                    <label class="adjust-size">My Profile</label>
                </div>
            </head>
            <main>
                <div class="home">
                    <div class="home-text">
                        <!-- Thông tin của Salesperson sẽ được hiển thị ở đây -->
                    </div>
                    <div class="home-img">
                        <!-- Hình ảnh avatar của Salesperson sẽ được hiển thị ở đây -->
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