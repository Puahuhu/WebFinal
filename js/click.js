function redirectToCreateAccount() {
    window.location.href = "CreateAccount.php";
}

function redirectToProductSales() {
    window.location.href = "ProductSales.php";
}

function redirectToProduct() {
    window.location.href = "Product.php";
}

function redirectToProductDetailsAdmin() {
    window.location.href = "ProductDetailsAdmin.php";
}

function redirectToProductDetailsEdit() {
    window.location.href = "ProductDetailsEdit.php";
}

function redirectToCustomerManagement() {
    window.location.href = "CustomerManagement.php";
}

function redirectToAccountManagement() {
    window.location.href = "AccountManagement.php";
}

function redirectToAddProduce() {
    window.location.href = "AddProduct.php";
}

function redirectToSalesDetails() {
    window.location.href = "SalesDetails.php";
}

function redirectToProductDetailsSales() {
    window.location.href = "ProductDetailsSales.php";
}

function redirectToLogin() {
    if (confirm("Bạn có chắc chắn muốn đăng xuất?")) {
        window.location.href = "LoginAdmin.php";
    }
}

function redirectToLoginAdmin() {
    window.location.href = "loginAdmin.php";
}

function redirectToLoginSales() {
    window.location.href = "loginSales.php";
}

function reloadPage() {
    window.location.reload();
}