<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10 bg-gray-100">

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Payment Receipt</h2>

    <p><strong>Student:</strong> {{ $payment->student->name }}</p>
    <p><strong>Amount:</strong> MWK {{ number_format($payment->amount_paid, 2) }}</p>
    <p><strong>Date:</strong> {{ $payment->payment_date }}</p>
    <p><strong>Method:</strong> {{ $payment->method }}</p>

</div>

</body>
</html>