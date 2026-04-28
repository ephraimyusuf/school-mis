<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice PDF</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>School Invoice</h2>

<p><strong>Student:</strong> {{ $student->name }}</p>
<p><strong>Date:</strong> {{ now()->format('d M Y') }}</p>

<table>
    <tr>
        <th>Fee</th>
        <th>Amount</th>
    </tr>

    @foreach($fees as $fee)
    <tr>
        <td>{{ $fee->fee->name }}</td>
        <td>{{ number_format($fee->amount, 2) }}</td>
    </tr>
    @endforeach
</table>

<h3>Total: {{ number_format($total, 2) }}</h3>
<h4>Paid: {{ number_format($student->total_paid, 2) }}</h4>
<h2>Balance: {{ number_format($student->balance, 2) }}</h2>

</body>
</html>