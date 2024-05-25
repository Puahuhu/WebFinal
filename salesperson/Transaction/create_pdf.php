<?php
$productNames = $_POST['products'];
$productPrices = $_POST['prices'];
$totalPrice = $_POST['totalPrice'];
$productCountsJSON = $_POST['productCounts'];
$productCounts = json_decode($productCountsJSON, true);
require_once('tcpdf/tcpdf.php');

// Tạo một TCPDF instance
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Thiết lập thông tin PDF
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('TCPDF, PDF, invoice');

// Đặt thông tin về phông chữ
$pdf->SetFont('times', '', 12);

// Tạo trang mới
$pdf->AddPage();

// Tạo bảng HTML động từ dữ liệu nhận được từ biểu mẫu
$html = '<h1>List of Products</h1>';
$html .= '<table cellspacing="0" cellpadding="1" border="1">';
$html .= '<tr>';
$html .= '<td style="text-align: center; color: red"><b>Product</b></td>';
$html .= '<td style="text-align: center; color: red"><b>Unit Price</b></td>';
$html .= '<td style="text-align: center; color: red"><b>Amount</b></td>';
$html .= '<td style="text-align: center; color: red"><b>Total Price</b></td>';
$html .= '</tr>';

// Lặp qua mỗi sản phẩm để thêm vào bảng
for ($i = 0; $i < count($productNames); $i++) {
    $productName = $productNames[$i];
    $productPrice = $productPrices[$i];
    $amount = $productCounts[$productName];
    $totalProductPrice = $productPrice * $amount;

    $html .= '<tr>';
    $html .= '<td style="text-align: center;">' . $productName . '</td>';
    $html .= '<td style="text-align: center;">' . $productPrice . '$</td>';
    $html .= '<td style="text-align: center;">' . $amount . '</td>';
    $html .= '<td style="text-align: center;">' . $totalProductPrice . '$</td>';
    $html .= '</tr>';
}

$html .= '</table>';
$html .= '<h1><p>Total: ' . $totalPrice . '$</p></h1>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Cuối tài liệu
$pdf->lastPage();

// Tạo tệp PDF và hiển thị hoặc tải về
$pdf->Output('receipt_details.pdf', 'D');
?>
