<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function showForm()
    {
        return view('invoice.form');
    }

    public function generateInvoice(Request $request)
{
    // Validate the input
    $validated = $request->validate([
        'customer_name' => 'required|string',
        'customer_address' => 'required|string',
        'items' => 'required|array',
        'subtotal' => 'required|numeric',
    ]);

    // Calculate VAT (15%) and total
    $vat = $validated['subtotal'] * 0.15;  // 15% VAT
    $total = $validated['subtotal'] + $vat; // Total = Subtotal + VAT

    // Create the invoice in the database
    $invoice = Invoice::create([
        'invoice_number' => 'INV-' . rand(1000, 9999),  // Generate a random invoice number
        'customer_name' => $validated['customer_name'],
        'customer_address' => $validated['customer_address'],
        'items' => json_encode($validated['items']),  // Store items as JSON
        'subtotal' => $validated['subtotal'],
        'vat' => $vat,
        'total' => $total,
    ]);

    // Return a view to display the generated invoice
    return view('invoice.show', compact('invoice'));
}

}
