<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container p-5">
    <div class="row">
        <div class="col">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;$amount=0;$taxTotal=0;?>
                    {{-- {{ dd($datas) }} --}}
                    @foreach ($datas as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ round($item['tax'],1) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['total'] }}</td>
                    </tr>
                    <?php $i++;$amount+=$item['total'];$taxTotal+=$item['tax']; ?>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th>Total Tax:</th>
                        <th>{{ round($taxTotal) }}</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th>Sub Total:</th>
                        <th>{{ round($taxTotal+$amount) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   </div>
</body>
</html>