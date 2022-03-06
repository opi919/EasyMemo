<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 20px;
            background-color: #f7f7ff;
        }

        #invoice {
            padding: 0px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #0d6efd
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #0d6efd;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border-top: 1px solid #0d6efd
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

    </style>
</head>

<body>
<div class="">
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
                                        {{-- <img src="{{ asset('storage/logo/'.$datas['brand'][0]->brand_logo) }}" width="80" alt=""> --}}
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="javascript:;">{{ $datas['brand'][0]->brand_name }}</a>
                                    </h2>
                                    <div>{{ $datas['brand'][0]->brand_address }}</div>
                                    <div>{{ $datas['brand'][0]->brand_contact }}</div>
                                    <div>{{ $datas['brand'][0]->brand_email }}</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <?php $user = 1; ?>
                                    @for ($i=0;$i<count($datas)-1;$i++)
                                        @if ($user == 1)
                                            <h2 class="to">{{ $datas[$i]['customer_name'] }}</h2>
                                            <div class="address">{{ $datas[$i]['customer_phone'] }}</div>
                                            <div class="address">{{ $datas[$i]['customer_address'] }}</div>
                                            <div class="email"><a
                                                    href="mailto:{{ $datas[$i]['customer_email'] }}">{{ $datas[$i]['customer_email'] }}</a>
                                        @endif
                                        <?php $user++; ?>
                                    @endfor
                                </div>
                            </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">NAME</th>
                                <th class="text-right">TAX</th>
                                <th class="text-right">QUANTITY</th>
                                <th class="text-right">PRICE</th>
                                <th class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;$subTotal=0;$tax=0; ?>
                            @for ($i=0;$i<count($datas)-1;$i++)
                            <tr>
                                <td class="no">{{ $i+1 }}</td>
                                <td class="text-left">{{ $datas[$i]['name'] }}</td>
                                <td class="qty">{{ round($datas[$i]['tax'], 1) }}</td>
                                <td class="qty">{{ $datas[$i]['quantity'] }}</td>
                                <td class="unit">{{ $datas[$i]['price'] }}</td>
                                <td class="total">{{ $datas[$i]['total'] }}</td>
                            </tr>
                            <?php $subTotal+=$datas[$i]['total'];$tax+=$datas[$i]['tax']?>
                            @endfor
                            {{-- @foreach ($datas as $item)
                                <tr>
                                    <td class="no">{{ $i }}</td>
                                    <td class="text-left">{{ $item['name'] }}</td>
                                    <td class="qty">{{ round($item['tax'], 1) }}</td>
                                    <td class="qty">{{ $item['quantity'] }}</td>
                                    <td class="unit">{{ $item['price'] }}</td>
                                    <td class="total">{{ $item['total'] }}</td>
                                </tr>--}}
                                
                            {{-- @endforeach --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">SUBTOTAL</td>
                                <td>{{ $subTotal }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">TAX</td>
                                <td>{{ $tax }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">GRAND TOTAL</td>
                                <td>{{ round($subTotal+$tax) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    </main>
                    <footer>Tinkers Technologies Limited</footer>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                <div></div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
