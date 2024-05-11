<?php
    function removeVietnameseAccents($str) {
        $unwanted_array = array(
            'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 
            'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 
            'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 
            'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 
            'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'Ă'=>'A', 'ă'=>'a', 'Đ'=>'D', 'đ'=>'d', 'Ĩ'=>'I', 'ĩ'=>'i', 'Ũ'=>'U', 
            'ũ'=>'u', 'Ơ'=>'O', 'ơ'=>'o', 'Ư'=>'U', 'ư'=>'u', 'Ạ'=>'A', 'ạ'=>'a', 'Ả'=>'A', 'ả'=>'a', 'Ấ'=>'A', 'ấ'=>'a', 'Ầ'=>'A', 
            'ầ'=>'a', 'Ẩ'=>'A', 'ẩ'=>'a', 'Ẫ'=>'A', 'ẫ'=>'a', 'Ậ'=>'A', 'ậ'=>'a', 'Ắ'=>'A', 'ắ'=>'a', 'Ằ'=>'A', 'ằ'=>'a', 'Ẳ'=>'A', 
            'ẳ'=>'a', 'Ẵ'=>'A', 'ẵ'=>'a', 'Ặ'=>'A', 'ặ'=>'a', 'Ẹ'=>'E', 'ẹ'=>'e', 'Ẻ'=>'E', 'ẻ'=>'e', 'Ẽ'=>'E', 'ẽ'=>'e', 'Ế'=>'E', 
            'ế'=>'e', 'Ề'=>'E', 'ề'=>'e', 'Ể'=>'E', 'ể'=>'e', 'Ễ'=>'E', 'ễ'=>'e', 'Ệ'=>'E', 'ệ'=>'e', 'Ỉ'=>'I', 'ỉ'=>'i', 'Ị'=>'I', 
            'ị'=>'i', 'Ọ'=>'O', 'ọ'=>'o', 'Ỏ'=>'O', 'ỏ'=>'o', 'Ố'=>'O', 'ố'=>'o', 'Ồ'=>'O', 'ồ'=>'o', 'Ổ'=>'O', 'ổ'=>'o', 'Ỗ'=>'O', 
            'ỗ'=>'o', 'Ộ'=>'O', 'ộ'=>'o', 'Ớ'=>'O', 'ớ'=>'o', 'Ờ'=>'O', 'ờ'=>'o', 'Ở'=>'O', 'ở'=>'o', 'Ỡ'=>'O', 'ỡ'=>'o', 'Ợ'=>'O', 
            'ợ'=>'o', 'Ụ'=>'U', 'ụ'=>'u', 'Ủ'=>'U', 'ủ'=>'u', 'Ứ'=>'U', 'ứ'=>'u', 'Ừ'=>'U', 'ừ'=>'u', 'Ử'=>'U', 'ử'=>'u', 'Ữ'=>'U', 
            'ữ'=>'u', 'Ự'=>'U', 'ự'=>'u', 'Ỳ'=>'Y', 'ỳ'=>'y', 'Ỵ'=>'Y', 'ỵ'=>'y', 'Ỷ'=>'Y', 'ỷ'=>'y', 'Ỹ'=>'Y', 'ỹ'=>'y'
        );
        return strtr($str, $unwanted_array);
    }
    $selectedProductsJSON = $_POST['selectedProducts']; // Một chuỗi JSON chứa thông tin của từng sản phẩm
    // Giải mã chuỗi JSON thành mảng
    $selectedProducts = json_decode($selectedProductsJSON, true);
    // Lấy dữ liệu từ form
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $total = $_POST['total'];
    $moneygive = $_POST['moneygive'];
    $moneyback = $_POST['moneyback'];
    $date = $_POST['date'];
    require_once ('connection.php');

    //////////////////////////
    $sql = 'SELECT * FROM Customers';
    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute();
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }

    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    $customerID = null;
    foreach ($data as $customer) {
        if ($customer['FullName'] === $name) {
            $customerID = $customer['CustomerID'];
            break;
        }
    }

    // Tạo order mới
    if ($customerID !== null) {
        $sql1 = 'INSERT INTO Orders(CustomerID, SalespersonID, OrderDate, TotalAmount, MoneyGiven, MoneyBack) VALUES(?, ?, ?, ?, ?, ?)';
        try {
            $stmt = $dbCon->prepare($sql1);
            $stmt->execute(array($customerID, 1, $date, $total, $moneygive, $moneyback)); // Nhớ thay đổi SalespersonID
        } catch (PDOException $ex) {
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }
    }else{

        // Tạo tài khoản mới
        $username = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', removeVietnameseAccents($name)));
        $password = $username;
        $isActive = 1;

        $insertSQL = 'INSERT INTO accounts(username, pwd, IsActive) VALUES (?, ?, ?)';

        try {
            $insertStmt = $dbCon->prepare($insertSQL);
            $insertStmt->execute([$username, $password, $isActive]);

            // Lấy CustomerID vừa được tạo
            $customerID = $dbCon->lastInsertId();

        } catch (PDOException $ex) {
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }

        // Lấy danh sách tài khoản
        $sql = 'SELECT * FROM accounts';
        try {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }

        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        $userid = null;
        foreach ($data as $account) {
            if ($account['Username'] === $username) {
                $userid = $account['UserID'];
                break;
            }
        }

        // Tạo thông tin khách hàng mới
        $insertSQL = 'INSERT INTO customers(UserID, FullName, Phone, CustomerAddress, CreatedDate) VALUES (?, ?, ?, ?, ?)';

        try {
            $insertStmt = $dbCon->prepare($insertSQL);
            $insertStmt->execute([$userid, $name, $phone, $address, $date]);

            // Lấy CustomerID vừa được tạo
            $customerID = $dbCon->lastInsertId();
        } catch (PDOException $ex) {
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }

        // Lấy danh sách khách hàng
        $sql = 'SELECT * FROM Customers';
        try {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }

        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        $customerID = null;
        foreach ($data as $customer) {
            if ($customer['FullName'] === $name) {
                $customerID = $customer['CustomerID'];
                break;
            }
        }

        // Tạo order mới
        $sql1 = 'INSERT INTO Orders(CustomerID, SalespersonID, OrderDate, TotalAmount, MoneyGiven, MoneyBack) VALUES(?, ?, ?, ?, ?, ?)';
        try {
            $stmt = $dbCon->prepare($sql1);
            $stmt->execute(array($customerID, 1, $date, $total, $moneygive, $moneyback)); // Nhớ thay đổi SalespersonID
        } catch (PDOException $ex) {
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }
    }
?>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <a href="AccountManagement.php">
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
                <a href="AdminReport.php" class="active">
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
                                    <?php
                                        if(isset($_GET['ProductID'])) {
                                            $product_id = $_GET['ProductID'];
                                            
                                            $conn = mysqli_connect("localhost", "root", "", "finalweb");
                                            if (!$conn) {
                                                die("Kết nối không thành công: " . mysqli_connect_error());
                                            }
                                            
                                            $sql = "SELECT * FROM products 
                                            INNER JOIN orderdetails ON products.ProductID = orderdetails.ProductID 
                                            WHERE products.ProductID = $product_id";
                                            $result = mysqli_query($conn, $sql);
                                            
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_assoc($result);
                                    ?>
                                    <tbody class="info1">
                                        <tr>
                                            <td>
                                                <img src="<?php echo $row['Images']; ?>" width="50px" height="50px" alt="">
                                            </td>
                                            <td class="text-hover"><?= $row['ProductName'] ?></td>
                                            <td>
                                                <?= $row['UnitPrice'] ?>
                                            </td>
                                            <td>
                                                <?= $row['Quantity'] ?>
                                            </td>
                                            <td><?= $row['RetailPrice'] ?></td>
                                        </tr>
                                    </tbody>
                                    <?php 
                                            }
                                        }
                                    ?>  
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="customers right-aligned3">
                        <div class="card">
                        <?php
                            if(isset($_GET['ProductID'])) {
                                $product_id = $_GET['ProductID'];
                                
                                $conn = mysqli_connect("localhost", "root", "", "finalweb");
                                if (!$conn) {
                                    die("Kết nối không thành công: " . mysqli_connect_error());
                                }
                                
                                $sql = "SELECT sum(Quantity) as total FROM orderdetails INNER JOIN products ON products.ProductID = orderdetails.ProductID 
                                WHERE products.ProductID = $product_id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $totalProducts = $row['total'];
                                $sql1 = "SELECT SUM(products.RetailPrice * orderdetails.Quantity) AS totalmoney 
                                        FROM products 
                                        INNER JOIN orderdetails ON products.ProductID = orderdetails.ProductID 
                                        WHERE products.ProductID = $product_id";
                                $result1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_assoc($result1);
                                $totalMoney = $row1['totalmoney'];

                               
                                    
                        ?>
                            <div class="card-header1">
                                <h6 class="danger"> Total
                                    <h5 class="silver"> <?=$totalProducts ?> products</h5>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <div>
                                            <h6 class="silver2"><?= $totalMoney ?>$ </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="card-single2 align3">
                        <a href="AdminReport.php"> <button>Cancel</button></a>
                    </div>
            </main>
            </div>
</body>

</html>