<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Information</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@lastest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/Information.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .avatar-change-modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
    }

    .avatar-change-modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #changeAvatarBtn:hover {
        background-color: silver;
    }

    #changeAvatarBtn {
        background-color: #f1f1f1;
        color: black;
        font-size: 16px;
        border-radius: 5px;
    }
</style>
<script>
    var username = "<?php echo htmlspecialchars($_GET['username']); ?>"; 
    $(document).ready(function () {
        var salespersonid;
        $.get("api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("api/Salesperson/get-saleperson.php", function (data, status) {
                            if (status === "success" && data.status === true) {
                                var employs = data.data;
                                employs.forEach(function (employ) {
                                    if (employ.UserID === userId) {
                                        salespersonid = employ.SalespersonID;
                                        $(".home-text").append(
                                            "<span>Salesperson</span>" +
                                            "<h1 class='white'>" + employ.FullName + "</h1>" +
                                            "<table>" +
                                            "<tr><td><p>Email:</p></td><td><p>" + employ.Email + "</p></td></tr>" +
                                            "<tr><td><p>Address:</p></td><td><p>" + employ.SalesAddress + "</p></td></tr>" +
                                            "<tr><td><p>Phone:</p></td><td><p>" + employ.Phone + "</p></td></tr>" +
                                            "</table>" +
                                            "<div class='main-btn'>" +
                                            "<a id='changeAvatarLink' class='btn two'>Change Avatar</a>" +
                                            "<a href='SalesChangePassword.php?username=" + encodeURIComponent(username) + "'class='btn two'>Change Password</a>" +
                                            "</div>" +
                                            "<div class='main-btn'>" +
                                            "<a href='#' class='btn2'> Sales Details</a>" +
                                            "</div>"
                                        );
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

        $.get("api/Account/get-account.php", function (data, status) {
            if (status === "success" && data.status === true) {
                var accs = data.data;
                accs.forEach(function (acc) {
                    if (acc.Username === username) {
                        var userId = acc.UserID;
                        $.get("api/Admin/get-admin.php", function (data, status) {
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
        

        // Hiển thị cửa sổ nhỏ khi click vào nút "Change Avatar"
        $(document).on("click", "#changeAvatarLink", function () {
            $("#avatarChangeModal").css("display", "block");
        });

        // Ẩn cửa sổ nhỏ khi click vào nút đóng
        $(document).on("click", ".close", function () {
            $("#avatarChangeModal").css("display", "none");
        });

        // Xử lý sự kiện khi người dùng chọn hình ảnh từ máy tính và gửi đi
        var fileName;
        $(document).on("change", "#avatarInput", function () {
            var file = this.files[0];
            if (file) {
                fileName = "images/" + file.name; 
            } else {
                console.log("Không có file được chọn.");
            }
        });

        $(document).on("submit", "#avatarForm", function (event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của form

            var formData = new FormData(this);
            formData.append('SalespersonID', salespersonid); 
            formData.append('Avatar', fileName); 

            $.ajax({
                url: "api/Salesperson/update-SalepersonAvatar.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data, status) {
                    if (status === "success") {
                        alert("Avatar changed successfully.");
                        location.reload();
                    } else {
                        alert("An error occurred while processing your request.");
                    }
                },
                error: function (xhr, desc, err) {
                    alert("An error occurred while processing your request.");
                }
            });
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
                <a href="SalesAccMana.php" class="active sidebar-link">
                    <span class="material-symbols-sharp">settings</span>
                    <h3> Account Management </h3>
                </a>

                <a href="SalesCustomerMana.php" class="sidebar-link">
                    <span class="material-symbols-sharp">person</span>
                    <h3> Customers Management </h3>
                </a>
                <a href="SalesTransaction.php" class="sidebar-link">
                    <span class="material-symbols-sharp">paid</span>
                    <h3> Transaction </h3>
                </a>
                <a href="SalesReport.php" class="sidebar-link">
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
                    <!-- Avatar của Salesperson sẽ được hiển thị ở đây -->
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
    <div class="avatar-change-modal" id="avatarChangeModal">
    <div class="avatar-change-modal-content">
        <span class="close">&times;</span>
        <h2>Change Avatar</h2>
        <form id="avatarForm" enctype="multipart/form-data">
            <input type="file" id="avatarInput" name="avatarInput">
            <button type="submit" id="changeAvatarBtn">Change</button>
        </form>

    </div>
</div>
<script src="js/click.js"></script>
</body>
</html>