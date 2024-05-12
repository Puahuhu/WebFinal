<?php
    // Function to add a product to the cart
    session_start();
    function addToCart($productId, $productName, $retailprice, $images) {
        // Initialize cart if not already initialized
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Add product to cart
        $_SESSION['cart'][] = array(
            'ProductId' => $productId,
            'ProductName' => $productName,
            'RetailPrice' => $retailprice,
            'Images' => $images
        );
    }

    // Handle AJAX request to add product to cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addToCart') {
        // Validate input (you may need to add more validation)
        $productId = $_POST['ProductId'];
        $productName = $_POST['ProductName'];
        $retailprice = $_POST['RetailPrice'];
        $images = $_POST['Images'];

        // Add product to cart
        addToCart($productId, $productName, $retailprice, $images);

        // Return success response
        echo json_encode(array('success' => true));

        // Print session cart to console
        echo json_encode($_SESSION['cart']); // In session cart ra console
        exit;
    }
?>
