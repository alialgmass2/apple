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
        <td>{{ $payment->id }}</td>
    </tr>
    <tr>
        <td class="font-bold">TransactionStatus</td>
        <td>{{ $payment->status }}</td>
    </tr>
    <tr>
        <td  class="font-bold">Payment Brand</td>
        <td>Tabby</td>
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
        <td  class="font-bold">Payment description</td>
        <td>{{ $payment->description }}</td>
    </tr>
    <tr>
        <td  class="font-bold">buyer name</td>
        <td>{{ $payment->buyer['name'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">buyer email</td>
        <td>{{ $payment->buyer['email'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">buyer phone</td>
        <td>{{ $payment->buyer['phone'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">shipping city</td>
        <td>{{ $payment->shipping_address['city'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">shipping address</td>
        <td>{{ $payment->shipping_address['address'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">shipping zip</td>
        <td>{{ $payment->shipping_address['zip'] }}</td>
    </tr>
    <tr>
        <td  class="font-bold">created_at</td>
        <td>{{ $payment->created_at }}</td>
    </tr>
    </tbody>
</table>
