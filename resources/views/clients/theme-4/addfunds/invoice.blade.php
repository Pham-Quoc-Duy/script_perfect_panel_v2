<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #INV-{{ str_pad($payment->id, 8, '0', STR_PAD_LEFT) }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; padding: 20px; }
        .invoice { max-width: 850px; margin: 0 auto; background: white; padding: 50px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; padding-bottom: 30px; border-bottom: 3px solid #007bff; }
        .company-info h1 { color: #007bff; font-size: 28px; margin-bottom: 8px; }
        .company-info p { color: #666; font-size: 13px; line-height: 1.6; margin: 2px 0; }
        .invoice-meta { text-align: right; }
        .invoice-meta h2 { color: #333; font-size: 32px; margin-bottom: 10px; }
        .invoice-meta p { color: #666; font-size: 14px; margin: 4px 0; }
        .status-badge { display: inline-block; padding: 6px 16px; background: #28a745; color: white; border-radius: 20px; font-size: 12px; font-weight: bold; margin-top: 8px; }
        .parties { display: flex; gap: 40px; margin-bottom: 40px; }
        .party { flex: 1; }
        .party-title { font-size: 12px; color: #999; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; font-weight: 600; }
        .party-content { background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #007bff; }
        .party-content p { color: #333; font-size: 14px; line-height: 1.8; margin: 4px 0; }
        .party-content strong { color: #000; font-weight: 600; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .invoice-table thead { background: #007bff; }
        .invoice-table th { color: white; padding: 15px; text-align: left; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
        .invoice-table td { padding: 15px; border-bottom: 1px solid #e9ecef; font-size: 14px; }
        .invoice-table tbody tr:last-child td { border-bottom: 2px solid #dee2e6; }
        .invoice-table .description { color: #333; font-weight: 500; }
        .invoice-table .description small { color: #6c757d; font-weight: 400; display: block; margin-top: 4px; }
        .invoice-table .amount { text-align: right; font-weight: 600; color: #28a745; }
        .totals { margin-left: auto; width: 300px; }
        .total-row { display: flex; justify-content: space-between; padding: 12px 0; font-size: 14px; }
        .total-row.subtotal { color: #666; border-bottom: 1px solid #e9ecef; }
        .total-row.grand-total { font-size: 20px; font-weight: bold; color: #007bff; border-top: 3px double #007bff; padding-top: 15px; margin-top: 5px; }
        .payment-info { background: #e7f3ff; padding: 20px; border-radius: 8px; margin: 30px 0; border-left: 4px solid #007bff; }
        .payment-info h3 { color: #007bff; font-size: 16px; margin-bottom: 12px; }
        .payment-info p { color: #333; font-size: 14px; line-height: 1.8; margin: 4px 0; }
        .notes { background: #fff9e6; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ffc107; }
        .notes h3 { color: #856404; font-size: 14px; margin-bottom: 8px; text-transform: uppercase; }
        .notes p { color: #856404; font-size: 13px; line-height: 1.6; }
        .footer { text-align: center; margin-top: 50px; padding-top: 30px; border-top: 2px solid #e9ecef; }
        .footer p { color: #6c757d; font-size: 12px; line-height: 1.6; }
        .action-buttons { display: flex; gap: 10px; justify-content: center; margin: 30px 0; }
        .btn { padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; font-size: 15px; font-weight: 600; transition: all 0.3s; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-primary:hover { background: #0056b3; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,123,255,0.3); }
        .btn-success { background: #28a745; color: white; }
        .btn-success:hover { background: #1e7e34; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(40,167,69,0.3); }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #545b62; }
        @media print {
            body { background: white; padding: 0; }
            .action-buttons { display: none; }
            .invoice { box-shadow: none; }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function downloadPDF() {
            const buttons = document.querySelector('.action-buttons');
            buttons.style.display = 'none';
            const element = document.querySelector('.invoice');
            html2canvas(element, { scale: 2, useCORS: true }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 190;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                pdf.save('invoice-INV-{{ str_pad($payment->id, 8, "0", STR_PAD_LEFT) }}.pdf');
                buttons.style.display = 'flex';
            });
        }
    </script>
</head>
<body>
@php
    $invoiceNo = 'INV-' . str_pad($payment->id, 8, '0', STR_PAD_LEFT);
    $methodName = $payment->paymentMethod?->name ?? 'N/A';
    $user = auth()->user();
    $siteName = $config?->site_name ?? request()->getHost();
    $siteEmail = $config?->email ?? '';
@endphp
    <div class="invoice">
        <div class="invoice-header">
            <div class="company-info">
                <h1>{{ $siteName }}</h1>
                <p>{{ $siteEmail }}</p>
            </div>
            <div class="invoice-meta">
                <h2>INVOICE</h2>
                <p><strong>Invoice #:</strong> {{ $invoiceNo }}</p>
                <p><strong>Date:</strong> {{ $payment->created_at->format('F j, Y') }}</p>
                <p><strong>Status:</strong> <span class="status-badge">PAID</span></p>
            </div>
        </div>

        <div class="parties">
            <div class="party">
                <div class="party-title">Bill From</div>
                <div class="party-content">
                    <p><strong>{{ $siteName }}</strong></p>
                    <p>{{ $siteEmail }}</p>
                </div>
            </div>
            <div class="party">
                <div class="party-title">Bill To</div>
                <div class="party-content">
                    <p><strong>{{ $user->name ?? $user->username }}</strong></p>
                    <p>Username: {{ $user->username }}</p>
                    <p>Email: {{ $user->email }}</p>
                </div>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th style="width: 60%;">Description</th>
                    <th style="width: 20%; text-align: center;">Payment Method</th>
                    <th style="width: 20%; text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="description">
                        <strong>Payment Received</strong>
                        @if($payment->note)
                            <small>{{ $payment->note }}</small>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $methodName }}</td>
                    <td class="amount">${{ number_format($payment->amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="totals">
            <div class="total-row subtotal">
                <span>Subtotal:</span>
                <span>${{ number_format($payment->amount, 2) }}</span>
            </div>
            @if($payment->bonus_amount > 0)
            <div class="total-row subtotal">
                <span>Bonus:</span>
                <span>+${{ number_format($payment->bonus_amount, 2) }}</span>
            </div>
            @endif
            <div class="total-row subtotal">
                <span>Tax (0%):</span>
                <span>$0.00</span>
            </div>
            <div class="total-row grand-total">
                <span>Total (USD):</span>
                <span>${{ number_format($payment->total_amount ?? $payment->amount, 2) }}</span>
            </div>
        </div>

        <div class="payment-info">
            <h3>Payment Information</h3>
            <p><strong>Payment Method:</strong> {{ $methodName }}</p>
            <p><strong>Transaction ID:</strong> {{ $invoiceNo }}</p>
            <p><strong>Payment Date:</strong> {{ $payment->created_at->format('F j, Y') }}</p>
            <p><strong>Status:</strong> Completed &amp; Verified</p>
        </div>

        <div class="notes">
            <h3>Important Notes</h3>
            <p>This is a computer-generated invoice and serves as proof of payment. No signature is required. If you have any questions about this invoice, please contact our support team.</p>
        </div>

        <div class="action-buttons">
            <button class="btn btn-success" onclick="downloadPDF()">📥 Download PDF</button>
            <button class="btn btn-primary" onclick="window.print()">🖨️ Print Invoice</button>
            <a href="/addfunds" class="btn btn-secondary">← Back</a>
        </div>

        <div class="footer">
            <p><strong>Thank you for your payment!</strong></p>
            <p>© {{ $siteName }} - All rights reserved</p>
            <p style="margin-top: 10px; font-size: 11px;">This invoice was generated automatically on {{ $payment->created_at->format('F j, Y') }}</p>
        </div>
    </div>
</body>
</html>
