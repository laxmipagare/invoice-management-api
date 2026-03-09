<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size:14px;
            color:#333;
        }

        .container{
            width:100%;
            margin:auto;
        }

        .header{
            width:100%;
            margin-bottom:30px;
        }

        .header h2{
            margin:0;
        }

        .company{
            float:left;
        }

        .invoice-details{
            float:right;
            text-align:right;
        }

        .clear{
            clear:both;
        }

        .customer{
            margin-top:30px;
            margin-bottom:30px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#f2f2f2;
            padding:10px;
            border:1px solid #ddd;
            text-align:left;
        }

        table td{
            padding:10px;
            border:1px solid #ddd;
        }

        .total{
            margin-top:20px;
            width:40%;
            float:right;
        }

        .total td{
            padding:8px;
        }

        .footer{
            margin-top:80px;
            text-align:center;
            font-size:12px;
            color:#777;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="header">
        <div class="company">
            <img src="{{ public_path('logo.png') }}" alt="Company Logo" width="120">
            <h2>My Company</h2>
            <p>
                Nashik, Maharashtra<br>
                Email: company@email.com<br>
                Phone: 9876543210
            </p>
        </div>

        <div class="invoice-details">
            <h2>INVOICE</h2>
            <p>
                Invoice #: {{ $invoice->id }}<br>
                Date: {{ $invoice->created_at->format('d-m-Y') }}
            </p>
        </div>

        <div class="clear"></div>
    </div>


    <div class="customer">
        <strong>Bill To:</strong><br>
        {{ $invoice->customer_name }}<br>
        {{ $invoice->customer_email }}
    </div>


    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $invoice->item_name }}</td>
                <td>{{ $invoice->quantity }}</td>
                <td>{{ $invoice->price }}</td>
                <td>{{ $invoice->quantity * $invoice->price }}</td>
            </tr>
        </tbody>
    </table>


    <table class="total">
        <tr>
            <td><strong>Subtotal</strong></td>
            <td>{{ $invoice->quantity * $invoice->price }}</td>
        </tr>
        <tr>
            <td><strong>Tax (5%)</strong></td>
            <td>{{ ($invoice->quantity * $invoice->price) * 0.05 }}</td>
        </tr>
        <tr>
            <td><strong>Grand Total</strong></td>
            <td>
                {{ $invoice->total_amount }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>{{ $invoice->status }}</strong>
            </td>            
        </tr>
    </table>

    <div class="clear"></div>


    <div class="footer">
        Thank you for your business!
    </div>

</div>

</body>
</html>