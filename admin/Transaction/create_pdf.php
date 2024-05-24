<?php
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

$html = '<h1>List of Products</h1>
<div></div>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td style="text-align: center; color: red"><b>Product</b></td>
        <td style="text-align: center; color: red"><b>Unit Price</b></td>
        <td style="text-align: center; color: red"><b>Amount</b></td>
        <td style="text-align: center; color: red"><b>Total Price</b></td>
    </tr>

    <tr>
        <td style="text-align: center;">iPhone 15 Pro</td>
        <td style="text-align: center;">1999$</td>
        <td style="text-align: center;">1</td>
        <td style="text-align: center;">1999$</td>
    </tr>

    <tr>
        <td style="text-align: center;">Apple Watch SE</td>
        <td style="text-align: center;">599$</td>
        <td style="text-align: center;">1</td>
        <td style="text-align: center;">599$</td>
    </tr>
</table>

<h1><p>Total: 1798$</p></h1> 
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// Cuối tài liệu
$pdf->lastPage();

// Tạo tệp PDF và hiển thị hoặc tải về
$pdf->Output('receipt_details.pdf', 'D');
?>