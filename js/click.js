function redirectToCreateAccount() {
    window.location.href = "AdmCreateAccount.php";
}

function redirectToProductMana() {
    window.location.href = "AdimProdMana.php";
}

function redirectToProductDetailsAdmin() {
    window.location.href = "AdminProdDetails.php";
}

function redirectToProductDetailsEdit() {
    window.location.href = "AdminProdDetailsEdit.php";
}

function redirectToAccountManagement() {
    window.location.href = "AccountManagement.php";
}

function redirectToAddProduce() {
    window.location.href = "AddProduct.php";
}

function redirectToSalesDetails() {
    window.location.href = "SalesAccMana.php";
}

function redirectToProductDetailsSales() {
    window.location.href = "SalesProductDetails.php";
}

function redirectToLogin() {
    if (confirm("Do you want to log out?")) {
        window.location.href = "AdminLogin.php";
    }
}

function reloadPage() {
    window.location.reload();
}