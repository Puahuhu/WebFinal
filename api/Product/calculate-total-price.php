<?php
    // Start the session
    session_start();

    // Function to calculate total price of all products in the cart
    function calculateTotalPrice() {
        $totalPrice = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $totalPrice += $item['RetailPrice'];
            }
        }
        echo $totalPrice; // Trả về tổng giá tiền
    }

    // Calculate and return total price
    calculateTotalPrice();
?>
