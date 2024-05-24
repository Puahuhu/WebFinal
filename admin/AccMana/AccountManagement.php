<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../../css/AccountManagement.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    .suggestions {
        position: absolute;
        top: calc(55px); /* Hiển thị khung gợi ý ngay dưới thanh tìm kiếm */
        right: 20%;
        border-radius: 30px;
        width: 40%;
        display: flex;
        align-items: center;
        overflow: hidden;
        max-height: 300px; /* Đặt chiều cao tối đa cho khung gợi ý */
        overflow-y: auto; 
        background-color: #404040; 
        display: none; /* Ẩn khung gợi ý ban đầu */
        z-index: 999; /* Đảm bảo khung gợi ý nằm trên các phần tử khác */
    }

    #suggestions::-webkit-scrollbar {
        width: 6px;
        background-color: silver;
        border-radius: 30px;
    } 

    #suggestions::-webkit-scrollbar-thumb {
        background-color: #242526;
        border-radius: 30px;
    }

</style>
</head>
<script>
    $(document).ready(function () {
        $.get("../../api/Salesperson/get-saleperson.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var employs = data.data;
                var totalAccounts = employs.length;
                var activeAccounts = 0;
                var lockedAccounts = 0;
                document.getElementById("totalAccounts").innerText = totalAccounts;
                var tableBody = $(".info1");

                employs.forEach(function (employ) {
                    if (employ.IsActive === 1) {
                        activeAccounts++;
                    }else{
                        lockedAccounts++;
                    }

                    var statusClass = employ.IsActive === 1 ? "green" : "gray";
                    var statusText = employ.IsActive === 1 ? "Active" : "Locked";
                    var operationClass = employ.IsActive === 1 ? "operation_locked" : "operation_actived";
                    var row = "<tr data-id='" + employ.SalespersonID + "'>" + 
                        "<td>" +
                        "<img src='" + employ.Avatar + "' width='25px' height='25px' alt=''>" +
                        "</td>" +
                        "<td>" +
                        "<a href='AdmInformationView.php?fullName=" + encodeURIComponent(employ.FullName) + "&username=" + encodeURIComponent(username) + "' id='fullname' class='text-hover employ-name' style='color: white;'>" + employ.FullName + "</a>" +
                        "</td>" +
                        "<td>" +
                        "<span class='status " + statusClass + "'></span> " + statusText +
                        "</td>" +
                        "<td class='" + operationClass + "'>" +
                        "<span><button>" + (employ.IsActive === 1 ? "Locked" : "Actived") + "</button></span>" +
                        "</td>";
                    tableBody.append(row);

                    $("#newacc").append(
                        "<div class='card-body'>" +
                            "<div class='customer'>" +
                                "<div class='info'>" +
                                    "<img src='" + employ.Avatar + "' width='40px' height='40px' alt=''>" +
                                    "<div>" +
                                        "<h4 class='text-hover'>" + employ.FullName + "</h4>" +
                                        "<small> Employee</small>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>"
                    );
                });
                document.getElementById("activeAccounts").innerText = activeAccounts;
                document.getElementById("lockedAccounts").innerText = lockedAccounts;
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
                                            "<a href='AdminInformationMana.php?username=" + encodeURIComponent(username) + "&fullname=" + encodeURIComponent(adm.FullName) + "'><div><h4 class='yellow text-hover1'>" + adm.FullName + "</h4><small> Admin </small></div></a>"
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

        // Hàm xử lý khi nhấn nút "Locked" hoặc "Actived"
        $(".info1").on("click", ".operation_locked button, .operation_actived button", function () {
            var row = $(this).closest("tr"); // Lấy hàng chứa nút đang được nhấn
            var fullName = row.find(".employ-name").text(); // Lấy tên đầy đủ của nhân viên
            var isActive = row.find(".operation_locked").length > 0 ? 0 : 1; // Xác định trạng thái mới của nhân viên
            var salespersonID = row.attr("data-id"); // Lấy ID của nhân viên

            $.post("../../api/Salesperson/update-IsActiveSaleperson.php", {
                SalespersonID: salespersonID,
                FullName: fullName,
                IsActive: isActive
            })
            location.reload();
        });

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
    function handleSearchInput(query) {
            var suggestions = document.getElementById('suggestions');
            if (query.length >= 2) {
                $.ajax({
                    url: '../../api/Admin/search-name.php',
                    method: 'POST',
                    data: { q: query },
                    success: function (data) {
                        var customerList = '';
                        var customers = JSON.parse(data);
                        if (customers.length > 0) {
                            customers.forEach(function (Customer) {
                                customerList += `
                                    <div class="customer sidebar-link" onclick="redirectToCustomerDetails('${encodeURIComponent(Customer.FullName)}')">
                                        <div class="info">
                                            <div class="operation_actived ">
                                                <h4 class="text-hover sidebar-link">${Customer.FullName}</h4>
                                                <h5>${Customer.Phone}</h5>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                            suggestions.innerHTML = customerList;
                            suggestions.style.display = 'block';
                        } else {
                            suggestions.style.display = 'none';
                        }
                    }
                });
            } else {
                suggestions.innerHTML = '';
                suggestions.style.display = 'none';
            }
        }
        var username = "<?php echo htmlspecialchars($_GET['username']); ?>";
        localStorage.setItem('username', username);

        var storedUsername = localStorage.getItem('username');

        function redirectToCustomerDetails(FullName) {
            var username = localStorage.getItem('username');
            window.location.href = 'AdmInformationView.php?fullName=' + FullName + '&username=' +encodeURIComponent(username) ;
        }
        
    
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
                <h1 class="yellow text-hover1">
                    <label for="nav-toggle">
                        <span class = "material-symbols-sharp" id="setting">settings</span>
                    </label> Account Management
                </h1>
                <div class="search-wrapper">
                    <span class="las la-search white"></span>
                    <input type="search" placeholder="Search for salesperson" oninput="handleSearchInput(this.value)" />
                    <div id="suggestions" class="suggestions sidebar-link"></div>
                </div>
                <div class="user-wrapper">
                    <!--  -->
                </div>
            </header>
            <main>
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1 id="totalAccounts" class="white"></h1>
                            <span>Total Account</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">person</span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 id="activeAccounts" class="white"></h1>
                            <span> Active Account </span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">toggle_on</span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1 id="lockedAccounts" class="white"></h1>
                            <span> Locked Account</span>
                        </div>
                        <div>
                            <span class="material-symbols-sharp">block</span>
                        </div>
                    </div>
                    <div>
                    </div>
                    <div class="card-single2">
                        <a href="AdmCreateAccount.php" class="sidebar-link" ><button class="material-symbols-sharp"><span>Create an account</span> person_add</button></a>
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
                                        <!-- Dữ liệu thêm ở đây -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="customers scrollable-content">
                        <div id="newacc" class="card">
                            <div class="card-header">
                                <h3 class="yellow"> New account</h3>
                            </div>
                            <!-- <div class="card-body">
                                <div class="customer">
                                    <div class="info">
                                        <img src="../../images/phuong.png" width="40px" height="40px" alt="">
                                        <div>
                                            <h4 class="text-hover"> Nguyen Le Tuan Phuong </h4>
                                            <small> Employee</small>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </main>
            <!-- <div class="right-aligned4 card-single3 cart-icon">
                <div class="avatar1">
                    <button><img src="../../images/cart_icon.png"></button>
                </div>
            </div> -->
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
</html>