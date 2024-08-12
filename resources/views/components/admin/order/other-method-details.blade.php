<h3 class="fw-bold mb-3 fs-26">Payment Details</h3>
<table class="table table-responsive-md mt-5 table-bordered  xtable-striped">
    <thead>
    <tr>
        <th class="w-250px"><strong>Name</strong></th>
        <th><strong>Description</strong></th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td class="font-bold">TransactionId</td>
        <td>{{ $payment->merchantTransactionId }}</td>
    </tr>
    <tr>
        <td class="font-bold">TransactionStatus</td>
        <td>{{ $payment->result['description'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Payment Brand</td>
        <td>{{ $payment->paymentBrand }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Payment Amount</td>
        <td>{{ $payment->amount }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Payment currency</td>
        <td>{{ $payment->currency }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card Bin</td>
        <td>{{ $payment->card['bin'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Bin Country</td>
        <td>{{ $payment->card['binCountry'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card Last4Digits</td>
        <td>{{ $payment->card['last4Digits'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card Holder</td>
        <td>{{ $payment->card['holder'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card ExpiryMonth</td>
        <td>{{ $payment->card['expiryMonth'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card ExpiryYear</td>
        <td>{{ $payment->card['expiryYear'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card Bank</td>
        <td>{{ $payment->card['issuer']['bank'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card type</td>
        <td>{{ $payment->card['type'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card Level</td>
        <td>{{ $payment->card['level'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card Country</td>
        <td>{{ $payment->card['country'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card MaxPanLength</td>
        <td>{{ $payment->card['maxPanLength'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Card BbinType</td>
        <td>{{ $payment->card['binType'] }}</td>
    </tr>
    </tbody>
</table>
