<?php
$_SESSION['logged in'] = true;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("connection.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $error = "Please enter your username";
    } elseif (empty($password)) {
        $error = "Please enter your password";
    } else {
        // Kiểm tra xem UserId có trong bảng Salesperson hay không
        $stmt = $dbCon->prepare("SELECT * FROM Salesperson WHERE UserID IN (SELECT UserID FROM Accounts WHERE Username = :username)");
        $stmt->execute(array(':username' => $username));

        if ($stmt->rowCount() > 0) {
            // Kiểm tra xem tài khoản mật khẩu có trong bảng Accounts hay không
            $stmt = $dbCon->prepare("SELECT * FROM Accounts WHERE Username=:username AND pwd=:password");
            $stmt->execute(array(':username' => $username, ':password' => $password));

            if ($stmt->rowCount() > 0) {
                // Chuyển sang màn hình chính
                header("Location: SalesAccMana.php?username=$username");
                exit();
            } else {
                $error = "Wrong password";
            }
        } else {
            // Kiểm tra xem UserId có trong bảng Admins hay không
            $stmt = $dbCon->prepare("SELECT * FROM Admins WHERE UserID IN (SELECT UserID FROM Accounts WHERE Username = :username)");
            $stmt->execute(array(':username' => $username));

            if ($stmt->rowCount() > 0) {
                $error = "Account doesn't exist";
            } else {
                $error = "Account doesn't exist";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salesperson Login</title>
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Error.css">
</head>

<body>
    <div class="wrapper" style="background-image: url('images/bg-phone3.jpeg');">
        <div class="inner">
            <div class="image-holder">
                <img class="bg" src="images/bg-phone10.jpeg" alt="">
            </div>
            <form action="SalesLogin.php" method="post" id="loginForm">
                <div class="form-button">
                    <button class="choose" id="adminButton">Admin
                        <i class="zmdi zmdi-account"></i>
                    </button>
                    <button class="active">Salesperson
                        <i class="zmdi zmdi-account"></i>
                    </button>
                </div>
                <h3>Sign in</h3>
                <div class="form-wrapper">
                    <input name="username" type="text" placeholder="Username" class="form-control" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                    <i class="zmdi zmdi-account"></i>
                </div>
                <div class="form-wrapper">
                    <input name="password" type="password" placeholder="Password" class="form-control">
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <button type="submit">Login
						<i class="zmdi zmdi-arrow-right"></i>
				</button>
                <!-- In thông báo lỗi -->
                <?php if (!empty($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("adminButton").addEventListener("click", function () {
            document.getElementById("loginForm").action = "AdminLogin.php";
        });
    </script>
</body>
</html>