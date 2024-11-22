<html>
<head>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 30px;
        }

        .invoice-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Improved Header Styling */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }

        /* Logo Styling */
        .invoice-header .logo img {
            width: 150px;
            height: auto;
        }

        /* Invoice Title */
        .invoice-header .invoice-details {
            text-align: right;
            font-size: 1.6em;
        }

        .invoice-header h1 {
            font-size: 2.8em;
            color: #333;
            margin: 0;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Invoice Info */
        .invoice-info {
            margin-bottom: 30px;
        }

        .invoice-info p {
            font-size: 1.2em;
            margin: 8px 0;
        }

        .invoice-info strong {
            color: #007bff;
        }

        /* Table for Items */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .items-table th,
        .items-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 1.2em;
        }

        .items-table th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #333;
        }

        .items-table td {
            color: #555;
        }

        /* Summary Section */
        .invoice-summary {
            display: flex;
            justify-content: space-between;
            font-size: 1.3em;
            margin-top: 30px;
            color: #333;
            font-weight: bold;
        }

        .invoice-summary .label {
            font-weight: 600;
        }

        .invoice-summary .value {
            color: #007bff;
        }

        /* Footer */
        .invoice-footer {
            text-align: center;
            margin-top: 40px;
            font-size: 1.2em;
            color: #555;
            border-top: 2px solid #007bff;
            padding-top: 20px;
        }

        .invoice-footer a {
            color: #007bff;
            text-decoration: none;
        }

        /* Button Styling */
        button {
            padding: 14px 24px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.2em;
            cursor: pointer;
            width: 100%;
            margin-top: 40px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .invoice-container {
                padding: 30px;
            }

            .invoice-header h1 {
                font-size: 2.2em;
            }

            .invoice-summary {
                font-size: 1.1em;
                flex-direction: column;
                align-items: flex-start;
            }

            .items-table th,
            .items-table td {
                padding: 12px 15px;
            }
        }

        /* Print Styling */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background-color: white;
            }

            .invoice-container {
                box-shadow: none;
                padding: 20px;
                border: none;
                margin: 0;
            }

            button {
                display: none; /* Hide print button when printing */
            }

            .invoice-header h1 {
                font-size: 2.2em;
                color: #333;
            }

            .invoice-summary {
                font-size: 1.2em;
            }

            .invoice-footer {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo">
            </div>
            <div class="invoice-details">
                <h1>Invoice #{{ str_pad($invoice->invoice_number, 5, '0', STR_PAD_LEFT) }}</h1>
                <div class="invoice-info">
                    <p><strong>Date:</strong> {{ $invoice->created_at->format('F j, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="invoice-info">
            <p><strong>Bill To:</strong></p>
            <p>{{ $invoice->customer_name }}</p>
            <p>{{ $invoice->customer_address }}</p>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach(json_decode($invoice->items) as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Invoice Summary -->
        <div class="invoice-summary">
            <div><span class="label">Subtotal:</span> <span class="value">${{ number_format($invoice->subtotal, 2) }}</span></div>
            <div><span class="label">VAT (15%):</span> <span class="value">${{ number_format($invoice->vat, 2) }}</span></div>
            <div><span class="label">Total:</span> <span class="value">${{ number_format($invoice->total, 2) }}</span></div>
        </div>

        <!-- Print Button -->
        <button onclick="window.print()">Print Invoice</button>

        <!-- Footer -->
        <div class="invoice-footer">
            <p>&copy; 2024 <strong>Cyntex Solutions</strong></p>
            <p>Visit us at: <a href="https://cyntexsolutions.net" target="_blank">cyntexsolutions.net</a></p>
        </div>
    </div>
</body>
</html>
