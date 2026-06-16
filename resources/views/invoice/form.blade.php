<!DOCTYPE html>
<html>
<head>
    <title>Invoice Generator</title>
    <style>
        body { font-family: Arial; margin: 20px; display: flex; gap: 40px; }
        .form-container { width: 40%; }
        .preview-container { width: 60%; border: 1px solid #ccc; padding: 20px; }

        input, button { width: 100%; padding: 8px; margin: 6px 0; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }

        .right { text-align: right; }
        hr { margin: 10px 0; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create Invoice</h2>

    <form method="POST" action="{{ route('invoice.generate') }}">
        @csrf

        <label>Invoice Date</label>
        <input type="date" id="invoice_date" name="invoice_date" required value="{{ date('Y-m-d') }}">

        <label>Period From</label>
        <input type="date" id="period_from" name="period_from" required value="{{ date('Y-m-d') }}">

        <label>Period To</label>
        <input type="date" id="period_to" name="period_to" required value="{{ date('Y-m-d') }}">

        <label>Quantity</label>
        <input type="number" id="qty" name="quantity" required value="100">

        <label>Rate</label>
        <input type="number" id="rate" name="rate" required value="25">

        <label>Total</label>
        <input type="number" id="total" name="total" readonly value="">

        <button type="submit">Download PDF</button>
    </form>
</div>

<div class="preview-container" id="preview-area">
    @include('invoice.layout', [
        'invoice_date' => '',
        'period_from' => '',
        'period_to' => '',
        'quantity' => 0,
        'rate' => 0,
        'total' => 0,
        'company' => $company,
        'client' => $client
    ])
</div>

<script>
function updatePreview() {
    let date = document.getElementById('invoice_date').value;
    let from = document.getElementById('period_from').value;
    let to = document.getElementById('period_to').value;
    let qty = document.getElementById('qty').value || 0;
    let rate = document.getElementById('rate').value || 0;

    let total = qty * rate;

    document.getElementById('total').value = total;

    document.getElementById('p_date').innerText = date || '-';
    document.getElementById('p_period').innerText = (from && to) ? from + ' to ' + to : '-';
    document.getElementById('p_qty').innerText = qty;
    document.getElementById('p_rate').innerText = rate;
    document.getElementById('p_total').innerText = total;
    document.getElementById('p_grand').innerText = total;
}
// Attach listeners
['invoice_date','period_from','period_to','qty','rate'].forEach(id => {
    document.getElementById(id).addEventListener('input', updatePreview);
});
</script>

</body>
</html>