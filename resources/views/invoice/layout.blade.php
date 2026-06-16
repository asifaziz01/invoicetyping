<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .container { width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        .no-border td { border: none; text-align: left; padding: 2px; }
        .right { text-align: right; }
        .center { text-align: center; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>

<div class="container">

    <h3 class="center">Invoice for Typing</h3>

    <p class="">Dated: <span id="p_date">{{ $invoice_date ?? date('d-m-Y') }}</span></p>

    <p>
        <strong>To,</strong><br>
        {{ $client['name'] }}<br>
        {{ $client['address1'] }}<br>
        {{ $client['address2'] }}<br>
        Telephone: {{ $client['phone'] }}<br>
        Email ID: {{ $client['email'] }}
    </p>

    <p>
    </p>

    <table>
        <tr>
            <th>Invoice No</th>
            <th>Date From</th>
            <th>Date Till</th>
        </tr>
        <tr>
            <td>{{ $invoice_no ?? '—' }}</td>
            <td id="p_from">{{ $period_from ?? '-' }}</td>
            <td id="p_to">{{ $period_to ?? '-' }}</td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <th>Particulars</th>
            <th>Rate</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Typing A4 size pages</td>
            <td id="p_rate">{{ $rate ?? 0 }}/-</td>
            <td id="p_qty">{{ $quantity ?? 0 }}</td>
            <td id="p_total">{{ $total ?? 0 }}/-</td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <td class="right bold">Total</td>
            <td class="bold" id="p_grand">{{ $total ?? 0 }}/-</td>
        </tr>
    </table>

    <p>
        <strong>In Words:</strong>
        <span id="p_words">{{ $total_in_words ?? '' }}</span>
    </p>

    <br>

    <p><strong>Bank details for depositing the above amount:</strong></p>

    <table class="no-border">
        <tr><td>Bank: {{ $bank['name'] }}</td></tr>
        <tr><td>Account Name: {{ $bank['account_name'] }}</td></tr>
        <tr><td>Account No: {{ $bank['account_number'] }}</td></tr>
        <tr><td>IFSC Code: {{ $bank['ifsc'] }}</td></tr>
    </table>

    <br><br>

    <p>Sign:</p>
    <p>
        @if(!empty($signature))
            <img src="{{ $signature }}" style="height: 60px;">
        @endif
    </p>
    <p>
        Name: {{ $company['name'] }}<br>
        Address: {{ $company['address'] }}<br>
        Mobile No: {{ $company['phone'] }}<br>
        Email ID: {{ $company['email'] }}
    </p>

</div>

</body>
</html>