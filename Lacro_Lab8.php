<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Smart Receipt</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    font-family: 'Poppins', sans-serif;
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
}

.card {
    background: white;
    padding: 25px;
    width: 380px;
    border-radius: 15px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

.title {
    text-align: center;
    font-weight: 700;
    margin-bottom: 15px;
}

.receipt {
    border-top: 2px dashed #ccc;
    padding-top: 15px;
}

.line {
    display: flex;
    justify-content: space-between;
    margin: 6px 0;
    color: #333;
}

.total {
    font-weight: 700;
    border-top: 1px solid #ddd;
    margin-top: 10px;
    padding-top: 10px;
}
</style>
</head>

<body>

<div class="card">
<div class="title">🧾 Smart Receipt</div>

<div class="receipt">
<?php
$name="             JUan DelA Cruz                    ";
$item="             Laptop                               ";
$quantity=3;
$price=59999.99;
$card='123409912316591';

//DO TASKS HERE
$trimName = strtoupper(trim($name));
$trimItem = strtoupper(trim($item));

$total = $price * $quantity;
$vat = $total * 0.12;
$OverallTotal = $total + $vat;

$firstTwo = substr($card, 0, 2);
$lastFour = substr($card, -4);
$maskLength = strlen($card) - 6; 
$secretCard = $firstTwo . str_repeat('*', $maskLength) . $lastFour;

echo '<div class="line"><span class="label"><b>NAME</b></span><span class="value">' . $trimName . '</span></div>';
echo '<div class="line"><span class="label"><b>BALANCE</b></span><span class="value">' . $secretCard . '</span></div>';
echo '<div class="line"><span class="label"><b>ITEM</b></span><span class="value">' . $trimItem . '</span></div>';
echo '<div class="line"><span class="label"><b>PRICE</b></span><span class="value">Php ' . number_format($price, 2) . '</span></div>';
echo '<div class="line"><span class="label"><b>QUANTITY</b></span><span class="value">' . $quantity . '</span></div>';
echo '<div class="line"><span class="label"><b>TOTAL</b></span><span class="value">Php ' . number_format($total, 2) . '</span></div>';
echo '<div class="line"><span class="label"><b>VAT (12%)</b></span><span class="value">Php ' . number_format($vat, 2) . '</span></div>';
echo '<div class="line total"><span class="label">Total Amount to Pay</span><span class="value">Php ' . number_format($OverallTotal, 2) . '</span></div>';
echo '<div style="text-align: center; color: #1e3c72; font-size: 0.85em; margin-top: 20px;">Thank you for your purchase!</div>';

?>
</div>
</div>

</body>
</html>