<div>
    <h1 style="text-align: center" >Detail Transaksi</h1>
    <h2>Invoice: #{{ $transactionsa["notransaksi"] }}</h2>
    <table width="100%" >
        <thead>
            <tr>
                <th width="35%"  style="text-align: left">Toko</th>
                <th style="text-align: left;,margin-right: 5%">Customer</th>
                @if ($driver != null)
                    <th style="text-align: left">Driver</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="35%" style="margin-right: 5%,vertical-align: text-top">
                    <h4>{{ $store["store_name"] }}</h4>
                    <p>
                        {{ $store["address"] }}
                    </p>
                    <p>  {{ $store["latitude"] }},{{ $store["longititude"] }}</p>
                    <p>Phone :{{ $store["phone"] }}</p>
                </td>

                <td width="35%" style="vertical-align: text-top">
                    <h4>{{ $transactionsa["customer_name"] }}</h4>
                    <p>
                        {{ $transactionsa["address_customer"] }}
                    </p>
                    <p> {{ $transactionsa["latitude"] }},{{ $transactionsa["longitude"] }}</p>
                    <p>Phone :{{ $transactionsa["customer_phone"] }}</p>
                </td>

                @if ($driver != null)
                <td width="35%" style="vertical-align: text-top">
                    <h4>{{ $driver["name"] }}</h4>
                    <p>Plat kendaraan: {{ $driver["plat"] }}</p>
                    <p>Phone : {{ $driver["phone"] }}</p>
                </td>
                @endif

            </tr>
        </tbody>
    </table>
    <br>

    <table width="100%">
        <thead>
            <tr style="background: rgb(144, 140, 140)">
                <th style="text-align: left">QTY</th>
                <th style="text-align: left">PRODUCT</th>
                <th style="text-align: left">CATEGORY</th>
                <th style="text-align: left">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $detailTransaction as $item )
            <tr>
                <td>{{ $item['count']}}</td>
                <td>{{ $item['name_product'] }}</td>
                <td>{{ $item['category']}}</td>
                <td>Rp {{ number_format($item['price_product'] * $item['count'],'0',',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <br>
    <table width="100%">
        <tbody>
            <tr>
                <th width="60%"></th>
                <th style="text-align: left"><h3>Subtotal</h3></th>
                <td>Rp {{ number_format($totalTransaction,'0',',','.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            @if ($promo != null)
            <tr >
                <th width="60%"></th>
                <th style="text-align: left"><h3>Discount</h3></th>
                <td>- Rp {{ number_format($promo,'0',',','.') }}</td>
            </tr>
          @endif
            <tr>
                <th width="60%"></th>
                <th style="text-align: left"><h3>Biaya Driver</h3></th>
                <td>Rp {{ number_format($transactionsa["driver_price"],'0',',','.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            @if ($promo != null)
            <tr>
                <th width="60%"></th>
                <th style="text-align: left"><h3>Total:</h3></th>
                <td>Rp {{ number_format( $totalTransaction + $transactionsa["driver_price"]- $promo,'0',',','.')  }}</td>
            </tr>
            @else
            <tr>
                <th width="60%"></th>
                <th style="text-align: left"><h3>Total:</h3></th>
                <td>Rp {{ number_format($totalTransaction + $transactionsa["driver_price"],'0',',','.') }}</td>
            </tr>
            @endif

        </tbody>
    </table>
</div>
