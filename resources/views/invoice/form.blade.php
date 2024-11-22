<form action="{{ route('generate.invoice') }}" method="POST" class="invoice-form">
    @csrf
    <h2>Create Invoice</h2>
    
    <!-- Customer Info -->
    <div class="form-section">
        <h3>Customer Information</h3>
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
        </div>
        <div class="form-group">
            <label for="customer_address">Customer Address</label>
            <textarea id="customer_address" name="customer_address" placeholder="Enter customer address" required></textarea>
        </div>
    </div>

    <!-- Item Info -->
    <div class="form-section">
        <h3>Item Information</h3>
        <div id="items">
            <div class="form-group">
                <label for="item_name_0">Item Name</label>
                <input type="text" id="item_name_0" name="items[0][name]" placeholder="Enter item name" required>
            </div>
            <div class="form-group">
                <label for="item_quantity_0">Quantity</label>
                <input type="number" id="item_quantity_0" name="items[0][quantity]" placeholder="Enter quantity" required>
            </div>
            <div class="form-group">
                <label for="item_price_0">Price</label>
                <input type="number" id="item_price_0" name="items[0][price]" placeholder="Enter price" required>
            </div>
        </div>
    </div>

    <!-- Subtotal, VAT and Total -->
    <div class="form-section">
        <h3>Invoice Summary</h3>
        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" id="subtotal" name="subtotal" placeholder="Enter subtotal" required oninput="calculateTotal()">
        </div>
        <div class="form-group">
            <label for="vat">VAT (15%)</label>
            <input type="number" id="vat" placeholder="VAT (15%)" disabled>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" id="total" placeholder="Total" disabled>
        </div>
    </div>

    <button type="submit" class="submit-btn">Generate Invoice</button>
</form>

<script>
    function calculateTotal() {
        const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
        const vat = subtotal * 0.15;  // 15% VAT
        const total = subtotal + vat;

        // Update the VAT and total fields
        document.getElementById('vat').value = vat.toFixed(2);
        document.getElementById('total').value = total.toFixed(2);
    }
</script>

<style>
    /* Basic form styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        padding: 20px;
    }

    .invoice-form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .form-section {
        margin-bottom: 20px;
    }

    .form-section h3 {
        margin-bottom: 10px;
        color: #333;
        font-size: 1.2em;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-group textarea {
        height: 80px;
    }

    .form-group input:disabled {
        background-color: #f0f0f0;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        font-size: 1.1em;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }

    /* Responsive design */
    @media (max-width: 600px) {
        .invoice-form {
            padding: 15px;
        }

        .submit-btn {
            font-size: 1em;
        }
    }
</style>
