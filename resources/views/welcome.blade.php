<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VAT Invoice</title>
    <style>
        /* Simple Styling for Invoice */
        .invoice-container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .invoice-header img {
            width: 100px;
        }
        .invoice-details { margin-top: 20px; }
    </style>
</head>
<body>

    <h1>Create VAT Invoice</h1>

    <form id="invoice-form">
        <!-- Customer Info -->
        <input type="text" id="customer-name" placeholder="Customer Name" required>
        <textarea id="customer-address" placeholder="Customer Address" required></textarea>

        <!-- Item Info -->
        <input type="text" id="item-name" placeholder="Item Name" required>
        <input type="number" id="item-quantity" placeholder="Quantity" required>
        <input type="number" id="item-price" placeholder="Price" required>

        <input type="number" id="subtotal" placeholder="Subtotal" required>
        <input type="number" id="vat" placeholder="VAT" required>
        <input type="number" id="total" placeholder="Total" required>

        <button type="submit">Generate Invoice</button>
    </form>

    <div id="invoice" class="invoice-container" style="display:none;">
        <div class="invoice-header">
            <img src="logo.png" alt="Logo">
            <h2>Invoice</h2>
        </div>
        <div class="invoice-details">
            <p><strong>Customer:</strong> <span id="invoice-customer-name"></span></p>
            <p><strong>Address:</strong> <span id="invoice-customer-address"></span></p>
            <h3>Items:</h3>
            <ul id="invoice-items"></ul>
            <p><strong>Subtotal:</strong> <span id="invoice-subtotal"></span></p>
            <p><strong>VAT:</strong> <span id="invoice-vat"></span></p>
            <p><strong>Total:</strong> <span id="invoice-total"></span></p>
        </div>
        <button onclick="window.print()">Print Invoice</button>
    </div>

    <script>
        document.getElementById('invoice-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Capture form data
            var customerName = document.getElementById('customer-name').value;
            var customerAddress = document.getElementById('customer-address').value;
            var itemName = document.getElementById('item-name').value;
            var itemQuantity = document.getElementById('item-quantity').value;
            var itemPrice = document.getElementById('item-price').value;
            var subtotal =
