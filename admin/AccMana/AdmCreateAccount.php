<?php
require_once("../../connection.php");

$createSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['gmail'];
    $fullName = $_POST['fullName'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Lấy phần username từ địa chỉ email
    $username = explode('@', $email)[0];

    // Thêm vào bảng Accounts

    $sql = "INSERT INTO Accounts (Username, pwd) VALUES (:username, :username)";

    $stmt = $dbCon->prepare($sql);
    $stmt->bindParam(':username', $username);

    if ($stmt->execute()) {
        // Lấy ID mới nhất
        $userID = $dbCon->lastInsertId();
        
        // Thêm vào bảng Salesperson
        $avatar = "../../images/avatar.png";
        $sql = "INSERT INTO Salesperson (UserID, FullName, Email, Avatar, IsActive, IsNew, SalesAddress, Phone) VALUES (:userID, :fullName, :email, :avatar, 0, 1, :address, :phone)";
        $stmt = $dbCon->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':fullName', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        
        if ($stmt->execute()) {
            $createSuccess = "Account created successfully.";
            $subject = 'Your account successfully created';
            $body = 'Your account has been successfully created with the following details:<br><br>'
                    . 'Username: ' . $username . '<br>'
                    . 'Password: ' . $username . '<br><br>'
                    . 'First login link here: http://localhost/WebFinal/layout/First-time/FirstLogin.php';
            require("../../send-email.php");
        } else {
            $createSuccess = "Error: Unable to create account.";
        }
    } else {
        $createSuccess = "Error: Unable to create account.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create An Account</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@lastest/css/boxicons.min.css">
    <link rel="stylesheet" href="../../css/CreateAccount.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
    $(document).ready(function () {
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
                            <span class = "material-symbols-sharp" id="setting">edit_square</span>
                        </label> Create An Account
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
                        <form method="POST">
                            <table>
                                    <tr>
                                        <td>
                                            <p>Gmail</p>
                                        </td>
                                        <td>
                                            <p>
                                                <a><input name="gmail" type="text" id="" placeholder="-" required></a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Full Name</p>
                                        </td>
                                        <td>
                                            <p>
                                                <a><input name="fullName" type="text" required placeholder="-"></a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Birthday</p>
                                        </td>
                                        <td>
                                            <p>
                                                <a><input name="birthday" type="date" id="dateproduct" placeholder="-" required></a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Address</p>
                                        </td>
                                        <td>
                                            <p>
                                                <a><input name="address" type="text" placeholder="-" required></a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Phone</p>
                                        </td>
                                        <td>
                                            <p>
                                                <a><input name="phone" type="text" required placeholder="-"></a>
                                            </p>
                                        </td>
                                    </tr>
                            </table>
                            <div class="main-btn">
                                <a class="btn2"><input id="createBtn" type="submit" value="Create"></a>
                                <a href="AccountManagement.php" class="btn3 sidebar-link"><h2>Cancel</h2></a>
                            </div>
                        </form>
                        <?php if (!empty($createSuccess)): ?>
                            <script>
                                alert("<?php echo $createSuccess; ?>");
                            </script>
                        <?php endif; ?>
                    </div>
                    <div class="home-img">
                        <img src="../../images/avatar.png">
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
    $(document).ready(function(){
        // Khi nút "Create" được click
        $("#createBtn").click(function(e){
            // Ngăn chặn hành động mặc định của nút submit
            e.preventDefault();
            // Disable nút để ngăn chặn việc click nhiều lần
            $("#createBtn").prop("disabled", true);
            // Tiến hành gửi dữ liệu
            $("form").submit();
        });
    });
</script>
</html>